@inject('service','App\Service\Service')

@php 

if(count($all_requests) > 0){
    echo '<div>';
    foreach($all_requests as $request){
        if(true) {

            $rid = !is_null($request->rid) ? $request->rid : null;
            $ob = json_decode($request->request);
            $isobject =  is_object($ob) ? true :false;
            echo '<h3>';
            if(!is_null($rid)){ 
                echo '<i class="fa fa-check-circle-o"></i>&nbsp';
            }
            echo 'request from '.$request->client_name.' for '.$cats->where('id',$request->category_id)->first()->name.' on '.date('D jS M Y',strtotime($request->created_at)).'</h3>';
            echo (int)$request->count_available_vendors !== 0 ? '<h5><i>(sent to '.((int)$request->count_available_vendors-1).' other vendors)</i></h5>':'';
            $num = $rid ? ((int)$request->crid-1) : (int)$request->crid;
            echo '<div>';
            /*echo "<a href='show_quotes/$request->id'>
            <button type='' class='btn btn-info btn-sm show_others_quotes'>
                Show Quotes from Others($num)
            </button></a> &nbsp;";*/
            if(is_null($rid) && !isset($customer)){
                if($isobject){
                    if(strtotime($ob->date)>strtotime(date('Y-m-d'))){
                    echo "<button class='btn btn-success btn-xs request' id='reply' data-toggle='modal'
                        data-target='#reply_request' data-rid = '$request->id'
                        data-cid = '$request->client_id'
                    >
                        Reply
                        
                    </button>
                    <button class='btn btn-danger btn-xs request dismiss' data-rid = '$request->id'
                        data-cid = '$request->client_id'
                        
                    >
                        Ignore
                        
                    </button>
                    <br><br>";
                }
                else 
                    echo "<div class='row'><div class='alert alert-warning col-sm-4'>Event Schedule Date has Passed</div>
                    <div class='col-sm-6'><button class='btn btn-danger btn-sm col-md-4 request dismiss' data-rid = '$request->id'
                        data-cid = '$request->client_id'>
                        Dismiss
                        
                    </button></div></div>";
                }
            }
            else{
                    $cost = $service->currencyFormatter($request->cost);
                    echo "<button class='btn btn-success btn-xs request' id='reply' data-toggle='modal'
                        data-target='#reply_request' data-message = '$request->message'
                        data-cost ='$cost' data-uid = '$vendor_id' data-dp='$request->dp'
                    >
                        Show Quote
                    </button>
                    &nbsp;Highest Cost: ".$service->currencyFormatter($request->max_cost).
                    " Lowest Cost: ".$service->currencyFormatter($request->min_cost)." <br>Average: ".
                    $service->currencyFormatter($request->avg_cost)."
                    </i> from you and ".((int)$request->crid-1)." other(s)<br><br>";
            }
            if($isobject){
                $pm = null;
                echo '<div class="row list-group" style="padding:10 0 0 10px;">';
                foreach($ob as $key=>$value){
                    echo '<div class="col-xs-6 col-md-4 list-group-item list-group-item-action" style="padding-bottom:10px;">';
                    if($key !== 'personal_message'){
                                if(is_array($value)){
                                    if($key == 'my_budget'){
                                        echo str_replace('_',' ',title_case($key));
                                        echo ': &#8358;'.$service->currencyFormatter($value[0]).'- &#8358;'.$service->currencyFormatter($value[1]);
                                    }else {
                                        echo $key == 'extra'? 'Extras: (': ucwords($key).': (';
                                        echo implode(",",$value);
                                        echo ' )';
                                    }
                                    
                                }elseif($key == 'date' && $value !== ''){
                                    $dt = \Carbon\Carbon::parse($value);
                                    echo 'Date:'.$dt->toFormattedDateString();
                                } elseif($key == 'price_range' || $key == 'my_budget') {
                                            
                                            list($lower, $higher) = explode('-',$value);
                                            echo str_replace('_',' ',title_case($key)).': &#8358;'.
                                            $service->currencyFormatter($lower).'- &#8358;'.$service->currencyFormatter($higher);

                                }
                                elseif($key == 'budget') {
                                    echo str_replace('_',' ',title_case($key));
                                    echo ': &#8358;'.$service->currencyFormatter($value);
                                    echo '<br><hr>';
                                }
                                else
                                    echo str_replace('_',' ',title_case($key)).':'.$value;
                    }else{
                        $pm = '<br><hr><textarea disabled class="form-control input-md">'.$value.'</textarea>';
                    }
                    echo'</div>';
                }
                echo $pm.'</div>';
            }
            else echo $request->request;
        }
        
    }
}
@endphp
@if(isset($requests_count))
    @if($requests_count > $all_requests->count())
         <a href="{{url('/requests')}}" class="btn btn-default">View all</a>
    @endif
@endif
