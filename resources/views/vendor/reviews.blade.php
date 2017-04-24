@extends('vendor.layout.layout')

@section('customstyle')

<style>
    .filter{
        display:inline;
        
    }
    .filter_active{
        background-color:black;
        color:white;
        text-decoration:none;
    }

    .glyphicon-star{
       color:#DAA520;
    }
    
</style>

@endsection

@section('content')

<?php $i = 0;?>
<?php $j = 1;?>
    <!-- page title style6 START -->
@include('vendor.header.header',['title'=>'Review'])
 @include('vendor.profile_update_snippet')
<!-- page title style6 END -->

    <div class="container-fluid">
        <div class="content">
           
            @if($reviews->count() > 0)
            <div class="header">
                                
             <h5 class="title">@include('app_view.shared.review_filter_tab',['total'=>$total,'avg'=>$avg])</h5> 
            </div>
            <div class="table-responsive">
               <table  class="table table-striped  table-bordered table-hover">
                        <tr>
                            <th>#</th>
                            <th>Reviewer's Name</th>
                        
                            <th>Rating</th>
                            <th>Review Date</th> 
                            <th>Review</th>
                            <th>Reply</th>
                        </tr>
                    
                    @foreach($reviews as $key=>$review)
                        <tr>
                            <td>
                               @php
                               
                                    if($page !== null && $page !== '1'){
                                       
                                       
                                        $num = ((int)($page*$pagination)-$pagination+$j);
                                        
                                        ++$j;
                                        echo $num;
                                        
                                    }
                                    else echo $j++;
                            @endphp
                            </td>
                            <td>{{$review->reviewers_name}}
                             @if($review->reply == null) 
                                <small>
                                   <i>

                                   <button class="btn btn-success btn-xs review_reply" id="reply" data-toggle="modal" 
                                            data-target="#reply_review" 
                                            data-name = "{{$review->reviewers_name}}" 
                                            data-id="{{$review->id}}"
                                    >
                                            Reply
                                            
                                        </button>
                                        
                                    </i>
                                </small>
                            @endif
                            </td>
                            
                            <td  width="8%">
                                <?php 
                                
                                $count = $review->rating;
                                for($i=0;$i<$count;$i++){
                                        
                                            echo  '<span class="glyphicon glyphicon-star"></span>';
                             
                                }            
                    ?>
                            </td>
                            <td>{{$review->created_at->toFormattedDateString()}}</td> 
                            <td>{{$review->review}}</td>
                            <td class="reply" data-id="{{$review->id}}">{{$review->reply or ''}}</td>
                        </tr>
                    @endforeach
                    </table>
                </div>
 @include('app_view.shared.reply_from')
                
                {{$reviews->links()}}

            @else
               @include('app_view.shared.review_filter_tab')
                <div class="alert alert-success">No Reviews</div>
            @endif
        </div>
       
    </div>

@endsection

@section('js')

@endsection