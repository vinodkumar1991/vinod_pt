<?php
/* @var $this SelfdriveController */

$this->breadcrumbs=array(
	'Selfdrive',
);

?>
<script>

/*
   function testAPI() {
   
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
												var id=$("#id1").val();
											var fromdate=$("#fromdate1").val();
											var todate=$("#todate1").val();
											var bookloc=$("#bookloc1").val();
											var amount=$("#amount1").val();
											
												$.post('<?php echo $this->createUrl('Selfdrive/SelfDriveBookconfirm');?>',{
												  
										id:id,
										 fromdate:fromdate,
										todate:todate,
										bookloc:bookloc,
										amount:amount,
									
										
											 
									 }, 
										 function(data)
										 {
											window.location="http://metrepersecond.com/bookaservice/index.php/Selfdrive/SelfDriveBookconfirm1/transactionid/"+data;
										//alert(data);
							
								});	
						
											}   
										}); 
	  
    });
  } */

  jQuery(document).ready(function()
		{
			$('#verifyform1').hide();
			$('#btnsub_login').click(function()
			{
		
		
		//customer vehicle added details
		
		
		var uname= $("#user_name").val();
		var password= $("#user_password").val();
		
		amount=$("#pricetag").val();
	
		model_id=$("#model_id").val();
		makes_id=$("#make_id").val();
	
		var id=$("#id1").val();
		
		
		
		 $.post('<?php echo  $this->createUrl('Selfdrive/Checklogin');?>',{
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
					
						$.post('<?php echo $this->createUrl('Selfdrive/SelfDriveBookconfirm');?>',{
												  
										id:id,
										 fromdate:fromdate,
										todate:todate,
										bookloc:bookloc,
										amount:amount,
									
										
											 
									 }, 
										 function(data)
										 {
											 
											window.location="http://metrepersecond.com/bookaservice/index.php/Selfdrive/SelfDriveBookconfirm1/transactionid/"+data;
										alert(data);
							
								});
					}
					 });  
	 });
			
	 $('#resendbtn1').click(function()
		{
			                a=$('#hidvalue1').val();
							$.post('<?php echo  $this->createUrl('Selfdrive/Verify');?>',{
											  
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
			  
			   
			
			
			var id=$("#id1").val();
		var fromdate=$("#fromdate1").val();
		var todate=$("#todate1").val();
		var bookloc=$("#bookloc1").val();
		var amount=$("#amount1").val();
					var a = Math.floor(100000 + Math.random() * 900000);		
							a = a.toString();
							a = a.substring(-2);
							$('#hidvalue1').val(a); 
								$.post('<?php echo  $this->createUrl('Selfdrive/Verify');?>',{
											  
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
	
		
		 $.post('<?php echo $this->createUrl('mPSVEHICLES_DETAILS/RegisterCustlogin');?>',{
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
									$.post('<?php echo $this->createUrl('Selfdrive/SelfDriveBookconfirm');?>',{
												  
										id:id,
										 fromdate:fromdate,
										todate:todate,
										bookloc:bookloc,
										amount:amount,
									
										
											 
									 }, 
										 function(data)
										 {
											window.location="http://metrepersecond.com/bookaservice/index.php/Selfdrive/SelfDriveBookconfirm1/transactionid/"+data;
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
<link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/owl-carousel2/assets/owl.carousel.min.css" rel="stylesheet">
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/owl-carousel2/owl.carousel.min.js"></script>

<!-- CONTENT AREA -->
    <div class="content-area">

        <!-- BREADCRUMBS -->
        <section class="page-section breadcrumbs text-right">
            <div class="container">
                <div class="page-header">
                    <h1>Car Booking</h1>
                </div>
                <ul class="breadcrumb">
                    <li><a href="<?php echo Yii::app()->homeUrl;?>">Home</a></li>
                    <li><a href="<?php echo $this->createUrl('Selfdrive/Selfdrivedetails');?>">Self Drive</a></li>
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
                        <div class="car-big-card alt">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="owl-carousel img-carousel">
                                        <div class="item">
                                            <a class="btn btn-zoom" href="http://www.metrepersecond.com/MPS<?php echo $bookorder['img_path']; ?>" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                            <a href="http://www.metrepersecond.com/MPS<?php echo $bookorder['img_path']; ?>" data-gal="prettyPhoto"><img class="img-responsive" src="http://www.metrepersecond.com/MPS<?php echo $bookorder['img_path']; ?>" alt=""/></a>
                                        </div>
										
           
										    <?php $bookimages=unserialize($bookorder['imagespath']);
										
									$i=0; while($i<sizeof($bookimages))
									{ 
									?>
										<div class="item">
                                            <a class="btn btn-zoom" href="http://www.metrepersecond.com/MPS<?php if(isset($images)) echo $images[$i]; ?>" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                            <a href="http://www.metrepersecond.com/MPS<?php echo $bookimages[$i]; ?>" data-gal="prettyPhoto"><img class="img-responsive" src="http://www.metrepersecond.com/MPS<?php echo $bookimages[$i]; ?>" alt="<?php echo $bookorder['makename'];?>"/></a>
                                        </div>
                                     <?php $i++; } ?> 
                                    </div>
                                    <div class="row car-thumbnails">
									<?php 
										$bookimages=unserialize($bookorder['imagespath']);
										
									?>
                                        <div class="col-xs-2 col-sm-2 col-md-3"><a href="#" onclick="jQuery('.img-carousel').trigger('to.owl.carousel', [0,300]);"><img src="http://www.metrepersecond.com/MPS<?php echo $bookorder['img_path']; ?>" width="70" alt="<?php echo $bookorder['makename'];?>"/></a></div>
                                        <?php 
									$j=0; while($j<sizeof($bookimages))
									{ 
									?>
                                        <div class="col-xs-2 col-sm-2 col-md-3"><a href="#" onclick="jQuery('.img-carousel').trigger('to.owl.carousel', [<?php echo $j+1; ?>,300]);"><img src="http://www.metrepersecond.com/MPS<?php echo $bookimages[$j]; ?>" width="70" alt="<?php echo $bookorder['makename'];?>"/></a></div>
                                       
									<?php $j++; } ?> 
									</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="car-details">
                                        <div class="list">
                                            <ul>
                                                <li class="title">
												
                                                    <h2><?php echo $bookorder['makename'];?><?php echo $bookorder['modelname']?> <span><?php echo $bookorder['variant']; ?></span></h2>
                                                    Excess Kms <?php echo $bookorder['extra_rate_per_kms'];?>Rs/ per Kms
                                                </li>
                                                <li>Security Deposit <?php echo $bookorder['security_deposit'];?>Rs</li>
                                                <li>Price Per Hour <?php echo $bookorder['price_per_hour'];?>Rs</li>
                                                <li>Seating Capacity <?php echo $bookorder['seating_capacity'];?></li>
                                            </ul>
                                        </div>
                                        <div class="price">
                                            <strong><i class="fa fa-inr"></i> <?php echo $totalprice; ?></strong>
											<input type="hidden" id="pricetag" name="pricetag" value="<?php echo $bookorder['price']; ?>"/>
											<input type="hidden" id="model_id" name="models_id" value="<?php echo $bookorder['models_id']; ?>"/>
											<input type="hidden" id="make_id" name="makesid" value="<?php echo $bookorder['makes_id']; ?>"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="page-divider half transparent"/>

                        <h3 class="block-title alt">Extras & Frees</h3>
                        <form role="form" class="form-extras">
							<?php $features=explode(',',$bookorder['vehicle_features']);
								$i=0; while($i<sizeof($features)-1) {
								?>
                                <div class="col-md-3 checkbox checkbox-danger">
                                    <input id="checkboxl1" type="checkbox" disabled="disabled" checked="checked">
                                    <label for="checkboxl1"><?php echo $features[$i]; ?></label>
                                </div>
								<?php $i++; } ?>
                        </form>
                       
                     


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
                                    <div class="media-body"><p><?php echo $fromdate; ?></p></div>
                                </div>
                                <div class="media">
                                    <span class="media-object pull-left"><i class="fa fa-location-arrow"></i></span>
                                   <div class="media-body"><p><?php if(isset($bookloc)) echo $bookloc; ?></p></div> 
                                </div>
                                <h5 class="widget-title-sub">Droping Off Time</h5>
                                <div class="media">
                                    <span class="media-object pull-left"><i class="fa fa-calendar"></i></span>
                                    <div class="media-body"><p><?php echo $todate; ?></p></div>
                                </div>
                                <!-- <div class="media">
                                    <span class="media-object pull-left"><i class="fa fa-location-arrow"></i></span>
                                    <div class="media-body"><p>From SkyLine AirPort</p></div>
                                </div> -->
							 	<div class="form-group mrg-top-20">	                            
	                            <a class="btn btn-theme ripple-effect btn-theme-dark" href="<?php echo $this->createUrl('Selfdrive/index');?>">Cancel</a>
	                            <?php 	if(empty(Yii::app()->session['username']))
	                            {
	                            ?>
	                            <a class = "btn btn-theme ripple-effect" id="btnsubbook" data-toggle = "modal" data-target = "#signup-model">Book Now</a>
	                            <?php	} else
	                            {	?>
	                            <form action="<?php echo $this->createUrl('Selfdrive/SelfDriveBookconfirm');?>" method="POST">
									<input type="hidden" id="id" name="id" value="<?php echo  $bookorder['ID']; ?>">
									<input type="hidden" id="amount" name="amount" value="<?php echo $totalprice;  ?>">	
									<input type="hidden" id="fromdate" name="fromdate" value="<?php echo $fromdate; ?>">
									<input type="hidden" id="servicecat" name="todate" value="<?php echo $todate; ?>">
									<input type="hidden" id="bookloc" name="bookloc" value="<?php if(isset($bookloc)) echo $bookloc; ?>">
									<button type="submit" name="order" value="order" class="btn btn-theme ripple-effect">Book Now</button>
	                           	</form> <?php } ?>
	                        	</div>		
                            </div>
                        </div>
                        <!-- /widget detail reservation -->
                        <!-- widget helping center -->
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
            </div>
        </section>
        <!-- /PAGE WITH SIDEBAR -->

<!-- popup for login and sign up --> 
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

                        	<input type="hidden" id="id1" name="id" value="<?php echo  $bookorder['ID']; ?>">
							<input type="hidden" id="amount1" name="amount" value="<?php echo $totalprice;  ?>">
							<input type="hidden" id="fromdate1" name="fromdate" value="<?php echo $fromdate; ?>">
							<input type="hidden" id="todate1" name="todate" value="<?php echo $todate; ?>">
							<input type="hidden" id="bookloc1" name="bookloc" value="<?php if(isset($bookloc)) echo $bookloc; ?>">
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
		        		<div class="col-md-7">		 
		                     <div class="col-md-12">
		                        <div class="form-group"><input class="form-control alt" type="text" name="aregemail" id="aregemail"  placeholder="Enter Email*" required></div>
		                    </div>
		                    <div class="col-md-12">
		                        <div class="form-group"><input class="form-control alt" type="text" name="areguname" id="areguname" placeholder="Name" required></div>
		                    </div>
		                    <div class="col-md-12">
		                        <div class="form-group has-icon has-label">
		                            <input type="text" class="form-control alt" id="aregmobNo" name="aregmobNo" placeholder="Enter Mobile Number*" maxlength="10" required>
		                        </div>
		                    </div>
		                    <div class="col-md-12">
		                        <div class="form-group"><input class="form-control alt" type="password" name="regupwd" id="regupwd" placeholder="Enter Password*" required></div>
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
<!-- End popup for login and sign up --> 

<!-- OTP Pop UP -->
<div id="mps-otp" class="modal fade otp-popup" role="dialog">
  	<div class="modal-dialog">
  		<div class="modal-content">
		   <div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button></div>
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
						<input type="button" value="Submit" id="averify" name="register" class="btn btn-theme submit-otp"></div>
					<div class="col-md-3 text-center">
						<div id="emailerror"></div>
						<input type="button" value="ReSend" id="resendbtn1" name="resendbtn1" class="btn btn-theme btn-theme-dark submit-otp">
					</div>
					<span id="error"></span>
				</div>	
			</div>
		</div>
	</div>
</div>
<!-- End OTP Pop UP -->