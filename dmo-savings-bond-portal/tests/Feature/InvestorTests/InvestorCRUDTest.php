<?php

namespace Tests\Feature\InvestorTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use DMO\SavingsBond\Models\Investor;
use DMO\SavingsBond\Traits\Testing\WithInvestor;

class InvestorCRUDTest extends TestCase
{
    use WithFaker;
    use WithInvestor;

    /**
     * A feature test Investor can be created
     *
     * @return void
     */

     public function test_investor_can_be_created() : void{
        
        /**
         * investor can be created via the model directly
         * @var App\Traits\Testing\WithInvestor $this->investor 
         */
        $this->investor = Investor::create(Investor::factory()->make()->toArray());
        $this->assertModelExists($this->investor);
        $this->assertDatabaseHas('sb_investors', $this->investor->toArray());


      
        /**
         * Investor can be created via api http request
         * 
         * Authenticate the user
         * @func App\Traits\Testing\WithUser $this->authUser() 
         */
        $this->authUser();
        $this->investor = Investor::factory()->make()->toArray();
       
        $response = $this->withHeaders([
            'accept' => '/application/json',
        ])->post(route('sb-api.investors.store'), $this->investor);

        $response->assertValid(); 
        $response->assertStatus(200);
    }

    /* A feature test Investor can be created
      *
      * @return void
     */

     public function test_investor_can_be_read() : void{
        /**
         * investor can be created via the model directly
         * @var App\Traits\Testing\WithInvestor $this->investor 
         */
        $this->investor = Investor::find($this->investor->id);
        $this->assertModelExists($this->investor);

         /**
         * Investor can be read 
         * 
         * Authenticate the user
         * @func App\Traits\Testing\WithUser $this->authUser() 
         */
        $this->authUser();

        // via http request 
        $response = $this->get(route('sb.investors.show', $this->investor->id));
        $response->assertStatus(200);
        $response->assertViewIs('dmo-savings-bond-module::pages.investors.show');

        // via api end point request
        $response = $this->withHeaders([
            'accept' => '/application/json',
        ])->get(route('sb-api.investors.show', $this->investor->id));
        $response->assertStatus(200);
    }

    //  /**
    //   * 
    //   * A feature test Investor can be updated
    //   *
    //   * @return void
    //  */

     public function test_investor_can_be_updated() : void{

        /**
         * investor can be updated via the model directly
         * @var App\Traits\Testing\WithInvestor $this->investor 
         */
        $new_status =$this->faker()->word();
        
        $this->investor->status = $new_status; 
        $this->assertTrue($this->investor->isDirty());

        $this->investor->save();
        $this->assertTrue($this->investor->wasChanged());


         /**
         * Investor can be update via api end point request 
         * 
         * Authenticate the user
         * @func App\Traits\Testing\WithUser $this->authUser() 
         */
        $this->authUser();
        $new_status =$this->faker()->word();
        $this->investor->status = $new_status; 

        $response = $this->withHeaders([
            'accept' => '/application/json',
        ])->put(route('sb-api.investors.update', $this->investor->id), $this->investor->toArray());
       
        $response->assertValid(); 
        $response->assertStatus(200);

        $this->investor->refresh();
        $this->assertTrue($this->investor->wasChanged());
    }

    /**
      *  A feature test investor can be delete
      * @return void
     */
    public function test_investor_can_be_deleted() : void{
        /**
         * investor can be delete via the model directly
         * @var App\Traits\Testing\WithInvestor $this->investor 
         */
        $this->investor->delete();
        $this->assertSoftDeleted($this->investor);


         /**
         * Investor can be delete via api end point request 
         * 
         * Authenticate the user
         * @func App\Traits\Testing\WithUser $this->authUser() 
         */
        $this->authUser();

        // reinitialise a new investor 
        // @func App\Traits\Testing\WithUser $this->setUpInvestor()

        $investor = Investor::factory()->create();
        $response = $this->withHeaders([
            'accept' => '/application/json',
        ])->put(route('sb-api.investors.destroy',  $investor->id), $investor->toArray());
        $response->assertValid();
        $response->assertStatus(200);
    }

    /**
     * A feature test Investor can be permanently deleted
     *
     * @return void
     */
    public function test_investor_can_be_deleted_permanently():void
    {
        /**
         * investor can be deleted permanently via the model directly
         * @property App\Traits\Testing\WithInvestor $this->investor 
         */
       $this->investor->forceDelete();
       $this->assertDeleted($this->investor);
       $this->assertModelMissing($this->investor);
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
