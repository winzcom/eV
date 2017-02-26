<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>tempo - An Ultimate Website Template</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon" href="apple-touch-icon.png">
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
	
	<!-- style.css is main stylesheet and all other sylesheets are being
		 imported in this file. -->

	<link rel="stylesheet" href="{{asset('style.css')}}">
	<link rel="stylesheet" href="{{asset('vendor/css/eazy.css')}}">
	

	<script src="{{asset('js/vendor/modernizr-2.8.3-respond-1.4.2.min.js')}}"></script>
	
</head>
<body data-spy="scroll" data-target=".navscroll">
@include('app_view.requestForm.requestform',['events'=>$events])
	<!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
	

<!-- preloader START -->
<div class="preloader">
	<div class="spinner-wrap">
		<div class="spinner spinner-wave">
			<div class="rect1"></div>
			<div class="rect2"></div>
			<div class="rect3"></div>
			<div class="rect4"></div>
			<div class="rect5"></div>
		</div>
	</div>
</div>
<!-- preloader END -->


<!-- main navigation START -->
<nav class="navbar navbar-custom transparent-nav navbar-fixed-top mega-menu" role="navigation">
	<div class="container">
	
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.html"><img src="{{asset('img/logos/tempo-dark.png')}}" alt="tempo"></a>
		</div>		
	
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navscroll" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#">Home</a></li>
				<li><a href="#">Browse Vendors</a></li>
				<li><a href="#">Request Quotes</a></li>
				<li><a href="#">Sign In</a></li>
				<li><a href="#">Join as Vendor</a></li>
			</ul>
		</div><!-- /.navbar-collapse -->
		
	</div><!-- /.container -->
</nav>
<!-- main navigation END -->


