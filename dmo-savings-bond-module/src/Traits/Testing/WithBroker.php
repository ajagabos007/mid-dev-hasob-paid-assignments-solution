<?php
namespace DMO\SavingsBond\Traits\Testing;
use DMO\SavingsBond\Models\Broker;

trait WithBroker
{
    /**
     * The Broker instance.
     *
     * @var \DMO\SavingsBond\Models\Broker
     */

    protected $broker;


    /**
     * Initialize the broker instance.
     *
     * @param  array|null  $broker_data
     * @return \DMO\SavingsBond\Models\Broker
     */
    protected function setUpBroker($broker_data=null):void
    {
        $this->broker = $this->broker($broker_data);
    }

    

    /**
     * Get/create an broker instance for a given broker data.
     *
     * @param  array|null  $broker_data
     * @return \DMO\SavingsBond\Models\Broker
     */
    public function broker($broker_data = null ){
        $broker = is_array($broker_data) ? Broker::factory()->create($broker_data) : Broker::first();
        return $broker ??   Broker::factory()->create();
    }

    /**
     * Delete all of the model's associated database records
     * Reset any auto-incrementing IDs on the model's associated table
     * @return void
     */
    public function refreshBroker() :void {

        foreach (Broker::withTrashed()->get() as $key => $broker) {
            $broker->forceDelete();
        }
  
    }

}
