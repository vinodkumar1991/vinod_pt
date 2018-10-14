<?php

?>
<!-- CONTENT AREA -->


<script>
$(document).ready(function() 
	{
		alert();
$('#btnsub').click(function()
				{
					serviceid="<?php echo $serviceid;?>";
					/* if(serviceid==1)
					{

					} */
					    pkid=<?php echo $planid;?>;
						model_id="<?php echo $post_mod_id;?>";
						makes_id="<?php echo $post_brand_id;?>";
						usertot="<?php echo $payamount;?>";
						value="<?php echo $hidvalue;?>";
						
						uname=$("#uname").val();
						
						
						 $.post('Updateuserpackage',{
								
								   value:value,
								   model_id:model_id,
								   pkid:pkid,
								   usertot:usertot,
								   makes_id:makes_id,
								   uname:uname,
								   serviceid:serviceid
								 
								  
								 
								},
							function(data)
							{
							alert(data);
							   /* if(data==1)
								{
									$("#loginerror").html('<font color=red>Invalid username and password</font>');
								}
								else
								{
									window.location="AddVehicle";
								}   */
							});
							/* var uname= $("#uname").val();
							var password= $("#password").val();
							var makes_id= "<?php echo $post_brand_id;?>";
							var model_id= "<?php echo $post_mod_id;?>"; 
							var amount= "<?php echo $payamount;?>"; 
							var serviceid="<?php echo $serviceid;?>";
							   $.post('loginuser',{
									 
									 uname:uname,
									 password:password,
									 makes_id:makes_id,
									 model_id:model_id,
									 amount:amount,
									 serviceid:serviceid
									 
									},
								function(data)
								{
										if(data==1)
										{
											$("#loginerror").html('<font color=red>Invalid username and password</font>');
										}
										else
										{
											window.location="paynowpage";
										}
										
								});  */
					
				});
	});
