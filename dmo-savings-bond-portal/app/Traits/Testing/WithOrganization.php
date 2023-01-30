<?php
namespace App\Traits\Testing;

use Illuminate\Foundation\Testing\WithFaker;
use Hasob\FoundationCore\Models\Organization;

/**
 * 
 */
trait WithOrganization
{
    /**
     * The instance of an Organization
     *
     * @var  \Hasob\FoundationCore\Models\Organization;

     */

    protected $organization;


    /**
     * Initialize the organization instance.
     * 
     * @param  array|null  $organization_data
     * @return void
     */
    public function setUpOrganization($organization_data=null)
    {
        $this->organization = $this->organization($organization_data);
    }
    

    /**
     * Get/creat an organization instance for a given  data.
     *
     * @param  array|null  $organization_data
     * @return \Hasob\FoundationCore\Models\Organization;
     */
    public function organization($organization_data = null ){
        $organization = is_array($organization_data) ? Organization::factory()->create($organization_data) : organization::first();
        return $organization ??   Organization::factory()->create();
    }

    /**
     * Delete all of the model's associated database records
     * Reset any auto-incrementing IDs on the model's associated table
     * @return void
     */
    public function refreshOrganization():void{

        foreach (Organization::withTrashed()->get() as $key => $organization) {
            $organization->forceDelete();
        }
       
    }
}
