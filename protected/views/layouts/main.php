<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Metre Per Second</title>
        <link rel="shortcut icon" href="<?php echo Yii::app()->baseUrl; ?>/assets/ico/favicon.ico">
        <!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>-->
        <link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/fontawesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/prettyphoto/css/prettyPhoto.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/owl-carousel2/assets/owl.theme.default.min.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/animate/animate.min.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/swiper/css/swiper.min.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->baseUrl; ?>/assets/css/custom-styles.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/assets/css/bootstrap-multiselect.css" type="text/css">
        <link href="<?php echo Yii::app()->baseUrl; ?>/assets/css/theme.css" rel="stylesheet">
        <script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/modernizr.custom.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/jquery/jquery-1.11.1.min.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/superfish/js/superfish.min.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/prettyphoto/js/jquery.prettyPhoto.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/jquery.sticky.min.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/jquery.easing.min.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/jquery.smoothscroll.min.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/js/Customer.js"></script>

      
        <script>
            var webUrl = '';
            webUrl = '<?php echo Yii::app()->params['webURL']; ?>';

        </script>
    <div id="fb-root"></div>
</head>
<body id="home" class="wide">
    <!-- PRELOADER -->
    <div id="preloader">
        <div id="preloader-status">
            <div class="spinner">
                <div class="rect1"></div>
                <div class="rect2"></div>
                <div class="rect3"></div>
                <div class="rect4"></div>
                <div class="rect5"></div>
            </div>
            <div id="preloader-title">Loading</div>
        </div>
    </div>
    <!-- /PRELOADER -->

    <!-- WRAPPER -->
    <div class="wrapper">

        <!-- HEADER -->
        <header class="header fixed">
            <div class="header-wrapper">
                <div class="container">

                    <!-- Logo -->
                    <div class="logo">
                        <a href="<?php echo Yii::app()->params['webURL'] ; ?>"><img src="<?php echo Yii::app()->baseUrl; ?>/assets/img/logo-mps.png" title="MetrePerSecond" alt="MetrePerSecond"/></a>
                    </div>
                    <!-- /Logo -->

                    <!-- Mobile menu toggle button -->
                    <a href="#" class="menu-toggle btn ripple-effect btn-theme-transparent"><i class="fa fa-bars"></i></a>
                    <!-- /Mobile menu toggle button -->

                    <div class="topnav pull-right">
                        <div class="pull-right dwn-app">
                            <a href="https://play.google.com/store/apps/details?id=com.mps.mpsb2c&hl=en" class="btn btn-submit btn-theme">Download App <i class="fa fa-mobile animated" aria-hidden="true"></i></a>
                        </div>
                        <div class="pull-right myaccount">
                            <a href="<?php echo Yii::app()->params['webURL'] . 'Vendor/Vendor/Vendor'; ?>" class="dropdown-toggle">Partner With Us</a>
                            <?php
                            if (isset(Yii::app()->session['customerID']) && !empty(Yii::app()->session['customerID'])) {
                                ?>
                                <!--<a href="#" class="dropdown-toggle">Add your vehicle</a>-->
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo 'Welcome ' . Yii::app()->session['customerName']; ?> <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </a>							
                                    <ul class="dropdown-menu">
                                        <!--<li><a href='<?php // echo $this->createUrl('mPSVEHICLES_DETAILS/VehicleList');                                                                  ?>'>My Vehicles</a></li>-->
                                        <li><a href='<?php echo Yii::app()->params['webURL'] . 'Booking/Orders/Orders'; ?>'>My Orders</a></li>
                                        <li><a href='<?php echo Yii::app()->params['webURL'] . 'Login/Customer/signOUT' ?>'>Logout</a></li>
                                    </ul>
                                </div>

                            <?php } else {
                                ?>
                                <a href="#" class="dropdown-toggle" data-toggle = "modal" id="fblogin" data-target = "#signup-model_main">Register / Login</a>
                                <?php
                            }
                            ?>


                        </div>

                    </div>
                    <!-- Navigation -->
                    <nav class="navigation closed clearfix">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <!-- navigation menu -->
                                <a href="#" class="menu-toggle-close btn"><i class="fa fa-times"></i></a>
                                <ul class="nav sf-menu">
                                    <li class="<?php if (Yii::app()->controller->action->id == "Booking") echo "active"; ?>">


                                        <a href="<?php echo Yii::app()->params['webURL'] . 'bookacar'; ?>">Book a Service</a></li>

                                    <li class="<?php if (Yii::app()->controller->id == "selfdrive") echo "active"; ?>">
                                        <a href="<?php echo Yii::app()->params['webURL'] . 'selfdrive'; ?>">Self Drive</a>
                                    </li>
                                    <li class="<?php if (Yii::app()->controller->id == "hireMechanic") echo "active"; ?>">

                                        <a href="<?php echo Yii::app()->params['webURL'] . 'hiremechanic'; ?>">Hire a Mechanic</a></li>


