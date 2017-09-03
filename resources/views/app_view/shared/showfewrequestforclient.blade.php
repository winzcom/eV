 @inject('service','App\Service\Service')

 <div class="panel-group" id="accordion2" role="tablist" aria-multiselectable="true">
@if(isset($all_requests))
    @if(count($all_requests) > 0)
   
        @foreach($all_requests as $key=>$request)
            <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading{{$key}}">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion2" href="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}">
                             @if($request->replies > 0)
                                <i class="fa fa-check-circle-o"></i>&nbsp;
                            @endif

                             Request For {{$request->cat_name}} 
                             @if(!is_null($request->vicinity))
                                in {{$request->vicinity}}, {{$request->state}}
                             @else all of {{$request->state}}
                             @endif 
                             
                             on {{\Carbon\Carbon::parse($request->created_at)->toFormattedDateString()}}({{$request->replies}} reply(s) of {{$request->total_vendors}})
                            </a>
                        
                        </h4><!-- panel-title-->
                    </div><!-- panel-heading -->
                <div id="collapse{{$key}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading{{$key}}">
                    <div class="panel-body">
                        @php 
                            $obj = json_decode($request->request);
                            if($request->rid !== null){
                                echo "<a href = 'cuquote/$request->id' ><button class='btn btn-success btn-xs request ' id='reply'>
                                            Show Quotes
                                        </button></a><br><br>";
                                    
                            }
                            if(is_object($obj)){
                                
                                foreach($obj as $key=>$value){
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
                                    elseif($key == 'date'){
                                        $dt = null;
                                        try{
                                            $dt = \Carbon\Carbon::parse($value);
                                            echo str_replace('_',' ',title_case($key)).':'.$dt->toFormattedDateString().'<br><hr>';
                                        }catch(\Exception $e){
                                            echo 'Date: Date of event not specified<br><hr>';
                                        }
                                        
                                    } elseif($key == 'price_range') {

                                        list($lower, $higher) = explode('-',$value);
                                        echo str_replace('_',' ',title_case($key)).': &#8358;'.
                                        $service->currencyFormatter($lower).'- &#8358;'.$service->currencyFormatter($higher).'<br><br><hr>';

                                    } elseif($key == 'personal_message' || $key == 'personalmessage') {
                                        echo str_replace('_',' ',title_case($key)).': <textarea disabled class="form-control">'.$value.'</textarea><br><br><hr>';
                                    }
                                    else
                                        echo str_replace('_',' ',title_case($key)).':'.$value.'<br><br><hr>';
                                }
                            }
                            else{
                                echo $request->request;
                            }
                        @endphp
                    </div><!-- panel-body-->
                </div><!-- panel-collapse collapse in-->
            </div><!-- panel panel-default-->
                
        @endforeach
    @endif
@elseif(isset($request))

    @php 
        
        
        if($obj = json_decode($request)){
            
            foreach($obj as $key=>$value){

                if(is_array($value)){
                    if($key == 'my_budget'){
                        echo str_replace('_',' ',title_case($key));
                        echo ': &#8358;'.$service->currencyFormatter($value[0]).'- &#8358;'.$service->currencyFormatter($value[1]);
                        echo '<br><hr>';
                    }else {
                        echo $key == 'extra'? 'Extras: (': ucwords($key).': (';
                        echo implode(",",$value);
                        echo ' )';
                        echo '<br><hr>';
                    }
                }
                else
                    echo str_replace('_',' ',title_case($key)).':'.$value.'<br><hr>';
            }
        }
        else{
            echo $request;
        }
    @endphp

@endif
</div>