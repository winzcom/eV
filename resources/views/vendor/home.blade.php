@extends('vendor.layout.layout')

@section('content')

@include('app_view.requestForm.replyrequest')
<!-- page title style6 START -->
@include('vendor.header.header',['title'=>'Home '.Auth::user()->name])
<!-- page title style6 END -->

<!-- page content START -->
<div class="content" id="content">
	@if(!is_null(session('message')))
		<div id = "profile_update_message"></div>
	@endif
	
	@include('vendor.profile_update_snippet')
		
	<!-- section START -->
		<section class="section half-section-right">
			
			<div class="container">
				<!-- <label for="">I am not Available from --- to</label>
				<input type="date" name="from_date" id="from_date">&nbsp; <input type="date" name="to_date" id="to_date">
				<input type="button" value="set date" class="btn btn-success" id="set_offday_button"> -->
				<div class="work-process style1" >
						<div class="process-wrap">
							<div class="icon-wrap">
								<span class="step" id="answered_requests">{{count($requests->where('rid','!=',null))}}</span>
								<i class="icon icon-coffee"></i>
							</div>
							<h3 class="">Answered Requests</h3>
						</div>
						<div class="process-wrap">
							<div class="icon-wrap">
								<span class="step" id="unanswered_requests">{{count($requests->where('rid',null))}}</span>
								<i class="icon icon-web text-info"></i>
							</div>
							<h3 class="">Unanswered Requests</h3>
						</div>
						<div class="process-wrap">
							<div class="icon-wrap">
								<span class="step" id="total_requests">{{count($requests)}}</span>
								<i class="icon icon-coding text-danger"></i>
							</div>
							<h3 class="">Total Requests</h3>
						</div>

				</div>
				<!-- category requests details start-->
				<!--<div class="row">
					<div class="col-lg-3">
						<div class="thumbnail style1">
							<div class="thumb-wrapper">
								<div class="thumbs-carousel">
								{{--@foreach($categories_count as $key=>$cat_request)
									<div class="item">
										<h3>{{$key}} Requests Details</h3>
									</div>
								@endforeach--}}
								</div>						
							</div>
						</div>
					</div>
					
				</div>-->
				
				<!-- category requests details ends -->
				<!-- tabs header START -->
				
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Reviews</a></li>
					<!--<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Quotes</a></li>-->
					<li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Requests/Quotes</a></li>
				</ul>
				
				<!-- Tab panes -->
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="home">
						@include('app_view.shared.display_review',['reviews'=>$reviews,'company_id'=>Auth::id()])
					</div>
					
					<div role="tabpanel" class="tab-pane" id="messages">
						@include('app_view.shared.showfewrequests',['all_requests'=>$requests->take(5),'requests_count'=>$requests->count(),'vendor_id'=>Auth::id()])
					</div>
				</div>
			</div>
		</section>
	</div>
	<!-- section END -->
	

<!-- page content END -->

@endsection

@section('script')
<script src="{{asset('vendor/js/jaccordion/jquery-ui.min.js')}}"></script>

<script>
	$(document).ready(function(){
		$( "#accordion" ).accordion({
			collapsible: true,
			active:true
		});
		$("#request_accordion").accordion({
			collapsible:true
		})

		var s_message  = $('#profile_update_message');
		if(s_message.length > 0)
			alertify.success('Profile Updated');
	})
	

</script>
@endsection