<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>

	<!-- Global Site Tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-107501187-1"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments)};
	gtag('js', new Date());

	gtag('config', 'UA-107501187-1');
	</script>


	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>eventpad</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon" href="apple-touch-icon.png">
	<link rel="shortcut icon" type="image/x-icon" href="{{asset('favicon-32x32')}}">
	@yield('style')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" type="" href="{{asset('vendor/css/nouislider.min.css')}}">
	<!-- style.css is main stylesheet and all other sylesheets are being
		 imported in this file. -->
		 <!-- Latest compiled and minified CSS -->
		 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.2.0/jquery.rateyo.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/timepicker@1.11.12/jquery.timepicker.min.css">
	<!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css"> -->

	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />	
	<link rel="stylesheet" href="{{asset('customcss/all.css')}}">

	<!--<link rel="stylesheet" href="{{asset('vendor/css/eazy.css')}}">-->
	<!--<link rel="stylesheet" href="{{asset('css/material-bootstrap-wizard.css')}}">-->
	<link rel="shortcut icon" href="favicon-32x32.png" type="image/png">
	

	<script src="{{asset('js/vendor/modernizr-2.8.3-respond-1.4.2.min.js')}}"></script>
	<!--<script src="{{asset('jss/custom/googleautocomplete.js')}}"></script>-->

<style>
body {
	overflow-x:hidden !important;
	box-sizing:border-box;
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
window.myUrl = window.location.origin+'/';
//alert(window.myUrl = window.location.origin);
window.customerUrl = window.location.origin+'/';

</script>

<body data-spy="scroll" data-target=".navscroll">

	<!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
	
@if(session('user_state') !== null)
	<!--<p style="display:none" id="user_state" data-user-state ="{{session('user_state')}}">session('user_state')</p>-->
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
			<a class="navbar-brand" href=""><img src="{{asset('img/logos/logo.png')}}" alt="tempo"></a>
		</div>		
	
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navscroll" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="{{url('/')}}">Eventpad</a></li>
				<li><a href="{{url('/browse_vendors')}}">Browse Vendors</a></li>
				<!--<li><a href="#">Request Quotes</a></li>-->
				
				@if(Auth::check())
					<li><a href="{{url('/home')}}">Home</a></li>
				@elseif (Auth::guard('client')->check())
					<li><a href="{{url('/cuhome')}}">Home</a></li>
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
				<li>
					@include('app_view.shared.search')
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
		
	</div><!-- /.container -->
</nav>
<!-- main navigation END -->


<!-- page content START -->
@yield('content')
<!-- page content END -->


<!-- footer START -->

@include('layouts.footer')
<!--Footer end --> 
<!-- jQuery plugins -->
<script src="{{asset('js/vendor/jquery.js')}}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script> -->
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
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/timepicker@1.11.12/jquery.timepicker.min.js"></script>
<!--<script src="{{asset('js/app/app.js')}}"></script>-->
<script src="{{ asset('js/mailgun_validator.js') }}"></script>
<script src="{{asset('jss/custom/data/requestdata.js')}}"></script>
<script src="{{asset('jss/custom/startRequestwizard.js')}}"></script>
<script src="{{asset('vendor/js/createsteps/jquery-bootstrap-modal-steps.min.js')}}"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.2.0/jquery.rateyo.min.js"></script>
<script src="{{asset('jss/combox.js')}}"></script>
<script src="https://www.gstatic.com/firebasejs/3.6.9/firebase.js"></script>
<script src="{{asset('jss/firebase_config.js')}}"></script>
<script src="{{asset('jss/custom/firebase.js')}}"></script>
<script src="{{asset('jss/custom/googleautocomplete.js')}}"></script>

<!--<script src="{{asset('vendor/twitterwizard/js/modal.js')}}"></script>-->
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB7SGP6giYEwQUUJXWbBffqhe9AIbp1ciY&libraries=places&callback=initAutoComplete"
        async defer>
</script> -->

<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="{{asset('vendor/js/jquery.steps.min.js')}}"></script>
<script src="{{asset('vendor/js/nouislider.min.js')}}"></script>
<!--<script src="{{asset('js/jquery.bootstrap.js')}}"></script>
<script src="{{asset('js/material-bootstrap-wizard.js')}}"></script>-->
<script src="https://vuejs.org/js/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.4/lodash.min.js"></script>

@yield('script')
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/599d6c3cb6e907673de090b5/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</body>
</html>
