<?php

namespace Tests\Feature\OfferTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

use DMO\SavingsBond\Models\Offer;

use DMO\SavingsBond\Events\OfferCreated;
use DMO\SavingsBond\Events\OfferUpdated;
use DMO\SavingsBond\Events\OfferDeleted;

use DMO\SavingsBond\Listeners\OfferCreatedListener;
use DMO\SavingsBond\Listeners\OfferUpdatedListener;
use DMO\SavingsBond\Listeners\OfferDeletedListener;

use DMO\SavingsBond\Traits\Testing\WithOffer;

class OfferListernerTest extends TestCase
{
    use WithFaker;
    use WithOffer;

    /**
     * A feature test Offer fire created event can be raised
     *
     * @return void
     */
    public function test_offer_created_listener_can_be_fired():void 
    {
        $this->offer = Offer::create(Offer::factory()->make()->toArray());

        Event::fake();

        OfferCreated::dispatch($this->offer);
        Event::assertDispatched(OfferCreated::class);
        
        Event::assertListening(
            OfferCreated::class,
            OfferCreatedListener::class
        );
    }

    /**
     * A feature test Offer fire update event can be raised
     *
     * @return void
     */

     public function test_offer_updated_listener_can_be_fired():void 
     {
         
         /** 
         * Authenticate the user
         * 
         * @func App\Traits\Testing\WithUser $this->authUser() 
         */
        $this->authUser();
        $new_status =$this->faker()->word();
        $this->offer->status = $new_status; 
        $this->assertTrue($this->offer->isDirty());

        $response = $this->withHeaders([
            'accept' => '/application/json',
        ])->put(route('sb-api.offers.update', $this->offer->id), $this->offer->toArray());
       
        $response->assertValid(); 
        $response->assertStatus(200);

         Event::fake();
 
         OfferUpdated::dispatch($this->offer);
         Event::assertDispatched(OfferUpdated::class);
         
         Event::assertListening(
             OfferUpdated::class,
             OfferUpdatedListener::class
         );
     }

     public function test_offer_delete_listener_can_be_fired():void 
     {
        /** 
         * Authenticate the user
         * 
         * @func App\Traits\Testing\WithUser $this->authUser() 
         */
        $this->authUser();

        /**
         * reinitialise offer
         * 
         * @func App\Traits\Testing\WithOffer offer()
        */   
        $offer = $this->offer();
        $response = $this->withHeaders([
            'accept' => '/application/json',
        ])->put(route('sb-api.offers.destroy',  $offer->id), $offer->toArray());
        $response->assertValid();
        $response->assertStatus(200);

         Event::fake();
 
         OfferDeleted::dispatch($this->offer);
         Event::assertDispatched(OfferDeleted::class);
         
         Event::assertListening(
             OfferDeleted::class,
             OfferDeletedListener::class
         );
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
     * Clean up the testing environment before the next test.
     *
     * @return void
     *
     * @throws \Mockery\Exception\InvalidCountException
     */
    protected function tearDown(): void
    {
        $this->refreshOffer();         
        parent::tearDown();
    }
}
