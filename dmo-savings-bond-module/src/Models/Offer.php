<?php

namespace DMO\SavingsBond\Models;

use Hasob\FoundationCore\Traits\GuidId;
use Hasob\FoundationCore\Traits\Ledgerable;
use Hasob\FoundationCore\Traits\Artifactable;
use Hasob\FoundationCore\Traits\OrganizationalConstraint;
use Hasob\FoundationCore\Models\Organization;

use Eloquent as Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Database\Factories\OfferFactory;

use DMO\SavingsBond\Events\OfferCreated;
use DMO\SavingsBond\Events\OfferUpdated;
use DMO\SavingsBond\Events\OfferDeleted;

use DMO\SavingsBond\Listeners\OfferCreatedListener;
use DMO\SavingsBond\Listeners\OfferUpdatedListener;
use DMO\SavingsBond\Listeners\OfferDeletedListener;

/**
 * Class Offer
 * @package DMO\SavingsBond\Models
 * @version April 12, 2022, 7:27 pm UTC
 *
 * @property string $organization_id
 * @property string $status
 * @property string $offer_title
 * @property number $price_per_unit
 * @property integer $max_units_per_investor
 * @property number $interest_rate_pct
 * @property string $offer_start_date
 * @property string $offer_end_date
 * @property string $offer_settlement_date
 * @property string $offer_maturity_date
 * @property integer $tenor_years
 */
class Offer extends Model
{
    use GuidId;
    use OrganizationalConstraint;
    
    use SoftDeletes;

    use HasFactory;

    public $table = 'sb_offers';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'organization_id',
        'display_ordinal',
        'status',
        'wf_status',
        'wf_meta_data',
        'offer_title',
        'price_per_unit',
        'max_units_per_investor',
        'interest_rate_pct',
        'offer_start_date',
        'offer_end_date',
        'offer_settlement_date',
        'offer_maturity_date',
        'tenor_years'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'display_ordinal' => 'integer',
        'status' => 'string',
        'wf_status' => 'string',
        'wf_meta_data' => 'string',
        'offer_title' => 'string',
        'price_per_unit' => 'decimal:2',
        'max_units_per_investor' => 'integer',
        'interest_rate_pct' => 'decimal:2',
        'tenor_years' => 'integer'
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => OfferCreated::class,
        'updated' => OfferUpdated::class,
        'deleted' => OfferDeleted::class,
    ];

     /**
     * The event map for the model.
     *
     * @var array
     */
    protected $listeners = [
        'created' => OfferCreatedListener::class,
        'updated' => OfferUpdatedListener::class,
        'deleted' => OfferDeletedListener::class,
    ];

    /**
     * Get the organization that the offer belongs to.
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }  

    /**
     * Create a new factory instance for user.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return OfferFactory::new();
    }

    

}
