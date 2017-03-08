@component('mail::message')

    Quote Received From {{$data['vendor_data']->name}} For {{$data['request_data']->name}}

    @component('mail::panel')

        @if(is_object($ob = json_decode($req->request)))

            @foreach(json_decode($req->request) as $key=>$value)
                    @php
                        if(is_array($value)){
                            continue;
                        } 
                    @endphp
                    {{$key}} : {{$value}}<hr>
                        
            @endforeach
                
        @else

            {{$req->request}}
                                        
                
        @endif

    @endcomponent


@endcomponent