<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Hasob\FoundationCore\Models\Organization;
use Hasob\FoundationCore\Models\Department;

class DepartmentFactory extends Factory
{
     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Department::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'key'=> $this->faker->unique()->bothify('??##???##??###'),
            'long_name' => $this->faker->unique()->word(),
            'is_unit' => $this->faker->boolean(),
            'email' => $this->faker->safeEmail(),
            'telephone' => $this->faker->e164PhoneNumber(),
            'physical_location' => $this->faker->streetName(),            
            'is_ad_import'=>  $this->faker->boolean(),
           'ad_type' => $this->faker->word(),
            'ad_key'=> $this->faker->bothify('?#?##??#?##??##??#'),
            'ad_data' => $this->faker->text(),
            'parent_id'=> null,
            'organization_id'=> Organization::first()?? null
        ];
    }
}
