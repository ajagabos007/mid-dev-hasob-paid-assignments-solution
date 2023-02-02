<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Hasob\FoundationCore\Models\Organization;
use Hasob\FoundationCore\Models\User;

use DMO\SavingsBond\Models\Investor;
use DMO\SavingsBond\Models\Broker;

class InvestorFactory extends Factory
{
    
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Investor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'organization_id' => Organization::first(),
            'display_ordinal' => $this->faker->randomDigitNotNull,
            'broker_id' => Broker::firstOrCreate(Broker::factory()->make()->toArray()),
            'is_broker_created' => true ,
            'user_id' => User::factory()->create(),
            'date_of_birth' => $this->faker->date('Y-m-d H:i:s'),
            'origin_geo_zone' => $this->faker->word,
            'origin_lga' => $this->faker->word,
            'address_street' => $this->faker->streetName(),
            'address_town' => $this->faker->cityPrefix(),
            'address_state' => $this->faker->state(),
            'status' => $this->faker->word,
            'wf_status' => $this->faker->word,
            'wf_meta_data' => $this->faker->text,
            'bank_account_name' => $this->faker->name(),
            'bank_account_number' => $this->faker->numerify("##########"),
            'bank_name' => $this->faker->word(),
            'is_bank_account_verified' => $this->faker->boolean(),
            'bank_account_meta_data' => $this->faker->text(),
            'bank_verification_number' => $this->faker->randomNumber(),
            'is_bvn_verified' => $this->faker->boolean(),
            'bvn_meta_data' => $this->faker->text(),
            'national_id_number' => $this->faker->randomNumber(),
            'is_nin_verified' => $this->faker->boolean(),
            'nin_meta_data' => $this->faker->text(),
            'cscs_id_number' => $this->faker->bothify('??##???##??###'),
            'is_cscs_id_verified' => $this->faker->boolean(),
            'cscs_meta_data' => $this->faker->slug(),
            'chn_id_number' => $this->faker->bothify('??##???##??###'),
            'is_chn_id_verified' => $this->faker->boolean(),
            'chn_meta_data' => $this->faker->slug(),
        ];
    }
}
