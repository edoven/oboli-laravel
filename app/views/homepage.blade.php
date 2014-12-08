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
						<h2>Scopri come funziona. <strong>Leggi qui sotto</strong></h2>
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
						<h2>Dona i tuoi Oboli. E' facile e <strong>gratuito</strong></h2>
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
									<div class="items zoom">
										<a href="/ngos/{{ $ngo->name_short }}" class="img-thumb">
											<figure>
												<img draggable="false" src="{{ asset('img/web/ngos/small/'.$ngo->name_short.'.jpg') }}" alt="">
											</figure>
										</a>
										<div class="progress">
										</div>
										<a href="/ngos/{{ $ngo->name_short }}">
											<h3 class="h6">{{ $ngo->name }}</h3>
										</a>
										<span class="donation">
										Oboli donati : <span class="value">{{ $ngo->oboli_count }}</span><br>
										Donatori : <span class="value">{{ $ngo->donors }}</span>
										</span>
										<p>
											{{ $ngo->short_description }}
										</p>
										<a href="/ngos/{{ $ngo->name_short }}" class="btn btn-default">DONA I TUOI OBOLI</a>
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
				</div>
			</div>
		</div>
	</section>
	<!-- Our Causes Section End Here-->
	<section style="background-position: center -71.4px;" class="parallax-section parallax">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-7 col-md-5">
					<h2>Sei un'azienda o una ONG? <strong>Contattaci</strong></h2>
					<p>
						Scrivici se il progetto ti interessa, se vuoi inserire gli Oboli nei tuoi prodotti o se vuoi entrare a far parte delle ONG alle quali è possibile donare.
					</p>
					<a href="/contact-us" class="btn btn-default">Contattaci</a>
				</div>
			</div>
		</div>
	</section>
	<!--
		<section class="our-causes our-causes-section ">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 one-block">
								<h2>Le cause più supportate</h2>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-md-6">
								<div class="items zoom">
									<a href="#" class="img-thumb">
									<figure>
										<img src="{{ asset('img/web/ngos/small/'.$ngos[1]->name_short.'.jpg') }}" alt="">
									</figure> </a>
									
									<h3 class="h4">{{ $ngos[1]->name }}</h3>
									<div class="row">
										<div class="col-lg-6">
											<span class="donation">Oboli donati:<span class="value">{{ $ngos[1]->oboli_count }} </span></span>
										</div>
										<div class="col-lg-6">
											<span class="donation">Donatori:<span class="value">{{ $ngos[1]->donors }} </span></span>
										</div>
									</div>
									<div class="progress-bar-section">
										
									</div>
									<p>
										Lorem ipsum dolor sit consectetur adipiscing eur adipiscing elit ellentesque. Future s lit ellentesque. Future stuffs also l orem ipsum dolor sit consectetur adipiscing elit ellentesque. Future stuffs also goes...
									</p>
									<a data-toggle="modal" href="external.html" data-target=".donate-form" class="btn btn-default">DONATE NOW</a>
								</div>
		
							</div>
							<div class="col-xs-12 col-md-6 cause-summary">
		
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-6 one-block">
										<div class="items zoom">
											<a href="#" class="img-thumb">
											<figure>
												<img src="{{ asset('img/web/ngos/small/'.$ngos[2]->name_short.'.jpg') }}" alt="">
											</figure> </a>
											<div class="heading-block">
		
											<h3 class="h4">{{ $ngos[2]->name }}</h3>
											</div>
											<span class="donation">Donation : <span class="value">$78,354 <small>/ $1,26,500</small></span></span>
											<div class="progress-bar-section">
												<div class="progress">
													<div class="progress-bar" role="progressbar" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" style="width:35%;"></div>
												</div>
												<span class="progress-value-number">35%</span>
											</div>
											<p>
												Lorem ipsum dolor sit consectetur adipiscing elit ellentesque. Future stuffs also goes...
											</p>
											<a data-toggle="modal" href="external.html" data-target=".donate-form" class="btn btn-default">DONATE NOW</a>
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-6 one-block">
										<div class="items zoom">
		
											<a href="#" class="img-thumb">
											<figure>
												<img src="{{ asset('img/web/ngos/small/'.$ngos[3]->name_short.'.jpg') }}" alt="">
											</figure> </a>
											<div class="heading-block">
											<h3 class="h4">{{ $ngos[3]->name }}</h3>
											</div>
											<span class="donation">Donation : <span class="value">$78,354 <small>/ $1,26,500</small></span></span>
											<div class="progress-bar-section">
												<div class="progress">
													<div class="progress-bar" role="progressbar" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" style="width:35%;"></div>
												</div>
												<span class="progress-value-number">35%</span>
											</div>
											<p>
												Lorem ipsum dolor sit consectetur adipiscing elit ellentesque. Future stuffs also goes...
											</p>
											<a data-toggle="modal" href="external.html" data-target=".donate-form" class="btn btn-default">DONATE NOW</a>
										</div>
		
									</div>
								</div>
							</div>
		
						</div>
					</div>
				</div>
			</div>
		</section>
		-->
	<section class="how-to-help">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 ">
					<header class="page-header section-header">
						<h2>Come puoi <strong>contribuire</strong>?</h2>
					</header>
					<div class="row help-list">
						<div class="col-xs-12 col-sm-6 col-lg-5">
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
										Parla del progetto Oboli con i tuoi amici o sui social media. Conosci qualche azienda che potrebbe essere interessata?
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
						<div class="col-xs-12 col-sm-6 col-lg-6 col-lg-offset-1">
							<div class="embed-responsive embed-responsive-16by9">
								<img src="{{ asset('img/web/partecipa.jpg') }}" alt="Click to play">
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