<!--                                    <li class="<?php //if (Yii::app()->controller->id == "modificationshop") echo "active";  ?>">

                                        <a href="<?php //echo Yii::app()->params['webURL'] . 'Modificationshop/Car';  ?>">Modifications</a>

                                    </li>-->

                                    <li class="<?php if (Yii::app()->controller->id == "vehicleGuide") echo "active"; ?>">

                                        <a href="<?php echo Yii::app()->params['webURL'] . 'vehicleguide'; ?>">Vehicle Guide</a>


                                    </li>
                                    <li>
                                        <ul class="social-icons">
                                            <li><a href="https://www.facebook.com/metrepersecond" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="https://twitter.com/metrepersecond" class="twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                        </ul>
                                    </li>
                                </ul>
                                <!-- /navigation menu -->
                            </div>
                        </div>
                        <!-- Add Scroll Bar -->
                        <div class="swiper-scrollbar"></div>
                    </nav>
                    <!-- /Navigation -->

                </div>
            </div>

        </header>
        <!-- /HEADER -->
        <!-- CONTENT AREA -->
        <div class="content-area">
            <input type="hidden" name="lastid" id="lastid" value="<?php echo Yii::app()->session['lastid']; ?>">
                           <!--<input type="" name="txt" id="">-->
            <?php echo $content; ?>
        </div>
        <!-- /CONTENT AREA -->

        <div class="clear"></div>

        <section class="subscribe">
            <div class="container">
                <!-- Get in touch -->
                <!-- Contact form -->
                <div id="contact-form">
                    <div class="col-md-6">
                        <div class="form-group footer-btn">
                            <a class="btn ripple-effect btn-theme" href="<?php echo Yii::app()->params['webURL'] . 'Vendor/Vendor/Vendor'; ?>">Partner With Us</a>
                            <?php
                            if (isset(Yii::app()->session['customerID']) && !empty(Yii::app()->session['customerID'])) {
                                
                            } else {
                                ?>
                             <a href="#" class="btn ripple-effect btn-theme" data-toggle = "modal" id="fblogin" data-target = "#signup-model_main">Sign Up</a>
                                <?php
                            }
                            ?>
                        </div>
                        <ul class="media-list contact-list">
                            <li class="media">
                                <div class="media-left"><i class="fa fa-phone"></i></div>
                                <div class="media-body">Support Phone: <?php echo Yii::app()->params['customer_info']['support_mobile']; ?></div>
                            </li>
                            <li class="media">
                                <div class="media-left"><i class="fa fa-envelope"></i></div>
                                <div class="media-body">E mail: <a href="mailto:support@metrepersecond.com" style="color: #a1b1bc;"><?php echo Yii::app()->params['customer_info']['support_mail']; ?></a></div>
                            </li>
                            <li class="media">
                                <a href="https://www.facebook.com/metrepersecond" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a>
                                <a href="https://twitter.com/metrepersecond" class="twitter" target="_blank"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li class="address">
                                <address>
                                    Corporate Address: <br><br>Catalyst Bulding, T-Hub, Gachibowli,<br>
                                    Hyderabad, Telangana, 500032.
                                </address>
                            </li>
                        </ul>
                    </div>
                    <form action="" method="POST" name="enquiry-from" id="enquiry-from"><!-- Enquiry Form -->
                        <br/>
                        <div id="ajaxMessage" align="center">                            
                        </div>                                     
                        <div class="col-md-6 contact-form alt">
                            <h2 class="section-title">
                                <small>Feel Free to Say Hello!</small>
                                <span>Join us for More.</span>
                            </h2>            
                            <div class="outer required">
                                <div class="form-group af-inner has-icon">
                                    <label class="sr-only" for="name">Name</label>
                                    <input type="text" name="enquiry_name" id="enquiry_name" placeholder="Name"  value="" size="30"
                                           data-toggle="tooltip" title="Name is required"
                                           class="form-control placeholder"/>
                                    <span class="form-control-icon"><i class="fa fa-user"></i></span>
                                    <span id="customernameError" style="color:red;"></span>
                                </div>
                            </div>
                            <div class="outer required">
                                <div class="form-group af-inner has-icon">
                                    <label class="sr-only" for="email">Email</label>
                                    <input type="text" name="enquiry_email" id="enquiry_email" placeholder="Email" value="" size="30"
                                           data-toggle="tooltip" title="Email is required"
                                           class="form-control placeholder"/>
                                    <span class="form-control-icon"><i class="fa fa-envelope"></i></span>
                                    <span id="customeremailError" style="color:red;"></span>
                                </div>
                            </div>
                            <div class="outer required">
                                <div class="form-group af-inner has-icon">
                                    <label class="sr-only" for="phone">Phone</label>
                                    <input type="text" name="enquiry_phone" id="enquiry_phone" placeholder="Phone" value="" size="11"
                                           data-toggle="tooltip" title="Phone no is required"
                                           class="form-control placeholder numeric" maxlength="10"/>
                                    <span class="form-control-icon"><i class="fa fa-phone"></i></span>
                                    <span id="phoneError" style="color:red;"></span>
                                </div>
                            </div>

                            <div class="form-group af-inner has-icon">
                                <label class="sr-only" for="input-message">Message</label>
                                <textarea name="enquiry_content"  id="enquiry_content" placeholder="Message" rows="4" cols="50"
                                          data-toggle="tooltip" title="Message is required"
                                          class="form-control placeholder"></textarea>
                                <span class="form-control-icon"><i class="fa fa-bars"></i></span>
                                <span id="contentError" style="color:red;"></span>
                            </div>

                            <div class="outer required">
                                <div class="form-group af-inner">
                                    <button id="submitForm" class="btn btn-theme" type="button">Send message</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- /Contact form -->
                </div>
            </div>
        </section>
        <!-- /PAGE -->			  
        <!-- FOOTER -->
        <footer class="footer">
            <div class="footer-meta">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h2 class="section-title">
                                <small>Our Partners</small>
                            </h2>
                            <div class="ourprtnr">
                                <a href="#">
                                    <img src="https://msg91.com/images/startups/msg91Badge.png" width="60" title="MSG91 - SMS for Startups" alt="Bulk SMS - MSG91">
                                </a>
                                <a href="#">
                                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/citruspay_logo.jpg" title="Citruspay" alt="Citruspay">
                                </a>
                                <a href="#">
                                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/ccevenue_logo.png" title="CCAvenue" alt="CCAvenue">
                                </a>
                                <a href="#">
                                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/vakil-search.png" title="Vakil Search" alt="CCAvenue">
                                </a>
                                <a href="#">
                                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/SMS-country.png" title="SM Country" alt="CCAvenue">
                                </a>
                                <a href="#">
                                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/Keka.png" title="Keka" alt="CCAvenue">
                                </a>
                            </div>
                            
