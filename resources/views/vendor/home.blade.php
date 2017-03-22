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
	<!-- section START -->
		<section class="section half-section-right">
			
			<div class="container">

				<div class="work-process style1" >
						<div class="process-wrap">
							<div class="icon-wrap">
								<span class="step">{{count($requests->where('rid','!=',null))}}</span>
								<i class="icon icon-coffee"></i>
							</div>
							<h3 class="title">Answered Requests</h3>
						</div>
						<div class="process-wrap">
							<div class="icon-wrap">
								<span class="step">{{count($requests->where('rid',null))}}</span>
								<i class="icon icon-web text-info"></i>
							</div>
							<h3 class="title">Unanswered Requests</h3>
						</div>
						<div class="process-wrap">
							<div class="icon-wrap">
								<span class="step">{{count($requests)}}</span>
								<i class="icon icon-coding text-danger"></i>
							</div>
							<h3 class="title">Total Requests</h3>
						</div>

				</div>
						
					<!-- tabs header START -->
					
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Reviews</a></li>
						<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Quotes</a></li>
						<li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Requests</a></li>
					</ul>
					
					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="home">
							@include('app_view.shared.display_review',['reviews'=>$reviews,'company_id'=>Auth::id()])
						</div>
						<div role="tabpanel" class="tab-pane" id="profile">
							@include('app_view.shared.showquotes',['quotes'=>$quotes])
						</div>
						<div role="tabpanel" class="tab-pane" id="messages">
							@include('app_view.shared.showfewrequests',['all_requests'=>$requests,'vendor_id'=>Auth::id()])
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