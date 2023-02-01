<?php

namespace Tests\Feature\BrokerTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Hasob\FoundationCore\Models\Organization;

use DMO\SavingsBond\Models\Broker;
use DMO\SavingsBond\Traits\Testing\WithBroker;
 

class BrokerRelationshipTest extends TestCase
{
    use WithBroker;

    /**
     * A feature broker relationship test. broker  belongs to an organization.
     *
     * @return void
     */
    public function test_broker_belongs_to_an_organization()
    {
        $organization_class = $this->broker->organization? $this->broker->organization::class : null;
        $this->assertTrue($organization_class == Organization::class);
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
