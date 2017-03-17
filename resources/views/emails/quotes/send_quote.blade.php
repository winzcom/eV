@component('mail::message')

    Quote Received From {{$data['vendor_data']->name}} For {{$data['request_data']->name}}

    @component('mail::panel')

        @if(is_object($ob = json_decode($data['request_data']->request)))

            @foreach($ob as $key=>$value)
                    @php
                        if(is_array($value)){
                            foreach($value as $key=>$val){
                                echo $val.' ';
                            }
                        } 
                    @endphp
                    {{$key}} : {{$value}}<hr>
                        
            @endforeach
                
        @else

            {{$data->request}}
                                        
                
        @endif

        <h4>Cost: {{$data['cost']}}</h4>
        <p>Message: {{$data['message']}}</p>

    @endcomponent


@endcomponent