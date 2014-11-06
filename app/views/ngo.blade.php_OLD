@extends('layouts.master1')


@section('title')
{{ $ngo->name  }}
@stop


@section('content')
<!--=== DONATE modal ===-->
<div class="modal fade" id="donatemodal">
	<div class="modal-dialog modal-lg text-center">
		<div class="modal-content">
			@if (Auth::check())
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h1 class="modal-title">Donate Now </h1>
					<h2>Join us in helping people survive and rebuild their lives. </h2>
				</div>
				<div class="modal-body">
					@if (Auth::user()->oboli_count < 1)
						<p>Sorry, you have no obolis to donate.</p>
					@else		
						{{ Form::open(array('url' => 'makeDonation')) }}
							{{ Form::hidden('ngo_id', $ngo['id']) }}
							<select name="amount" class="form-control">
								@for ($i=1; $i< Auth::user()->oboli_count; $i++)
									@if ($i%5==0)
										<option value="{{ $i }}">{{ $i }} Obolis</option>
									@endif									
								@endfor
							</select>
							<br>
							<div class="col-md-1">
								{{ Form::submit('Donate', array('class' => 'btn btn-tertiary btn-xl btn-rounded-edge')) }}
							</div>
						{{ Form::close() }} 
						<br>
						<br>  
					@endif
				</div>
			@else
				<div class="modal-header">
					<h2>Please <a href="/login">login</a> or <a href="/signup">signup</a> to donate.</h2>
				</div>
			@endif
		</div>
	</div>
	<!-- / modal-content -->
</div>
<!-- / modal-dialog -->
</div><!--=== / END donate modal ===-->



<!--=== INTRO ===-->
<section class="hero bg-brand-primary">
	<div class="col-lg-12 inner-container animated-longer-delay-4 fadeInDown text-center no-subtitle">
		<h1>{{ $ngo->name }}</h1>
	</div>
	<div class="clearfix"></div>
</section>
<!--=== / END intro  ===-->
<!--=== Social Share Bar ===-->
<div id="social-share-bar" class="bg-brand-primary-darker">
	<div class="col-lg-12 animated-longer-delay-5 fadeInDown text-center">
		<div class="social-share-bar">
			<ul class="list-inline list-social">
				<li><a href="javascript:void(0)"><i class="fa fa-envelope-square"></i> <small class="list-social-text">email</small></a></li>
				<li><a href="javascript:void(0)"><i class="fa fa-twitter-square"></i> <small class="list-social-text">tweet</small></a></li>
				<li><a href="javascript:void(0)"><i class="fa fa-facebook-square"></i> <small class="list-social-text">post</small></a></li>
				<li><a href="javascript:void(0)"><i class="fa fa-pinterest-square"></i> <small class="list-social-text">pin</small></a></li>
				<li><a href="javascript:void(0)"><i class="fa fa-google-plus-square"></i><small class="list-social-text"> share</small></a></li>
			</ul>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
<!--=== / END social share bar ===-->
<!--=== CAMPAIGN SUMMARY AND DONATION ===-->
<section id="campaign-summary">
	<div id="sample-campaign-image" class="col-sm-8 animated-longer-delay-5 fadeIn">
		
		<div id="wrapper">
		<h2>prova</h2>
		<!-- Slideshow 3 -->
		<div class="rslides_container">
		  <ul class="rslides" id="slider3">
			<li><img src="{{ asset('bootstrap/img/amnesty.png') }}" alt=""></li>
			<li><img src="{{ asset('bootstrap/img/amnesty2.png') }}" alt=""></li>
			<li><img src="{{ asset('bootstrap/img/amnesty3.png') }}" alt=""></li>
		  </ul>
		</div>
		</div>
		
		
		
		
	</div>
	<div id="sample-campaign-stats" class="col-sm-4 text-center bg-white">
		<!--
		<div class="animated-longer-delay-8 fadeIn">
			<a href="#donatemodal" data-toggle="modal" role="button" class="btn btn-tertiary btn-lg btn-rounded-edge">Give Obolis</a>
		</div>
		-->
		<!-- campaign stats -->
		<div class="col-lg-12 bg-brand-secondary-darkest footer">
			<div class="fundraiser-stats">
				<div class="col-xs-4">
					<div class="vert-centered-wrapper-120px">
						<!-- height set in one-page-base.css -->
						<div class="vert-centered">
							<h2 class="bold" >{{ $ngo->oboli_count }}</h2>
							<h4>Obolis donated</h4>
						</div>
					</div>
				</div>
				<div class="col-xs-4">
					<div class="vert-centered-wrapper-120px">
						<!-- height set in one-page-base.css -->
						<div class="vert-centered">
							<h2 class="bold" >{{ $ngo->donations_count }}</h2>
							<h4>Donations</h4>
						</div>
					</div>
				</div>
				<div class="col-xs-4 end">
					<div class="vert-centered-wrapper-120px">
						<!-- height set in one-page-base.css -->
						<div class="vert-centered">
							<h2 class="bold" >{{ $ngo->donors }}</h2>
							<h4>Donors</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /end campaign stats --> 
		
		<div class="animated-longer-delay-8 fadeIn">
			<a href="#donatemodal" data-toggle="modal" role="button" class="btn btn-tertiary btn-lg btn-rounded-edge">Give Obolis</a>
		</div>
		
	</div>
	<div class="clearfix"></div>
