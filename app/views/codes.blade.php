@extends('layouts.master')

@section('title')
Codes
@stop


@section('content')
	<div class="container" style="margin-top:40px">	
		<h2>Codes</h2>
		<div class="bs-example">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Code</th>
						<th>Oboli</th>
						<th>Used By</th>
						<th>Activated At</th>
						<th>USE</th>
					</tr>
				</thead>
				<tbody>				
					@for ($i=0; $i<count($codes); $i++) 
						<?php
						$code = $codes[$i];
						?>
						<tr>
							<td>{{ $i }}</td>
							<td>{{ $code->id }}</td>	
							<td>{{ $code->oboli }}</td>						
							<td>
								@if ($code->activated_at==null)
									NOT YET USED
								@else
									{{ User::find($code->user)->name }}
								@endif
							</td>
							<td>
								@if ($code->activated_at==null)
									NOT YET USED
								@else
									{{ $code->activated_at }}
								@endif
							</td>
							<td>
								<form action="code/{{ $code->id }}">
									<input type="submit" class="btn btn-success" value="Use this code">
								</form>
							</td>
						</tr>
					@endfor				
				</tbody>
			</table>
		</div>
	</div>
	
@stop
