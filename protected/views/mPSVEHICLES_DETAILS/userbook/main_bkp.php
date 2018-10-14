<?php

 
//echo $_GET['name'];

$data1=$_SERVER['PHP_SELF'];
$data=explode('/',$data1);

//echo Yii::app()->session['username'];

?>
<!DOCTYPE html>
<html lang="en">
   
<head>

   
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Metre Per Second</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo Yii::app()->baseUrl; ?>/assets/ico/favicon.ico">
    <!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>-->
	
    <!-- CSS Global -->
    <link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/fontawesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/prettyphoto/css/prettyPhoto.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/owl-carousel2/assets/owl.theme.default.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/animate/animate.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/swiper/css/swiper.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->baseUrl; ?>/assets/css/custom-styles.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/assets/css/bootstrap-multiselect.css" type="text/css">

    <!-- Theme CSS -->
    <link href="<?php echo Yii::app()->baseUrl; ?>/assets/css/theme.css" rel="stylesheet">
    <!-- Head Libs -->
    <script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/modernizr.custom.js"></script>
	
	<!-- JS Global -->
    <script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/jquery/jquery-1.11.1.min.js"></script>
	<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
	<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/superfish/js/superfish.min.js"></script>
	<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/prettyphoto/js/jquery.prettyPhoto.js"></script>
	<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/jquery.sticky.min.js"></script>
	<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/jquery.easing.min.js"></script>
	<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/jquery.smoothscroll.min.js"></script>

	<script>
		// WOW - animated content
		//new WOW().init();
	</script>

    <!--[if lt IE 9]>
    <script src="assets/plugins/iesupport/html5shiv.js"></script>
    <script src="assets/plugins/iesupport/respond.min.js"></script>
    <![endif]-->

<script>
  jQuery(document).ready(function()
		{
			$('#verifyform1').hide();
					 $('#btnsub1').click(function()
			{
		
		
		//customer vehicle added details
		
		
		var uname= $("#user_name").val();
		var password= $("#password").val();
		
		
		
		
		 $.post('Checklogin',{
						  uname:uname,
						  password:password,
						
						 
				 },
					 function(data)
					 {
					
					if(data==1)
					{
						$("#loginerror_login").html('<font color=red>Invalid username and password</font>');
					}
					else
					{
						window.location="AddVehicle";
					}
					 });  
	 });
			
	 $('#resendbtn1').click(function()
		{
			                a=$('#hidvalue1').val();
							$.post('<?php echo  $this->createUrl('mPSVEHICLES_DETAILS/Verify');?>',{
											  
										mobileno:$('#aregmobNo').val(),
										otp:a ,
											 
									 }, 
										 function(data)
										 {
											
										//alert(data);
							
									});
		});
		
		$('#aregister').click(function()
		{
			
					var a = Math.floor(100000 + Math.random() * 900000);		
							a = a.toString();
							a = a.substring(-2);
							$('#hidvalue1').val(a); 
								$.post('<?php echo  $this->createUrl('mPSVEHICLES_DETAILS/Verify');?>',{
											  
										mobileno:$('#aregmobNo').val(),
										otp:a ,
											 
									 }, 
										 function(data)
										 {
											
										console.log(data[0]);
										$('#content1').hide(); 
										$('#form2').hide(); 
										$('#verifyform1').show();
											$('#averify').click(function()
											{
												var b=$('#verifyidd').val();
												
												if(a==b)
												{
		 var regemail= $("#aregemail").val();
		 var upwd= $("#aregupwd").val();
		 var mobNo= $("#aregmobNo").val();
		var uname= $("#areguname").val();
	
		
		 $.post('RegisterCustlogin',{
						   regemail:regemail,
						   upwd:upwd,
						   mobNo:mobNo, 
						   uname:uname,
						  
						   
						   
				 },
				 
					 function(data)
					 {
					alert("Vericfication Successful");
					if(data==1)
					{
					 window.location="AddVehicle";
					}   
					 });  
														
												}
												else
												{
													$('#error').html( "<Strong>Vericfication Code error</strong>" );
												}
											});
			});
	
	 });
	 
		}); 
