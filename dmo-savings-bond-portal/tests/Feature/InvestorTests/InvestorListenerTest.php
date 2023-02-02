<?php

namespace Tests\Feature\InvestorTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Event;


use DMO\SavingsBond\Models\Investor;
use DMO\SavingsBond\Events\InvestorCreated;
use DMO\SavingsBond\Events\InvestorUpdated;
use DMO\SavingsBond\Events\InvestorDeleted;

use DMO\SavingsBond\Listeners\InvestorCreatedListener;
use DMO\SavingsBond\Listeners\InvestorUpdatedListener;
use DMO\SavingsBond\Listeners\InvestorDeletedListener;

use DMO\SavingsBond\Traits\Testing\WithInvestor;

class InvestorListenerTest extends TestCase
{
    use WithInvestor;

    /**
     * A basic test example investor listener.
     *
     * @return void
     */
    public function test_example_investor_listener()
    {
        $this->assertTrue(true);
    }

    /**
     * A feature test Investor fire created event can be raised
     *
     * @return void
     */
    // public function test_investor_created_listener_can_be_fired():void 
    // {
    //     $this->investor = Investor::create(Investor::factory()->make()->toArray());
    //     Event::fake();

    //     InvestorCreated::dispatch($this->investor);
    //     Event::assertDispatched(InvestorCreated::class);
        
    //     Event::assertListening(
    //         InvestorCreated::class,
    //         InvestorCreatedListener::class
    //     );
    // }
}
