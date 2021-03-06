@extends('layouts.master')

@section('meta')
	<!-- FACEBOOK METAs -->
	<meta property="og:locale" content="it_IT"/>
	<meta property="og:type" content="article"/>
	@if ($amount == 1)
		<meta property="og:title" content="Ho appena donato 1 obolo a {{ $ngo->name }}! #bastapoco"/>
	@else
		<meta property="og:title" content="Ho appena donato {{ $amount }} oboli a {{ $ngo->name }}! #bastapoco"/>
	@endif	
	<meta property="og:description" content="Oboli - il nuovo modo di fare del bene senza spendere un centesimo!"/>
	<meta property="og:url" content="{{ Request::url() }}"/>
	<meta property="og:site_name" content="Oboli"/>
	<meta property="og:image" content="{{ asset('img/web/ngos/small/'.$ngo->name_short.'.jpg') }}"/>
	<meta property="fb:app_id" content="309252712585820" />
	<meta property="article:author" content="https://oboli.co.in/" />
	<meta property="article:publisher" content="https://oboli.co.in" />
@stop

<title>Oggi ho aiutato {{ $ngo->name }} @ Oboli</title>






@section('title')
{{ $ngo->name  }}
@stop


@section('content')
        
        <div class="donation-completed-page content-wrapper" id="page-info">
            <div class="container">
                <!-- our causes detail-->
                <div class="anim-section animate">
                    <div class="row">
                        <div class="col-xs-12 col-sm-9 left-block">
                            <div class="article-list-large donation-completed-box progressbar">

                                <h1><span><b>{{ $user_name }}</b> ha scelto di fare del bene</span>&nbsp;su <b>Oboli</b></h1>
                                <figure>
                                    <img src="{{ asset('img/web/ngos/large/'.$ngo->name_short.'.jpg') }}">
                                </figure>
                                <!--<img src="{{ asset('img/web/ngos/large/'.$ngo->name_short.'.jpg') }}" class="image-area" alt="$ngo->name_short">-->
                                <div class="bottom-area">
                                    <h3>
                                    	@if ($amount==1)
                                    		 Ha donato <b>1 Oboli</b><br />
										@else
											 Ha donato <b>{{ $amount }} Oboli</b><br />
										@endif                                  
                                        a {{ $ngo->name }}
                                    </h3>
                                    <a href="/howitworks">Scopri come puoi fare del bene <b>anche tu</b>!</a>
                                </div>
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
														<div class="overlay"></div>
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
										<a href="/ngos?category=environment">
											<img src="{{ asset('img/web/areas/icons/environment.png') }}" alt=""> Ambiente <span class="pull-right">(5)</span>
										</a>
									</li>
									<li>
										<a href="/ngos?category=animals">
											<img src="{{ asset('img/web/areas/icons/animals.png') }}" alt=""> Animali <span class="pull-right">(1)</span>
										</a>
									</li>
									<li>
										<a href="/ngos?category=children">
											<img src="{{ asset('img/web/areas/icons/children.png') }}" alt=""> Bambini <span class="pull-right">(2)</span>
										</a>
									</li>
									<li>
										<a href="/ngos?category=humrights">
											<img src="{{ asset('img/web/areas/icons/humrights.png') }}" alt=""> Diritti Umani <span class="pull-right">(4)</span>
										</a>
									</li>
									<li>
										<a href="/ngos?category=women">
											<img src="{{ asset('img/web/areas/icons/women.png') }}" alt=""> Donne <span class="pull-right">(2)</span>
										</a>
									</li>
									<li>
										<a href="/ngos?category=health">
											<img src="{{ asset('img/web/areas/icons/health.png') }}" alt=""> Salute <span class="pull-right">(2)</span>
										</a>
									</li>
									<li>
										<a href="/ngos?category=development">
											<img src="{{ asset('img/web/areas/icons/development.png') }}" alt=""> Sviluppo <span class="pull-right">(3)</span>
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



@section('scripts')


<div id="fb-root"></div>
<script>
	(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=765916286805888&version=v2.0";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>


<!--
<script>
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
</script>
-->
@stop