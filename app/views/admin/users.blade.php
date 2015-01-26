@extends('layouts.master')

@section('title')
Users
@stop


@section('content')
	<div class="container" style="margin-top:40px">	
		<h2>Users</h2>
		<div class="bs-example">

			<table class="table">
				<tbody>				
					<tr>
						<td>Total Users</td>
						<td>{{ $users_count }}</td>	
					</tr>			
				</tbody>
			</table>



			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Email</th>
						<th>Email Confirmed</th>
						<th>Signup with Facebook</th>
						<th>Obolis</th>
						<th>Obolis Donated</th>
					</tr>
				</thead>
				<tbody>				
					@for ($i=0; $i<count($users); $i++) 
						<?php
						$user = $users[$i];
						?>
						<tr>
							<td>{{ $i }}</td>
							<td>{{ $user->email }}</td>	
							<th>{{ ($user->confirmed==1) ? 'yes' : '' }}</th>
							<th>{{ ($user->facebook_profile==1) ? 'yes' : '' }}</th>	
							<td>{{ $user->oboli_count }}</td>				
							<td>{{ $user->donated_oboli_count }}</td>
						</tr>
					@endfor				
				</tbody>
			</table>
		</div>
	</div>
	
@stop
