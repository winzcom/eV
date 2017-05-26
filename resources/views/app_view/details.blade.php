@extends('layouts.applayout')


@section('content')
<style>
       #map {
        height: 400px;
        width: 100%;
       }
	   #reviews{
		   max-height:500px;
		   overflow-y:scroll;
	   }

    </style>
 @include('app_view.requestForm.requestform',['category_id'=>$cat_id])
 
 @if(Auth::guard('client')->check())
	@include('app_view.requestForm.review_form',
				['reviewers_name'=>Auth::guard('client')->user()->first_name.Auth::guard('client')->user()->last_name,
				'reviewers_email'=>Auth::guard('client')->user()->email,
				'review_for'=>$company->id
				]
		)
 @endif
 <div id="start_request">
 	<input type="hidden" value="{{$company->state}}"/>
	 	<input type="hidden" value="{{$company->vicinity_id or ''}}">
</div>
<!-- page title style6 START -->
<section class="page-title style3" data-path="{{asset('img/headers/header12.jpg')}}">

	<div class="bottom-align">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="strong text-uppercase" id="company_name">{{$company->name}}</h1>
					<ol class="breadcrumb">
					  
						<li><a href="{{url('/')}};"><i class="fa fa-home"></i></a></li>
						<li class="active">Get Quote from {{$company->name}} and Similar Vendors
						for {{$category_name}}
						</li>
					</ol>
					
				</div>
				<button type="submit" 
                    class="btn btn-primary btn-lg btn-block start"
                    data-toggle="modal" data-target="#myModal"
					id="start"
					data-state="{{$company->state}}",
					data-vicinity="{{$company->vicinity_id}}"
                >
                        Start
                </button>
			</div>
		</div>
	</div>
</section>
<!-- page title style6 END -->



