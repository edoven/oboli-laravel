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
					<h2>
						<span class="orange-border">Scopri come funziona, <strong class="border-none orange">leggi qui sotto</strong></span>
					</h2>
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
									<h2>
										<span class="orange-border">Dona i tuoi Oboli. E' facile e  <strong class="border-none orange">gratuito</strong>.</span>
									</h2>
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
													<a href="/ngos/{{ $ngo->name_short }}" class="img-thumb">
														<figure>
															<img class="main" src="{{ asset('img/web/ngos/small/'.$ngo->name_short.'.jpg') }}" alt="{{ $ngo->name }}">
														</figure> 
													</a>
													<div class="item-content">
														<div class="ngo-name-area">
															<div class="ngo-name-text">
																<p>
																	@if (strlen($ngo->name)<50)
																		<a href="/ngos/{{ $ngo->name_short }}">{{ $ngo->name }}</a>
																	@else
																		<a style="font-size:14px; line-height: 20%;" href="/ngos/{{ $ngo->name_short }}">{{ $ngo->name }}</a>
																	@endif
																</p>
															</div>
														</div>
														<div class="row">
															<div class="col-xs-6">
																<img class="ngo-icon" src="{{ asset('img/web/donations.png') }}" />
																<hr class="ngo">
																<div class="donation">
																	<div class="donation-number">{{ $ngo->oboli_count }}</div>
																	<div class="donation-string">oboli donat{{ ($ngo->oboli_count == 1) ? 'o' : 'i' }}</div>
																</div>
															</div>
															<div class="col-xs-6">
																<img class="ngo-icon" src="{{ asset('img/web/donors.png') }}" />
																<hr class="ngo">
																<div class="donation">
																	<div class="donation-number">{{ $ngo->donors }}</div>
																	<div class="donation-string">donator{{ ($ngo->donors == 1) ? 'e' : 'i' }}</div>
																</div>
															</div>
														</div>
														<p>
															{{ $ngo->short_description }}
														</p>
														@if (Auth::guest())
															<div class="btn-donation">
																<a href="/access" class="btn-donation">Accedi e dona i tuoi Oboli</a>
															</div>
															
														@else
															@if (Auth::user()->oboli_count >0)
																{{ Form::open(array('url' => 'makeDonation', 'class' => 'donation-form')) }}
																	{{ Form::hidden('ngo_id', $ngo['id']) }}
																	@if (Auth::user()->oboli_count == 1)
																		<input id="ex{{ $i }}" name="amount" data-slider-id='ex{{ $i }}Slider' type="text" data-slider-min="0" data-slider-max="1" data-slider-step="1" data-slider-value="1" data-slider-tooltip="always" />
																	@else
																		<input id="ex{{ $i }}" name="amount" data-slider-id='ex{{ $i }}Slider' type="text" data-slider-min="0" data-slider-max="{{ Auth::user()->oboli_count }}" data-slider-step="1" data-slider-value="{{ (Auth::user()->oboli_count - Auth::user()->oboli_count%2) / 2 }}" data-slider-tooltip="always" />		
																	@endif
																	<div class="btn-donation">
																		<input class="btn-donation" type="submit" value="DONA">
																	</div>
																{{ Form::close() }} 
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
	
		<!--Testimonial Section Start Here -->			
				<section class="testimonial parallax">
					<div class="overlay"></div>
					<div class="container">
						<div class="row">
							<div class="col-xs-12">
								<div class="testimonial-slider flexslider">
									<ul class="slides">
										<li>
									<div class="slide">
										<h2>Cosa dicono i volontari di noi? <strong class="border-none"> Leggi qui sotto </strong></h2>
										<blockquote>
											<p>
												“Oboli è un'idea tanto semplice quanto rivoluzionaria!”
											</p>
											<footer>
												<span>Michele Orlando</span>
												<cite>(Fondazione Veronesi)</cite>
											</footer>
										</blockquote>
									</div>
									</li>

									
								</ul>
								</div>
							</div>
						</div>
					</div>
				</section>
	<!--Testimonial Section End Here -->


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
	
