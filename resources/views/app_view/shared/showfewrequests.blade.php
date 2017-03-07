

@if(isset($all_requests))
    @if(count($all_requests) >0)
    <div id="js-grid-faq" class="cbp cbp-l-grid-faq">
        @foreach($all_requests as $req)
    
            <div class="cbp-item">
                <div class="cbp-caption">
                    <div class="cbp-caption-defaultWrap">

                            @if($req->dismissed == 1)
                                continue
                            
                            @elseif($req->rid !== null)
                                 <i class="fa fa-check-circle-o"></i>
                           
                            @endif
                            
                       
 
                               
                       
                        Request from {{$req->client_name}} for 
                       
                        {{$cate->where('id',$req->category_id)->first()->name}}
                        
                        
                    </div>
                    <div class="cbp-caption-activeWrap">
                        <div class="cbp-l-caption-body">
                        @if($req->rid == null)
                             
                                @if(is_object($ob = json_decode($req->request)))

                                    @if(strtotime($ob->date)>strtotime(date('Y-m-d')))
                                       <button class="btn btn-success btn-xs request" id="reply" data-toggle="modal" 
                                            data-target="#reply_request" data-rid = "{{$req->id}}"
                                            data-client-id = "{{$req->client_id}}" data-uid = "{{Auth::id()}}"
                                        >
                                            Reply
                                            
                                        </button>
                                        <button class="btn btn-danger btn-xs request" data-rid = "{{$req->id}}"
                                            data-client-id = "{{$req->client_id}}" data-uid = "{{Auth::id()}}"
                                            id="dismiss"
                                        >
                                            Dismiss
                                            
                                        </button>
                                        <br><br>
                                    
                                    @else
                                    
                                        <div class="alert alert-warning">Event Schedule Date has Passed</div>
                                    @endif
                                
                            @endif
                                
                        @endif
                           @if(is_object(json_decode($req->request)))
                               
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
                            <br>
                            
                        </div>
                    </div>
                </div>
            </div>

        @endforeach
    </div>
    @endif
@endif