<!-- page content START -->
<div class="content" id="content">
	
	<!-- section START -->
		<section class="section">
			<div class="container">
            
				<div class="row">
					<div class="col-lg-5">
						
						<div class="product-images">
							<div id="cloudslider" class="product-gallery">
								@if($company->galleries->count() > 0)
								
									@foreach($company->galleries->take(2) as $gallery)
										<div class="kr-sky" data-duration="5000">
											<img class="sky-background" src="{{$path}}/{{$gallery->image_name}}" alt="product title">								
										</div>
									@endforeach
									
								@else
								
									<div class=" kr-sky"></div>
								@endif
								<!--<div class="kr-sky" data-duration="5000">
									<img class="sky-background" src="{{asset('img/shop/p2.jpg')}}" alt="product title">								
								</div>
					
								<div class="kr-sky" data-duration="5000">
									<img class="sky-background" src="{{asset('img/shop/p3.jpg')}}" alt="">								
								</div>
					
								<div class="kr-sky" data-duration="5000">
									<img class="sky-background" src="{{asset('img/shop/p4.jpg')}}" alt="">								
								</div>
					
								<div class="kr-sky" data-duration="5000">
									<img class="sky-background" src="{{asset('img/shop/p5.jpg')}}" alt="">								
								</div>
					
								<div class="kr-sky" data-duration="5000">
									<img class="sky-background" src="{{asset('img/shop/p6.jpg')}}" alt="">								
								</div>
					
								<div class="kr-sky" data-duration="5000">
									<img class="sky-background" src="{{asset('img/shop/p7.jpg')}}" alt="">								
								</div>
					
								<div class="kr-sky" data-duration="5000">
									<img class="sky-background" src="{{asset('img/shop/p8.jpg')}}" alt="">								
								</div>
					
								<div class="kr-sky" data-duration="5000">
									<img class="sky-background" src="{{asset('img/shop/p9.jpg')}}" alt="">								
								</div>-->
							</div>
						</div><!--product-images-->
					</div>
					<div class="col-lg-7">
						<h5 class="h1">{{$company->summary}}</h5>
							<!--<div class="star-rating inline-block">
								<i class="livicon" data-name="star-full" data-onparent="false" data-color="#f4c41c" data-hovercolor="#f4c41c" data-size="24"></i>
								<i class="livicon" data-name="star-full" data-onparent="false" data-color="#f4c41c" data-hovercolor="#f4c41c" data-size="24"></i>
								<i class="livicon" data-name="star-full" data-onparent="false" data-color="#f4c41c" data-hovercolor="#f4c41c" data-size="24"></i>
								<i class="livicon" data-name="star-half" data-onparent="false" data-color="#f4c41c" data-hovercolor="#f4c41c" data-size="24"></i>
								<i class="livicon" data-name="star-empty" data-onparent="false" data-color="#f4c41c" data-hovercolor="#f4c41c" data-size="24"></i>
							</div>-->
							<div class="rating" data-rating="{{$company->reviews->avg('rating')}}" id="rating"></div>
							<span class="reviews-link">( <a href="javascript:void(0);" title="customers reviews">{{count($company->reviews)}} Customer reviews</a> )</span>
							<!--<h3 class="price"><del><span class="amount">$375.00</span></del> <ins><span class="amount">$299.00</span></ins></h3>-->
							<div class="row">
				<div class="col-lg-12">
					
					<div id="horizontalTab1">
						<ul class="resp-tabs-list hor_1">
							<li>Description</li>
							<li>Reviews</li>
							<li>Map</li>
						</ul>
						<div class="resp-tabs-container hor_1">
							<div>
								<h3>{{$company->summary}}</h3>
									{{$company->description}}
							</div>
							<div id="reviews">
								@include('app_view.shared.display_review',['reviews'=>$company->reviews,'company_id'=>$company->id])
							</div>
							<div>
								<div id="map">
								
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
							
							<div class="row">
								
							</div>
							<div class="row">
								<!--<div class="col-lg-6">
									<button class="btn btn-primary btn-lg btn-icon"><i class="livicon" data-name="shopping-cart" data-color="#fff" data-hovercolor="false" data-size="24"></i> Add to Cart</button>
								</div>-->
							</div>
							<hr class="spacer-40">
							<div class="product-cat">
								<span class="strong small text-uppercase">Categories</span>: {{$company->categories()->pluck('name')}}<br><hr>
								<span class="strong small text-uppercase">Address</span>:<p id= "address">
								{{$company->house_no}} {{$company->street_name}} {{$company->state}}</p>
							</div>
					</div>
				</div>
			</div>
		</section>
		<section class="section gray-bg">
			
		</section>
	<!-- section END -->
	
	<!-- section START -->
		<!--<section class="section img-bg half-section" data-path="img/shop/big-offer.jpg">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-sm-8 col-lg-offset-6 col-sm-offset-4">
						<div class="overlay light text-center">
							<h2 class="slide-title">Big Offer</h2>
							<hr class="spacer-20">
							<div class="star-rating inline-block">
								<i class="livicon" data-name="star-full" data-onparent="false" data-color="#f4c41c" data-hovercolor="#f4c41c" data-size="24"></i>
								<i class="livicon" data-name="star-full" data-onparent="false" data-color="#f4c41c" data-hovercolor="#f4c41c" data-size="24"></i>
								<i class="livicon" data-name="star-full" data-onparent="false" data-color="#f4c41c" data-hovercolor="#f4c41c" data-size="24"></i>
								<i class="livicon" data-name="star-half" data-onparent="false" data-color="#f4c41c" data-hovercolor="#f4c41c" data-size="24"></i>
								<i class="livicon" data-name="star-empty" data-onparent="false" data-color="#f4c41c" data-hovercolor="#f4c41c" data-size="24"></i>
							</div>
							<h3 class="price"><del><span class="amount">$375.00</span></del> <ins><span class="amount">$299.00</span></ins></h3>
							<p class="lead alt-font">Etiam placerat commodo feugiat. Proin in quam erat. Duis sed porttitor magna, a laoreet enim.</p>
							<a class="btn btn-primary btn-lg btn-icon"><i class="livicon" data-name="shopping-cart" data-color="#fff" data-hovercolor="false" data-size="24"></i> Shop Now</a>
						</div>						
					</div>
				</div>
			</div>
		</section>-->
	<!-- section END -->
	
	<!-- section START -->
	
	<!-- section END -->

</div>
<!-- page content END -->


@endsection


@section('script')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB7SGP6giYEwQUUJXWbBffqhe9AIbp1ciY&callback=initMap"
        async defer>
</script>
<script src="{{asset('jss/custom/map.js')}}"></script>
<script>
$(document).ready(function(){

	$('#rate').rateYo({
			fullStar:true,
			starWidth:"20px",
			onSet:function(rating, rateYoInstance){
				$('#rating').val(rating);
			}
		})

	$('.rating').each(function(i,e){
		var self = $(this);
		var rating = self.data('rating');
		if(!isNaN(rating) && rating !== null && rating !== ''){
			self.rateYo({
			rating:rating,
			readOnly:true,
			starWidth:"20px"
		})
	  }
		
	})
})

	
</script>
@endsection