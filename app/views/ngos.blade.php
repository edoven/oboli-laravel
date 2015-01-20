@extends('layouts.master')

@section('title')
NGOs
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
			                            <div class="row choose-pricing">
			                                <div class="col-xs-12 col-sm-4 col-sm-offset-1">
			                                    <div class="btn-group">
			                                        <select id="donationAmount" name="amount" class="form-control">
			                                            @for ($i=1; $i<=Auth::user()->oboli_count; $i++)
															<option value="{{ $i }}">{{ $i }}</option>
														@endfor
			                                        </select>
			                                    </div>
			                                </div>
			                                <div class="col-xs-12 col-sm-5">
			                               		<button class="btn btn-default btn-donation" type="button" onclick="makeDonationFromSelect()">Dona</button>
			                                </div>
			                            </div>				
									</div>
									
									<!--
									<select id="donationAmount">
									 	@for ($i=1; $i<Auth::user()->oboli_count; $i++)
											<option value="{{ $i }}">{{ $i }}</option>
										@endfor
									</select>
									<button type="button" onclick="makeDonation()">Dona</button>
									-->
								</div>
							@endif
						@endif
					@endif
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>




		<!--
		<div class="modal fade" id="camaleonticDonateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
			@if (Auth::user()->oboli_count > 0)
				<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			        <h4 class="modal-title" id="modal-title">New message</h4>
			    </div>
			    <div class="modal-body row">
					<div class="col-xs-12">
						<div class="col-xs-12">
							<div class="row">
	                            <div class="col-xs-12 col-sm-10 col-sm-offset-1">
	                                {{ Form::open(array('url'=>'/donations/new', 'role'=>'form')) }}
										<input id="ngo-id" name="ngo_id" value="{{ $ngo->id }}" type="hidden">
										<div class="row">
			                                <div class="col-xs-12 col-sm-10 col-sm-offset-1">
			                                    <label>Seleziona il numero di oboli</label>
			                                </div>
			                            </div>
										<div class="row choose-pricing">
											<div class="col-xs-12 col-sm-4 col-sm-offset-1">
												<div class="btn-group"> 
													<select name="amount" class="form-control">
														@for ($i=1; $i<Auth::user()->oboli_count; $i++)
														  <option value="{{ $i }}">{{ $i }}</option>
														@endfor
													</select>
												</div>
											</div>
											<div class="col-xs-12 col-sm-5 ">
												<input value="DONA" class="btn btn-default btn-donation" type="submit">
											</div>
										</div>			
									{{ Form::close() }}
	                            </div>
	                        </div>		
						</div>
					</div>
				</div>
		   	@else
		   		<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			        <h4 class="modal-title">Non hai Oboli da donare</h4>
			    </div>
				<div class="modal-body">
		      	</div>
			@endif
		      <div class="modal-footer">        
		      </div>
		    </div>
		  </div>
		</div>
		-->
	@endif



	@if (!Auth::guest())
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
	                            <h3 id="ngoName">NGO NAME</h3>
	                            <p class="donation-detail">ti ringrazia per avergli donato <span id="donationAmountPost">OBOLI AMOUNT</span> oboli</p>
	                            <hr>
	                            <h4>Condividi la tua donazione su</h4>
	                            <div class="socials">
	                                <a id="fb-share-button" class="btn btn-default btn-social btn-lg btn-facebook" href="TO_SET" target="_blank"><i class="fa fa-facebook"></i>Facebook</a>
	                                <a id="twitter-share-button" target="_blank" href="TO_SET" class="btn btn-default btn-social btn-lg btn-twitter" url="URL" data-via="edoventurini" data-count="none"><i class="fa fa-twitter"></i>Twitter</a>
	                            </div>
	                            <div class="text-center">
	                            	(oppure <a href="/ngos">torna indietro</a>)
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
			</div><!-- /.modal-dialog -->
		</div>
	@endif
@stop



@section('scripts')
	@if (!Auth::guest())


		<!-- MAKE DONATION SCRIPT -->
		<script>
			//generic function
			function makeDonation(donationAmount)
			{
				var xmlhttp;
				if (window.XMLHttpRequest)
				{// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp=new XMLHttpRequest();
				}
				else
				{// code for IE6, IE5
					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange=function()
				{
					if (xmlhttp.readyState==4 )
					{
						var response = xmlhttp.responseText;
						console.log("response="+response);
						var data = JSON.parse(response);
						var ngoId = data.data.ngo_id;

						//change values of the ngo item
						document.getElementById("obolis-count-ngo"+ngoId).innerHTML=data.data.obolis_count;
						document.getElementById("donors-ngo"+ngoId).innerHTML=data.data.donors;

						//change values of the "donation confirmed" modal
						document.getElementById("ngoName").innerHTML=data.data.ngo_name;
						document.getElementById("donationAmountPost").innerHTML=data.data.amount;
						var twitter_link = "https://twitter.com/intent/tweet?hashtags=obolicoin,bastapoco&amp;original_referer=http://oboli.co.in&amp;text=Ho%20donato%20"+data.data.amount+"%20oboli%20a%20"+data.data.ngo_name+"%20su%20Oboli&amp;tw_p=tweetbutton&amp;url="+data.data.donation_url;
						document.getElementById("twitter-share-button").setAttribute("href", twitter_link);
						document.getElementById("fb-share-button").setAttribute("href", data.data.fb_sharing_link);
						$('#camaleonticDonateModal').modal('hide');
						$('#donation-confirmed-modal').modal('show');

					}
				}
				try
				{
				    xmlhttp.open("POST", "{{ Config::get('local-config')['https_host']}}/api/v1.0/donations/new", true);
				    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				    //read the ngoId from the input hidden tag in the modal
				    var ngoId = document.getElementById("ngo-id").getAttribute("value");
				    var queryString = "user_id={{ Auth::id() }}&token={{ Auth::user()->api_token }}&ngo_id="+ngoId+"&amount="+donationAmount;
				    console.log("queryString="+queryString);
					xmlhttp.send(queryString);
				}
				catch (e)
				{
				    console.log(e);
				}		
			}

			//make donation from select button
			function makeDonationFromSelect() 
			{
				var element = document.getElementById("donationAmount");
				var donationAmount = element.options[element.selectedIndex].value;
				makeDonation(donationAmount);
			}

			//make donation from min/median/max donation
			$('#oboli-selector').on('click', 'li', function()
			{
			    var donationAmount = $(this).data('value');
			    makeDonation(donationAmount);
			});
		</script>


		<!-- SCRIPT TO UPDATE FIELDS IN THE camaleonticDonateModal -->
		<script type="text/javascript">
		$('#camaleonticDonateModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var ngo_id = button.data('ngo-id')
		  var ngo_name = button.data('ngo-name') // Extract info from data-* attributes
		  var modal = $(this)
		  modal.find('.modal-body #ngo-id').attr("value", ngo_id)
		})
		</script>
	@endif
@stop