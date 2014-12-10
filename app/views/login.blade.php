@extends('layouts.master')

@section('title')
Login
@stop


@section('content')
<div id="main">
	<div class="container" >
	  	<div class="panel panel-primary panel-login col-sm-4 col-sm-offset-4">
			<div class="panel-heading">
				<h3 class="panel-title">EFFETTUA L'ACCESSO</h3>
			</div>
			<div class="panel-body">
				<a href="/login/fb" class="btn btn-block btn-social btn-lg btn-facebook"><i class="fa fa-facebook"></i>Login con Facebook</a>	                
	            <div class="row signup-separator">
	            	<!-- <div class="col-sm-4 col-lg-4 line"></div> -->
	            	oppure
	            	<!-- <div class="col-sm-4 col-lg-4 col-lg-offse-4 text">oppure</div> -->
	            	<!-- <div class="col-sm-4 col-lg-4 line"></div> -->
	            </div>
	  			 @if (Session::has('errors'))
					<ul>
						@foreach (Session::get('errors')->toArray() as $error)
							<li class="error">
								{{ $error[0] }}
							</li>
						@endforeach
					</ul>
	            @endif   
	  			{{ Form::open(array('url' => 'login')) }}
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
					<div class="form-group btns-wrapper">
						<button type="submit" class="btn btn-register">Accedi</button>
						<a data-toggle="modal" href="#" data-target=".login-form" class="btn btn-default pull-right">Dona subito</a>
					</div>
	            {{ Form::close() }}
	            <div class="row signup-bottom">
	            	<a href="/password/remind"><strong>Hai dimenticato i dati di accesso?</strong></a><br>
	            	Non hai ancora un account? <a href="/signup"><strong>Registrati!</strong></a>
	            </div>
			</div>
		</div>
	</div>
</div>
@stop



<div aria-hidden="true" style="display: true;" class="modal login-form" id="login-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					×
				</button>
				<header class="page-header">
					<h2>Login</h2>
				</header>
			</div>
			<div class="modal-body">
				<div class="col-xs-12">
					<div class="panel panel-primary panel-login col-sm-12">
						<div class="panel-heading">
							<h3 class="panel-title">EFFETTUA L'ACCESSO</h3>
						</div>
						<div class="panel-body">
							<a href="/login/fb" class="btn btn-block btn-social btn-lg btn-facebook"><i class="fa fa-facebook"></i>Login con Facebook</a>	                
				            <div class="row signup-separator">
				            	<!-- <div class="col-sm-4 col-lg-4 line"></div> -->
				            	oppure
				            	<!-- <div class="col-sm-4 col-lg-4 col-lg-offse-4 text">oppure</div> -->
				            	<!-- <div class="col-sm-4 col-lg-4 line"></div> -->
				            </div>
				  			 @if (Session::has('errors'))
								<ul>
									@foreach (Session::get('errors')->toArray() as $error)
										<li class="error">
											{{ $error[0] }}
										</li>
									@endforeach
								</ul>
				            @endif   
				  			{{ Form::open(array('url' => 'login')) }}
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
								<div class="form-group btns-wrapper">
									<button type="submit" class="btn btn-register">Accedi</button>
									<a data-toggle="modal" href="#" data-target=".login-form" class="btn btn-default pull-right">Dona subito</a>
								</div>
				            {{ Form::close() }}
				            <div class="row signup-bottom">
				            	<a href="/password/remind"><strong>Hai dimenticato i dati di accesso?</strong></a><br>
				            	Non hai ancora un account? <a href="/signup"><strong>Registrati!</strong></a>
				            </div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>


@section('scripts')
	@if (Session::has('errors'))
		<script type="text/javascript">
		    $(window).load(function(){
		        $('#login-modal').modal('show');
		    });
		</script>
	@endif
@stop