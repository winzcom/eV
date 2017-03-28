@inject('service','App\Service\Service')

@php 

if(count($all_requests) > 0){
    echo '<div>';
    foreach($all_requests as $request){
        
        $rid = !is_null($request->rid) ? $request->rid : null;
        $ob = json_decode($request->request);
        $isobject =  is_object($ob) ? true :false;
        echo '<h3>';
        if(!is_null($rid)){ 
            echo '<i class="fa fa-check-circle-o"></i>&nbsp';
        }
        echo 'request from '.$request->client_name.' for '.$cats->where('id',$request->category_id)->first()->name.'</h3>';

        echo '<div>';
        if(is_null($rid) && !isset($customer)){
            if($isobject){
                if(strtotime($ob->date)>strtotime(date('Y-m-d'))){
                echo "<button class='btn btn-success btn-xs request' id='reply' data-toggle='modal'
                    data-target='#reply_request' data-rid = '$request->id'
                    data-client-id = '$request->client_id' data-uid = '$vendor_id'
                >
                    Reply
                    
                </button>
                <button class='btn btn-danger btn-xs request dismiss' data-rid = '$request->id'
                    data-client-id = '$request->client_id' data-uid = '$vendor_id'
                    
                >
                    Ignore
                    
                </button>
                <br><br>";
            }
            else 
                echo '<div class="alert alert-warning">Event Schedule Date has Passed</div>';
            }
        }
        else{
                echo "<button class='btn btn-success btn-xs request' id='reply' data-toggle='modal'
                    data-target='#reply_request' data-message = '$request->message'
                    data-cost = '$request->cost' data-uid = '$vendor_id' data-dp='$request->dp'
                >
                    Show Quote
                </button>
                &nbsp;<i class=\"btn btn-info btn-xs sq-corner\">Highest Cost: ".$service->currencyFormatter()->formatCurrency($request->max_cost,'EUR').
                " Lowest Cost: ".$service->currencyFormatter()->formatCurrency($request->min_cost,'EUR')."</i><br><br>";
        }
        if($isobject){
            echo '<div class="alert alert-success">';
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
                    echo title_case($key).':'.$value.'<br><hr>';
            }
            echo '</div>';
        }
        else echo $request->request;
    }
}
@endphp
