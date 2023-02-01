<?php

namespace Tests\Feature\OfferTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Hasob\FoundationCore\Models\Organization;

use DMO\SavingsBond\Traits\Testing\WithOffer;

class OfferRelationshipTest extends TestCase
{
    use WithOffer;

    /**
     * A feature offer relationship test. offer  belongs to an organization.
     *
     * @return void
     */
    public function test_offer_belongs_to_an_organization()
    {
        $organization_class = $this->offer->organization? $this->offer->organization::class : null;
        $this->assertTrue($organization_class == Organization::class);
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
}
