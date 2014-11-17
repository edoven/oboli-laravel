@extends('layouts.master')

@section('title')
Password Reset
@stop


@section('content')
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
                                    <div class="contact-form col-sm-4 col-sm-offset-4">


	                    <h3>Reimposta la password</h3>
	                    @if (Session::has('error'))
							<div id="error">
								<h2>{{ trans(Session::get('error')) }}</h2>
							</div>
						@elseif (Session::has('success'))
							<div id="success">
								<h2>Password changed with success!</h2>
							</div>						
						@endif

						{{ Form::open(array('url' => 'password/reset')) }}
							<input type="hidden" name="token" value="{{ $token }}">
							<div class="form-group">
								<div class="controls">
									 <label class="control-label">Email</span></label>
									 <input type="text" id="email" name="email" class="field text form-control" >
								</div>
								<div class="controls">
									 <label class="control-label">Password</label>
									 <input type="password" id="password" name="password" class="field text form-control" >
								</div>
								<div class="controls">
									 <label class="control-label">Password Confirmation</span></label>
									 <input type="password" id="password_confirmation" name="password_confirmation" class="field text form-control">
							</div>		

							<div class="form-group btns-wrapper">
								<button type="submit" class="btn btn-sm btn-default">
									Reimposta la Password
								</button>
							</div>				
													
						{{ Form::close() }}

					
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
@stop
