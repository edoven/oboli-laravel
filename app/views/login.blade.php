@extends('layouts.master')

@section('title')
Login
@stop


@section('content')
	<div class="container" style="margin-top:120px">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						<strong>
							Login
						</strong>
					</h3>
				</div>
				<div class="panel-body">
					{{ Form::open(array('url' => 'login')) }}
						<div class="form-group">
							{{ Form::label('email', 'Email Address') }}
							<input type="email" class="form-control" style="border-radius:0px" id="email" name="email" placeholder="Enter email">
						</div>
						<div class="form-group">
							{{ Form::label('password', 'Password') }} <!--<a href="/sessions/forgot_password">(forgot password) </a>-->
							<input type="password" class="form-control" style="border-radius:0px" id="password" name="password" placeholder="Password">
						</div>
						<button type="submit" class="btn btn-sm btn-default">
							Login
						</button>
					{{ Form::close() }}
				</div>
				
				<p>
				{{ $errors->first('email') }}
				</p>
				<p>
					{{ $errors->first('password') }}
				</p>
			</div>
		</div>
	</div>
@stop
