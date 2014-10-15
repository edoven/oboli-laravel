@extends('layouts.master1')

@section('title')
Signin
@stop


@section('content')
<div class="container" style="margin-top:120px">
	<div class="col-md-4 col-md-offset-4">
		<div class="panel panel-default">			
			<div class="panel-heading">	
				<h2>Sign In</h2> 	
				<h3>(it only takes a few seconds)</h3> 				
				<a href="login/fb" class="btn btn-block btn-lg btn-social btn-facebook">
					<i class="fa fa-facebook"></i> Sign in with Facebook
				</a>
				<p class="text-center" >
					(or <a href="signup/email">Sign Up with e-mail</a>)
				</p>
			</div>					
		</div>
	</div>
</div>
@stop
