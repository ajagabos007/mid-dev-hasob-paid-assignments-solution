<!-- Status Field -->
<div id="div-status" class="row mb-3">
    <label for="status" class="col-lg-3 col-form-label">Status</label>
    <div class="col-lg-9">
        {!! Form::text('status', null, ['id'=>'status', 'class' => 'form-control']) !!}
        <p class="text-danger input-error text-sm" id="status_input_error"></p>

    </div>
</div>

<!-- Offer Title Field -->
<div id="div-offer_title" class="row mb-3">
    <label for="offer_title" class="col-lg-3 col-form-label">Offer Title</label>
    <div class="col-lg-9">
        {!! Form::text('offer_title', null, ['id'=>'offer_title', 'class' => 'form-control']) !!}
        <p class="text-danger input-error text-sm" id="offer_title_input_error"></p>
    </div>
</div>

<!-- Start Price Per Unit Field -->
<div id="div-price_per_unit" class="row mb-3">
    <label for="price_per_unit" class="col-lg-3 col-form-label">Price Per Unit</label>
    <div class="col-lg-9">
        {!! Form::number('price_per_unit', null, ['id'=>'price_per_unit', 'class' => 'form-control','min' => 0,'max' => 100000000]) !!}
        <p class="text-danger input-error text-sm" id="price_per_unit_input_error"></p>

    </div>
</div>
<!-- End Price Per Unit Field -->

<!-- Start Max Units Per Investor Field -->
<div id="div-max_units_per_investor" class="row mb-3">
    <label for="max_units_per_investor" class="col-lg-3 col-form-label">Max Units Per Investor</label>
    <div class="col-sm-9">
        {!! Form::number('max_units_per_investor', null, ['id'=>'max_units_per_investor', 'class' => 'form-control','min' => 1,'max' => 1000000000]) !!}
        <p class="text-danger input-error text-sm" id="max_units_per_investor_input_error"></p>
    </div>
</div>
<!-- End Max Units Per Investor Field -->

<!-- Start Interest Rate Pct Field -->
<div id="div-interest_rate_pct" class="row mb-3">
    <label for="interest_rate_pct" class="col-lg-3 col-form-label">Interest Rate Pct</label>
    <div class="col-sm-9">
        {!! Form::number('interest_rate_pct', null, ['id'=>'interest_rate_pct', 'class' => 'form-control','min' => 0,'max' => 100]) !!}
        <p class="text-danger input-error text-sm" id="interest_rate_pct_input_error"></p>

    </div>
</div>
<!-- End Interest Rate Pct Field -->

<!-- Offer Start Date Field -->
<div id="div-offer_start_date" class="row mb-3">
    <label for="offer_start_date" class="col-lg-3 col-form-label">Offer Start Date</label>
    <div class="col-lg-9">
        {!! Form::text('offer_start_date', null, ['id'=>'offer_start_date', 'class' => 'form-control']) !!}
        <p class="text-danger input-error text-sm" id="offer_start_date_input_error"></p>

    </div>
</div>

<!-- Offer End Date Field -->
<div id="div-offer_end_date" class="row mb-3">
    <label for="offer_end_date" class="col-lg-3 col-form-label">Offer End Date</label>
    <div class="col-lg-9">
        {!! Form::text('offer_end_date', null, ['id'=>'offer_end_date', 'class' => 'form-control']) !!}
        <p class="text-danger input-error text-sm" id="offer_end_date_input_error"></p>

    </div>
</div>

<!-- Offer Settlement Date Field -->
<div id="div-offer_settlement_date" class="row mb-3">
    <label for="offer_settlement_date" class="col-lg-3 col-form-label">Offer Settlement Date</label>
    <div class="col-lg-9">
        {!! Form::text('offer_settlement_date', null, ['id'=>'offer_settlement_date', 'class' => 'form-control']) !!}
        <p class="text-danger input-error text-sm" id="offer_settlement_date_input_error"></p>

    </div>
</div>

<!-- Offer Maturity Date Field -->
<div id="div-offer_maturity_date" class="row mb-3">
    <label for="offer_maturity_date" class="col-lg-3 col-form-label">Offer Maturity Date</label>
    <div class="col-lg-9">
        {!! Form::text('offer_maturity_date', null, ['id'=>'offer_maturity_date', 'class' => 'form-control']) !!}
        <p class="text-danger input-error text-sm" id="offer_maturity_date_input_error"></p>

    </div>
</div>

<!-- Tenor Years Field -->
<div id="div-tenor_years" class="row">
    <label for="tenor_years" class="col-lg-3 col-form-label">Tenor Years</label>
    <div class="col-lg-9">
        {!! Form::number('tenor_years', null, ['id'=>'tenor_years', 'class' => 'form-control']) !!}
        <p class="text-danger input-error text-sm" id="tenor_years_input_error"></p>

    </div>
</div>