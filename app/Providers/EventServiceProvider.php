<?php

namespace App\Providers;

use Illuminate\Auth\Events\Login;
use App\Listeners\LoginSuccessful;
use Illuminate\Auth\Events\Logout;
use App\Listeners\LogoutSuccessful;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Login::class => [LoginSuccessful::class],
        Logout::class => [LogoutSuccessful::class],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
