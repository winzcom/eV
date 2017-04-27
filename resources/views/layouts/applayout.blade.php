<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>e-venting</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon" href="apple-touch-icon.png">
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<!-- style.css is main stylesheet and all other sylesheets are being
		 imported in this file. -->
		 <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.2.0/jquery.rateyo.min.css">

	<link rel="stylesheet" href="{{asset('customcss/all.css')}}">
	<link rel="stylesheet" href="{{asset('vendor/css/eazy.css')}}">

	

	<script src="{{asset('js/vendor/modernizr-2.8.3-respond-1.4.2.min.js')}}"></script>
	<!--<script src="{{asset('jss/custom/googleautocomplete.js')}}"></script>-->
	
<style>
    .request_modal{
		margin-top:10%;
	}
	
</style>

</head>

<script>

	/***Google Maps and Autocomplete Starts */
	/*** */
	window.Laravel = {!! json_encode([
		'csrfToken' => csrf_token(),
	]) 
!!};
window.myUrl = window.location.origin+"/eventing/public\/";
//alert(window.myUrl = window.location.origin);
window.customerUrl = window.location.origin+"/eventing/public\/";

</script>

<body data-spy="scroll" data-target=".navscroll">

	<!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
	
@if(session('user_state') !== null)
	<p style="display:none" id="user_state" data-user-state ="{{session('user_state')}}">session('user_state')</p>
@endif
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
				<li><a href="{{url('/')}}">Home</a></li>
				<li><a href="{{url('/browse_vendors')}}">Browse Vendors</a></li>
				<!--<li><a href="#">Request Quotes</a></li>-->
				
				@if(Auth::check())
					<li><a href="{{url('/home')}}">DashBoard</a></li>
				@elseif (Auth::guard('client')->check())
					<li><a href="{{url('/cuhome')}}">DashBoard</a></li>
				@else
					<li><a href="{{url('/register')}}">Join as Vendor</a></li>
					<!--<li><a href="{{url('/login')}}">Sign In</a></li>-->
					<li class="dropdown">
						<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Sign In <span class="fa fa-chevron-down"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li class="submenu left-dropdown">
								<a href="{{url('/login')}}" title="Shop Style1">As a vendor</a>
								
							</li>
							<li class="submenu left-dropdown">
								<a href="{{url('/culogin')}}" title="Shop Style2">As a client</a>
							
							</li>
							
						</ul>
				</li>
				@endif 
			</ul>
		</div><!-- /.navbar-collapse -->
		
	</div><!-- /.container -->
</nav>
<!-- main navigation END -->


<!-- page content START -->
@yield('content')
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
	<div id="map"></div>
</footer>
<!-- footer style1 END -->

    
<!-- jQuery plugins -->
<script src="{{asset('js/vendor/jquery.js')}}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
<script src="{{asset('owl-carousel/owl.carousel.min.js')}}"></script>
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
<!--<script src="{{asset('jss/custom/profile.js')}}"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<!--<script src="{{asset('vendor/js/dropzone/dropzone.js')}}"></script>-->
<script src="https://cdn.rawgit.com/alertifyjs/alertify.js/v1.0.10/dist/js/alertify.js"></script>
<!--<script src="{{asset('js/app/app.js')}}"></script>-->

<script src="{{asset('jss/custom/data/requestdata.js')}}"></script>
<script src="{{asset('jss/custom/startRequestwizard.js')}}"></script>
<script src="{{asset('vendor/js/createsteps/jquery-bootstrap-modal-steps.min.js')}}"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.2.0/jquery.rateyo.min.js"></script>
<script src="{{asset('jss/combox.js')}}"></script>
<!--<script src="https://www.gstatic.com/firebasejs/3.6.9/firebase.js"></script>
<script src="{{asset('jss/firebase_config.js')}}"></script>
<script src="{{asset('jss/custom/firebase.js')}}"></script>-->

<-- standard version -->


<!--<script src="{{asset('vendor/twitterwizard/js/modal.js')}}"></script>-->
<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB7SGP6giYEwQUUJXWbBffqhe9AIbp1ciY&libraries=places&callback=initAutoComplete,initMap"
        async defer>
</script>-->


	
<script>

</script>




@yield('script')

</body>
</html>
