<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

 @if(isset($quotes))
        @if(count($quotes) > 0)
            @foreach($quotes as $key=>$quote)
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading{{$key}}">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}">
                                @if($key == 0)
                        
                                    Quote for {{$quote->cat_name}} for {{$quote->fname}} {{$quote->lname}}
                                @else
                                    Quote for {{$quote->cat_name}} for {{$quote->fname}} {{$quote->lname}}
                                @endif
                            </a>
                        </h4>
                    </div><!-- panel-heading-->
            
                <div id="collapse{{$key}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading{{$key}}">
                    <div class="panel-body">
                    
                                        
                                        @php 

                                        echo 'Cost:'. $quote->cost;
                                        echo 'Message:'. $quote->message;
                                        echo '<br><hr>';
                                        $ob = json_decode($quote->qrequest);
                                        $isobject =  is_object($ob) ? true :false;
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
                                    else echo $quote->qrequest;
                                    @endphp
                                                        <br><hr>
                                </div><!--panel-body-->
                        </div><!--panel-collapse collapse in-->
                    </div><!--panel-default-->
            @endforeach
        @endif
        
    @endif


</div>


