@extends('layouts.master1')

@section('title')
Signin
@stop


@section('content')
	<div class="container" style="margin-top:120px">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						<strong>
							Sign Up
						</strong>
					</h3>
				</div>
				<div class="panel-body">
					{{ Form::open(array('url' => 'signup')) }}
						<div class="form-group">
							<div class="controls">
								 <label class="control-label">Name <span class="transparent-50">*</span></label>
								 <input type="text" id="name" name="name" class="field text form-control" placeholder="Name">
							</div>
						</div>
						<div class="form-group">
							<div class="controls">
								 <label class="control-label">Email <span class="transparent-50">*</span></label>
								 <input type="text" id="email" name="email" class="field text form-control" placeholder="Email">
							</div>
						</div>
						<div class="form-group">
							<div class="controls">
								 <label class="control-label">Password <span class="transparent-50">*</span></label>
								 <input type="password" id="password" name="password" class="field text form-control" placeholder="Password">
							</div>
						</div>
						<button type="submit" class="btn btn-sm btn-default">
							Signin
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
