@extends('layouts.master')


@section('title')
{{ $ngo->name  }}
@stop


@section('content')

			<!-- site content -->
			<div id="main">
				

				<div class="cause-page" id="page-info">
					<!-- Our Causes Detail Section-->

						<div class="container anim-section">
							<div class="row">
								<div class="col-xs-12">

									<div class="row article-list-large progressbar">
										<div class="col-xs-12 anim-section">

											<!--
											<section class="img-slider flex-slide flexslider">
												<div style="overflow: hidden; position: relative;" class="flex-viewport">
													<ul style="width: 600%; margin-left: 0px;" class="slides">
														<li style="width: 1140px; float: left; display: block;" class="flex-active-slide">
															<img draggable="false" src="{{ asset('assets/img/blog-pic0.jpg') }}" alt="">
														</li>
														<li class="" style="width: 1140px; float: left; display: block;">
															<img draggable="false" src="{{ asset('assets/img/blog-pic1.jpg') }}" alt="">
														</li>
														<li class="" style="width: 1140px; float: left; display: block;">
															<img draggable="false" src="{{ asset('assets/img/blog-pic3.jpg') }}" alt="">
														</li>
													</ul>
												</div>

												<div class="text-center section-header">
													<h1>{{ $ngo->name }}</h1>
												</div>

												<ol class="flex-control-nav flex-control-paging">
													<li>
														<a class="flex-active">1</a>
													</li>
													<li>
														<a class="">2</a>
													</li>
													<li>
														<a class="">3</a>
													</li>
												</ol>
												<ul class="flex-direction-nav">
													<li>
														<a tabindex="-1" class="flex-prev flex-disabled" href="#">Previous</a>
													</li>
													<li>
														<a tabindex="-1" class="flex-next" href="#">Next</a>
													</li>
												</ul>
											</section>
											-->

											<div class="text-center section-header">
												<h2 class="h4">{{ $ngo->name }}</h2>
											</div>
											
											<div class="row">
												<div class="col-xs-12 col-md-8 item-wrapper">
													<figure class="article-pic zoom">
														<img src="{{ asset('img/web/ngos/large/'.$ngo->name_short.'.jpg') }}" alt="">
													</figure>
												</div>
											
												<div class="col-xs-12 col-md-4 item-wrapper">
													<div class="detail-description">
														<div class="donation-details">
															<div class="row">
																<div class="col-xs-12 col-md-12 item-wrapper">
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
																</div>
																<div class="col-xs-12 col-md-12 item-wrapper">
																	@if (Auth::guest())
																		<div class="btn-donation">
																			<a href="/access" class="btn-donation">Accedi e dona i tuoi Oboli</a>
																		</div>		
																	@else
																		@if (Auth::user()->oboli_count >0)
																			{{ Form::open(array('url' => '/donations/new', 'class' => 'donation-form')) }}
																				{{ Form::hidden('ngo_id', $ngo->id) }}
																				@if (Auth::user()->oboli_count == 1)
																					<input id="ex{{ $ngo->id }}" name="amount" data-slider-id='ex{{ $ngo->id }}Slider' type="text" data-slider-min="0" data-slider-max="1" data-slider-step="1" data-slider-value="1" data-slider-tooltip="always" />
																				@else
																					<input id="ex{{ $ngo->id }}" name="amount" data-slider-id='ex{{ $ngo->id }}Slider' type="text" data-slider-min="0" data-slider-max="{{ Auth::user()->oboli_count }}" data-slider-step="1" data-slider-value="{{ (Auth::user()->oboli_count - Auth::user()->oboli_count%2) / 2 }}" data-slider-tooltip="always" />		
																				@endif
																				<div class="btn-donation">
																					<input class="btn-donation" type="submit" value="DONA">
																				</div>
																			{{ Form::close() }} 
																		@endif
																	@endif
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-xs-12 col-md-8 item-wrapper">
													<div class="ngo-page-description">
														<div class="summary">
															<h3>{{ $ngo->short_description }}</h3>
														</div>
														<p>
															{{ $ngo->long_description }}
														</p>
													</div>
												</div>
												<div class="col-xs-12 col-md-4 ngo-page-conctats">
													<div>
														<div>
															<h3>Riferimenti</h3>
														</div>
														<ul>
															<li>
																indirizzo: via marchi degli agosti 34
															</li>
															<li>
																sito web: www.sito.com
															</li>
															<li>
																email:nome@dominio.it
															</li>
														</ul>
													</div>
													
												</div>
											</div>

										</div>
									</div>
								</div>
							</div>

							<!-- our causes detail-->

						</div>
					</div>
				

			</div>
			<!-- site content ends -->


@stop

@section('scripts')

	<?php echo("<script>") ?>
		$('#ex{{ $ngo->id }}').slider({
			formatter: function(value) {
				//return 'Current value: ' + value;
				if (value == 1)
					return '1 Obolo';
				else
					return value + ' Oboli';
			}
		});
	<?php echo("</script>") ?>

@stop
