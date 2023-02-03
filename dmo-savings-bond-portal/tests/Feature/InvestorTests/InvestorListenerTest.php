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
    use WithFaker;
    use WithInvestor;

    /**
     * A feature test Investor fire created event can be raised
     *
     * @return void
     */
    public function test_investor_created_listener_can_be_fired():void 
    {
        $this->investor = Investor::create(Investor::factory()->make()->toArray());
        Event::fake();

        InvestorCreated::dispatch($this->investor);
        Event::assertDispatched(InvestorCreated::class);
        
        Event::assertListening(
            InvestorCreated::class,
            InvestorCreatedListener::class
        );
    }

    /**
     * A feature test Investor fire update event can be raised
     *
     * @return void
     */

     public function test_investor_updated_listener_can_be_fired():void 
     {
         
         /** 
         * Authenticate the user
         * 
         * @func App\Traits\Testing\WithUser $this->authUser() 
         */
        $this->authUser();
        $new_status =$this->faker()->word();
        $this->investor->status = $new_status; 
        $this->assertTrue($this->investor->isDirty());

        $response = $this->withHeaders([
            'accept' => '/application/json',
        ])->put(route('sb-api.investors.update', $this->investor->id), $this->investor->toArray());
       
        $response->assertValid(); 
        $response->assertStatus(200);

         Event::fake();
 
         InvestorUpdated::dispatch($this->investor);
         Event::assertDispatched(InvestorUpdated::class);
         
         Event::assertListening(
             InvestorUpdated::class,
             InvestorUpdatedListener::class
         );
     }

     public function test_investor_delete_listener_can_be_fired():void 
     {
        /** 
         * Authenticate the user
         * 
         * @func App\Traits\Testing\WithUser $this->authUser() 
         */
        $this->authUser();

        /**
         * reinitialise investor
         * 
         * @func App\Traits\Testing\WithInvestor investor()
        */   
        $investor = $this->investor();
        $response = $this->withHeaders([
            'accept' => '/application/json',
        ])->put(route('sb-api.investors.destroy',  $investor->id), $investor->toArray());
        $response->assertValid();
        $response->assertStatus(200);

         Event::fake();
 
         InvestorDeleted::dispatch($this->investor);
         Event::assertDispatched(InvestorDeleted::class);
         
         Event::assertListening(
             InvestorDeleted::class,
             InvestorDeletedListener::class
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
        $this->setUpInvestor();         
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
        $this->refreshInvestor();         
        parent::tearDown();
    }
}
