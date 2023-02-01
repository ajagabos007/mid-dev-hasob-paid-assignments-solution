<?php

namespace Tests\Feature\OfferTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use DMO\SavingsBond\Models\Offer;
use DMO\SavingsBond\Traits\Testing\WithOffer;


class OfferCRUDTest extends TestCase
{
    use WithFaker;
    use WithOffer;

    /**
     * A feature test Offer can be created
     *
     * @return void
     */

     public function test_offer_can_be_created() : void{
        
        /**
         * offer can be created via the model directly
         * @var App\Traits\Testing\WithOffer $this->offer 
         */
        $this->offer = Offer::create(Offer::factory()->make()->toArray());
        $this->assertModelExists($this->offer);
        $this->assertDatabaseHas('sb_offers', $this->offer->toArray());


      
        /**
         * Offer can be created via api http request
         * 
         * Authenticate the user
         * @func App\Traits\Testing\WithUser $this->authUser() 
         */
        $this->authUser();
        $this->offer = Offer::factory()->make()->toArray();
       
        $response = $this->withHeaders([
            'accept' => '/application/json',
        ])->post(route('sb-api.offers.store'), $this->offer);

        $response->assertStatus(200);
        $this->assertDatabaseHas('sb_offers', $this->offer);
    }

     /* A feature test Offer can be created
      *
      * @return void
     */

     public function test_offer_can_be_read() : void{
        /**
         * offer can be created via the model directly
         * @var App\Traits\Testing\WithOffer $this->offer 
         */
        $this->offer = Offer::find($this->offer->id);
        $this->assertModelExists($this->offer);

         /**
         * Offer can be read 
         * 
         * Authenticate the user
         * @func App\Traits\Testing\WithUser $this->authUser() 
         */
        $this->authUser();

        // via http request 
        $response = $this->get(route('sb.offers.show', $this->offer->id));
        $response->assertStatus(200);
        $response->assertViewIs('dmo-savings-bond-module::pages.offers.show');


        // via api end point request
        $response = $this->withHeaders([
            'accept' => '/application/json',
        ])->get(route('sb-api.offers.show', $this->offer->id));
        
        $response->assertStatus(200);
    }


     /* A feature test Offer can be updated
     *
     * @return void
     */

     public function test_offer_can_be_updated() : void{

        /**
         * offer can be updated via the model directly
         * @var App\Traits\Testing\WithOffer $this->offer 
         */
        $new_status =$this->faker()->word();
        $this->offer->status = $new_status; 

        $this->offer->save();
        $this->offer->refresh();
        $this->assertTrue($this->offer->wasChanged());


         /**
         * Offer can be update via api end point request 
         * 
         * Authenticate the user
         * @func App\Traits\Testing\WithUser $this->authUser() 
         */
        $this->authUser();
        $new_status =$this->faker()->word();
        $this->offer->status = $new_status; 

        $response = $this->withHeaders([
            'accept' => '/application/json',
        ])->put(route('sb-api.offers.update', $this->offer->id), $this->offer->toArray());
       
        $response->assertValid(); 
        $response->assertStatus(200);

        $this->offer->refresh();
        $this->assertTrue($this->offer->wasChanged());
    }

     /**
      *  A feature test offer can be delete
      * @return void
     */
     public function test_offer_can_be_deleted() : void{
        /**
         * offer can be delete via the model directly
         * @var App\Traits\Testing\WithOffer $this->offer 
         */
        $this->offer->delete();
        $this->assertSoftDeleted($this->offer);


         /**
         * Offer can be delete via api end point request 
         * 
         * Authenticate the user
         * @func App\Traits\Testing\WithUser $this->authUser() 
         */
        $this->authUser();

        // reinitialise a new offer 
        // @func App\Traits\Testing\WithUser $this->setUpOffer()

        $offer = Offer::factory()->create();
        $response = $this->withHeaders([
            'accept' => '/application/json',
        ])->put(route('sb-api.offers.destroy',  $offer->id), $offer->toArray());
        $response->assertValid();
        $response->assertStatus(200);
    }

    /**
     * A feature test Offer can be permanently deleted
     *
     * @return void
     */
     public function test_offer_can_be_permanently_deleted():void
     {
        $this->offer->forceDelete();
        $this->assertDeleted($this->offer);
        $this->assertModelMissing($this->offer);
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
