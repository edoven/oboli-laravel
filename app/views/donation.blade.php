@extends('layouts.master')

@section('meta')
	<og:url class="hide">http://www.getoboli.com</og:url>
	<og:title class="hide">Oggi ho aiutato {{ $ngo_name }} @ Oboli</og:title>
	<og:description class="hide">Oboli: il nuovo modo di aiutare fare del bene senza spendere un centesimo.</og:description>
	<og:image class="hide" href="{{ asset('assets/img/volunteer.jpg') }}"></og:image>
	
	<title>Oggi ho aiutato {{ $ngo_name }} @ Oboli</title>
@stop


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
				<a class="btn btn-default" href="http://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fedoventurini.com%2Fdonazione%2F&width&layout=icon_link&appId=765916286805888">share on fb</a>
				<a class="btn btn-default" href="/">Torna alla pagina principale</a>	


				<button id="sharer" class="btn btn-default">Share on fb</button>
				<script>
				document.getElementById('sharer').onclick = function () {
				  var url = 'https://www.facebook.com/sharer/sharer.php?u=http://edoventurini.com/donations/1';
				  window.open(url, 'fbshare', 'width=640,height=320');
				};
				</script>


			</div>		
		</div>
	</section>
</div>
@stop

