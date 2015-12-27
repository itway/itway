<?php

namespace Itway\Repositories;

use Itway\Uploader\ImageContract;
use Itway\Uploader\ImageTrait;
use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Repositories\PollRepository;
use Itway\Models\Poll;
use itway\Commands\CreatePollCommand;
use Itway\Repositories\EloquentRepository;
use Itway\Validation\Poll\PollFormRequest;
use Illuminate\Contracts\Bus\Dispatcher;
use Itway\Uploader\ImageUploader;
use Auth;
use Itway\Models\Picture;
use Lang;
use Itway\Models\PollOptions;

use Itway\Contracts\Bannable\Bannable;
use Itway\Traits\Banable;
/**
 * Class PollRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class PollRepositoryEloquent extends BaseRepository implements PollRepository, ImageContract, Bannable
{
    use ImageTrait, Banable;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
{
    return Poll::class;
}

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
{
    $this->pushCriteria(app(RequestCriteria::class));
}

    /**
     * @return mixed
     */
    public function getModel()
{
    $model = Poll::class;

    return new $model;
}

    /** fetch all paginated, published and localed posts */
    public function getAll()
{
    return $this->getModel()->latest('published_at')->published()->localed()->paginate();
}
    /** fetch all users paginated, published and localed posts */
    public function getAllUsers()
{
    return $this->getModel()->latest('published_at')->published()->localed()->users()->paginate();
}


    /**
     * @param PollFormRequest $request
     * @param $image
     * @return mixed
     */
    public function createPoll(PollFormRequest $request, $image = null){

    $quiz = $this->dispatcher->dispatch(
        new CreatePollCommand(
            $request->name,
            $request->question,
            $request->tags_list,
            $request->published_at,
            $request->localed = Lang::locale()
        ));

    $this->bindImage($image, $quiz);

    $this->bindOptions($quiz, $request->options);

    return $quiz;
}


    protected function bindOptions($quiz, $options) {

    $options = remove_empty($options);

    foreach($options as $option) {

        PollOptions::create([
            "poll_id" => $quiz->id,
            "option" => $option
        ]);

    }
}


    /**
     * return the number of user's posts
     *
     * @return mixed
     */
    public function countUserPolls(){

    return $this->getModel()->where('user_id', '=', Auth::id())->count();
}

    /**
     * return the number of today's posts
     *
     * @return mixed
     */
    public function todayPolls(){

    return $this->getModel()->latest('published_at')->published()->today()->count();

}
}