</section>
<!--=== / END campaign summary  ===-->
<!--=== CAMPAIGN DETAILS ===-->
<section id="campaign-details" class="bg-white">
	<div class="inner-container overlay-light">
		<!-- section header -->
		<!--
		<div class="row text-center">
			<div class="col-lg-12 col-sm-12 wow animated-longer-delay-1 fadeInDown">
				<h1>{{ $ngo['name'] }}</h1>
				<div class="accent-rule-short"></div>
				<h2>{{ $ngo['short_description'] }}</h2>
			</div>
		</div>
		-->
		<!-- / end section header -->
		<div class="row row-of-columns">
			<div class="col-md-8 col-xs-12 wow animated-longer-delay-2 fadeIn">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs nav-justified" role="tablist">
					<li class="active large"><a href="#campaign-overview" role="tab" data-toggle="tab">Description</a></li>
					<li class="large"><a href="#location" role="tab" data-toggle="tab">Location</a></li>
				</ul>
				<!-- Tab panes -->
				<div class="tab-content bg-white">
					<!-- tab pane 1 -->
					<div class="tab-pane active" id="campaign-overview">
						<div class="clearfix"></div>
						<!--  campaign logo -->
						<div class="col-lg-4">
							<div class="widget-campaign-logo">
								<div class="vert-centered-wrapper-300px">
									<!-- height set in one-page-base.css -->
									<div class="vert-centered">
										<i class="fa fa-child fa-5x"></i><i class="fa fa-child fa-5x"></i><i class="fa fa-child fa-5x"></i><i class="fa fa-child fa-5x">
										</i><br>
										<i class="fa fa-child fa-5x"></i><i class="fa fa-child fa-5x"></i><i class="fa fa-child fa-5x"></i><i class="fa fa-child fa-5x"></i>
										<h2 class="bold">100 Children</h2>
										<h2>Need our help</h2>
									</div>
								</div>
							</div>
						</div>
						<!--  /end campaign logo -->
						<br>
						<div class="col-lg-8">
							<h3>Working to protect human rights.</h3>
							<p>
								{{ $ngo['long_description'] }}
							</p>
						</div>
					</div>
					<!-- / end tab pane 1 -->
					<!-- tab pane 2 -->
					<div id="location" class="tab-pane text-center">
						<h3>Location: <span class="text-primary"> North Africa</span></h3>
						<br>
						<img src="img/World_map_blank_gmt.svg" class="img-responsive col-xs-12" alt="map">
					</div>
					<!-- / end tab pane 2 -->
					<div class="clearfix"></div>
				</div>
				<!-- / end tabs -->
			</div>
			<!-- / end col 1 -->
			<!-- col 2 -->
			<div class="col-md-4 col-xs-12 wow animated-longer-delay-6 fadeIn">
				<!-- panel -->
				<div class="panel panel-support-campaign panel-white">
					<div class="panel-header bg-brand-primary text-center">
						<h2>What can your donation do?</h2>
					</div>
					<div class="panel-body">
						<div class="vert-centered-wrapper-200px wow animated-longer-delay-4 fadeIn stats-carousel">
							<!-- height set in one-page-base.css -->
							<div class="vert-centered">
								<!-- carousel -->
								<div class="carousel slide carousel-fade" id="carousel-sample">
									<div class="carousel-inner">
										<!-- item 1  -->
										<div class="item active">
											<i class="fa fa-group fa-3x"></i>
											<h3>Just $15.00 provides meals to more than 10 children</h3>
											<a href="#donatemodal" data-toggle="modal" role="button" class="btn btn-tertiary btn-lg btn-rounded-edge">Give Obolis</a>
										</div>
										<!-- /end item 1  -->   
										<!-- item 2  -->
										<div class="item ">
											<i class="fa fa-life-bouy fa-3x"></i>
											<h3>Just $100.00 provides aid to more than 10 families</h3>
											<button class="btn btn-tertiary btn-lg  btn-rounded-edge" >Support</button>
										</div>
										<!-- /end item 2  --> 
									</div>
								</div>
								<!-- /end carousel  --> 
							</div>
						</div>
						<!-- /end vert centered wrapper  --> 
					</div>
					<!-- /end panel body  -->
				</div>
				<!-- /end panel  -->
			</div>
		</div>
	</div>
	<!-- / end col 2 -->
	<div class="clearfix"></div>
</section>
<!--=== / END campaign details   ===-->





	
		



@stop


@section('plugins')
<script src="{{ asset('bootstrap/plugins/Animated-Circle-Statistics-Plugin-With-jQuery-Canvas-Circliful/js/jquery.circliful.min.js') }}"></script>


	<script src="{{ asset('slider/responsiveslides.js') }}"></script>
	<script src="{{ asset('slider/responsiveslides.min.js') }}"></script>
	<link rel="stylesheet" href="{{ asset('slider/cresponsiveslides.css') }}" />
	<link rel="stylesheet" href="{{ asset('slider/themes.css') }}" />
	<script>
    // You can also use "$(window).load(function() {"
    $(function () {

      // Slideshow 1
      $("#slider1").responsiveSlides({
        auto: false,
        pager: true,
        nav: true,
        speed: 500,
        maxwidth: 800,
        namespace: "centered-btns"
      });

      // Slideshow 2
      $("#slider2").responsiveSlides({
        auto: false,
        pager: true,
        nav: true,
        speed: 500,
        maxwidth: 800,
        namespace: "transparent-btns"
      });

      // Slideshow 3
      $("#slider3").responsiveSlides({
        auto: true,
        pager: false,
        nav: true,
        speed: 500,
        maxwidth: 800,
        namespace: "centered-btns"
      });

    });
  </script>

@stop

