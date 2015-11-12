<?php

namespace Itway\Repositories;

use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Repositories\EventRepository;
use Itway\Models\Event;
use Itway\Validation\Event\EventRequest;
use Itway\Commands\CreateEventCommand;
use App;
use Lang;
use Itway\Models\Picture;
use Auth;
/**
 * Class EventRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class EventRepositoryEloquent extends BaseRepository implements EventRepository
{
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
    'organizer_link' => 'like'
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


    /**create the event
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
     * bind an image to the event
     *
     * @param $image
     * @param $event
     */
    protected function bindImage($image, $event){

        $this->uploader->upload($image, config('image.eventsDESTINATION'))->save(config('image.eventsDESTINATION'));

        $picture = Picture::create(['path' => $this->uploader->getFilename()]);

        $event->picture()->attach($picture);
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
     * ban or unban the user
     *
     * @param $id
     */
    public function banORunBan($id)
    {
        $event = $this->find($id);

        if ($event->banned === 0) {

            \Toastr::warning('Event banned!', $title = $event->name, $options = []);

            $event->banned = true;

        }
        else {
            \Toastr::info('Event unbanned!', $title = $event->name, $options = []);

            $event->banned = false;
        }

        $event->update();
    }


}
