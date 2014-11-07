@extends('layouts.master')

@section('title')
Accedi
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
										  			<h4>Registrati</h4>
										  			<div class="row">
											  			<div class="btns-wrapper col-sm-8">
											  				<a href="/login/fb" class="btn btn-block btn-social btn-lg btn-facebook">
																<i class="fa fa-facebook" />
																</i>ACCEDI CON FACEBOOK 
															</a>
														</div>	
													</div>
													<div class="row">
											  			<div class="btns-wrapper col-sm-8">
											  				<a href="/signup/email">
																(accedi tramite email) 
															</a>
														</div>	
													</div>
										  		</div>
										  		
										  														
										  		<div class="col-sm-6 col-sm-offset-1">
										  			<h2>Efettua il login</h2>
										  			<div class="row">
											  			<div class="btns-wrapper col-sm-8">
											  				<a href="/login/fb" class="btn btn-block btn-social btn-lg btn-facebook">
																<i class="fa fa-facebook" />
																</i>ACCEDI CON FACEBOOK 
															</a>
														</div>	
													</div>
													<div class="row">
											  			<h4>Oppure effettua il login con e-mail</h4>
														{{ Form::open(array('url' => 'login')) }}
											  				<div class="form-group">
																<label for="name">email</label>
																<input type="text" name="email" class="form-control" id="email">
															</div>
															<div class="form-group">
																<label for="password">password</label>
																<input type="password" name="password" class="form-control" id="password">
															</div>
															<div class="form-group btns-wrapper">
																<button type="submit" class="btn btn-default btn-lg">login</button>
																<a href="#" class="pull-right frgt-pwd">Non ti ricordi la password?</a>
															</div>
											  			{{ Form::close() }}	
													</div>


										  			
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
