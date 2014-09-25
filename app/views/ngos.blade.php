@extends('layouts.master')

@section('title')
NGOs
@stop

@section('content')

	<!-- NGOs -->
	<div class="container" style="margin-top:40px">			
			@for ($i = 0; $i < count($ngos); $i++)
				<?php
				$ngo = $ngos[$i];
				?>
				@if ($i%3==0)
					<div class="row">
				@endif
				
				<div class="col-lg-4">
					<a href="ngos/{{ $ngo->id }}">
						<img src="img/projects/project.jpg" style="width: 140px; height: 140px;" class="img-circle" data-src="holder.js/140x140" alt="140x140">
					</a>
					<a href="ngos/{{ $ngo->id }}">
						<h2>{{ $ngo->name }}</h2>
					</a>
					
					<p>
						{{ $ngo->short_description }}
					</p>
					<div class="progress">
						<div class="progress-bar" role="progressbar" aria-valuenow="{{ $ngo->oboli_count  }}" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
							{{ $ngo->oboli_count }}
						</div>
					</div>
					<p>
						<a class="btn btn-default" href="ngos/{{ $ngo->id }}" role="button">
							View details »
						</a>
					</p>
				</div><!-- /.col-lg-4 -->
				
				@if ($i%3==2)
					</div><!-- /.row -->
				@endif
			@endfor
	</div>
	</div>
@stop
