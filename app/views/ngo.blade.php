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
									<span class="date-desc">Anno di fondazione: 2005.</span>
								</div>
								<div class="row">
									<div class="col-xs-12">
										<span class="donation">
											<img class="metric-icon" src="{{ asset('img/web/donated.png') }}" /> <span id="obolisCount" class="value" >{{ $ngo->oboli_count }}</span>
											<img class="metric-icon" src="{{ asset('img/web/donors.png') }}" /> <span id="donors" class="value">{{ $ngo->donors }}</span>
										</span>
										
										@if (Auth::guest())
											<a data-toggle="modal" href="#" data-target=".login-form" class="btn btn-default btn-donation pull-right">dona subito</a>
										@else
											<a data-toggle="modal" href="#" data-target="#donate-modal" class="btn btn-default btn-donation pull-right">dona subito</a>
										@endif
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
						<div class="row article-list progressbar bottom-bar">
							<header class="col-xs-12 block-title">
								<h3>Cause collegate</h3>
							</header>
							@foreach ($same_area_ngos as $same_area_ngo)
								<div class="col-xs-12 col-sm-4 zoom anim-section animate">
									<a href="#" class="img-thumb">
										<figure>
											<img src="{{ asset('img/web/ngos/large/'.$same_area_ngo->name_short.'.jpg') }}" alt="">
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
										<img src="{{ asset('img/web/areas/icons/women.png') }}" alt=""> Donne <span class="pull-right">(20)</span>
									</a>
								</li>
								<li>
									<a href="/ngos?category=children">
										<img src="{{ asset('img/web/areas/icons/children.png') }}" alt=""> Bambini <span class="pull-right">(18)</span>
									</a>
								</li>
								<li>
									<a href="/ngos?category=environment">
										<img src="{{ asset('img/web/areas/icons/environment.png') }}" alt=""> Ambiente <span class="pull-right">(15)</span>
									</a>
								</li>
								<li>
									<a href="/ngos?category=health">
										<img src="{{ asset('img/web/areas/icons/health.png') }}" alt=""> Salute <span class="pull-right">(12)</span>
									</a>
								</li>
								<li>
									<a href="/ngos?category=humrights">
										<img src="{{ asset('img/web/areas/icons/humrights.png') }}" alt=""> Diritti Umani <span class="pull-right">(30)</span>
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



<!-- DONATION MODAL -->
<div aria-hidden="true" style="display: none;" class="modal" id="donate-modal">
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
								<p>Scopri come ottenerli visitando la pagina con i prodotti convenzionati con Oboli.</p>
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
						<div class="modal-body">
							<div class="col-xs-12">
								<div class="form-group col-xs-12 col-sm-6">
									{{ Form::open(array('url'=>'/donations/new', 'role'=>'form')) }}
										<input id="ngo_id" name="ngo_id" value="{{ $ngo->id }}" type="hidden">
										<div class="row">
											<div class="form-group col-xs-12 col-sm-12">
													<label>Seleziona il numero di oboli</label>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-12 col-sm-6">
												<div class="choose-pricing">
													<div class="btn-group"> 
														<select name="amount" class="form-control">
															@for ($i=1; $i<Auth::user()->oboli_count; $i++)
															  <option value="{{ $i }}">{{ $i }}</option>
															@endfor
														</select>

													</div>
												</div>
											</div>
											<div class="form-group col-xs-12 col-sm-6">
												<input value="DONA" class="btn btn-default" type="submit">
												<button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
											</div>
										</div>							
									{{ Form::close() }}
								</div>
							</div>
							
							<select id="donationAmount">
							 	@for ($i=1; $i<Auth::user()->oboli_count; $i++)
									<option value="{{ $i }}">{{ $i }}</option>
								@endfor
							</select>
							<button type="button" onclick="makeDonation()">Dona</button>
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
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					×
				</button>
				<header class="page-header">
					<h2>Grazie</h2>
				</header>
			</div>
			<div class="modal-body">
				<div class="col-xs-12">
					<p>Grazie {{ Auth::user()->name }}!</p>
					<p>
						<span id="ngoName"></span> ti ringrazia per avergli donato <span id="donationAmountPost"></span> Oboli
					</p>
					<div>
						<a href="" id="donationLink"></a>
					</div>
					<div>
						<button id="sharer" class="btn btn-default btn-social btn-lg btn-facebook"><i class="fa fa-facebook"></i>Condividi su Facebook</button>
						<a href="https://twitter.com/share" class="btn btn-default btn-social btn-lg btn-twitter" url="http://ciao.it" data-via="edoventurini" data-count="none">Tweet</a>
					</div>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
@endif



@section('scripts')

@if (!Auth::guest())
	<script>
		function makeDonation()
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
					var response = xmlhttp.responseText
					console.log("response="+response);
					var data = JSON.parse(response);
					document.getElementById("obolisCount").innerHTML=data.data.obolis_count;
					document.getElementById("donors").innerHTML=data.data.donors;
					document.getElementById("ngoName").innerHTML=data.data.ngo_name;
					document.getElementById("donationAmountPost").innerHTML=data.data.amount;
					document.getElementById("donationLink").setAttribute("href", "{{ Config::get('local-config')['host']}}/donations/"+data.data.donation_id);
					$('#donate-modal').modal('hide');
					$('#donation-confirmed-modal').modal('show');

				}
			}
			try
			{
				var element = document.getElementById("donationAmount");
				var donationAmount = element.options[element.selectedIndex].value;
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
	</script>
@endif



<!-- FACEBOOK SHARING BUTTON SCRIPT -->
<script>
	document.getElementById('sharer').onclick = function () {
	  var url = 'https://www.facebook.com/sharer/sharer.php?u='+document.getElementById("donationLink").getAttribute("href");
	  window.open(url, 'fbshare', 'width=640,height=320');
	};
</script>

<!-- TWITTER SHARING BUTTON SCRIPT -->
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
@stop
