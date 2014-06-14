@extends('layouts.master')

@section('title')
Home
@stop

@section('content')
	<section id="main-slider" class="no-margin">
        <div class="carousel slide wet-asphalt">
            <ol class="carousel-indicators">
                <li data-target="#main-slider" data-slide-to="0" class="active"></li>
                <li data-target="#main-slider" data-slide-to="1"></li>
                <li data-target="#main-slider" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="item active" style="background-image: url(   {{ asset('theme/images/slider/img1.jpg') }}  )">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="carousel-content center centered">
									<h2 class="boxed animation animated-item-1">Stiamo costruendo un mondo migliore grazie a te</h2>
									<!--<p class="animation animated-item-2">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>-->
									<br>
									<a class="btn btn-md animation animated-item-3" href="#">Scopri come</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/.item-->
                <div class="item" style="background-image: url(images/slider/bg2.jpg)">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="carousel-content center centered">
                                    <h2 class="boxed animation animated-item-1">Clean, Crisp, Powerful and Responsive Web Design</h2>
                                    <p class="boxed animation animated-item-2">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                                    <br>
                                    <a class="btn btn-md animation animated-item-3" href="#">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/.item-->
                <div class="item" style="background-image: url(images/slider/bg3.jpg)">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="carousel-content centered">
                                    <h2 class="animation animated-item-1">Powerful and Responsive Web Design Theme</h2>
                                    <p class="animation animated-item-2">Pellentesque habitant morbi tristique senectus et netus et malesuada fames</p>
                                    <a class="btn btn-md animation animated-item-3" href="#">Learn More</a>
                                </div>
                            </div>
                            <div class="col-sm-6 hidden-xs animation animated-item-4">
                                <div class="centered">
                                    <div class="embed-container">
                                        <iframe src="//player.vimeo.com/video/69421653?title=0&amp;byline=0&amp;portrait=0&amp;color=a22c2f" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/.item-->
            </div><!--/.carousel-inner-->
        </div><!--/.carousel-->
        <a class="prev hidden-xs" href="#main-slider" data-slide="prev">
            <i class="icon-angle-left"></i>
        </a>
        <a class="next hidden-xs" href="#main-slider" data-slide="next">
            <i class="icon-angle-right"></i>
        </a>
    </section><!--/#main-slider-->
    
    
    <section id="recent-works">
        <div class="container">
			<div class="center">
				<h1>I progetti che puoi sostenere</h1>
            </div>
            <div class="gap"></div>
            <div class="row">
                <div class="col-md-12">
                    <div id="scroller" class="carousel slide">
                        <div class="carousel-inner">
                            <div class="item active">
								
								
								
								<!-- Projects -->
								<?php
									$projects = Project::all();
								?>
								<div class="container marketing">			
										@for ($i = 0; $i < count($projects); $i++)
											@if ($i%3==0)
												<div class="row">
											@endif
											
											<div class="col-lg-4">
												<a href="project/{{ $projects[$i]->id }}">
													<img class="img-responsive" src="{{ asset('theme/images/portfolio/recent/mafia.png') }} " alt="">
												</a>
												<a href="project/{{ $projects[$i]->id }}">
													<h2>{{ $projects[$i]->getName() }}</h2>
												</a>
												
												<p>
													{{ $projects[$i]->getShortDescription() }}
												</p>
												<div class="progress">
													<div class="progress-bar" role="progressbar" aria-valuenow="{{ $projects[$i]->getOboliCount()  }}" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
														{{ $projects[$i]->getOboliCount()  }}
													</div>
												</div>
												<p>
													<a class="btn btn-default" href="project/{{ $projects[$i]->id }}" role="button">
														View details »
													</a>
												</p>
											</div><!-- /.col-lg-4 -->
											
											@if ($i%3==2)
												</div><!-- /.row -->
											@endif
										@endfor
								</div>
                            </div><!--/.item-->
                        </div>
                    </div>
                </div>
            </div><!--/.row-->
            
            <div class="row">
				<br \>
				<br \>
				<div class="center">
					<form action="/projects">
						<input type="submit" value="Scopri tutti i progetti" class="btn btn-primary btn-lg">
					</form>
					
				</div>
				
            </div>
        </div>
    </section><!--/#recent-works-->
    
    
     <section id="testimonial" class="turquoise">
		<div class="container">
			<h1 class="center">Come funziona Oboli</h1>
			<div class="gap"></div>

			<div id="meet-the-team" class="row">
				<div class="col-md-4 col-xs-6">
					<div class="center">
						<p><img class="img-responsive img-thumbnail img-circle" src="{{ asset('theme/images/team-member.jpg') }} " alt="" ></p>
						<h2><p>1</p></h2>
						<h3><p>Raccogli gli Oboli che trovi in oltre cento prodotti</p></h3>
					</div>
				</div>
				
				<div class="col-md-4 col-xs-6">
					<div class="center">
						<p><img class="img-responsive img-thumbnail img-circle" src="{{ asset('theme/images/team-member.jpg') }}" alt="" ></p>
						<h2><p>2</p></h2>
						<h3><p>Scegli i progetti che vuoi sostenere</p></h3>
					</div>
				</div>
				
				<div class="col-md-4 col-xs-6">
					<div class="center">
						<p><img class="img-responsive img-thumbnail img-circle" src="{{ asset('theme/images/team-member.jpg') }}" alt="" ></p>
						<h2><p>3</p></h2>
						<h3><p>Dona gli Oboli ai progetti che hai scelto</p></h3>
					</div>
				</div>


			</div><!--/#meet-the-team-->
		</div>
    </section><!--/#about-us-->
    
@stop