<!--                            <div class="ourprtnr">
                                <a href="https://msg91.com/startups/?utm_source=startup-banner" target="_blank">
                                    <img src="https://msg91.com/images/startups/msg91Badge.png" width="60" title="MSG91 - SMS for Startups" alt="Bulk SMS - MSG91">
                                </a>
                                <a href="http://www.citruspay.com/" target="_blank">
                                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/citruspay_logo.jpg" title="Citruspay" alt="Citruspay">
                                </a>
                                <a href="https://www.ccavenue.com/" target="_blank">
                                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/ccevenue_logo.png" title="CCAvenue" alt="CCAvenue">
                                </a>
                                <a href="https://vakilsearch.com" target="_blank">
                                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/vakil-search.png" title="Vakil Search" alt="CCAvenue">
                                </a>
                                <a href="http://www.smscountry.com/" target="_blank">
                                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/SMS-country.png" title="SM Country" alt="CCAvenue">
                                </a>
                                <a href="https://www.keka.com/" target="_blank">
                                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/Keka.png" title="Keka" alt="CCAvenue">
                                </a>
                            </div>-->
                        </div>
                            <!-- <p class="btn-row text-center">
                                <a href="#" class="btn btn-theme ripple-effect btn-icon-left facebook wow fadeInDown" data-wow-offset="20" data-wow-delay="100ms"><i class="fa fa-facebook"></i>FACEBOOK</a>
                                <a href="#" class="btn btn-theme btn-icon-left ripple-effect twitter wow fadeInDown" data-wow-offset="20" data-wow-delay="200ms"><i class="fa fa-twitter"></i>TWITTER</a>
                                <a href="#" class="btn btn-theme btn-icon-left ripple-effect pinterest wow fadeInDown" data-wow-offset="20" data-wow-delay="300ms"><i class="fa fa-pinterest"></i>PINTEREST</a>
                                <a href="#" class="btn btn-theme btn-icon-left ripple-effect google wow fadeInDown" data-wow-offset="20" data-wow-delay="400ms"><i class="fa fa-google"></i>GOOGLE</a>
                            </p> -->
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="copyright">&copy; 2016 Meter Per Second — 
                                <a href="<?php echo $this->createUrl('Selfdrive/Privacypolicy'); ?>" target="_blank">Privacy Policy</a>
                                <a href="http://www.digitaltoday.co.in" target="_blank" class="pull-right">Powered by Digital Today</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- /FOOTER -->

        <div id="to-top" class="to-top"><i class="fa fa-angle-up"></i></div>

    </div>
    <!-- popup for login and sign up --> 
    <div class = "customer-signup modal fade" id = "signup-model_main" role = "dialog">   
        <div class = "modal-dialog">
            <div class = "modal-content pull-left">
                <button type = "button" class = "close" data-dismiss = "modal">&times;</button>       
                <div class = "modal-body pull-left">			
                    <div id="form2_m">
                        <ul id = "myTab" class = "nav nav-tabs">
                            <li class = "active">
                                <a href = "#logintab_main" data-toggle = "tab">Login</a>
                            </li>
                            <li>
                                <a href = "#signuptab_main" data-toggle = "tab">Sign Up</a>
                            </li>   
                        </ul>

                        <!---login block-->
                        <div id = "myTabContent" class = "tab-content">
                            <div class = "tab-pane fade in active" id = "logintab_main">
                                <div class="aside-signup col-md-5" id="content1_m">
                                    <h3 class="block-title">Login Today and You will be able to</h3>
                                    <ul class="list-check">
                                        <li>Online Order Status</li>
                                        <li>See Ready Hot Deals</li>
                                        <li>Love List</li>
                                        <li>Sign up to receive exclusive news and private sales</li>
                                        <li>Quick Buy Stuffs</li>
                                    </ul>
                                </div>			
                                <div id="errMessage" align="center" style="color:red;"></div>
                                <div class="col-md-7">	                    
                                    <input type="hidden" name="makes_idd" id="makes_idd">
                                    <input type="hidden" name="model_idd" id="model_idd">
                                    <div class="col-md-12">
                                        <div class="form-group"><input class="form-control" type="text" name="user_name_m" id="user_name_m" placeholder="User name or email" autofocus="" required="">
                                            <div id="usernameErr" style="color:red;padding-left:20px;"></div></div>
                                    </div>                               
                                    <div class="col-md-12">
                                        <div class="form-group"><input class="form-control" type="password" name="user_password_m" minlength="4" maxlength="4" id="user_password_m" placeholder="Enter Pin">
                                            <div id="passwordErr" style="color:red;padding-left:20px;"></div></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkbox pull-left">
                                            <input type="checkbox" name="remember" id="checkboxa1">
                                            <label for="checkboxa1">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a href="<?php echo Yii::app()->params['webURL'] . 'Login/Customer/ForgotPassword' ?>" class="forgot-password" target="_blank">forgot Pin?</a>
                                    </div>
                                    <div class="col-md-12 text-center mrg-top-20">								
                                        <div id="loginerror_login_m"></div>
                                        <input type="button" value="Login" id="login_btn1" name="login_btn1" class="btn btn-theme btn-theme-dark"/>
                                        <!--<a href = "#" onClick = "doLogin()" class="btn btn-fbook"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a>-->
                                    </div>	                        
                                    <div id="status1"></div>

                                </div>
                            </div>                   
                            <div class = "tab-pane fade" id = "signuptab_main">
                                <div class="aside-signup col-md-5" id="content1_m">
                                    <h3 class="block-title">Signup Today and You will be able to</h3>
                                    <ul class="list-check">
                                        <li>Online Order Status</li>
                                        <li>See Ready Hot Deals</li>
                                        <li>Love List</li>
                                        <li>Sign up to receive exclusive news and private sales</li>
                                        <li>Quick Buy Stuffs</li>
                                    </ul>
                                </div>

                                <div class="col-md-7">
                                    <div class="col-md-12">
                                        <div class="form-group"><input class="form-control alt" type="text" name="areguname_m" id="areguname_m" placeholder="Name" required>
                                            <div id="nameerror" style="color:red;padding-left:20px"></div></div>                                        
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                                    <!--<input class="form-control alt" type="text" name="aregemail_m" id="aregemail_m"  placeholder="Enter Email*" onkeyup="isValidEmailAddress();">-->
                                            <input class="form-control alt" type="text" name="aregemail_m" id="aregemail_m"  placeholder="Enter Email*"/>
                                            <div id="usernameerror" style="color:red;padding-left:20px"></div>
                                        </div>                                        
                                    </div>                    
                                    <div class="col-md-12">
                                        <div class="form-group has-icon has-label">
                                            <input type="text" class="form-control alt numeric" id="aregmobNo_m" name="aregmobNo_m" placeholder="Enter Mobile Number*" maxlength="10" required>
                                            <div id="mobileerror" style="color:red;padding-left:20px"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group"><input class="form-control alt" type="password" name="aregupwd_m" id="aregupwd_m" placeholder="Enter Pin*" minlength="4" maxlength="4" required>
                                            <div id="pwderror" style="color:red;padding-left:20px"></div></div>                                        
                                    </div>
                                    <!-- <div class="col-md-12">
                                        <div class="form-group"><input class="form-control alt" type="password" name="acpwd" id="acpwd" placeholder="Enter Confirm Password*" required></div>
                                        <div class="col-md-6">                    
                                    </div>
                                   </div> -->

                                    <div class="col-md-12 text-center mrg-top-20">
                                        <div id="emailerror1"></div>
                                        <!--<input type="button" value="Create Account" id="aregister_btn1" name="aregister_btn1" class="btn btn-theme btn-theme-dark" data-toggle="modal" data-target="#mps-otp">-->
                                        <input type="button" value="Create Account" id="aregister_btn1" name="aregister_btn1" class="btn btn-theme btn-theme-dark" data-toggle="modal">
                                    </div>
                                    <!--<div class="col-md-6 mrg-top-20">
                                         <a href="#" class="btn btn-theme btn-block btn-icon-left facebook"><i class="fa fa-facebook"></i>Sign in with Facebook</a>
                                     </div>-->
                                    <div class="col-md-6 mrg-top-20">

                                        <div id="status1"></div>
                                    </div>
                                </div>
                            </div>				   
                        </div>			
                    </div>	    

                </div>
                <!-- /.modal-content -->
            </div><!-- /.modal-dialog -->  
        </div><!-- /.Registration Sign up Modal -->
    </div>
    <!-- End popup for login and sign up --> 

    <!-- OTP Pop UP -->
    <div id="mps-otp" class="modal fade otp-popup" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div id="verifyform1_m">
                    <div class="verification-model">
                        <div class="dwn-app text-center">
                            <i class="fa fa-mobile animated" aria-hidden="true"></i>
                            <h4>OTP Verification</h4>
                        </div>
                        <input class="form-control" type="hidden" name="hidvalue1_m" id="hidvalue1_m" placeholder="User name or email">
                        <div class="col-md-12 otp-inputtxt">
                            <div class="form-group">
                                <input class="form-control alt text-center" type="text" name="bregemail" id="verifyidd_m"  placeholder="Enter Vericfication code*" required></div>
                                <span id="signotp_error"/></span>
                        </div>
                         
                        <div class="col-md-6 text-right">
                            <div id="emailerror1"></div>
                            <input type="button" value="Submit" id="averify_m" name="register" class="btn btn-theme submit-otp">
                        </div>
                        <div class="col-md-6 text-left">
                            <div id="emailerror"></div>
                            <div class="resend-icon">
                                <input type="button" value="ReSend" id="resendbtn" name="resendbtn" class="btn btn-theme btn-theme-dark submit-otp">
                            </div>
                        </div>
                        <span id="error"></span>					
                    </div>         
                </div>
            </div>
        </div>
    </div>
    <!-- End OTP Pop UP -->
    <!-- /WRAPPER -->

    <!-- JS Page Level -->

    <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/assets/js/bootstrap-multiselect.js"></script>
    <script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/theme-ajax-mail.js"></script>
    <script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/theme.js"></script>


