<?php
namespace DMO\SavingsBond\Traits\Testing;
use DMO\SavingsBond\Models\Investor;

trait WithInvestor
{
    /**
     * The Investor instance.
     *
     * @var \DMO\SavingsBond\Models\Investor
     */

    protected $investor;


    /**
     * Initialize the investor instance.
     *
     * @param  array|null  $investor_data
     * @return \DMO\SavingsBond\Models\Investor
     */
    protected function setUpInvestor($investor_data=null):void
    {
        $this->investor = $this->investor($investor_data);
    }

    

    /**
     * Get/create an investor instance for a given investor data.
     *
     * @param  array|null  $investor_data
     * @return \DMO\SavingsBond\Models\Investor
     */
    public function investor($investor_data = null ){
        $investor = is_array($investor_data) ? Investor::factory()->create($investor_data) : Investor::first();
        return $investor ??   Investor::factory()->create();
    }

    /**
     * Delete all of the model's associated database records
     * Reset any auto-incrementing IDs on the model's associated table
     * @return void
     */
    public function refreshInvestor() :void {

        foreach (Investor::withTrashed()->get() as $key => $investor) {
            $investor->forceDelete();
        }
  
    }

}
