@extends('layouts.master')

@section('title')
Error
@stop

@section('content')
<!-- site content -->
<div id="main">				
	<section class="container" id="page-info">
		<div class="row">
			<!-- Table Section Start Here -->
			<div class="col-xs-12 col-md-8 col-md-offset-2 four-zero-four">
				<h1>Errore</h1>
				<header class="page-header">
					<h2>{{ Session::get('message') }}</h2>
				</header>
				<a class="btn btn-default" href="{{ URL::previous() }}">Torna indietro</a>		
			</div>		
		</div>
	</section>
</div>
@stop