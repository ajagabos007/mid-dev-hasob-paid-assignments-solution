<?php

namespace Tests\Feature\SubscriptionTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Event;

use DMO\SavingsBond\Models\Subscription;
use DMO\SavingsBond\Events\SubscriptionCreated;
use DMO\SavingsBond\Events\SubscriptionUpdated;
use DMO\SavingsBond\Events\SubscriptionDeleted;

use DMO\SavingsBond\Listeners\SubscriptionCreatedListener;
use DMO\SavingsBond\Listeners\SubscriptionUpdatedListener;
use DMO\SavingsBond\Listeners\SubscriptionDeletedListener;

use DMO\SavingsBond\Traits\Testing\WithSubscription;

class SubscriptionListenerTest extends TestCase
{
    use WithSubscription;

    /**
     * A basic test example subscription listener.
     *
     * @return void
     */
    public function test_example_subscription_listener()
    {
        $this->assertTrue(true);
    }

    /**
     * A feature test Subscription fire created event can be raised
     *
     * @return void
     */

    // public function test_subscription_created_listener_can_be_fired():void 
    // {
    //     $this->subscription = Subscription::create(Subscription::factory()->make()->toArray());

    //     Event::fake();

    //     SubscriptionCreated::dispatch($this->subscription);
    //     Event::assertDispatched(SubscriptionCreated::class);
        
    //     Event::assertListening(
    //         SubscriptionCreated::class,
    //         SubscriptionCreatedListener::class
    //     );
    // }
}
