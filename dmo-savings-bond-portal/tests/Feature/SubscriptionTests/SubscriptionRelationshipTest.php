<?php

namespace Tests\Feature\SubscriptionTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Hasob\FoundationCore\Models\User;
use Hasob\FoundationCore\Models\Organization;

use DMO\SavingsBond\Models\Broker;
use DMO\SavingsBond\Models\Subscription;
use DMO\SavingsBond\Traits\Testing\WithSubscription;

class SubscriptionRelationshipTest extends TestCase
{
    use WithFaker;
    use WithSubscription;

    /**
     * A feature subscription relationship test. subscription  belongs to an organization.
     *
     * @return void
    */
    public function test_subscription_belongs_to_an_organization()
    {
        if(!$this->subscription)
            $this->setUpSubscription();
        $organization_class = $this->subscription->organization? $this->subscription->organization::class : null;
        $this->assertTrue($organization_class == Organization::class);
    }

    /**
     * A feature subscription relationship test. subscription  belongs to an organization.
     *
     * @return void
    */
    public function test_subscription_belongs_to_a_user()
    {
        if(!$this->subscription)
            $this->setUpSubscription();
        $user_class = $this->subscription->user? $this->subscription->user::class : null;
        $this->assertTrue($user_class == User::class);
    }

     /**
     * A feature subscription relationship test. subscription  belongs to an organization.
     *
     * @return void
    */
    // public function test_subscription_belongs_to_a_broker()
    // {
    //     if(!$this->subscription)
    //         $this->setUpSubscription();
    //     $broker_class = $this->subscription->broker? $this->subscription->broker::class : null;
    //     $this->assertTrue($broker_class == Broker::class);
    // }

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

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     *
     * @throws \Mockery\Exception\InvalidCountException
    */
    protected function tearDown(): void
    {
        $this->refreshSubscription();         
        parent::tearDown();
    }

}
