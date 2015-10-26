<?php

namespace itway\Http\Controllers;

use Illuminate\Http\Request;
use itway\Http\Requests;
use itway\Http\Controllers\Controller;
use Itway\Repositories\Users\UserRepository;
use itway\User;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Thread;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App;
use itway\Events\UserEnteredChatEvent;
use itway\Events\ChatRoomCreated;

class MessagesController extends Controller
{
    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

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

    /**
     * Creates a new message thread
     *
     * @return mixed
     */
    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get();

        return view('messages.create', compact('users'));
    }

    /**
     * Stores a new message thread
     *
     * @return mixed
     */
    public function store()
    {
        $input = Input::all();

        $thread = Thread::create(
            [
                'subject' => $input['subject'],
            ]
        );

        // Message
        Message::create(
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

        event(new ChatRoomCreated());

        return redirect(App::getLocale().'/chat');
    }

    /**
     * Adds a new message to a current thread
     *
     * @param $id
     * @return mixed
     */
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
}
