<?php

namespace DMO\SavingsBond\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use Illuminate\Support\Facades\Event;

use DMO\SavingsBond\Events\BrokerCreated;
use DMO\SavingsBond\Events\BrokerUpdated;
use DMO\SavingsBond\Events\BrokerDeleted;

use DMO\SavingsBond\Listeners\BrokerCreatedListener;
use DMO\SavingsBond\Listeners\BrokerUpdatedListener;
use DMO\SavingsBond\Listeners\BrokerDeletedListener;

use DMO\SavingsBond\Events\OfferCreated;
use DMO\SavingsBond\Events\OfferUpdated;
use DMO\SavingsBond\Events\OfferDeleted;

use DMO\SavingsBond\Listeners\OfferCreatedListener;
use DMO\SavingsBond\Listeners\OfferUpdatedListener;
use DMO\SavingsBond\Listeners\OfferDeletedListener;

use DMO\SavingsBond\Events\InvestorCreated;
use DMO\SavingsBond\Events\InvestorUpdated;
use DMO\SavingsBond\Events\InvestorDeleted;

use DMO\SavingsBond\Listeners\InvestorCreatedListener;
use DMO\SavingsBond\Listeners\InvestorUpdatedListener;
use DMO\SavingsBond\Listeners\InvestorDeletedListener;

use DMO\SavingsBond\Events\SubscriptionCreated;
use DMO\SavingsBond\Events\SubscriptionUpdated;
use DMO\SavingsBond\Events\SubscriptionDeleted;

use DMO\SavingsBond\Listeners\SubscriptionCreatedListener;
use DMO\SavingsBond\Listeners\SubscriptionUpdatedListener;
use DMO\SavingsBond\Listeners\SubscriptionDeletedListener;

class SavingsBondEventServiceProvider extends ServiceProvider
{

    protected $listen = [
    
        BrokerCreated::class => [BrokerCreatedListener::class],
        BrokerUpdated::class => [BrokerUpdatedListener::class],
        BrokerDeleted::class => [BrokerDeletedListener::class],

        OfferCreated::class => [OfferCreatedListener::class],
        OfferUpdated::class => [OfferUpdatedListener::class],
        OfferDeleted::class => [OfferDeletedListener::class],

        InvestorCreated::class => [InvestorCreatedListener::class],
        InvestorUpdated::class => [InvestorUpdatedListener::class],
        InvestorDeleted::class => [InvestorDeletedListener::class],

        SubscriptionCreated::class => [SubscriptionCreatedListener::class],
        SubscriptionUpdated::class => [SubscriptionUpdatedListener::class],
        SubscriptionDeleted::class => [SubscriptionDeletedListener::class],

    ];

    public function boot()
    {
        parent::boot();
    }
}