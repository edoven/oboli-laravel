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
					<img src="assets/img/slide-banner-01.jpg" alt="banner" data-bgfit="cover" data-bgposition="center 36%" data-bgrepeat="no-repeat">


					<div
					data-endspeed="500"
					data-easing="easeOutCirc"
					data-start="900"
					data-speed="700"
					data-y="150"
					data-x="152"
					class="tp-caption sft third-style banner-heading banner-title">
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
						<a data-toggle="modal" href="external.html" data-target=".donate-form" class="btn btn-default">Scopri come</a>
					</div>
				</li>
			</ul>
		</div>
	</section>
	<!-- banner slider End Here -->
	
	<!-- How To Help Section Start Here -->
	<section class="how-to-help help-section">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 ">
					<header class="page-header section-header">
						<h2>Come funziona? <strong class="border-none">Guarda qui sotto</strong></h2>
					</header>
					<div class="row help-list">
						<div class="col-xs-12 col-sm-12 col-lg-12">
							<div class="row">
								<div class="media col-xs-12 col-md-4">
									<div class="media-content equal-block">
										<span class="fa fa-money howto">  </span>
										<div class="media-body less-width">
											<h3 class="media-heading">Oboli è una moneta virtuale</h3>
											<p>
												1000 Oboli = 1 Euro. <br /> Oboli è una moneta virtuale che ti pemette di creare un mondo migliore in maniera semplice e <strong>gratuita</strong>.
											</p>
										</div>
									</div>
								</div>
								<div class="media col-xs-12 col-md-4">
									<div class="media-content equal-block">
										<span class="fa fa-database howto">  </span>
										<div class="media-body less-width">
											<h3 class="media-heading">Ottieni gli Oboli</h3>
											<p>
												Puoi ottenere gli Oboli acquistando diversi prodotti. Come avviene con i punti fedeltà.
											</p>
										</div>
									</div>
								</div>
								<div class="media col-xs-12 col-md-4">
									<div class="media-content equal-block">
										<span class="fa fa-heart howto">  </span>
										<div class="media-body less-width">
											<h3 class="media-heading">Dona i tuoi Oboli</h3>
											<p>
												Dona i tuoi oboli alle ONG e ai progetti sociali che trovi qui.
											</p>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- How To Help Section End Here-->
	
	
	<!-- Our Causes Section Start Here-->
	<section class="our-causes our-causes-section our-causes3">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<header class="page-header section-header">
						<h2>Dona i tuoi oboli. E' facile e  <strong>gratuito</strong>.</h2>
						<span>Sceglie le ONG e le associazioni a cui donare gli oboli che possiedi. </span>
					</header>

					<div class="row">
						<?php
						$ngos = Ngo::all();
						?>
						@for ($i = 0; $i<3; $i++)
							<?php
								$ngo = $ngos[$i];
							?>
						
						
						
							<div class="col-xs-12 col-md-4 item-wrapper">
								<div class="items zoom">
									<a href="/ngos/{{ $ngo->id }}" class="img-thumb">
										<figure>
											<img src="assets/img/our-cause-pic.jpg" alt="">
										</figure> 
									</a>
									<div class="item-content">
										<h3><a href="/ngos/{{ $ngo->id }}">{{ $ngo->name }}</a></h3>
										<div class="row">
											<div class="col-xs-6 col-md-6 item-wrapper">
												<div class="donation">Oboli donati : <span class="value">{{ $ngo->oboli_count }}</span></div>
											</div>
											<div class="col-xs-6 col-md-6 item-wrapper">
												<div class="donation">Donatori : <span class="value">{{ $ngo->donors }}</span></div>
											</div>
										</div>
										<div class="progress-bar-section">
											<div class="progress">
												<div class="progress-bar" role="progressbar" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" style="width:35%;"></div>
											</div>
											<span class="progress-value-number">35%</span>
										</div>
										<p>{{ $ngo->short_description }}</p>
										
										@if (Auth::guest())
											<a class="btn btn-default btn-volunteer" href="/access">Entra e dona i tuoi Oboli</a>
										@else
											@if (Auth::user()->oboli_count > 2)
												<div class="col-md-1">
													{{ Form::open(array('url' => 'makeDonation')) }}
														{{ Form::hidden('ngo_id', $ngo['id']) }}
														{{ Form::hidden('amount', 1) }}
														{{ Form::submit('1 Oboli', array('class' => 'btn btn-default',)) }}
													{{ Form::close() }} 
												</div>
												<div class="col-md-1">
													{{ Form::open(array('url' => 'makeDonation')) }}
														{{ Form::hidden('ngo_id', $ngo['id']) }}
														{{ Form::hidden('amount', Auth::user()->oboli_count) }}
														{{ Form::submit(Auth::user()->oboli_count.' Oboli', array('class' => 'btn btn-default',)) }}	
													{{ Form::close() }} 
												</div>
												<div class="col-md-1">
													{{ Form::open(array('url' => 'makeDonation')) }}
														{{ Form::hidden('ngo_id', $ngo['id']) }}
														<?php echo Form::selectRange('amount', 1, Auth::user()->oboli_count); ?>
														{{ Form::submit('Dona', array('class' => 'btn btn-default',)) }}
													{{ Form::close() }} 
												</div>
											@endif
											
											@if (Auth::user()->oboli_count == 2)
												<div class="col-md-1">
												{{ Form::open(array('url' => 'makeDonation')) }}
													{{ Form::hidden('ngo_id', $ngo['id']) }}
													{{ Form::hidden('amount', 1) }}
													{{ Form::submit('1 Oboli', array('class' => 'btn btn-default',)) }}
												{{ Form::close() }} 
												</div>
												<div class="col-md-1">
												{{ Form::open(array('url' => 'makeDonation')) }}
													{{ Form::hidden('ngo_id', $ngo['id']) }}
													{{ Form::hidden('amount', 2) }}
													{{ Form::submit('2 Oboli', array('class' => 'btn btn-default',)) }}
												{{ Form::close() }} 
												</div>
											@endif
											
											@if (Auth::user()->oboli_count == 1)
												<div class="col-md-1">
												{{ Form::open(array('url' => 'makeDonation')) }}
													{{ Form::hidden('ngo_id', $ngo['id']) }}
													{{ Form::hidden('amount', 1) }}
													{{ Form::submit('1 Obolo', array('class' => 'btn btn-default',)) }}
												{{ Form::close() }} 
												</div>
											@endif
											
											@if (Auth::user()->oboli_count == 0)
												<div class="col-md-1">
													<button class="btn btn-default'">Non hai oboli da donare :(</button>
												
												</div>
											@endif
										@endif

									</div>
								</div>
							</div>
							
						@endfor

					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Our Causes Section End Here-->
	
	



	<!-- Become Volunteer Section Start Here -->
	<section class="parallax-section parallax">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-7 col-md-5">
					<h2>Cosa dicono di noi</h2>
					<p>
						Oboli può davvero rivoluzionare il mondo di raccogliere i fondi per ONG e associazioni.
					</p>
					<a data-toggle="modal" href="external.html" data-target=".join-now-form" class="btn btn-default">Join Now</a>
				</div>
			</div>
		</div>
	</section>
	<!-- Become Volunteer Section End Here -->
</div>

@stop

			
