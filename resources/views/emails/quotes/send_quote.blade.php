@extends('emails.layout.email')

@section('content')
         <h5>Quote Received From {{$vendor->name}} For {{$request->name}}</h5> 
       <p><h5> Cost:</h5> {{$cost}}</p> <br>
       <p><h5>Message:</h5> {{$message}}</p>
    <br>
       <hr>
       <h5>Your request:</h5><br>
        @if(is_object($ob = json_decode($request->request)))

            @foreach($ob as $key=>$value)
                    @php
                        if(is_array($value)){
                            echo '<b>'.ucfirst($key).'</b>: ('.implode(',',$value).')<br><br>';
                        }
                        else{
                            echo '<b>'.ucfirst(str_replace('_',' ',title_case($key))).'</b> : '.$value.'<br><br>';
                        } 
                    @endphp                
            @endforeach
                
        @else

            {{$request}}
                                        
                
        @endif

@endsection