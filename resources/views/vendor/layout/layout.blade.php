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
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- style.css is main stylesheet and all other sylesheets are being
		 imported in this file. -->
	<link rel="stylesheet" href="{{asset('customcss/all.css')}}">
	<link rel="stylesheet" href="{{asset('vendor/css/jquery-ui.min.css')}}">

	@yield('style')

	<script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
	<script src="https://js.pusher.com/4.0/pusher.min.js"></script>
	
	
	<script>

    // Enable pusher logging - don't include this in production
    
	//window.myUrl = "http:\/\/localhost/eventing/public\/";
	window.myUrl = window.location.origin+"/eventing22/public\/";

  </script>

</head>
<body>

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
<nav class="navbar navbar-custom transparent-nav navbar-fixed-top vertical-nav" role="navigation">
	<div class="container-fluid">
		
		
		<button type="button" class="navbar-toggle" data-toggle="offcanvas">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
	
		<!-- brand (compnay logo) -->
		<div class="navbar-header">
			<a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('img/logos/tempo-light.png')}}" alt="tempo"></a>
		</div>		
		
		<ul class="nav navbar-nav navbar-right search-cart">
				<li class="dropdown search">
					<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="ion-ios-search-strong"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li class="clearfix">
							<form method="get" action="#">
								<div class="form-group">
									<input type="text" class="form-control input-sm" id="query" placeholder="Search...">
								</div>
								<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
							</form>
						</li>
					</ul>
				</li>
				<li class="dropdown cart">
					<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						<i class="ion-bell"></i>
						 <span class="glyphicon glyphicon-bell" aria-hidden="true">{{count($requests->where('rid',null))}}</span></a>
					<ul class="dropdown-menu" role="menu">
						<li>
							<div class="cart-wrap">
								<ul>
                                    @if(count($requests->where('rid',null)) > 0)
										@php 
											$unanswered = $requests->where('rid',null);
										@endphp
                                        @foreach($unanswered as $ur)
                                            <li>
                                                <a href="javascript:void(0);" class="product" title="link title">
                                                    <img src="{{asset('img/defaultRequest.jpg')}}" 
															alt="Product One"
															style="border-radius:7px;"
													> 
													 Request From {{$ur->client_name}}
                                                </a>
                                                <span class="quantity">
													On @if(isset($ur->created_at))
														{{date('d M Y H:i:s',strtotime($ur->created_at))}}
														for @php 
															 echo ((json_decode($ur->request)->event))
														  @endphp
													@endif
												</span>
                                            </li>
                                        @endforeach

                                    @endif
									
								</ul>
							</div>
							<div class="sub-total">

							</div>
							<!--<div class="shop-controls clearfix">
								<a href="javascript:void(0);" class="btn btn-primary btn-xs" title="View Cart">View Cart</a>
								<a href="javascript:void(0);" class="btn btn-success btn-xs" title="Checkout">Checkout</a>
							</div>-->
						</li>
					</ul>					
				</li>
		</ul>
	
		<!-- vertical navigation START -->
		<div class="nav-items">
			<div class="logo-alt">
				<a href="index.html" title="Tempo - A Responsive Bootstrap Template">
					<!--<img src="{{asset('img/logos/tempo-light.png')}}" alt="tempo">-->
				</a>
			</div>
			<ul>
				<li class="dropdown">
					<a href="{{url('/home')}}" title="Home page default">Home</a>
				</li>
				<li class="dropdown">
					<a href="{{url('/profile')}}" title="Template Features">Profile</a>
				</li>

				<li class="dropdown">
					<a href="{{url('/requests')}}" title="Extra Pages">Requests</a>
				</li>

				<li class="dropdown">
					<a href="javascript:void(0);" title="Home page default">Quotes</a>
                </li>

				<li class="dropdown">
					<a href="{{url('/reviews')}}" title="Home page default">Reviews</a>
                </li>

				<li class="dropdown">
					<a href="{{url('/gallery')}}" title="Home page default">Gallery</a>
                </li>

				<!--<li class="dropdown">
					<a href="{{url('')}}" title="Home page default">Offer Listing</a>
                </li>-->
					
			</ul>

			<ul class="social-links">
				<li class="">
					<a href="{{url('/')}}" title="Home page default">Eventing</a>
                </li>
				<li class="">
					<a href="{{url('/logout')}}" title="Home page default">Logout</a>
                </li>
			</ul>
			
		</div><!-- /.nav-items -->
		
	</div><!-- /.container -->
</nav>
<!-- main navigation END -->

@yield('content')

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
 
 <!-- Custom Script -- >



 <!-- Custom Script End -->



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
<script src="{{asset('nivo-lightbox/nivo-lightbox.min.js')}}"></script>
<script src="{{asset('js/appear.js')}}"></script>
<!--<script src="{{asset('js/pie-chart.js')}}"></script>
<script src="{{asset('js/vide.js')}}"></script>-->
<!--<script src="{{asset('js/fitvids.js')}}"></script>-->
<!--<script src="{{asset('owl-carousel/owl.carousel.min.js')}}"></script>-->
<!--<script src="{{asset('js/jflickrfeed.js')}}"></script>-->
<!--<script src="{{asset('js/tweecool.js')}}"></script>-->
<!--<script src="{{asset('js/chart.js')}}"></script>-->
<script src="{{asset('js/totop.js')}}"></script>
<script src="{{asset('js/sm-scroll.js')}}"></script>
<script src="{{asset('js/smooth-scroll.js')}}"></script>
<!--<script src="{{asset('js/ajaxchimp.js')}}"></script>-->
<!--<script src="{{asset('js/contact.js')}}"></script>
<script src="{{asset('js/form.js')}}"></script>
<script src="{{asset('js/validate.js')}}"></script>-->
<script src="{{asset('js/tempo.js')}}"></script>
<!--<script src="{{asset('js/main.js')}}"></script>-->	
<script src="{{asset('jss/custom/profile.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="{{asset('vendor/js/dropzone/dropzone.js')}}"></script>
<script src="https://cdn.rawgit.com/alertifyjs/alertify.js/v1.0.10/dist/js/alertify.js"></script>
<!--<script src="{{asset('js/app/app.js')}}"></script>-->

@yield('script')

</body>
</html>
