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
								<span class="step">{{count($requests->where('reply','!=',0)->all())}}</span>
								<i class="icon icon-coffee"></i>
							</div>
							<h3 class="title">Answered Requests</h3>
						</div>
						<div class="process-wrap">
							<div class="icon-wrap">
								<span class="step">{{count($requests->where('reply',0)->all())}}</span>
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
					
					<div id="horizontalTab1">
						<ul class="resp-tabs-list hor_1">
							<li>Reviews</li>
							<li>Requests</li>
							<li>Quotes</li>
						</ul>
						
						<div class="resp-tabs-container hor_1">
							
								<div>
									
								</div>
								<div>
									@include('app_view.shared.showfewrequestforclient')
								</div>
								<div>
								</div>
							<!--</div>--><!-- panel-group accordion style1-->
						</div><!-- resp-tabs-container hor_1-->
						
					</div><!-- horizontalTab1 -->

				</div>
			</div>


			</div>
		</section>
	<!-- section END -->
	
</div>
<!-- page content END -->



@endsection