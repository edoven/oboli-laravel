@extends('layouts.master')

@section('title')
User {{ Auth::user()->name }}
@stop

@section('content')
	<div class="container" style="margin-top:60px">	
		<p>Name: {{ $user['name']}}</p>
		<p>Email: {{ $user['email'] }}</p>
		<p>Oboli: {{ $user['oboli_count'] }}</p>
		@if (count($donations)==0)
			<p>NO DONATIONS</p>
		@else
			<h2>Donations</h2>
			<div class="bs-example">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>NGO</th>
							<th>Oboli Donated</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>	
						@for ($i=0; $i<count($donations); $i++) 
							<tr>
								<td>{{ $i }}</td>
								<td>{{ $donations[$i]['ngo_id'] }}</td> 
								<td>{{ $donations[$i]['amount'] }}</td>
								<td>{{ $donations[$i]['date'] }}</td>
								<td>{{ $donations[$i]['created_ad'] }}</td>
							</tr>
						@endfor
					</tbody>
				</table>
			</div><!-- /example -->
		@endif
		

	</div>
@stop



