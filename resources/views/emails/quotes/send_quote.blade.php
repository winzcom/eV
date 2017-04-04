@component('mail::message')

    @component('mail::panel')
        Quote Received From {{$vendor->name}} For {{$request->name}}
        Cost: {{$cost}}
    Message: {{$message}}

    @endcomponent

    @component('mail::subcopy')

        @if(is_object($ob = json_decode($request->request)))

            @foreach($ob as $key=>$value)
                    @php
                        if(is_array($value)){
                            foreach($value as $key=>$val){
                                echo $val.' ';
                            }
                        }
                        else{
                            echo $key.' '.$value;
                        } 
                    @endphp                
            @endforeach
                
        @else

            {{$request}}
                                        
                
        @endif

    @endcomponent


@endcomponent