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
					<h2>You can help lots of people by donating little. <strong>Our causes</strong></h2>
				</header>
			</div>
		</section>

		<!-- Our Causes Section-->
		<section class="our-causes">
			<div class="anim-section animate">
				<div class="row">	
					<div class="article-list progressbar">
						@foreach ($ngos as $ngo)
							<div class="cols-xs-12 col-sm-4 anim-section animate">
								<div style="height: 520px;" class="spacer-bottom zoom equal-box">
									
									<a href="/ngos/{{ $ngo->name_short }}" class="img-thumb">
										<figure>
											<img src="{{ asset('img/web/ngos/small/'.$ngo->name_short.'.jpg') }}" alt="">
										</figure>
									</a>
									<div class="progress">
									</div>
									<a href="/ngos/{{ $ngo->name_short }}" class="img-thumb">
										<h3 class="h5">{{ $ngo->name }}</h3>
									</a>
									<span class="donation">
										Oboli donati : <span class="value">{{ $ngo->oboli_count }}</span><br>
										Donatori : <span class="value">{{ $ngo->donors }}</span>
									</span>
									<p>
										{{ $ngo->short_description }}
									</p>
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
