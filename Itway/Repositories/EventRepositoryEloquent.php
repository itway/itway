<?php

namespace Itway\Repositories;

use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Models\Event;
use Itway\Validation\Event\EventRequest;
use Itway\Commands\CreateEventCommand;
use App;
use Lang;
use Auth;
use Itway\Uploader\ImageContract;
use Itway\Uploader\ImageTrait;

use Itway\Contracts\Bannable\Bannable;
use Itway\Traits\Banable;
/**
 * Class EventRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class EventRepositoryEloquent extends BaseRepository implements EventRepository, ImageContract
{
    use ImageTrait;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Event::class;
    }

/**
     * @var array
     */
    protected $fieldSearchable = [
    'name' => '=',
    'description' => 'like',
    'time' => 'like', 
    'date' => 'like', 
    'organizer' => '=', 
    'place' => 'like', 
    'max_people_number' => '=', 
    'organizer_link' => 'like',
    'today' =>'='
    ];

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

//    public function createEvent(EventRequest $request, $image) {
//
//
//
//    }

     /**
     * get the model instance
     *
     * @return mixed
     */
    public function getModel()
    {
        $model = Event::class;

        return new $model;
    }

    /** fetch all paginated, published and localed events */
    public function getAll()
    {
        return $this->getModel()->latest('published_at')->published()->localed()->paginate();
    }
    /** fetch all users paginated, published and localed events */
    public function getAllUsers()
    {
        return $this->getModel()->latest('published_at')->published()->localed()->users()->paginate();
    }


    /**
     * create the event
     *
     * and dispatch the command
     * @param EventRequest $request
     * @param $image
     * @return mixed
     */
    public function createEvent(EventRequest $request, $image){

        $event = $this->dispatcher->dispatch(
            new CreateEventCommand(
                $request->name,
                $request->description,
                $request->time,
                $request->date,
                $request->event_format,
                $request->organizer,
                $request->place,
                $request->max_people_number,
                $request->organizer_link,
                $request->published_at,
                $request->localed = Lang::locale()
            ));

        $this->bindImage($image, $event);

        return $event;
    }


    /**
     * return the number of user's events
     *
     * @return mixed
     */
    public function countUserEvents(){

        return $this->getModel()->where('user_id', '=', Auth::id())->count();

    }
    /**
     * return the number of today's events
     *
     * @return mixed
     */
    public function todayEvents(){

        return $this->getModel()->latest('published_at')->published()->today()->count();

    }

    /**
     * ban or unban instance
     *
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function banORunBan($id)
    {
        try {
            $instance = $this->find($id);
            if ($instance->banned === 0) {
                \Toastr::warning(trans('bans.' . strtolower($this->getModelName())), $title = $instance->title, $options = []);
                $instance->banned = true;
            } else {
                \Toastr::info(trans('unbans.' . strtolower($this->getModelName())), $title = $instance->title, $options = []);
                $instance->banned = false;
            }
            $instance->update();
        } catch (\Exception $e) {
            return response("Error appeared. Maybe model doesn't have banned field" . $e->getMessage(), $e->getCode());
        }
    }

}
