<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

use Hasob\FoundationCore\Models\Organization;

class OrganizationFactory extends Factory
{
     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Organization::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $org = $this->faker->domainWord();
        $domain = $this->faker->word();

        return [
            'org' =>$org, //'app',
            'domain' => $domain,  // 'test',
            'full_url' => 'www.'.$org.'.'.$domain, //'www.app.test',
            'subdomain' => 'sub',
            'is_local_default_organization' => true,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ];
    }
}
