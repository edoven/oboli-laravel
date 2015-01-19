@extends('layouts.master')

@section('title')
Home
@stop

@section('content')





<div id="main">
	            <!-- banner slider Start Here -->
            <section class="rev_slider_wrapper banner-section">
                <div class="rev_slider banner-slider">
                    <ul>
                        <!-- SLIDE  -->
                        <li data-transition="fade" data-slotamount="7" data-masterspeed="500" class="slide-1">
                            <!-- MAIN IMAGE -->
                            <img src="img/web/slide-01.jpg" alt="banner" data-bgfit="cover" data-bgposition="center 36%" data-bgrepeat="no-repeat">
                            <div style="min-height: 0px;
									min-width: 0px;
									white-space: nowrap;
									line-height: 22px;
									border-width: 0px;
									margin: 0px;
									padding: 0px;
									font-size: 14px;
									visibility: visible;
									opacity: 0;
									top: 100px;
									left: 382px;
									transform: none;
									font-color: white;"
                                 data-endspeed="800"
                                 data-easing="easeOutCirc"
                                 data-start="800"
                                 data-speed="700"
                                 data-y="150"
                                 data-x="152"
                                 class="tp-caption sft banner-heading start">
                                <h2>
                                    <strong>Aiutare gli altri?</strong>
                                    Con Oboli è semplice <br /> e gratuito
                                </h2>
                            </div>
                            <div data-endspeed="800"
                                 data-easing="easeOutCirc"
                                 data-start="1200"
                                 data-speed="700"
                                 data-y="316"
                                 data-x="152"
                                 class="tp-caption sft">
                                <a href="#howitworks-home" class="btn btn-default btn-slider">Scopri come</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>
            <!-- banner slider End Here -->
            <!-- How does it work Section Start Here-->
            <section class="container services text-center">
                <div class="row">
                    <div class="col-xs-12">
                        <header class="service-header section-header">
                            <a name="howitworks-home"></a>
                            <div class="page-header section-header clearfix">
                                <h2>Scopri come funziona. <strong style="border: none;">Leggi qui sotto</strong></h2>
                            </div>
                        </header>
                        <div class="row">
                            <div class="col-xs-12 col-sm-4 zoom">
                                <img src="img/web/howto1.png" alt="">
                                <h2 class="h2">Oboli è una <br \><span class="howto-orange">moneta</span> virtuale</h2>
                                <hr class="howto">
                                <p>
                                    1000 Oboli = 1 Euro. <br /> Oboli è la moneta virtuale che ti pemette di creare un mondo migliore in maniera semplice e <strong>gratuita</strong>.
                                </p>
                            </div>
                            <div class="col-xs-12 col-sm-4 zoom ">
                                <img src="img/web/howto2.png" alt="">
                                <h2 class="h2">Come <span class="howto-orange">ottenere</span><br \>gli Oboli</h2>
                                <hr class="howto">
                                <p>
                                    Puoi ottenere gli Oboli acquistando i prodotti convenzionati. Puoi ottenere ad esempio 100 oboli comprando una bevanda o 200 oboli acquistando un bagnoschiuma.
                                </p>
                            </div>
                            <div class="col-xs-12 col-sm-4 zoom">
                                <img src="img/web/howto3.png" alt="">
                                <h2 class="h2"><span class="howto-orange">Dona</span><br \> i tuoi Oboli</h2>
                                <hr class="howto">
                                <p>
                                    Dona i tuoi oboli a ONG, associazioni con finalità sociali e progetti umanitari.<br>E' facile e <strong>non ti costa nulla</strong>.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- How does it work Section End Here-->
	<!-- Out Causes Section Starts Here-->
	<section class="our-causes">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="page-header section-header clearfix">
						<h2>Dona i tuoi Oboli. &Egrave; facile e <strong style="border: none;">gratuito</strong></h2>
					</div>
					<div class="article-list flexslider article-slider progressbar">
						<div style="overflow: hidden; position: relative;" class="flex-viewport">
							<ul style="width: 1800%; margin-left: -2340px;" class="slides">
								<?php 
									$ngos = Ngo::all(); 
									$ngos->shuffle();
									?>
								@for ($i = 0; $i<count($ngos); $i++)
									<?php $ngo = $ngos[$i]; ?>
									<li style="width: 360px; float: left; display: block;">
										<div class="items">
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
												<div class="btn col-xs-12 col-sm-6">
													<a href="/ngos/{{ $ngo->name_short }}" class="btn btn-default btn-donation inverted btn-block">dettagli</a>
												</div>
												<div class="btn col-xs-12 col-sm-6">
													@if (Auth::guest())
														<a data-toggle="modal" href="#" data-target=".login-form" class="btn btn-default btn-donation btn-block">dona subito</a>
													@else
														<a data-toggle="modal" href="#" data-target="#camaleonticDonateModal" data-ngo-name="{{ $ngo->name }}" data-ngo-id="{{ $ngo->id }}" class="btn btn-default btn-donation btn-block">dona subito</a>
													@endif
												</div>
											</div>
										</div>
									</li>
								@endfor
							</ul>
						</div>
						<ul class="flex-direction-nav">
							<li><a class="flex-prev" href="#">Previous</a></li>
							<li><a tabindex="-1" class="flex-next flex-disabled" href="#">Next</a></li>
						</ul>
					</div>
					<div class="show-all-btn">
						<a href="/ngos" class="btn btn-default btn-lg">MOSTRA TUTTI I PROGETTI</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Our Causes Section End Here-->
	<section style="background-position: center -71.4px;" class="parallax-section parallax">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-7 col-md-5">
					<h2>Sei un'azienda o una ONG? <strong >Contattaci</strong></h2>
					<p>
						Scrivici se il progetto ti interessa, se vuoi inserire gli Oboli nei tuoi prodotti o se vuoi entrare a far parte delle ONG alle quali &egrave; possibile donare.
					</p>
					<a href="mailto:info@getoboli.com" class="btn btn-default">Contattaci</a>
				</div>
			</div>
		</div>
	</section>

	<section class="how-to-help">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 ">
					<header class="page-header section-header">
						<h2>Come puoi <strong style="border: none;">contribuire</strong>?</h2>
					</header>
					<div class="row help-list">
						<div class="col-xs-12 col-sm-7 col-lg-6">
							<article class="media">
								<a class="pull-left warning-icon-box" href="our-story.html"><i class="icon-user"></i></a>
								<div class="media-body less-width">
									<h3 class="media-heading">Scegli</h3>
									<p>
										Scegli i prodotti che contengono gli Oboli per fare del bene in maniera semplice e gratuita.
									</p>
								</div>
							</article>
							<article class="media">
								<a class="pull-left warning-icon-box" href="volunteer.html"><i class="icon-volume"></i></a>
								<div class="media-body less-width">
									<h3 class="media-heading">Diffondi</h3>
									<p>
										Parla del progetto Oboli con i tuoi amici o sui social media. Conosci qualche azienda o associazione che potrebbe essere interessata? Faccelo sapere.
									</p>
								</div>
							</article>
							<article class="media">
								<a class="pull-left warning-icon-box" href="external.html" data-toggle="modal" data-target=".donate-form"><i class="icon-heart"></i></a>
								<div class="media-body less-width">
									<h3 class="media-heading">Contattaci</h3>
									<p>
										Contattaci e raccontaci cosa ne pensi del progetto Oboli. Contiamo anche sul tuo aiuto per migliorare ogni giorno!
									</p>
								</div>
							</article>
						</div>



						<div class="col-xs-12 col-sm-5 col-lg-5 col-lg-offset-1">
							<div class="volunteer-reward">
								<div class="reward-apply">
									<header class="page-header">
										<strong class="get-involved">FAI UN DONO <span>UTILE</span> </strong>
										<span class="svg-shape user-svg-shape"> <svg class="svg replaced-svg" xml:space="preserve" enable-background="new 0 0 72 72" viewBox="0 0 72 72" height="72px" width="72px" y="0px" x="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" id="Layer_1" version="1.1">
