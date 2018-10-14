<?php

/* @var $this SelfdriveController */







?>
<script>
  $(document).ready(function()
		{
			$('#verifyform1').hide();
			$('#btnsub_login').click(function()
			{
		
		
		//customer vehicle added details
		
		
		var uname= $("#user_name").val();
		var password= $("#user_password").val();
		alert(password);
		
		
		
		
		 $.post('HireMechanic/Checklogin',{
						  uname:uname,
						  password:password,
						
						 
				 },
					 function(data)
					 {
					alert(data);
					 if(data==1)
					{
						$("#loginerror_login").html('<font color=red>Invalid username and password</font>');
					}
					else
					{
						window.location="<?php echo $this->createUrl('HireMechanic/BikeServiceOrderSummary?amount='.$total_amount.'');?>";
					} 
					 });  
	 });
			
	 $('#resendbtn1').click(function()
		{
			                a=$('#hidvalue1').val();
							$.post('<?php echo  $this->createUrl('HireMechanic/Verify');?>',{
											  
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
								$.post(' <?php echo $this->createUrl('HireMechanic/Verify');?>',{
											 
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
	
		
		 $.post('<?php echo $this->createUrl('HireMechanic/RegisterCustlogin');?>',{
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
					 window.location="<?php echo $this->createUrl('Selfdrive/BikeServiceOrderSummary?amount='.$total_amount.'');?>";
					 
					 
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
<link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/owl-carousel2/assets/owl.carousel.min.css" rel="stylesheet">

<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/owl-carousel2/owl.carousel.min.js"></script>



<!-- CONTENT AREA -->

    <div class="content-area">



        <!-- BREADCRUMBS -->

        <section class="page-section breadcrumbs text-right">

            <div class="container">

                <div class="page-header">

                    <h1>Hire a Mechanic</h1>

                </div>

                <ul class="breadcrumb">

                    <li><a href="<?php echo Yii::app()->homeUrl;?>">Home</a></li>

                    <li><a href="<?php echo $this->createUrl('HireMechanic/MechanicDetails');?>">Hire a Mechanic</a></li>

                    <li class="active">Booking & Payment</li>

                </ul>

            </div>

        </section>

        <!-- /BREADCRUMBS -->



        <!-- PAGE WITH SIDEBAR -->

        <section class="page-section with-sidebar sub-page">
            <div class="container">
                    <!-- CONTENT -->
                    <div class="col-md-9 content" id="content">
                        <h3 class="block-title alt">Mechanic Information</h3>
                        <div class="car-big-card alt">
                            <div class="row">
                                <div class="col-md-7">
									<div class="item">
										<a class="btn btn-zoom" href="http://www.metrepersecond.com/MPS/<?php echo $bookorder['upload_pic_path']; ?>" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>

										<a href="http://www.metrepersecond.com/MPS/<?php echo $bookorder['upload_pic_path']; ?>" data-gal="prettyPhoto"><img class="img-responsive" src="http://www.metrepersecond.com/MPS/<?php echo $bookorder['upload_pic_path']; ?>" alt=""/></a>

									</div>
                                </div>
                                <div class="col-md-5">
                                    <div class="car-details">
                                        <div class="list">
                                            <ul>
                                                <li>profesionality in :<?php echo $bookorder['profesional']; ?></li>
                                                <li>Year of Experiance <?php echo $bookorder['Year_of_exp']; ?></li>
                                                <li>Description : <?php echo $bookorder['description']; ?> </li>
                                            </ul>
                                        </div>
                                        <div class="price">
                                            <strong><i class="fa fa-inr"></i><?php echo $bookorder['booking_charge']; ?></strong>
                                        </div>
                                    </div>
                                </div>
								<a class = "btn btn-theme pull-right" id="btnsub1" data-toggle = "modal" data-target = "#signup-model">Book Now</a>
                            </div>
                        </div>

						<?php 	if(empty(Yii::app()->session['username']))
						{
						?>
						
						<?php	}else { ?>

						<h3 class="block-title alt">Customer Information</h3>
                        <form action="#" class="form-delivery">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group"><input class="form-control alt" type="text" value="<?php echo Yii::app()->session['username']; ?>" ></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"><input class="form-control alt" type="text" value="<?php echo $user_details['emailid']; ?>" ></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"><input class="form-control alt" type="text" value="<?php echo $user_details['mobile_no']; ?>" ></div>
                                </div>
                            </div>
                        </form>

						 <?php } ?>

                        <h3 class="block-title alt">Payments options</h3>
                        <div class="panel-group payments-options" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel radio panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" aria-controls="collapseOne">
                                            <span class="dot"></span> Direct Bank Transfer
                                        </a>
                                    </h4>

                                </div>

                                <div id="collapse1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">

                                    <div class="panel-body">

                                        <div class="alert alert-success" role="alert">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sollicitudin ultrices suscipit. Sed commodo vel mauris vel dapibus.</div>

                                    </div>

                                </div>

                            </div>

                            <div class="panel panel-default">

                                <div class="panel-heading" role="tab" id="headingTwo">

                                    <h4 class="panel-title">

                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false" aria-controls="collapseTwo">

                                            <span class="dot"></span> Cheque Payment

                                        </a>

                                    </h4>

                                </div>

                                <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">

                                    <div class="panel-body">

                                        Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.

                                    </div>

                                </div>

                            </div>

                            <div class="panel panel-default">

                                <div class="panel-heading" role="tab" id="headingThree">

                                    <h4 class="panel-title">

                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="false" aria-controls="collapseThree">

                                            <span class="dot"></span> Credit Card

                                        </a>

                                <span class="overflowed pull-right">

                                    <img src="<?php echo Yii::app()->baseUrl; ?>/assets/img/preview/payments/mastercard-2.jpg" alt=""/>

                                    <img src="<?php echo Yii::app()->baseUrl; ?>/assets/img/preview/payments/visa-2.jpg" alt=""/>

                                    <img src="<?php echo Yii::app()->baseUrl; ?>/assets/img/preview/payments/american-express-2.jpg" alt=""/>

                                    <img src="<?php echo Yii::app()->baseUrl; ?>/assets/img/preview/payments/discovery-2.jpg" alt=""/>

                                    <img src="<?php echo Yii::app()->baseUrl; ?>/assets/img/preview/payments/eheck-2.jpg" alt=""/>

                                </span>

                                    </h4>

                                </div>

                                <div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3"></div>

                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading4">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                            <span class="dot"></span> PayPal
                                        </a>
                                        <span class="overflowed pull-right"><img src="assets/img/preview/payments/paypal-2.jpg" alt=""/></span>
                                    </h4>
                                </div>
                                <div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading4"></div>
                            </div>
                        </div>                    
					</div>
					<!-- /CONTENT -->
				
				 <!-- SIDEBAR -->

                    <aside class="col-md-3 sidebar selfaside" id="sidebar">                      

					   <div class="widget shadow widget-helping-center">

                            <h4 class="widget-title">Support Center</h4>

                            <div class="widget-content">

                                <p>Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros.</p>

                                <h5 class="widget-title-sub">+90 555 444 66 33</h5>

                                <p><a href="mailto:support@supportcenter.com">support@supportcenter.com</a></p>

                            </div>

                        </div>

                        <!-- /widget helping center -->

                    </aside>

                    <!-- /SIDEBAR -->

            </div>

        </section>
       <!-- /PAGE WITH SIDEBAR -->

<div class = "customer-signup modal fade" id ="signup-model" tabindex = "-1" role = "dialog" aria-labelledby = "myModalLabel" aria-hidden = "true">   

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

			<div class="col-md-8">
				
                <ul id = "myTab" class = "nav nav-tabs" id="form2">

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
								<input type="button" value="Login" id="btnsub_login" name="btnsub_login" class="btn btn-theme btn-block btn-theme-dark"/></div>
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

