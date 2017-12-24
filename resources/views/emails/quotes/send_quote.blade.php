@extends('emails.layout.email')

@section('content')
         <h5>Quote Received From {{$vendor->name}} For {{$request->name}}</h5> 
       <p>Cost: {{$cost}}</p> <br><br>
       <label>Message:</label> 
       <textarea rows="5" cols="30" readonly>{{$message}}</textarea>
    <br>
       <hr>
       <h5>Your request:</h5><br>
        @if(is_object($ob = json_decode($request->request)))

            @foreach($ob as $key=>$value)
                    @php
                        if(is_array($value)){
                            echo '<b>'.ucfirst($key).'</b>: ('.implode(',',$value).')<br><br>';
                        } elseif( $key === 'personal_message' ) {
                            echo '<label for="">'.ucfirst(str_replace('_',' ',title_case($key))).'</label>';
                            echo '<textarea rows="10" cols="40" readonly>'.$value.'</textarea>';
                        }
                        else{
                            echo '<b>'.ucfirst(str_replace('_',' ',title_case($key))).'</b> : '.$value.'<br><br>';
                        } 
                    @endphp                
            @endforeach
                
        @else

            {{$request}}
                                        
                
        @endif
        You can Login to see more details <br><br>
    <a href="https://eventpad.ng/culogin" style="text-align:center;"><button class="btn btn-primary" type="">Login</button></a><br>
                Thanks,
                {{ config('app.name') }}
@endsection