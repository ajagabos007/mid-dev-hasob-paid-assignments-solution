<?php
namespace DMO\SavingsBond\Traits\Testing;
use DMO\SavingsBond\Models\Offer;

trait WithOffer
{
    /**
     * The Offer instance.
     *
     * @var \DMO\SavingsBond\Models\Offer
     */

    protected $offer;


    /**
     * Initialize the offer instance.
     *
     * @param  array|null  $offer_data
     * @return \DMO\SavingsBond\Models\Offer
     */
    protected function setUpOffer($offer_data=null):void
    {
        $this->offer = $this->offer($offer_data);
    }

    

    /**
     * Get/create an offer instance for a given offer data.
     *
     * @param  array|null  $offer_data
     * @return \DMO\SavingsBond\Models\Offer
     */
    public function offer($offer_data = null ){
        $offer = is_array($offer_data) ? Offer::factory()->create($offer_data) : Offer::first();
        return $offer ??   Offer::factory()->create();
    }

    /**
     * Delete all of the model's associated database records
     * Reset any auto-incrementing IDs on the model's associated table
     * @return void
     */
    public function refreshOffer() :void {

        foreach (Offer::withTrashed()->get() as $key => $offer) {
            $offer->forceDelete();
        }
  
    }

}
