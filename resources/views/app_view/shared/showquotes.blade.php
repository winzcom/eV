<div id="accordion">

 @if(isset($quotes))
        @if(count($quotes) > 0)
            @foreach($quotes as $key=>$quote)
                <h4 class="well">
                 @if($key == 0)
                    
                    Quote for {{$quote->cat_name}} for {{$quote->fname}} {{$quote->lname}}
                @else
                   Quote for {{$quote->cat_name}} for {{$quote->fname}} {{$quote->lname}}
                @endif
                </h4>
                <div style="max-height:500px;">
                    Cost: {{$quote->cost}}
                                    Message: {{$quote->message}}
                                    <br><hr>
                                    @php 
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
                                            </div>
            @endforeach
        @endif
        
    @endif


</div>
