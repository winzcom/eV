@if(isset($requests))
    @if(count($requests) > 0)
    <div class="panel-group accordion style1" id="accordion" role="tablist" aria-multiselectable="true">
        @foreach($requests as $key=>$request)
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="heading{{$key}}">
                    <h4 class="panel-title">
                        <a class="" data-toggle="collapse" data-parent="#accordion" 
                            href="#collapse{{$key}}" aria-expanded="false" 
                            aria-controls="collapse{{$key}}">
								Request For {{$request->cat_name}}
                        </a>
                        
                    </h4><!-- panel-title-->
                        
                </div><!-- panel-heading -->
                <div id="collapse{{$key}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$key}}">
                    <div class="panel-body">
                        @php 
                            $obj = json_decode($request->request);
                            if(is_object($obj)){
                                foreach($obj as $key=>$val){
                                    echo $key.': '.$val.'<br><hr>';
                                }
                            }
                        @endphp
                    </div><!-- panel-body-->
                </div><!-- panel-collapse collapse in-->
            </div><!-- panel panel-default-->
                
        @endforeach
        </div>
    @endif
@endif