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
                                        <h2 class="title">Entra in Oboli</h2>
                                        <hr>
										<div class="form-group btns-wrapper">
											<a href="/login" class="btn btn-register">Accedi</a>
										</div>
                                        <div class="form-group btns-wrapper">
											<a href="/signup/email" class="btn btn-register">Crea un nuovo account</a>
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
