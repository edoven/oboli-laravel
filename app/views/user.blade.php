@extends('layouts.master')


@section('title')
User {{ Auth::user()->name }}
@stop


@section('content')
	<div class="container" style="margin-top:60px">	


		@if (count($helped_ngos)==0)
			<div class="profile-block">
				<div class="title">
					<h2>Non hai ancora fatto donazioni</h2>
				</div>
			</div>
		@else
			<div class="profile-block">
				<div class="title">
					<h2>Ong aiutate</h2>
				</div>
				<div class="bs-example">
					<table class="table">
						<thead>
							<tr>
								<th>ONG</th>
								<th>Oboli donati</th>
							</tr>
						</thead>
						<tbody>	
							@foreach ($helped_ngos as $ngo) 
								<tr>
									<td>{{ $ngo['ngo']['name'] }}</td> 
									<td>{{ $ngo['amount'] }}</td>  
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>

			<div class="profile-block">
				<div class="title">
					<h2>Donazione effettuate</h2>
				</div>
				<div class="bs-example">
					<table class="table">
						<thead>
							<tr>
								<th>ONG</th>
								<th>Oboli donati</th>
								<th>Link da Condividere</th>
							</tr>
						</thead>
						<tbody>	
							@foreach ($donations as $donation) 
								<tr>
									<td><a href="/donations/{{ $donation->name }}">{{ $donation->name }}</a></td> 
									<td>{{ $donation->amount }}</td>  
									<td><a href="/donations/{{ $donation->id }}"><span class="fa fa-external-link"></span></a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div><!-- /example -->
			</div>
		@endif

		

		<div class="profile-block">
			@if (count($brands2obolis)==0)
				<div class="title">
					<h2>Non hai ancora guadagnato Oboli</h2>
				</div>
			@else
				<div class="title">
					<h2>Oboli Ottenuti</h2>
				</div>
				<div class="bs-example">
					<table class="table">
						<thead>
							<tr>
								<th>Azienda</th>
								<th>Numero di Oboli</th>
							</tr>
						</thead>
						<tbody>	
							@foreach ($brands2obolis as $brand2obolis) 
								<tr>
									<td><img src="{{ $brand2obolis['brand_image_url'] }}"></img></td>
									<!--<td>{{ $brand2obolis['brand_name'] }}</td>-->
									<td>{{ $brand2obolis['oboli'] }}</td> 
								</tr>
							@endforeach
						</tbody>
					</table>
				</div><!-- /example -->
			@endif
		</div>
		

	</div>
@stop