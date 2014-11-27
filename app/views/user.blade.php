@extends('layouts.master')

@section('title')
User {{ Auth::user()->name }}
@stop

@section('content')
	<div class="container" style="margin-top:60px">	
		@if (count($helped_ngos)==0)
			<p>Non hai ancora fatto donazioni</p>
		@else
			<h2>Donazione che hai fatto</h2>
			<div class="bs-example">
				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>ONG</th>
							<th>Oboli donati</th>
						</tr>
					</thead>
					<tbody>	
						@foreach ($donations as $donation) 
							<tr>
								<td><a href="/donations/{{ $donation['id'] }}">{{ $donation['ngo_id'] }}</a></td> 
								<td><a href="/ngos/{{ $donation['ngo_id'] }}">{{ $donation['ngo_id'] }}</a></td>  
								<td>{{ $donation['amount'] }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div><!-- /example -->
		@endif


		@if (count($brands2obolis)==0)
			<p>Non hai ancora guadagnato Oboli</p>
		@else
			<h2>Oboli Earned</h2>
			<div class="bs-example">
				<table class="table">
					<thead>
						<tr>
							<th>BRAND NAME</th>
							<th>Obolis EARNED</th>
						</tr>
					</thead>
					<tbody>	
						@foreach ($brands2obolis as $brand2obolis) 
							<tr>
								<td>{{ $brand2obolis['brand_name'] }}</td> 
								<td>{{ $brand2obolis['oboli'] }}</td> 
								<td><img src="{{ $brand2obolis['brand_image_url'] }}"></img></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div><!-- /example -->
		@endif
		

	</div>
@stop



