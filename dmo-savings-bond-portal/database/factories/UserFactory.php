<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Hasob\FoundationCore\Models\User;
use Hasob\FoundationCore\Models\Organization;
use Hasob\FoundationCore\Traits\Testing\WithOrganization;

use Hash;
use Carbon\Carbon;



class UserFactory extends Factory
{
    use WithOrganization;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'telephone' => $this->faker->unique()->e164PhoneNumber(),
            'password' => Hash::make('password'),
            'first_name' => $this->faker->name(),
            'last_name' => $this->faker->name(),
            'organization_id' => Organization::firstorCreate(Organization::newFactory()->make()->toArray()),
            'last_loggedin_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ];
    }

    
    
}