<!-- page content START -->
<div class="content" id="content">

	<!-- intro section START -->
	<section class="landing-intro horizontal-form" id="home">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<section class="form-elements">
						<p class="slide-sub-title light-color wow fadeInUp" data-wow-delay="0.5">Receive Tailored Quotes from  vendors round you with a single request.</p>
						<h3 class="slide-title light-color wow fadeInUp" data-wow-delay="1s">eVenting</h3>
						<div class="form-wrapper">
							<form id = "start_request">
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control input-lg" id="yourName" placeholder="State" required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control input-lg" id="yourEmail" placeholder="Locality" required>
										</div>
									</div>
									<!--<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control input-lg" id="yourProfession" placeholder="Category">
										</div>
									</div>-->
									<div class="col-md-3">
										<button type="submit" 
											class="btn btn-primary btn-lg btn-block start"
											data-toggle="modal" data-target="#myModal"
										>
												Start
										</button>
									</div>
								</div>
							</form>
						</div>
					</section>
					<small class="form-disclaimer light-color"><strong></strong></small>
				</div>
			</div>
		</div>
		
		<a href="#features" class="arrow bounce" title="Scroll Down"><i class="fa fa-angle-down"></i></a>
		
	</section>
	<!-- intro section END -->
	
	<!-- section START -->
	<section class="section" id="features">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2 text-center">
					<div class="section-header">
						<i class="icon-briefcase wow fadeInUp" data-wow-delay="0.5s"></i>
						<h1>How it works</h1>
						<p class="lead em">Giving you a better vendor sourcing experience</p>
					</div>
					
					<!-- optional spacer classes "spacer-10" "spacer-20" "spacer-30" upto "spacer-80" -->
					<hr class="spacer-30">
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="icon-box style7">
						<i class="livicon" data-name="umbrella" data-color="#2ECC71" data-hovercolor="false" data-size="48" data-onparent="true"></i>
						<h4 class="box-title strong">Make a request</h4>
						<p>Make a request with our simple form flow</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="icon-box style7">
						<i class="livicon" data-name="sitemap" data-color="#F1C40F" data-hovercolor="false" data-size="48" data-onparent="true"></i>
						<h4 class="box-title strong">Receive Quotes</h4>
						<p>Receive quotes from Vendors</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="icon-box style7">
						<i class="livicon" data-name="star-full" data-color="#E74C3C" data-hovercolor="false" data-size="48" data-onparent="true"></i>
						<h4 class="box-title strong">Compare</h4>
						<p>Compare prices from  vendors and hire the best</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- section END -->
	
	<!-- section START -->
		
	<!-- section END -->
	
	<!-- section START -->
		<!--<section class="section half-section-left">
			<div class="section-bg bg6 hidden-xs">
				<a title="How we doing" class="nivo-lightbox play-btn cbutton cbutton--effect-ivana wow fadeInUp" data-wow-delay="0.5s" href="http://vimeo.com/70301553"><i class="fa fa-play"></i></a>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-sm-6 col-sm-offset-6">
						<div class="overlay">
							<h2>Section with video block on left</h2>
							<p class="lead alt-font">Etiam placerat commodo feugiat. Proin in quam erat. Duis sed porttitor magna, a laoreet enim.</p>
							<p>Morbi pulvinar sagittis ipsum sed posuere. Sed et interdum nibh. Duis tristique massa non est hendrerit vehicula. Fusce rutrum lorem luctus blandit ultricies. Aliquam auctor mi ac odio sollicitudin sollicitudin. </p>
							<a class="btn btn-danger">Learn More</a>
						</div>				
					</div>
				</div>
			</div>
		</section>-->
	<!-- section END -->
	
	<!-- section START -->
	<section class="section gray-bg" id="testimonials">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
				
					<div class="section-header text-center">
						<i class="icon-chat"></i>
						<h2 class="h1">Don't Take Our Word For It...</h2>
						<hr class="spacer-30">
					</div>
					
					<div class="row">
						<div class="col-sm-6">
							
							<!-- testimonial style2 START -->
							<div class="testimonials-style2">
								<div class="quote">
									Vestibulum nisl viverra lacus euismod vehicula. Nullam condimentum id libero sollicitudin, at vestibulum ex finibus.
								</div>
								<div class="cst-name">
									<img src="{{asset('img/authors/author8.jpg')}}" alt="John Doe">
									<span class="text-uppercase alt-color">John Doe</span>
									<br><abbr title="Chief Ececutive Officer" class="initialism">CEO</abbr> ABC Inc.
								</div>
							</div>
							<!-- testimonial style2 END -->
							
						</div>
						<div class="col-sm-6">
							
							<!-- testimonial style2 START -->
							<div class="testimonials-style2">
								<div class="quote">
									Vestibulum nisl viverra lacus euismod vehicula. Nullam condimentum id libero sollicitudin, at vestibulum ex finibus.
								</div>
								<div class="cst-name">
									<img src="{{asset('img/authors/author5.jpg')}}" alt="John Doe">
									<span class="text-uppercase alt-color">John Doe</span>
									<br><abbr title="Chief Ececutive Officer" class="initialism">CEO</abbr> ABC Inc.
								</div>
							</div>
							<!-- testimonial style2 END -->
							
						</div>
					</div>	
					
					<div class="row">
						<div class="col-sm-4">
							
							<!-- testimonial style2 START -->
							<div class="testimonials-style2">
								<div class="quote">
									Vestibulum nisl viverra lacus euismod vehicula. Nullam condimentum id libero sollicitudin, at vestibulum ex finibus.
								</div>
								<div class="cst-name"><span>John Doe</span> - <abbr title="Chief Ececutive Officer" class="initialism">CEO</abbr> ABC Inc.</div>
							</div>
							<!-- testimonial style2 END -->
							
						</div>
						<div class="col-sm-4">
							
							<!-- testimonial style2 START -->
							<div class="testimonials-style2">
								<div class="quote">
									Vestibulum nisl viverra lacus euismod vehicula. Nullam condimentum id libero sollicitudin, at vestibulum ex finibus.
								</div>
								<div class="cst-name"><span>John Doe</span> - <abbr title="Chief Ececutive Officer" class="initialism">CEO</abbr> ABC Inc.</div>
							</div>
							<!-- testimonial style2 END -->
							
						</div>
						<div class="col-sm-4">
							
							<!-- testimonial style2 START -->
							<div class="testimonials-style2">
								<div class="quote">
									Vestibulum nisl viverra lacus euismod vehicula. Nullam condimentum id libero sollicitudin, at vestibulum ex finibus.
								</div>
								<div class="cst-name"><span>John Doe</span> - <abbr title="Chief Ececutive Officer" class="initialism">CEO</abbr> ABC Inc.</div>
							</div>
							<!-- testimonial style2 END -->
							
						</div>
					</div>		
							
				</div>
			</div>
		</div>
	</section>
	<!-- section END -->
	
	<!-- section START -->
	<!--<section class="section" id="pricing">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2 text-center">
					<div class="section-header">
						<i class="icon-basket wow fadeInUp" data-wow-delay="0.5s"></i>
						<h1>Simple &amp; Transparent Pricing</h1>
					</div>-->
					
					<!-- optional spacer classes "spacer-10" "spacer-20" "spacer-30" upto "spacer-80" -->
					<!--<hr class="spacer-30">
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3 col-sm-6">
					<div class="plan style2">
						<div class="plan-header bg-info">
							<i class="livicon" data-name="star-full" data-color="#fff" data-hovercolor="#fff" data-size="48"></i>
							<h4 class="title">Basic Plan</h4>
							<h2 class="price"><sup>$</sup><strong>13</strong>.<sup>99</sup> <small>/month</small></h2>
						</div>
						<div class="plan-features">
							<ul class="features-list">
								<li>bandwidth <i class="ion-ios-infinite alt-color" data-toggle="tooltip" title="There is no restriction on bandwidth usage"></i></li>
								<li>disk storage <strong class="alt-color" data-toggle="tooltip" title="Scalable upto 50TB">10GB</strong></li>
								<li>websites <strong>1</strong></li>
								<li>domain name <strong class="alt-color" data-toggle="tooltip" title="You will get one domain free of charge for lifetime">free</strong></li>
								<li><i class="fa fa-close text-danger"></i></li>
								<li><i class="fa fa-close text-danger"></i></li>
							</ul>
						</div>
						<div class="plan-footer">
							<a href="javascript:void(0);" class="btn btn-info" title="Start your basic plan">Start Now</a>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="plan style2">
						<div class="plan-header bg-warning">
							<i class="livicon" data-name="clock" data-color="#fff" data-hovercolor="#fff" data-size="48"></i>
							<h4 class="title">Regular Plan</h4>
							<h2 class="price"><sup>$</sup><strong>18</strong>.<sup>99</sup> <small>/month</small></h2>
						</div>
						<div class="plan-features">
							<ul class="features-list">
								<li>bandwidth <i class="ion-ios-infinite alt-color" data-toggle="tooltip" title="There is no restriction on bandwidth usage"></i></li>
								<li>disk storage <strong class="alt-color" data-toggle="tooltip" title="Scalable upto 50TB">20GB</strong></li>
								<li>websites <strong>5</strong></li>
								<li>domain name <strong class="alt-color" data-toggle="tooltip" title="You will get one domain free of charge for lifetime">free</strong></li>
								<li><i class="fa fa-close text-danger"></i></li>
								<li>24/7 phone support</li>
							</ul>
						</div>
						<div class="plan-footer">
							<a href="javascript:void(0);" class="btn btn-warning" title="Start your regular plan">Start Now</a>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="plan style2">
						<div class="plan-header bg-success">
							<i class="livicon" data-name="barchart" data-color="#fff" data-hovercolor="#fff" data-size="48"></i>
							<h4 class="title">Most Popular</h4>
							<h2 class="price"><sup>$</sup><strong>24</strong>.<sup>99</sup> <small>/month</small></h2>
						</div>
						<div class="plan-features">
							<ul class="features-list">
								<li>bandwidth <i class="ion-ios-infinite alt-color" data-toggle="tooltip" title="There is no restriction on bandwidth usage"></i></li>
								<li>disk storage <strong class="alt-color" data-toggle="tooltip" title="Scalable upto 50TB">50GB</strong></li>
								<li>websites <strong>10</strong></li>
								<li>domain name <strong class="alt-color" data-toggle="tooltip" title="You will get one domain free of charge for lifetime">free</strong></li>
								<li>free SSL</li>
								<li>24/7 phone support</li>
							</ul>
						</div>
						<div class="plan-footer">
							<a href="javascript:void(0);" class="btn btn-success" title="Start your popular plan">Start Now</a>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="plan style2">
						<div class="plan-header bg-danger">
							<i class="livicon" data-name="dashboard" data-color="#fff" data-hovercolor="#fff" data-size="48"></i>
							<h4 class="title">Speed Booster</h4>
							<h2 class="price"><sup>$</sup><strong>49</strong>.<sup>99</sup> <small>/month</small></h2>
						</div>
						<div class="plan-features">
							<ul class="features-list">
								<li>bandwidth <i class="ion-ios-infinite alt-color" data-toggle="tooltip" title="There is no restriction on bandwidth usage"></i></li>
								<li>disk storage  <i class="ion-ios-infinite alt-color" data-toggle="tooltip" title="There is no restriction on disk usage"></i></li>
								<li>websites  <i class="ion-ios-infinite alt-color" data-toggle="tooltip" title="Host as many webistes as you want"></i></li>
								<li>domain name <strong class="alt-color" data-toggle="tooltip" title="You will get one domain free of charge for lifetime">free</strong></li>
								<li>free SSL</li>
								<li>24/7 phone support</li>
							</ul>
						</div>
						<div class="plan-footer">
							<a href="javascript:void(0);" class="btn btn-danger" title="Start your speed booster plan">Start Now</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>-->
	<!-- section END -->
	
	<!-- section START -->
	<!--<section class="section img-bg-color-overlay" data-path="img/bg/bg12.jpg" id="clients">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
				
					<div class="section-header alt-style">
						<h1 class="strong">Our Happy Clients</h1>
						<small class="text-uppercase strong base-color">Fusce vulputate enim vitae dolor <br>consectetur rutrum viverra commodo. </small>
					</div>
					
					<hr class="spacer-10">
					
					<div class="featured-clients">
						<a href="javascript:void(0);" title="Client Name"><img class="wow flipInX" data-wow-delay="0.5s" src="img/clients/1.png" width="280" height="260" alt="Client Name"></a>
						<a href="javascript:void(0);" title="Client Name"><img class="wow flipInX" data-wow-delay="0.7s" src="img/clients/2.png" width="280" height="260" alt="Client Name"></a>
						<a href="javascript:void(0);" title="Client Name"><img class="wow flipInX" data-wow-delay="0.9s" src="img/clients/3.png" width="280" height="260" alt="Client Name"></a>
						<a href="javascript:void(0);" title="Client Name"><img class="wow flipInX" data-wow-delay="1.1s" src="img/clients/4.png" width="280" height="260" alt="Client Name"></a>
						<a href="javascript:void(0);" title="Client Name"><img class="wow flipInX" data-wow-delay="1.3s" src="img/clients/5.png" width="280" height="260" alt="Client Name"></a>
						<a href="javascript:void(0);" title="Client Name"><img class="wow flipInX" data-wow-delay="1.5s" src="img/clients/6.png" width="280" height="260" alt="Client Name"></a>
						<a href="javascript:void(0);" title="Client Name"><img class="wow flipInX" data-wow-delay="1.7s" src="img/clients/7.png" width="280" height="260" alt="Client Name"></a>
						<a href="javascript:void(0);" title="Client Name"><img class="wow flipInX" data-wow-delay="1.9s" src="img/clients/8.png" width="280" height="260" alt="Client Name"></a>
						<a href="javascript:void(0);" title="Client Name"><img class="wow flipInX" data-wow-delay="2.1s" src="img/clients/9.png" width="280" height="260" alt="Client Name"></a>
						<a href="javascript:void(0);" title="Client Name"><img class="wow flipInX" data-wow-delay="2.3s" src="img/clients/10.png" width="280" height="260" alt="Client Name"></a>
						<a href="javascript:void(0);" title="Client Name"><img class="wow flipInX" data-wow-delay="2.5s" src="img/clients/11.png" width="280" height="260" alt="Client Name"></a>
						<a href="javascript:void(0);" title="Client Name"><img class="wow flipInX" data-wow-delay="2.7s" src="img/clients/12.png" width="280" height="260" alt="Client Name"></a>
					</div>
					
				</div>
			</div>
		</div>
	</section>-->
	<!-- section END -->
	
						
	<!-- section START -->
	<!--<section class="section" id="news">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2 text-center">
					<div class="section-header">
						<small class="text-uppercase strong base-color">Lorem ipsum dolor sit amet</small>
						<h1>Featured News Updates</h1>
					</div>-->
					
					<!-- optional spacer classes "spacer-10" "spacer-20" "spacer-30" upto "spacer-80" -->
					<!--<hr class="spacer-30">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
				
					<div class="thumbnail style1">
						<div class="thumb-wrapper">
							<img src="img/thumbnails/thumb1.jpg" alt="Thumbnail">
							<a href="javascript:void(0);" class="post-author" data-toggle="tooltip" title="Author Name"><img src="img/authors/author1.jpg" alt="Post Author"></a>
						</div>
						<div class="caption">
							<h3><a href="javascript:void(0);" class="post-title" title="post title">Post title one</a></h3>
							<div class="post-meta">
								<span class="post-category">Creative</span>
								<span class="post-date">08 June, 2015</span>
								<span class="post-comments"><a href="javascript:void(0);" title="Comments on this post">6</a> <i class="fa fa-comments"></i></span>
							</div>
							<p>Suspendisse potenti fusce rutrum none fringilla dictum. Praesent nant tincidunt polars feugiat non rutrum eget libero.</p>
							<a href="javascript:void(0);" class="btn btn-primary btn-sm" title="Thumbnail link">Read More</a>
						</div>
					</div>
					
				</div>
				<div class="col-sm-4">
				
					<div class="thumbnail style1">
						<div class="thumb-wrapper">
							<div class="thumbs-carousel">
								<div class="item">
									<img src="img/thumbnails/thumb3.jpg" class="img-responsive" alt="Thumbnail">
								</div>
								<div class="item">
									<img src="img/thumbnails/thumb4.jpg" class="img-responsive" alt="Thumbnail">
								</div>
								<div class="item">
									<img src="img/thumbnails/thumb5.jpg" class="img-responsive" alt="Thumbnail">
								</div>
							</div>								
							<a href="javascript:void(0);" class="post-author" data-toggle="tooltip" title="Author Name"><img src="img/authors/author2.jpg" alt="Post Author"></a>
						</div>
						<div class="caption">
							<h3><a href="javascript:void(0);" class="post-title" title="post title">Post title two</a></h3>
							<div class="post-meta">
								<span class="post-category">Programming</span>
								<span class="post-date">09 June, 2015</span>
								<span class="post-comments"><a href="javascript:void(0);" title="Comments on this post">34</a> <i class="fa fa-comments"></i></span>
							</div>
							<p>Suspendisse potenti fusce rutrum none fringilla dictum. Praesent nant tincidunt polars feugiat non rutrum eget libero.</p>
							<a href="javascript:void(0);" class="btn btn-primary btn-sm" title="Thumbnail link">Read More</a>
						</div>
					</div>
					
				</div>
				<div class="col-sm-4">
				
					<div class="thumbnail style1">
						<div class="thumb-wrapper">
							<img src="img/thumbnails/thumb2.jpg" alt="Thumbnail">
							<a title="Video title here" class="nivo-lightbox play-btn cbutton cbutton--effect-ivana wow fadeIn" data-wow-delay="0.5s" href="http://vimeo.com/70301553"><i class="fa fa-play"></i></a>
							<a href="javascript:void(0);" class="post-author" data-toggle="tooltip" title="Author Name"><img src="img/authors/author3.jpg" alt="Post Author"></a>
						</div>
						<div class="caption">
							<h3><a href="javascript:void(0);" class="post-title" title="post title">Post title three</a></h3>
							<div class="post-meta">
								<span class="post-category">Laptops</span>
								<span class="post-date">13 June, 2015</span>
								<span class="post-comments"><a href="javascript:void(0);" title="Comments on this post">3</a> <i class="fa fa-comments"></i></span>
							</div>
							<p>Suspendisse potenti fusce rutrum none fringilla dictum. Praesent nant tincidunt polars feugiat non rutrum eget libero.</p>
							<a href="javascript:void(0);" class="btn btn-primary btn-sm" title="Thumbnail link">Read More</a>
						</div>
					</div>
					
				</div>		
			</div>
		</div>
	</section>-->
	<!-- section END -->
	
	<!-- section START -->
	<section>
		<a class="info-box bg-success text-center no-margin wow flipInX" data-wow-delay="0.5s" href="javascript:void(0);">
			<div class="container">
				<div class="row">
					<div class="col-lg-10 col-lg-offset-1">
						<i class="livicon pull-right visible-lg" data-name="angle-double-right" data-color="#fff" data-hovercolor="false" data-size="36" data-onparent="true"></i>
						<p class="h2">Take your business to the ultimate level with tempo</p>
					</div>
				</div>
			</div>
		</a>
	</section>
	<!-- section END -->

