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
                                    <div class="contact-form col-sm-4 col-sm-offset-4">
                                        <a href="/signup" class="btn btn-default btn-lg">Crea un nuovo account</a>
                                        <div>
                                        	Hai gia un account? <a href="/login"> Effettua il login.</a>
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
<!-- site content ends -->


@stop
