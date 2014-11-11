<!DOCTYPE html>
<html lang="en">

	

	<head>
		@yield('meta')

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<title>Oboli - @yield('title')</title>
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico?v=2">
		<!-- google fonts -->
		<link href='http://fonts.googleapis.com/css?family=Lato:400,300italic,300,700%7CPlayfair+Display:400,700italic%7CRoboto:300%7CMontserrat:400,700%7COpen+Sans:400,300%7CLibre+Baskerville:400,400italic' rel='stylesheet' type='text/css'>
		<!-- Bootstrap -->		
		<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/bootstrap-theme.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/revolution-slider/css/settings.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/global.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/skin.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/bootstrap-social-buttons.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/bootstrap-slider.css') }}" rel="stylesheet">
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

	</head>
	<body>





		@if (!Auth::guest() && Auth::user()->confirmed==0)
			<div class="alert alert-danger text-center" role="alert">
				<strong>Attenzione!</strong> Per donare i tuoi oboli devi prima confermare l'indirizzo email.
			</div>
		@endif

		@if (Auth::guest() && Session::has('code'))
			<div class="alert alert-danger text-center" role="alert">
				<strong>Attenzione!</strong> Per poter donare gli oboli associati al codice devi effettuare l'accesso. <a href="/access">Clicca qui.</a>
			</div>
		@endif

		


		@yield('top')

		<div id="wrapper">
			<!--Header Section Start Here -->
			<header id="header">
				<div class="container">
					<div class="row primary-header">
						<a href="/" class="col-xs-12 col-sm-2 brand" title="Welcome to Charity"><img src="{{ asset('assets/img/logo2.png') }}" alt="Charity"></a>
						<div class="social-links col-xs-12 col-sm-10">
							
							
							@if (!Auth::check())
								<a href="/login" class="btn btn-default btn-volunteer">Login</a>
								<a href="/signup" class="btn btn-default btn-volunteer">Registrati</a>
							@else
								 @if (Session::get('obolis')==0) 
									<div class="oboli-count fa fa-money"><span class="badge badge-oboli-count">0<span></div>	
								@else
									<div class="oboli-count fa fa-money"><span class="badge badge-oboli-count">{{ Auth::user()->oboli_count }}<span></div>								
								@endif
							@endif
						
							@if (!Auth::check())
								<ul class="social-icons hidden-xs">
									<li>
										<a href="https://www.facebook.com/getoboli" target="_blank"><i class="fa fa-facebook"></i></a>
									</li>
									<li>
										<a href="https://twitter.com/getoboli" target="_blank"><i class="fa fa-twitter"></i></a>
									</li>
									<li>
										<a href="mailto:info@getoboli.com"><i class="fa fa-send"></i></a>
									</li>
								</ul>

							@endif
						</div>
					</div>
				</div>
				<div class="navbar navbar-default" role="navigation">
					<div class="container">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>

						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<nav>
							<ul class="nav navbar-nav">
								<li class="active">
									<a href="/" >Home </a>
								</li>
								<li>
									<a href="/ngos" >Progetti  e  ONG </a>
								</li>
								<li>
									<a href="/howitworks"  >Come Funziona  </a>
								</li>
								<li>
									<a href="/contact-us">contattaci</a>
								</li>
								@if (!Auth::guest())
									<li>
										<a href="/users/{{ Auth::id() }}">profilo</a>
									</li>
									<li>
										<a href="/logout">logout</a>
									</li>
								@endif

							</ul>
							</nav>
						</div><!-- /.navbar-collapse -->
					</div><!-- /.container-fluid -->
				</div>

			</header>
			<!-- Header Section End Here -->
	
 
			@yield('content')
	
	
	
	
			<!--Footer Section Start Here -->
			<footer id="footer">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-4">
							<div class="footer-logo">
								<a href="index.html" title="Welcome to Charity"><img src="assets/img/logo1.png" alt="Charity"></a>
							</div>
							<p>
								There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour,
							</p>
							<address>
								<span> <i class="fa fa-home"></i> <span>A-2, Sector-63, Noida, 201301, India</span> </span>
								<span> <i class="fa fa-phone-square"></i> <span>+1 707 921 7269</span> </span>
								<span> <i class="fa fa-envelope"></i> <span><a href="mailto:contact@charity.com">contact@charity.com</a></span> </span>
							</address>

						</div>
						<div class="col-xs-12 col-sm-4 twitter-update">
							<h6>Twitter Feed</h6>
							<p>
								<a href="#"> <span class="charity">@charity</span> Various versions have evolved over the years, sometimes by accident, sometimes on purpos. <span class="comment-time">2 hours ago</span> </a>
							</p>
							<p>
								<a href="#"> <span class="charity">@charity</span> Various versions have evolved over the years, sometimes by accident, sometimes on purpos. <span class="comment-time">2 hours ago</span> </a>
							</p>
						</div>
						<div class="col-xs-12 col-sm-4">
							<h6>Newsletter Signup</h6>
							<p>
								Variations of passages of Lorem Ipsum available, but the majokgrity
							</p>
							<form role="form" class="sign-up">

								<div class="input-group">
									<input class="form-control" type="email" placeholder="Email">
									<div class="input-group-addon">
										<input type="submit" class="btn btn-theme" value="Submit">
									</div>
								</div>

							</form>

							<h6>Follow us</h6>
							<ul class="social-icons">
								<li>
									<a href="http://facebook.com" target="_blank"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="http://twitter.com" target="_blank"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="http://dribble.com/" target="_blank"><i class="fa fa-dribbble"></i></a>
								</li>
								<li>
									<a href="http://pinterest.com" target="_blank"><i class="fa fa-pinterest"></i></a>
								</li>
								<li>
									<a href="http://plus.google.com" target="_blank"><i class="fa fa-google-plus"></i></a>
								</li>
								<li>
									<a href="http://instagram.com" target="_blank"><i class="fa fa-instagram"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="copyright">
					<div class="container">
						<div class="row">
							<div class="col-xs-12">
								<span> &copy; Copyright 2014, All Rights Reserved by Oboli.
									</span>
							</div>
						</div>
					</div>
				</div>
			</footer>
			<!--Footer Section End Here -->
		</div>


		@yield('after-footer')
		
	
		<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.easing.min.js') }}"></script>
		<!--Main Slider Js-->
		<script src="{{ asset('assets/revolution-slider/js/jquery.themepunch.plugins.min.js') }}"></script>
		<script src="{{ asset('assets/revolution-slider/js/jquery.themepunch.revolution.js') }}"></script>
		<!--Main Slider End Js-->
		<script src="{{ asset('assets/js/jquery.flexslider.js') }}"></script>
		<script src="{{ asset('assets/js/site.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap-slider.js') }}"></script>

		<!-- sometime later, probably inside your on load event callback -->

		@yield('scripts')

		
		

	</body>
</html>
