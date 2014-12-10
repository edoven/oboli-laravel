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


@section('content')
<div id="fb-root"></div>

<!-- site content -->
<div id="main">				
	<section class="container" id="page-info">
		<div class="row">
			<!-- Table Section Start Here -->
			<div class="col-xs-12 col-md-8 col-md-offset-2 four-zero-four">
				
				<h1>Hai un cuore grande {{ $user_name }}!</h1>
				<h1><span class="fa fa-heart-o" /></h1>
				<div class="row">
					<figure>
						<img src="{{ asset('img/web/ngos/large/'.$ngo->name_short.'.jpg') }}" alt="">
					</figure>
				</div>
				<hr>
				<div class="row">
					<h2>{{ $ngo->name }} ti ringrazia per avergli donato {{ $amount }} oboli!</h2>
				</div>
				<hr>
				<div class="row">
					<div class="col-xs-12">
						<button id="sharer" class="btn btn-default btn-social btn-lg btn-facebook"><i class="fa fa-facebook"></i>Condividi su Facebook</button>
					</div>
					<hr />
					<div class="col-xs-12">
						<a href="https://twitter.com/share" class="btn btn-default btn-social btn-lg btn-twitter" data-via="getoboli" data-lang="it" data-count="none"><i class="fa fa-twitter"></i>Condividi su Twitter</a>
					</div>
					<div class="col-xs-12">
						(Oppure <a href="/ngos">torna indietro</a>)
					</div>		
				</div>
				
				
			</div>		
		</div>
	</section>
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