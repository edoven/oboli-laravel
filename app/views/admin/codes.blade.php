@extends('layouts.master')

@section('title')
Codes
@stop


@section('content')
	<div class="container" style="margin-top:40px">	
		<h2>Codes</h2>
		<div class="bs-example">

			<table class="table">
				<tbody>				
					<tr>
						<td>Codici Totali</td>
						<td>{{ $codes_count }}</td>	
					</tr>
					<tr>
						<td>Codici Usati</td>
						<td>{{ $codes_count-$unused_codes_count }}</td>	
					</tr>
					<tr>
						<td>Codici Non Usati</td>
						<td>{{ $unused_codes_count }}</td>	
					</tr>			
				</tbody>
			</table>



			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Code</th>
						<th>Oboli</th>
						<th>Used By</th>
						<th>Created At</th>
						<th>Activated At</th>
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
								@if ($code->activated_at!=null)
									{{ User::find($code->user)->name }}
								@endif
							</td>
							<td>
								{{ $code->created_at }}
							</td>
							<td>
								@if ($code->activated_at!=null)
									{{ $code->activated_at }}
								@endif
							</td>
						</tr>
					@endfor				
				</tbody>
			</table>
		</div>
	</div>
	
@stop
