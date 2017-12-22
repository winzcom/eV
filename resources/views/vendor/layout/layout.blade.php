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
	<!--<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">-->
	<link rel="shortcut icon" href="favicon-32x32.png" type="image/png">
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
	window.myUrl = window.location.origin+'/';

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
				<!-- <li class="dropdown search">
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
				</li> -->
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

				<!--<li class="dropdown">
					<a href="javascript:void(0);" title="Home page default">Quotes</a>
                </li>-->

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
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="soq_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Quotes</h4>
      </div>
      <div class="modal-body" id="quotes_modal_body">
		<p id="getting_quotes">Getting quotes...</p>
		<div id="quotes">
			
		</div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@yield('content')

<!-- footer START -->
@include('layouts.footer')
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
