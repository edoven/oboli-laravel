@extends('layouts.master')

@section('title')
NGOs
@stop


@section('top')
	@if (Session::has('new_code'))
		<div class="alert alert-success alert-dismissible text-center" role="alert">
		 	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<strong>Complimenti!</strong> Hai appena guadagnato {{ Session::get('amount') }} Oboli!
		</div>
	@endif
@stop


@section('content')      
        	


<div class="content-wrapper cause-page-section" id="page-info">
	<div class="container">
		<section class="our-story row anim-section animate">
			<div class="col-xs-12">
				<header class="page-header section-header top-spacer">
					<h2>Dona i tuoi Oboli. E' facile e <strong>gratuito</strong></h2>
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
									<a href="/ngos/{{ $ngo->name_short }}" class="btn btn-default btn-donation">dettagli</a>
									<button type="button" class="btn btn-default btn-donation" data-toggle="modal" data-target="#exampleModal" data-ngo-name="{{ $ngo->name }}" data-ngo-id="{{ $ngo->id }}">dona subito</button>
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



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
      </div>
      <div class="modal-body">
        <div class="form-group col-xs-12 col-sm-6">
        	@if (Auth::guest())
        		<p>non puoi donare</p>
        	@else
				{{ Form::open(array('url'=>'/donations/new', 'role'=>'form')) }}
					<input id="ngo_id" name="ngo_id" value="-1" type="hidden">
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
			@endif
		</div>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>


@section('scripts')
	<script type="text/javascript">
	$('#exampleModal').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) // Button that triggered the modal
	  var ngo_id = button.data('ngo-id')
	  var ngo_name = button.data('ngo-name') // Extract info from data-* attributes
	  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  var modal = $(this)
	  modal.find('.modal-title').text('Stai donando a  ' + ngo_name)
	  modal.find('.modal-body #ngo_id').attr("value", ngo_id)
	})
	</script>
@stop