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
									<h2>Puoi fare molto con un piccolo sforzo. <strong>Basta un click</strong></h2>
								</header>

							</div>
						</section>

						<!-- Our Causes Section-->
						<section class="our-causes">
							<div class="anim-section">
								<div class="row">	
													
											<!-- Article Section Srart Here -->
										<div class="article-list progressbar">
											
											@for ($i = 0; $i < count($ngos); $i++)
												<?php
												$ngo = $ngos[$i];
												?>
												
												<!--
												<div class="cols-xs-12 col-sm-4 anim-section">
													<div class="spacer-bottom zoom equal-box">
														<h3 class="h5"><a href="/ngos/{{ $ngo->id }}">{{ $ngo->name }}</a></h3>
														<a href="/ngos/{{ $ngo->id }}" class="img-thumb">
															<figure>
															<img src="assets/img/img-slide-01.jpg" alt="">
															</figure>
															</a>
														<div class="progress">
															<div class="progress-bar" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100">
																<span class="progress-value">72% </span>
															</div>
														</div>
														<div class="donation">Oboli Donati : <span class="value">{{ $ngo->oboli_count }}</span> Donatori: <span class="value">{{ $ngo->donors }}</div>
														<p>
															Lorem ipsum dolor sit consectetur adipiscing elit ellentesque. Future stuffs also goes...
														</p>
														<a data-toggle="modal" href="external.html" data-target=".donate-form" class="btn btn-default">DONATE NOW</a>
													</div>
												</div>
												-->
												<div class="col-xs-12 col-md-4 anim-section">
													<div class="items zoom">										
														<a href="/ngos/{{ $ngo->id }}" class="img-thumb">
															<figure>
																<img src="{{ asset('img/web/ngos/'.$ngo->id.'.png') }}" alt="">
															</figure>
														</a>
														<h3 class="h4"><a href="/ngos/{{ $ngo->id }}">{{ $ngo->name }}</a></h3>
														<div class="row">
															<div class="col-xs-6 col-md-6 col-sm-6 item-wrapper">
																<span class="fa fa-money ngo">  </span>
																@if ($ngo->oboli_count == 1)
																	<div class="donation"><span class="value">1</span> Obolo donato</div>
																@else
																	<div class="donation"><span class="value">{{ $ngo->oboli_count }}</span> Oboli donati</div>
																@endif
															</div>
															<div class="col-xs-6 col-md-6 col-sm-6 item-wrapper">
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
																	<input  class="btn btn-default" type="submit" value="Non hai oboli da donare">
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
