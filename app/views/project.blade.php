@extends('layouts.master')

@section('title')
	Project {{ $project['name'] }}
@stop

@section('content')

	<div class="container" style="margin-top:40px">	
		@if (Auth::check())
			{{ Form::open(array('action' => 'UserController@makeDonation')) }}
			{{ Form::hidden('project_id', $project['id']) }}
			<div class="row">
				<div class="col-md-1">
					<select name="amount" class="form-control input-small">
					@for ($i=1; $i< Auth::user()->getOboliCount(); $i++)
						@if ($i%5==0)
							<option value="{{ $i }}">{{ $i }}</option>
						@endif									
					@endfor
				</select>
				</div>
				<div class="col-md-1">
					{{ Form::submit('Donate', array('class' => 'btn btn-success')) }}
				</div>
			</div>
			{{ Form::close() }}
		@endif
		

		@if (count($donations)==0)
			<h2>No donations to this project.</h2>
		@else	
			<h2>Donations</h2>
			<div class="bs-example">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>User</th>
							<th>Oboli Donated</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>				
						@for ($i=0; $i<count($donations); $i++)
							<tr>
								<td>{{ $i }}</td>
								<td>{{ User::find($donations[$i]['user_id'])->getName() }}</td> <!--DA OTTIMIZZARE!! -->
								<td>{{ $donations[$i]['amount'] }}</td>
								<td>today</td>
							</tr>
						@endfor				
					</tbody>
				</table>
			</div>
		@endif
	</div>
	</div>
@stop
