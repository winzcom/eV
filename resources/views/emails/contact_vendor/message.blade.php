@extends('emails.layout.email')

@section('content')


@endsection

@component('mail::message')

 @inject('service','App\Service\Service')

Message from {{$customer->first_name}} {{$customer->last_name}} for {{$request->name}}<br><hr>

@component('mail::panel')
{{$message}}
@endcomponent
@component('mail::panel')

Quote<br><hr>

cost: {{$service->currencyFormatter()->formatCurrency($request->cost,'EUR')}}<br><hr>
message: {{$request->message}}

@endcomponent
@component('mail::subcopy')
 @foreach(json_decode($request->request) as $key=>$value)
        @php
            if(is_array($value)){
                echo 'Additional Services ( ';
                foreach($value as $val){
                    echo $val.' ';
                }
                echo ' )<br><br>';
                continue;
            } 
        @endphp
        {{title_case($key)}} : {{$value}} | 
    @endforeach

<br><br><hr>

@endcomponent


@component('mail::promotion')Thanks,<br>@endcomponent

@endcomponent
