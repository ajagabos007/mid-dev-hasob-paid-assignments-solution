<?php

namespace Tests\Feature\SubscriptionTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use DMO\SavingsBond\Models\Subscription;
use DMO\SavingsBond\Traits\Testing\WithSubscription;

class SubscriptionCRUDTest extends TestCase
{
    use WithFaker;
    use WithSubscription;

    /**
     * A feature test Subscription can be created
     *
     * @return void
     */

     public function test_subscription_can_be_created() : void{
        
        /**
         * subscription can be created via the model directly
         * @var App\Traits\Testing\WithSubscription $subscription 
         */
        // setup subscription if not set
        if(!$this->subscription)
            $this->setUpSubscription();
        $this->assertModelExists($this->subscription);
        $this->assertDatabaseHas('sb_subscriptions', $this->subscription->toArray());


      
        /**
         * Subscription can be created via api http request
         * 
         * Authenticate the user
         * @func App\Traits\Testing\WithUser $this->authUser() 
         */
        $this->authUser();
        $new_subscription_data = Subscription::factory()->make()->toArray();
       
        $response = $this->withHeaders([
            'accept' => '/application/json',
        ])->post(route('sb-api.subscriptions.store'), $new_subscription_data);

        $response->assertValid(); 
        $response->assertStatus(200);
    }

    /* A feature test Subscription can be created
      *
      * @return void
     */

     public function test_subscription_can_be_read() : void{
        /**
         * subscription can be created via the model directly
         * @var App\Traits\Testing\WithSubscription $this->subscription 
         */
        $this->subscription = Subscription::find($this->subscription->id);
        $this->assertModelExists($this->subscription);

         /**
         * Subscription can be read 
         * 
         * Authenticate the user
         * @func App\Traits\Testing\WithUser $this->authUser() 
         */
        $this->authUser();

        // via http request 
        $response = $this->get(route('sb.subscriptions.show', $this->subscription->id));
        $response->assertStatus(200);
        $response->assertViewIs('dmo-savings-bond-module::pages.subscriptions.show');

        // via api end point request
        $response = $this->withHeaders([
            'accept' => '/application/json',
        ])->get(route('sb-api.subscriptions.show', $this->subscription->id));
        $response->assertStatus(200);
    }

    /**
      * 
      * A feature test Subscription can be updated
      *
      * @return void
     */

     public function test_subscription_can_be_updated() : void{

        /**
         * subscription can be updated via the model directly
         * @var App\Traits\Testing\WithSubscription $this->subscription 
         */
        $new_status =$this->faker()->word();
        
        $this->subscription->status = $new_status; 
        $this->assertTrue($this->subscription->isDirty());

        $this->subscription->save();
        $this->assertTrue($this->subscription->wasChanged());


         /**
         * Subscription can be update via api end point request 
         * 
         * Authenticate the user
         * @func App\Traits\Testing\WithUser $this->authUser() 
         */
        $this->authUser();
        $new_status =$this->faker()->word();
        $this->subscription->status = $new_status; 

        $response = $this->withHeaders([
            'accept' => '/application/json',
        ])->put(route('sb-api.subscriptions.update', $this->subscription->id), $this->subscription->toArray());
       
        $response->assertValid(); 
        $response->assertStatus(200);

        $this->subscription->refresh();
        $this->assertTrue($this->subscription->wasChanged());
    }

    /**
      *  A feature test subscription can be delete
      * @return void
     */
    public function test_subscription_can_be_deleted() : void{
        /**
         * subscription can be delete via the model directly
         * @var App\Traits\Testing\WithSubscription $this->subscription 
         */
        $this->subscription->delete();
        $this->assertSoftDeleted($this->subscription);


         /**
         * Subscription can be delete via api end point request 
         * 
         * Authenticate the user
         * @func App\Traits\Testing\WithUser $this->authUser() 
         */
        $this->authUser();

        /**
         * reinitialise subscription
         * 
         * @func App\Traits\Testing\WithSubscription subscription()
        */   
        $subscription = $this->subscription();
        $response = $this->withHeaders([
            'accept' => '/application/json',
        ])->put(route('sb-api.subscriptions.destroy',  $subscription->id), $subscription->toArray());
        $response->assertValid();
        $response->assertStatus(200);
    }

    /**
     * A feature test Broker can be permanently deleted
     *
     * @return void
     */
    public function test_subscription_can_be_deleted_permanently():void
    {
        /**
         * subscription can be deleted permanently via the model directly
         * @property App\Traits\Testing\WithSubscription $subscription 
         */
       $this->subscription->forceDelete();
       $this->assertDeleted($this->subscription);
       $this->assertModelMissing($this->subscription);
    }

    /**
     * Setup the investor event test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpSubscription();         
    }

}
