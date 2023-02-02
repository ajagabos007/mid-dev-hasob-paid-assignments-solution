<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Hasob\FoundationCore\Models\Organization;
use Hasob\FoundationCore\Models\User;

use DMO\SavingsBond\Models\Broker;
use DMO\SavingsBond\Models\Investor;
use DMO\SavingsBond\Models\Offer;
use DMO\SavingsBond\Models\Subscription;


class SubscriptionFactory extends Factory
{
     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subscription::class;

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
            'offer_id' => Offer::firstOrCreate(Offer::factory()->make()->toArray()),
            'user_id' => User::factory()->create(),
            'broker_id' => Broker::firstOrCreate(Broker::factory()->make()->toArray()),
            'broker_code' => $this->faker->word,
            'broker_name' => $this->faker->word,
            'is_broker_created' => true,
            'status' => $this->faker->word,
            'wf_status' => $this->faker->word,
            'wf_meta_data' => $this->faker->text,
            'units_requested' => $this->faker->randomDigitNotNull,
            'price_per_unit' => $this->faker->randomDigitNotNull,
            'total_price' => $this->faker->randomDigitNotNull,
            'interest_rate_pct' => $this->faker->randomDigitNotNull,
            'offer_start_date' => $this->faker->date('Y-m-d H:i:s'),
            'offer_end_date' => $this->faker->date('Y-m-d H:i:s'),
            'offer_settlement_date' => $this->faker->date('Y-m-d H:i:s'),
            'offer_maturity_date' => $this->faker->date('Y-m-d H:i:s'),
            'tenor_years' => $this->faker->randomDigitNotNull,
            'investor_email' => $this->faker->unique()->safeEmail(),
            'investor_telephone' => $this->faker->unique()->e164PhoneNumber(),
            'first_name' => $this->faker->word,
            'middle_name' => $this->faker->word,
            'last_name' => $this->faker->word,
            'date_of_birth' => $this->faker->date('Y-m-d H:i:s'),
            'origin_geo_zone' => $this->faker->word,
            'origin_lga' => $this->faker->word,
            'address_street' => $this->faker->word,
            'address_town' => $this->faker->word,
            'address_state' => $this->faker->word,
            'bank_account_name' => $this->faker->name(),
            'bank_account_number' => $this->faker->numerify("##########"),
            'bank_name' => $this->faker->word,
            'bank_verification_number' => $this->faker->randomNumber(),
            'national_id_number' => $this->faker->randomNumber(),
            'cscs_id_number' => $this->faker->bothify('??##???##??###'),
            'chn_id_number' => $this->faker->bothify('??##???##??###'),
        ];
    }
}
