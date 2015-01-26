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
		<link href="//fonts.googleapis.com/css?family=Raleway" rel="stylesheet" type="text/css" >
		<!-- Bootstrap -->		
		<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('css/bootstrap-theme.css') }}" rel="stylesheet">
		<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
		<link href="{{ asset('revolution-slider/css/settings.css') }}" rel="stylesheet">
		<link href="{{ asset('css/global.css') }}" rel="stylesheet">
		<link href="{{ asset('css/style.css') }}" rel="stylesheet">
		<link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
		<link href="{{ asset('css/skin.css') }}" rel="stylesheet">

		<link href="{{ asset('css/addendum.css') }}" rel="stylesheet">		
		<link href="{{ asset('css/fakeLoader.css') }}" rel="stylesheet">		

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

	</head>
	<body>
		<!-- Site Content -->

		@if (!Auth::guest() && Auth::user()->confirmed==0)
			<div class="alert alert-danger text-center" role="alert">
				<strong>Attenzione!</strong> Per donare i tuoi oboli devi prima confermare l'indirizzo email.
			</div>
		@endif

		@if (Auth::guest() && Session::has('code'))
			<div class="alert alert-danger text-center" role="alert">
				<strong>Attenzione!</strong> Per poter donare gli oboli associati al codice devi effettuare l'accesso. <a data-toggle="modal" href="#" data-target=".signup-form" >Clicca qui.</a>
			</div>
		@endif

		@yield('top')

		<div id="wrapper">
			<!--Header Section Start Here -->
			<header id="header" class="sticky-yes">
				<div class="container">
					<div class="row primary-header">
						<a href="/" class="col-xs-12 col-sm-2 brand" title="Welcome to Oboli"><img src="{{ asset('img/web/logo.png') }}" alt="Oboli"></a>
						<div class="social-links col-xs-12 col-sm-10">						
							@if (Auth::check())
								<div class="oboli-count"><img src="{{ asset('img/web/coin.png') }}" />{{ Auth::user()->oboli_count }} <span class="hidden-xs">Obol{{ (Auth::user()->oboli_count==1) ? 'o' : 'i' }}</span></div>								
							@else
								<ul class="social-icons hidden-xs">
									<li>
										<a href="https://www.facebook.com/getoboli" target="_blank"><i class="fa fa-facebook"></i></a>
									</li>
									<li>
										<a href="https://twitter.com/getoboli" target="_blank"><i class="fa fa-twitter"></i></a>
									</li>
									<li>
										<a href="mailto:info@getoboli.com"><i class="fa fa-envelope"></i></a>
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
								<ul class="nav navbar-nav navbar-left">
									<li {{ (URL::current() == Config::get('local-config')['host']) ? 'class="active"' : '' }}>
										<a href="/">Home</a>
									</li>
									<li {{ (URL::current() == Config::get('local-config')['host'].'/ngos') ? 'class="active"' : '' }}>
										<a href="/ngos">Cause e Progetti</a>
									</li>
									<li {{ (URL::current() == Config::get('local-config')['host'].'/howitworks') ? 'class="active"' : '' }}>
										<a href="/howitworks">Come Funziona</a>
									</li>
									
									<!--
									<li {{ (URL::current() == Config::get('local-config')['host'].'/contact-us') ? 'class="active"' : '' }}>
										<a href="/contact-us">contattaci</a>
									</li>
									-->
									<!--
									@if (!Auth::guest())
										<li {{ (URL::current() == Config::get('local-config')['host'].'/users/'.Auth::id()) ? 'class="active"' : '' }}>
											<a href="/users/{{ Hashids::encode(Auth::id()) }}">Profilo</a>
										</li>					
									@endif
									-->
								</ul>
								<ul class="nav navbar-nav navbar-right">
									@if (Auth::guest())
										<li {{ (URL::current() == Config::get('local-config')['host'].'/login') ? 'class="active"' : '' }}>
											<a data-toggle="modal" href="#" data-target=".login-form" >LOGIN</a>
										</li>
										<li {{ (URL::current() == Config::get('local-config')['host'].'/signup') ? 'class="active"' : '' }}>
											<a data-toggle="modal" href="#" data-target=".signup-form" >REGISTRATI</a>
										</li>
									@else
										<li>
											<a href="/logout">LOGOUT</a>
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
                            <a href="/" title="Welcome to Charity"><img src="{{ asset('img/web/logo.png') }}" alt="Oboli"></a>
                        </div>
                        <p>
                        </p>
                        <ul>
                            <li>
                                <a href="/team">Chi Siamo</a>
                            </li>
                        </ul>
                        <p></p>
                    </div>
                    <!-- <div class="col-xs-12 col-sm-4 twitter-update"> -->
                    <div class="col-xs-12 col-sm-4 twitter-update">
                        <h6>Contattaci</h6>
                        <ul class="social-icons">
                            <li>
                                <a href="https://www.facebook.com/getoboli" target="_blank"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="https://twitter.com/getoboli" target="_blank"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="mailto:info@getoboli.com"><i class="fa fa-envelope"></i></a>
                            </li>
                        </ul>
                        <br>
                        <!--
                            <h6>Twitter Feed</h6>
                            <a class="twitter-timeline"  href="https://twitter.com/getoboli"
                               data-widget-id="532913595990818816"
                               data-theme="dark"
                               data-link-color="#ff6e03"
                               data-chrome="noscrollbar "
                               data-border-color="#ff6e03">Tweets by @getoboli</a>
                            -->
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <h6>Iscriviti alla Newsletter</h6>
                        <p>
                            Rimani aggiornato su notizie interessanti, novità sul progetto Oboli e molto altro ancora.
                        </p>
                        <form method="POST" action="http://edoventurini.com/mailinglist/new" accept-charset="UTF-8" role="form" class="sign-up">
                            <input name="_token" value="5zEbstZUtpN2Z9Z5HGtpnXCGnLnRznEfr5Dk6GSR" type="hidden">
                            <div class="input-group">
                                <input name="tag" value="mailing_list_footer" type="hidden">
                                <input class="form-control" name="email" id="email" placeholder="Email" type="email">
                                <div class="input-group-addon">
                                    <input class="btn btn-theme" value="Iscriviti" type="submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <span> © Copyright 2015, All Rights Reserved by Oboli. <small><a href="http://edoventurini.com/terms">Termini e condizioni d'uso.</a></small></span>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--Footer Section End Here -->
		</div>


		@yield('after-footer')



		@if (Auth::guest())
			<div aria-hidden="true" style="display: true;" class="modal login-form" id="login-modal">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								×
							</button>
						</div>
						<div class="modal-body">
							<div class="col-xs-12">
								<div class="panel panel-primary panel-login col-sm-12">
									<div class="panel-heading">
										<h3 class="panel-title">Login</h3>
									</div>
									<div class="panel-body">
										<a href="/login/fb" class="btn btn-block btn-social btn-lg btn-facebook"><i class="fa fa-facebook"></i>Login con Facebook</a>	                
							            <div class="row signup-separator">
							            	oppure
							            </div>
							  			 @if (Session::has('login-errors'))
											<ul>
												@foreach (Session::get('login-errors')->toArray() as $error)
													<li class="error">
														{{ $error[0] }}
													</li>
												@endforeach
											</ul>
							            @endif   
							  			{{ Form::open(array('url' => 'login')) }}
											<div class="form-group {{ (Session::has('login-errors') && Session::get('login-errors')->has('email')) ? 'error' : '' }}">
												<div class="input-group">
							                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
							                    	<input type="text" name="email" class="form-control" placeholder="email" value="{{ Session::get('input')['email'] }}"> 
							                    </div>
											</div>
											<div class="form-group {{ (Session::has('login-errors') && Session::get('login-errors')->has('password')) ? 'error' : '' }}">
												<div class="input-group">
							                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							                    	<input type="password" name="password" class="form-control" placeholder="password">
							                    </div>
											</div>
											<div class="form-group btns-wrapper">
												<button type="submit" class="btn btn-register">Accedi</button>
											</div>
							            {{ Form::close() }}
							            <div class="row signup-bottom">
							            	<a href="/password/remind"><strong>Hai dimenticato i dati di accesso?</strong></a><br>
							            	Non hai ancora un account? <a data-dismiss="modal" onclick="$('#signup-modal').modal('show');" href="#"><strong>Registrati!</strong></a>
							            </div>
									</div>
								</div>
							</div>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div>



			<div aria-hidden="true" style="display: true;" class="modal signup-form" id="signup-modal">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								×
							</button>
						</div>

						<div class="modal-body">
							<div class="col-xs-12">
								<div class="panel panel-primary panel-login col-sm-12">
									<div class="panel-heading">
										<h3 class="panel-title">Registrati</h3>
									</div>
									<div class="panel-body">
										<a href="/login/fb" class="btn btn-block btn-social btn-lg btn-facebook"><i class="fa fa-facebook"></i>Registrati con Facebook</a>	                
							            <div class="row signup-separator">
							            	<!-- <div class="col-sm-4 col-lg-4 line"></div> -->
							            	oppure
							            	<!-- <div class="col-sm-4 col-lg-4 col-lg-offse-4 text">oppure</div> -->
							            	<!-- <div class="col-sm-4 col-lg-4 line"></div> -->
							            </div>
							  			 @if (Session::has('signup-errors'))
							  			 	<div class="errors">
								  			 	<h3>Errori:</h3>
												<ul>
													@foreach (Session::get('signup-errors')->toArray() as $error)
														<li>
															{{ $error[0] }}
														</li>
													@endforeach
												</ul>
											</div>
							            @endif   
							  			 {{ Form::open(array('url' => 'signup')) }}
											<div class="form-group {{ (Session::has('signup-errors') && Session::get('signup-errors')->has('name')) ? 'error' : '' }}">
												<!--<label for="name">nome</label>-->
												 <div class="input-group">
						                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						                        	<input type="text" name="name" class="form-control" placeholder="nome" value="{{ Session::get('input')['name'] }}">
						                        </div>
											</div>
											<div class="form-group {{ (Session::has('signup-errors') && Session::get('signup-errors')->has('email')) ? 'error' : '' }}">
												<div class="input-group">
						                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
						                        	<input type="text" name="email" class="form-control" placeholder="email" value="{{ Session::get('input')['email'] }}"> 
						                        </div>
											</div>
											<div class="form-group {{ (Session::has('signup-errors') && Session::get('signup-errors')->has('password')) ? 'error' : '' }}">
												<div class="input-group">
						                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						                        	<input type="password" name="password" class="form-control" placeholder="password">
						                        </div>
											</div>
											<div class="form-group btns-wrapper">
												<button type="submit" class="btn btn-lg">Registrati</button>
												<br />
												<small>(cliccando su "Registrati" o "Registrati con Facebook" dichiari di accettare i <a href="/terms" target="_blank">termini e le condizioni d'uso</a> del servizio)</small>
											</div>
						                {{ Form::close() }}
							            <div class="row signup-bottom">
							            	Hai già un account? <a data-dismiss="modal" onclick="$('#login-modal').modal('show');" href="#"><strong>Effettua l'accesso!</strong></a>
							            </div>
									</div>
								</div>
							</div>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div>
		@endif


		@if (Session::has('new_code'))
		<div aria-hidden="false" style="display: block;" class="modal in" id="obolis-earned-modal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						×
						</button>
						<header class="page-header">
							<h2>Complimenti!</h2>
						</header>
					</div>
					<div class="modal-body">
						<div class="col-xs-12">
							<h3>Hai appena guadagnato:</h3>
                            <div class="amount">
                                <span>{{ Session::get('amount') }}</span>
                                <img src="{{ asset('img/web/piggy.png') }}" />
                            </div>
						</div>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		@endif

		@yield('modals')




		
	
		<script src="{{ asset('js/jquery.min.js') }}"></script>
		<script src="{{ asset('js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('js/jquery.easing.min.js') }}"></script>
		<script src="{{ asset('js/jquery-ui.js') }}"></script>
		<script src="{{ asset('js/jquery.ui.touch-punch.min.js') }}"></script>
		<!--Main Slider Js-->
		<script src="{{ asset('revolution-slider/js/jquery.themepunch.plugins.min.js') }}"></script>
		<script src="{{ asset('revolution-slider/js/jquery.themepunch.revolution.js') }}"></script>
		<!--Main Slider End Js-->
		<script src="{{ asset('js/jquery.flexslider.js') }}"></script>
		<script src="{{ asset('js/site.js') }}"></script>







		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-57160464-1', 'auto');
			ga('send', 'pageview');
		</script>

		<!-- sometime later, probably inside your on load event callback -->


		@if (Session::has('login-errors'))
			<script type="text/javascript">
			    $(window).load(function(){
			        $('#login-modal').modal('show');
			    });
			</script>
		@endif

		@if (Session::has('signup-errors'))
			<script type="text/javascript">
			    $(window).load(function(){
			        $('#signup-modal').modal('show');
			    });
			</script>
		@endif

		@if (Session::has('new_code'))
			<script type="text/javascript">
			    $(window).load(function(){
			        $('#obolis-earned-modal').modal('show');
			    });
			</script>
		@endif

		@yield('scripts')

	</body>
</html>