<g>
<g>
	<path d="M36.083,45.154c-9.49,0-16.428-17.231-16.428-26.2c0-9.059,7.369-16.428,16.428-16.428    c9.058,0,16.428,7.369,16.428,16.428C52.511,27.922,45.573,45.154,36.083,45.154z M36.083,6.526    c-6.853,0-12.428,5.575-12.428,12.428c0,7.764,6.388,22.2,12.428,22.2c6.039,0,12.428-14.437,12.428-22.2    C48.511,12.101,42.936,6.526,36.083,6.526z"></path>
</g>
<g>
	<g>
		<path d="M27.688,20.425c-0.553,0-1-0.447-1-1c0-5.499,4.474-9.973,9.973-9.973c0.552,0,1,0.448,1,1c0,0.553-0.448,1-1,1     c-4.396,0-7.973,3.577-7.973,7.973C28.688,19.978,28.24,20.425,27.688,20.425z"></path>
	</g>
	<g>
		<path d="M28.039,24.264c-0.27,0-0.52-0.1-0.71-0.29c-0.189-0.189-0.29-0.45-0.29-0.71s0.101-0.52,0.29-0.71     c0.37-0.37,1.04-0.37,1.41,0c0.19,0.19,0.3,0.45,0.3,0.71c0,0.271-0.109,0.521-0.3,0.71C28.56,24.165,28.3,24.264,28.039,24.264z     "></path>
	</g>
