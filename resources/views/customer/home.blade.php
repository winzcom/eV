@extends('customer.layout.layout')

@section('content')

<!-- page title style6 START -->
<section class="page-title style2 " data-path="{{asset('img/headers/header4.jpg')}}">
	<div class="middle-align">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="strong text-uppercase">Home</h1>
				</div>
			</div>
		</div>
	</div>
	<a href="#content" class="arrow bounce" title="Scroll Down"><i class="fa fa-angle-down"></i></a>
</section>
<!-- page title style6 END -->


<!-- page content START -->
<div class="content" id="content">

	<!-- section START -->
		<section class="section half-section-right">
			
			<div class="container">

				<div class="work-process style1">
						<div class="process-wrap">
							<div class="icon-wrap">
								<span class="step">{{count($requests->where('replies','>',0)->all())}}</span>
								<i class="icon icon-coffee"></i>
							</div>
							<h3 class="title">Answered Requests</h3>
						</div>
						<div class="process-wrap">
							<div class="icon-wrap">
								<span class="step">{{count($requests->where('replies',0)->all())}}</span>
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
			<div class="row">
				<div class="col-lg-12">
					
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
							@include('app_view.shared.showfewrequestforclient',['all_requests'=>$requests])
						</div>
					</div>

				</div>
			</div>


			</div>
		</section>
	<!-- section END -->
	
</div>
<!-- page content END -->



@endsection