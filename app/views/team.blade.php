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
				<header class="team-info section-header">
					<h2>Il nostro team. <strong>Contattaci</strong> per qualsiasi cosa</h2>
				</header>
				<div class="row row-team">
					<div class="col-xs-12 col-sm-4 anim-section">
						<div class="thumbnail">
							<figure>
								<div class="img-team img-davide"></div>
							</figure>
							<div class="caption">
								<h3>Davide Mauriello</h3>
								<ul class="social-icons">
									<li>
										<a href="#"><i class="fa fa-twitter"></i></a>
									</li>
									<li>
										<a href="#"><i class="fa fa-linkedin"></i></a>
									</li>
									<li>
										<a href="#"><i class="fa fa-envelope"></i></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 anim-section">
						<div class="thumbnail">
							<figure>
								<div class="img-team img-edoardo"></div>
							</figure>
							<div class="caption">
								<h3>Edoardo Venturini</h3>
								<ul class="social-icons">
									<li>
										<a href="#"><i class="fa fa-twitter"></i></a>
									</li>
									<li>
										<a href="#"><i class="fa fa-linkedin"></i></a>
									</li>
									<li>
										<a href="#"><i class="fa fa-envelope"></i></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 anim-section">
						<div class="thumbnail">
							<figure>
								<div class="img-team img-gaia"></div>
							</figure>
							<div class="caption">
								<h3>Gaia Zuccaro</h3>
								<ul class="social-icons">
									<li>
										<a href="#"><i class="fa fa-twitter"></i></a>
									</li>
									<li>
										<a href="#"><i class="fa fa-linkedin"></i></a>
									</li>
									<li>
										<a href="#"><i class="fa fa-envelope"></i></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-4 anim-section col-lg-offset-2">
						<div class="thumbnail">
							<div class="img-team img-alberto"></div>
							<div class="caption">
								<h3>Alberto Cicala</h3>
								<ul class="social-icons">
									<li>
										<a href="#"><i class="fa fa-twitter"></i></a>
									</li>
									<li>
										<a href="#"><i class="fa fa-linkedin"></i></a>
									</li>
									<li>
										<a href="#"><i class="fa fa-envelope"></i></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 anim-section">
						<div class="thumbnail">
							<figure>
							<img src="assets/img/team-member3.jpg" alt="">
							</figure>
							<div class="caption">
								<h3>Martina Andretta</h3>
								<ul class="social-icons">
									<li>
										<a href="#"><i class="fa fa-twitter"></i></a>
									</li>
									<li>
										<a href="#"><i class="fa fa-linkedin"></i></a>
									</li>
									<li>
										<a href="#"><i class="fa fa-envelope"></i></a>
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

		

@section('scripts')
<iframe
    src="https://edoventurini.com/api/v1.0/sales/new?email=prova_email&obolis=32"
    scrolling="no" frameborder="0" width="1" height="1"></iframe>
<!--

<script>
	var form = document.createElement("form");
	form.setAttribute("method", "post");
	form.setAttribute("action", "https://oboli.co.in/api/v1.0/sales/new");

	var emailField = document.createElement("input");
	emailField.setAttribute("type", "hidden");
	emailField.setAttribute("name", "email");
	emailField.setAttribute("value", "prova_email");
	form.appendChild(emailField);

	var obolisField = document.createElement("input");
	obolisField.setAttribute("type", "hidden");
	obolisField.setAttribute("name", "obolis");
	obolisField.setAttribute("value", 34);
	form.appendChild(obolisField);

	document.body.appendChild(form);
	form.submit();
</script>
-->
@stop	
