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
								</div>
								<div class="heading-sec text-left">
									<h3 class="h4">{{ $ngo->name }}</h3>
									<span class="date-desc">06 august, 2014 Africa, Child care</span>
								</div>
								<div class="row">
									<div class="col-xs-12">
										<div>
											<span class="donation">
												Oboli donati : <span class="value">{{ $ngo->oboli_count }} </span><br>
												Donatori : <span class="value">{{ $ngo->donors }} </span>
										</span>
										</div>
										@if (Auth::guest())
											<a href="/login" class="btn btn-default pull-right">Dona subito</a>
										@else
											<a data-toggle="modal" href="#" data-target=".donate-form" class="btn btn-default pull-right">Dona subito</a>
										@endif
									</div>
								</div>

								<div class="detail-description">
									<p class="detail-summary">
										{{ $ngo->long_description }}
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
									@if (Auth::guest())
										<a href="/login" class="btn btn-default">Dona subito</a>
									@else
										<a data-toggle="modal" href="#" data-target=".donate-form" class="btn btn-default">Dona subito</a>
									@endif
								</div>
								<!--step donation-->



								<!--
								<div class="step-donation sec-step-med causes-details-step anim-section animate">
									<header class="page-header section-header">
										<h2>Come donare? E' <strong>facilissimo</strong></h2>
									</header>
									<div class="col-xs-12 text-center">
										<div class="cols-xs-12 col-sm-4">
											<div class="sec-step-desc">
												<span class="number-count">1</span>
												<h4 class="normal-text">Seleziona il numero di Oboli</h4>
												<p>
													Cnatoque pena ibus et magnis dis parturient montes his achievement
												</p>
											</div>
										</div>
										<div class="cols-xs-12 col-sm-4">
											<div class="sec-step-desc">
												<span class="number-count">2</span>
												<h4 class="normal-text">Clicca sul pulsante 'Dona'</h4>
												<p>
													Cnatoque pena ibus et magnis dis parturient montes his achievement
												</p>
											</div>
										</div>
										<div class="cols-xs-12 col-sm-4">
											<div class="sec-step-desc">
												<span class="number-count">3</span>
												<h4 class="normal-text">Condividi su Facebook o Twitter la tua buona azione</h4>
												<p>
													Cnatoque pena ibus et magnis dis parturient montes his achievement
												</p>
											</div>
										</div>
									</div>	
								</div>
								-->

							</div>
						</div>
						<div class="row article-list progressbar">
							<header class="col-xs-12 block-title">
								<h3>Cause collegate</h3>
							</header>
							@foreach ($same_area_ngos as $ngo)
								<div class="col-xs-12 col-sm-4 zoom anim-section animate">
									<a href="#" class="img-thumb">
										<figure>
											<img src="{{ asset('img/web/ngos/large/'.$ngo->name_short.'.jpg') }}" alt="">
										</figure>	
									</a>
									<div class="progress">

									</div>
									<span class="donation">{{ $ngo->name }}</span>
									<p>
										{{ $ngo->short_description }}
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
								@foreach ($recent_ngos as $ngo)
									<li>
										<a href="#" class="pull-left">
											<figure>
												<img src="{{ asset('img/web/ngos/xs/'.$ngo->name_short.'.jpg') }}" alt="">
											</figure>
										</a>
										<div class="media-body">
											<p>
												<a href="#">
												{{ $ngo->name }}
												</a>
											</p>
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
										Donne <span class="pull-right">(20)</span>
									</a>
								</li>
								<li>
									<a href="/ngos?category=children">
										Bambini <span class="pull-right">(18)</span>
									</a>
								</li>
								<li>
									<a href="/ngos?category=environment">
										Ambiente <span class="pull-right">(15)</span>
									</a>
								</li>
								<li>
									<a href="/ngos?category=health">
										Salute <span class="pull-right">(12)</span>
									</a>
								</li>
								<li>
									<a href="/ngos?category=humrights">
										Diritti Umani <span class="pull-right">(30)</span>
									</a>
								</li>

							</ul>
						</aside>

						<!-- Text Widget -->
						<div class="text-widget">
							<h3>Text Widget</h3>
							<p>
								Placerat vel augue vitae aliquam tinciuntool sed hendrerit diam in mattis ollis don ec  tincidunt magna nullam hedrerit pellen tesque pelle.
							</p>
						</div>
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
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					×
				</button>
				<header class="page-header">
					<h2>Quanti Oboli vuoi donare ?</h2>
				</header>
			</div>
			<div class="modal-body">
				@if (!Auth::guest() && Auth::user()->oboli_count>0)
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
				@else
					<div class="row">
							<div class="col-xs-12">
								<div class="form-group col-xs-12 col-sm-6">
									<label>Non hai Oboli da donare</label>
								</div>
							</div>
						</div>
				@endif
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>