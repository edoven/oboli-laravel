<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Oboli - Get more!</title>
        <!-- Bootstrap Core CSS -->
        <link href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Theme CSS --> 
        <link href="{{ asset('bootstrap/css/one-page-base.css') }}" rel="stylesheet">
        <link href="{{ asset('bootstrap/css/act.css') }}" rel="stylesheet">
        <!-- Plugins & Assets-->
        <link href="{{ asset('bootstrap/css/animate.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('bootstrap/css/hover-effects.css') }}" />
        <link rel="stylesheet" href="{{ asset('bootstrap/plugins/prettyPhoto_uncompressed_3.1.5/css/prettyPhoto.css') }}" type="text/css" media="screen">
        <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('bootstrap/plugins/bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('bootstrap/plugins/tinyscrollbar-master/examples/simple/tinyscrollbar.css') }}" type="text/css" media="screen"/>
        <!-- Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800,300,400italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>
        <link href="{{ asset('bootstrap/font-awesome-4.1.0/css/font-awesome.css') }} " rel="stylesheet" type="text/css">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        
        <!-- adaptive-images.php this script must go here 
        <script type="text/javascript">
            function submitContactForm(){
                $.post('contact.php', $('#contactform').serialize(), function(response){
                    $('#contactResponse').html(response);
                }, 'html');
            }
        </script>
        -->
        
        
    </head>
    <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
        <!-- preloader -->
        <div id="preloader-wrapper">
            <div class="preloader">
            </div>
        </div>
        <!-- / preloader -->
        <!--=== NAVIGATION ===-->  
        <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
            <div class="container-wide">
                <div class="navbar-header">
                    <ul class="list-unstyled list-inline pull-right">
                        <li>
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
								<i class="fa fa-bars"></i>
                            </button>     
                        </li>
                        <li id="donate-button-responsive" class="donate bg-brand-tertiary bg-br">
                            <a  href="#donateModal" data-toggle="modal" role="button" class="nav-show-hide">Donate</a>     
                        </li>
                    </ul>
                    <a id="logo" class="navbar-brand-home navbar-brand" href="#home"><img src="{{ asset('bootstrap/img/logo.svg') }}" alt="logo"></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                    <ul class="nav navbar-nav">
                        <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                        <li class="first"><a href="#home" class="hidden-li"></a></li>
                        <li class="page-scroll">
                            <a href="ngos">NGOs</a>
                        </li>
                        <li class="page-scroll">
                            <a href="#howitworks">How it works</a>
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
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>
        <!--=== END Navigation ===-->  
        
        
        
        <!--=== INTRO ===-->  
        <header id="home" class="intro">
            <div class="overlay-dark">
                <div class="intro-body">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- carousel container-->
                            <div class="carousel-wrapper">
                                <!-- carousel -->
                                <div class="carousel slide carousel-fade">
                                    <div class="carousel-inner">
                                        <!-- item 1  -->
                                        <div class="item active">       
                                            <span class="text-big">The free way to help NGOs<br>creating a better world</span><br>
                                            <a href="#howitworks" class="btn btn-outline btn-xl page-scroll">Learn More</a>
                                            
                                        </div>
                                        <!-- /end item 1  -->   
                                        <!-- item 2  -->
                                        <div class="item">       
                                            <span class="text-big">Make an impact!<br>it's free and it's simple</span><br>
                                            <a href="#howitworks" ><button class="btn btn-outline btn-xl">Learn More</button></a>
                                        </div>
                                        <!-- /end item 2  -->
                                        <!-- item 3  -->
                                        <!--
                                            <div class="item">       
                                                  <span class="text-big">Support an ACT<br> Campaign today</span><br>
                                                  <button class="btn btn-outline btn-xl">Explore Intiatives</button>
                                            </div>
                                            --><!-- /end item 3  --> 
                                    </div>
                                </div>
                                <!-- /end carousel  -->  
                            </div>
                            <!-- /end carousel container-->
                            </div>
                            </div>
                            
                            <!-- fundraising bar -->
						   <div id="fundraiser-bar" class="bottom-bar-responsive bg-brand-secondary-darkest">
								  <!-- fundraising progress bar --> 
								  <div class="col-md-6 fundraiser-progress-bar animated-longer-delay-3 fadeIn">
									   <div class="vert-centered-wrapper-120px"><!-- height set in one-page-base.css -->
										  <div class="vert-centered">
											  <div class="progress">
													<div class="progress-bar progress-bar-tertiary" role="progressbar"  style="width:60%;">
													  <h3><span class="responsive-hide">Obolis redeemed</span> &nbsp;<b>2453</b></h3>
													</div>
													<h3 class="goal"><span class="responsive-hide">Goal</span> <b>5000</b></h3>
											   </div>
										  </div>
									   </div>
								  </div><!-- /end fundraising progress bar --> 
								  <!-- campaign stats --> 
								  <div class="col-md-4 col-sm-9 col-xs-12 fundraiser-stats">
									  <div class="col-md-4 col-sm-4  col-xs-4 animated-longer-delay-7 fadeIn">
										  <div class="vert-centered-wrapper-120px"><!-- height set in one-page-base.css -->
											  <div class="vert-centered">	
												  <h2><span class="timer" data-to="56302" >56302</span></h2>
												  <h4>Obolis donated</h4>
											  </div>
										   </div>
									  </div>
									  <div class="col-md-4 col-sm-4 col-xs-4 animated-longer-delay-8 fadeIn">
										  <div class="vert-centered-wrapper-120px"><!-- height set in one-page-base.css -->
											  <div class="vert-centered">	
												  <h2><span class="timer" data-to="1506">1506</span></h2>
												  <h4>Donors</h4>
											  </div>
										   </div>
									  </div>
									  <div class="col-md-4 col-sm-4 col-xs-4 animated-longer-delay-9 fadeIn end">
										  <div class="vert-centered-wrapper-120px"><!-- height set in one-page-base.css -->
											  <div class="vert-centered">	
												  <h2><span class="timer" data-to="25" data-speed="2500">25</span></h2>
												  <h4></h4>
											  </div>
										   </div>
									  </div><div class="clearfix"></div>
								  </div><!-- /end campaign stats --> 
								  <!-- make a donation --> 
								  <div class="col-md-2 col-sm-3 col-xs-12  make-a-donation  animated-longer-delay-10 fadeIn">
									  <div class="vert-centered-wrapper-120px"><!-- height set in one-page-base.css -->
										   <div class="vert-centered">	
											  <a href="sample-campaign.html" class="btn btn-primary btn-lg btn-rounded-edge btn-extra-padding">How it works</a>
										   </div>
									  </div>
								  </div><!-- /end make a donation --> 
						  </div><!-- /end fundraising bar -->   
										
                            
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!--=== END intro ===-->  
        
        
        
        <!--=== CONTENT (between intro and footer) ===-->

        
        <!--=== how it works ===-->
        <section id="howitworks" class="bg-white">
			<div class="inner-container">
				<!-- section header -->
				<div class="row text-center">
					<div class="col-lg-8 col-xs-12 col-lg-offset-2  wow animated fadeInDown">
						<h1 class="">How it works</h1>
						<div class="accent-rule-short"></div>
						<h2>Oboli is the <b>free</b> and easy way to help NGOs<br /> creating a better world</h2>
					</div>
				</div>
				<!-- / end section header -->
				<div class="row row-after-a-row row-of-columns">
					<div class="col-lg-4 col-sm-12 text-center  wow animated-longer-delay-1 fadeIn">
						<i class="text-big text-primary fa fa-money"></i>
						<h2><b>Oboli is a virtual currency</b></h2>
						<h3>1000 Obolis = 1€</h3>
					</div>
					<div class="col-lg-4 col-sm-12 text-center  wow animated-longer-delay-4 fadeIn">
						<i class="text-big text-primary fa fa-qrcode"></i>
						<h2><b>Get the Obolis</b></h2>
						<h4>You can find Obolis in different producs. <br>To get them you just scan a code with our mobile app.</h4>
					</div>
					<div class="col-lg-4 col-sm-12 text-center  wow animated-longer-delay-5 fadeIn">
						<i class="text-big text-primary fa fa-heart"></i>
						<h2><b>Give your Obolis</b></h2>
						<h4>You can easly donate your Obolis to NGOs<br>to help them creating a better world.</h4>
					</div>
				</div>
			</div>
		</section>
		<!--=== END how it works ===-->  
		
		
		
		<!--=== About Carousel ===-->
       <section id="about" class="bg-brand-secondary-dark">
          <div class="col-lg-12 inner-container text-center wow animated fadeInDown" data-wow-offset="10">
              <h2>"Be the change that you wish to see in the world"</h2>
              <div class="accent-rule-short"></div>
              <h3>Mahatma Gandhi</h3>
              
               </div>             
          <div class="clearfix"></div>
       </section><!--=== / END about  ===-->   
		
		
		
		
		
            
        
		 <!--=== ngos and projects ===-->
		<section id="ngos">
			<div class="bg-white">
				<div class="inner-container overlay-light row-of-columns"><!-- used 'row-of-columns' anytime columns will eventually stack in responsive mode, it adds bottom margin to all inner columns when window less than 1200px   -->
					<!-- section header -->
					<div class="header row text-center">
						<div class="col-lg-8 col-xs-12 col-lg-offset-2 wow animated fadeInDown">
							<h1>NGOs you can support</h1>
						</div>
					</div><!-- / end section header -->    
					<!-- end section header -->
					
					<!-- section ngos rows -->
					<div class="bg-white">
						<div class="inner-container overlay-light row-of-columns">
						<!-- used 'row-of-columns' anytime columns will eventually stack in resposive mode adds bottom margin to all inner columns when window less than 1200px   -->	
							
							<?php
								$ngos = Ngo::all();
							?>
							
							<!-- row1-->
							<div class="row">
								@for ($i = 0; $i<3; $i++)
									<?php
										$ngo = $ngos[$i];
									?>
									<!-- element -->
									<div class="col-sm-4 ">
										<div class="">
											<div class="carousel-inner">
												<div class="item active">
													<div class="panel ngo">
														<div class="panel-header">
															<a href="ngos/{{ $ngo->id }}">
																<img src="{{ asset('bootstrap/img/amnesty.png') }}" class="img-responsive col-xs-12 no-padding"  alt="image"/><!-- / css hack: 'col-xs-12 no-padding' added as workaround due to image not resizing once responsive col kicks in -->
															</a>
															<div class="clearfix"></div>
														</div>
														<div class="panel-body">
															<h3><a href="ngos/{{ $ngo->id }}">{{ $ngo->name }}</a></h3>
															<p> {{ $ngo->short_description }}</p>
															<div class="col-lg-12 no-padding">
																<div class="progress progress-xs">
																	<div class="progress-bar progress-bar-tertiary" role="progressbar"  aria-valuenow="60" aria-valuemin="0" aria-valuemax="60" style="width:50%"></div>
																</div>
															</div>
														</div>
														<div class="clearfix"></div>
														<div class="panel-footer text-center">
															<div class="col-xs-4">
																<h3> {{ $ngo->oboli_count }} </h3>
																<small>Obolis raised</small>
															</div>
															<div class="col-xs-4">
																<h3>54</h3>
																<small>Donors</small>
															</div>														
															<div class="col-xs-4">
																<h3>67</h3>
																<small>Donations</small>
															</div>
															<div class="clearfix"></div>
														</div>
													</div>
													<!-- /end panel  -->
												</div>

											</div>
											<!-- /end recent campaign carousel -->
										</div>
										<!-- /end inner container -->
									</div>
									<!-- END element-->
								@endfor									
							</div>
							<!-- END row1-->
				
							<div class="center">
								   
							</div>
							
							<div class="row text-center">
								<div class="col-lg-12 col-xs-12">
									<h1><a  href="ngos" role="button" class="show-more btn btn-primary btn-lg btn-rounded-edge btn-extra-padding">SHOW MORE</a>  </h1>
								</div>
							</div>
							
				
						</div>
					</div>
					<!-- end section ngos rows -->
			
				</div>
			</div><!-- / end inner container-->
        </section>            
        <!--=== END ngos and projects ===-->
        
        
        
        <!--=== Volunteer Stories ===-->
         <section id="volunteer">
         	<div class="overlay-dark">
                    <div class="col-md-7 inner-container wow animated fadeIn pull-right ">
                        <h2 class="text-secondary-dark">Volunteer Spotlight</h2>
                        <h3>Meet Jill</h3>
                        <span class="text-callout">“A few years ago, I started looking for worthwhile volunteer opportunities. I began volunteering at the downtown location in September of 2009 and the rest is history. I have met so many wonderful people and have made new friendships with other volunteers.”
                        </span>
                    </div>
            </div><!-- /end overlay -->
     	 </section><!--=== / END volunteer stories  ===-->   
        
        
      <!--=== CONTACT ===-->
      <section id="contact">
            <div class="row">
                <div class="span4 collapse-group">
                  <div id="viewdetails" class="bg-brand-tertiary collapse">
                    <div class="inner-container animated fadeIn">
                          <div class="col-lg-12"><h2>Contact Us</h2></div>
                          <div class="col-lg-8">
                           <!-- contact form -->    
                           <div class="col-lg-12 no-padding">
                           		<div class="col-lg-8 no-padding"><p id="contactResponse"></p></div>
                           </div>
                              <form method="post"  id="contactform" class="contactform">
                                                <div class="form-group">
                                                    <div class="controls">
                                                         <label class="control-label">Name <span class="transparent-50">*</span></label>
                                                         <input type="text" id="name" name="name" class="field text form-control" placeholder="Name">
                                                    </div>
                                                </div>
                                                    
                                                <div class="form-group">
                                                    <div class="controls">
                                                         <label class="control-label">Email <span class="transparent-50">*</span></label>
                                                         <input type="text" id="email"  name="email" class="field text form-control"  placeholder="Email">
                                                    </div>	
                                                </div>
                                                
                                                <div class="form-group ">
                                                    <div class="controls">
                                                        <label class="control-label">Subject <span class="transparent-50">*</span></label>
                                                        <input type="text"  id="subject" name="subject" class="field textbig form-control" placeholder="Subject">
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group ">
                                                    <div class="controls">
                                                        <label class="control-label">Message <span class="transparent-50">*</span></label>
                                                        <textarea id="comments" name="comments" class="field form-control" rows="5" placeholder="Enter your message here..."></textarea>
                                       
                                                    </div>
                                                </div>
                                                
                                                <div class="controls">
                                                    <button type="button" onclick="submitContactForm()" value="send message" id="submitbtn" class="btn btn-black btn-lg btn-rounded-edge">Send Message</button>
                                                    
                                                </div>
                                    </form>
                          </div><!-- /end contact form -->   
                          <div class="col-lg-4 col-sm-12 col-right-responsive-fix">
                         	<h3>We want to hear from you</h3>
                            <p>We view ourselves as relational. If you prefer to talk to a real live person, please pick up the phone and give us a call.</p>
                            <br>
                            <h3>Have any questions?</h3>

                            <p>Nulla facilisi. Sed quis bibendum felis, pharetra fringilla ante. Donec tincidunt dui risus, at suscipit purus sodales non.</p>
                            <br>
                            <h3>Stay up to Date</h3>
                            <p>Keep informed by signing up for email updates. We promise we won't send you any junk mail.  </p>
                            <div class="col-lg-9 col-sm-5 no-padding">
                                <form class="footer-subsribe">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Email Address">                            
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" type="button">Subscribe</button>
                                        </span>
                                    </div>                  
                                </form>  
                            </div>
                         </div>
                        <div class="clearfix"></div> 
                    </div>
                  </div>
                </div><!-- / end collapse-group -->
            </div><!-- / end row -->
            <div class="bg-brand-tertiary thin-strip">&nbsp;</div>
            <div class="wrapper-relative bg-white">
               <!-- map // map corrdinates line 90 of act.js text near line 207 of act.js -->
               <div id="map" class="wow animated-longer-delay-4"> </div><!-- / end map -->
               <!-- contact toggle -->
               <div class="float-over-top">
                        <div id="contact-toggle" class="tab-down tab-down-tertiary">
							<a class="" data-toggle="collapse" data-target="#viewdetails">
								<h3>Send us a message <i class="fa fa-chevron-down"></i></h3>
							</a>
						</div>
               </div><!--/ end contact toggle -->
 
            </div>
      </section> <!--=== / END contact ===-->
        

        
        
        <!--=== FOOTER ===-->
        <section id="footer">
            <!-- Row 1 -->
            <div class="row footer-top row-of-columns">
                <div class="inner-container-small wow animated fadeIn">
                    
                    <div class="col-md-3">
                        <div class="content-stacked">
                            <!-- Community -->
                            <div class="headline-first">
                                <h5>Contacts</h5>
                            </div>
                            <ul class="list-unstyled list-vert-solid-line">
								<li><a href="javascript:void(0)">Email</a></li>
                                <li><a href="javascript:void(0)">Facebook</a></li>
                                <li><a href="javascript:void(0)">Twitter</a></li>
                                <li><a href="javascript:void(0)">Linkedin</a></li>
                            </ul>
                            <!-- / end Community -->
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <!-- Recent Blog Entries -->
                        <div class="blog-posts">
                            <div class="headline">
                                <h5>Recent Blog Entries</h5>
                            </div>
                            <div class="post col-lg-12 no-padding">
                                <a href="javascript:void(0)"><strong class="text-primary">Syria: the Dangers</strong><br> 
                                Home replaced by a perilous sea journey to Italy...</a><br>
                                <i><small>Posted by Administrator</small></i>
                            </div>
                            <div class="post col-lg-12 no-padding">
                                <a href="javascript:void(0)"><strong class="text-primary">Displacement of thousands</strong><br>
                                <i>Now headed for a region that’s already overstretcheded...</i></a><br>
                                <i><small>Posted by Administrator</small></i>                           	
                            </div>
                            <div class="post col-lg-12 no-padding">
                                <a href="javascript:void(0)"><strong class="text-primary">Six months of fighting</strong><br>
                                <i>A generation of children at risk...</i></a>    <br>
                                <i><small>Posted by Administrator</small></i>                       	
                            </div>
                        </div>
                        <!-- / end recent blog entries -->
                    </div>
                    <div class="col-md-3 last">
                        <div class="headline">
                            <h5>Other Stuff</h5>
                        </div>
                        <div class="post col-lg-12 no-padding">
							<a href="javascript:void(0)"><strong class="text-primary">Privacy Policy</strong></a>
						</div>
						<div class="post col-lg-12 no-padding">
							<a href="javascript:void(0)"><strong class="text-primary">Terms of Service</strong></a>                     	
						</div>
                    </div>
                    <div class="col-md-3">               
                        <!-- Monthly Newsletter -->
                        <div class="headline">
                            <h5>Monthly Newsletter</h5>
                        </div>
                        <p>Subscribe to our newsletter and stay up to date with the latest news!</p>
                        <form class="footer-subscribe">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Email Address">                            
                                <span class="input-group-btn">
                                <button class="btn btn-primary" type="button">Subscribe</button>
                                </span>
                            </div>
                        </form>
                        <!-- end Monthly Newsletter -->
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!-- / end inner container -->
            </div>
            <!-- / end Row 1 -->
            <!-- Row 2 -->
            <div class="row footer-bottom">
                <div class="inner-container-small wow animated fadeIn">
                    <div class="col-lg-3 col-sm-12 left">
                        <p><small class="transparent-50">© 2014 Oboli LTD. All Rights Reserved.</small></p>
                    </div>
                    <div class="col-lg-6 col-sm-12 pull-right">
                        <div class="list-social transparent-100 pull-right">
                            <ul class="list-inline">
                                <li><a href="javascript:void(0)"><i class="fa fa-facebook transparent"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-twitter transparent"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-send transparent"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / end Row 2 -->
        </section>
        <!--=== END Footer ===-->    
        
        
        
        
           
        <!-- Core JavaScript Files -->
        <script src="{{ asset('bootstrap/js/jquery-1.11.0.js') }}"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <!-- Plugins -->
        <script src="https://maps.googleapis.com/maps/api/js"></script>
        <script src="{{ asset('bootstrap/js/modernizr.js') }}"></script>
        <script src="{{ asset('bootstrap/js/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('bootstrap/plugins/WOW-master/dist/wow.js') }}"></script>
        <script>
            new WOW().init();
        </script>
        <script src="{{ asset('bootstrap/plugins/prettyPhoto_uncompressed_3.1.5/js/jquery.prettyPhoto.js') }}" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript" src="{{ asset('bootstrap/plugins/tinyscrollbar-master/lib/jquery.tinyscrollbar.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bootstrap/plugins/jquery-countTo-master/jquery.countTo.js') }}"></script>
        <!-- these next three are for the date picker in the the 'schedule an event' modal window -->
        <script type="text/javascript" src="{{ asset('bootstrap/js/moment.js') }}"></script>
        <script src="{{ asset('bootstrap/plugins/bootstrap-datetimepicker-master/src/js/locales/bootstrap-datetimepicker.en-au.js') }}" type="text/javascript" charset="utf-8"></script>
        <script src="{{ asset('bootstrap/plugins/bootstrap-datetimepicker-master/src/js/bootstrap-datetimepicker.js') }}" type="text/javascript" charset="utf-8"></script>
        <!-- Custom Theme JavaScript -->
        <script src="{{ asset('bootstrap/js/act.js') }}"></script>
    </body>
</html>

