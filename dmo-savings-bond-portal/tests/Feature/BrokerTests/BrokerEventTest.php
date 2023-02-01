<?php

namespace Tests\Feature\BrokerTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

use DMO\SavingsBond\Models\Broker;
use DMO\SavingsBond\Events\BrokerCreated;
use DMO\SavingsBond\Listerner\BrokerCreatedListerner;
use DMO\SavingsBond\Traits\Testing\WithBroker;

class BrokerEventTest extends TestCase
{
    use WithFaker;
    use WithBroker;

    /**
     * A basic feature test created event can be raised.
     *
     * @return void
     */
    public function test_broker_created_event_can_be_raised()
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
        ])->post(route('sb-api.brokers.store'), Broker::factory()->make()->toArray());
        $response->assertValid();
        $response->assertStatus(200);

        Event::fake();
        BrokerCreated::dispatch($this->broker);
        Event::assertDispatched(BrokerCreated::class);
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
