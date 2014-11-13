

@extends('layouts.master')

@section('title')
Password dimenticata?
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
                                    <div class="contact-form col-sm-4 col-sm-offset-4">  
                                        @if (Session::has('success'))
											<h3>Successo!</h3>
											<h3>Ti abbiamo inviato una email per recuperare la password.</h3>
                                        @else  
                                        	<h3>Hai dimenticato la password?</h3>                                   
	                                        @if (Session::has('error'))
												<ul>
													<li class="error">
														{{ trans(Session::get('error')) }}
													</li>
												</ul>
	                                        @endif
                                                                        
	                                        {{ Form::open(array('url' => 'password/remind')) }}										
												<div class="form-group">
													<label for="name">email</label>
													<input type="text" name="email" class="form-control">
												</div>
												<div class="form-group btns-wrapper">
													<button type="submit" class="btn btn-default btn-lg">Inviami una nuova password</button>
												</div>
	                                        {{ Form::close() }}
	                                    @endif
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
<!-- site content ends -->
@stop
