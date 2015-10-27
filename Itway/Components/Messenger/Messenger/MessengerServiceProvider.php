<?php namespace Itway\Components\Messenger;

use Illuminate\Support\ServiceProvider;

class MessengerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            base_path('Itway/Components/Messenger/config/config.php') => config_path('messenger.php'),
            base_path('Itway/Components/Messenger/migrations') => base_path('database/migrations'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            base_path('Itway/Components/Messenger/config/config.php'), 'messenger'
        );
    }
}
