<!-- Broker Field -->

<div id="div-origin_geo_zone" class="row mb-3">
    <label for="origin_geo_zone" class="col-lg-3 col-form-label">Broker</label>
    <div class="col-lg-9">
        {!! Form::select('broker_id',$brokers??[''=>''], null, ['id'=>'broker_id', 'class' => 'form-control']) !!}
        <p class="text-danger input-error text-sm" id="broker_id_input_error"></p>
    </div>
</div>

<!-- User Field -->
<div id="div-origin_geo_zone" class="row mb-3">
    <label for="origin_geo_zone" class="col-lg-3 col-form-label">User</label>
    <div class="col-lg-9">
        {!! Form::select('user_id', $users ?? [''=>''], null, ['id'=>'user_id', 'class' => 'form-control']) !!}
        <p class="text-danger input-error text-sm" id="user_id_input_error"></p>
    </div>
</div>

<!-- Date Of Birth Field -->
<div id="div-date_of_birth" class="row mb-3">
    <label for="date_of_birth" class="col-lg-3 col-form-label">Date Of Birth</label>
    <div class="col-lg-9">
        {!! Form::text('date_of_birth', null, ['id'=>'date_of_birth', 'class' => 'form-control']) !!}
        <p class="text-danger input-error text-sm" id="date_of_birth_input_error"></p>
    </div>
</div>

<!-- Origin Geo Zone Field -->
<div id="div-origin_geo_zone" class="row mb-3">
    <label for="origin_geo_zone" class="col-lg-3 col-form-label">Origin Geo Zone</label>
    <div class="col-lg-9">
        {!! Form::text('origin_geo_zone', null, ['id'=>'origin_geo_zone', 'class' => 'form-control']) !!}
        <p class="text-danger input-error text-sm" id="origin_geo_zone_input_error"></p>
    </div>
</div>

<!-- Origin Lga Field -->
<div id="div-origin_lga" class="row mb-3">
    <label for="origin_lga" class="col-lg-3 col-form-label">Origin Lga</label>
    <div class="col-lg-9">
        {!! Form::text('origin_lga', null, ['id'=>'origin_lga', 'class' => 'form-control']) !!}
        <p class="text-danger input-error text-sm" id="origin_lga_input_error"></p>
    </div>
</div>

<!-- Address Street Field -->
<div id="div-address_street" class="row mb-3">
    <label for="address_street" class="col-lg-3 col-form-label">Address Street</label>
    <div class="col-lg-9">
        {!! Form::text('address_street', null, ['id'=>'address_street', 'class' => 'form-control']) !!}
        <p class="text-danger input-error text-sm" id="address_street_input_error"></p>
    </div>
</div>

<!-- Address Town Field -->
<div id="div-address_town" class="row mb-3">
    <label for="address_town" class="col-lg-3 col-form-label">Address Town</label>
    <div class="col-lg-9">
        {!! Form::text('address_town', null, ['id'=>'address_town', 'class' => 'form-control']) !!}
        <p class="text-danger input-error text-sm" id="address_town_input_error"></p>
    </div>
</div>

<!-- Address State Field -->
<div id="div-address_state" class="row mb-3">
    <label for="address_state" class="col-lg-3 col-form-label">Address State</label>
    <div class="col-lg-9">
        {!! Form::text('address_state', null, ['id'=>'address_state', 'class' => 'form-control']) !!}
        <p class="text-danger input-error text-sm" id="address_state_input_error"></p>
    </div>
</div>

<!-- Status Field -->
<div id="div-status" class="row mb-3">
    <label for="status" class="col-lg-3 col-form-label">Status</label>
    <div class="col-lg-9">
        {!! Form::text('status', null, ['id'=>'status', 'class' => 'form-control']) !!}
        <p class="text-danger input-error text-sm" id="status_input_error"></p>
    </div>
</div>

<!-- Bank Account Name Field -->
<div id="div-bank_account_name" class="row mb-3">
    <label for="bank_account_name" class="col-lg-3 col-form-label">Bank Account Name</label>
    <div class="col-lg-9">
        {!! Form::text('bank_account_name', null, ['id'=>'bank_account_name', 'class' => 'form-control','minlength' => 2,'maxlength' => 100]) !!}
        <p class="text-danger input-error text-sm" id="bank_account_name_input_error"></p>
    </div>
</div>

<!-- Bank Account Number Field -->
<div id="div-bank_account_number" class="row mb-3">
    <label for="bank_account_number" class="col-lg-3 col-form-label">Bank Account Number</label>
    <div class="col-lg-9">
        {!! Form::text('bank_account_number', null, ['id'=>'bank_account_number', 'class' => 'form-control']) !!}
        <p class="text-danger input-error text-sm" id="bank_account_number_input_error"></p>
    </div>
</div>

<!-- Bank Name Field -->
<div id="div-bank_name" class="row mb-3">
    <label for="bank_name" class="col-lg-3 col-form-label">Bank Name</label>
    <div class="col-lg-9">
        {!! Form::text('bank_name', null, ['id'=>'bank_name', 'class' => 'form-control']) !!}
        <p class="text-danger input-error text-sm" id="bank_name_input_error"></p>
    </div>
</div>
<!-- Bank Verification Number Field -->
<div id="div-bank_verification_number" class="row mb-3">
    <label for="bank_verification_number" class="col-lg-3 col-form-label">Bank Verification Number</label>
    <div class="col-lg-9">
        {!! Form::text('bank_verification_number', null, ['id'=>'bank_verification_number', 'class' => 'form-control']) !!}
        <p class="text-danger input-error text-sm" id="bank_verification_number_input_error"></p>
    </div>
</div>

<!-- National Id Number Field -->
<div id="div-national_id_number" class="row mb-3">
    <label for="national_id_number" class="col-lg-3 col-form-label">National Id Number</label>
    <div class="col-lg-9">
        {!! Form::text('national_id_number', null, ['id'=>'national_id_number', 'class' => 'form-control']) !!}
        <p class="text-danger input-error text-sm" id="national_id_number_input_error"></p>
    </div>
</div>

<!-- Cscs Id Number Field -->
<div id="div-cscs_id_number" class="row mb-3">
    <label for="cscs_id_number" class="col-lg-3 col-form-label">Cscs Id Number</label>
    <div class="col-lg-9">
        {!! Form::text('cscs_id_number', null, ['id'=>'cscs_id_number', 'class' => 'form-control']) !!}
        <p class="text-danger input-error text-sm" id="cscs_id_number_input_error"></p>
    </div>
</div>
<!-- Chn Id Number Field -->
<div id="div-chn_id_number" class="row mb-3">
    <label for="chn_id_number" class="col-lg-3 col-form-label">Chn Id Number</label>
    <div class="col-lg-9">
        {!! Form::text('chn_id_number', null, ['id'=>'chn_id_number', 'class' => 'form-control']) !!}
        <p class="text-danger input-error text-sm" id="chn_id_number_input_error"></p>
    </div>
</div>
