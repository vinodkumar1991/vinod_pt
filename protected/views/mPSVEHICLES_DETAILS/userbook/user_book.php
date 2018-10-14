<?php

/* @var $this SelfdriveController */







?>
<script>
  jQuery(document).ready(function()
		{
			
		$('#btnsub').click(function()
		{
		
		var uname= $("#uname").val();
		var password= $("#password").val();
		$.post('Checklogin',{
						  uname:uname,
						  password:password,
						
						 
				 },
					 function(data)
					 {
					   alert(data);
					 if(data==1)
					 {
						 $("#loginerror").html('<font color=red>Invalid username and password</font>');
					 }
					 else
					 {
						 window.location="CarDetails";
					 }
					 });  
	 });
});
	 </script>
<?php //var_dump($bikedetails); ?>

<!-- CONTENT AREA -->

    <div class="content-area">

        <!-- BREADCRUMBS -->

         <section class="bookservice-main page-section breadcrumbs">

            <div class="container">

            <div class="col-md-6">

                <div class="page-header">

                    <div class="form-group has-icon has-label col-sm-12">

                      <label>&nbsp;</label>

                     <input class="form-control alt geocomplete" type="text" name="adrs" id="adrs" placeholder="picked customer location address" value="" required>

                      <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>  

                    </div>

                    <div class="col-sm-6">

                    <div class="form-group has-icon has-label">

                        <label>&nbsp;</label>

                        <input type="text" class="form-control" id="picdate" name="picdate" placeholder="Picking Up Date" value="">

                        <span class="form-control-icon"><i class="fa fa-calendar"></i></span>

                    </div>

                    </div>

                    <div class="col-sm-6">

                    <div class="form-group has-icon has-label">

                        <label>&nbsp;</label>

                        <input type="text" class="form-control" id="pickhr" name="pickhr" placeholder="Picking Up Hour" value="" >

                        <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>

                    </div>

                    </div>

            </div>

            </div>     	</form>       

            <div class="col-md-6 text-right">

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
                                        <img class="img-responsive" src="<?php  echo $img_path; ?>" alt=""/>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="car-details">
									<h3 class="brnd-mdl-name"><?php echo $brand_name; ?> / <?php echo $model_name; ?></h3>
                                        <?php //echo $html; ?>                          
									</div>
									<div class="price text-center">
										<strong><i class="fa fa-inr"></i> <?php echo $payamount; ?></strong>
									</div>
                                    </div>
									</div>
									<div class="row">
										<div class="panel-group accordion" id="accordion" role="tablist" aria-multiselectable="true">
											<!-- list of selected services -->
											<div class="panel panel-default">
												<div class="panel-heading" role="tab" id="heading2">
													<h4 class="panel-title">
														<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false" aria-controls="collapse2">
															<span class="dot"></span> Selcted Service List
														</a>
													</h4>
												</div>
												<div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
													<div class="panel-body">
														<?php echo $html; ?>  
													</div>
												</div>
											</div>
											<!-- /list of selected services -->
										</div>							
									  
								
									</div>
									
									
                            </div>

                        </div>
						<?php if(!empty(Yii::app()->session['username']))

    						{  ?>
                        <hr class="page-divider half transparent"/>

                        <h3 class="block-title alt">Customer Information</h3>

                        <form action="#" class="form-delivery">

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group"><input class="form-control alt" type="text" value="<?php //echo Yii::app()->session['username']; ?>" ></div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group"><input class="form-control alt" type="text" value="<?php //echo $user_details['emailid']; ?>" ></div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group"><input class="form-control alt" type="text" value="<?php //echo $user_details['mobile_no']; ?>" ></div>

                                </div>

                                

                            </div>

                        </form>
						<?php	} ?>
                      <!--   <h3 class="block-title alt">Payments options</h3>
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
					<?php 	if(empty(Yii::app()->session['username']))
						{
						?>
							
							
                         <a class = "btn btn-theme pull-right" id="btnsub1" data-toggle = "modal" data-target = "#signup-model">Book Now</a>
						
					<?php	}else
					{						?>
				
				    <a href="<?php echo $this->createUrl('mPSVEHICLES_DETAILS/carserviceBilling');?>">Book Now</a>
						
				
					<?php } ?>
					  <a href="<?php echo $this->createUrl('mPSVEHICLES_DETAILS/CarServiceOrderSummary');?>">another Book Now</a>
                        <a class="btn btn-theme pull-right btn-theme-dark" href="<?php echo $this->createUrl('mPSVEHICLES_DETAILS/Booking');?>">Cancel</a>
                    </div>

                    <!-- /CONTENT -->

                    <!-- SIDEBAR -->

                    <aside class="col-md-3 sidebar selfaside" id="sidebar">
				<div class="widget shadow widget-helping-center estimate-widget">
                        <!-- widget detail reservation -->

                      <!-- <div class="widget shadow widget-details-reservation">

                            <h4 class="widget-title">Detail Reservation</h4>

                            <div class="widget-content">

                                <h5 class="widget-title-sub">Picking Up Location</h5>

                                <div class="media">

                                    <span class="media-object pull-left"><i class="fa fa-calendar"></i></span>

                                    <div class="media-body"><p></p></div>

                                </div>

                                <div class="media">

                                    <span class="media-object pull-left"><i class="fa fa-location-arrow"></i></span>

                                   <div class="media-body"><p></p></div> 

                                </div>

                                <h5 class="widget-title-sub">Droping Off Time</h5>

                                <div class="media">

                                    <span class="media-object pull-left"><i class="fa fa-calendar"></i></span>

                                    <div class="media-body"><p></p></div>

                                </div>

                                <div class="media">

                                    <span class="media-object pull-left"><i class="fa fa-location-arrow"></i></span>

                                      <div class="media-body"><p>From SkyLine AirPort</p></div>

                                </div>

                                <div class="button">

                                    <a href="#" class="btn btn-block btn-theme btn-theme-dark">Update Reservation</a>

                                </div>

                            </div>

                        </div> -->
						 <h4 class="widget-title">Vehicle Servicing</h4>
                            <div class="widget-content">
                             <div class="aside-vhls-dtls">                            
	                           	<div id="carimg"></div>
	                        <span class="brnd-name" id="brand"></span><br>
	                        <span class="mdl-name" id="model"></span>
                            </div>
                            <div id="extra" class="aside-srvs-dtls">
                                <h5>Type of Service</h5>
								<h4><?php echo $servicename; ?></h4>
								<h5><?php if(!empty($planname)) echo $planname; ?></h5>
                              
							<div class="aside-amt-dtls">
                                <h5>Estimated Amount</h5>
                                	<!-- <div id="estamt" class="est-amount">
                               		1000.00
                               	</div> -->
								<i class="fa fa-inr" aria-hidden="true"></i><div  class="est-amount"><?php echo $payamount; ?></div>
                            </div>	
                           
                            </div>
                        </div>
                        <!-- /widget detail reservation -->

                        <!-- widget helping center -->

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

            </div>

        </section>

        <!-- /PAGE WITH SIDEBAR -->


				<div class = "customer-signup modal fade" id = "signup-model" tabindex = "-1" role = "dialog" 
   aria-labelledby = "myModalLabel" aria-hidden = "true">
   
   <div class = "modal-dialog">
      <div class = "modal-content pull-left">
      <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">&times;</button>       
         <div class = "modal-body pull-left">
            <div class="aside-signup col-md-4">
                <h3 class="block-title">Signup Today and You will be able to</h3>
                    <ul class="list-check">
                        <li>Online Order Status</li>
                        <li>See Ready Hot Deals</li>
                        <li>Love List</li>
                        <li>Sign up to receive exclusive news and private sales</li>
                        <li>Quick Buy Stuffs</li>
                    </ul>
            </div><div class="col-md-8">
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
                        <form method="post" class="form-login"><!-- FOR LOGIN USER-->
						<input type="hidden" name="makes_idd" id="makes_idd">
				    <input type="hidden" name="model_idd" id="model_idd">
                                <div class="col-md-12">
                                    <div class="form-group"><input class="form-control" type="text" name="uname" id="uname" placeholder="User name or email"></div>
                                </div>                               
                                <div class="col-md-12">
                                    <div class="form-group"><input class="form-control" type="password" name="password" id="password" placeholder="Enter Password"></div>
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
								<input type="button" value="Login" id="btnsub" name="btnsub" class="col-md-12 btn btn-theme"></div>
                                <div class="col-md-6 mrg-top-20">
                                    <a href="#" class="btn btn-theme btn-block btn-icon-left facebook"><i class="fa fa-facebook"></i>Login with Facebook</a>
                                </div>
                                <div class="col-md-6 mrg-top-20">
                                    <a href="#" class="btn btn-theme btn-block btn-icon-left google"><i class="fa fa-google-plus" aria-hidden="true"></i>Login with Google</a>
                                </div>                                
                                
                        </form>
                    </div>
                   </div>                   
                   <div class = "tab-pane fade" id = "signuptab">
				 
                    <div class="col-md-12">
                        <div class="form-group"><input class="form-control alt" type="text" name="Usernmame" id="Usernmame"  placeholder="Enter Email*" required></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"><input class="form-control alt" type="text" name="reguname" id="reguname" placeholder="Name" required></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group has-icon has-label">
                            <input type="text" class="form-control alt" id="mobNo" name="mobNo" placeholder="Enter Mobile Number*" maxlength="10" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"><input class="form-control alt" type="password" name="upwd" id="upwd" placeholder="Enter Password*" required></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"><input class="form-control alt" type="password" name="cpwd" id="cpwd" placeholder="Enter Confirm Password*" required></div>
                        <div class="col-md-6">                    
                    </div>
                   </div>
                   <div class="col-md-12 text-center"><input type="button" value="Create Account" id="register" name="register" class="col-md-12 btn btn-theme"></div>
                   <div class="col-md-6 mrg-top-20">
                        <a href="#" class="btn btn-theme btn-block btn-icon-left facebook"><i class="fa fa-facebook"></i>Sign in with Facebook</a>
                    </div>
                    <div class="col-md-6 mrg-top-20">
                        <a href="#" class="btn btn-theme btn-block btn-icon-left google"><i class="fa fa-google-plus" aria-hidden="true"></i>Sign in with Google</a>
                    </div>
                   </div>
				   
            </div>
			
         </div>
         
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
  
</div><!-- /.Registration Sign up Modal -->
</div>
				
