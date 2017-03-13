

<div class="panel-group toggle style2" id="toggle" role="tablist" aria-multiselectable="true">
    @if(isset($quotes))
        @if(count($quotes) > 0)
            @foreach($quotes as $key=>$quote)

                <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading{{$key}}">
                <h4 class="panel-title">
                 @if($key == 0)
                    <a class="active" data-toggle="collapse" href="#toggle{{$key}}" aria-expanded="true" aria-controls="toggle{{$key}}">
                    Quote for {{$quote->cat_name}} for {{$quote->fname}} {{$quote->lname}}
                @else
                    <a class="collapsed" data-toggle="collapse" href="#toggle{{$key+1}}" aria-expanded="true" aria-controls="toggle{{$key}}">
                    Quote for {{$quote->cat_name}} for {{$quote->fname}} {{$quote->lname}}
                @endif
                </a>
                </h4>
            </div>
                @if($key == 0)
                    <div id="toggle{{$key}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading{{$key}}">
                @else
                    <div id="toggle{{$key}}" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading{{$key}}">
                @endif
                <div class="panel-body">
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
            </div>
        </div>

            @endforeach
            
        @endif
        
    @endif
</div><!-- toggle-->



