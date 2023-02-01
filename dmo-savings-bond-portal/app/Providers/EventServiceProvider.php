<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;


use Hasob\FoundationCore\Events\BrokerCreated;
use Hasob\FoundationCore\Listerners\BrokerCreatedListerner;


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
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(
            BrokerCreated::class,
            [BrokerCreatedListener::class, 'handle']
        );
    }
    public function shouldDiscoverEvents()
    {
        return true;
    }
}
