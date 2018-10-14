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
												
											window.location="http://metrepersecond.com/bookaservice/index.php/HireMechanic/HireServiceOrderSummary?id="+'<?php echo $bookorder['id']; ?>';
						
											}   
										}); 
	  
    });
  }
            /* function login(){
                FB.api('/me?fields=email,name,id', function(response) {
					console.log(response);
                    document.getElementById('login').style.display = "block";
                    document.getElementById('login').innerHTML = response.name + " succsessfully logged in!";
					//alert(response.user_birthday);
					$.post('<?php echo  $this->createUrl('Orders/fblogin');?>',{
											regemail:response.email,										
											uname:response.name,
											id:response.id
						  
						   
						   
										},
				 
										function(data)
										{
											
											if(data==1)
											{
												
											window.location="http://metrepersecond.com/bookaservice/index.php/HireMechanic/HireServiceOrderSummary?id="+'<?php echo $bookorder['id']; ?>';
						
											}   
										}); 
                });
            } */
			   
          
  $(document).ready(function()
		{
			$('#verifyform1').hide();
			$('#btnsub_login').click(function()
			{
		
		
		//customer vehicle added details
		
		
		var uname= $("#user_name").val();
		var password= $("#user_password").val();
		
		
		
		
		
		 $.post('<?php echo $this->createUrl('HireMechanic/Checklogin');?>',{
						  uname:uname,
						  password:password,
						
						 
				 },
					 function(data)
					 {
					//alert(data);
					  if(data==1)
					{
						$("#loginerror_login").html('<div class="has-error">Invalid username and Pin</div>');
					}
					else
					{
						window.location="http://metrepersecond.com/bookaservice/index.php/HireMechanic/HireServiceOrderSummary?id="+'<?php echo $bookorder['id']; ?>';
												 
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
												window.location="http://metrepersecond.com/bookaservice/index.php/HireMechanic/HireServiceOrderSummary?id="+'<?php echo $bookorder['id']; ?>';
												  
												 
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
                        <!-- <h3 class="block-title alt">Mechanic Details</h3> -->
                        <div class="car-big-card alt">
                            <div class="row">
                                <div class="col-md-3">
									<div class="item">
										<!-- <a class="btn btn-zoom" href="http://www.metrepersecond.com/MPS/<?php echo $bookorder['upload_pic_path']; ?>" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a> -->
										<!-- <a href="http://www.metrepersecond.com/MPS/<?php echo $bookorder['upload_pic_path']; ?>" data-gal="prettyPhoto"></a>-->
										<img class="img-responsive" src="http://www.metrepersecond.com/MPS/<?php echo $bookorder['upload_pic_path']; ?>" alt=""/>
									</div>
                                </div>
                                <div class="col-md-6">
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
								<div class="col-md-3">
								
								<?php
							if(empty(Yii::app()->session['username']))
                            {
							?>
							 <a class = "btn btn-theme pull-right mrg-top-155" id="btnsub1" data-toggle = "modal" data-target = "#signup-model">Book Now</a>
							 <input type="hidden" name="booklocation" id="booklocation"/>
							<?php
							}
							else{
							?>
							 <a href="<?php echo $this->createUrl('HireMechanic/HireServiceOrderSummary?id='.$bookorder['id'].'');?>" class = "btn btn-theme pull-right">Book Now</a>
							
							  <!-- <a class = "btn btn-theme pull-right" id="btnsub1" data-toggle = "modal" data-target = "#signup-model">Book Now</a>-->
							<?php
							}
							?>
								</div>
								
                            </div>
                        </div>
						
                                           
					</div>
					<!-- /CONTENT -->
				
				 <!-- SIDEBAR -->
                    <aside class="col-md-3 sidebar selfaside" id="sidebar">                      
					   <div class="widget shadow widget-helping-center">
                            <h4 class="widget-title">HELP &amp; SUPPORT</h4>
                            <div class="widget-content">
                                <p>Call us for all your car and bike needs.</p>
                                <h5 class="widget-title-sub">+91 801 944 80 35</h5>
                                <p><a href="mailto:support@metrepersecond.com">support@metrepersecond.com</a></p>
                            </div>
                        </div>
                        <!-- /widget helping center -->
                    </aside>
                    <!-- /SIDEBAR -->
            </div>
        </section>
       <!-- /PAGE WITH SIDEBAR -->

<!-- popup for login and sign up --> 
<div class = "customer-signup modal fade" id ="signup-model" tabindex = "-1" role = "dialog" aria-labelledby = "myModalLabel" aria-hidden = "true">   
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
                   	<div class="aside-signup col-md-5" id="content1">
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
						<input type="hidden" name="makes_idd" id="makes_idd">
				        <input type="hidden" name="model_idd" id="model_idd">
                        <div class="col-md-12">
                            <div class="form-group"><input class="form-control" type="text" name="user_name" id="user_name" placeholder="User name or email"></div>
                        </div>                               
                        <div class="col-md-12">
                            <div class="form-group"><input class="form-control" type="password" name="user_password" id="user_password" placeholder="Enter Pin"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="checkbox pull-left">
                                <input type="checkbox" name="remember" id="checkboxa1">
                                <label for="checkboxa1">Remember me</label>
                            </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="#" class="forgot-password">forgot Pin?</a>
                        </div>
                        <div class="col-md-12 text-center mrg-top-20">						
							<div id="loginerror_login"></div>
							<input type="button" value="Login" id="btnsub_login" name="btnsub_login" class="btn btn-theme btn-theme-dark"/>
							<a href = "#" onClick = "doLogin()" class="btn btn-fbook"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a>
						</div>
                        <div class="col-md-6 mrg-top-20">
                   	
						
                		</div>
                	</div>
                </div>                   
               	<div class = "tab-pane fade" id = "signuptab">
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
		                    <div class="form-group"><input class="form-control alt" type="password" name="regupwd" id="regupwd" placeholder="Enter Pin*" required></div>
		                </div>
		                <!-- <div class="col-md-6">
		                    <div class="form-group"><input class="form-control alt" type="password" name="acpwd" id="acpwd" placeholder="Enter Confirm Password*" required></div>
		                    <div class="col-md-6">                    
		                </div>
		               </div> -->					  
		                <div class="col-md-12 text-center mrg-top-20">
		                	<div id="emailerror1"></div>
		                	<input type="button" value="Create Account" id="aregister" name="aregister" class="btn btn-theme btn-theme-dark">
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
</div>

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
	                    <div class="form-group"><input class="form-control alt text-center" type="text" name="bregemail" id="verifyidd"  placeholder="Enter Vericfication code*" required></div>
	                </div>
					<div class="col-md-6 text-right">
					 	<div id="emailerror1"></div>
					 	<input type="button" value="Submit" id="averify" name="register" class="btn btn-theme submit-otp">
					</div>
					<div class="col-md-6 text-left">
						<div id="emailerror"></div>
						<input type="button" value="ReSend" id="resendbtn1" name="resendbtn1" class="btn btn-theme btn-theme-dark submit-otp">
					</div>
					<span id="error"></span>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.End OTP Pop UP -->