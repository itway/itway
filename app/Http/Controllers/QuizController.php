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

    private $repository;

    public function __construct(QuizRepository $repository){

        $this->repository = $repository;

    }

    /**
     * redirect if nothing found
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectNotFound()
    {
        return redirect()->to(App::getLocale()."/quiz")->with(\Flash::error('Quiz Not Found!!'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
       $quizes = $this->repository->allOrSearch($request->get('q'));

        $countUserQuizzes = count($quizes->where('user_id', Auth::id()));


        return view('Quiz.index', compact('quizes', 'countUserQuizzes'));
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

        return redirect()->to(App::getLocale().'/quiz/show/'.$quiz->id);


    }


    /**
     * show single quiz and pass some data to views
     *
     * @param $slug
     * @param Quiz $quizdata
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($slug)

    {
        try {
            $quiz = $this->repository->getModel()->findBySlugOrId($slug);

            $quiz->view();

            $quizUser = $quiz->user_id;

            $countUserQuizzes = $this->repository->countUserQuizzes();


            if(Auth::user() && Auth::user()->id === $quizUser) {

                $createdByUser = true;

                return view('quiz.single', compact('quiz', 'createdByUser','countUserQuizzes'));
            }
            else {
                $createdByUser = false;

                return view('quiz.single', compact('quiz','createdByUser','countUserQuizzes'));
            }
        } catch (ModelNotFoundException $e) {

            return $this->redirectNotFound();

        }

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

    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if($deleted) {

            Toastr::success(Auth::user()->name, $title = 'Your Quiz deleted successfully! Have a nice day!', $options = []);

            return redirect()->to(App::getLocale().'/quiz');
        }
    }

    public function tags($slug) {

        $quizzes = Quiz::withAnyTag([$slug])->latest('published_at')->published()->paginate(8);

        $countUserQuizzes = $this->repository->countUserQuizzes();

        return view('Quiz.index',compact('quizzes', 'countUserQuizzes'));
    }

}
