<?php

namespace Itway\Repositories;

use App;
use Auth;
use Itway\Commands\CreateEventCommand;
use Itway\Commands\UpdateEventCommand;
use Itway\Models\Event;
use Itway\Models\EventSpeakers;
use Itway\Models\User;
use Itway\Uploader\ImageTrait;
use Itway\Validation\Event\EventRequest;
use Itway\Validation\Event\UpdateEventRequest;
use Lang;
use Prophecy\Comparator\Factory;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use RepositoryLab\Repository\Eloquent\BaseRepository;

/**
 * Class EventRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class EventRepositoryEloquent extends BaseRepository implements EventRepository
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
        'today' => 'like'
    ];

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

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

    /** fetch all paginated, created_at and localed events */
    public function getAll()
    {
        return $this->getModel()->latest('created_at')->localed()->paginate();
    }

    /** fetch all users paginated, created_at and localed events */
    public function getAllUsers()
    {
        return $this->getModel()->latest('created_at')->localed()->users()->paginate();
    }


    /**
     * create the event
     *
     * and dispatch the command
     * @param EventRequest $request
     * @param $image
     * @return mixed
     */
    public function createEvent(EventRequest $request, $image)
    {
        $event = $this->dispatcher->dispatch(
            new CreateEventCommand(
                $request->name,
                $request->preamble,
                $request->description,
                $request->time,
                $request->date,
                $request->timezone,
                $request->event_format,
                $request->youtube_link,
                $request->city,
                $request->invite,
                Auth::user()->id,
                $request->localed = Lang::locale(),
                $request->tags_list
            ));
        if (!is_null($image)) {
            $this->bindImage($image, $event);
        }
        if (!is_null($request->speakers)) {
            $this->bindSpeakers($event, trim($request->speakers));
        }
        return $event;
    }

    /**
     * @param UpdateEventRequest $request
     * @param $image
     */
    public function updateEvent(UpdateEventRequest $request, $image)
    {

        $event = $this->dispatcher->dispatch(
            new UpdateEventCommand(
                $request->name,
                $request->preamble,
                $request->description,
                $request->time,
                $request->date,
                $request->timezone,
                $request->event_format,
                $request->youtube_link,
                $request->city,
                $request->invite,
                Auth::user()->id,
                $request->localed = Lang::locale(),
                $request->tags_list
            ));
        if (!is_null($image)) {
            $this->bindImage($image, $event);
        }
        if (!is_null($request->speakers)) {
            $this->unBindSpeakers($event);
            $this->bindSpeakers($event, trim($request->speakers));
        }

        return $event;
    }

    /**
     * @param $event
     * @param $speakers
     */
    public function bindSpeakers($event, $speakers)
    {
        $speakers = explode(',', $speakers);
        foreach ($speakers as $speaker) {
            EventSpeakers::create(['events_id' => $event->id,
                    'user_slug' => $speaker
                ]);
            }
    }

    /**
     * @param $event
     */
    public function unBindSpeakers($event)
    {
        EventSpeakers::where('events_id', $event->id)->delete();
    }

    /**
     * @param $event
     * @param $speakers
     */
    public function updateSpeakers($event, $speakers)
    {
        $speakers = explode(',', $speakers);

        foreach ($speakers as $speaker) {
            if (!empty($speaker)) {
                EventSpeakers::where('events_id', $event->id)->update(['user_slug' => $speaker]);
            }
        }
    }


    public function getSpeakers($eventID)
    {
        $speakersData = EventSpeakers::where('events_id', $eventID)->select('user_slug')->get('user_slug');
        $speakers = [];

        foreach($speakersData as $key => $speaker) {
            $speakers[$key] = User::findBySlugOrFail($speaker->user_slug);
        }

        return view('includes.speakers', compact('speakers'));
    }

    /**
     * @param $event
     * @param $subscriberID
     */
    public function bindSubscriber($event, $subscriberID)
    {
        $event->eventSubscribers()->attach($subscriberID);

    }

    /**
     * @param $event
     * @param $subscriberID
     */
    public function unBindSubscriber($event, $subscriberID)
    {
        $event->eventSubscribers()->detach($subscriberID);

    }

    /**
     * return the number of user's events
     *
     * @return mixed
     */
    public function countUserEvents()
    {

        return $this->getModel()->where('user_id', '=', Auth::id())->count();

    }

    /**
     * return the number of today's events
     *
     * @return mixed
     */
    public function todayEvents()
    {

        return $this->getModel()->groupBy('created_at')->latest('created_at')->today()->count();

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
            if ($instance->banned === false) {
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
