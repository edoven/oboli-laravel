@extends('layouts.master')


@section('title')
{{ $ngo->name  }}
@stop


@section('content')
<div class="cause-page content-wrapper" id="page-info">
		<div class="container">
			<!-- our causes detail-->
			<div class="anim-section animate">
				<div class="row">
					<div class="col-xs-12 col-sm-9 left-block">
						<div class="article-list-large causes-description progressbar">
							<div class="anim-section animate">
								<figure>
									<img src="{{ asset('img/web/ngos/large/'.$ngo->name_short.'.jpg') }}" alt="">
								</figure>
								<div class="progress">
									<div class="progress1">
										<div class="progress2">
											<div class="progress3">

											</div>
										</div>
									</div>	
								</div>
								<div class="heading-sec text-left">
									<h3 class="h4">{{ $ngo->name }}</h3>
									<span class="date-desc">Anno di fondazione: 2005.</span>
								</div>
								<div class="row">
									<div class="col-xs-12">
										<span class="donation">
											<img class="metric-icon" src="{{ asset('img/web/donated.png') }}" /> <span class="value">{{ $ngo->oboli_count }}</span>
											<img class="metric-icon" src="{{ asset('img/web/donors.png') }}" /> <span class="value">{{ $ngo->donors }}</span>
										</span>
										
										@if (Auth::guest())
											<a href="/login" class="btn btn-default btn-donation pull-right">Dona subito</a>
										@else
											<a data-toggle="modal" href="#" data-target=".donate-form" class="btn btn-default btn-donation pull-right">dona subito</a>
										@endif
									</div>
								</div>

								<div class="detail-description">
									<p class="detail-summary">
										{{ $ngo->middle_description }}
									</p>
									<p>
										{{ $ngo->long_description }}
									</p>
									@if (Auth::guest())
										<a href="/login" class="btn btn-default btn-donation ">Dona subito</a>
									@else
										<a data-toggle="modal" href="#" data-target=".donate-form" class="btn btn-default btn-donation">dona subito</a>
									@endif
								</div>
								<!--step donation-->
							</div>
						</div>
						<div class="row article-list progressbar bottom-bar">
							<header class="col-xs-12 block-title">
								<h3>Cause collegate</h3>
							</header>
							@foreach ($same_area_ngos as $same_area_ngo)
								<div class="col-xs-12 col-sm-4 zoom anim-section animate">
									<a href="#" class="img-thumb">
										<figure>
											<img src="{{ asset('img/web/ngos/large/'.$same_area_ngo->name_short.'.jpg') }}" alt="">
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
									<span class="donation">{{ $same_area_ngo->name }}</span>
									<p>
										{{ $same_area_ngo->short_description }}
									</p>
									<!--<a data-toggle="modal" href="external.html" data-target=".donate-form" class="btn btn-default">DONATE NOW</a>-->

								</div>
							@endforeach
						</div>
					</div>








					<div class="col-xs-12 col-sm-3 left-block ">
						<aside class="media">
							<h3 class="space-top">Donazioni più recenti</h3>
							<ul>
								@foreach ($recent_ngos as $recent_ngo)
									<li>
										<div class="recent-ngo">
											<a href="/ngos/{{ $recent_ngo->name_short }}">
												<figure>
													<img src="{{ asset('img/web/ngos/xs/'.$recent_ngo->name_short.'.jpg') }}" alt="">
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
											<p class="name">{{ $recent_ngo->name }}</p>
										</div>
									</li>
								@endforeach
							</ul>
						</aside>

						<!-- Categories  -->
						<aside class="media">
							<h3>Categorie</h3>
							<ul class="archives">
								<li>
									<a href="/ngos?category=women">
										<img src="{{ asset('img/web/areas/icons/women.png') }}" alt=""> Donne <span class="pull-right">(20)</span>
									</a>
								</li>
								<li>
									<a href="/ngos?category=children">
										<img src="{{ asset('img/web/areas/icons/children.png') }}" alt=""> Bambini <span class="pull-right">(18)</span>
									</a>
								</li>
								<li>
									<a href="/ngos?category=environment">
										<img src="{{ asset('img/web/areas/icons/environment.png') }}" alt=""> Ambiente <span class="pull-right">(15)</span>
									</a>
								</li>
								<li>
									<a href="/ngos?category=health">
										<img src="{{ asset('img/web/areas/icons/health.png') }}" alt=""> Salute <span class="pull-right">(12)</span>
									</a>
								</li>
								<li>
									<a href="/ngos?category=humrights">
										<img src="{{ asset('img/web/areas/icons/humrights.png') }}" alt=""> Diritti Umani <span class="pull-right">(30)</span>
									</a>
								</li>
							</ul>
						</aside>
					</div>






				</div>
			</div>
			<!-- our causes detail-->
		</div>
	</div>
@stop




<div aria-hidden="true" style="display: none;" class="modal donate-form">
	<div class="modal-dialog">
		<div class="modal-content">
			@if (!Auth::guest())
				@if (Auth::user()->confirmed == 0)	
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							×
						</button>
						<header class="page-header">
							<h2>Un ultimo sforzo prima di poter donare</h2>
						</header>
					</div>
					<div class="modal-body">
						<div class="col-xs-12">
							<p>Devi confermare il tuo account per poter donare. Controlla l'email che ti abbiamo inviato.</p>
						</div>
					</div>
				@else
					@if (Auth::user()->oboli_count<1)
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								×
							</button>
							<header class="page-header">
								<h2>Non possiedi Oboli</h2>
							</header>
						</div>
						<div class="modal-body">
							<div class="col-xs-12">
								<p>Scopri come ottenerli visitando la pagina con i prodotti convenzionati con Oboli.</p>
							</div>
						</div>
					@else
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								×
							</button>
							<header class="page-header">
								<h2>Effettua una donazione</h2>
							</header>
						</div>
						<div class="modal-body">
							<div class="col-xs-12">
								<div class="form-group col-xs-12 col-sm-6">
									{{ Form::open(array('url'=>'/donations/new', 'role'=>'form')) }}
										{{ Form::hidden('ngo_id', $ngo->id) }}
										<div class="row">
											<div class="col-xs-12">
												<div class="form-group col-xs-12 col-sm-6">
													<label>Seleziona una quantità</label>
													<div class="choose-pricing">
														<div class="btn-group">
															{{ Form::selectRange('amount', 1, Auth::user()->oboli_count) }}
														</div>
													</div>
												</div>
											</div>
											<div class="col-xs-12">
												<div class="form-group col-xs-12">
													<input value="DONA" class="btn btn-default" type="submit">
												</div>
											</div>
										</div>							
									{{ Form::close() }}
								</div>
							</div>
						</div>
					@endif
				@endif
			@endif
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>