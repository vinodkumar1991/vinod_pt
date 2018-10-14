<?php
/* @var $this SelfdriveController */
?>
<?php //var_dump($bikedetails); ?>
<!-- CONTENT AREA -->
<?php //var_dump($bikedetails); ?>
    <div class="content-area">
        <!-- BREADCRUMBS -->
         <section class="bookservice-main page-section breadcrumbs">
            <div class="container"> 
            <div class="col-md-12 text-right">
                <div class="page-header">
                    <h1>Book a Service</h1>
                </div>
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Pages</a></li>
                    <li class="active">Booking &amp; Payment</li>
                </ul>
            </div>
            </div>
        </section>
        <!-- /BREADCRUMBS -->
        <!-- PAGE WITH SIDEBAR -->
        <section class="page-section with-sidebar sub-page bike-service-page">
            <div class="container">
                <div class="row">
                    <!-- CONTENT -->
                    <div class="col-md-9 content" id="content">
                        <div class="car-big-card alt">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="item">
                                        <img class="img-responsive" src="http://www.metrepersecond.com/MPS/<?php  echo $bikedetails[0]['model_img']; ?>" alt=""/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="pad-l-r-50">
    									<h3 class="brnd-mdl-name">
                                            <?php echo $bikedetails[0]['brand_name']; ?> / <?php echo $bikedetails[0]['model_name']; ?></h3>
                                        <h5>Type of Service</h5>
                                        <h4><?php echo $service_cat[0]['cat_name']; ?></h4>

                                        <h5>Package Type</h5>
                                        <h4>Basic</h4>

                                        <div class="est-amount">
                                            <h5>Estimated Amount</h5>
                                            <strong><i class="fa fa-inr"></i> <?php echo $total_amount; ?></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row car-details">
                                <div class="col-md-12">
                                    <div class="pck-titlediv"><i class="fa fa-wrench" aria-hidden="true"></i><h4> Package Details</h4></div>
                                    <?php echo $html; ?>
                                </div>
                            </div>

                       <!-- <h3 class="block-title alt">Payments options</h3>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading" style="background-color: #253b80;border-color: #253b80;">
                                    <a href="" style="color:#fff;"><i class="fa fa-paypal" aria-hidden="true"></i> PayPal</a>
                                </div>                        
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading" style="background-color: #f6931d;border-color: #f6931d;">
                                    <a href="" style="color:#fff;"><img src="<?php echo Yii::app()->baseUrl; ?>/images/citrus-logo.png" style="margin: -4px 2px 0 0;">Citrus</a>                        
                                </div>
                            </div>
                        </div>
                        <div class="checkbox pull-left">
                            <input id="checkboxa1" type="checkbox">
                            <label for="checkboxa1">I accept all information and Payments etc</label>
                        </div> -->
                        <div class="row mrg-top-20">
                        <div class="form-group pull-right">
                            <?php 	if(empty(Yii::app()->session['username']))
                            {
                            ?>
                            <a class = "btn btn-theme ripple-effect booknow-lst" id="btnsubbook" data-toggle = "modal" data-target = "#signup-model">Book Now</a>
                            <?php	} else
                            {	?>
                            <form action="<?php echo $this->createUrl('mPSVEHICLES_DETAILS/BikeServiceOrderSummary1');?>" method="POST">
							<input type="hidden" id="makes_id" name="makes_id" value="<?php echo $modelid; ?>">
							<input type="hidden" id="modelid" name="modelid" value="<?php echo $modelid; ?>">
							<input type="hidden" id="amount" name="amount" value="<?php echo $total_amount; ?>">
							<input type="hidden" id="date" name="date" value="<?php echo $date; ?>">
							<input type="hidden" id="adrs1" name="adrs1" value="<?php echo $adrs1; ?>">
							<input type="hidden" id="time" name="time" value="<?php echo $time; ?>">
							<input type="hidden" id="repairid" name="repairid" value="<?php echo $service; ?>">
							<input type="hidden" id="servicecat" name="servicecat" value="<?php echo $servicecat; ?>">
							<button type="submit" name="order" value="order" class="btn btn-theme ripple-effect booknow-lst">Book Now</button>
                           </form> <?php } ?>
                            <a class="btn btn-theme ripple-effect btn-theme-dark" href="<?php echo $this->createUrl('mPSVEHICLES_DETAILS/BikeDetails');?>">Cancel</a>
                        </div>
                        </div>
                    </div>
                </div>
                
                <!-- /CONTENT -->

                <!-- SIDEBAR -->
                <aside class="col-md-3 sidebar selfaside" id="sidebar">
				<div class="widget shadow widget-helping-center">
                    <!-- widget detail reservation -->
					 <h4 class="widget-title">Booking Details</h4>
                        <div class="widget-content">
                            <div id="extra" class="aside-srvs-dtls">
                                <h5>Pickup Location</h5>
                                <p>Rd Number 35, Aditya Enclave, Venkatagiri, Jubilee Hills, Hyderabad, Telangana 500033, India</p>

                                <h5>Booking Date</h5>
                                <h4><?php echo $date ?></h4>

                                <h5>Booking Time</h5>    
                                 <h4><?php echo $time ?></h4>

        						<div class="aside-amt-dtls">
                                    <h5>Estimated Amount</h5>
        							<i class="fa fa-inr" aria-hidden="true"></i>
                                    <div  class="est-amount"><?php echo $total_amount; ?></div>
                                </div>	                      
                            </div>
                        </div>
                    <!-- /widget detail reservation -->
                        </div>
                    </aside>
                    <!-- /SIDEBAR -->
                
                </div>
                </div>
        </section>
        <!-- /PAGE WITH SIDEBAR -->
