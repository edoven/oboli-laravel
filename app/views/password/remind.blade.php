@extends('layouts.master1')

@section('title')
Password Remind
@stop


@section('content')
	<div class="container" style="margin-top:120px">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">			
				<div class="panel-heading">
					<h3 class="panel-title">
						<strong>
							Password forgotten?
						</strong>
					</h3>
				</div>
				<div class="panel-body">
					{{ Form::open(array('url' => 'password/remind')) }}
						<div class="form-group">
							<div class="controls">
								 <label class="control-label">Email <span class="transparent-50"></span></label>
								 <input type="text" id="email" name="email" class="field text form-control" placeholder="Email">
							</div>
						</div>						
						<button type="submit" class="btn btn-sm btn-default">
							Submit
						</button>						
					{{ Form::close() }}

					@if (Session::has('error'))
						<div id="error">
							<h2>{{ trans(Session::get('error')) }}</h2>
						</div>
					@elseif (Session::has('success'))
						<div id="success">
							<h2>An email with the password reset has been sent.</h2>
						</div>						
					@endif
				</div>			
			</div>			
		</div>
	</div>
@stop