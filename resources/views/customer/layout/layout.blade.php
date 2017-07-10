<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>eventpad</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon" href="apple-touch-icon.png">
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/css/slick.css')}}"/>
	<link rel="shortcut icon" href="favicon-32x32.png" type="image/png">
	<!-- style.css is main stylesheet and all other sylesheets are being
		 imported in this file. -->
	<link rel="stylesheet" href="{{asset('customcss/all.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.2.0/jquery.rateyo.min.css">
	<link rel="stylesheet" href="{{asset('vendor/css/scroll.css')}}">
	<script src="{{asset('js/vendor/modernizr-2.8.3-respond-1.4.2.min.js')}}"></script>
	<script src="https://www.gstatic.com/firebasejs/3.6.9/firebase.js"></script>
	<script>
	
	var config = {
            apiKey: "AIzaSyDaLwKhrrU0XnVwajC_lh_1nKX5hFBJ514",
            authDomain: "myfirstapp-a776e.firebaseapp.com",
            databaseURL: "https://myfirstapp-a776e.firebaseio.com",
            storageBucket: "myfirstapp-a776e.appspot.com",
            messagingSenderId: "43600357644"
        };
	firebase.initializeApp(config);
	
	</script>

	@yield('style')

	<script>
	window.Laravel = {!! json_encode([
		'csrfToken' => csrf_token(),
	]) 
!!};
	//window.customerUrl = "http:\/\/localhost/eventing/public\/";
	window.customerUrl = window.location.origin+'/';
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
			<a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('./img/logos/tempo-light.png')}}" alt="tempo"></a>
		</div>		
		
		<!--<ul class="nav navbar-nav navbar-right search-cart">
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
						 <span class="glyphicon glyphicon-bell" aria-hidden="true">3</a>
					<ul class="dropdown-menu" role="menu">
						<li>
							<div class="cart-wrap">
								<ul>
                                    
									
								</ul>
							</div>
							<div class="sub-total">

							</div>
							<div class="shop-controls clearfix">
								<a href="javascript:void(0);" class="btn btn-primary btn-xs" title="View Cart">View Cart</a>
								<a href="javascript:void(0);" class="btn btn-success btn-xs" title="Checkout">Checkout</a>
							</div>
						</li>
					</ul>					
				</li>
		</ul>-->
	
		<!-- vertical navigation START -->
		<div class="nav-items">
			<div class="logo-alt">
				<a href="index.html" title="Tempo - A Responsive Bootstrap Template">
					<!--<img src="{{asset('img/logos/tempo-light.png')}}" alt="tempo">-->
				</a>
			</div>
			<ul>
				<li class="dropdown">
					<a href="{{url('/cuhome')}}" title="Home page default">Home</a>
				</li>
				<!--<li class="dropdown">
					<a href="{{url('/cuprofile')}}" title="Template Features">Profile</a>
				</li>-->

				<li class="dropdown">
					<a href="{{url('/curequest')}}" title="Extra Pages">Requests</a>
				</li>

				<!--<li class="dropdown">
					<a href="javascript:void(0);" title="Home page default">Quotes</a>
                </li>-->
					
			</ul>

			<ul class="social-links">
				<li class="">
					<a href="{{url('/')}}" title="Home page default">EventPad</a>
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
@include('layouts.footer')
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.2.0/jquery.rateyo.min.js"></script>
<script src="https://cdn.rawgit.com/alertifyjs/alertify.js/v1.0.10/dist/js/alertify.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
<script src="{{asset('jss/custom/customer.js')}}"></script>
<script src="{{asset('jss/custom/firebase.js')}}"></script>
	
@yield('script')
</body>
</html>
