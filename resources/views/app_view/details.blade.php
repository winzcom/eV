@extends('layouts.applayout')


@section('content')

 @include('app_view.requestForm.requestform',['category_id'=>$cat_id])
 
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
					<h1 class="strong text-uppercase">{{$company->name}}</h1>
					<ol class="breadcrumb">
					  
						<li><a href="{{url('/')}};"><i class="fa fa-home"></i></a></li>
						<li class="active">Get Quote from {{$company->name}} and Similar Vendors</li>
					</ol>
					
				</div>
				<button type="submit" 
                    class="btn btn-primary btn-lg btn-block start"
                    data-toggle="modal" data-target="#myModal"
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
								<div class="kr-sky" data-duration="5000">
									<img class="sky-background" src="img/shop/p2.jpg" alt="product title">								
								</div>
					
								<div class="kr-sky" data-duration="5000">
									<img class="sky-background" src="img/shop/p3.jpg" alt="">								
								</div>
					
								<div class="kr-sky" data-duration="5000">
									<img class="sky-background" src="img/shop/p4.jpg" alt="">								
								</div>
					
								<div class="kr-sky" data-duration="5000">
									<img class="sky-background" src="img/shop/p5.jpg" alt="">								
								</div>
					
								<div class="kr-sky" data-duration="5000">
									<img class="sky-background" src="img/shop/p6.jpg" alt="">								
								</div>
					
								<div class="kr-sky" data-duration="5000">
									<img class="sky-background" src="img/shop/p7.jpg" alt="">								
								</div>
					
								<div class="kr-sky" data-duration="5000">
									<img class="sky-background" src="img/shop/p8.jpg" alt="">								
								</div>
					
								<div class="kr-sky" data-duration="5000">
									<img class="sky-background" src="img/shop/p9.jpg" alt="">								
								</div>
							</div>
						</div>
						
					</div>
					<div class="col-lg-7">
						<h2 class="h1">{{$company->summary}}</h2>
							<div class="star-rating inline-block">
								<i class="livicon" data-name="star-full" data-onparent="false" data-color="#f4c41c" data-hovercolor="#f4c41c" data-size="24"></i>
								<i class="livicon" data-name="star-full" data-onparent="false" data-color="#f4c41c" data-hovercolor="#f4c41c" data-size="24"></i>
								<i class="livicon" data-name="star-full" data-onparent="false" data-color="#f4c41c" data-hovercolor="#f4c41c" data-size="24"></i>
								<i class="livicon" data-name="star-half" data-onparent="false" data-color="#f4c41c" data-hovercolor="#f4c41c" data-size="24"></i>
								<i class="livicon" data-name="star-empty" data-onparent="false" data-color="#f4c41c" data-hovercolor="#f4c41c" data-size="24"></i>
							</div>
							<span class="reviews-link">( <a href="javascript:void(0);" title="customers reviews">17 Customer reviews</a> )</span>
							<!--<h3 class="price"><del><span class="amount">$375.00</span></del> <ins><span class="amount">$299.00</span></ins></h3>-->
							<p>
								{{$company->description}}
							</p>
							
							<div class="row">
								
							</div>
							<div class="row">
								<!--<div class="col-lg-6">
									<button class="btn btn-primary btn-lg btn-icon"><i class="livicon" data-name="shopping-cart" data-color="#fff" data-hovercolor="false" data-size="24"></i> Add to Cart</button>
								</div>-->
							</div>
							<hr class="spacer-40">
							<div class="product-cat">
								<span class="strong small text-uppercase">Categories</span>: {{$company->categories()->pluck('name')}}
							</div>
					</div>
				</div>
			</div>
		</section>
		<section class="section gray-bg">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<h5 class="page-header">Related Vendors</h5>
						<div class="cbp-panel">
					
							<div  class="cbp related-products">
								@foreach($similars as $sim)

									<div class="cbp-item motion print">
									<div class="thumbnail product">
										<div class="thumb-wrapper">
											<a href="{{url('/detail/')}}/{{$sim->name_slug}}" title="Single product">
												<img src="{{asset('img/shop/p1.jpg')}}" class="img-one" alt="Thumbnail">
												<img src="{{asset('img/shop/p1-alt.jpg')}}" class="img-two" alt="Thumbnail">
												<!--<span class="sale">Sale!</span>-->
											</a>
											<div class="controls">
												<a href="{{url('/detail/')}}/{{$sim->name_slug}}" class="view-details" title="View details" data-toggle="tooltip" data-placement="right"><i class="livicon" data-name="list" data-color="#fff" data-hovercolor="#fff" data-size="22"></i></a>
												<!--<a href="javascript:void(0);" class="add-to-cart" title="Add to cart" data-toggle="tooltip" data-placement="right"><i class="livicon" data-name="shopping-cart" data-color="#fff" data-hovercolor="#fff" data-size="22"></i></a>-->
												<a href="javascript:void(0);" class="like-this" title="Like this" data-toggle="tooltip" data-placement="right"><i class="livicon" data-name="heart" data-color="#fff" data-hovercolor="#fff" data-size="22"></i></a>
											</div>
										</div>
										<div class="caption">
											<h3><a href="{{url('/detail/')}}/{{$sim->name_slug}}" title="Single Product">{{$sim->name}}</a></h3>
											<div class="product-cat">
												<span class="strong small text-uppercase">Categories</span>: {{$sim->categories()->pluck('name')}}
											</div>
											
											<div class="star-rating">
												<i class="livicon" data-name="star-full" data-onparent="false" data-color="#f4c41c" data-hovercolor="#f4c41c" data-size="18"></i>
												<i class="livicon" data-name="star-full" data-onparent="false" data-color="#f4c41c" data-hovercolor="#f4c41c" data-size="18"></i>
												<i class="livicon" data-name="star-full" data-onparent="false" data-color="#f4c41c" data-hovercolor="#f4c41c" data-size="18"></i>
												<i class="livicon" data-name="star-half" data-onparent="false" data-color="#f4c41c" data-hovercolor="#f4c41c" data-size="18"></i>
												<i class="livicon" data-name="star-empty" data-onparent="false" data-color="#f4c41c" data-hovercolor="#f4c41c" data-size="18"></i>
											</div>
										</div>
									</div>
								</div><!-- cbp-item motion print-->

								@endforeach
								
								
							</div><!-- Class cbp related-products-->
					
						</div><!-- Panel-->
					</div>
				</div>
			</div>
		</section>
	<!-- section END -->
	
	<!-- section START -->
		<section class="section img-bg half-section" data-path="img/shop/big-offer.jpg">
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
		</section>
	<!-- section END -->
	
	<!-- section START -->
	
	<!-- section END -->

</div>
<!-- page content END -->


@endsection