<?php namespace itway\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use itway\Events\UserWasCreatedEvent;
use itway\Events\PostWasCreatedEvent;
use itway\Listeners\PostWasCreatedListener;
use itway\Listeners\UserRegisteredListener;
use itway\Events\QuizWasCreated;
use itway\Listeners\QuizWasCreatedListener;

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
		]
		,
		PostWasCreatedEvent::class => [
			PostWasCreatedListener::class
		],
		QuizWasCreated::class => [
			QuizWasCreatedListener::class
		]

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
