@if(isset($requests))
    @if(count($requests) > 0)
    <div class="">
        @foreach($requests as $key=>$request)
            <div class="">
                <div class="" role="tab" id="heading{{$key}}">
                    <h4 class="">
                        <a class="" data-toggle="collapse" data-parent="#accordion" 
                            href="#collapse{{$key}}" aria-expanded="false" 
                            aria-controls="collapse{{$key}}">
                                Request For {{$request->cat_name}} ({{$request->replies}} reply(s) )
                        </a>
                        
                    </h4><!-- panel-title-->
                        
                </div><!-- panel-heading -->
                <div id="collapse{{$key}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$key}}">
                    <div class="panel-body">
                        @php 
                            $obj = json_decode($request->request);
                            if($request->rid !== null){
                                echo "<button class='btn btn-success btn-xs request' id='reply'>
                                            Show Quotes
                                        </button><br><br>";
                            }
                            if(is_object($obj)){
                                foreach($obj as $key=>$val){
                                    echo $key.': '.$val.'<br><hr>';
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
        </div>
    @endif
@endif