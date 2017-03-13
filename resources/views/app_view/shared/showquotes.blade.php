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
                                    @if(is_object(json_decode($quote->qrequest)))
                                
                                    @foreach(json_decode($quote->qrequest) as $key=>$value)
                                        @php
                                            if(is_array($value)){
                                                echo 'Additional Services ( ';
                                                foreach($value as $val){
                                                    echo $cats->where('id',$val)->first()->name;
                                                }
                                                echo ' )<br><br>';
                                                continue;
                                            } 
                                        @endphp
                                        {{title_case($key)}} : {{$value}}<hr>
                                        
                                    @endforeach
                                
                                @else
                                
                                    {{$quote->qrequest}}
                                @endif
                        <br><hr>
                </div>

            @endforeach
            
        @endif
        
    @endif


</div>
