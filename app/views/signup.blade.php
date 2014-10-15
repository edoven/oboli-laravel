@extends('layouts.master1')

@section('title')
Signin
@stop


@section('content')
	<div class="container" style="margin-top:120px">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<a  href="login/fb" data-toggle="modal" role="button" class="text-center btn btn-tertiary btn-lg btn-rounded-edge"><i class="fa fa-facebook transparent"></i> Sign Up with Facebook</a>
					<p class="text-center" ><a href="signup/email">(or Sign Up with e-mail</a></p>
				</div>
			</div>
		</div>
	</div>
@stop
