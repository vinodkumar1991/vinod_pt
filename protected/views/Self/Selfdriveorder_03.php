<?php
/*print_r($SelfImages);
die();
foreach($SelfImages as $SelfImage)
{
    if($SelfImage['is_parent'] == 1)
    {
        
    }
}*/

?>

<link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/owl-carousel2/assets/owl.carousel.min.css" rel="stylesheet">
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/owl-carousel2/owl.carousel.min.js"></script>
<script>
jQuery(document).ready(function ()
{

  //  alert();
    var intCustomerId;
    var strMobile;
    var strToken;
    var strFirstName;
    var strSMSToken;
    $('#aregister').click(function ()
    {
        var intCustomer = '';
        var intValidation = '';
        var objCustomer = {};
        var regemail = $("#aregemail").val();
        var upwd = $("#regupwd").val();
        var mobNo = $("#aregmobNo").val();
        var uname = $("#areguname").val();
        objCustomer = {
            first_name: $("#areguname").val(),
            username: $("#aregemail").val(),
            mobile: $("#aregmobNo").val(),
            password: $("#regupwd").val(),
        };
        intValidation = registerValidations(objCustomer);
       
        if (1 == intValidation) {
            strCustomer = makeString(objCustomer);
           
            if ('' != strCustomer) {
                saveCustomer(objCustomer);
            } else {
//Need to think what we do
                return false;
            }
        } else {
            return FALSE;
        }
    });
     $('#resendbtn1').click(function ()
    {
        var objResendToken = {};
        objResendToken = {
            mobile: strMobile,
            customerId: intCustomerId,
        };
        $.post(webUrl + 'Login/Customer/resendToken', objResendToken, function (response) {
            var objResendResponse = 0;
            objResendResponse = getObjectLength(response);
            if (objResendResponse > 0 && '' != response.data.smsToken) {
                strSMSToken = response.data.smsToken;
                strToken = response.data.verifyToken;
                return 1;
            } else {
                return false;
            }
        });
    });
     $('#make_order').click(function () {
            window.location = '<?php echo Yii::app()->params['webURL'] . '/Self/SelfDrive/billingNewOrder' ?>';
        });
    /**
     * @author Ctel
     * @param object objCustomer
     * @returns integer It will return an integer response
     * @ignore Need to change
     */
    function saveCustomer(objCustomer) {
        $.post(webUrl + 'Login/Customer/create', objCustomer, function (response) {
            
            
            
            var intResponseLen = 0;
            intResponseLen = getObjectLength(response);
         
           
            if (intResponseLen > 0 && response.data.customerId > 0) {
                clearCustomerInputs();
                strToken = response.data.verifyToken;
                intCustomerId = response.data.customerId;
                strFirstName = response.data.first_name;
                strSMSToken = response.data.smsToken;
                $('#signup-model').modal('hide');
                $('#mps-otp').modal('show');
            } else {
                
                    $("#aregemailErr").text(response.data.username);
                    $("#passwordErr").text(response.data.password);
                    $("#nameErr").text(response.data.first_name);
                    $("#emailErr").text(response.data.username);
                    $("#mobileErr").text(response.data.mobile);
                    $("#newpasswordErr").text(response.data.password);
                $('#mps-otp').modal('hide');
            }

        });
    }
    
$('#averify').click(function ()
    {
        var objVerifcationDet = {};
        objVerifcationDet = {
            mobile: strMobile,
            otp: strToken,
            customerId: intCustomerId,
            first_name: strFirstName,
            smsToken: strSMSToken,
        }
        verfiyToken(objVerifcationDet);
    });
    /**
     * @author Ctel
     * @param object objCustomer
     * @returns integer It will return an integer response
     */
    function registerValidations(objCustomer) {
        var intResponse = 0;
        intResponse = 1;
        return intResponse;
    }

    /**
     * @author Ctel
     * @param object objectData
     * @returns string It will return a string
     */
    function makeString(objectData) {
        var strResponse = objSource = '';
        objSource = objectData;
        strResponse = JSON.stringify(objectData);
        return strResponse;
    }

    /**
     * @author Ctel
     * @param object objData
     * @returns integer It will return length of the object
     */
    function getObjectLength(objData) {
        var intLength = 0;
        if ('' != objData) {
            intLength = Object.keys(objData).length;
        }
        return intLength;
    }


    /**
     * @author Ctel
     * @ignore It will handle verification process
     */
    $('#averify_m').click(function ()
    {
        var objVerifcationDet = {};
        objVerifcationDet = {
            mobile: strMobile,
            otp: strToken,
            customerId: intCustomerId,
            first_name: strFirstName,
            smsToken: strSMSToken,
        }
        verfiyToken(objVerifcationDet);
    });

    /**
     * @author Ctel
     * @param object objVerifcationDet
     * @returns boolean It will return either true or false response
     */
    function verfiyToken(objVerifcationDet) {
        $.post(webUrl + 'Login/Customer/verifyToken', objVerifcationDet, function (response) {
            var objVerifyResponse = 0;
            objVerifyResponse = getObjectLength(response);
            if (objVerifyResponse > 0) {
                $('#mps-otp').modal('hide');
                location.reload();
                return true;
            } else {
                return false;
            }
        });
    }

    /**
     * @author Ctel
     * @returns integer It will return an integer response
     */
    function clearCustomerInputs() {
        $("#aregemail").val('');
        $("#regupwd").val('');
        $("#aregmobNo").val('');
        $("#areguname").val('');
        $("#verifyidd").val('');
        return 1;
    }
    ;


    /**
     * @author Ctel
     * @ignore It will handle resend verification code activities
     */
    $('#resendbtn').click(function ()
    {
        var objResendToken = {};
        objResendToken = {
            mobile: strMobile,
            customerId: intCustomerId,
        };
        $.post(webUrl + 'Login/Customer/resendToken', objResendToken, function (response) {
            var objResendResponse = 0;
            objResendResponse = getObjectLength(response);
            if (objResendResponse > 0 && '' != response.data.smsToken) {
                strSMSToken = response.data.smsToken;
                strToken = response.data.verifyToken;
                return 1;
            } else {
                return false;
            }
        });
    });

    /**
     * @author Digital Today
     * @ignore It will handle login functionality
     */
    /*$('#btnsub_login').click(function ()
    {
        var objLogin = {};
        objLogin = {
            username: $('#user_name').val(),
            password: $('#user_password').val()
        }
        $.post(webUrl + 'Login/Customer/SignIN', objLogin, function (response) {
            alert(response)
            if (1 == response.data) {
                location.reload();
                return true;
            } else {
                return false;
            }

        });
    });*/
$('#btnsub_login').click(function ()
        {
            var objLogin = {};
            objLogin = {
                username: $('#user_name').val(),
                password: $('#user_password').val()
            }
            $.post(webUrl + 'Login/Customer/SignIN', objLogin, function (response) {
                if (1 == response.data) {
                    
                    window.location = '<?php echo Yii::app()->params['webURL'] . '/Self/SelfDrive/billingNewOrder' ?>';
                    return true;
                } else {
                    //return false;
                    $("#usernameErr").text(response.data.username);
                    $("#passwordErr").text(response.data.password);
                }

            });
        });
         $('#btnsub_login').click(function ()
    {
            $("#errMessage").html("");            
            $("#usernameErr").text("");
            $("#passwordErr").text("");
        var objLogin = {};
        objLogin = {
            username: $('#user_name').val(),
            password: $('#user_password').val()
        }
        $.post(webUrl + 'Login/Customer/SignIN', objLogin, function (response) {            
            if (1 == response.data) {
                location.reload();
                return true;
            } else {               
                    $("#usernameErr").text(response.data.username);                                                      
                    $("#passwordErr").text(response.data.password);
                if(!response.data.username && !response.data.username){
                    $("#errMessage").html(response.message);                    
                }
                return false;
            }

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
                                            <a class="btn btn-zoom" href="http://metrepersecond.com/Staging/MPS/images/uploadimages/selfdrive/cars/web/450X260/<?php echo $SelfImages[0]['image_name'];?>" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                            <a href="http://metrepersecond.com/Staging/MPS/images/uploadimages/selfdrive/cars/web/450X260/<?php echo $SelfImages[0]['image_name'];?>" data-gal="prettyPhoto"><img class="img-responsive" src="http://metrepersecond.com/Staging/MPS/images/uploadimages/selfdrive/cars/web/450X260/<?php echo $SelfImages[0]['image_name'];?>" alt=""/></a>
                                        </div>
										
           
										    <?php 
										
									foreach($SelfImages as $SelfImage)
									{ 
									?>
										<div class="item">
                                            <a class="btn btn-zoom" href="http://metrepersecond.com/Staging/MPS/images/uploadimages/selfdrive/cars/web/450X260/<?php echo $SelfImage['image_name'];?>" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                            <a href="http://metrepersecond.com/Staging/MPS/images/uploadimages/selfdrive/cars/web/450X260/<?php echo $SelfImage['image_name'];?>" data-gal="prettyPhoto"><img class="img-responsive" src="http://metrepersecond.com/Staging/MPS/images/uploadimages/selfdrive/cars/web/450X260/<?php echo $SelfImage['image_name'];?>" alt="<?php echo $VehicleDetails[0]['BrandName'];?>"/></a>
                                        </div>
                                                                        <?php //$i++;
                                                                        }
																		?> 
                                    </div>
                                        <div class="row car-thumbnails">
								
                                        <div class="col-xs-2 col-sm-2 col-md-3"><a href="#" onclick="jQuery('.img-carousel').trigger('to.owl.carousel', [0,300]);"><img src="http://metrepersecond.com/Staging/MPS/images/uploadimages/selfdrive/cars/web/450X260/<?php echo $SelfImage['image_name'];?>" width="70" alt="<?php echo $VehicleDetails[0]['BrandName'];?>"/></a></div>
                                    
                                        <div class="col-xs-2 col-sm-2 col-md-3"><a href="#" onclick="jQuery('.img-carousel').trigger('to.owl.carousel', [<?php //echo $j+1; ?>,300]);"><img src="http://metrepersecond.com/Staging/MPS/images/uploadimages/selfdrive/cars/web/450X260/<?php echo $SelfImage['image_name'];?>" width="70" alt="<?php echo $VehicleDetails[0]['BrandName'];?>"/></a></div>
                                       
									
									</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="car-details">
                                        <div class="list">
                                            <ul>
                                                <li class="title">
												
                                                    <h2><?php echo $VehicleDetails[0]['BrandName'];?>  <?php echo $VehicleDetails[0]['ModelName']?> <span><?php //echo $bookorder['variant']; ?></span></h2>
                                                    Excess Kms <?php echo $VehicleDetails[0]['extrarate'];?>Rs/ per Kms
                                                </li>
                                                <li>Security Deposit <?php echo $VehicleDetails[0]['deposit'];?>Rs</li>
                                                <li>Price Per Hour <?php echo $VehicleDetails[0]['priceperhr'];?>Rs</li>
                                                <li>Seating Capacity <?php echo $VehicleDetails[0]['seating'];?></li>
                                            </ul>
                                        </div>
                                        <div class="price">
                                            <strong><i class="fa fa-inr"></i> <?php echo $totalprice; ?></strong>
											<input type="hidden" id="pricetag" name="pricetag" value="<?php //echo $bookorder['price']; ?>"/>
											<input type="hidden" id="model_id" name="models_id" value="<?php //echo $bookorder['models_id']; ?>"/>
											<input type="hidden" id="make_id" name="makesid" value="<?php //echo $bookorder['makes_id']; ?>"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="page-divider half transparent"/>

                        <h3 class="block-title alt">Vehicle Features </h3>
                        <form role="form" class="form-extras">
							<?php 
                                                              
                                                               $SelfFeatures=explode(',',$FeatureDetails[0][0]['Features']);
                                                             
                                                               if(count($SelfFeatures) > 1)
                                                               {
                                                                   $SelfFeatures = $SelfFeatures;
                                                               
                                                           
								$i=0; 
                                                                if(isset($SelfFeatures))
                                                                {
                                                                foreach($SelfFeatures as $FeatureDetail) {
								?>
                                <div class="col-md-3 checkbox checkbox-danger">
                                    <input id="checkboxl1" type="checkbox" disabled="disabled" checked="checked">
                                    <label for="checkboxl1"><?php echo $FeatureDetail; ?></label>
                                </div>
								<?php $i++; }
                                                                }
                                                                
                                                               }else{?>
                                <div class="col-md-3 checkbox checkbox-danger">
                                    <input id="checkboxl1" type="checkbox" disabled="disabled" checked="checked">
                                    <label for="checkboxl1"><?php echo $FeatureDetails[0][0]['Features']; ?></label>
                                </div>
                                                <?php
                                                     }
                                                ?>
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
                                    <div class="media-body"><p><?php 
                                    if(isset($location))
                                    {
                                         echo $location;
                                    }
                                    
                                    ?></p></div>
                                </div>
                                <div class="media">
                                     <h5 class="widget-title-sub">Start Trip</h5>
                                    <span class="media-object pull-left"><i class="fa fa-location-arrow"></i></span>
                                   <div class="media-body"><p><?php 
                                   if(isset($SelfDriveDetails['FromDate']))
                                    {
                                         echo $SelfDriveDetails['FromDate']; 
                                    }
                                   ?></p></div> 
                                </div>
                                <h5 class="widget-title-sub">End Trip</h5>
                                <div class="media">
                                    <span class="media-object pull-left"><i class="fa fa-calendar"></i></span>
                                    <div class="media-body"><p><?php
                                    if(isset($SelfDriveDetails['ToDate']))
                                    {
                                       echo $SelfDriveDetails['ToDate'];
                                    }
                                    
                                    ?></p></div>
                                </div>
                             
                                                                 <?php
                                $objSession = Yii::app()->session;
                                if (isset(Yii::app()->session['customerName']) && !empty(Yii::app()->session['customerName'])) {
                                    //$objSession['order_info'] = $order_details;
                                    ?>
                                    <a class="btn btn-theme btn-theme-dark booknow-lst" id="make_order" name="make_order">Book Now</a>
                                    <?php
                                } else {
                                    ?>
                                    
                                    <a class="btn btn-theme btn-theme-dark booknow-lst" id="btnsub1"  data-toggle = "modal" data-target = "#signup-model">Book Now</a>
                                    <?php
                                }
                                ?>
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

                        	<input type="hidden" id="id1" name="id" value="">
							<input type="hidden" id="amount1" name="amount" value="">
							<input type="hidden" id="fromdate1" name="fromdate" value="">
							<input type="hidden" id="todate1" name="todate" value="">
							<input type="hidden" id="bookloc1" name="bookloc" value="">
							<input type="hidden" name="makes_idd" id="makes_idd">
				        	<input type="hidden" name="model_idd" id="model_idd">

                            <div class="col-md-12">
                                <div class="form-group"><input class="form-control" type="text" name="user_name" id="user_name" placeholder="User name or email"></div>
                                <!--<div id="usernameErr"></div>-->
                                 <div id="usernameErr" style="colodetailsr:red;padding-left: 20px;"></div>
                            </div>                               
                            <div class="col-md-12">
                                <div class="form-group"><input class="form-control" type="password" name="user_password" id="user_password" placeholder="Enter Password"></div>
                                 <!--<div id="passwordErr"></div>-->
                                 <div id="passwordErr" style="color:red;padding-left: 20px;"></div>
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
                                                <div id="errMessage" style="color:red;padding-left: 20px;"></div>
                                                 <div id="usernameErr" style="color:red;padding-left: 20px;"></div>
                                                   <div id="passwordErr" style="color:red;padding-left: 20px;"></div>
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
                                         <div id="aregemailErr" style="color:red;padding-left: 20px;"></div>
		                    </div>
		                    <div class="col-md-12">
		                        <div class="form-group"><input class="form-control alt" type="text" name="areguname" id="areguname" placeholder="Name" required></div>
                                          <div id="nameErr" style="color:red;padding-left: 20px;"></div>
		                    </div>
		                    <div class="col-md-12">
		                        <div class="form-group has-icon has-label">
		                            <input type="text" class="form-control alt" id="aregmobNo" name="aregmobNo" placeholder="Enter Mobile Number*" maxlength="10" required>
                                            <div id="mobileErr" style="color:red;padding-left: 20px;"></div>
		                        </div>
		                    </div>
		                    <div class="col-md-12">
		                        <div class="form-group"><input class="form-control alt" type="password" name="regupwd" id="regupwd" placeholder="Enter Password*" required></div>
                                        
                                        <div id="newpasswordErr" style="color:red;padding-left: 20px;"></div>
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
				   	<input class="form-control" type="hidden" name="hidvalue2" id="hidvalue1" placeholder="User name or email">
				    <div class="col-md-12 otp-inputtxt">
			            <div class="form-group"><input class="form-control alt text-center" type="text" name="bvregemail" id="verifyidd"  placeholder="Enter Vericfication code*" required></div>
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