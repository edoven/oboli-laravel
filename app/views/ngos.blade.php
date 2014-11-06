@extends('layouts.master')

@section('title')
NGOs
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
													<div class="spacer-bottom zoom equal-box">
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
															<p>{{ $ngo->short_description }}</p>
															
															@if (Auth::guest())
																<a class="btn btn-default btn-volunteer" data-toggle="modal" data-target=".login-form">Entra e dona i tuoi Oboli</a>
															@else
																@if (Auth::user()->oboli_count > 2)
																	<div class=row>
																		<div class="col-md-4">
																			{{ Form::open(array('url' => 'makeDonation')) }}
																				{{ Form::hidden('ngo_id', $ngo['id']) }}
																				{{ Form::hidden('amount', 1) }}
																				{{ Form::submit('1 Obolo', array('class' => 'btn btn-default',)) }}
																			{{ Form::close() }} 
																		</div>
																		<div class="col-md-4">
																			{{ Form::open(array('url' => 'makeDonation')) }}
																				{{ Form::hidden('ngo_id', $ngo['id']) }}
																				{{ Form::hidden('amount', Auth::user()->oboli_count) }}
																				{{ Form::submit(Auth::user()->oboli_count.' Oboli', array('class' => 'btn btn-default',)) }}	
																			{{ Form::close() }} 
																		</div>
																		<div class="col-md-4">
																			{{ Form::open(array('url' => 'makeDonation')) }}
																				{{ Form::hidden('ngo_id', $ngo['id']) }}
																				<?php echo Form::selectRange('amount', 1, Auth::user()->oboli_count); ?>
																				{{ Form::submit('Dona', array('class' => 'btn btn-default',)) }}
																			{{ Form::close() }} 
																		</div>
																	</div>
																@endif
																
																@if (Auth::user()->oboli_count == 2)
																	<div class="col-md-6">
																	{{ Form::open(array('url' => 'makeDonation')) }}
																		{{ Form::hidden('ngo_id', $ngo['id']) }}
																		{{ Form::hidden('amount', 1) }}
																		{{ Form::submit('1 Oboli', array('class' => 'btn btn-default',)) }}
																	{{ Form::close() }} 
																	</div>
																	<div class="col-md-6">
																	{{ Form::open(array('url' => 'makeDonation')) }}
																		{{ Form::hidden('ngo_id', $ngo['id']) }}
																		{{ Form::hidden('amount', 2) }}
																		{{ Form::submit('2 Oboli', array('class' => 'btn btn-default',)) }}
																	{{ Form::close() }} 
																	</div>
																@endif
																
																@if (Auth::user()->oboli_count == 1)
																	<div class="col-md-12">
																	{{ Form::open(array('url' => 'makeDonation')) }}
																		{{ Form::hidden('ngo_id', $ngo['id']) }}
																		{{ Form::hidden('amount', 1) }}
																		{{ Form::submit('1 Oboli', array('class' => 'btn btn-default',)) }}
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
										<!-- Article Section Srart Here -->
								
								</div>
							</div>
						</section>
						<!-- Our Causes Section End-->

						<!--Pagination Section Start Here-->
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
								</li>
							</ul>

						</div>
						<!--Pagination Section End Here-->

					</div>

				</div>
				<!-- cause page Start End-->
			</div>
			<!-- site content ends -->
       

@stop