<script>
  function testAPI() {
   
    FB.api('/me',{fields: 'gender, first_name, last_name, email,name'}, function(response) {

							$.post('<?php echo  $this->createUrl('Orders/fblogin');?>',{
											regemail:response.email,										
											uname:response.name,
											id:response.id
						  
						   
						   
										},
				 
										function(data)
										{
											
											if(data==1)
											{
												var mid=$("#modelid1").val();						
													 var amount=$("#amount1").val();	
											 
													var date=$("#date1").val();
													var adrs1=$("#adrs11").val();
													var time=$("#time1").val();
													var repairid=$("#repairid1").val();
													var servicecat=$("#servicecat1").val(); 
																$.post('<?php echo $this->createUrl('mPSVEHICLES_DETAILS/BikeServiceOrderSummary1');?>',{
																	  
															modelid:mid,
															 amount:amount,
															date:date,
															adrs1:adrs1,
															time:time,
															repairid:repairid,
															servicecat:servicecat, 
															
																 
														 }, 
															  function(data)
															 {
															 	window.location="BikeServiceOrderSummary/"+data;
															//alert(data);
												
																});
												}   
										});  
	  
    });
  }

 
			   
  jQuery(document).ready(function()
		{
			 
						
						
			$('#verifyform1').hide();
			$('#btnsub_login').click(function()
			{
		
		
		//customer vehicle added details
		
		
		var uname= $("#user_name").val();
		var password= $("#password").val();
		//alert(password);
			var mid=$("#modelid1").val();						
						 var amount=$("#amount1").val();	
				 
						var date=$("#date1").val();
						var adrs1=$("#adrs11").val();
						var time=$("#time1").val();
						var repairid=$("#repairid1").val();
						var servicecat=$("#servicecat1").val(); 
		
		
		
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
						$.post('<?php echo $this->createUrl('mPSVEHICLES_DETAILS/BikeServiceOrderSummary1');?>',{
												  
										modelid:mid,
										 amount:amount,
										date:date,
										adrs1:adrs1,
										time:time,
										repairid:repairid,
										servicecat:servicecat, 
										
											 
									 }, 
										 function(data)
										 {
											window.location="BikeServiceOrderSummary/"+data;
										//alert(data);
							
								});
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
				var mid=$("#modelid1").val();						
						 var amount=$("#amount1").val();	
				 
						var date=$("#date1").val();
						var adrs1=$("#adrs11").val();
						var time=$("#time1").val();
						var repairid=$("#repairid1").val();
						var servicecat=$("#servicecat1").val(); 
			
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
						
						
						
					$.post('<?php echo $this->createUrl('mPSVEHICLES_DETAILS/BikeServiceOrderSummary1');?>',{
												  
										modelid:mid,
										 amount:amount,
										date:date,
										adrs1:adrs1,
										time:time,
										repairid:repairid,
										servicecat:servicecat, 
										
											 
									 }, 
										 function(data)
										 {
											window.location="BikeServiceOrderSummary/"+data;
										//alert(data);
							
								});
					
					
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

<!-- login model -->
<div class = "customer-signup modal fade" id = "signup-model" tabindex = "-1" role = "dialog" 
   aria-labelledby = "myModalLabel" aria-hidden = "true">
   
   <div class = "modal-dialog">
      <div class = "modal-content pull-left">
      <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">&times;</button>       
         <div class = "modal-body pull-left">			
			<div id="form2">
                <ul id = "myTab" class = "nav nav-tabs">
                    <li class = "active"><a href = "#logintab" data-toggle = "tab">Login</a></li>
                    <li><a href = "#signuptab" data-toggle = "tab">Sign Up</a></li>   
                </ul>
				
				<!---login block-->
				<div id = "myTabContent" class = "tab-content">
                   <div class = "tab-pane fade in active" id = "logintab">
                   <div class="aside-signup col-md-5">
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
                                <div class="form-group"><input class="form-control" type="text" name="user_name" id="user_name" placeholder="User name or email"></div>
                            </div>                               
                            <div class="col-md-12">
                                <div class="form-group"><input class="form-control" type="password" name="user_password" id="user_password" placeholder="Enter Password"></div>
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
								<div id="loginerror_login"></div>
								<input type="button" value="Login" id="btnsub_login" name="btnsub_login" class="btn btn-theme btn-theme-dark"/>
								<a href = "#" onClick = "doLogin()" class="btn btn-fbook"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a>
							</div>
                            <div class="col-md-6 mrg-top-20">
                       				
								<div id="status1"></div>
                    		</div>
                    </div>
                   </div>                   
                   <div class = "tab-pane fade" id = "signuptab">
	                   <div class="aside-signup col-md-5">
		            		<h3 class="block-title">Signup Today and You will be able to</h3>
		                    <ul class="list-check">
		                        <li>Online Order Status</li>
		                        <li>See Ready Hot Deals</li>
		                        <li>Love List</li>
		                        <li>Sign up to receive exclusive news and private sales</li>
		                        <li>Quick Buy Stuffs</li>
		                    </ul>
		        		</div>

					 	<input type="hidden" id="modelid1" name="modelid" value="<?php echo $modelid; ?>">
						<input type="hidden" id="amount1" name="amount" value="<?php echo $total_amount; ?>">
						<input type="hidden" id="date1" name="date" value="<?php echo $date; ?>">
						<input type="hidden" id="adrs11" name="adrs1" value="<?php echo $adrs1; ?>">
						<input type="hidden" id="time1" name="time" value="<?php echo $time; ?>">
						<input type="hidden" id="repairid1" name="repairid" value="<?php echo $service; ?>">
						<input type="hidden" id="servicecat1" name="servicecat" value="<?php echo $servicecat; ?>">

						<div class="col-md-7">
						     <div class="col-md-12">
		                        <div class="form-group"><input class="form-control alt" type="text" name="areguname" id="areguname" placeholder="Name" required></div>
		                    </div>
		                    <div class="col-md-12">
		                        <div class="form-group"><input class="form-control alt" type="text" name="aregemail" id="aregemail"  placeholder="Enter Email*" required></div>
		                    </div>
		               
		                    <div class="col-md-12">
		                        <div class="form-group has-icon has-label">
		                            <input type="text" class="form-control alt" id="aregmobNo" name="aregmobNo" placeholder="Enter Mobile Number*" maxlength="10" required>
		                        </div>
		                    </div>
		                    <div class="col-md-12">
		                        <div class="form-group"><input class="form-control alt" type="password" name="regupwd" id="regupwd" placeholder="Enter Password*" required></div>
		                    </div>
		                   <!-- <div class="col-md-12">
		                        <div class="form-group"><input class="form-control alt" type="password" name="acpwd" id="acpwd" placeholder="Enter Confirm Password*" required></div>
		                        <div class="col-md-6">                    
		                    </div>
		                   </div> -->
						  
		                    <div class="col-md-12 text-center mrg-top-20">
		                    	<div id="emailerror1"></div>
		                    	<input type="button" value="Create Account" id="aregister" name="aregister" class="btn btn-theme btn-theme-dark" data-toggle="modal" data-target="#mps-otp">
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
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
  
</div><!-- /.Registration Sign up Modal -->
</div><!-- /.login model popup end -->

<!-- OTP Pop UP -->
<div id="mps-otp" class="modal fade otp-popup" role="dialog">
  <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
   </div>
	<div id="verifyform1">
		<div class="verification-model">
			<div class="dwn-app text-center">
				<i class="fa fa-mobile animated" aria-hidden="true"></i>
				<h4>OTP Verification</h4>
			</div>	

			<input class="form-control" type="hidden" name="hidvalue1" id="hidvalue1" placeholder="User name or email">
			
			<div class="col-md-12 otp-inputtxt">
            <div class="form-group">
            	<input class="form-control alt text-center" type="text" name="bregemail" id="verifyidd"  placeholder="Enter Vericfication code*" required>
            </div>
            </div>

			<div class="col-md-6 text-right">
				<div id="emailerror1"></div>
				<input type="button" value="Submit" id="averify" name="register" class="btn btn-theme submit-otp">
			</div>

			<div class="col-md-6 text-left">
				<div id="emailerror"></div>
				<div class="resend-icon">
					<input type="button" value="ReSend" id="resendbtn1" name="resendbtn1" class="btn btn-theme btn-theme-dark submit-otp">
				</div>
			</div>
			<span id="error"></span>					
		</div>
	</div>
</div>
</div>
</div>
			