</script>
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
                    <a href="<?php echo Yii::app()->baseUrl; ?>"><img src="<?php echo Yii::app()->baseUrl; ?>/assets/img/logo-rentit.png" alt="Rent It"/></a>
                </div>
                <!-- /Logo -->

                <!-- Mobile menu toggle button -->
                <a href="#" class="menu-toggle btn ripple-effect btn-theme-transparent"><i class="fa fa-bars"></i></a>
                <!-- /Mobile menu toggle button -->
			
			<div class="topnav pull-right">
					<div class="pull-right dwn-app">
						<a href="" class="btn btn-submit btn-theme">Download App <i class="fa fa-mobile animated" aria-hidden="true"></i></a>
                    </div>
                    <div class="pull-right myaccount">
					<?php 
					
					if((Yii::app()->controller->action->id=="VehicleInfo" || Yii::app()->controller->action->id=="Booking" ||
					Yii::app()->controller->action->id=="loginuser" || Yii::app()->controller->action->id=="VehicleList" ||
					Yii::app()->controller->action->id=="Bookingsevicedetails" || Yii::app()->controller->action->id=="loginuser" || Yii::app()->controller->action->id=="Selfdrivedetails" || Yii::app()->controller->action->id=="Modificationdetails" || Yii::app()->controller->action->id=="Hiremechanicdetails" ||  Yii::app()->controller->action->id=="Vehicleguidedetails"
					|| Yii::app()->controller->action->id=="Savebookservice" || Yii::app()->controller->action->id=="saveVehicle" || Yii::app()->controller->action->id=="AddVehicle") && !empty(Yii::app()->session['username']))
					{
						//echo Yii::app()->controller->action->id;
						echo ' <a href="#" class="dropdown-toggle" data-toggle = "modal" data-target = "#myModalpartner">Partner With Us</a>
								<a href="#" class="dropdown-toggle">Add your vehicle</a>
								<div class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome '.Yii::app()->session['username'].' <b class="caret"></b></a>							
			                        <ul class="dropdown-menu">
			                            <li><a href="'.$this->createUrl('mPSVEHICLES_DETAILS/VehicleList').'">My Vehicles</a></li>							
			                            <li><a href="">My Orders</a></li>
			                            <li><a href="">Settings</a></li>
			                            <li><a href="'.$this->createUrl('mPSVEHICLES_DETAILS/Dashboard').'">Logout</a></li>
			                        </ul>
		                        </div>';
					}
					
					else if(isset($_GET['name']))
					{
						 Yii::app()->session['username']=$_GET['name'];
						 echo '<a href="#" class="dropdown-toggle" data-toggle = "modal" data-target = "#myModalpartner">Partner With Us</a>
						 	   <a href="" class="dropdown-toggle">Add your vehicle</a>
								 <div class="dropdown">
									 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome '.$_GET['name'].' <b class="caret"></b></a>						
				                        <ul class="dropdown-menu">
				                            <li><a href="'.$this->createUrl('mPSVEHICLES_DETAILS/VehicleList').'">My Vehicles</a></li>
				                            <li><a href="">My Orders</a></li>
				                            <li><a href="">Settings</a></li>
				                            <li><a href="'.$this->createUrl('mPSVEHICLES_DETAILS/Dashboard').'">Logout</a></li>
				                        </ul>
			                    </div>'; 
						
					}
					   else if((count($data) > 3) && !empty(Yii::app()->session['username']))
					{
						//echo 'else';
						 echo '<a href="#" class="dropdown-toggle" data-toggle = "modal" data-target = "#myModalpartner">Partner With Us</a>
						 	   <a href="" class="dropdown-toggle">Add your vehicle</a>
						 	   <div class="dropdown">
							 	   <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome '.Yii::app()->session['username'].' <b class="caret"></b></a>
			                        <ul class="dropdown-menu">
			                            <li><a href="'.$this->createUrl('mPSVEHICLES_DETAILS/VehicleList').'">My Vehicles</a></li>
			                            <li><a href="">My Orders</a></li>
			                            <li><a href="">Settings</a></li>
			                            <li><a href="'.$this->createUrl('mPSVEHICLES_DETAILS/Dashboard').'">Logout</a></li>
			                        </ul>
			                    </div>'; 
					}  
					  else if((count($data) < 3) && !empty(Yii::app()->session['username']))
					{
						//echo 'igkjklf';
						 echo '<a href="#" class="dropdown-toggle" data-toggle = "modal" data-target = "#myModalpartner">Partner With Us</a>
						 	   <a href="" class="dropdown-toggle">Add your vehicle</a>
						 	<div class="dropdown">
						 	   	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome '.Yii::app()->session['username'].' <b class="caret"></b></a>		
		                        <ul class="dropdown-menu">
		                            <li><a href="'.$this->createUrl('mPSVEHICLES_DETAILS/VehicleList').'">My Vehicles</a></li>
		                            <li><a href="">My Orders</a></li>
		                            <li><a href="">Settings</a></li>
		                            <li><a href="'.$this->createUrl('mPSVEHICLES_DETAILS/Dashboard').'">Logout</a></li>
		                        </ul>
		                    </div>'; 
					}   
					else if(empty(Yii::app()->session['username']))
					{
						//echo 'k;d'.Yii::app()->session['username'];
						echo '<a href="#" class="dropdown-toggle" data-toggle = "modal" data-target = "#myModalpartner">Partner With Us</a>
						      <a href="#" class="dropdown-toggle" data-toggle = "modal" data-target = "#signup-model">Register/Login</a>';
					
					}
					else{
						//echo 'fjflk;dhk;';
						echo '<a href="#" class="dropdown-toggle" data-toggle = "modal" data-target = "#myModalpartner">Partner With Us</a>
							  <a href="" class="dropdown-toggle">Add your vehicle</a>
							  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome '.Yii::app()->session['username'].' <b class="caret"></b></a>
							<div class="dropdown">
		                        <ul class="dropdown-menu">
		                            <li><a href="'.$this->createUrl('mPSVEHICLES_DETAILS/VehicleList').'">My Vehicles</a></li>
		                            <li><a href="">My Orders</a></li>
		                            <li><a href="">Settings</a></li>
		                            <li><a href="'.$this->createUrl('mPSVEHICLES_DETAILS/CustLogin').'">Logout</a></li>
		                        </ul>
	                        </div>'; 
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
                            <li class="<?php if(Yii::app()->controller->action->id=="Booking") echo "active";?>">
							
							
							<a href="<?php echo $this->createUrl('mPSVEHICLES_DETAILS/Booking');?>">Book a Service</a></li>
							
                                <li class="<?php if(Yii::app()->controller->id=="selfdrive") echo "active";?>">
								<a href="<?php echo $this->createUrl('Selfdrive/');?>">Self Drive</a>
								
                                    <!-- <ul>
                                        <li><a href="index.html">Home 1</a></li>
                                        <li><a href="index-2.html">Home 2</a></li>
                                        <li><a href="index-3.html">Home 3</a></li>
                                        <li><a href="index-4.html">Home 4</a></li>
                                        <li><a href="index-5.html">Home 5</a></li>
                                        <li><a href="index-6.html">Home 6</a></li>
                                    </ul> -->
                                </li>
                                <li class="<?php if(Yii::app()->controller->id=="hireMechanic") echo "active";?>">
								
								<a href="<?php echo $this->createUrl('HireMechanic/');?>">Hire a Mechanic</a></li>
								
								
                                <li class="<?php if(Yii::app()->controller->id=="modificationshop") echo "active";?>">
								
								<a href="<?php echo $this->createUrl('Modificationshop/');?>">Modifications</a></li>
								
								
                                <li class="<?php if(Yii::app()->controller->id=="vehicleGuide") echo "active";?>">
								
								<a href="<?php echo $this->createUrl('VehicleGuide/');?>">Vehicle Guide</a>
								
                                  <!-- <ul>
                                        <li class="row">
                                            <div class="col-md-3">
                                                <h4 class="block-title"><span>Paragraph</span></h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
                                                <p>Suspendisse molestie est nec tortor placerat, vel pellentesque metus sollicitudin. Suspendisse congue sem mauris, at ultrices felis blandit non.</p>
                                            </div>
                                            <div class="col-md-3">
                                                <h4 class="block-title"><span>Portfolio</span></h4>
                                                <ul>
                                                    <li><a href="portfolio.html">Portfolio 3 Columns</a></li>
                                                    <li><a href="portfolio-4col.html">Portfolio 4 Columns</a></li>
                                                    <li><a href="portfolio-alt.html">Portfolio Alternate</a></li>
                                                    <li><a href="portfolio-single.html">Portfolio Single</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-md-3">
                                                <h4 class="block-title"><span>Pages</span></h4>
                                                <ul>
                                                    <li><a href="shortcodes.html">Shortcodes</a></li>
                                                    <li><a href="typography.html">Typography</a></li>
                                                    <li><a href="coming-soon.html">Coming soon</a></li>
                                                    <li><a href="error-page.html">404 Page</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-md-3">
                                                <h4 class="block-title"><span>Pages</span></h4>
                                                <ul>
                                                    <li><a href="car-listing.html">Car Listing</a></li>
                                                    <li><a href="booking.html">Booking & Payment</a></li>
                                                    <li><a href="about.html">About</a></li>
                                                    <li><a href="login.html">Login</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul> -->
                                </li>
                                <li>
                                    <ul class="social-icons">
                                        <li><a href="https://www.facebook.com/profile.php?id=100012273646277" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="https://twitter.com/metreper_second" class="twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
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
 <input type="hidden" name="lastid" id="lastid" value="<?php echo Yii::app()->session['lastid'];?>">
		<!--<input type="" name="txt" id="">-->
	<?php echo $content; ?>
	</div>
	    <!-- /CONTENT AREA -->

	<div class="clear"></div>

    <!-- Create Account Model box -->
                          
               <!-- End Create Account Model box -->
	
	
<!--partnership-->
<div id="myModalpartner" class="modal fade register-model" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Client Details</h4>
                  </div>
                  <div class="modal-body">
				
                  <form action="#" id="formpartner" class="create-account">
                   <div class="col-md-12">
                         <label for="formFindCarCategory"></label>
                                <select class="form-control alt" name="clist" id="clist">
                                	<option>Select Partner</option>
                                	<option value="1">Mechanic Shop</option>
                                	<option value="2">Self Drive</option>
									<option value="3">Modification</option>
                                </select>
                    </div>
               
                  <br/> <br/> <br/>
				  
				  <div id="mech_shop">
				    <fieldset>
						<legend>Mechanic Shop:</legend>
				   <label class="col-md-6 control-label">Shop Name:</label>
                                            <div class="col-md-6">
                        <div class="form-group"><input class="form-control alt" type="text" name="shopnm" id="shopnm"  placeholder="Enter Shop Name*" required></div>
                    </div>
					  <label class="col-md-6 control-label">Owner Name:</label>
                              <div class="col-md-6">
                        <div class="form-group"><input class="form-control alt" type="text" name="ownernm" id="ownernm"  placeholder="Enter Shop Owner Name*" required></div>
                    </div>
					
					  <label class="col-md-6 control-label">Email:</label>
                                            <div class="col-md-6">
                        <div class="form-group"><input class="form-control alt" type="text" name="shopemail" id="shopemail"  placeholder="Enter EmailId*" required></div>
						</div>
						 <label class="col-md-6 control-label">Contact:</label>
                                            <div class="col-md-6">
                        <div class="form-group"><input class="form-control alt" type="text" name="shopcon" id="shopcon"  placeholder="Enter Contact Number*" required></div>
						</div>
					
                        <label class="col-md-6 control-label">Services offerd</label>
                        <div class="col-md-6">
                            <select id="typeofservices" class="form-control alt" name="typeofservices[]" multiple="multiple" required>
                                <option value="selected">General Service</option>
                                <option>Periodic Service</option>
                                <option>Denting</option>
                                <option>Washing</option>
                                <option>Oil Service</option>
                            </select>
							  <br/>
                        </div>
                           
					 <label class="col-md-6 control-label">Address:</label>
                                            <div class="col-md-6">
                        <div class="form-group">
						<textarea class="form-control alt" name="mechadrs" id="mechadrs" placeholder="Enter Shop Address" required></textarea>
						</div>
						
                    </div>
					   <label class="col-md-6 control-label">Number Of Mechanics:</label>
                                            <div class="col-md-6">
                        <div class="form-group"><input class="form-control alt" type="text" name="nummech" id="nummech"  placeholder="Enter Number of Mechanics*" required></div>
                    </div>
					</fieldset>
				     <div class="col-md-12 text-center"><input type="button" value="Done" id="mechsub" name="mechsub" class="col-md-12 btn btn-theme"></div>
				  </div>
				  
				   <div id="self_shop">
				   
				    <fieldset>
						<legend>Self Drive Agency:</legend>
				      <label class="col-md-6 control-label">Agency Name:</label>
                                            <div class="col-md-6">
                        <div class="form-group"><input class="form-control alt" type="text" name="agnm" id="agnm"  placeholder="Enter Agency Name*" required></div>
                    </div>
					    <label class="col-md-6 control-label">Email:</label>
                                            <div class="col-md-6">
                        <div class="form-group"><input class="form-control alt" type="text" name="agemail" id="agemail"  placeholder="Enter Enter Email ID*" required></div>
                    </div>
					    <label class="col-md-6 control-label">Contact No:</label>
                                            <div class="col-md-6">
                        <div class="form-group"><input class="form-control alt" type="text" name="selfcon" id="selfcon"  placeholder="Enter Contact No.*" required></div>
						
                    </div>
					  <label class="col-md-6 control-label">Address:</label>
                                            <div class="col-md-6">
                        <div class="form-group">
						<textarea class="form-control alt" name="selfadrs" id="selfadrs" placeholder="Enter Shop Address"></textarea>
						
						</div>
						
                    </div>
					 </fieldset>
				   <div class="col-md-12 text-center"><input type="button" value="Done" id="selfshop" name="selfshop" class="col-md-12 btn btn-theme"></div>
				  </div>
                 
                   <!--<div class="col-md-6 mrg-top-20">
                        <a href="#" class="btn btn-theme btn-block btn-icon-left facebook"><i class="fa fa-facebook"></i>Sign in with Facebook</a>
                    </div>-->
					
				
                   
                    </form>
                   </div>
                  </div>
                </div>

              </div>			  
<!-- PAGE -->
        <section class="page-section subscribe">
            <div class="container">
                <!-- Get in touch -->

                <h2 class="section-title">
                    <small>Feel Free to Say Hello!</small>
                    <span>Get in Touch With Us</span>
                </h2>
                        <!-- Contact form -->
                        <div  class="contact-form alt" id="contact-form">

                            <div class="row">
                                <div class="col-md-6">
			                        <ul class="media-list contact-list">
			                            <li class="media">
			                                <div class="media-left"><i class="fa fa-phone"></i></div>
			                                <div class="media-body">Support Phone: 040 42425539</div>
			                            </li>
			                            <li class="media">
			                                <div class="media-left"><i class="fa fa-envelope"></i></div>
			                                <div class="media-body">E mails: support@metrepersecond.com</div>
			                            </li>
			                            <li class="media">
			                                <a href="https://www.facebook.com/profile.php?id=100012273646277" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a>
			                                <a href="https://twitter.com/metreper_second" class="twitter" target="_blank"><i class="fa fa-twitter"></i></a>
			                            </li>
			                        </ul>
                    			</div>

                                <div class="col-md-6">
                                   
							
<script>

$(document).ready(function()
	{
		$("#submit").click(function() 
		{
				name=$('#name').val();
				email=$('#email').val();
				message=$('#message').val();
				
				$.post('<?php echo $this->createUrl('mPSVEHICLES_DETAILS/getintouch');?>',{
				  
							name:name,
							email:email,
							message:message
						},
						function(data)
						{
							alert(data);
							/* var form=document.createElement('form');
							form.setAttribute('method','post');
							form.setAttribute('action','getintouch');
							document.body.appendChild(form);
							form.submit(); */
						});
			});
		});
</script>
 							<div class="outer required">
                                        <div class="form-group af-inner has-icon">
                                            <label class="sr-only" for="name">Name</label>
                                            <input type="text"  id="name" placeholder="Name" value="" size="30"
                                                    data-toggle="tooltip" title="Name is required"
                                                    class="form-control placeholder"/>
                                            <span class="form-control-icon"><i class="fa fa-user"></i></span>
                                        </div>
                                    </div>
                                    <div class="outer required">
                                        <div class="form-group af-inner has-icon">
                                            <label class="sr-only" for="email">Email</label>
                                            <input type="text" id="email" placeholder="Email" value="" size="30"
                                                    data-toggle="tooltip" title="Email is required"
                                                    class="form-control placeholder"/>
                                            <span class="form-control-icon"><i class="fa fa-envelope"></i></span>
                                        </div>
                                    </div>

                            
                            <div class="form-group af-inner has-icon">
                                <label class="sr-only" for="input-message">Message</label>
                                <textarea  id="message" placeholder="Message" rows="4" cols="50"
                                        data-toggle="tooltip" title="Message is required"
                                        class="form-control placeholder"></textarea>
                                <span class="form-control-icon"><i class="fa fa-bars"></i></span>
                            </div>

                            <div class="outer required">
                                <div class="form-group af-inner">
                                    <button id="submit" class="form-button form-button-submit btn btn-block btn-theme" >Send message</button>
                                </div>
                            </div>
</div>
                      </div>
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
                    <div class="col-sm-6">
                    <a href="https://msg91.com/startups/?utm_source=startup-banner">
                    <span class="smsprt">Our SMS Partner</span><br><img src="https://msg91.com/images/startups/msg91Badge.png" width="72" title="MSG91 - SMS for Startups" alt="Bulk SMS - MSG91"></a>
                    </div>
                        <!-- <p class="btn-row text-center">
                            <a href="#" class="btn btn-theme ripple-effect btn-icon-left facebook wow fadeInDown" data-wow-offset="20" data-wow-delay="100ms"><i class="fa fa-facebook"></i>FACEBOOK</a>
                            <a href="#" class="btn btn-theme btn-icon-left ripple-effect twitter wow fadeInDown" data-wow-offset="20" data-wow-delay="200ms"><i class="fa fa-twitter"></i>TWITTER</a>
                            <a href="#" class="btn btn-theme btn-icon-left ripple-effect pinterest wow fadeInDown" data-wow-offset="20" data-wow-delay="300ms"><i class="fa fa-pinterest"></i>PINTEREST</a>
                            <a href="#" class="btn btn-theme btn-icon-left ripple-effect google wow fadeInDown" data-wow-offset="20" data-wow-delay="400ms"><i class="fa fa-google"></i>GOOGLE</a>
                        </p> -->
                        <div class="col-sm-6">
                        <div class="copyright">&copy; 2016 Meter Per Second — powered by Digital Today</div>
                    </div>

                </div>
            </div>
        </div>
    </footer>
    <!-- /FOOTER -->

    <div id="to-top" class="to-top"><i class="fa fa-angle-up"></i></div>

</div>
 
<div class = "customer-signup modal fade" id = "signup-model" tabindex = "-1" role = "dialog" 
   aria-labelledby = "myModalLabel" aria-hidden = "true">
   
   <div class = "modal-dialog">
      <div class = "modal-content pull-left">
      <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">&times;</button>       
         <div class = "modal-body pull-left">
            <div class="aside-signup col-md-4" id="content1">
                <h3 class="block-title">Signup Today and You will be able to</h3>
                    <ul class="list-check">
                        <li>Online Order Status</li>
                        <li>See Ready Hot Deals</li>
                        <li>Love List</li>
                        <li>Sign up to receive exclusive news and private sales</li>
                        <li>Quick Buy Stuffs</li>
                    </ul>
            </div>
			
			<div id="verifyform1">
				   <input class="form-control" type="hidden" name="hidvalue1" id="hidvalue1" placeholder="User name or email">
				     <div class="col-md-12">
                        <div class="form-group"><input class="form-control alt" type="text" name="bregemail" id="verifyidd"  placeholder="Enter Vericfication code*" required></div>
                    </div>
					 <div class="col-md-3 text-center"> <div id="emailerror1"></div><input type="button" value="Submit" id="averify" name="register" class="col-md-12 btn btn-theme"></div>
					  <div class="col-md-3 text-center"> <div id="emailerror"></div><input type="button" value="ReSend" id="resendbtn1" name="resendbtn1" class="col-md-12 btn btn-theme"></div>
					<span id="error"></span>
					
				  </div>
			<div class="col-md-8" id="form2">
                <ul id = "myTab" class = "nav nav-tabs">
                    <li class = "active">
                        <a href = "#logintab" data-toggle = "tab">Login</a>
                    </li>
                    <li>
                        <a href = "#signuptab" data-toggle = "tab">Sign Up</a>
                    </li>   
                </ul>

				
				<!---login block-->
				<div id = "myTabContent" class = "tab-content">
                   <div class = "tab-pane fade in active" id = "logintab">
                      <div class="col-sm-12">
                        
						<input type="hidden" name="makes_idd" id="makes_idd">
				        <input type="hidden" name="model_idd" id="model_idd">
                                <div class="col-md-12">
                                    <div class="form-group"><input class="form-control" type="text" name="user_name" id="user_name" placeholder="User name or email"></div>
                                </div>                               
                                <div class="col-md-12">
                                    <div class="form-group"><input class="form-control" type="password" name="user_password" id="user_password" placeholder="Enter Password"></div>
                                </div>
                                <div class="bottomservice-btn overflowed reservation-now col-md-12 col-lg-6">
                                    <div class="checkbox pull-left">
                                        <input type="checkbox" name="remember" id="checkboxa1">
                                        <label for="checkboxa1">Remember me</label>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6 text-right-lg">
                                    <a href="#" class="forgot-password">forgot password?</a>
                                </div>
                                <div class="col-md-12 text-center">
								
								<div id="loginerror_login"></div>
								<input type="button" value="Login" id="btnsub1" name="btnsub1" class="btn btn-theme btn-block btn-theme-dark"/></div>
                               <div class="col-md-6 mrg-top-20">
                       	<fb:login-button size='large' show_faces='false'  onlogin="checkLoginState();">
								</fb:login-button>
								<div id="status1">
									</div>
                    </div>
                                                               
                                
                        
                    </div>
                   </div>                   
                   <div class = "tab-pane fade" id = "signuptab">
				 
                     <div class="col-md-12">
                        <div class="form-group"><input class="form-control alt" type="text" name="aregemail" id="aregemail"  placeholder="Enter Email*" required></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"><input class="form-control alt" type="text" name="areguname" id="areguname" placeholder="Name" required></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group has-icon has-label">
                            <input type="text" class="form-control alt" id="aregmobNo" name="aregmobNo" placeholder="Enter Mobile Number*" maxlength="10" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"><input class="form-control alt" type="password" name="regupwd" id="regupwd" placeholder="Enter Password*" required></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"><input class="form-control alt" type="password" name="acpwd" id="acpwd" placeholder="Enter Confirm Password*" required></div>
                        <div class="col-md-6">                    
                    </div>
                   </div>
				  
                    <div class="col-md-12 text-center"> <div id="emailerror1"></div><input type="button" value="Create Account" id="aregister" name="aregister" class="col-md-12 btn btn-theme"></div>
                   <!--<div class="col-md-6 mrg-top-20">
                        <a href="#" class="btn btn-theme btn-block btn-icon-left facebook"><i class="fa fa-facebook"></i>Sign in with Facebook</a>
                    </div>-->
					<div class="col-md-6 mrg-top-20">
                       	<fb:login-button size='large' show_faces='false'  onlogin="checkLoginState();">
								</fb:login-button>
								<div id="status1">
									</div>
                    </div>
                   </div>
				   
            </div>
			
         </div>
         
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
  
</div><!-- /.Registration Sign up Modal -->
</div>

<!-- /WRAPPER -->

	<!-- JS Page Level -->
	
	<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/assets/js/bootstrap-multiselect.js"></script>
	<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/theme-ajax-mail.js"></script>
	<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/theme.js"></script>


</body>
<script>
  jQuery(document).ready(function()
		{
			    $('#mech_shop').show();
			    $('#self_shop').hide();
			
			$('#clist').change(function()
			{
				
				val=$('#clist').val();
				if(val==1)
				{
					$('#mech_shop').show();
					$('#self_shop').hide();
				}
				else if(val==2)
				{
					$('#mech_shop').hide();
					$('#self_shop').show();
				}
			});
			
			$('#mechsub').click(function()
			{
				    shopnm=$('#shopnm').val();
					ownernm=$('#ownernm').val();
					selfemail=$('#selfemail').val();
					mechadrs=$('#mechadrs').val();
					$.post('PartnersInfo',{
											  
										shopnm:shopnm,
										ownernm:ownernm,
										selfemail:selfemail,
										mechadrs:mechadrs,
											 
									 }, 
										 function(data)
										 {
											
										//alert(data);
							
									});
				
			});
			
				
			
			
		});
		</script>
</html>
