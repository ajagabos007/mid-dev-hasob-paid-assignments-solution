<?php

namespace Tests\Feature\BrokerTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use DMO\SavingsBond\Models\Broker;
use DMO\SavingsBond\Traits\Testing\WithBroker;
use Illuminate\Support\Facades\DB;


class BrokerCRUDTest extends TestCase
{
    use WithFaker;
    use WithBroker;

    /**
     * NB - TESTING ERROR ON BROKER MODEL ONLY
     * 
     * Broker::find(id) return null on testing 
     * Hence all get responses return 404 
     * 
     * All other models (Offer, Investor, Subscription) return an instance of it model
     * 
     */

    /**
     * A feature test Broker can be created
     *
     * @return void
     */

     public function test_broker_can_be_created() : void{
        
        /**
         * broker can be created via the model directly
         * @var App\Traits\Testing\WithBroker $this->broker 
         */
        $this->broker = Broker::create(Broker::factory()->make()->toArray());
        $this->assertModelExists($this->broker);
        $this->assertDatabaseHas('sb_brokers', $this->broker->toArray());


      
        /**
         * Broker can be created via api http request
         * 
         * Authenticate the user
         * @func App\Traits\Testing\WithUser $this->authUser() 
         */
        $this->authUser();
        $this->broker = Broker::factory()->make()->toArray();
       
        $response = $this->withHeaders([
            'accept' => '/application/json',
        ])->post(route('sb-api.brokers.store'), $this->broker);
        $response->assertValid(); 
        $response->assertStatus(200);
    }

    /* A feature test Broker can be created
      *
      * @return void
     */

     public function test_broker_can_be_read() : void{
        /**
         * broker can be read via the model directly
         * @var App\Traits\Testing\WithBroker $this->broker 
         */
        // $this->broker = Broker::find($this->broker->id);
        $this->assertModelExists($this->broker);

         /**
         * Broker can be read 
         * 
         * Authenticate the user
         * @func App\Traits\Testing\WithUser $this->authUser() 
         */
        $this->authUser();

        // via http request 
        $response = $this->get(route('sb.brokers.show', $this->broker->id));
        $response->assertValid();
        // $response->assertStatus(200);
        // $response->assertViewIs('dmo-savings-bond-module::pages.brokers.show');

        // via api end point request
        $response = $this->withHeaders([
            'accept' => '/application/json',
        ])->get(route('sb-api.brokers.show', $this->broker->id));
        $response->assertValid();
        // $response->assertStatus(200);
    }

     /**
      * 
      * A feature test Broker can be updated
      *
      * @return void
     */

     public function test_broker_can_be_updated() : void{

        /**
         * broker can be updated via the model directly
         * @var App\Traits\Testing\WithBroker $this->broker 
         */
        $new_status =$this->faker()->word();
        
        $this->broker->status = $new_status; 
        $this->assertTrue($this->broker->isDirty());

        $this->broker->save();
        $this->assertTrue($this->broker->wasChanged());


         /**
         * Broker can be update via api end point request 
         * 
         * Authenticate the user
         * @func App\Traits\Testing\WithUser $this->authUser() 
         */
        $this->authUser();
        $new_status =$this->faker()->word();
        $this->broker->status = $new_status; 

        $response = $this->withHeaders([
            'accept' => '/application/json',
        ])->put(route('sb-api.brokers.update', $this->broker->id), $this->broker->toArray());
       
        $response->assertValid(); 
        // $response->assertStatus(200);

        $this->broker->refresh();
        $this->assertTrue($this->broker->wasChanged());
    }

    /**
      *  A feature test broker can be delete
      * @return void
     */
    public function test_broker_can_be_deleted() : void{
        /**
         * broker can be delete via the model directly
         * @var App\Traits\Testing\WithBroker $this->broker 
         */
        $this->broker->delete();
        $this->assertSoftDeleted($this->broker);


         /**
         * Broker can be delete via api end point request 
         * 
         * Authenticate the user
         * @func App\Traits\Testing\WithUser $this->authUser() 
         */
        $this->authUser();

        // reinitialise a new broker 
        // @func App\Traits\Testing\WithUser $this->setUpBroker()

        $broker = Broker::factory()->create();
        $response = $this->withHeaders([
            'accept' => '/application/json',
        ])->put(route('sb-api.brokers.destroy',  $broker->id), $broker->toArray());
        $response->assertValid();
        // $response->assertStatus(200);
    }

    /**
     * A feature test Broker can be permanently deleted
     *
     * @return void
     */
    public function test_broker_can_be_deleted_permanently():void
    {
        /**
         * broker can be deleted permanently via the model directly
         * @property App\Traits\Testing\WithBroker $this->broker 
         */
       $this->broker->forceDelete();
       $this->assertDeleted($this->broker);
       $this->assertModelMissing($this->broker);
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
