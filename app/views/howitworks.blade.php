@extends('layouts.master')

@section('title')
NGOs
@stop


@section('content')
      
<!-- site content -->
<div id="main">

	<!-- How does it work Section Start Here-->
	<section class="container services text-center">
		<div class="row">
			<div class="col-xs-12">
				<div class="page-header section-header clearfix">
                    <h2>Scopri come funziona. <strong style="border: none;">Leggi qui sotto</strong></h2>
                </div>

				<div class="row">
					<div class="col-xs-12 col-sm-4 zoom">
						<img src="img/web/howto1.png" alt="">
						<h2 class="h2">Oboli è una <br \><span class="howto-orange">moneta</span> virtuale</h2>
						<hr class="howto">
						<p>
							1000 Oboli = 1 Euro. <br /> Oboli è una moneta virtuale che ti pemette di creare un mondo migliore in maniera semplice e <strong>gratuita</strong>.
						</p>
					</div>
					<div class="col-xs-12 col-sm-4 zoom ">
						<img src="img/web/howto2.png" alt="">
						<h2 class="h2">Come <span class="howto-orange">ottenere</span><br \>gli Oboli</h2>
						<hr class="howto">
						<p>
							Puoi ottenere gli Oboli acquistando dei prodotti convenzionati. Puoi ottenere ad esempio 100 oboli comprando una bevanda o 200 oboli comprando un bagnoschiuma.
						</p>
					</div>
					<div class="col-xs-12 col-sm-4 zoom">
						<img src="img/web/howto3.png" alt="">
						<h2 class="h2"><span class="howto-orange">Dona</span><br \> i tuoi Oboli</h2>
						<hr class="howto">
						<p>
							Dona i tuoi oboli a ONG, associazioni con fini sociali e progetti umanitari. E' facile e <strong>non ti costa nulla</strong>.
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Services Section End Here-->
				
				
		<div class="content-wrapper" id="page-info">
			<div class="container">

				<div class="row">
					<div class="col-xs-12">
						<header class="faq-header section-header">
							<div class="page-header section-header clearfix">
                                <h2>Qualcosa non è chiaro? Leggi le nostre <strong style="border: none;">domande frequenti</strong>.</h2>
                            </div>
						</header>
						<!-- Collape Section Start Here -->

						<div class="row faq">
							<div class="cols-xs-12 col-sm-12 anim-section">
								<div class="panel-group" id="accordion-right">
									<div class="panel panel-default panel-faq">
										<div class="panel-heading">
											<h4 class="panel-title"><a class="collapsed" data-toggle="collapse" data-parent="#accordion-right" href="#collapse-9"> Quanto mi costa donare gli oboli  ? <i class="fa fa-plus collape-plus"></i></a></h4>
										</div>
										<div id="collapse-9" class="panel-collapse collapse">
											<div class="panel-body">
												<p>
													Assolutamente niente. Fare una donazione di Oboli è gratis.
												</p>
											</div>
										</div>
									</div>
									<div class="panel panel-default panel-faq">
										<div class="panel-heading">
											<h4 class="panel-title"><a class="collapsed" data-toggle="collapse" data-parent="#accordion-right" href="#collapse-10"> Quanto arriva in tasca alle ONG  ? <i class="fa fa-plus collape-plus"></i></a></h4>
										</div>
										<div id="collapse-10" class="panel-collapse collapse">
											<div class="panel-body">
												<p>
													Il 100% della donazione. Noi non tratteniamo niente.
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Collape Section End Here -->
					</div>
				</div>
			</div>

			<!-- ask-us -->
			<section class="save-lives ask-us text-center">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
							<header class="page-header">
								<h2>Hai altre domande? <strong>Contattaci</strong></h2>
								<p>
									Saremo felici di rispondere ad ogni domanda o dubbio. Scrivici anche per qualsiasi altra cosa, critiche comprese! :)
								</p>
							</header>
							<a class="btn btn-default" href="/contact-us">Contattaci</a>

						</div>
					</div>
				</div>
			</section>
			<!-- ask-us end  -->
		</div>

	</div>
	<!-- FAQ section ends -->
       

@stop



