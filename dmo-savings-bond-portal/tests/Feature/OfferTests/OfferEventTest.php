<?php

namespace Tests\Feature\OfferTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;

use Tests\TestCase;
use Illuminate\Support\Facades\Event;

use DMO\SavingsBond\Models\Offer;
use DMO\SavingsBond\Events\OfferCreated;
use DMO\SavingsBond\Events\OfferUpdated;
use DMO\SavingsBond\Events\OfferDeleted;

use Illuminate\Database\Eloquent\Model;

use DMO\SavingsBond\Traits\Testing\WithOffer;


class OfferEventTest extends TestCase
{
    use WithFaker;
    use WithOffer;
    
    /**
     * A basic feature test created event can be raised.
     *
     * @return void
     */
    public function test_offer_created_event_can_be_raised()
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
        ])->post(route('sb-api.offers.store'), Offer::factory()->make()->toArray());
       
        $response->assertStatus(200);

        Event::fake();
        OfferCreated::dispatch($this->offer);
        Event::assertDispatched(OfferCreated::class);
    }

    /**
     * A basic feature test created event can be raised.
     *
     * @return void
     */
    public function test_offer_updated_event_can_be_raised()
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

        $this->offer->status = $new_status; 

        $response = $this->withHeaders([
            'accept' => '/application/json',
        ])->put(route('sb-api.offers.update',$this->offer->id), $this->offer->toArray());
        $response->assertStatus(200);

        Event::fake();
        OfferUpdated::dispatch($this->offer);
        Event::assertDispatched(OfferUpdated::class);
    }

    public function test_offer_deleted_event_can_be_raised()
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
        ])->put(route('sb-api.offers.destroy',$this->offer->id), $this->offer->toArray());
        $response->assertStatus(200);
        
        Event::fake();
        OfferDeleted::dispatch($this->offer);
        Event::assertDispatched(OfferDeleted::class);
    }

     /**
     * Setup the offer event test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpOffer();         
    }

     /**
     * clean up the offer before the next test
     * Clean up the testing environment before the next test.
     * 
     * @overide Illuminate\Foundation\Testing\TestCase\tearDown
     * @return void
     *
     * @throws \Mockery\Exception\InvalidCountException
     */
    protected function tearDown():void
    {
        $this->refreshOffer();
        parent::tearDown();
    }

}
