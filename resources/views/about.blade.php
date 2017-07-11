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
		<div class="">
			<div class="">
				<h1 class="strong">About Us</h1>
			</div>
		</div>
	</div>
</section>
<!-- page title style1 END -->
    <div class="">
		<div class="">
			<div class="">
				<div class="card">
					<div class="list-group-item">
						<h4>Who we are</h4>
						We pride ourselves on being able to apply our creativity 
						to every brief to deliver the right message. 
						Ready to take advantage of this service and work with clients?
					</div>
					
				</div>
				
			</div>
			<div class="">
				<div class="card">
					<div class="list-group-item">
						<h4>Why EventPad</h4>
							To complement your effort in getting new customers, 
							Eventpad makes it possible for Individuals and Event Organizers to reach out to you when in need of your service. 
							This works by the making requests from individuals 
							and event organizers accessible to you You can then decide 
							to respond to them provided you are interested in making them your customers
					</div>
					</div>
			</div>
			<div class="">
				<div class="card">
					<div class="list-group-item">
						<h4>Benefits</h4>
						<ul>
							<li class="">More user outreach as you receive request based on your service and location</li>
							<li class="">No need to worry about been on top listing or first page of listing.</li>
							<li class="">Can reply to user reviews about your service</li>
						</ul>
					</div>
					
				</div>
				
			</div>
			<div class="">
				<div class="card">
					<div class="list-group-item">
						<h4>How it works</h4>
							<h5>Each request received will contain the following</h5> 
								<ol>
									<li>	The category ( i.e the service needed like catering, drinks )</li>

									<li>	The type of event to be organized</li>

									<li>	The event date</li>

									<li>	The start time (i.e time the service will be required)</li>

									<li>	May contain number of hours your service is needed</li>

									<li>	The event venue</li>

									<li>	The estimated number of guest</li>

									<li>	Their budget</li>

									<li>	The stage of the request (i.e are they looking book immediately or just interested in quotes)</li>

									<li>	Additional message regarding the service they need</li>

									<li>	The customers first name and last name</li>
								</ol>

    					<p>The request may also contain some additional information pertaining to the service the client selects.</p>
						<p>A sample request is shown below.</p><br>
						<img src="https://eventpad.ng/img/sample_request.JPG" alt="">

					</div>
					</div>
			</div>
			<div class="">
				<div class="card">
					<div class="list-group-item">
						<p>
							With this information you can then reply with your quotes that should contain the following
						</p>

						<ol>
							<li>	Your estimated cost </li>

							<li>	Your down payment in percentage (optional) e.g 2%</li>

							<li>	Your message that will contain a cost break-down and/or a recommendation to the customer</li>
						</ol>

					</div>
					
				</div>
				
			</div>
		</div>
		<div class="card">
			<h4 style="padding-left:10px;">For more information you can contact Us</h4>
			<div style="padding-left:10px;">
				email: (info@eventpad.ng)
				phone: (09020628153)
			</div> 
		</div>
    </div>
@endsection