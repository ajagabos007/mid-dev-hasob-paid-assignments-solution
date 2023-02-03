    <!-- Offer investors Field -->
    <div id="div_broker_investors" class="col-sm-12 mb-10">
        <p>
            <label for="investors" class="control-label fw-bold">Investors:</label>
            <span id="spn_broker_investors">  
            @if (isset($broker->subscriptions))  
                @forelse ($broker->investors as $investor)
                    <p>{{$loop->index+1}}. <a href="{{route('sb.investors.show', $investor->id)}}">{!! $investor->user->first_name !!} </a><p>
                @empty
                    N/A
                @endforelse
            @endif
            </span>
        </p>
    </div>
<hr/>
    <!-- Offer subscriptions Field -->
    <div id="div_broker_subscriptions" class="col-sm-12 mb-10">
        <p>
            <label for="subscriptions" class="control-label fw-bold">Subscriptions:</label>
            <span id="spn_broker_subscriptions">
            @if (isset($broker->subscriptions))  
                @forelse ($broker->subscriptions as $subscription)
                    <p>{{$loop->index+1}}. <a href="{{route('sb.subscriptions.show', $subscription->id)}}">{!! $subscription->id!!} </a><p>
                @empty
                    N/A
                @endforelse
            @endif
            </span>
        </p>
    </div>
<hr/>
<!-- Status Field -->
<div id="div_broker_status" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('status', 'Status:', ['class'=>'control-label fw-bold']) !!} 
        <span id="spn_broker_status">
        @if (isset($broker->status) && empty($broker->status)==false)
            {!! $broker->status !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<hr/>
    <!-- Offer Title Field -->
    <div id="div_broker_organization_id" class="col-sm-12 mb-10">
        <p>
            {!! Form::label('organization_id', 'Organization:', ['class'=>'control-label fw-bold']) !!} 
            <span id="spn_broker_organization_id">
            @if (isset($broker->organization) && empty($broker->organization)==false)
                <a href="{{route('fc.organizations.show', $broker->organization->id)}}">{!! $broker->organization->org !!} </a> 
            @else
                N/A
            @endif
            </span>
        </p>
    </div>
<hr/>

<!-- Broker Code Field -->
<div id="div_broker_broker_code" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('broker_code', 'Broker Code:', ['class'=>'control-label fw-bold']) !!} 
        <span id="spn_broker_broker_code">
        @if (isset($broker->broker_code) && empty($broker->broker_code)==false)
            {!! $broker->broker_code !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Full Name Field -->
<div id="div_broker_full_name" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('full_name', 'Full Name:', ['class'=>'control-label fw-bold']) !!} 
        <span id="spn_broker_full_name">
        @if (isset($broker->full_name) && empty($broker->full_name)==false)
            {!! $broker->full_name !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Short Name Field -->
<div id="div_broker_short_name" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('short_name', 'Short Name:', ['class'=>'control-label fw-bold']) !!} 
        <span id="spn_broker_short_name">
        @if (isset($broker->short_name) && empty($broker->short_name)==false)
            {!! $broker->short_name !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

