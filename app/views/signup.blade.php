@extends('layouts.master')

@section('title')
Registrazione
@stop


@section('content')
<div id="main">
	<div class="container" >
	  	<div class="panel panel-primary panel-login col-sm-4 col-sm-offset-4">
			<div class="panel-heading">
				<h3 class="panel-title">REGISTRATI</h3>
			</div>
			<div class="panel-body">
				<a href="/login/fb" class="btn btn-block btn-social btn-lg btn-facebook"><i class="fa fa-facebook"></i>Registrati con Facebook</a>	                
	            <div class="row signup-separator">
	            	<!-- <div class="col-sm-4 col-lg-4 line"></div> -->
	            	oppure
	            	<!-- <div class="col-sm-4 col-lg-4 col-lg-offse-4 text">oppure</div> -->
	            	<!-- <div class="col-sm-4 col-lg-4 line"></div> -->
	            </div>
	  			 @if (Session::has('errors'))
	  			 	<div class="errors">
		  			 	<h3>Errori:</h3>
						<ul>
							@foreach (Session::get('errors')->toArray() as $error)
								<li>
									{{ $error[0] }}
								</li>
							@endforeach
						</ul>
					</div>
	            @endif   
	  			 {{ Form::open(array('url' => 'signup')) }}
					<div class="form-group {{ (Session::has('errors') && $errors->has('name')) ? 'error' : '' }}">
						<!--<label for="name">nome</label>-->
						 <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        	<input type="text" name="name" class="form-control" placeholder="nome" value="{{ Session::get('input')['name'] }}">
                        </div>
					</div>
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
						<button type="submit" class="btn btn-lg">Registrati</button>
					</div>
                {{ Form::close() }}
	            <div class="row signup-bottom">
	            	Hai già un account? <a href="/login"><strong>Effettua l'accesso!</strong></a>
	            </div>
			</div>
		</div>
	</div>
</div>

@stop
