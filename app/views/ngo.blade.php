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

											<div class="text-center section-header">

												<h1>{{ $ngo->name }}</h1>
											</div>

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


											<!--
											<figure class="article-pic">
												<img src="{{ asset('assets/img/detail-big-01.jpg') }}" alt="">
											</figure>
											-->
											<div class="progress">
												<div class="progress-bar" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100">
													<span class="progress-value">72% </span>
												</div>
											</div>
											
											

											<div class="detail-description">
												<div class="donation-details">
													<div class="donation">Oboli donati : <span class="value">{{ $ngo->oboli_count }}</span></div>
													<div class="donation">Donatori : <span class="value">{{ $ngo->donors }}</span></div>
													
													@if (Auth::guest())
														<a class="btn btn-default" data-toggle="modal" data-target=".login-form">Entra e dona i tuoi Oboli</a>
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
															<button class="btn btn-default'">Non hai oboli da donare :(</button>													
														@endif
													@endif
		
												</div>

												<p class="donation-summary">
													Lorem ipsum dolor sit coopnsectetur adipiscing elit ellentesque future stuffs also goes placerat vel augue vitae aliquam tincidunt dolor sed hendrerit diam in <strong>mattis mollis donec ut tincidunt magna nullam hendrerit</strong> pellentesque pellentesque sed ultrices arcu non dictum porttitor nam ac leo arcu aliquam erat volutpat suspendisse eget congue justo class aptent taciti sociosqu ad litora torquent per conubia nostra
												</p>
												<p>
													Future stuffs also goes placerat vel augue vitae aliquam tincidunt dolor sed hendrerit diam in mattis mollis donec ut tincidunt magna niullam hendrerit pellen tesque pellentesque sed ultrices arcu non dictum porttitor nam ac leo arcu aliquam erat volutpat suspendisse eget
												</p>

												<p>
													augue vitae aliquam tincidunt dolor sed hendrerit diam in mattis mollis donec ut tincidunt magna nullam hendrerit pellentesque pellentesqu e sed ultrices arcu non dictum porttitor nam ac leo arcu aliquam erat volutpat suspendisse eget congue justo class aptent taciti sociosqu adlitora torquent per conubia nostra per inceptos himenaeos Lorem ipsum dolor sit coopnsectetur adipiscing elit ellentesque  future stuffs also goes placerat vel Lorem ipsum dolor sit coopnsectetur adipiscing elit ellentesque
												</p>

												<ul class="list-trangled">
													<li>
														Praesent congue magna quis sodales porta.
													</li>
													<li>
														Phasellus et quam ac leo varius tincidunt.
													</li>
													<li>
														Maecenas non velit eu quam tincidunt euismod id non nulla.
													</li>
													<li>
														Sed non felis sit amet augue tincidunt aliquam a in sem.
													</li>
												</ul>

												<a data-toggle="modal" href="external.html" data-target=".donate-form" class="btn btn-default">DONATE NOW</a>
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

