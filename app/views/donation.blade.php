@extends('layouts.master')

@section('meta')
	<meta property="og:locale" content="it_IT"/>
	<meta property="og:type" content="article"/>
	<meta property="og:title" content="Oggi ho aiutato {{ $ngo_name }} @ Oboli"/>
	<meta property="og:description" content="Oboli: il nuovo modo di aiutare fare del bene senza spendere un centesimo."/>
	<meta property="og:url" content="{{ Request::url() }}"/>
	<meta property="og:site_name" content="Oboli"/>
	<meta property="og:image" content="{{ asset('img/web/ngos/'.$ngo_id.'.png') }}"/>	
@stop

<title>Oggi ho aiutato {{ $ngo_name }} @ Oboli</title>


@section('content')
<div id="fb-root"></div>

<!-- site content -->
<div id="main">				
	<section class="container" id="page-info">
		<div class="row">
			<!-- Table Section Start Here -->
			<div class="col-xs-12 col-md-8 col-md-offset-2 four-zero-four">
				<h1>Hai un cuore grande {{ $user_name }}!</h1>
				<header class="page-header">
					<h2>{{ $ngo_name }} ti ringrazia per avergli donato {{ $amount }} oboli!</h2>
				</header>
				<a class="btn btn-default" href="/">Torna alla pagina principale</a>	


				<button id="sharer" class="btn btn-default">Share on fb</button>
				<script>
				document.getElementById('sharer').onclick = function () {
				  var url = 'https://www.facebook.com/sharer/sharer.php?u={{ Request::url() }}';
				  window.open(url, 'fbshare', 'width=640,height=320');
				};
				</script>


			</div>		
		</div>
	</section>
</div>
@stop

