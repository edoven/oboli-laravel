@extends('layouts.master')


@section('title')
{{ $ngo->name  }}
@stop


@section('content')
<div class="cause-page content-wrapper" id="page-info">
		<div class="container">
			<!-- our causes detail-->
			<div class="anim-section animate">
				<div class="row">
					<div class="col-xs-12 col-sm-9 left-block">
						<div class="article-list-large causes-description progressbar">
							<div class="anim-section animate">
								<div class="top-detail">
                                    <figure>
                                        <img src="{{ asset('img/web/ngos/large/'.$ngo->name_short.'.jpg') }}" alt="">
                                    </figure>
                                    <div class="progress">
                                        <div class="progress1">
                                            <div class="progress2">
                                                <div class="progress3">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="heading-sec text-left">
                                        <h3 class="h4">{{ $ngo->name }}</h3>
                                        <span class="date-desc">Anno di fondazione: 2005</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <span class="donation">
                                               <span id="obolisCount" class="value donated-icon">{{ $ngo->oboli_count }}</span>
                                            <span id="donors" class="value donors-icon">{{ $ngo->donors }}</span>
                                            </span>
                                            @if (Auth::guest())
												<a data-toggle="modal" href="#" data-target=".login-form" class="btn btn-default btn-donation pull-right">dona subito</a>
											@else
												<a data-toggle="modal" href="#" data-target="#donate-modal" class="btn btn-default btn-donation pull-right">dona subito</a>
											@endif
                                        </div>
                                    </div>
                                </div>
								<div class="detail-description">
									<p class="detail-summary">
										{{ $ngo->middle_description }}
									</p>
									<p>
										{{ $ngo->long_description }}
									</p>

									<ul class="list-trangled">
										<li>
											<a href="http://{{ $ngo->website }}" target="_blank">{{ $ngo->website }}</a>
										</li>
										<li>
											<a href="mailto:{{ $ngo->email }}">{{ $ngo->email }}</a>
										</li>
										<li>
											{{ $ngo->phone }}
										</li>
									</ul>

									@if (Auth::guest())
										<a data-toggle="modal" href="#" data-target=".login-form" class="btn btn-default btn-donation">dona subito</a>
									@else
										<a data-toggle="modal" href="#" data-target="#donate-modal" class="btn btn-default btn-donation">dona subito</a>
									@endif
								</div>
								<!--step donation-->
							</div>
						</div>

						<div class="row article-list progressbar bottom-bar related-items">
						    <header class="col-xs-12 block-title">
						        <h3>Cause e progetti nella stessa categoria</h3>
						    </header>
						    @foreach ($same_area_ngos as $same_area_ngo)
							    <div class="col-xs-12 col-sm-4 zoom anim-section animate">
							        <div class="related-item">
							            <a href="/ngos/{{ $same_area_ngo->name_short }}" class="img-thumb">
							                <figure>
							                    <img src="{{ asset('img/web/ngos/xs/'.$same_area_ngo->name_short.'.jpg') }}" alt="">
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
							            <span class="donation">{{ $same_area_ngo->name }}</span>
										<p>
											{{ $same_area_ngo->short_description }}
										</p>
							        </div>
							    </div>
							@endforeach
						</div>
					</div>

					<div class="col-xs-12 col-sm-3 left-block ">
						<aside class="media">
							<h3 class="space-top">Donazioni più recenti</h3>
							<ul>
								@foreach ($recent_ngos as $recent_ngo)
									<li>
										<div class="recent-ngo">
											<a href="/ngos/{{ $recent_ngo->name_short }}">
												<figure>
													<div class="overlay"></div>
													<img src="{{ asset('img/web/ngos/xs/'.$recent_ngo->name_short.'.jpg') }}" alt="">
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
											<p class="name">{{ $recent_ngo->name }}</p>
										</div>
									</li>
								@endforeach
							</ul>
						</aside>

						<!-- Categories  -->
						<aside class="media">
							<h3>Categorie</h3>
							<ul class="archives">
								<li>
									<a href="/ngos?category=women">
										<img src="{{ asset('img/web/areas/icons/women.png') }}" alt=""> Donne <span class="pull-right">(2)</span>
									</a>
								</li>
								<li>
									<a href="/ngos?category=children">
										<img src="{{ asset('img/web/areas/icons/children.png') }}" alt=""> Bambini <span class="pull-right">(2)</span>
									</a>
								</li>
								<li>
									<a href="/ngos?category=environment">
										<img src="{{ asset('img/web/areas/icons/environment.png') }}" alt=""> Ambiente <span class="pull-right">(5)</span>
									</a>
								</li>
								<li>
									<a href="/ngos?category=health">
										<img src="{{ asset('img/web/areas/icons/health.png') }}" alt=""> Salute <span class="pull-right">(2)</span>
									</a>
								</li>
								<li>
									<a href="/ngos?category=humrights">
										<img src="{{ asset('img/web/areas/icons/humrights.png') }}" alt=""> Diritti Umani <span class="pull-right">(4)</span>
									</a>
								</li>
								<li>
									<a href="/ngos?category=development">
										<img src="{{ asset('img/web/areas/icons/development.png') }}" alt=""> Sviluppo <span class="pull-right">(3)</span>
									</a>
								</li>
							</ul>
						</aside>
					</div>
				</div>
			</div>
			<!-- our causes detail-->
		</div>
	</div>
@stop


@section('modals')
	<!-- DONATION MODAL -->
	<div class="modal fade" id="donate-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
	                            	<a id="fb-share-button" class="btn btn-default btn-social btn-lg btn-facebook" href="https://oboli.co.in"><i class="fa fa-facebook"></i>Facebook</a>
	                                <!-- <button id="facebook-share-button" class="btn btn-default btn-social btn-lg btn-facebook" href="www.ciao.it"><i class="fa fa-facebook"></i>Facebook</button> -->
	                                <!-- <a id="twitter-share-button" href="https://twitter.com/share" class="btn btn-default btn-social btn-lg btn-twitter" data-url="URL" data-via="getoboli" data-count="none" data-hashtags="oboli" target="_blank"><i class="fa fa-twitter"></i>Twitter</a> -->   
	                                <a href="https://twitter.com/share" id="twitter-share-button" class="twitter-share-button" data-url="http://prova.it" data-text="Fai del bene con Oboli!" data-via="getoboli" data-count="none">Tweet</a>
	                            

	                               


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
						document.getElementById("obolisCount").innerHTML=data.data.obolis_count;
						document.getElementById("donors").innerHTML=data.data.donors;
						document.getElementById("ngoName").innerHTML=data.data.ngo_name;
						document.getElementById("donationAmountPost").innerHTML=data.data.amount;
						document.getElementById("twitter-share-button").setAttribute("data-url", data.data.donation_url);
						document.getElementById("fb-share-button").setAttribute("href", "https://www.facebook.com/sharer/sharer.php?app_id=359422247568866&u="+data.data.donation_url+"&display=popup&ref=plugin");
						$('#donate-modal').modal('hide');
						$('#donation-confirmed-modal').modal('show');

					}
				}
				try
				{
				    xmlhttp.open("POST", "{{ Config::get('local-config')['https_host']}}/api/v1.0/donations/new", true);
				    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				    var queryString = "user_id={{ Auth::id() }}&token={{ Auth::user()->api_token }}&ngo_id={{ $ngo->id }}&amount="+donationAmount;
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
	@endif



	<!-- TWITTER SHARING BUTTON SCRIPT -->

	<!-- <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script> -->
@stop