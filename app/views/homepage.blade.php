@extends('layouts.master')

@section('title')
Home
@stop

@section('content')
<!-- Site Content -->
<div id="main">
	<!-- banner slider Start Here -->
	<section class="rev_slider_wrapper banner-section">
		<div class="rev_slider banner-slider">
			<ul>
				<!-- SLIDE  -->

				<li data-transition="fade" data-slotamount="7" data-masterspeed="500" class="slide-1" >
					<!-- MAIN IMAGE -->
					<img src="img/web/slide-01.jpg" alt="banner" data-bgfit="cover" data-bgposition="center 36%" data-bgrepeat="no-repeat">
					<div 
						style="min-height: 0px; 
							   min-width: 0px; 
							   white-space: nowrap; 
							   line-height: 22px; 
							   border-width: 0px; 
							   margin: 0px; 
							   padding: 0px; 
							   font-size: 14px; 
							   visibility: visible; 
							   opacity: 0; 
							   top: 100px; 
							   left: 382px; 
							   transform: none;
							   font-color: white;" 
						data-endspeed="800" 
						data-easing="easeOutCirc" 
						data-start="800" 
						data-speed="700" 
						data-y="150" 
						data-x="152" 
						class="tp-caption sft banner-heading start">
						<h2>
							<strong>Aiutare gli altri?</strong>													
							Con Oboli è semplice <br /> e gratuito
						</h2>
					</div>
					<div
						data-endspeed="800"
						data-easing="easeOutCirc"
						data-start="1200"
						data-speed="700"
						data-y="316"
						data-x="152"
						class="tp-caption sft">
						<a href="#howitworks-home" class="btn btn-default btn-slider">Scopri come</a>
					</div>
				</li>
			</ul>
		</div>
	</section>
	<!-- banner slider End Here -->
	<!-- How does it work Section Start Here-->
	<section class="container services text-center">
		<div class="row">
			<div class="col-xs-12">
				<header class="service-header section-header">
					<a name="howitworks-home"></a> 
					<div class="page-header section-header clearfix">
						<h2>Scopri come funziona. <strong style="border: none;">Leggi qui sotto</strong></h2>
					</div>
				</header>
				<div class="row">
					<div class="col-xs-12 col-sm-4 zoom">
						<img src="img/web/howto1.png" alt="">
						<h2 class="h2">Oboli è una <br \><span class="howto-orange">moneta</span> virtuale</h2>
						<hr class="howto">
						<p>
							1000 Oboli = 1 Euro. <br /> Oboli è una moneta virtuale che ti pemette di creare un mondo migliore in maniera semplice e <strong>gratuita</strong>.
						</p>
					</div>
					<div class="col-xs-12 col-sm-4 zoom ">
						<img src="img/web/howto2.png" alt="">
						<h2 class="h2">Come <span class="howto-orange">ottenere</span><br \>gli Oboli</h2>
						<hr class="howto">
						<p>
							Puoi ottenere gli Oboli acquistando dei prodotti convenzionati. Puoi ottenere ad esempio 100 oboli comprando una bevanda o 200 oboli comprando un bagnoschiuma.
						</p>
					</div>
					<div class="col-xs-12 col-sm-4 zoom">
						<img src="img/web/howto3.png" alt="">
						<h2 class="h2"><span class="howto-orange">Dona</span><br \> i tuoi Oboli</h2>
						<hr class="howto">
						<p>
							Dona i tuoi oboli a ONG, associazioni con finalità sociali e progetti umanitari.<br>E' facile e <strong>non ti costa nulla</strong>.
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Services Section End Here-->
	<!-- Out Causes Section Starts Here-->
	<section class="our-causes">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="page-header section-header clearfix">
						<h2>Dona i tuoi Oboli. E' facile e <strong style="border: none;">gratuito</strong></h2>
					</div>
					<div class="article-list flexslider article-slider progressbar">
						<div style="overflow: hidden; position: relative;" class="flex-viewport">
							<ul style="width: 1800%; margin-left: -2340px;" class="slides">
								<?php 
									$ngos = Ngo::all(); 
									$ngos->shuffle();
									?>
								@for ($i = 0; $i<count($ngos); $i++)
								<?php $ngo = $ngos[$i]; ?>
								<li style="width: 360px; float: left; display: block;">
									<div class="items">
										<a href="/ngos/{{ $ngo->name_short }}" class="img-thumb zoom">
											<figure>
												<img draggable="false" src="{{ asset('img/web/ngos/small/'.$ngo->name_short.'.jpg') }}" alt="">
											</figure>
										</a>
										<div class="progress">
											<div class="progress1">
												<div class="progress2">
													<div class="progress3">

													</div>
												</div>
											</div>	
										</div>
										<div class="details">
											<a href="/ngos/{{ $ngo->name_short }}">
												<h3 class="h6">{{ $ngo->name }}</h3>
											</a>
											<span class="donation">
												<div class="row">
													<div class="col-xs-3 element">
														<span><img class="metric-icon" src="{{ asset('img/web/donated.png') }}" /> <div class="metric-number">{{ $ngo->oboli_count }}</div><span>
													</div>
													<div class="col-xs-3 element">
														<span><img class="metric-icon" src="{{ asset('img/web/donors.png') }}"> <div class="metric-number">{{ $ngo->donors }}</div><span>
													</div>
												</div>
											</span>
											<p>
												{{ $ngo->middle_description }}
											</p>
											<a href="/ngos/{{ $ngo->name_short }}" class="btn btn-default btn-donation">dona i tuoi Oboli</a>
										</div>
									</div>
								</li>
								@endfor
							</ul>
						</div>
						<ul class="flex-direction-nav">
							<li><a class="flex-prev" href="#">Previous</a></li>
							<li><a tabindex="-1" class="flex-next flex-disabled" href="#">Next</a></li>
						</ul>
					</div>
					<div class="show-all-btn">
						<a href="/ngos" class="btn btn-default btn-lg">MOSTRA TUTTI I PROGETTI</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Our Causes Section End Here-->
	<section style="background-position: center -71.4px;" class="parallax-section parallax">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-7 col-md-5">
					<h2>Sei un'azienda o una ONG? <strong >Contattaci</strong></h2>
					<p>
						Scrivici se il progetto ti interessa, se vuoi inserire gli Oboli nei tuoi prodotti o se vuoi entrare a far parte delle ONG alle quali è possibile donare.
					</p>
					<a href="/contact-us" class="btn btn-default">Contattaci</a>
				</div>
			</div>
		</div>
	</section>

	<section class="how-to-help">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 ">
					<header class="page-header section-header">
						<h2>Come puoi <strong style="border: none;">contribuire</strong>?</h2>
					</header>
					<div class="row help-list">
						<div class="col-xs-12 col-sm-7 col-lg-6">
							<article class="media">
								<a class="pull-left warning-icon-box" href="our-story.html"><i class="icon-user"></i></a>
								<div class="media-body less-width">
									<h3 class="media-heading">Scegli</h3>
									<p>
										Scegli i prodotti che contengono gli Oboli per fare del bene in maniera semplice e gratuita.
									</p>
								</div>
							</article>
							<article class="media">
								<a class="pull-left warning-icon-box" href="volunteer.html"><i class="icon-volume"></i></a>
								<div class="media-body less-width">
									<h3 class="media-heading">Diffondi</h3>
									<p>
										Parla del progetto Oboli con i tuoi amici o sui social media. Conosci qualche azienda o associazione che potrebbe essere interessata? Faccelo sapere.
									</p>
								</div>
							</article>
							<article class="media">
								<a class="pull-left warning-icon-box" href="external.html" data-toggle="modal" data-target=".donate-form"><i class="icon-heart"></i></a>
								<div class="media-body less-width">
									<h3 class="media-heading">Contattaci</h3>
									<p>
										Contattaci e raccontaci cosa ne pensi del progetto Oboli. Contiamo anche sul tuo aiuto per migliorare ogni giorno!
									</p>
								</div>
							</article>
						</div>



						<div class="col-xs-12 col-sm-5 col-lg-5 col-lg-offset-1">
							<div class="volunteer-reward">
								<div class="reward-apply">
									<header class="page-header">
										<strong class="get-involved">GET <span>INVOLVED</span> </strong>
										<span class="svg-shape user-svg-shape"> <svg class="svg replaced-svg" xml:space="preserve" enable-background="new 0 0 72 72" viewBox="0 0 72 72" height="72px" width="72px" y="0px" x="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" id="Layer_1" version="1.1">
