<?php

namespace CodeZero\Mailer;

use Illuminate\Support\ServiceProvider;

class MailerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'CodeZero\Mailer\Mailer',
            'CodeZero\Mailer\LaravelMailer'
        );
    }
}
