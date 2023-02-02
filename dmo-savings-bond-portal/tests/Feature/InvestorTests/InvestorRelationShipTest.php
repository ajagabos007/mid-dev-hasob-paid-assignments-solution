<?php

namespace Tests\Feature\InvestorTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Hasob\FoundationCore\Models\Organization;

use DMO\SavingsBond\Models\Investor;
use DMO\SavingsBond\Traits\Testing\WithInvestor;

class InvestorRelationShipTest extends TestCase
{
    use WithInvestor;
    
    /**
     * A feature investor relationship test. investor  belongs to an organization.
     *
     * @return void
     */
    public function test_investor_belongs_to_an_organization()
    {
        $organization_class = $this->investor->organization? $this->investor->organization::class : null;
        $this->assertTrue($organization_class == Organization::class);
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
