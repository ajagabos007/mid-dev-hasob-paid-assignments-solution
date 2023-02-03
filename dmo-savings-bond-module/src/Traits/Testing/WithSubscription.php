<?php
namespace DMO\SavingsBond\Traits\Testing;
use DMO\SavingsBond\Models\Subscription;

trait WithSubscription
{
    /**
     * The Subscription instance.
     *
     * @var \DMO\SavingsBond\Models\Subscription
     */

    protected $subscription;


    /**
     * Initialize the subscription instance.
     *
     * @param  array|null  $subscription_data
     * @return \DMO\SavingsBond\Models\Subscription
     */
    protected function setUpSubscription($subscription_data=null):void
    {
        $this->subscription = $this->subscription($subscription_data);
    }

    

    /**
     * Get/create an subscription instance for a given subscription data.
     *
     * @param  array|null  $subscription_data
     * @return \DMO\SavingsBond\Models\Subscription
     */
    public function subscription($subscription_data = null ){
        $subscription = is_array($subscription_data) ? Subscription::factory()->create($subscription_data) : Subscription::first();
        return $subscription ??   Subscription::factory()->create();
    }

    /**
     * Delete all of the model's associated database records
     * Reset any auto-incrementing IDs on the model's associated table
     * @return void
     */
    public function refreshSubscription() :void {

        foreach (Subscription::withTrashed()->get() as $key => $subscription) {
            $subscription->forceDelete();
        }
  
    }

}
