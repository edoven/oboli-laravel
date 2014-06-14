
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		
		<title>Oboli - @yield('title')</title>
		
		<link href="{{ asset('theme/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('theme/css/font-awesome.min.css') }}" rel="stylesheet">
		<link href="{{ asset('theme/css/prettyPhoto.css') }}" rel="stylesheet">
		<link href="{{ asset('theme/css/main.css') }}" rel="stylesheet">
		<link href="{{ asset('theme/css/animate.css') }}" rel="stylesheet">


		<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
		<script src="js/respond.min.js"></script>
		<![endif]-->       
	   
		<link rel="shortcut icon" href="{{ asset('theme/images/ico/favicon.ico') }}">
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('theme/images/ico/apple-touch-icon-144-precomposed.png') }}">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('theme/images/ico/apple-touch-icon-114-precomposed.png') }}">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('theme/images/ico/apple-touch-icon-72-precomposed.png') }}">
		<link rel="apple-touch-icon-precomposed" href="{{ asset('theme/images/ico/apple-touch-icon-57-precomposed.png') }}">
	</head><!--/head-->

    <body>	
		
		<header class="navbar navbar-inverse navbar-fixed-top wet-asphalt" role="banner">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/"><img src="{{ asset('theme/images/logo.png') }}" alt="logo"></a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav navbar-right">
						<li class="active"><a href="/">Home</a></li>
						<li><a href="/projects">Projects</a></li>
						
						@if (Auth::check())
							<li><a href="/user/{{ Auth::id() }}">Profile</a></li>
							<li><a href="/logout">Logout</a></li>
						@else
							<li><a href="/login">Login</a></li>
							<li><a href="/signin">Signin</a></li>
						@endif
					</ul>
				</div>
			</div>
		</header><!--/header-->

		
		@yield('content')
		
		
		<footer id="footer" class="midnight-blue">
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						&copy; 2013 <a target="_blank" href="http://shapebootstrap.net/" title="Free Twitter Bootstrap WordPress Themes and HTML templates">Oboli</a>. All Rights Reserved.
					</div>
					<div class="col-sm-6">
						<ul class="pull-right">
							<li class="active"><a href="/">Home</a></li>
							<li><a href="/projects">Projects</a></li>
							@if (Auth::check())
								<li><a href="/user/{{ Auth::id() }}">Profile</a></li>
								<li><a href="/logout">Logout</a></li>
							@else
								<li><a href="/login">Login</a></li>
								<li><a href="/signin">Signin</a></li>
							@endif
							<li><a id="gototop" class="gototop" href="#"><i class="icon-chevron-up"></i></a></li><!--#gototop-->
						</ul>
					</div>
				</div>
			</div>
		</footer><!--/#footer-->

		<script src="{{ asset('theme/js/jquery.js') }} "></script>
		<script src="{{ asset('theme/js/bootstrap.min.js') }} "></script>
		<script src="{{ asset('theme/js/jquery.prettyPhoto.js') }} "></script>
		<script src="{{ asset('theme/js/main.js') }} "></script>

    </body>
</html>
