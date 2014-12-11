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
								<div class="spacer-bottom equal-box">
									<a href="/ngos/{{ $ngo->name_short }}" class="img-thumb zoom">
										<figure>
											<img draggable="false" src="{{ asset('img/web/ngos/small/'.$ngo->name_short.'.jpg') }}" alt="">
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
									<div class="details">
										<a href="/ngos/{{ $ngo->name_short }}">
											<h3 class="h6">{{ $ngo->name }}</h3>
										</a>
										<span class="donation">
											<div class="row">
												<div class="col-xs-3 element">
													<span><img class="metric-icon" src="{{ asset('img/web/donated.png') }}" /> <div class="metric-number">{{ $ngo->oboli_count }}</div><span>
												</div>
												<div class="col-xs-3 element">
													<span><img class="metric-icon" src="{{ asset('img/web/donors.png') }}"> <div class="metric-number">{{ $ngo->donors }}</div><span>
												</div>
											</div>
										</span>
										<div class="ngo-description">
											<p>
												{{ $ngo->middle_description }}
											</p>
										</div>
									</div>
									<a href="/ngos/{{ $ngo->name_short }}" class="btn btn-default btn-donation">Dona i tuoi Oboli</a>
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
