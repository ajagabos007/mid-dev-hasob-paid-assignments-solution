<!-- Status Field -->
<div id="div-status" class="row mb-3">
    <label for="status" class="col-lg-3 col-form-label">Status</label>
    <div class="col-lg-9">
        {!! Form::text('status', null, ['id'=>'status', 'class' => 'form-control']) !!}
        <p class="text-danger input-error text-sm" id="status_input_error"></p>
    </div>
</div>

<!-- Broker Code Field -->
<div id="div-broker_code" class="row mb-3">
    <label for="broker_code" class="col-lg-3 col-form-label">Broker Code</label>
    <div class="col-lg-9">
        {!! Form::text('broker_code', null, ['id'=>'broker_code', 'class' => 'form-control']) !!}
        <p class="text-danger input-error text-sm" id="broker_code_input_error"></p>
    </div>
</div>

<!-- Full Name Field -->
<div id="div-full_name" class="row mb-3">
    <label for="full_name" class="col-lg-3 col-form-label">Full Name</label>
    <div class="col-lg-9">
        {!! Form::text('full_name', null, ['id'=>'full_name', 'class' => 'form-control']) !!}
        <p class="text-danger input-error text-sm" id="full_name_input_error"></p>
    </div>
</div>

<!-- Short Name Field -->
<div id="div-short_name" class="row mb-3">
    <label for="short_name" class="col-lg-3 col-form-label">Short Name</label>
    <div class="col-lg-9">
        {!! Form::text('short_name', null, ['id'=>'short_name', 'class' => 'form-control']) !!}
        <p class="text-danger input-error text-sm" id="short_name_input_error"></p>
    </div>
</div>