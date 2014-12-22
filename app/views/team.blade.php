@extends('layouts.master')

@section('title')
Chi Siamo
@stop


@section('content')
<div class="content-wrapper" id="page-info">
	<!-- Our Team Section Start Here -->
	<div class="container">
		<div class="our-team text-center row">
			<div class="col-xs-12">
				<header class="page-info section-header">
					<h2>Il nostro team. <strong>Contattaci</strong> per qualsiasi cosa</h2>
				</header>

				<div class="row">
					<div class="col-xs-12 col-sm-4 anim-section animate">
						<div class="thumbnail">
							<figure>
							<img src="{{ asset('img/web/team/davide1.png')}}" alt="">
							</figure>
							<div class="caption">
								<h3>Davide Mauriello</h3>
								<ul class="social-icons">
									<li>
										<a href="https://twitter.com/davidemauriello" target="_blank"><i class="fa fa-twitter"></i></a>
									</li>
									<li>
										<a href="https://it.linkedin.com/in/davidemauriello" target="_blank"><i class="fa fa-linkedin"></i></a>
									</li>
									<li>
										<a href="mailto:davide@getoboli.com"><i class="fa fa-envelope"></i></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 anim-section animate">
						<div class="thumbnail">
							<figure>
								<img src="{{ asset('img/web/team/edoardo1.png')}}" alt="">
							</figure>
							<div class="caption">
								<h3>Edoardo Venturini</h3>
								<ul class="social-icons">
									<li>
										<a href="https://twitter.com/edoventurini" target="_blank"><i class="fa fa-twitter"></i></a>
									</li>
									<li>
										<a href="https://it.linkedin.com/in/edoardoventurini" target="_blank"><i class="fa fa-linkedin"></i></a>
									</li>
									<li>
										<a href="mailto:edoardo@getoboli.com"><i class="fa fa-envelope"></i></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 anim-section animate">
						<div class="thumbnail">
							<figure>
								<img src="{{ asset('img/web/team/gaia1.png')}}" alt="">
							</figure>
							<div class="caption">
								<h3>Gaia Zuccaro</h3>
								<ul class="social-icons">
									<li>
										<a href="https://twitter.com/gaiazzz" target="_blank"><i class="fa fa-twitter"></i></a>
									</li>
									<li>
										<a href="https://it.linkedin.com/in/gaiazuccaro" target="_blank"><i class="fa fa-linkedin"></i></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<br />
				<br />
				<div class="row">
					<div class="col-xs-12 col-sm-4 col-sm-offset-2 anim-section animate">
						<div class="thumbnail">
							<figure>
								<img src="{{ asset('img/web/team/alberto1.png')}}" alt="">
							</figure>
							<div class="caption">
								<h3>Alberto Cicala</h3>
								<ul class="social-icons">
									<li>
										<a href="https://twitter.com/AlbertoCicala" target="_blank"><i class="fa fa-twitter"></i></a>
									</li>
									<li>
										<a href="http://it.linkedin.com/in/albertocicala" target="_blank"><i class="fa fa-linkedin"></i></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 anim-section animate">
						<div class="thumbnail">
							<figure>
								<img src="{{ asset('img/web/team/martina1.png')}}" alt="">
							</figure>
							<div class="caption">
								<h3>Martina Andretta</h3>
								<ul class="social-icons">
									<li>
										<a href="http://it.linkedin.com/in/martinandretta" target="_blank"><i class="fa fa-linkedin"></i></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Our Team Section Start Here -->
</div>		
@stop