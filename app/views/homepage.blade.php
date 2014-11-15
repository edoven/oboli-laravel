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
										<span class="fa fa-qrcode howto">  </span>
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
	<!--
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

										</div>
										<p>{{ $ngo->short_description }}</p>
										
										@if (Auth::guest())
											<div class="row">
												<a class="btn btn-default" href="/access">Entra e dona i tuoi Oboli</a>
											</div>
										@else
											@if (Auth::user()->oboli_count > 2)
												<div class="row">
													{{ Form::open(array('url' => 'makeDonation')) }}
														{{ Form::hidden('ngo_id', $ngo['id']) }}
														{{ Form::hidden('amount', 1) }}
														{{ Form::submit('1 Oboli', array('class' => 'btn btn-default')) }}
														{{ Form::submit(Auth::user()->oboli_count.' Oboli', array('class' => 'btn btn-default')) }}
													{{ Form::close() }} 
												</div>
												<div class="row">
													<div>
														{{ Form::open(array('url' => 'makeDonation')) }}
															{{ Form::hidden('ngo_id', $ngo['id']) }}
															<input id="ex{{ $i }}" name="amount" data-slider-id='ex{{ $i }}Slider' type="text" data-slider-min="1" data-slider-max="{{ Auth::user()->oboli_count }}" data-slider-step="1" data-slider-value="1" />	
															{{ Form::submit('Dona', array('class' => 'btn btn-default',)) }} <span id="ex{{ $i }}SliderVal">1</span>
														{{ Form::close() }} 
													</div>
												</div>
											@endif					
											@if (Auth::user()->oboli_count == 2)
												<div class="col-md-1">
												{{ Form::open(array('url' => 'makeDonation')) }}
													{{ Form::hidden('ngo_id', $ngo['id']) }}
													{{ Form::hidden('amount', 1) }}
													{{ Form::submit('1 Oboli', array('class' => 'btn btn-default')) }}
													{{ Form::submit('2 Oboli', array('class' => 'btn btn-default')) }}
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
	-->
	<!-- Our Causes Section End Here-->




	<!-- Our Causes Section Start Here-->
				<section class="our-causes our-causes-section our-causes3">
					<div class="container">
						<div class="row">
							<div class="col-xs-12">
								<header class="page-header section-header">
									<h2>Dona i tuoi Oboli. E' facile e  <strong class="border-none">gratuito</strong>.</h2>
								</header>

								<div class="article-list flexslider article-slider progressbar">
									<ul class="slides">
										<?php 
										$ngos = Ngo::all(); 
										$ngos->shuffle();
										?>
										@for ($i = 0; $i<count($ngos); $i++)
											<?php $ngo = $ngos[$i]; ?>
											<li>
												<div class="items zoom">
													<a href="#" class="img-thumb">
														<figure>
															<img src="{{ asset('img/web/ngos/small/'.$ngo->name_short.'.jpg') }}" alt="{{ $ngo->name }}">
														</figure> 
													</a>
													<div class="item-content">
														<h3 class="h4">
															<a href="/ngos/{{ $ngo->id }}">{{ $ngo->name }}</a>
														</h3>
														<div class="row">
															<div class="col-xs-6">
																<span class="fa fa-money ngo">  </span>
																@if ($ngo->oboli_count == 1)
																	<div class="donation"><span class="value">1</span> Obolo donato</div>
																@else
																	<div class="donation"><span class="value">{{ $ngo->oboli_count }}</span> Oboli donati</div>
																@endif
															</div>
															<div class="col-xs-6">
																<span class="fa fa-child ngo">  </span>
																@if ($ngo->donors == 1)
																	<div class="donation"><span class="value">1</span> donatore</div>
																@else
																	<div class="donation"><span class="value">{{ $ngo->donors }}</span> donatori</div>
																@endif
															</div>
														</div>
														<p>
															{{ $ngo->long_description }}
														</p>
														@if (Auth::guest())
															<a href="/access" class="btn btn-default">entra e dona i tuoi oboli</a>
														@else
															@if (Auth::user()->oboli_count == 0)
																<div>
																	<input  class="btn btn-default" type="submit" value="Non hai Oboli da donare">
																</div>
															@else
																@if (Auth::user()->oboli_count == 1)
																	{{ Form::open(array('url' => 'makeDonation')) }}
																		{{ Form::hidden('ngo_id', $ngo['id']) }}
																		{{ Form::hidden('amount', 1) }}
																		{{ Form::submit('Dona 1 Obolo', array('class' => 'btn btn-default',)) }}
																	{{ Form::close() }} 
																@else
																	{{ Form::open(array('url' => 'makeDonation')) }}
																		{{ Form::hidden('ngo_id', $ngo['id']) }}
																		<input id="ex{{ $i }}" name="amount" data-slider-id='ex{{ $i }}Slider' type="text" data-slider-min="1" data-slider-max="{{ Auth::user()->oboli_count }}" data-slider-step="1" data-slider-value="1" data-slider-tooltip="always" />	
																		<div>
																			<input  class="btn btn-default" type="submit" value="dona">
																		</div>
																	{{ Form::close() }} 
																@endif
															@endif
														@endif
													</div>
												</div>
											</li>
										@endfor							
									</ul>
								</div>
							</div>
						</div>
					</div>
				</section>
	<!-- Our Causes Section End Here-->
	
	


			<section style="background-position: center -41.1px;" class="testimonial parallax">
				<div class="overlay"></div>
					<div class="container">
						<div class="row">
							<div class="col-xs-12">
								<div class="testimonial-slider flexslider">
									
								<div style="overflow: hidden; position: relative;" class="flex-viewport">
									<ul style="width: 600%; margin-left: -1140px;" class="slides">
										<li style="width: 1140px; float: left; display: block;" class="">
											<div class="slide">
												<h2>Cosa dicono i volontari <strong> Leggi qui sotto </strong></h2>
												<blockquote>
													<p>
														“Oboli è un progetto veramente rivoluzionario che può cambiare per sempre il mondo delle donazioni. ”
													</p>
													<footer>
														<span>Federica Spanna</span>
														<cite>(Fondazione per i Diritti delle Donne)</cite>
													</footer>
												</blockquote>
											</div>
										</li>
									</ul>
								</div>
						</div>
					</div>
				</section>




</div>

@stop


@section('scripts')

	<?php echo("<script>") ?>
		@for ($i = 0; $i<count($ngos); $i++)
			<?php $ngo = $ngos[$i]; ?>
			$('#ex{{ $i }}').slider({
				formatter: function(value) {
					//return 'Current value: ' + value;
					if (value == 1)
						return '1 Obolo';
					else
						return value + ' Oboli';
				}
			});
		@endfor
	<?php echo("</script>") ?>

@stop
	
