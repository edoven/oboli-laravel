@extends('layouts.master')

@section('title')
User {{ Auth::user()->name }}
@stop

@section('content')
	<div class="container" style="margin-top:60px">	
		<p>Name: {{ $user['name']}}</p>
		<p>Email: {{ $user['email'] }}</p>
		<p>Oboli: {{ $user['oboli_count'] }}</p>
		@if (count($helped_ngos)==0)
			<p>NO HELPED NGOS</p>
		@else
			<h2>Helped Ngos</h2>
			<div class="bs-example">
				<table class="table">
					<thead>
						<tr>
							<th>NGO</th>
							<th>Oboli Donated</th>
						</tr>
					</thead>
					<tbody>	
						@foreach ($helped_ngos as $helped_ngo) 
							<tr>
								<td>{{ $helped_ngo['ngo']['name'] }}</td> 
								<td>{{ $helped_ngo['amount'] }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div><!-- /example -->
		@endif


		@if (count($brands2obolis)==0)
			<p>NO OBOLIS EARNED</p>
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



