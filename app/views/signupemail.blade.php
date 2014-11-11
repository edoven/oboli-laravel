@extends('layouts.master')

@section('title')
Signup
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
                                        <h3>Registrati</h3>
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
											@if (Session::has('errors'))
												<div class="form-group {{ $errors->has('name') ? 'error' : '' }}">
													<label for="name">nome</label>
													<input type="text" name="name" class="form-control" value="{{ Session::get('input')['name'] }}">
												</div>
												<div class="form-group {{ $errors->has('email') ? 'error' : '' }}">
													<label for="name">email</label>
													<input type="text" name="email" class="form-control" value="{{ Session::get('input')['email'] }}">
												</div>
												<div class="form-group {{ $errors->has('password') ? 'error' : '' }}">
													<label for="password">password</label>
													<input type="password" name="password" class="form-control">
												</div>
												<div class="form-group btns-wrapper">
													<button type="submit" class="btn btn-default btn-lg">Registrati</button>
													<a href="#" class="pull-right frgt-pwd">Non ti ricordi la password?</a>
												</div>
											@else
												<div class="form-group">
													<label for="name">nome</label>
													<input type="text" name="name" class="form-control">
												</div>
												<div class="form-group">
													<label for="name">email</label>
													<input type="text" name="email" class="form-control">
												</div>
												<div class="form-group">
													<label for="password">password</label>
													<input type="password" name="password" class="form-control">
												</div>
												<div class="form-group btns-wrapper">
													<button type="submit" class="btn btn-default btn-lg">Registrati</button>
													<a href="#" class="pull-right frgt-pwd">Non ti ricordi la password?</a>
												</div>
											@endif
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
<!-- site content ends -->


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
