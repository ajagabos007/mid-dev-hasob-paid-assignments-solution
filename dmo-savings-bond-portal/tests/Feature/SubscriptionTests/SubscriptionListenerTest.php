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
    use WithFaker;
    use WithSubscription;

    
    /**
     * A feature test Subscription fire created event can be raised
     *
     * @return void
     */

    public function test_subscription_created_listener_can_be_fired():void 
    {
        $this->subscription = Subscription::create(Subscription::factory()->make()->toArray());

        Event::fake();

        SubscriptionCreated::dispatch($this->subscription);
        Event::assertDispatched(SubscriptionCreated::class);
        
        Event::assertListening(
            SubscriptionCreated::class,
            SubscriptionCreatedListener::class
        );
    }

    /**
     * A feature test Subscription fire updated event can be raised
     *
     * @return void
     */

     public function test_subscription_updated_listener_can_be_fired():void 
     {
         
         /** 
         * Authenticate the user
         * 
         * @func App\Traits\Testing\WithUser $this->authUser() 
         */
        $this->authUser();
        $new_status =$this->faker()->word();
        $this->subscription->status = $new_status; 
        $this->assertTrue($this->subscription->isDirty());

        $response = $this->withHeaders([
            'accept' => '/application/json',
        ])->put(route('sb-api.subscriptions.update', $this->subscription->id), $this->subscription->toArray());
       
        $response->assertValid(); 
        $response->assertStatus(200);

         Event::fake();
 
         SubscriptionUpdated::dispatch($this->subscription);
         Event::assertDispatched(SubscriptionUpdated::class);
         
         Event::assertListening(
             SubscriptionUpdated::class,
             SubscriptionUpdatedListener::class
         );
     }

     public function test_subscription_delete_listener_can_be_fired():void 
     {
        /** 
         * Authenticate the user
         * 
         * @func App\Traits\Testing\WithUser $this->authUser() 
         */
        $this->authUser();

        /**
         * reinitialise subscription
         * 
         * @func App\Traits\Testing\WithSubscription subscription()
        */   
        $subscription = $this->subscription();
        $response = $this->withHeaders([
            'accept' => '/application/json',
        ])->put(route('sb-api.subscriptions.destroy',  $subscription->id), $subscription->toArray());
        $response->assertValid();
        $response->assertStatus(200);

         Event::fake();
 
         SubscriptionDeleted::dispatch($this->subscription);
         Event::assertDispatched(SubscriptionDeleted::class);
         
         Event::assertListening(
             SubscriptionDeleted::class,
             SubscriptionDeletedListener::class
         );
     }

     /**
     * Setup the investor event test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpSubscription();         
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     *
     * @throws \Mockery\Exception\InvalidCountException
    */
    protected function tearDown(): void
    {
        $this->refreshSubscription();         
        parent::tearDown();
    }
}
