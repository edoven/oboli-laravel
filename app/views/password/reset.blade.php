@extends('layouts.master')

@section('title')
Password Reset
@stop


@section('content')
<div id="main">
	<div class="container" >
	  	<div class="panel panel-primary panel-login col-sm-4 col-sm-offset-4">
			<div class="panel-heading">
				<h3 class="panel-title">Crea una nuova password</h3>
			</div>
			<div class="panel-body">  
				@if (Session::has('error'))
                    <ul>
                        <li class="error">
                            {{ trans(Session::get('error')) }}
                        </li>
                    </ul>
                @endif
	  			{{ Form::open(array('url' => 'password/reset')) }}	
	  				<input type="hidden" name="token" value="{{ $token }}">
	  				<div class="form-group {{ (Session::has('errors') && $errors->has('email')) ? 'error' : '' }}">
						<div class="input-group">
	                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
	                    	<input type="text" name="email" class="form-control" placeholder="email" value="{{ Session::get('input')['email'] }}"> 
	                    </div>
					</div>
					<div class="form-group {{ (Session::has('errors') && $errors->has('password')) ? 'error' : '' }}">
						<div class="input-group">
	                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	                    	<input type="password" name="password" class="form-control" placeholder="password">
	                    </div>
					</div>
					<div class="form-group {{ (Session::has('errors') && $errors->has('password')) ? 'error' : '' }}">
						<div class="input-group">
	                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	                    	<input type="password" name="password_confirmation" class="form-control" placeholder="ripeti la password">
	                    </div>
					</div>
					<div class="form-group btns-wrapper">
						<button type="submit" class="btn btn-register">Reimposta la Password</button>
					</div>										
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>
@stop