</div>
<!-- page content END -->


<!-- footer START -->
<footer class="footer">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-sm-12">
			
				<h4 class="strong">About Tempo</h4>
				<p>We pride ourselves on being able to apply our creativity to every brief to deliver the right message. Ready to start a project want to learn more about our process and how we work with clients?</p>
		<a href="contact1-single-location.html" title="Contact Us" class="btn btn-default btn-icon contact-btn"><i class="livicon" data-name="mail" data-color="#fff" data-hovercolor="false" data-size="18"></i> Contact Us</a>
		
			</div>
			<div class="col-lg-2 col-sm-4 col-lg-offset-2">
			
				<h4 class="strong">Company</h4>
				<ul class="ft-list">
					<li><a href="javascript:void(0);" title="Link title here">About Us</a></li>
					<li><a href="javascript:void(0);" title="Link title here">Whate We Do</a></li>
					<li><a href="javascript:void(0);" title="Link title here">Our Process</a></li>
					<li><a href="javascript:void(0);" title="Link title here">Careers</a></li>
				</ul>
				
			</div>
			<div class="col-lg-2 col-sm-4">
			
				<h4 class="strong">Services</h4>
				<ul class="ft-list">
					<li><a href="javascript:void(0);" title="Link title here">Graphics Design</a></li>
					<li><a href="javascript:void(0);" title="Link title here">Front End Development</a></li>
					<li><a href="javascript:void(0);" title="Link title here">WordPress Development</a></li>
					<li><a href="javascript:void(0);" title="Link title here">Theme &amp; Templates</a></li>
				</ul>
				
			</div>
			<div class="col-lg-2 col-sm-4">
			
				<h4 class="strong">Leagle</h4>
				<ul class="ft-list">
					<li><a href="javascript:void(0);" title="Link title here">Privacy</a></li>
					<li><a href="javascript:void(0);" title="Link title here">Terms of Use</a></li>
					<li><a href="javascript:void(0);" title="Link title here">FAQ</a></li>
				</ul>
				
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-sm-8 hidden-xs">
			
				<ul class="list-inline">
					<li><a href="javascript:void(0);" title="Link title here">Portfolio</a></li>
					<li><a href="javascript:void(0);" title="Link title here">Downloads</a></li>
					<li><a href="javascript:void(0);" title="Link title here">Gateways</a></li>
					<li><a href="javascript:void(0);" title="Link title here">Blog</a></li>
					<li><a href="javascript:void(0);" title="Link title here">Meetups</a></li>
					<li><a href="javascript:void(0);" title="Link title here">Clients</a></li>
					<li><a href="javascript:void(0);" title="Link title here">Coverage Map</a></li>
				</ul>
				
			</div>
			<div class="col-sm-4">
			
				<div class="ft-social text-right">
					<a class="cst-btn-ten" href="javascript:void(0);"><i class="fa fa-pinterest-p"></i><span>p</span></a>
					<a class="cst-btn-ten" href="javascript:void(0);"><i class="fa fa-facebook"></i><span>f</span></a>
					<a class="cst-btn-ten" href="javascript:void(0);"><i class="fa fa-linkedin"></i><span>in</span></a>
					<a class="cst-btn-ten" href="javascript:void(0);"><i class="fa fa-twitter"></i><span>t</span></a>
					<a class="cst-btn-ten" href="javascript:void(0);"><i class="fa fa-dribbble"></i><span>d</span></a>
				</div>
				
			</div>
			<div class="col-lg-12 col-sm-6">
			
				<p class="copyright">© 2015 Tempo Pty Ltd.</p>
				
			</div>
		</div>
		
	</div>
	
