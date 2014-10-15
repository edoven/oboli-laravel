<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Oboli - @yield('title')</title>
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
    <body class="subpage">
    		
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
                    <a id="logo" class="navbar-brand" href="/"><img src="{{ asset('bootstrap/img/logo.svg') }}" alt="logo"></a>
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
                                <li><a href="/signup">Sign Up</a></li>
                                <li><a href="/login">Log In</a></li
                            </ul>
                        </li>
                    </ul>
                </div><!-- /navbar-collapse -->
         </nav><!-- /navbar -->
    
    
    @yield('content')
    
    
     <!--=== FOOTER ===-->
        <section id="footer">
            <!-- Row 1 -->
            <div class="row footer-top row-of-columns">
                <div class="inner-container-small wow animated fadeIn">
                    
                    <div class="col-md-4">
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
                    
                    <div class="col-md-4 last">
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
                    <div class="col-md-4">               
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
