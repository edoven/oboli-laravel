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
					</tr>
				</thead>
				<tbody>				
					@for ($i=0; $i<count($codes); $i++) 
						<tr>
							<td>{{ $i }}</td>
							<td>{{ $codes[$i]->getId() }} (<a href="code/{{ $codes[$i]->getId() }}">USE IT</a>)</td>						
							<td>
								@if ($codes[$i]->getUser()==null)
									NOT YET USED
								@else
									{{ User::find($codes[$i]->getUser())->getName() }}
								@endif
							</td>
						</tr>
					@endfor				
				</tbody>
			</table>
		</div>
	</div>
	
@stop
