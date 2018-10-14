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
    <div id="fb-root"></div>
        <script type="text/javascript">
		
         
			
        </script>
<script>
var i=0;
  // Additional JS functions here
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '965036556905750', // App ID
      channelUrl : '//192.168.1.127/test/channel.html', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });

    // Additional init code here
 
  };

  function login() {
    FB.login(function(response) {
      if (response.authResponse) {
       if(i==0)
	   {
	   testAPI() ;
	   }else
	   {
		   testAPI1() ;
	   }
      } else {
        // cancelled
      }
    });
  }

	 function doLogin(){
	 
    FB.getLoginStatus(function(response) {
      if (response.status === 'connected') {
    login();
      } else if (response.status === 'not_authorized') {
        // not_authorized
        login();
      } else {
        // not_logged_in
       login();
      }
    });
  }
  function testAPI1() {
   
    FB.api('/me',{fields: 'gender, first_name, last_name, email,name'}, function(response) {
      console.log(response);
	     $.post('<?php echo  $this->createUrl('Orders/fblogin');?>',{
											regemail:response.email,										
											uname:response.name,
											id:response.id
						  
						   
						   
										},
				 
										function(data)
										{
											
											if(data==1)
											{
												/* if(carDetailsval=='CarDetails')
											{
												window.location="CarServiceOrderSummary?amount=<?php echo $payamount;?>&pickadrs="+pickadrs+"&picdate="+pickdate+"&pickhr="+pickhr;
											} */
											window.location="<?php echo  $this->createUrl('mPSVEHICLES_DETAILS/AddVehicle');?>";
											}   
										}); 
	  
    });
  }

  // Load the SDK Asynchronously
  (function(d){
    var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
    if (d.getElementById(id)) {return;}
      js = d.createElement('script'); js.id = id; js.async = true;
      js.src = "//connect.facebook.net/en_US/all.js";
      ref.parentNode.insertBefore(js, ref);
  }(document));


			
	 function ValidateEmail(email) {
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return expr.test(email);
    };
	

		function myfunction()
		{
			
		}
		
		$(function() {
			
			
			
			
		});

  jQuery(document).ready(function()
		{
			$("#fblogin").click(function()
			{
				i=1;
			});
			
			//$('#verifyform1_m').hide();
			$('#login_btn1').click(function()
			{
		
		
		//customer vehicle added details
		
		
		var uname= $("#user_name_m").val();
		var password= $("#user_password_m").val();
		
		
		
		
		 $.post('<?php echo  $this->createUrl('mPSVEHICLES_DETAILS/Checklogin');?>',{
						  uname:uname,
						  password:password,
						
						 
				 },
					 function(data)
					 {
					actionval="<?php echo Yii::app()->controller->action->id;?>";
					actionvalref="<?php echo  $_SERVER['HTTP_REFERER'];?>";
					
					if(data==1)
					{
						$("#loginerror_login_m").html('<div class="has-error">Invalid username and password</div>');
					}
					else
					{
						
											if(actionval=='CarDetails')
											{
												window.location="<?php echo  $this->createUrl('mPSVEHICLES_DETAILS/CarDetails');?>";
											}
											
											else if(actionval=='AddVehicle')
											{
												window.location="<?php echo  $this->createUrl('mPSVEHICLES_DETAILS/AddVehicle');?>";
											}
											else if(actionval=='Booking')
											{
												window.location="<?php echo  $this->createUrl('mPSVEHICLES_DETAILS/Booking');?>";
											}
											else if(actionval=='HireMechanic')
											{
												window.location="<?php echo  $this->createUrl('mPSVEHICLES_DETAILS/HireMechanic');?>";
											}
											else if(actionval=='Dashboard')
											{
												window.location="<?php echo  $this->createUrl('mPSVEHICLES_DETAILS/AddVehicle');?>";
											}
											else if(actionval=='actionvalref')
											{
												window.location="<?php echo  $this->createUrl('mPSVEHICLES_DETAILS/Selfdrive');?>";
											}
											
					}
					 });  
	 });
			
	 $('#resendbtn').click(function()
		{
			                a=$('#hidvalue1_m').val();
							$.post('<?php echo  $this->createUrl('mPSVEHICLES_DETAILS/Verify');?>',{
											  
										mobileno:$('#aregmobNo_m').val(),
										otp:a ,
											 
									 }, 
										 function(data)
										 {
											
										//alert(data);
							
									});
		});
	
	//face book 
	  
	
	
	
	//
		$('#aregister_btn1').click(function()
		{
					
		
			
					
					
					var regemail= $("#aregemail_m").val();
					var upwd= $("#aregupwd_m").val();
					var mobNo= $("#aregmobNo").val();
					var uname= $("#areguname_m").val();
					if(regemail == '' || upwd == '' || mobNo == '' || uname == '')
					{
						
						
							if(uname =='')
							{
								$("#nameerror").html('<font color="red">Please enter username</font>');
							}
							else if(regemail == ''){
								$("#emailerr").html('<font color="red">Please enter EmailId</font>');
								$("#nameerror").html('');
								
							}
							else if(upwd == ''){
								$("#pwderr").html('<font color="red">Please enter password</font>');
								$("#nameerror").html('');
								$("#emailerr").html('');
							}
							else if(mobNo == ''){
								$("#mobileerr").html('<font color="red">Please enter mobile number</font>');
								$("#nameerror").html('');
								$("#emailerr").html('');
								$("#pwderr").html('');
							}
							else
							{
								$("#nameerror").html('<font color="red">Please enter username</font>');
								$("#emailerr").html('<font color="red">Please enter EmailId</font>');
								$("#mobileerr").html('<font color="red">Please enter mobile number</font>');
								$("#pwderr").html('<font color="red">Please enter password</font>');
								
							}
								$("#nameerror").html('<font color="red">Please enter username</font>');
								$("#emailerr").html('<font color="red">Please enter EmailId</font>');
								$("#mobileerr").html('<font color="red">Please enter mobile number</font>');
								$("#pwderr").html('<font color="red">Please enter password</font>');
								$('#signup-model_main').modal('show');
								return false;
							}

					//else{
						$('#signup-model_main').modal('toggle');
					/*else
					  */
						/*  if (!ValidateEmail($("#aregemail_m").val())) {
							
								$("#emailerr").html('<font color="red">Invalid email address</font>');
								return false;
							} */
							
							var a = Math.floor(100000 + Math.random() * 900000);		
							a = a.toString();
							a = a.substring(-2);
							$('#hidvalue1_m').val(a); 
							$.post('<?php echo  $this->createUrl('mPSVEHICLES_DETAILS/Verify');?>',{
											  
										mobileno:$('#aregmobNo').val(),
										otp:a ,
											 
								}, 
										 function(data)
										 {
											
										console.log(data[0]);
										//$('#content1_m').hide(); 
										//$('#form2_m').hide(); 
										
										//$('#verifyform1_m').show();
											$('#averify_m').click(function()
											{
												var b=$('#verifyidd_m').val();
												
									if(a==b)
									{
											var regemail= $("#aregemail_m").val();
											var upwd= $("#aregupwd_m").val();
											var mobNo= $("#aregmobNo").val();
											var uname= $("#areguname_m").val();
	
		
											$.post('<?php echo  $this->createUrl('mPSVEHICLES_DETAILS/RegisterCustlogin');?>',{
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
												
											 window.location="<?php echo  $this->createUrl('mPSVEHICLES_DETAILS/AddVehicle');?>";
											}   
										});  
														
									}
												else
												{
													//$('#error').html( "<Strong>Vericfication Code error</strong>" );
												}
											});
								});
								//return true;
		//}
	
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
						echo ' <a href="'.$this->createUrl('partnership/Partners').'" class="dropdown-toggle">Partner With Us</a>
								<a href="#" class="dropdown-toggle">Add your vehicle</a>
								<div class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome '.Yii::app()->session['username'].' <b class="caret"></b></a>							
			                        <ul class="dropdown-menu">
			                            <li><a href="'.$this->createUrl('mPSVEHICLES_DETAILS/VehicleList').'">My Vehicles</a></li>							
			                            <li><a href="'.$this->createUrl('Orders/').'">My Orders</a></li>
			                           <li><a href="">Settings</a></li>';
									
		                          echo '  <li><a href="'.$this->createUrl('mPSVEHICLES_DETAILS/Dashboard').'">Logout</a></li>';
								
		                       echo ' </ul>
		                        </div>';
					}
					
					else if(isset($_GET['name']))
					{
						 Yii::app()->session['username']=$_GET['name'];
						 echo '<a href="'.$this->createUrl('partnership/Partners').'" class="dropdown-toggle">Partner With Us</a>
						 	   <a href="" class="dropdown-toggle">Add your vehicle</a>
								 <div class="dropdown">
									 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome '.$_GET['name'].' <b class="caret"></b></a>						
				                        <ul class="dropdown-menu">
				                            <li><a href="'.$this->createUrl('mPSVEHICLES_DETAILS/VehicleList').'">My Vehicles</a></li>
				                            <li><a href="'.$this->createUrl('Orders/').'">My Orders</a></li>
				                             <li><a href="">Settings</a></li>';
									
								
		                          echo '  <li><a href="'.$this->createUrl('mPSVEHICLES_DETAILS/Dashboard').'">Logout</a></li>';
									
		                       echo ' </ul>
			                    </div>'; 
						
					}
					   else if((count($data) > 3) && !empty(Yii::app()->session['username']))
					{
						//echo 'else';
						 echo '<a href="'.$this->createUrl('partnership/Partners').'" class="dropdown-toggle">Partner With Us</a>
						 	   <a href="" class="dropdown-toggle">Add your vehicle</a>
						 	   <div class="dropdown">
							 	   <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome '.Yii::app()->session['username'].' <b class="caret"></b></a>
			                        <ul class="dropdown-menu">
			                            <li><a href="'.$this->createUrl('mPSVEHICLES_DETAILS/VehicleList').'">My Vehicles</a></li>
			                            <li><a href="'.$this->createUrl('Orders/').'">My Orders</a></li>
			                            <li><a href="">Settings</a></li>';
								
		                          echo '  <li><a href="'.$this->createUrl('mPSVEHICLES_DETAILS/Dashboard').'">Logout</a></li>';
									
		                       echo ' </ul>
			                    </div>'; 
					}  
					  else if((count($data) < 3) && !empty(Yii::app()->session['username']))
					{
						//echo 'igkjklf';
						 echo '<a href="'.$this->createUrl('partnership/Partners').'" class="dropdown-toggle">Partner With Us</a>
						 	   <a href="" class="dropdown-toggle">Add your vehicle</a>
						 	<div class="dropdown">
						 	   	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome '.Yii::app()->session['username'].' <b class="caret"></b></a>		
		                        <ul class="dropdown-menu">
		                            <li><a href="'.$this->createUrl('mPSVEHICLES_DETAILS/VehicleList').'">My Vehicles</a></li>
		                            <li><a href="'.$this->createUrl('Orders/').'">My Orders</a></li>
		                             <li><a href="">Settings</a></li>';
									
		                          echo '  <li><a href="'.$this->createUrl('mPSVEHICLES_DETAILS/Dashboard').'">Logout</a></li>';
									
		                       echo ' </ul>
		                    </div>'; 
					}   
					else if(empty(Yii::app()->session['username']))
					{
						//echo 'k;d'.Yii::app()->session['username'];
						echo '<a href="'.$this->createUrl('partnership/Partners').'" class="dropdown-toggle">Partner With Us</a>
						      <a href="#" class="dropdown-toggle" data-toggle = "modal" id="fblogin" data-target = "#signup-model_main">Register / Login</a>';
					
					}
					else{
						//echo 'fjflk;dhk;';
						echo '<a href="'.$this->createUrl('partnership/Partners').'" class="dropdown-toggle">Partner With Us</a>
							  <a href="" class="dropdown-toggle">Add your vehicle</a>
							  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome '.Yii::app()->session['username'].' <b class="caret"></b></a>
							<div class="dropdown">
		                        <ul class="dropdown-menu">
		                            <li><a href="'.$this->createUrl('mPSVEHICLES_DETAILS/VehicleList').'">My Vehicles</a></li>
		                            <li><a href="'.$this->createUrl('Orders/').'">My Orders</a></li>
		                            <li><a href="">Settings</a></li>';
									
		                          echo '  <li><a href="'.$this->createUrl('mPSVEHICLES_DETAILS/Dashboard').'">Logout</a></li>';
									
		                       echo ' </ul>
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
 <input type="hidden" name="lastid" id="lastid" value="<?php echo Yii::app()->session['lastid'];?>">
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
                                <a class="btn ripple-effect btn-theme" href="<?php echo $this->createUrl('partnership/Partners');?>">Partner With Us</a>
                                <a class="btn ripple-effect btn-theme" href="#">Sign up Us</a>
                                </div>
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
			                                <a href="https://www.facebook.com/metrepersecond" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a>
			                                <a href="https://twitter.com/metrepersecond" class="twitter" target="_blank"><i class="fa fa-twitter"></i></a>
			                            </li>
			                        </ul>
                    			</div>

                                <div class="col-md-6 contact-form alt">
                                <h2 class="section-title">
                    				<small>Feel Free to Say Hello!</small>
                    				<span>Join us for More.</span>
                				</h2>
                                   
							
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
							//alert(data);
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
                                    <button id="submit" class="btn btn-theme" >Send message</button>
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
                    <div class="col-sm-12 text-center">
                    <h2 class="section-title">
                    	<small>Our Partners</small>
                	</h2>
                    <div class="ourprtnr">
	                    <a href="https://msg91.com/startups/?utm_source=startup-banner">
	                    	<img src="https://msg91.com/images/startups/msg91Badge.png" width="60" title="MSG91 - SMS for Startups" alt="Bulk SMS - MSG91">
	                    </a>
	                    <a href="#">
	                    	<img src="<?php echo Yii::app()->baseUrl; ?>/images/citruspay_logo.jpg" title="Citruspay" alt="Citruspay">
	                    </a>
	                    <a href="#">
	                    	<img src="<?php echo Yii::app()->baseUrl; ?>/images/ccevenue_logo.png" title="CCAvenue" alt="CCAvenue">
	                    </a>
	                </div>
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
						<a href="<?php echo $this->createUrl('Selfdrive/Privacypolicy');?>" target="_blank">Privacy Policy</a>
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
     
	                <div class="col-md-7">	                    
						<input type="hidden" name="makes_idd" id="makes_idd">
				        <input type="hidden" name="model_idd" id="model_idd">
                            <div class="col-md-12">
                                <div class="form-group"><input class="form-control" type="text" name="user_name_m" id="user_name_m" placeholder="User name or email" autofocus="" required=""></div>
                            </div>                               
                            <div class="col-md-12">
                                <div class="form-group"><input class="form-control" type="password" name="user_password_m" id="user_password_m" placeholder="Enter Password"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkbox pull-left">
                                    <input type="checkbox" name="remember" id="checkboxa1">
                                    <label for="checkboxa1">Remember me</label>
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="#" class="forgot-password">forgot password?</a>
                            </div>
                            <div class="col-md-12 text-center mrg-top-20">								
							<div id="loginerror_login_m"></div>
								<input type="button" value="Login" id="login_btn1" name="login_btn1" class="btn btn-theme btn-theme-dark"/>
								<a href = "#" onClick = "doLogin()" class="btn btn-fbook"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a>
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
	                    <div class="form-group"><input class="form-control alt" type="text" name="areguname_m" id="areguname_m" placeholder="Name" required></div>
						<div id="nameerror"></div>
	                </div>
	                 <div class="col-md-12">
	             <div class="form-group">
				 <!--<input class="form-control alt" type="text" name="aregemail_m" id="aregemail_m"  placeholder="Enter Email*" onkeyup="isValidEmailAddress();">-->
				 <input class="form-control alt" type="text" name="aregemail_m" id="aregemail_m"  placeholder="Enter Email*"/>
				 </div>
							<div id="emailerr"></div>
	                </div>                    
	                <div class="col-md-12">
	                    <div class="form-group has-icon has-label">
	                        <input type="text" class="form-control alt" id="aregmobNo_m" name="aregmobNo_m" placeholder="Enter Mobile Number*" maxlength="10" required>
							<div id="mobileerr"></div>
	                    </div>
	                </div>
	                <div class="col-md-12">
	                    <div class="form-group"><input class="form-control alt" type="password" name="aregupwd_m" id="aregupwd_m" placeholder="Enter Password*" required></div>
						<div id="pwderr"></div>
	                </div>
	                <!-- <div class="col-md-12">
	                    <div class="form-group"><input class="form-control alt" type="password" name="acpwd" id="acpwd" placeholder="Enter Confirm Password*" required></div>
	                    <div class="col-md-6">                    
	                </div>
	               </div> -->
				  
	                <div class="col-md-12 text-center mrg-top-20">
                		<div id="emailerror1"></div>
                		<input type="button" value="Create Account" id="aregister_btn1" name="aregister_btn1" class="btn btn-theme btn-theme-dark" data-toggle="modal" data-target="#mps-otp">
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
	                <div class="form-group"><input class="form-control alt text-center" type="text" name="bregemail" id="verifyidd_m"  placeholder="Enter Vericfication code*" required></div>
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
