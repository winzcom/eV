@if(isset($all_requests))
    @if(count($all_requests) >0)
    <div id="js-grid-faq" class="cbp cbp-l-grid-faq">
        @foreach($all_requests as $req)
    
            <div class="cbp-item">
                <div class="cbp-caption">
                    <div class="cbp-caption-defaultWrap">
                        
                            @if($req->rid !== null)
                                 <i class="fa fa-check-circle-o"></i>
                           
                            @endif
                            
                       
 
                               
                       
                        Request from {{$req->client_name}} for 
                        {{Auth::user()->categories()->where('categories.id',$req->category_id)->get()->first()->name}}
                        
                    </div>
                    <div class="cbp-caption-activeWrap">
                        <div class="cbp-l-caption-body">
                        @if($req->rid == null)
                            <button class="btn btn-success btn-xs request" id="reply" data-request-id = "{{$req->id}}">Reply</button>
                            <button class="btn btn-danger btn-xs request" id="dismiss" data-request-id = "{{$req->id}}">Dismiss</button>
                            <br><br>
                        @endif
                           @if(is_object(json_decode($req->request)))
                               
                                 @foreach(json_decode($req->request) as $key=>$value)
                                    {{$key}} : {{$value}}<hr>
                                 @endforeach
                               
                            @else
                            
                                {{$req->request}}
                            @endif
                            <br>
                            
                        </div>
                    </div>
                </div>
            </div>

        @endforeach
    </div>
    @endif
@endif

