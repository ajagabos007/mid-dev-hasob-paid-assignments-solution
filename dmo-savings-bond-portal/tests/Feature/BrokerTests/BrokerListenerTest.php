<?php

namespace Tests\Feature\BrokerTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

use DMO\SavingsBond\Models\Broker;
use DMO\SavingsBond\Events\BrokerCreated;
use DMO\SavingsBond\Listener\BrokerCreatedListener;
use DMO\SavingsBond\Traits\Testing\WithBroker;


class BrokerListenerTest extends TestCase
{
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
            BrokerListener::class
        );
    }
}
