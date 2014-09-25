@extends('layouts.master')

@section('title')
Projects
@stop

@section('content')

	<!-- Projects -->
	<div class="container" style="margin-top:40px">			
			@for ($i = 0; $i < count($projects); $i++)
				@if ($i%3==0)
					<div class="row">
				@endif
				
				<div class="col-lg-4">
					<a href="projects/{{ $projects[$i]->id }}">
						<img src="img/projects/project.jpg" style="width: 140px; height: 140px;" class="img-circle" data-src="holder.js/140x140" alt="140x140">
					</a>
					<a href="projects/{{ $projects[$i]->id }}">
						<h2>{{ $projects[$i]->getName() }}</h2>
					</a>
					
					<p>
						{{ $projects[$i]->getShortDescription() }}
					</p>
					<div class="progress">
						<div class="progress-bar" role="progressbar" aria-valuenow="{{ $projects[$i]->getOboliCount()  }}" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
							{{ $projects[$i]->getOboliCount()  }}
						</div>
					</div>
					<p>
						<a class="btn btn-default" href="projects/{{ $projects[$i]->id }}" role="button">
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
