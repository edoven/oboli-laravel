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
						<th>Used By</th>
						<th>USE</th>
					</tr>
				</thead>
				<tbody>				
					@for ($i=0; $i<count($codes); $i++) 
						<tr>
							<td>{{ $i }}</td>
							<td>{{ $codes[$i]->getId() }}</td>						
							<td>
								@if ($codes[$i]->getUser()==null)
									NOT YET USED
								@else
									{{ User::find($codes[$i]->getUser())->getName() }}
								@endif
							</td>
							<td>
								<form action="code/{{ $codes[$i]->getId() }}">
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
