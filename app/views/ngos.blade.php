@extends('layouts.master')

@section('title')
Cause e Progetti
@stop


@section('content')	
<div class="content-wrapper cause-page-section" id="page-info">
	<div class="container">
		<section class="our-story row anim-section animate">
			<div class="col-xs-12">
				<header class="page-header section-header top-spacer">
					<h2>Dona i tuoi Oboli. &Egrave; facile e <strong>gratuito</strong></h2>
				</header>
			</div>
		</section>

		<!-- Our Causes Section-->
		<section class="our-causes">
			<div class="anim-section animate">
				<div class="row">	
					<div class="article-list progressbar">
						@foreach ($ngos as $ngo)
							<div class="cols-xs-12 col-sm-6 col-md-4 anim-section animate">
								<!--<div style="height: 550px;" class="spacer-bottom zoom equal-box">-->
								<div class="spacer-bottom equal-box">
									<a href="/ngos/{{ $ngo->name_short }}" class="img-thumb zoom">
										<figure>
											<img draggable="false" src="{{ asset('img/web/ngos/small/'.$ngo->name_short.'.jpg') }}" alt="">
										</figure>
									</a>
									<div class="progress">
										<div class="progress1">
											<div class="progress2">
												<div class="progress3">
												</div>
											</div>
										</div>	
									</div>
									<div class="details">
										<div class="title-container">
											<a href="/ngos/{{ $ngo->name_short }}">
												<h3 class="h6">{{ $ngo->name }}</h3>
											</a>
										</div>
										<span class="donation">
											<img class="metric-icon" src="{{ asset('img/web/donated.png') }}" /> <span class="value" id="obolis-count-ngo{{$ngo->id}}">{{ $ngo->oboli_count }}</span>
											<img class="metric-icon" src="{{ asset('img/web/donors.png') }}" /> <span class="value" id="donors-ngo{{$ngo->id}}">{{ $ngo->donors }}</span>
										</span>
										<div class="ngo-description">
											<p>
												{{ $ngo->middle_description }}
											</p>
										</div>
									</div>
									<div class="row">
										<div class="btn col-xm-12 col-sm-6">
											<a href="/ngos/{{ $ngo->name_short }}" class="btn btn-default btn-donation btn-block inverted">dettagli</a>
										</div>
										<div class="btn col-xm-12 col-sm-6">
											@if (Auth::guest())
												<a data-toggle="modal" href="#" data-target=".login-form" class="btn btn-default btn-donation btn-block">dona subito</a>
											@else
												<a data-toggle="modal" href="#" data-target="#camaleonticDonateModal" data-ngo-name="{{ $ngo->name }}" data-ngo-id="{{ $ngo->id }}" class="btn btn-default btn-donation btn-block">dona subito</a>
											@endif
										</div>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</section>
		<!-- Our Causes Section End-->
	</div>

</div>
@stop




