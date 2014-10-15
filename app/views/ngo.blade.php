@extends('layouts.master1')

@section('title')
{{ $ngo['name']  }}
@stop

@section('content')
	<body class="subpage">
    
    <!-- preloader -->
    <div id="preloader-wrapper">
        <div class="preloader"></div>
    </div><!-- / preloader -->
        
    	<!--=== NAVBAR ===-->
        <nav class="navbar navbar-custom navbar-fixed-top top-nav-collapse subpage" role="navigation">
                <div class="navbar-header">
                    <ul class="list-unstyled list-inline pull-right">
                        <li>
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                                <i class="fa fa-bars"></i>
                            </button>     
                        </li>
                        <li id="donate-button-responsive" class="donate bg-brand-tertiary">
                             <a  href="#donatemodal" data-toggle="modal" role="button" class="navbar-toggle">Donate</a>     
                    	</li>      
                    </ul>         
                    <a id="logo" class="navbar-brand" href="index.html"><img src="img/logo.svg" alt="logo"></a>
                </div>
    
                <!-- Responsive toggle nav -->
               
               
                   <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                    <ul class="nav navbar-nav">
                        <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                        <li class="first"><a href="#home" class="hidden-li"></a></li>
                        <li class="page-scroll">
                            <a href="/ngos">NGOs</a>
                        </li>
                        <li class="page-scroll">
                            <a href="index.html#howitworks">How it works</a>
                        </li>

                        <li class="page-scroll">
                            <a href="#volunteer">Products</a>
                        </li>
                        <li class="page-scroll">
                            <a href="#contact">Contacts</a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Access <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="blog-home.html">Sign Up</a></li>
                                <li><a href="blog-isotope.html">Log In</a></li
                            </ul>
                        </li>
                    </ul>
                </div><!-- /navbar-collapse -->
         </nav><!-- /navbar -->
         
         
          <!--=== DONATE modal ===-->
		  <div class="modal fade" id="donateModal" style="overflow:visible!important">
			<div class="modal-dialog modal-lg text-center">
			  <div class="modal-content">
				  <div class="modal-body">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h1>Donate Now </h1>
					<div class="accent-rule-short"></div>
					<h2>Join us in helping people survive and rebuild their lives. </h2>
					<ul class="list-unstyled list-inline">
						<li><button type="button" class="btn btn-primary btn-xl btn-block">$15</button></li>
						<li><button type="button" class="btn btn-primary btn-xl btn-block">$25</button></li>
						<li><button type="button" class="btn btn-primary btn-xl btn-block">$50</button></li>
						<li><button type="button" class="btn btn-primary btn-xl btn-block">$75</button></li>
						<li><button type="button" class="btn btn-primary btn-xl btn-block">$100</button></li>
						<li>
							<div class="control-group">
							  <div class="form-control-donate controls">
								<input name="textinput" placeholder="$ Other Amount" class="form-control" type="text">
							  </div>
							</div>
						</li>
					</ul>
					<br>
					<!-- monthly / one-time -->
						  <form class="form-horizontal text-center">
							<fieldset>
							<div class="form-group">
							  <div class="col-md-12"> 
								<label class="radio-inline" for="radios-s">
								  <input name="radios" id="radios-s" value="1" checked="checked" type="radio">
								  Single Donation
								</label> 
								<label class="radio-inline" for="radios-m">
								  <input name="radios" id="radios-m" value="2" type="radio">
								  Monthly Donation
								</label> 
							  </div>
						  </div>
						  </fieldset>
						</form>
					<br>
					<button type="button" class="btn btn-tertiary btn-xl btn-rounded-edge" data-dismiss="modal">Continue</button> 
					<br><br>                     
				</div>
			  </div><!-- / modal-content -->
			</div><!-- / modal-dialog -->
		  </div><!--=== / END donate modal ===-->
        

         
         <!--=== INTRO ===-->
         <section class="hero bg-brand-primary">
            <div class="col-lg-12 inner-container animated-longer-delay-4 fadeInDown text-center no-subtitle">
				<h1>Give your Obolis to <br> {{ $ngo['name'] }}</h1> 
          	</div><div class="clearfix"></div>
         </section><!--=== / END intro  ===-->
       
         <!--=== Social Share Bar ===-->
         <div id="social-share-bar" class="bg-brand-primary-darker">
            <div class="col-lg-12 animated-longer-delay-5 fadeInDown text-center">
                 <div class="social-share-bar">
                      <ul class="list-inline list-social">
                        <li><a href="javascript:void(0)"><i class="fa fa-envelope-square"></i> <small class="list-social-text">email</small></a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-twitter-square"></i> <small class="list-social-text">tweet</small></a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-facebook-square"></i> <small class="list-social-text">post</small></a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-pinterest-square"></i> <small class="list-social-text">pin</small></a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-google-plus-square"></i><small class="list-social-text"> share</small></a></li>
                    </ul>
                  </div>
            </div>             
            <div class="clearfix"></div>
         </div><!--=== / END social share bar ===-->
         
        <!--=== CAMPAIGN SUMMARY AND DONATION ===-->
        <section id="campaign-summary">
        	<div id="sample-campaign-image" class="col-sm-8 animated-longer-delay-5 fadeIn"></div>
            <div id="sample-campaign-stats" class="col-sm-4 text-center bg-white">
            	<div id="myStat" data-dimension="200" data-text="35%" data-info="New Clients" data-width="30" data-fontsize="38" data-percent="35" data-fgcolor="#546569" data-bgcolor="#eee" data-fill="#ddd"></div>
                <span class="heading-progress animated-longer-delay-8 fadeIn"><h4><b>2543</b> obolis raised towards our <b>8000</b> obolis goal</h4></span>
                <div class="animated-longer-delay-8 fadeIn">
                	<a  href="#donateModal" data-toggle="modal" role="button" class="btn btn-tertiary btn-lg btn-rounded-edge">Give Obolis</a>
                </div>
            	<!-- campaign stats -->
                <div class="col-lg-12 bg-brand-secondary-darkest footer">
                    <div class="fundraiser-stats">
                        <div class="col-xs-4">
                            <div class="vert-centered-wrapper-120px"><!-- height set in one-page-base.css -->
                                <div class="vert-centered">	
                                    <h2 class="bold" >2543</h2>
                                    <h4>Obolis donated</h4>
                                </div>
                             </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="vert-centered-wrapper-120px"><!-- height set in one-page-base.css -->
                                <div class="vert-centered">	
                                	<h2 class="bold" >200</h2>
                               	    <h4>Donations</h4>
                                </div>
                             </div>
                        </div>
                        <div class="col-xs-4 end">
                            <div class="vert-centered-wrapper-120px"><!-- height set in one-page-base.css -->
                                <div class="vert-centered">	
                                	<h2 class="bold" >190</h2>
                                	<h4>Donors</h4>
                                </div>
                             </div>
                        </div>  
                	</div>
                </div><!-- /end campaign stats --> 
           </div><div class="clearfix"></div>
        </section><!--=== / END campaign summary  ===-->
      
       <!--=== CAMPAIGN DETAILS ===-->
       <section id="campaign-details" class="bg-white">
			<div class="inner-container overlay-light">
            	<!-- section header -->
                <div class="row text-center">
                    <div class="col-lg-12 col-sm-12 wow animated-longer-delay-1 fadeInDown">
                    	<h1>{{ $ngo['name'] }}</h1>
                        <div class="accent-rule-short"></div>
                    	<h2>{{ $ngo['short_description'] }}</h2>
                    </div>
                </div><!-- / end section header -->
                <div class="row row-of-columns">
                	<div class="col-md-8 col-xs-12 wow animated-longer-delay-2 fadeIn">			
                           <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-justified" role="tablist">
                                  <li class="active large"><a href="#campaign-overview" role="tab" data-toggle="tab">Description</a></li>
                                  <li class="large"><a href="#location" role="tab" data-toggle="tab">Location</a></li>
                                </ul>
      						  <!-- Tab panes -->
                                <div class="tab-content bg-white">
                                      <!-- tab pane 1 -->
                                      <div class="tab-pane active" id="campaign-overview">
                                      <div class="clearfix"></div>   
                                          <!--  campaign logo -->
                                             <div class="col-lg-4">
                                                <div class="widget-campaign-logo">
                                                	<div class="vert-centered-wrapper-300px"><!-- height set in one-page-base.css -->
                                                  	  <div class="vert-centered">	
                                                        <i class="fa fa-child fa-5x"></i><i class="fa fa-child fa-5x"></i><i class="fa fa-child fa-5x"></i><i class="fa fa-child fa-5x">
                                                        </i><br>
                                                        <i class="fa fa-child fa-5x"></i><i class="fa fa-child fa-5x"></i><i class="fa fa-child fa-5x"></i><i class="fa fa-child fa-5x"></i>
                                      
                                                        <h2 class="bold">100 Children</h2>
                                                        <h2>Need our help</h2>
                                                     </div>
                                                	 </div>
                                               </div>
                                            </div><!--  /end campaign logo -->
                                            <br><div class="col-lg-8">
                                                <h3>Working to protect human rights.</h3>
                                                <p>
													{{ $ngo['long_description'] }}
												</p>
                                            </div>              
                                      </div><!-- / end tab pane 1 -->
                                      
                                      <!-- tab pane 2 -->
                                      <div id="location" class="tab-pane text-center">
                                        <h3>Location: <span class="text-primary"> North Africa</span></h3>
                                        <br>
                                        <img src="img/World_map_blank_gmt.svg" class="img-responsive col-xs-12" alt="map">
                                      </div><!-- / end tab pane 2 -->
                                      
                                     
                                      <div class="clearfix"></div>
                                </div> <!-- / end tabs -->
                                <br>
                        	<!-- / end campaign partners-->
                            <div class="panel text-center">
                            	<ul class="list-unstyled list-inline list-6">
                                    <li><img src="img/logo-seed.svg"  class="transparent-50 img-responsive" alt="partner"></li>
                                    <li><img src="img/logo-worldrefugees.svg" class="transparent-50 img-responsive" alt="partner"></li>
                                    <li><img src="img/logo-NLONY.svg" class="transparent-50 img-responsive" alt="partner"></li>
                                    <li><img src="img/logo-star.svg"  class="transparent-50 img-responsive" alt="partner"></li>
                                    <li><img src="img/logo-envato.svg"  class="transparent-50 img-responsive" alt="partner"></li>
                                    <li><img src="img/logo-wrf.svg"  class="transparent-50 img-responsive" alt="partner"></li>
                                 </ul>           
                            </div><!-- / end campaign partners-->
                        </div><!-- / end col 1 -->
                        <!-- col 2 -->
                        <div class="col-md-4 col-xs-12 wow animated-longer-delay-6 fadeIn">
                           	<!-- panel -->
                            <div class="panel panel-support-campaign panel-white">
                                <div class="panel-header bg-brand-primary text-center">
                                   <h2>What can your donation do?</h2>
                                </div>
                                <div class="panel-body">
                                   <div class="vert-centered-wrapper-200px wow animated-longer-delay-4 fadeIn stats-carousel"><!-- height set in one-page-base.css -->
                                        <div class="vert-centered">
                                               <!-- carousel -->
                                                <div class="carousel slide carousel-fade" id="carousel-sample">
                                                  <div class="carousel-inner">   
                                                       <!-- item 1  -->
                                                       <div class="item active">       
                                                            <i class="fa fa-group fa-3x"></i>
                                            				<h3>Just $15.00 provides meals to more than 10 children</h3>
                                                             <a  href="#donateModal" data-toggle="modal" role="button" class="btn btn-tertiary btn-lg btn-rounded-edge">Give Obolis</a>
                                                      </div><!-- /end item 1  -->   
                                                       <!-- item 2  -->
                                                      <div class="item ">
                                                           <i class="fa fa-life-bouy fa-3x"></i>
                                            				<h3>Just $100.00 provides aid to more than 10 families</h3>
                                                            <button class="btn btn-tertiary btn-lg  btn-rounded-edge" >Support</button>
                                                     </div><!-- /end item 2  --> 
                                   				</div></div><!-- /end carousel  --> 
                                            </div></div><!-- /end vert centered wrapper  --> 
                                </div><!-- /end panel body  -->
                                <div class="panel-footer text-center">
                                     <div class="row-of-avatars text-center">
                                        <ul class="list-unstyled list-inline">
                                        	<li>
                                            	<div class="avatar-sm">
                                                    <span class="badge badge-fb"><i class="fa fa-facebook"></i></span>
                                                    <button type="button" class="btn btn-white no-padding" data-toggle="tooltip" data-placement="top" title="Marissa Whitaker $20">
                                                    <img src="img/tn_user_08.jpg" class="img-circle" alt="avatar">
                                                    </button>
                                                </div>
                                            </li>    
                                        	<li>
                                            	<div class="avatar-sm">
                                                    <span class="badge badge-fb"><i class="fa fa-facebook"></i></span>
                                                    <button type="button" class="btn btn-white no-padding" data-toggle="tooltip" data-placement="top" title="Ben Housier $10">
                                                    <img src="img/tn_user_07.jpg" class="img-circle" alt="avatar">
                                                    </button>
                                                </div>
                                            </li> 
                                            <li>
                                           		<div class="avatar-sm">
                                                    <span class="badge badge-fb"><i class="fa fa-facebook"></i></span>
                                                    <button type="button" class="btn btn-white no-padding" data-toggle="tooltip" data-placement="top" title="Jill Doe $15">
                                                    <img src="img/tn_user_02.jpg" class="img-circle" alt="avatar">
                                                    </button>
                                                </div>
                                            </li> 
                                            <li>
                                           		<div class="avatar-sm">
                                                    <span class="badge badge-fb"><i class="fa fa-facebook"></i></span>
                                                    <button type="button" class="btn btn-white no-padding" data-toggle="tooltip" data-placement="top" title="Liana Roselli $50">
                                                    <img src="img/tn_user_05.jpg" class="img-circle" alt="avatar">
                                                    </button>
                                                </div>
                                            </li> 
                                            <li>
                                           		<div class="avatar-sm">
                                                    <span class="badge badge-fb"><i class="fa fa-facebook"></i></span>
                                                    <button type="button" class="btn btn-white no-padding" data-toggle="tooltip" data-placement="top" title="Ian White $20">
                                                    <img src="img/tn_user_04.jpg" class="img-circle" alt="avatar">
                                                    </button>
                                                </div>
                                            </li> 
                                         </ul>
                                     </div><!-- /end row of avatars  -->
                                </div><!-- /end panel footer -->
                            </div><!-- /end panel  -->
                    	</div>
                    </div>
                </div><!-- / end col 2 -->
           <div class="clearfix"></div>
       </section><!--=== / END campaign details   ===-->
      
     
                    
            
@stop
