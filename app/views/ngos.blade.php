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
											<img class="metric-icon" src="{{ asset('img/web/donated.png') }}" /> <span class="value">{{ $ngo->oboli_count }}</span>
											<img class="metric-icon" src="{{ asset('img/web/donors.png') }}" /> <span class="value">{{ $ngo->donors }}</span>
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


@if (!Auth::guest())
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
									<input name="ngo_id" value="{{ $ngo->id }}" type="hidden">
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
@endif


@section('scripts')
	<script type="text/javascript">
	$('#camaleonticDonateModal').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) // Button that triggered the modal
	  var ngo_id = button.data('ngo-id')
	  var ngo_name = button.data('ngo-name') // Extract info from data-* attributes
	  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  var modal = $(this)
	  modal.find('#modal-title').text('Stai donando a  ' + ngo_name)
	  modal.find('.modal-body #ngo_id').attr("value", ngo_id)
	})
	</script>
@stop