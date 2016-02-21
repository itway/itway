<?php namespace itway\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use itway\Events\UserWasCreatedEvent;
use itway\Events\PostWasCreatedEvent;
use itway\Listeners\PostWasCreatedListener;
use itway\Listeners\UserRegisteredListener;
use itway\Events\PollWasCreated;
use itway\Listeners\PollWasCreatedListener;
use itway\Events\TeamWasCreatedEvent;
use itway\Listeners\TeamWasCreatedListener;
use itway\Events\EventWasCreatedEvent;
use itway\Listeners\EventWasCreatedListener;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		'event.name' => [
			'EventListener',
		],
		UserWasCreatedEvent::class => [
			UserRegisteredListener::class
		],
		PostWasCreatedEvent::class => [
			PostWasCreatedListener::class
		],
		PollWasCreated::class => [
			PollWasCreatedListener::class
		],
		TeamWasCreatedEvent::class => [
			TeamWasCreatedListener::class
		],
		EventWasCreatedEvent::class => [
			EventWasCreatedListener::class
		],

	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);

		//
	}

}