<g>
<g>
	<path d="M36.083,45.154c-9.49,0-16.428-17.231-16.428-26.2c0-9.059,7.369-16.428,16.428-16.428    c9.058,0,16.428,7.369,16.428,16.428C52.511,27.922,45.573,45.154,36.083,45.154z M36.083,6.526    c-6.853,0-12.428,5.575-12.428,12.428c0,7.764,6.388,22.2,12.428,22.2c6.039,0,12.428-14.437,12.428-22.2    C48.511,12.101,42.936,6.526,36.083,6.526z"></path>
</g>
<g>
	<g>
		<path d="M27.688,20.425c-0.553,0-1-0.447-1-1c0-5.499,4.474-9.973,9.973-9.973c0.552,0,1,0.448,1,1c0,0.553-0.448,1-1,1     c-4.396,0-7.973,3.577-7.973,7.973C28.688,19.978,28.24,20.425,27.688,20.425z"></path>
	</g>
	<g>
		<path d="M28.039,24.264c-0.27,0-0.52-0.1-0.71-0.29c-0.189-0.189-0.29-0.45-0.29-0.71s0.101-0.52,0.29-0.71     c0.37-0.37,1.04-0.37,1.41,0c0.19,0.19,0.3,0.45,0.3,0.71c0,0.271-0.109,0.521-0.3,0.71C28.56,24.165,28.3,24.264,28.039,24.264z     "></path>
	</g>
