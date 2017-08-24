@extends('emails.layout.email')

@section('content')

   @inject('service','App\Service\Service')
                <h3 style="text-align:center;">
                    New Request From {{ $first_name }} {{ $last_name }} for 
                    {{ $category }}
                </h3><br>

                <ul class="list-group">
                    
                
                    @foreach( $requests as $key => $value )
                        
                            @php 
                                if(is_array($value)){
                                    if($key == 'my_budget'){
                                        echo str_replace('_',' ',title_case($key));
                                        echo ': &#8358;'.$service->currencyFormatter($value[0]).'- &#8358;'.$service->currencyFormatter($value[1]);
                                    }else {
                                        echo $key == 'extra'? 'Extras: (': ucwords($key).': (';
                                        echo implode(",",$value);
                                        echo ' )';
                                    }
                                    
                                }
                                /*elseif($key == 'phone_no')
                                    continue;*/
                                elseif($key == 'date'){
                                    $dt = null;
                                    try{
                                        $dt = \Carbon\Carbon::parse($value);
                                        echo str_replace('_',' ',title_case($key)).':'.$dt->toFormattedDateString().'<br><hr>';
                                    }catch(\Exception $e){
                                        echo 'Date: Date of event not specified<br>';
                                    }
                                    
                                }
                                elseif($key == 'price_range') {
                                        list($lower, $higher) = explode('-',$value);
                                        echo '<li>'.str_replace('_',' ',title_case($key)).': &#8358;'.$service->currencyFormatter($lower).'- &#8358;'.$service->currencyFormatter($higher).'<li><br><br>';
                                        continue;
                                }
                                else
                                   echo '<li>'. ucfirst(str_replace('_',' ',title_case($key))).' : '. $value.'</li>';
                            @endphp
                        
                       <hr><br>
                    @endforeach
                </ul>
                <br>
                <a href="https://eventpad.ng/login" style="text-align:center;"><button class="btn btn-primary" type="">Login to submit quote</button></a><br>
                Thanks,
                {{ config('app.name') }}

@endsection
        