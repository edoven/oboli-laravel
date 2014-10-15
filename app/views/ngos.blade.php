@extends('layouts.master1')

@section('title')
NGOs
@stop

@section('content')

	
        
        
         <!--=== MEET THE TEAM ===-->
         <section id="team">
			<div class="bg-white">
				<div class="inner-container overlay-light row-of-columns"><!-- used 'row-of-columns' anytime columns will eventually stack in responsive mode, it adds bottom margin to all inner columns when window less than 1200px   -->
					<!-- section header -->
					<div class="header row text-center">
						<div class="col-lg-8 col-xs-12 col-lg-offset-2 wow animated fadeInDown">
							<h1>NGOs you can help</h1>
							<div class="accent-rule-short"></div>
							<h2>The ACT staff is group of passionate people dedicated to addressing the needs and rights of refugees and immigrants.  </h2>
						</div>
					</div><!-- / end section header -->    
                           
                           
                           
                           
             <!--=== ngos and projects ===-->
			<div class="bg-white">
			<div class="inner-container overlay-light row-of-columns">
				<!-- used 'row-of-columns' anytime columns will eventually stack in resposive mode adds bottom margin to all inner columns when window less than 1200px   -->
		
		
				@for ($i = 0; $i < count($ngos); $i++)
					<?php
					$ngo = $ngos[$i];
					?>
					@if ($i%3==0)
						<div class="row">
					@endif
					<!-- element 1/3-->
					<div class="col-sm-4 ">
						<div class="">
							<div class="carousel-inner">
								<div class="item active">
									<div class="panel ngo">
										<div class="panel-header">
											<a href="/ngos/{{ $ngo['id'] }}">
												<img src="{{ asset('bootstrap/img/amnesty.png') }}" class="img-responsive col-xs-12 no-padding"  alt="image"/><!-- / css hack: 'col-xs-12 no-padding' added as workaround due to image not resizing once responsive col kicks in -->
											</a>
											<div class="clearfix"></div>
										</div>
										<div class="panel-body">
											<h3><a href="/ngos/{{ $ngo['id'] }}">{{ $ngo->name }}</a></h3>
											<p>{{ $ngo->short_description }}</p>
											<div class="col-lg-12 no-padding">
												<div class="progress progress-xs">
													<div class="progress-bar progress-bar-tertiary" role="progressbar"  aria-valuenow="60" aria-valuemin="0" aria-valuemax="60" style="width:50%"></div>
												</div>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="panel-footer text-center">
											<div class="col-xs-4">
												<h3>{{ $ngo->oboli_count }}</h3>
												<small>Oboli raised</small>
											</div>
											<div class="col-xs-4">
												<h3>{{ $ngo->donations_count }}</h3>
												<small>Donations recieved</small>
											</div>
											<div class="col-xs-4">
												<h3>{{ $ngo->donors }}</h3>
												<small>Donors</small>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
									<!-- /end panel  -->
								</div>

							</div>
							<!-- /end recent campaign carousel -->
						</div>
						<!-- /end inner container -->
					</div>
					<!-- END element 1/3-->
					
					@if ($i%3==2)
						</div><!-- /.row -->
					@endif
				@endfor
				
				
			</div>
		<!--=== ENDngos and projects ===-->
                           
                           
                           
                             
                      </div><!-- / end inner container-->
                </div><!-- / end background color wrapper-->
	</section><!--=== / END meet the team ===-->
       

@stop
