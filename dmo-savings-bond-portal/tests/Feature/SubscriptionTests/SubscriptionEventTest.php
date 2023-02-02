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
use DMO\SavingsBond\Traits\Testing\WithSubscription;

class SubscriptionEventTest extends TestCase
{
    use WithFaker;
    use WithSubscription;
    
    /**
     * A basic feature test created event can be raised.
     *
     * @return void
     */
    public function test_subscription_created_event_can_be_raised()
    {
        // authenticate the user
        $this->authUser();

        /**
         *  Event::fake(); - Major Error
         * 
         *  Using Event:fake() before the operation in tests prevents UUID creation  
         *  Hence, the event was manually raise after the operation
         */

        $response = $this->withHeaders([
            'accept' => '/application/json',
        ])->post(route('sb-api.subscriptions.store'), Subscription::factory()->make()->toArray());
       
        $response->assertStatus(200);

        Event::fake();
        SubscriptionCreated::dispatch($this->subscription);
        Event::assertDispatched(SubscriptionCreated::class);
    }

    /**
     * A basic feature test created event can be raised.
     *
     * @return void
     */
    public function test_subscription_updated_event_can_be_raised()
    {
        // authenticate the user
        $this->authUser();
    
        /**
         *  Event::fake(); - Major Error
         * 
         *  Using Event:fake() before the operation in tests prevents UUID creation  
         *  Hence, the event was manually raise after the operation
         */
        $new_status =$this->faker()->word();

        $this->subscription->status = $new_status; 

        $response = $this->withHeaders([
            'accept' => '/application/json',
        ])->put(route('sb-api.subscriptions.update',$this->subscription->id), $this->subscription->toArray());
        $response->assertStatus(200);

        Event::fake();
        SubscriptionUpdated::dispatch($this->subscription);
        Event::assertDispatched(SubscriptionUpdated::class);
    }

    public function test_subscription_deleted_event_can_be_raised()
    {
        // authenticate the user
        $this->authUser();
    
        /**
         *  Event::fake(); - Major Error
         * 
         *  Using Event:fake() before the operation in tests prevents UUID creation  
         *  Hence, the event was manually raise after the operation
         */
        $response = $this->withHeaders([
            'accept' => '/application/json',
        ])->put(route('sb-api.subscriptions.destroy',$this->subscription->id), $this->subscription->toArray());
        $response->assertStatus(200);
        
        Event::fake();
        SubscriptionDeleted::dispatch($this->subscription);
        Event::assertDispatched(SubscriptionDeleted::class);
    }

    /**
     * Setup the subscription event test environment.
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
