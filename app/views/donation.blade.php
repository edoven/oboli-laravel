@extends('layouts.master')

@section('meta')
	<meta property="og:locale" content="it_IT"/>
	<meta property="og:type" content="article"/>
	<meta property="og:title" content="Oggi ho aiutato {{ $ngo->name }} @ Oboli"/>
	<meta property="og:description" content="Oboli: il nuovo modo di aiutare fare del bene senza spendere un centesimo."/>
	<meta property="og:url" content="{{ Request::url() }}"/>
	<meta property="og:site_name" content="Oboli"/>
	<meta property="og:image" content="{{ asset('img/web/ngos/small/'.$ngo->name_short.'.jpg') }}"/>	
@stop

<title>Oggi ho aiutato {{ $ngo->name }} @ Oboli</title>






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
								<div class="heading-sec text-left">
									<h3 class="h4">Hai un cuore grande {{ $user_name }}!</h3>
								</div>
								<figure>
									<img src="{{ asset('img/web/ngos/large/'.$ngo->name_short.'.jpg') }}" alt="">
								</figure>
								<div class="progress">
								</div>
								
								<div class="row">
									<div class="col-xs-12">
										
									</div>
								</div>
								<div class="heading-sec text-left">
									<h3 class="h4">{{ $ngo->name }} ti ringrazia per avergli donato {{ $amount }} oboli!</h3>
								</div>
								<div class="detail-description">
									<button id="sharer" class="btn btn-default btn-social btn-lg btn-facebook"><i class="fa fa-facebook"></i>Condividi su Facebook</button>
									<a href="https://twitter.com/share" class="btn btn-default btn-social btn-lg btn-twitter" data-via="getoboli" data-lang="it" data-count="none"><i class="fa fa-twitter"></i>Condividi su Twitter</a>
								</div>
								<!--step donation-->
							</div>
						</div>
						
					</div>

					<div class="col-xs-12 col-sm-3 left-block ">
						<aside class="media">
							<h3 class="space-top">Donazioni più recenti</h3>
							<ul>
								@foreach ($recent_ngos as $recent_ngo)
									<li>
										<a href="#" class="pull-left">
											<figure>
												<img src="{{ asset('img/web/ngos/xs/'.$recent_ngo->name_short.'.jpg') }}" alt="">
											</figure>
										</a>
										<div class="media-body">
											<p>
												<a href="#">
												{{ $recent_ngo->name }}
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
					</div>
				</div>
			</div>
			<!-- our causes detail-->
		</div>
	</div>


@stop



@section('scripts')
<script>
	document.getElementById('sharer').onclick = function () {
	  var url = 'https://www.facebook.com/sharer/sharer.php?u={{ Request::url() }}';
	  window.open(url, 'fbshare', 'width=640,height=320');
	};
</script>

<script>
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
</script>
@stop