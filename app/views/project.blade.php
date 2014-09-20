@extends('layouts.master')

@section('title')
	Project {{ $project['name'] }}
@stop

@section('content')

	<section id="blog" class="container">
        <div class="row">             
            <div class="container">
                <div class="blog">
                    <div class="blog-item">
                        <img class="img-responsive img-blog" src="{{ asset('img/project.jpg') }}" width="100%" alt="" />
                        <div class="blog-content">
                            <h3>{{ $project->getName() }}</h3>
                            <div class="entry-meta">
                                <span><i class="icon-user"></i> <a href="#">Amnesty International</a></span>
                                <span><i class="icon-calendar"></i> Sept 16th, 2012</span>
                            </div>
								<p class="lead">{{ $project->getShortDescription() }}</p>
								

								<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>

								<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

								<hr>

                            <div class="tags">
                                <i class="icon-tags"></i> Tags <a class="btn btn-xs btn-primary" href="#">Lotta alla Mafia</a> <a class="btn btn-xs btn-primary" href="#">Infanzia</a> <a class="btn btn-xs btn-primary" href="#">Giustizia</a>
                            </div>

                            <p>&nbsp;</p>

                            <div class="author well">
                                <div class="media">
                                    <div class="pull-left">
                                        <img class="avatar img-thumbnail" src="{{ asset('img/amnesty.jpg') }}  " alt="">
                                    </div>
                                    <div class="media-body">
                                        <div class="media-heading">
                                            <strong>Amnesty Internationl</strong>
                                        </div>
                                        <p>Amnesty International è un'organizzazione non governativa internazionale impegnata nella difesa dei diritti umani. Lo scopo di Amnesty International è quello di promuovere, in maniera indipendente e imparziale, il rispetto dei diritti umani sanciti nella Dichiarazione universale dei diritti umani e quello di prevenirne specifici abusi.</p>
                                    </div>
                                </div>
                            </div><!--/.author--> 
                        
                        </div>
                        
                        <hr>
                        
                        <div class="container">	
							@if (Auth::check())
								<h2>Make a donation</h2>
								{{ Form::open(array('action' => 'UserController@makeDonation')) }}
								{{ Form::hidden('project_id', $project['id']) }}
								<div class="row">
									<div class="col-md-1">
										<select name="amount" class="form-control input-small">
										@for ($i=1; $i< Auth::user()->getOboliCount(); $i++)
											@if ($i%5==0)
												<option value="{{ $i }}">{{ $i }}</option>
											@endif									
										@endfor
									</select>
									</div>
									<div class="col-md-1">
										{{ Form::submit('Donate', array('class' => 'btn btn-success')) }}
									</div>
								</div>
								{{ Form::close() }}
							@endif
							

							@if (count($donations)==0)
								<h2>No donations to this project.</h2>
							@else	
								<h2>Donations</h2>
								<div class="bs-example">
									<table class="table">
										<thead>
											<tr>
												<th>#</th>
												<th>User</th>
												<th>Oboli Donated</th>
												<th>Date</th>
											</tr>
										</thead>
										<tbody>				
											@for ($i=0; $i<count($donations); $i++)
												<tr>
													<td>{{ $i }}</td>
													<td>{{ User::find($donations[$i]['user_id'])->getName() }}</td> <!--DA OTTIMIZZARE!! -->
													<td>{{ $donations[$i]['amount'] }}</td>
													<td>today</td>
												</tr>
											@endfor				
										</tbody>
									</table>
								</div>
							@endif
						</div>
						</div>
                        
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->

	
@stop
