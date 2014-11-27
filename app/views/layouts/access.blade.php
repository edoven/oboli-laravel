<!DOCTYPE html>
<html lang="en">

	

	<head>
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
		

		
		<div id="wrapper" class="signup-wrapper">
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

			
			@yield('content')
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

		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-57160464-1', 'auto');
			ga('send', 'pageview');
		</script>
	</body>
</html>
