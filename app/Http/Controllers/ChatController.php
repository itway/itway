<?php

namespace itway\Http\Controllers;

use Illuminate\Http\Request;
use itway\Http\Requests;
use itway\Http\Controllers\Controller;
use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Itway\Components\Messenger\Models\Thread;
use Itway\Components\Messenger\Models\Message;
use Itway\Components\Messenger\Models\Participant;
use itway\User;
use Session;
use Itway\Repositories\Users\UserRepository;
use Input;
use Response;
use itway\Events\ChatMessageCreated;
use App;
use Validator;
use DateTime;
use Illuminate\Support\Str;
use Carbon\Carbon;
use itway\Events\UserEnteredChatEvent;
use itway\Events\ChatRoomCreated;

class ChatController extends Controller
{

    private $userRepository;
    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository){

        $this->userRepository = $userRepository;

    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectNotFound()
    {
        return redirect()->to(App::getLocale()."/")->with(\Flash::error('UPS Error happened!!'));
    }

    /**
     * Show all of the message threads to the user
     *
     * @return mixed
     */
    public function index()
    {
        try {
            if (Auth::user()) {

                $user = Auth::user();

                // All threads, ignore deleted/archived participants
//            $threads = Thread::getAllLatest()->get();

                // All threads that user is participating in

                $threads = Thread::forUser($user->id)->latest('updated_at')->get();

                $users = User::all();
//             All threads that user is participating in, with new messages
//             $threads = Thread::forUserWithNewMessages($currentUserId)->latest('updated_at')->get();

                return view('messages.index', compact('threads', 'user', 'users'));
            }
            else {
                return redirect()->to("/auth/login");
            }
        } catch (ModelNotFoundException $e) {

            return $this->redirectNotFound();

        }
    }

    public function getUsersConversations($user_id){

        $conversations = Thread::forUser($user_id)->latest('updated_at')->get();

        return Response::json([
            'success' => true,
            'result' => $conversations
        ]);
    }

    /**
     * Shows a message thread
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try {
            if (Auth::user()) {

                $user = Auth::user();


                $thread = Thread::findOrFail($id);


                $threads = Thread::forUser($user->id)->latest('updated_at')->get();

            }
            else
            {
                return redirect()->to('auth/login');
            }
        } catch (ModelNotFoundException $e) {

            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect(App::getLocale().'/messages');
        }

        // show current user in list if not a current participant
//         $users = User::whereNotIn('id', $thread->participantsUserIds())->get();

        // don't show the current user in list

        $userId = Auth::user()->id;


        $participants_list = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();

        $users = User::all();

        $thread->markAsRead($userId);

        event(new UserEnteredChatEvent($user));

        return view('messages.show', compact('thread','threads', 'participants_list','users', 'user', 'userId'));
    }

    public function update($id)
    {
        try {

            $thread = Thread::findOrFail($id);

        } catch (ModelNotFoundException $e) {

            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect('messages');
        }

        $thread->activateAllParticipants();

        // Message
        Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::id(),
                'body'      => Input::get('message'),
            ]
        );

        // Add replier as a participant
        $participant = Participant::firstOrCreate(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id
            ]
        );
        $participant->last_read = new Carbon;
        $participant->save();

        // Recipients
        if (Input::has('recipients')) {

            $thread->addParticipants(Input::get('recipients'));
        }

        return redirect(route('itway::messages.show', $id));
    }


    public function getConversations () {

            try {

                if (Auth::check()) {

                    $user = User::find(Input::get('user_id'));

                    $thread = Thread::findOrFail(Input::get('conversation'));

                    $checkUser = $thread->hasParticipant(Input::get('user_id'));

                    if (!$checkUser) {

                        return Response::json([
                            'notInRoom' => true
                        ]);
                    }
                    if ($thread->creator()->id === Auth::user()->id) {

                        $threadCreatedByUser = true;

                    }
                    else {

                        $threadCreatedByUser = true;

                    }

                }
                else {

                    return redirect()->to("/auth/login");

                }

            } catch (ModelNotFoundException $e){

                return $this->redirectNotFound();

            }


            return view('messages.conversations', compact('threadCreatedByUser', 'thread', 'user'));

    }

    public function getMessage() {

        try {

            $thread = Thread::findOrFail(Input::get('conversation'));


        } catch (ModelNotFoundException $e) {

            Session::flash('error_message', 'The thread with ID: ' . Input::get('conversation') . ' was not found.');

            return redirect(App::getLocale().'/messages');
        }

        $thread->activateAllParticipants();

        $user = User::find(Input::get('user_id'));

        $message = Message::where('user_id', $user->id)->where('thread_id', $thread->id)->get()->last();

        $thread->markAsRead(Auth::user()->id);

        return view('messages.message', compact('thread', 'message'));

    }

    public function sendMessage() {

        try {
            $rules = array('body' => 'required','conversation' => 'required', 'user_id' => 'required');

            $validator = Validator::make(Input::all(), $rules);

            if($validator->fails()) {

                return Response::json([
                    'success' => false,
                    'result' => $validator->messages()
                ]);

            }

            $thread = Thread::findOrFail(Input::get('conversation'));



        } catch (ModelNotFoundException $e) {

            Session::flash('error_message', 'The thread with ID: ' . Input::get('conversation') . ' was not found.');

            return redirect(App::getLocale().'/chat');
        }

        $thread->activateAllParticipants();

        $params = array(
            'thread_id' => $thread->id,
            'user_id'           => Input::get('user_id'),
            'body'               => Input::get('body'),
            'created_at'      => new DateTime
        );

        // Message
        $message = Message::create($params);


        $data = array(
            'room'        => Input::get('conversation'),
            'message'  => array( 'body' => Str::words($message->body, 60), 'user_id' => Input::get('user_id'))
        );

        // Add replier as a participant
        $participant = Participant::firstOrCreate(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id
            ]
        );

        $participant->last_read = new Carbon;

        $participant->save();

        // Recipients
        if (Input::has('recipients')) {

            $thread->addParticipants(Input::get('recipients'));
        }

        event(new ChatMessageCreated($data));

        return Response::json([
            'success' => true,
            'result' => $message
        ]);
    }

    public function createForm()
    {

        $users = User::all();

        return view("messages.create", compact("users"));
    }
    public function createRoom()
    {
        $input = Input::all();

        $thread = Thread::create(
            [
                'subject' => $input['subject'],
            ]
        );

        // Message
        $message = Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'body'      => $input['message'],
            ]
        );

        // Sender
        Participant::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'last_read' => new Carbon
            ]
        );

        // Recipients
        if (Input::has('recipients')) {

            $thread->addParticipants($input['recipients']);

        }

        $data = array(
            'room'        => $thread->id,
            'message'  => array( 'body' => Str::words($message->body, 60), 'user_id' => Auth::user()->id)
        );

        event(new ChatRoomCreated($data));

        return redirect(App::getLocale().'/chat');
    }

}
