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
        	


<div class="content-wrapper cause-page-section" id="page-info">
	<div class="container">
		<section class="our-story row anim-section animate">
			<div class="col-xs-12">
				<header class="page-header section-header top-spacer">
					<h2>Dona i tuoi Oboli. E' facile e <strong>gratuito</strong></h2>
				</header>
			</div>
		</section>

		<!-- Our Causes Section-->
		<section class="our-causes">
			<div class="anim-section animate">
				<div class="row">	
					<div class="article-list progressbar">
						@foreach ($ngos as $ngo)
							<div class="cols-xs-12 col-sm-6 col-md-4 anim-section animate">
								<!--<div style="height: 550px;" class="spacer-bottom zoom equal-box">-->
								<div class="spacer-bottom zoom equal-box">
									<a href="/ngos/{{ $ngo->name_short }}" class="img-thumb">
										<figure>
											<img draggable="false" src="{{ asset('img/web/ngos/small/'.$ngo->name_short.'.jpg') }}" alt="">
										</figure>
									</a>
									<div class="progress">
									</div>

									<div class="title-fixed-container">
										<a href="/ngos/{{ $ngo->name_short }}" class="img-thumb title-fixed-container-in ngo-title">
											{{ $ngo->name }}
										</a>
									</div>
									<hr width="60%">
									<span class="donation">
										<div class="row">
											<div class="col-xs-6">
												<div class="value">
													{{ $ngo->oboli_count }}
												</div>
												<div class="metric">
													OBOLI DONATI
												</div>
											</div>
											<div class="col-lg-6 col-xs-6">
												<div class="value">
													{{ $ngo->donors }}
												</div>
												<div class="metric">
													DONATORI
												</div>
											</div>
										</div>
									</span>
									<div class="ngo-description">
										<p>
											{{ $ngo->middle_description }}
										</p>
									</div>
									<a href="/ngos/{{ $ngo->name_short }}" class="btn btn-default">Dona i tuoi Oboli</a>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</section>
		<!-- Our Causes Section End-->
	</div>

</div>



@stop
