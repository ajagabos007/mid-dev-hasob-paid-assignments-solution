<?php

namespace Tests\Feature\BrokerTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

use DMO\SavingsBond\Models\Broker;
use DMO\SavingsBond\Events\BrokerCreated;
use DMO\SavingsBond\Events\BrokerUpdated;
use DMO\SavingsBond\Events\BrokerDeleted;

use DMO\SavingsBond\Listeners\BrokerCreatedListener;
use DMO\SavingsBond\Listeners\BrokerUpdatedListener;
use DMO\SavingsBond\Listeners\BrokerDeletedListener;
use DMO\SavingsBond\Traits\Testing\WithBroker;


class BrokerListenerTest extends TestCase
{
    use withFaker;
    use WithBroker;


    /**
     * A feature test Broker fire created event can be raised
     *
     * @return void
     */
    public function test_broker_created_listener_can_be_fired():void 
    {
        $this->broker = Broker::create(Broker::factory()->make()->toArray());

        Event::fake();

        BrokerCreated::dispatch($this->broker);
        Event::assertDispatched(BrokerCreated::class);
        
        Event::assertListening(
            BrokerCreated::class,
            BrokerCreatedListener::class
        );
    }

     /**
     * A feature test Broker fire updated event can be raised
     *
     * @return void
     */

     public function test_broker_updated_listener_can_be_fired():void 
     {
         
         /** 
         * Authenticate the user
         * 
         * @func App\Traits\Testing\WithUser $this->authUser() 
         */
        $this->authUser();
        $new_status =$this->faker()->word();
        $this->broker->status = $new_status; 
        $this->assertTrue($this->broker->isDirty());

        $response = $this->withHeaders([
            'accept' => '/application/json',
        ])->put(route('sb-api.brokers.update', $this->broker->id), $this->broker->toArray());
       
        $response->assertValid(); 
        // $response->assertStatus(200);

         Event::fake();
 
         BrokerUpdated::dispatch($this->broker);
         Event::assertDispatched(BrokerUpdated::class);
         
         Event::assertListening(
             BrokerUpdated::class,
             BrokerUpdatedListener::class
         );
     }

     public function test_broker_delete_listener_can_be_fired():void 
     {
        /** 
         * Authenticate the user
         * 
         * @func App\Traits\Testing\WithUser $this->authUser() 
         */
        $this->authUser();

        /**
         * reinitialise broker
         * 
         * @func App\Traits\Testing\WithBroker broker()
        */   
        $broker = $this->broker();
        $response = $this->withHeaders([
            'accept' => '/application/json',
        ])->put(route('sb-api.brokers.destroy',  $broker->id), $broker->toArray());
        $response->assertValid();
        // $response->assertStatus(200);

         Event::fake();
 
         BrokerDeleted::dispatch($this->broker);
         Event::assertDispatched(BrokerDeleted::class);
         
         Event::assertListening(
             BrokerDeleted::class,
             BrokerDeletedListener::class
         );
     }

    /**
     * Setup the broker event test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpBroker();         
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
        $this->refreshBroker();         
        parent::tearDown();
    }
}
