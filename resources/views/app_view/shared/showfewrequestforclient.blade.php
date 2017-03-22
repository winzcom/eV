 <div class="panel-group" id="accordion2" role="tablist" aria-multiselectable="true">
@if(isset($requests))
    @if(count($requests) > 0)
   
        @foreach($requests as $key=>$request)
            <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading{{$key}}">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion2" href="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}">
                             Request For {{$request->cat_name}} ({{$request->replies}} reply(s) )
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
                                        echo 'Additional Services ( ';
                                            foreach($value as $val){
                                                if(is_numeric($val))
                                                    echo $cats->where('id',$val)->first()->name;
                                                else
                                                    echo $val;
                                            }
                                            echo ' )<br><br>';
                                    }
                                    else
                                        echo title_case($key).':'.$value.'<br><hr>';
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
                    echo 'Additional Services ( ';
                        foreach($value as $val){
                            if(is_numeric($val))
                                echo $cats->where('id',$val)->first()->name.' ';
                            else
                                echo $val.' ';
                        }
                        echo ' )<br><br>';
                }
                else
                    echo title_case($key).':'.$value.'<br><hr>';
            }
        }
        else{
            echo $request;
        }
    @endphp

@endif
</div>