@section('modals')
	@if (!Auth::guest())
		<!-- DONATION MODAL -->
		<div class="modal fade" id="camaleonticDonateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					@if (!Auth::guest())
						@if (Auth::user()->confirmed == 0)	
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
									×
								</button>
								<header class="page-header">
									<h2>Un ultimo sforzo prima di poter donare</h2>
								</header>
							</div>
							<div class="modal-body">
								<div class="col-xs-12">
									<p>Devi confermare il tuo account per poter donare. Controlla l'email che ti abbiamo inviato.</p>
								</div>
							</div>
						@else
							@if (Auth::user()->oboli_count<1)
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										×
									</button>
									<header class="page-header">
										<h2>Non possiedi Oboli</h2>
									</header>
								</div>
								<div class="modal-body">
									<div class="col-xs-12">
										<p>Scopri come ottenerli visitando la pagina con le aziende convenzionate con Oboli.</p>
									</div>
								</div>
							@else
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										×
									</button>
									<header class="page-header">
										<h2>Effettua una donazione</h2>
									</header>
								</div>
								<div class="modal-body row">

									<input id="ngo-id" value="{{ $ngo->id }}" type="hidden">
									<div class="col-xs-12">
										<div class="row">
			                                <div class="col-xs-12 col-sm-10 col-sm-offset-1">
			                                    <label>Seleziona il numero di oboli</label>
			                                   	@if (Auth::user()->oboli_count >=3)
				                                    <ul class="oboli-selector" id="oboli-selector">
				                                        <li data-value="1">1</li>
				                                        <li data-value="{{ (Auth::user()->oboli_count-(Auth::user()->oboli_count % 2)) / 2 }}">{{ (Auth::user()->oboli_count-(Auth::user()->oboli_count % 2)) / 2 }}</li>
				                                        <li data-value="{{ Auth::user()->oboli_count }}">{{ Auth::user()->oboli_count }}</li>
				                                    </ul>
				                                @endif
			                                </div>
			                            </div>

			                            <div class="row">
			                                <div class="col-xs-12 col-sm-10 col-sm-offset-1">
			                                    <label>oppure scegli tu quanti oboli donare</label>
			                                </div>
			                            </div>
			                        </div>
			                       	<div class="col-xs-12">
			                            <div class="row choose-pricing">
			                            	{{ Form::open(array('url'=>'/donations/new')) }}
				                            	<input id="ngo-id" type="hidden" name="ngo_id" value="TO_SET">
				                            	<input type="hidden" name="origin" value="ngos" >
				                                <div class="col-xs-12 col-sm-4 col-sm-offset-1">
				                                    <div class="btn-group">
				                                        <select name="amount" class="form-control" id="amount">
				                                            @for ($i=1; $i<=Auth::user()->oboli_count; $i++)
																<option value="{{ $i }}">{{ $i }}</option>
															@endfor
				                                        </select>
				                                    </div>
				                                </div>
				                                <div class="col-xs-12 col-sm-5">
				                                	<input class="btn btn-default btn-donation"type="submit" value="Dona">
				                                </div>
			                                {{ Form::close() }}
			                            </div>				
									</div>

								</div>
							@endif
						@endif
					@endif
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>


		@if (Session::has('new_donation'))
			<!-- DONATION-CONFIRMED MODAL -->
			<div aria-hidden="true" style="display: none;" class="modal" id="donation-confirmed-modal">
				<div class="modal-dialog">
					<div class="modal-content">
		                <div class="modal-header">
		                    <header class="page-header">
		                        <h2>Grazie</h2>
		                    </header>
		                </div>
		                <div class="modal-body">
		                    <div class="row">
		                        <div class="col-xs-12">
		                            <h3>{{ Session::get('ngo_name') }}</h3>
		                            <p class="donation-detail">ti ringrazia per avergli donato <span id="donationAmountPost">{{ Session::get('amount') }}</span> oboli</p>
		                            <hr>
		                            <h4>Condividi la tua donazione su</h4>
		                            <div class="socials">
		                            	<a href="{{ Session::get('fb_sharing_link') }}" class="btn btn-default btn-social btn-lg btn-facebook"  target="_blank"><i class="fa fa-facebook"></i>Facebook</a>    
		                                <a href="https://twitter.com/intent/tweet?hashtags=obolicoin,bastapoco&text=Ho%20appena%20donato%20{{ Session::get('amount') }}%20oboli%20a%20{{ Session::get('ngo_name') }}&tw_p=tweetbutton&url={{ Session::get('donation_url') }}" class="btn btn-default btn-social btn-lg btn-twitter twitter-share-button" target="_blank" ><i class="fa fa-twitter"></i>Twitter</a>
		                            </div>
		                            <div class="text-center">
		                            	<br />
		                            	(<a href="javascript: void(0)" id="button">no, grazie</a>)
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
				</div><!-- /.modal-dialog -->
			</div>
		@endif

	@endif
@stop



@section('scripts')
	@if (!Auth::guest())

		//to use min/median/max buttons to change select value
		<script type="text/javascript">
			$('#oboli-selector').on('click', 'li', function()
			{
			    var donationAmount = $(this).data('value');
			    $("#amount").val(donationAmount);
			});
		</script>


		@if (Session::has('new_donation'))

			<!-- DONATION CONFIRMED MODAL activator -->
			<script type="text/javascript">
			    $(window).load(function(){
			        $('#donation-confirmed-modal').modal('show');
			    });
			</script>

			<!-- DONATION CONFIRMED MODAL dismiss button 'no, grazie' -->
			<script type="text/javascript">
			   $(function(){
				    $("#button").bind("click",function(){
				        $('#donation-confirmed-modal').modal('hide');
				    });
				});
			</script>
			

			{{ Session::forget('new_donation') }}
			{{ Session::forget('ngo_amount') }}
			{{ Session::forget('amount') }}
			{{ Session::forget('donation_url') }}
			{{ Session::forget('fb_sharing_link') }}
		@endif



		<!-- SCRIPT TO UPDATE FIELDS IN THE camaleonticDonateModal -->
		<script type="text/javascript">
		$('#camaleonticDonateModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget); // Button that triggered the modal
		  var ngo_id = button.data('ngo-id');
		  var ngo_name = button.data('ngo-name'); // Extract info from data-* attributes
		  var modal = $(this);
		  modal.find('.modal-body #ngo-id').attr("value", ngo_id);
		})
		</script>
	@endif
@stop
