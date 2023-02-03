<?php

namespace DMO\SavingsBond\Requests;

use DMO\SavingsBond\Requests\AppBaseFormRequest;
use DMO\SavingsBond\Models\Investor;

class CreateInvestorRequest extends AppBaseFormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'organization_id' => 'required',
            'display_ordinal' => 'nullable|min:0|max:365',
            'broker_id' => 'required',
            'user_id' => 'required',
            'origin_geo_zone' => 'nullable|string|max:100',
            'origin_lga' => 'nullable|string|max:100',
            'address_street' => 'nullable|string|max:200',
            'address_town' => 'nullable|string|max:200',
            'address_state' => 'nullable|string|max:200',
            'wf_status' => 'string|max:100',
            'wf_meta_data' => 'string|string|max:1000',
            'bank_account_name' => 'nullable|min:2|max:100',
            'bank_account_number' => 'nullable|string|max:10',
            'bank_name' => 'nullable|string|max:100',
            'bank_account_meta_data' => 'string|max:1000',
            'bank_verification_number' => 'nullable|string|max:100',
            'bvn_meta_data' => 'string|max:1000',
            'national_id_number' => 'nullable|string|max:100',
            'nin_meta_data' => 'string|max:1000',
            'cscs_id_number' => 'nullable|string|max:100',
            'cscs_meta_data' => 'string|max:1000',
            'chn_id_number' => 'nullable|string|max:100',
            'chn_meta_data' => 'string|max:1000'
        ];
    }
}
