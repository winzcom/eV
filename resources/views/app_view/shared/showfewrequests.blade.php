
@php 

if(count($all_requests) > 0){
    echo '<div>';
    foreach($all_requests as $request){
        $rid = !is_null($request->rid) ? $request->rid : null;
        $ob = json_decode($request->request);
        $isobject =  is_object($ob) ? true :false;
        echo '<h4>';
        if(!is_null($rid)){
            echo '<i class="fa fa-check-circle-o"></i>';
        }
        echo 'Request from '.$request->client_name.' for '.$cats->where('id',$request->category_id)->first()->name.'</h4>';

        echo '<div>';
        if(is_null($rid) && !isset($customer)){
            if($isobject){
                if(strtotime($ob->date)>strtotime(date('Y-m-d'))){
                echo '<button class="btn btn-success btn-xs request" id="reply" data-toggle="modal" 
                    data-target="#reply_request" data-rid = "{{$req->id}}"
                    data-client-id = "{{$req->client_id}}" data-uid = "{{Auth::id()}}"
                >
                    Reply
                    
                </button>
                <button class="btn btn-danger btn-xs request dismiss" data-rid = "{{$req->id}}"
                    data-client-id = "{{$req->client_id}}" data-uid = "{{Auth::id()}}"
                    
                >
                    Dismiss
                    
                </button>
                <br><br>';
            }
            else 
                echo '<div class="alert alert-warning">Event Schedule Date has Passed</div>';
            }
        }
        if($isobject){
            foreach($ob as $key=>$value){
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
                    echo $key.':'.$value.'<br><hr>';
            }
        }
        else echo $request->request;
    }
}
@endphp