</g>
<g>
	<path d="M36,69.475c-5.649,0-24.083-0.577-24.083-8c0-10.635,7.018-20.227,17.066-23.326l1.225-0.378l0.855,0.955    c3.062,3.42,6.725,3.581,10.01-0.066l0.861-0.956l1.227,0.387c9.963,3.144,16.922,12.76,16.922,23.385    C60.083,68.898,41.649,69.475,36,69.475z M29.028,42.36c-7.777,2.934-13.111,10.625-13.111,19.115c0,1.102,6.175,4,20.083,4    c13.907,0,20.083-2.898,20.083-4c0-8.486-5.283-16.199-12.986-19.17c-2.141,2-4.544,3.049-7.014,3.049    C33.555,45.354,31.139,44.324,29.028,42.36z"></path>
</g>
</g>
</svg> </span>
										<h2>Be a volunteer &amp; reap the
										rewards</h2>
									</header>
									<p>
										Integer accumsan nec orci at lacinia. Duis id sodales metus, eu efficitur massa am consequat tellus at sem  tortor rutrum orci blandit efficitur.
									</p>
									<a href="#" class="btn btn-default" title="Apply Today">Apply Today</a>
								</div>
							</div>
						</div>




					</div>
				</div>
			</div>
		</div>
	</section>
	<section style="background-position: center -57.6px;" class="testimonial parallax">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="testimonial-slider flexslider">
						<div style="overflow: hidden; position: relative;" class="flex-viewport">
							<ul style="width: 600%; margin-left: -2280px;" class="slides">
								<li style="width: 1140px; float: left; display: block;" class="">
									<div class="slide">
										<h2>Cosa dicono di noi <strong> Leggi qui sotto </strong></h2>
										<blockquote>
											<p>
												“Oboli è un'idea tanto semplice quanto rivoluzionaria. ”
											</p>
											<footer>
												<span>Jhon doe</span>
												<cite>(New media of Marketing firm)</cite>
											</footer>
										</blockquote>
									</div>
								</li>
								<li class="" style="width: 1140px; float: left; display: block;">
									<div class="slide">
										<h2>Cosa dicono di noi <strong> Leggi qui sotto </strong></h2>
										<blockquote>
											<p>
												“Oboli può veramente rivoluzionare il mondo delle donazioni.”
											</p>
											<footer>
												<span>Jhon doe</span>
												<cite>(New media of Marketing firm)</cite>
											</footer>
										</blockquote>
									</div>
								</li>
								<li class="flex-active-slide" style="width: 1140px; float: left; display: block;">
									<div class="slide">
										<h2>Cosa dicono di noi <strong> Leggi qui sotto </strong></h2>
										<blockquote>
											<p>
												“Quando ho sentito parlare di questo progetto per la prima volta mi sono subito chiesto: come ho fatto a non pensarci io?!”
											</p>
											<footer>
												<span>Tony Vedvik</span>
												<cite>(Head Sales of Sense Technology)</cite>
											</footer>
										</blockquote>
									</div>
								</li>
							</ul>
						</div>
						
						<ul class="flex-direction-nav">
							<li><a class="flex-prev" href="#">Previous</a></li>
							<li><a tabindex="-1" class="flex-next flex-disabled" href="#">Next</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@stop