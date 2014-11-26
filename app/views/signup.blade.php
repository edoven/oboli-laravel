@extends('layouts.access')

@section('title')
Signup
@stop


@section('content')
<!-- site content -->
<div class="container signup-container" id="page-info">
    <div class="row">
        <div class="col-xs-12">
            <!-- Checkout Section Start Here-->
            <section class="checkout anim-section">
            	<div class="row signup-logo">
            		<img src="{{ asset('img/web/signup-logo.png') }}" />
            	</div>
                <div class="row">
                    <!-- Checkout Tabbing Section Start Here-->
                    <div class="tab-wrap col-sm-12">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <!-- Signin Section Start Here-->
                            <div class="tab-pane active" id="signin">
                                <div class="row">
                                    <div class="col-sm-4 col-sm-offset-4 signup-form ">
                                        <h2 class="title">Registrati</h2>
                                        <hr>
                                        <a class="btn btn-block btn-social btn-lg btn-facebook"><i class="fa fa-facebook"></i>Accedi tramite facebook</a>
                                        
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
												<button type="submit" class="btn btn-register">Accedi</button>
											</div>
                                        {{ Form::close() }}
                                        <div class="row signup-bottom">
                                        	Hai già un account? <a href="/login"><strong>Effettua l'accesso!</strong></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Signin Section Ends Here-->
                        </div>
                    </div>
                </div>
			</section>
        <!-- Checkout Tabbing Section Ends Here-->									
		</div>
    <!-- Checkout Section End Here-->
	</div>






 
       

               
               
                
     </div> 
</div>



<!-- 
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
	</div>  -->
@stop