</script>
<?php

				if(empty(Yii::app()->session['username']))
				{
					?>
				
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
								
								<div id="loginerror"></div>
								<input type="button" value="Login" id="btnsub" name="btnsub" value="login"/></div>
                                <div class="col-md-6 mrg-top-20">
                                    <a href="#" class="btn btn-theme btn-block btn-icon-left facebook"><i class="fa fa-facebook"></i>Login with Facebook</a>
                                </div>
                                <div class="col-md-6 mrg-top-20">
                                    <a href="#" class="btn btn-theme btn-block btn-icon-left google"><i class="fa fa-google-plus" aria-hidden="true"></i>Login with Google</a>
                                </div>                                
                                
                        
                    </div>
                   </div>                   
                   <div class = "tab-pane fade" id = "signuptab">
				 
                    <div class="col-md-12">
                        <div class="form-group"><input class="form-control alt" type="text" name="regemail" id="regemail"  placeholder="Enter Email*" required></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"><input class="form-control alt" type="text" name="reguname" id="reguname" placeholder="Name" required></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group has-icon has-label">
                            <input type="text" class="form-control alt" id="regmobNo" name="regmobNo" placeholder="Enter Mobile Number*" maxlength="10" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"><input class="form-control alt" type="password" name="regupwd" id="regupwd" placeholder="Enter Password*" required></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"><input class="form-control alt" type="password" name="cpwd" id="cpwd" placeholder="Enter Confirm Password*" required></div>
                        <div class="col-md-6">                    
                    </div>
                   </div>
				  
                   <div class="col-md-12 text-center"><input type="button" value="Create Account" id="register1" name="register1" class="col-md-12 btn btn-theme"></div>
                   <div class="col-md-6 mrg-top-20">
				   <div id="emailerror">dfggsdg</div>
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
				<?php
				}
				
				?>
    <div class="content-area">

        <!-- BREADCRUMBS -->
        <section class="page-section breadcrumbs text-right">
            <div class="container">
                <div class="page-header">
                    <h1>Car Booking</h1>
                </div>
                <ul class="breadcrumb">
                    <li><a href="<?php echo Yii::app()->homeUrl;?>">Home</a></li>
                    <li><a href="">Self Drive</a></li>
                    <li class="active">Booking & Payment</li>
                </ul>
            </div>
        </section>
        <!-- /BREADCRUMBS -->

        <!-- PAGE WITH SIDEBAR -->
        <section class="page-section with-sidebar sub-page self-fullview-book">
            <div class="container">
                <div class="row">
                    <!-- CONTENT -->
                    <div class="col-md-9 content" id="content">

                        <h3 class="block-title alt">Car Information</h3>
                        <div class="car-big-card alt">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="item">
                                        <a href=""><img class="img-responsive" src="<?php echo $mod_path;?>" alt=""/></a>
                                    </div>                                    
                                </div>
                                <div class="col-md-4">
                                    <div class="car-details">
                                        <div class="list">
                                            <ul>
                                                <li class="title">
                                                    <h2>Brand Name :<?php echo $post_brand_nm;?> <span><br/><br/>Model Name : <?php echo $post_mod_nm;?></span></h2>         
                                                </li>
                                              
                                               
                                                
                                            </ul>
                                        </div>
                                        <div class="price">
                                            <strong><i class="fa fa-inr"></i> <?php echo $payamount;?></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="page-divider half transparent"/>

                        <h3 class="block-title alt"> <?php echo $servicename;?> ( <?php echo $planname;?>)</h3>
                        <ul class="list-check">		
						
						<?php
						foreach( $fetchmps as $fetch)
						{
							?>
							   <li><?php echo $fetch['sname'];?></li>
												  
							<?php
						}
						?>	
						
						
						<?php
						foreach( $fetch_select_details as $fetch_select_d)
						{
							?>
							   <li><?php echo $fetch_select_d['sname'];?></li>
												  
							<?php
						}
						?>						
                            
                        </ul>
                        <div class="clearfix">&nbsp;</div>
                        <h3 class="block-title alt">Customer Information</h3>
                        <form action="#" class="form-delivery">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group"><input class="form-control alt" type="text" value="User Name" ></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"><input class="form-control alt" type="text" value="E-mail ID" ></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"><input class="form-control alt" type="text" value="Mobile No." ></div>
                                </div>
                                
                            </div>
                        </form>
                        <div class="clearfix">&nbsp;</div>
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
                        <div class="overflowed">
                            <div class="checkbox pull-left">
                                <input id="checkboxa1" type="checkbox">
                                <label for="checkboxa1">I accept all information and Payments etc</label>
                            </div>
                           <!-- <a class="btn btn-theme pull-right" href="#" style="margin-left:10px;">Pay Now</a>-->
						<a class = "btn btn-theme pull-right" id="btnsub1" data-toggle = "modal" data-target = "#signup-model">Pay Now</a>
                            <a class="btn btn-theme pull-right btn-theme-dark" href="#">Cancel</a>
                        </div>

                    </div>
                    <!-- /CONTENT -->

                    <!-- SIDEBAR -->
                    <aside class="col-md-3 sidebar" id="sidebar">
                        <!-- widget detail reservation -->
                        <div class="widget shadow widget-details-reservation">
                            <h4 class="widget-title">Detail Reservation</h4>
                            <div class="widget-content">
                                <h5 class="widget-title-sub">Picking Up Location</h5>
                                <div class="media">
                                    <span class="media-object pull-left"><i class="fa fa-calendar"></i></span>
                                    <div class="media-body"><p>Date Time</p></div>
                                </div>
                                <div class="media">
                                    <span class="media-object pull-left"><i class="fa fa-location-arrow"></i></span>
                                   <div class="media-body"><p>Madhapur</p></div> 
                                </div>
                                <h5 class="widget-title-sub">Droping Off Time</h5>
                                <div class="media">
                                    <span class="media-object pull-left"><i class="fa fa-calendar"></i></span>
                                    <div class="media-body"><p>Date Time</p></div>
                                </div>
                                <div class="media">
                                    <span class="media-object pull-left"><i class="fa fa-location-arrow"></i></span>
                                    <!--  <div class="media-body"><p>From SkyLine AirPort</p></div> -->
                                </div>
                                <div class="button">
                                    <a href="#" class="btn btn-theme">Pay Now</a>
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
