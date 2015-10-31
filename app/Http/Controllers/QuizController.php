<?php

namespace itway\Http\Controllers;

use Auth;
use Conner\Tagging\Tag;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use itway\Http\Requests;
use itway\Quiz;
use Itway\Repositories\Quiz\QuizRepository;
use Itway\Services\Youtube\Facades\Youtube;
use nilsenj\Toastr\Facades\Toastr;
use Itway\Validation\Quiz\QuizFormRequest;
use App;

class QuizController extends Controller
{
    public function __construct(QuizRepository $repository){

        $this->repository = $repository;

    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
       $quizes = $this->repository->allOrSearch($request->get('q'));

        $countUserQuizes = count($quizes->where('user_id', Auth::id()));


        return view('Quiz.index', compact('quizes', 'countUserQuizes'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tagCollection = Tag::where('count', '>=', ENV('SUPPOSED_TAGS', 5))->get();

        $tags =  $tagCollection->lists('name', 'id');

        return view('Quiz.create', compact('tags'));

    }
    public function personalQuizzes(Request $request, Quiz $quizData){

        if (Auth::user()){

            try {
                $quizzes = $this->repository->allOrSearchUsers($request->get('q'));

                $countUserQuizzes = count($quizzes->where('user_id', Auth::id()));

                if(count($quizzes) === 0)
                {
                    Toastr::warning(trans('messages.noQuizzesFound'), $title = trans('messages.noQuizzesFoundTitle'), $options = []);

                    return redirect()->back();
                }
                else {

                    return view('quiz.index', compact('quizzes', 'countUserQuizzes'));
                }

            } catch (ModelNotFoundException $e) {

                return $this->redirectNotFound();
            }

        }
    }

    /**
     * store the quiz
     *
     * @param QuizFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(QuizFormRequest $request)
    {

        if (\Input::hasFile('image')) {

            $quiz = $this->repository->createQuiz($request, \Input::file('image'));
        }
        else {

            $quiz = $this->repository->createQuiz($request, null);

        }

        Toastr::success(trans('messages.yourQuizCreated'), $title = $quiz->title, $options = []);

        return redirect()->to(App::getLocale().'/quiz/'.$quiz->id);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
