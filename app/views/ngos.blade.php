@extends('layouts.master')

@section('title')
NGOs
@stop


@section('top')
	@if (Session::has('new_code'))
		<div class="alert alert-success alert-dismissible text-center" role="alert">
		 	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<strong>Complimenti!</strong> Hai appena guadagnato {{ Session::get('amount') }} Oboli!
		</div>
	@endif
@stop


@section('content')      
        	<!-- site content -->
			<div id="main">
				<!-- cause page Start Here-->
				<div class="content-wrapper cause-page-section" id="page-info">
					<div class="container">
						<section class="our-story row anim-section">
							<div class="col-xs-12">
								<header class="page-header section-header top-spacer">
									<h2 >
										<span class="orange-border">Puoi fare molto con <strong class="border-none orange"> un click</strong>. Ed è <strong class="border-none orange">gratis</strong>!</span>
									</h2>
								</header>

							</div>
						</section>

						<!-- Our Causes Section-->
						<section class="our-causes our-causes-section our-causes3">
							<div class="anim-section">
								<div class="row">	
													
										<!-- Article Section Srart Here -->
										<div class="article-list progressbar">
											
											@for ($i = 0; $i < count($ngos); $i++)
												<?php
												$ngo = $ngos[$i];
												?>
												
												@if ($i%3==0)
													<div class="row ngos">
												@endif
												
													<div class="col-xs-12 col-md-4 anim-section">
														<div class="item">
															<div class="items zoom">
																<a href="/ngos/{{ $ngo->name_short }}" class="img-thumb">
																	<figure>
																		<img class="main" src="{{ asset('img/web/ngos/small/'.$ngo->name_short.'.jpg') }}" alt="{{ $ngo->name }}">
																	</figure> 
																</a>
																<div class="item-content">
																	<div class="ngo-name">
																		<a href="/ngos/{{ $ngo->name_short }}">{{ $ngo->name }}</a>
																	</div>
																	<div class="row">
																		<div class="col-xs-6">
																			<img class="ngo-icon" src="{{ asset('img/web/donations.png') }}" />
																			<hr class="ngo">
																			@if ($ngo->oboli_count == 1)
																				<div class="donation">
																					<div class="donation-number">1</div>
																					<div class="donation-string">obolo donato</div>
																				</div>
																			@else
																				<div class="donation">
																					<div class="donation-number">{{ $ngo->oboli_count }}</div>
																					<div class="donation-string">oboli donati</div>
																				</div>
																			@endif
																		</div>
																		<div class="col-xs-6">
																			<img class="ngo-icon" src="{{ asset('img/web/donors.png') }}" />
																			<hr class="ngo">
																			@if ($ngo->donors == 1)
																				<div class="donation">
																					<div class="donation-number">1</div>
																					<div class="donation-string">donatore</div>
																				</div>
																			@else
																				<div class="donation">
																					<div class="donation-number">{{ $ngo->donors }}</div>
																					<div class="donation-string">donatori</div>
																				</div>
																			@endif
																		</div>
																	</div>
																	<p>
																		{{ $ngo->short_description }}
																	</p>
																	@if (Auth::guest())
																		<a href="/access" class="btn btn-default">entra e dona i tuoi oboli</a>
																	@else
																		@if (Auth::user()->oboli_count >0)
																			{{ Form::open(array('url' => '/donations/new', 'class' => 'donation-form')) }}
																				{{ Form::hidden('ngo_id', $ngo['id']) }}
																				@if (Auth::user()->oboli_count == 1)
																					<input id="ex{{ $i }}" name="amount" data-slider-id='ex{{ $i }}Slider' type="text" data-slider-min="0" data-slider-max="1" data-slider-step="1" data-slider-value="1" data-slider-tooltip="always" />
																				@else
																					<input id="ex{{ $i }}" name="amount" data-slider-id='ex{{ $i }}Slider' type="text" data-slider-min="0" data-slider-max="{{ Auth::user()->oboli_count }}" data-slider-step="1" data-slider-value="{{ (Auth::user()->oboli_count - Auth::user()->oboli_count%2) / 2 }}" data-slider-tooltip="always" />		
																				@endif
																				<div class="donation-btn">
																					<input class="donation-btn" type="submit" value="DONA">
																				</div>
																			{{ Form::close() }} 
																		@endif
																	@endif
																</div>
															</div>
														</div>
													</div>
											
												@if ($i%3==2)
													</div> <!-- END row -->
												@endif
											@endfor
										</div>
										<!-- Article Section Srart Here -->
								
								</div>
							</div>
						</section>
						<!-- Our Causes Section End-->






						<!--Pagination Section Start Here-->
						<!--
						<div class="cols-xs-12 anim-section text-center">
							<ul class="pagination">
								<li>
									<a href="#">Prev</a>
								</li>
								<li class="active">
									<a href="#">1</a>
								</li>
								<li>
									<a href="#">2</a>
								</li>
								<li>
									<a href="#">3</a>
								</li>
								<li>
									<a href="#">4</a>
								</li>
								<li>
									<a href="#">Next</a>
									<a data-toggle="modal" data-target=".donate-form" class="btn btn-default pull-right">DONATE NOW</a>
								</li>
							</ul>

						</div>
						-->
						<!--Pagination Section End Here-->

					</div>

				</div>
				<!-- cause page Start End-->
			</div>
			<!-- site content ends -->
@stop




<!-- @section('after-footer')
	@if (Session::has('new_donation'))
		<div class="modal donate-form" id="my-modal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">

						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
						<header class="page-header">
							<h2>Hai un cuore grande!</h2>
						</header>

					</div>
					<div class="modal-body">
						<body class="page-body">
							<h2>{{ Session::get('ngo_name') }} ti ringrazia di cuore per aver donato <strong>{{ Session::get('amount') }} oboli</strong>!</h2>
						</body>
					</div>
				</div>
			</div>
		</div>
	@endif
@stop -->



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
