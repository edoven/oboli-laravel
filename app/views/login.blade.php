@extends('layouts.master1')

@section('title')
Login
@stop


@section('content')
	<div class="container" style="margin-top:120px">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				
				<div >
					<h3>
						<a href="login/fb" class="btn btn-block btn-lg btn-social btn-facebook">
							<i class="fa fa-facebook"></i> Log in with Facebook
						</a>
					</h3>
				</div>
				
				
				
				<div class="panel-heading">
					<h3 class="panel-title">
						<strong>
							Login with Email
						</strong>
					</h3>
				</div>
				<div class="panel-body">
					{{ Form::open(array('url' => 'login')) }}
						<div class="form-group">
							<div class="controls">
								 <label class="control-label">Email <span class="transparent-50"></span></label>
								 <input type="text" id="email" name="email" class="field text form-control" placeholder="Email">
							</div>
						</div>
						<div class="form-group">
							<div class="controls">
								 <label class="control-label">Password <span class="transparent-50"></span></label>
								 <input type="password" id="password" name="password" class="field text form-control" placeholder="Password">
							</div>
						</div>
						
						<button type="submit" class="btn btn-sm btn-default">
							Log In
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