</body>
</html>

<script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery('.numeric').keyup(function () {
                    this.value = this.value.replace(/[^0-9\.]/g, '');
                });
 window.oncontextmenu = function () {
   return false;
}
        $(document).keydown(function(e){
         if(e.which === 123){
            return false;
         }
     });

//Post the Form value through Ajax to Enquiry Controller
                jQuery("#submitForm").click(function () {
                    jQuery('#ajaxMessage').empty();
                    jQuery.ajax({
                        type: 'POST',
                        url: '<?php echo Yii::app()->params['webURL'] . 'Enquiry/Enquiry/ContactUs' ?>',
                        data: jQuery('form').serialize(),
                        success: function (data) {
                            var obj = jQuery.parseJSON(data);
                            if (obj.type == 'success') {
                                jQuery("#customernameError").html("");
                                jQuery("#customeremailError").html("");
                                jQuery("#phoneError").html("");
                                jQuery("#contentError").html("");
                                jQuery(':input', '#enquiry-from').val('');
                                jQuery('#ajaxMessage').append('<span class="suc-msg-title text-center"> Thank You, We Will Contact Soon </span>');
                            } else {
                                if (typeof obj.data.enquiry_name != 'undefined') {
                                    jQuery("#customernameError").html(obj.data.enquiry_name);
                                } else {
                                    jQuery("#customernameError").html("");
                                }
                                if (typeof obj.data.enquiry_email != 'undefined') {
                                    jQuery("#customeremailError").html(obj.data.enquiry_email);
                                } else {
                                    jQuery("#customeremailError").html("");
                                }
                                if (typeof obj.data.enquiry_phone != 'undefined') {
                                    jQuery("#phoneError").html(obj.data.enquiry_phone);
                                } else {
                                    jQuery("#phoneError").html("");
                                }
                                if (typeof obj.data.enquiry_content != 'undefined') {
                                    jQuery("#contentError").html(obj.data.enquiry_content);
                                } else {
                                    jQuery("#contentError").html("");
                                }
                            }
                        }
                    });
                });

            });
</script>