</footer>
<!-- footer style1 END -->

    
<!-- jQuery plugins -->
<script src="{{asset('js/vendor/jquery.js')}}"></script>
<script src="{{asset('js/vendor/bootstrap.js')}}"></script>
<script src="{{asset('js/easing.js')}}"></script>
<script src="{{asset('js/scrollbar.js')}}"></script>
<script src="{{asset('js/retina.js')}}"></script>
<script src="{{asset('js/raphael.js')}}"></script>
<script src="{{asset('js/tabs.js')}}"></script>
<script src="{{asset('js/livicons.js')}}"></script>
<script src="{{asset('js/icheck.js')}}"></script>
<script src="{{asset('js/mousewheel.js')}}"></script>
<script src="{{asset('js/selectik.js')}}"></script>
<script src="{{asset('js/spinedit.js')}}"></script>
<script src="{{asset('js/wow.js')}}"></script>
<script src="{{asset('js/hover-dropdown.js')}}"></script>
<script src="{{asset('js/classie.js')}}"></script>
<script src="{{asset('cloudslider/js/cloudslider.jquery.min.js')}}"></script>
<script src="{{asset('cubeportfolio/js/jquery.cubeportfolio.js')}}"></script>
<script src="{{asset('vendor/js/eazyForm.js')}}"></script>
<script src="{{asset('nivo-lightbox/nivo-lightbox.min.js')}}"></script>
<script src="{{asset('js/appear.js')}}"></script>
<script src="{{asset('js/pie-chart.js')}}"></script>
<script src="{{asset('js/vide.js')}}"></script>
<script src="{{asset('js/fitvids.js')}}"></script>
<script src="{{asset('owl-carousel/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/jflickrfeed.js')}}"></script>
<script src="{{asset('js/tweecool.js')}}"></script>
<script src="{{asset('js/chart.js')}}"></script>
<script src="{{asset('js/totop.js')}}"></script>
<script src="{{asset('js/sm-scroll.js')}}"></script>
<script src="{{asset('js/smooth-scroll.js')}}"></script>
<script src="{{asset('js/ajaxchimp.js')}}"></script>
<script src="{{asset('js/contact.js')}}"></script>
<script src="{{asset('js/form.js')}}"></script>
<script src="{{asset('js/validate.js')}}"></script>
<script src="{{asset('js/tempo.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>	
<script src="{{asset('jss/custom/requestwizard.js')}}"></script>
<script src="{{asset('jss/custom/startRequestwizard.js')}}"></script>

<!--<script src="{{asset('vendor/twitterwizard/js/modal.js')}}"></script>-->	
	
</body>
</html>
