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
use DMO\SavingsBond\Traits\Testing\WithInvestor;


class InvestorEventTest extends TestCase
{
    use WithFaker;
    use WithInvestor;
    
    /**
     * A feature investor test created event can be raised.
     *
     * @return void
     */
    public function test_investor_created_event_can_be_raised():void
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
        ])->post(route('sb-api.investors.store'), Investor::factory()->make()->toArray());
       
        $response->assertStatus(200);

        Event::fake();
        InvestorCreated::dispatch($this->investor);
        Event::assertDispatched(InvestorCreated::class);
    }

    /**
     * A feature investor test updated event can be raised.
     *
     * @return void
     */
    public function test_investor_updated_event_can_be_raised():void
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

        $this->investor->status = $new_status; 

        $response = $this->withHeaders([
            'accept' => '/application/json',
        ])->put(route('sb-api.investors.update',$this->investor->id), $this->investor->toArray());
        $response->assertStatus(200);

        Event::fake();
        InvestorUpdated::dispatch($this->investor);
        Event::assertDispatched(InvestorUpdated::class);
    }

     /**
     * A feature investor test deleted event can be raised.
     *
     * @return void
     */
    public function test_investor_deleted_event_can_be_raised():void
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
        ])->put(route('sb-api.investors.destroy',$this->investor->id), $this->investor->toArray());
        $response->assertStatus(200);
        
        Event::fake();
        InvestorDeleted::dispatch($this->investor);
        Event::assertDispatched(InvestorDeleted::class);
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
     * clean up the investor before the next test
     * Clean up the testing environment before the next test.
     * 
     * @overide Illuminate\Foundation\Testing\TestCase\tearDown
     * @return void
     *
     * @throws \Mockery\Exception\InvalidCountException
     */
    protected function tearDown():void
    {
        $this->refreshInvestor();
        parent::tearDown();
    }
}
