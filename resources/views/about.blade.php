@extends('layouts.applayout')

@section('style')
<style>
	.card {
    /* Add shadows to create the "card" effect */
		box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
		transition: 0.3s;
		margin:10px 10px 10px 10px;
		padding:5px 10px 5px 5px;
	}

	/* On mouse-over, add a deeper shadow */
	.card:hover {
		box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
	}

	/* Add some padding inside the card container */
	.container {
		padding: 2px 16px;
	}
</style>

@endsection


@section('content')
<!-- page title style1 START -->
<section class="page-title style1" data-path="{{asset('img/headers/header7.jpg')}}">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="strong">About Us</h1>
			</div>
		</div>
	</div>
</section>
<!-- page title style1 END -->
    <div class="">
		<div class="row">
			<div class="col-md-4 col-sm-6 col-xs-12 col-lg-4">
				<div class="card">
					<div class="list-group-item list-group-item-info">
						<h4>Who we are</h4>
						We pride ourselves on being able to apply our creativity 
						to every brief to deliver the right message. 
						Ready to take advantage of this service and work with clients?
					</div>
					
				</div>
				
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12 col-lg-4">
				<div class="card">
					<div class="list-group-item list-group-item-warning">
						<h4>Why EventPad</h4>
							To complement your effort in getting new customers, 
							Eventpad makes it possible for Individuals and Event Organizers to reach out to you when in need of your service. 
							This works by the making requests from individuals 
							and event organizers accessible to you You can then decide 
							to respond to them provided you are interested in making them your customers
					</div>
					</div>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12 col-lg-4">
				<div class="card">
					<div class="list-group-item list-group-item-success">
						<h4>Benefits</h4>
						<ul>
							<li class="">More user outreach as you receive request based on your service and location</li>
							<li class="">No need to worry about been on top listing or first page of listing.</li>
							<li class="">Can reply to user reviews about your service</li>
						</ul>
					</div>
					
				</div>
				
			</div>
		</div>
		<div class="card">
			<h4>Contact Us</h4>
			email: (info@eventpad.ng)
			phone: (09020628153)
		</div>
    </div>
@endsection