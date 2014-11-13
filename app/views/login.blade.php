@extends('layouts.master')

@section('title')
Login
@stop


@section('content')
	<!-- site content -->
				<div class="container" id="page-info">
					<div class="row">
						<div class="col-xs-12">
							<!-- Checkout Section Start Here-->
							<section class="checkout anim-section">
								<div class="row">
									
									<!-- Checkout Tabbing Section Start Here-->
									<div class="tab-wrap col-sm-12">
										
										<!-- Tab panes -->
										<div class="tab-content">
										  <!-- Signin Section Start Here-->
										  <div class="tab-pane active" id="signin">
										  	<div class="row">
										  		
										  		<div class="col-sm-5" >
										  			<h4>Login con Facebook</h4>
										  			<div class="btns-wrapper">
														<a href="/login/fb" class="btn btn-default grouped">LOGIN WITH FACEBOOK </a>
													</div>	
										  		</div>
										  		
										  														
										  		<div class="contact-form col-sm-6 col-sm-offset-1">
										  			<h4>Login con e-mail</h4>
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
														@if (Session::has('errors'))
											  				<div class="form-group {{ $errors->has('email') ? 'error' : '' }}">
																<label for="name">email</label>
																<input type="text" name="email" class="form-control" id="email">
															</div>
															<div class="form-group {{ $errors->has('password') ? 'error' : '' }}">
																<label for="password">password</label>
																<input type="password" name="password" class="form-control" id="password">
															</div>		
														@else
															<div class="form-group">
																<label for="name">email</label>
																<input type="text" name="email" class="form-control" id="email">
															</div>
															<div class="form-group">
																<label for="password">password</label>
																<input type="password" name="password" class="form-control" id="password">
															</div>
														@endif
															<div class="form-group btns-wrapper">
																<button type="submit" class="btn btn-default btn-lg">login</button>
																<a href="/password/remind" class="pull-right frgt-pwd">Non ti ricordi la password?</a>
															</div>
										  			{{ Form::close() }}
										  		</div>

										  		
										  		
										  	</div>
										  </div>
										  <!-- Signin Section Ends Here-->
										</div>
			
										  </div>
										</div>
										</div>
									<!-- Checkout Tabbing Section Ends Here-->									
								</div>
							</section>
							<!-- Checkout Section End Here-->
						</div>
					</div>
				</div>

			</div>
			<!-- site content ends -->
@stop
