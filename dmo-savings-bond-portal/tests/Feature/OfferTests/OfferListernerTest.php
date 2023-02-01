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
}
