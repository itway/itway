<?php

namespace itway\Http\Controllers;

use App;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Itway\components\Country\CountryBuilder;
use Itway\components\Tags\TagsBuilder;
use Itway\components\Timezone\TimezoneBuilder;
use itway\Http\Requests;
use Itway\Models\Event;
use Itway\Repositories\EventRepository;
use Itway\Validation\Event\EventRequest;
use Itway\Validation\Event\UpdateEventRequest;
use nilsenj\Toastr\Facades\Toastr;

class EventsController extends Controller
{
    private $repository;
    private $timezone;
    private $country;
    private $tags;

    /**
     * EventsController constructor.
     * @param EventRepository $repository
     * @param TimezoneBuilder $timezone
     * @param CountryBuilder $country
     * @param TagsBuilder $tags
     */
    public function __construct(EventRepository $repository, TimezoneBuilder $timezone, CountryBuilder $country, TagsBuilder $tags)
    {
        $this->middleware('auth', ['only' => ['create', 'edit', 'update', 'store']]);
        $this->repository = $repository;
        $this->timezone = $timezone;
        $this->country = $country;
        $this->tags = $tags;
    }

    /**
     * Redirect not found.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectNotFound()
    {
        return redirect()->to(route("itway::events::index"))->with(Toastr::error('Event Not Found!', $title = 'event might be deleted or banned', $options = []));
    }

    /**
     * redirect error
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectError($message = null)
    {
        if (!is_null($message)) {
            return redirect()->to(route("itway::events::index"))->with(Toastr::error($message, $title = "Error", $options = []));
        } else return redirect()->to(route("itway::events::index"))->with(Toastr::error("Error appeared!", $title = Auth::user()->name, $options = []));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('RepositoryLab\Repository\Criteria\RequestCriteria'));

        $events = $this->repository->getAll();

        $countUserEvents = $this->repository->countUserEvents();

        $tags = $this->repository->getModel()->existingTags();

        return view('events.events', compact('events', 'countUserEvents', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $timezoneBuilder = $this->timezone->buildSelect();
        $countryBuilder = $this->country->buildCountrySelect();
        $tagsBuilder = $this->tags->tagsTechMultipleSelect(trans('event-form.select-tags'));
        $countUserEvents = $this->repository->countUserEvents();
        $tags = $this->repository->getModel()->existingTags();


        return view('events.create', compact('countUserEvents', 'tags', 'timezoneBuilder', 'countryBuilder', 'tagsBuilder'));

    }

    /**
     * @param EventRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(EventRequest $request)
    {
        try {

            $image = \Input::hasFile('image') ? \Input::file('image') : null;

            $event = $this->repository->createEvent($request, $image);

            Toastr::success(trans('messages.yourEventCreated'), $title = $event->name, $options = []);

            return redirect()->to(App::getLocale() . '/events/event/' . $event->id);
        } catch (\Exception $e) {

            $this->redirectError('Error Appeared in the process of creation...');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPageBody($id)
    {
        $body = $this->repository->getModel()->findOrFail($id)->description()->first();

        return response()->json(['description' => $body]);
    }


    /**
     * @param $slug
     * @param Event $eventdata
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($slug, Event $eventdata)

    {
        try {
            $event = $eventdata->findBySlugOrId($slug);

            $event->view();

            $eventUser = $event->user_id;

            $countUserEvents = $this->repository->countUserEvents();

            $modelName = $this->repository->getModelName();
            $speakers = $this->repository->getSpeakers($event->id);

            if (!Auth::guest() && Auth::user()->id === $eventUser) {

                $createdByUser = true;

            } else {
                $createdByUser = false;

            }
            return view('events.single', compact('event', 'createdByUser', 'countUserEvents', 'modelName', 'speakers'));

        } catch (ModelNotFoundException $e) {

            return $this->redirectNotFound();

        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)

    {
        try {
            $event = $this->repository->getModel()->findBySlugOrId($id);
            $countUserEvents = $this->repository->countUserEvents();

            $tags = $event->tagNames();

            $description = $event->getDescription();

            flash()->info(trans('messages.createLang'));

            $tagsBuilder = $this->tags->tagsTechMultipleSelect("choose" . trans('event-form.tags'), $tags);

            return view('events.edit', compact('event', 'tags', 'description', 'countUserEvents', 'tagsBuilder'));

        } catch (ModelNotFoundException $e) {

            return $this->redirectNotFound();

        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEventRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateEventRequest $request, $id)
    {
        try {
            $event = $this->repository->getModel()->findBySlugOrId($id);
            $image = \Input::file('image');
            $this->repository->updateEvent($request, $image);
            $updatedEvent = $event->id;

            Toastr::success(trans('messages.yourEventUpdated'), $title = $event->name, $options = []);

            return redirect()->to(App::getLocale() . '/events/event/' . $updatedEvent);

        } catch (ModelNotFoundException $e) {
            return $this->redirectError();
        }
    }

    /**
     * just deleting events if the event belongs to user or the user is admin
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->repository->deleteAll($id);

        Toastr::success(Auth::user()->name, $title = 'Your Post deleted successfully! Have a nice day!', $options = []);

        return redirect()->to(App::getLocale() . '/events');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function personalEvents(Request $request)
    {
        try {

            $events = $this->repository->getAllUsers();

            $countUserEvents = $this->repository->countUserEvents();

            $tags = $this->repository->getModel()->existingTags();

            if ($countUserEvents === 0) {

                if ($request->ajax()) {
                    return response()->json(['error_message' => trans('messages.noPostsFound'), $title = trans('messages.noPostsFoundTitle')]);
                } else {
                    Toastr::warning(trans('messages.noPostsFound'), $title = trans('messages.noPostsFoundTitle'), $options = []);
                    return redirect()->back();
                }
            } else {
                if ($request->ajax()) {
                    return view('events.dynamic-events', compact('events', 'countUserEvents', 'tags'));
                } else {
                    return view('events.events', compact('events', 'countUserEvents', 'tags'));
                }
            }

        } catch (ModelNotFoundException $e) {

            return $this->redirectNotFound();
        }

    }

    /**
     * get the list of tags defined for teams
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tags($slug)
    {
        $events = Event::withAnyTag([$slug])->latest('created_at')->paginate(8);
        $tags = $this->repository->getModel()->existingTags();

        return view('events.events', compact('events', 'tags'));
    }

}