</g>
<g>
	<path d="M36,69.475c-5.649,0-24.083-0.577-24.083-8c0-10.635,7.018-20.227,17.066-23.326l1.225-0.378l0.855,0.955    c3.062,3.42,6.725,3.581,10.01-0.066l0.861-0.956l1.227,0.387c9.963,3.144,16.922,12.76,16.922,23.385    C60.083,68.898,41.649,69.475,36,69.475z M29.028,42.36c-7.777,2.934-13.111,10.625-13.111,19.115c0,1.102,6.175,4,20.083,4    c13.907,0,20.083-2.898,20.083-4c0-8.486-5.283-16.199-12.986-19.17c-2.141,2-4.544,3.049-7.014,3.049    C33.555,45.354,31.139,44.324,29.028,42.36z"></path>
</g>
</g>
</svg> </span>
										<h2>Da oggi puoi regalare la Oboli Card contentente quanti Oboli vuoi</h2>
									</header>
									<p>
										Fai un regalo speciale ad una persona speciale e offrile la possibilità di migliorare il mondo attraverso un piccolo gesto.
										Sei un'azienda? Contattaci per scroprire tutti i vantagi di regalare la Oboli Card.
									</p>
									<a href="/giftcard" class="btn btn-default" title="Apply Today">Scopri come funziona</a>
								</div>
							</div>
						</div>




					</div>
				</div>
			</div>
		</div>
	</section>
	<section style="background-position: center -57.6px;" class="testimonial parallax">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="testimonial-slider flexslider">
						<div style="overflow: hidden; position: relative;" class="flex-viewport">
							<ul style="width: 600%; margin-left: -2280px;" class="slides">
								<li style="width: 1140px; float: left; display: block;" class="">
									<div class="slide">
										<h2>Cosa dicono di noi <strong> Leggi qui sotto </strong></h2>
										<blockquote>
											<p>
												Oboli &egrave; un'idea tanto semplice quanto rivoluzionaria.
											</p>
											<footer>
												<span>Laura Michelin</span>
												<cite>(Volontaria)</cite>
											</footer>
										</blockquote>
									</div>
								</li>
								<li class="" style="width: 1140px; float: left; display: block;">
									<div class="slide">
										<h2>Cosa dicono di noi <strong> Leggi qui sotto </strong></h2>
										<blockquote>
											<p>
												Oboli pu&ograve; veramente cambiare per sempre il mondo delle donazioni!
											</p>
											<footer>
												<span>Francesco Peruzzi</span>
												<cite>(Volontario)</cite>
											</footer>
										</blockquote>
									</div>
								</li>
								<li class="flex-active-slide" style="width: 1140px; float: left; display: block;">
									<div class="slide">
										<h2>Cosa dicono di noi <strong> Leggi qui sotto </strong></h2>
										<blockquote>
											<p>
												Quando ho sentito parlare di questo progetto per la prima volta mi sono subito chiesta: come ho fatto a non pensarci io??
											</p>
											<footer>
												<span>Caroline Dunkle</span>
												<cite>(Volontaria)</cite>
											</footer>
										</blockquote>
									</div>
								</li>
							</ul>
						</div>
						
						<ul class="flex-direction-nav">
							<li><a class="flex-prev" href="#">Previous</a></li>
							<li><a tabindex="-1" class="flex-next flex-disabled" href="#">Next</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>


<!-- DONATION MODAL START -->
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
		<!-- DONATION MODAL END -->


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
	                                <a id="twitter-share-button" href="https://twitter.com/share" class="btn btn-default btn-social btn-lg btn-twitter" url="URL" data-via="edoventurini" data-count="none"><i class="fa fa-twitter"></i>Twitter</a>
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
						document.getElementById("twitter-share-button").setAttribute("url", data.data.donation_url);
						document.getElementById("fb-share-button").setAttribute("href", "https://www.facebook.com/sharer/sharer.php?app_id=359422247568866&u="+data.data.donation_url+"&display=popup&ref=plugin");
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
