@extends('layouts.master')

@section('title')
Oboli Card
@stop


@section('content')	
<div class="content-wrapper container" id="page-info">
					<div class="row">
						<div class="col-xs-12">
							<article class="blog blog-details anim-section animate">
								<figure>
									<img src="{{ asset('img/web/card.jpg') }}" alt="">
								</figure>
								<div class="row">
									<div class="col-xs-12 col-sm-10 col-sm-offset-1 caption text-center">
										<h2 class="h1">La Oboli Card sarà disponbile tra pochi giorni!</h2>				
									</div>
									<div class="col-xs-12 col-sm-10 col-sm-offset-1 text-center">
										<div class="reply-form">
											<h3>Vuoi ricevere uno <strong>sconto del 20%</strong>?<br /><br />Lasciaci la tua e-mail e sarai avvisato appena la Oboli Card sarà disponibile.</h3>
											{{ Form::open(array('url' => 'mailinglist/new', 'role'=>'form')) }}
												<div class="row">
													<div class="col-xs-6 col-sm-6 col-sm-offset-3">
														<div class="row">
															<div class="col-xs-12 col-sm-9">
																<input name="tag" value="gift_card" type="hidden">
																<input class="form-control" id="email" name="email" placeholder="email">
															</div>
															<div class="col-xs-12 col-sm-3">
																<button type="submit" class="btn btn-default">
																Invia
															</button>
															</div>
														</div>													
													</div>
												</div>
											{{ Form::close() }}
										</div>
									</div>
								</div>
							</article>
						</div>
					</div>
				</div>
@stop

