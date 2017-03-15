


@if(!Auth::check())
    @if(Auth::guard('client')->check())
       @php 
            if(!in_array(Auth::guard('client')->user()->email,$reviews->pluck('reviewers_email')->all())
                && !in_array($company->id,$reviews->pluck('reviews_for')->all())
            ){
                echo "<button class='btn btn-default btn-sm' data-toggle='modal' data-target='#write_review'>
                        Write A Review
                    </button>";
            }
       @endphp
        
    @else
        <a href="{{url('/culogin')}}"><button class="btn btn-default btn-sm">Login To Write a Review</button></a>
    @endif
@endif

<span>Average Rating {{number_format($reviews->avg('rating'),1)}}/5<span>
                    @foreach($reviews as $review)
                        <h4>
                            {{$review->reviewers_name}} 
                            
                        </h4><span><?php 
                                
                                $count = $review->rating;
                                for($i=0;$i<$count;$i++){
                                        
                                            echo  '<span class="glyphicon glyphicon-star"></span>';
                             
                                }

                                if($count<5){
                                    for($j=0;$j<5-$count;$j++){
                                        
                                            echo  '<span class="glyphicon glyphicon-star-empty"></span>';
                             
                                     }
                                }
                            
                    ?></span> &nbsp;@if($review->created_at !== null){{$review->created_at->toFormattedDateString()}}@endif
                        <p>{{$review->review}}</p>
                            @if($review->reply !== null)
                                
                                    @if($review->reply !== '')
                                        <div class="well">
                                         <small>Supplier's Reply</small></br>
                                            <i>{{$review->reply or ''}}</i>
                                        </div>
                                    @endif
                            @endif
                            <hr>
                    @endforeach