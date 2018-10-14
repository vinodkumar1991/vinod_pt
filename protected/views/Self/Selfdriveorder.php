
<link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/owl-carousel2/assets/owl.carousel.min.css" rel="stylesheet">
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/owl-carousel2/owl.carousel.min.js"></script>

<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>            
       <script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/jquery.geocomplete.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/dist/locationpicker.jquery.min.js"></script>
        
        <style>
            .btn-theme{
                margin-left: -10px;
            }
            .plsordr{
                width: 109%;
            }
        </style>
<!-- CONTENT AREA -->
    <div class="content-area">

        <!-- BREADCRUMBS -->
        <section class="page-section breadcrumbs text-right">
            <div class="container">
                <div class="page-header">
                    <h1>Vehicle Booking</h1>
                </div>
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Pages</a></li>
                    <li class="active">Booking &amp; Payment</li>
                </ul>
            </div>
        </section>
        <!-- /BREADCRUMBS -->

        <!-- PAGE WITH In details of selected vehicle -->
        <section class="page-section with-sidebar sub-page">
            <div class="container">
                <div class="row">
                    <?php if(!empty($BookVehicleDetails)) { 
                         $objSession = Yii::app()->session;
                         $objSession["self_order_info"]=$BookVehicleDetails;
                        ?>
                    <!-- CONTENT -->
                    <div class="col-md-9 content" id="content">
                        <h3 class="block-title alt">Vehicle Information</h3>
                        <div class="car-big-card alt">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="owl-carousel img-carousel">
                                        <?php if(!empty($BookVehicleDetails["vehicle_images"])) {
                                            foreach($BookVehicleDetails["vehicle_images"] as $images) {
                                                if($images['is_parent'] == 1){
                                                $path1= Yii::app()->params['adminImgURL'] . $images["vehicle_parent_image_path"] . $images["self_vehicle_image"];
                                                }else{
                                                   $path1= Yii::app()->params['adminImgURL'] . $images["vehicle_multi_image_path"] . $images["self_vehicle_image"];
                                                  
                                                }  $path2 = Yii::app()->params['adminImgURL'] . $images["vehicle_parent_image_path"] . 'car_default.jpg';
                                               ?>
                                        <div class="item">
                                            <a class="btn btn-zoom" href="<?php echo $path1; ?>" onerror='this.onerror=null;this.href="<?php echo $path2; ?>"' data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                            <a href="<?php echo $path1; ?>" onerror='this.onerror=null;this.href="<?php echo $path2; ?>"' data-gal="prettyPhoto">
                                                <img class="img-responsive" src="<?php echo $path1; ?>" alt="" onerror='this.onerror=null;this.src="<?php echo $path2; ?>"' /></a>
                                        </div>
                                        <?php } }?>
                                       
                                    </div>
                                    
                                    <div class="row car-thumbnails">
                                        
                                         <?php if(!empty($BookVehicleDetails["vehicle_images"])) {
                                            foreach($BookVehicleDetails["vehicle_images"] as $images) {
                                                 if($images['is_parent'] == 1){
                                                $path1= Yii::app()->params['adminImgURL'] . $images["vehicle_parent_image_path"] . $images["self_vehicle_image"];
                                                }else{
                                                   $path1= Yii::app()->params['adminImgURL'] . $images["vehicle_multi_image_path"] . $images["self_vehicle_image"];
                                                  
                                                }
                                                $path2 = Yii::app()->params['adminImgURL'] . $images["vehicle_parent_image_path"] . 'car_default.jpg';
                                               ?>
                                        <div class="col-xs-6 col-sm-4 col-md-2"><a href="#" onclick="jQuery('.img-carousel').trigger('to.owl.carousel', [0,300]);">
                                                <img src="<?php echo $path1; ?>" alt="" onerror='this.onerror=null;this.src="<?php echo $path2; ?>"' alt=""/></a></div>
                                         <?php } }?>
                                    </div>
                                    
                                </div>
                                <div class="col-md-4">
                                    <div class="car-details">
                                        <div class="list">
                                            <ul>
                                                <li class="title">
                                                    <h2><?php echo isset($BookVehicleDetails['vehicle_brand_name'])? $BookVehicleDetails['vehicle_brand_name'] : NULL ; ?> 
                                                        <?php echo isset($BookVehicleDetails['vehicle_model_name']) ? $BookVehicleDetails['vehicle_model_name'] :NULL; ?> 
                                                        <span><?php echo isset($BookVehicleDetails['vehicle_variant_name']) ? $BookVehicleDetails['vehicle_variant_name'] : NUll; ?></span>
                                                    </h2> 
                                                        <?php echo isset($BookVehicleDetails['vehicle_seating_capacity']) ? ($BookVehicleDetails['vehicle_seating_capacity'] . '-Seater') : NUll; ?>
                                               </li>
                                                <li>Price per Hour : <?php echo isset($BookVehicleDetails['pphr']) ? $BookVehicleDetails['pphr'] : NUll; ?></li>
                                                <li>Kms per Hour : <?php echo isset($BookVehicleDetails['kmph']) ? $BookVehicleDetails['kmph'] : NUll; ?></li>
                                                <li>Total Fare: <?php echo isset($BookVehicleDetails['total_amount']) ? $BookVehicleDetails['total_amount'] : NUll; ?></li>
                                                <li>Security Deposit : <?php echo isset($BookVehicleDetails['security_deposit']) ? $BookVehicleDetails['security_deposit'] : NUll; ?></li>
<!--                                                <li>Tax :<?php //echo isset($BookVehicleDetails['tax_amount']) ? $BookVehicleDetails['tax_amount'] : NUll; ?></li>
                                                -->
                                            </ul>
                                        </div>
                                        <div class="price">
                                            <strong>(<?php echo isset($BookVehicleDetails['final_amount']) ? $BookVehicleDetails['final_amount'] : NUll; ?>)</strong> Included all taxes
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="page-divider half transparent"/>
                        <h3 class="block-title alt">Features</h3>
                        <form role="form" class="form-extras">
                            <div class="row">
                                <div>
                                    <?php
                                    if (!empty($BookVehicleDetails['vehicle_features'])) {
                                        foreach ($BookVehicleDetails['vehicle_features'] as $features) {
                                               $featureimagepath= Yii::app()->params['adminImgURL'] . $features["vehicle_feature_image_path"] . $features["feature_image"];
                                          ?><div class="col-md-3">
                                            <div class="checkbox checkbox-danger">
                                                <img src="<?php echo $featureimagepath; ?>" alt="" /> <label for="checkboxl1"><?php echo $features['feature_name']; ?></label>
                                            </div> 
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>

                            </div>

                        </form>
                   </div>
                    <!-- /CONTENT -->

                    <!-- SIDEBAR -->
                    <aside class="col-md-3 sidebar" id="sidebar">
                        <!-- widget detail reservation -->
                    <div class="text-center" style="margin-bottom: 10px;">
                        <a class = "btn ripple-effect btn-theme" id="selfdrive_book1" name="selfdrive_book1" data-toggle = "modal" data-target = "#signup-model" style="width:100%">Book Now</a>
                                        </div>
                        <form  action="<?php echo Yii::app()->params['webURL'] . 'Self/SelfDrive/SelfDriveOrderBooking/' ?>" method="POST" id="bookSelfdrive" name="bookSelfdrive">
                                <div class="widget shadow widget-details-reservation">
                                    <h4 class="widget-title">Detail Reservation</h4>
                                    <div class="widget-content">
                                        <h5 class="widget-title-sub">Picking Up Location</h5>
                                        <div class="media">
                                            <span class="media-object pull-left"><i class="fa fa-calendar"></i></span>
                                            <div class="media-body"><p><?php echo isset($SelfFormDetails['TripStart']) ? $SelfFormDetails['TripStart'] : NUll; ?></p></div>
                                            <input type="hidden" id="start_date" name="start_date" value="<?php echo isset($SelfFormDetails['TripStart']) ? $SelfFormDetails['TripStart'] : NUll; ?>" />
                                            <input type="hidden" id="end_date" name="end_date" value="<?php echo isset($SelfFormDetails['TripEnd']) ? $SelfFormDetails['TripEnd'] : NUll; ?>" />
                                            <input type="hidden" name="selflocation" id="selflocation" class="selflocation" value="<?php echo isset($SelfFormDetails['selfcustomerlocation']) ? $SelfFormDetails['selfcustomerlocation'] : NUll; ?>"/>
                                            <input type="hidden" name="location" id="location" value="<?php echo isset($SelfFormDetails['location']) ? $SelfFormDetails['location'] : NULL; ?>" />

                                        </div>
                                        <div class="media">
                                            <span class="media-object pull-left"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                            <div class="media-body">
                                                <?php $pickuplocation = isset($SelfFormDetails['pickupmode']) ? $SelfFormDetails['pickupmode'] : Null;
                                                if ($pickuplocation == 'doorstep') {
                                                    ?>
                                                    <input type="hidden" name="is_door_step" id="is_door_step" value="1" />
                                                    <input type="hidden" name="is_pickup" id="is_door_step" value="0" />
                                                    <input type="button" value="change location" class="change-loc-text" id="change_loc" />
                                                    <input type="text" style="display:none;" class="change-loc-input geocomplete"  id="self_book_location" name="self_book_location"  placeholder="Location">
<!--                                                     <input type="hidden" name="location" id="location" value="<?php echo isset($selfForm->location) ? $selfForm->location : NULL; ?>">
                            -->
                                                    <input type="hidden" name="pickup_location_latlng" id="pickup_location_latlng" value="<?php echo isset($SelfFormDetails['location']) ? $SelfFormDetails['location'] : NULL; ?>" />
                                                    <textarea id="pickup_location" name="pickup_location" class="form-control" readonly=""><?php echo $SelfFormDetails['selfcustomerlocation'];
                                                    
                                        }  ?></textarea>
                                          <?php if ($pickuplocation == 'pickup') { ?>
                                                    <input type="hidden" name="is_door_step" id="is_door_step" value="0" />
                                                    <input type="hidden" name="is_pickup" id="is_pickup" value="1" />
                                                    <input type="hidden" name="pickup_location_latlng" id="pickup_location_latlng" value="<?php echo isset($SelfFormDetails['Trip_agent_location']) ? $SelfFormDetails['Trip_agent_location'] : NULL; ?>" />
                                                    <textarea id="pickup_location" name="pickup_location" class="form-control" readonly=""><?php echo $SelfFormDetails['selfagentlocation'];
                                            } ?></textarea>
                                                <div id="err_pickuplocation"></div>
                                            </div>
                                        </div>
                                        <h5 class="widget-title-sub">Droping Off Location</h5>
                                        <div class="media">
                                            <span class="media-object pull-left"><i class="fa fa-calendar"></i></span>
                                            <div class="media-body"><p><?php echo isset($SelfFormDetails['TripEnd']) ? $SelfFormDetails['TripEnd'] : NUll; ?></p></div>
                                        </div>
                                        <div class="media">
                                            <span class="media-object pull-left"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                            <div class="media-body">
                                               <?php if ($pickuplocation == 'doorstep') { ?>
                                                   
                                                <input type="hidden" name="drop_location_latlng" id="drop_location_latlng" value="<?php echo isset($SelfFormDetails['location']) ? $SelfFormDetails['location'] : NULL; ?>" />
                                                <textarea id="drop_location" name="drop_location" readonly=""><?php echo trim(isset($SelfFormDetails['selfcustomerlocation']) ? $SelfFormDetails['selfcustomerlocation'] : NUll); 
                                                } ?> </textarea>
                                                
                                                <?php if ($pickuplocation == 'pickup') { ?>
                                                <input type="hidden" name="drop_location_latlng" id="drop_location_latlng" value="<?php echo isset($SelfFormDetails['Trip_agent_location']) ? $SelfFormDetails['Trip_agent_location'] : NULL; ?>" />
                                                <textarea id="drop_location" name="drop_location" readonly=""><?php echo trim(isset($SelfFormDetails['selfagentlocation']) ? $SelfFormDetails['selfagentlocation'] : NUll); 
                                                } ?></textarea>
                                                
                                                
                                                <div id="err_droplocation"></div>
                                            </div>
                                        </div>
                                        <div class="reservation-now">
                                            <div class="checkbox">
                                                <input id="self_book_agree" name="self_book_agree" type="checkbox" checked required>
                                                <label for="checkboxa1">I accept all information and Payments etc</label>
                                                <div id="legal"></div>
                                            </div>

                                        </div>

                                        <!--Button :: START-->
                                        <div class="text-center" style="margin-bottom: 10px;">
                                            <a class = "btn ripple-effect btn-theme plsordr" id="selfdrive_book" name="selfdrive_book" data-toggle = "modal" data-target = "#signup-model">Book Now</a>
                                        </div>
                                        <!--Button :: END-->
                                    </div>
                                </div>
                            </form>
                        
                        <!-- /widget detail reservation -->
                       
                        <!-- widget helping center -->
                      <div class="widget shadow widget-helping-center">
                              
                                <h4 class="widget-title">
                                    <?php
                                    echo Yii::app()->params['customer_info']['tag'];
                                    ?>
                                </h4>
                                <!--Support Tag :: END-->
                                <div class="widget-content">
                                    <p>
                                        <?php
                                        echo Yii::app()->params['customer_info']['message'];
                                        ?>
                                    </p>
                                    <h5 class="widget-title-sub">
                                        <?php
                                        echo Yii::app()->params['customer_info']['support_mobile'];
                                        ?>
                                    </h5>
                                    <p>
                                        <a href="mailto:<?php echo Yii::app()->params['customer_info']['support_mail']; ?>">
                                            <?php echo Yii::app()->params['customer_info']['support_mail']; ?>
                                        </a>
                                    </p>
                                </div>
                            </div> 
               <!-- /widget helping center -->
                    </aside>
                    <!-- /SIDEBAR -->
        <?php } ?>
                </div>
            </div>
        </section>
        <!-- /PAGE WITH SIDEBAR -->
        
          <!-- popup for login and sign up --> 
    <div class = "customer-signup modal fade signin_signup_form" id ="signup-model" tabindex = "-1" role = "dialog" aria-labelledby = "myModalLabel" aria-hidden = "true">   
        <div class = "modal-dialog">
            <div class = "modal-content pull-left">
                <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">&times;</button>       
                <div class = "modal-body pull-left">
                    <div id="form2">
                        <ul id = "myTab" class = "nav nav-tabs">
                            <!--Login :: START-->
                            <li class = "active">
                                <a href = "#logintab" data-toggle ="tab" id="selfdrive_login_tab" name="selfdrive_login_tab">Login</a>
                            </li>
                            <!--Login :: END-->
                            <!--SignUp :: START-->
                            <li>
                                <a href = "#signuptab" data-toggle ="tab" id="selfdrive_login_tab" name="selfdrive_login_tab">Sign Up</a>
                            </li>   
                            <!--SignUp :: END-->
                        </ul>


                        <div id = "myTabContent" class = "tab-content">	
                            <!--Login Tab :: START-->
                            <div class = "tab-pane fade in active" id = "logintab">
                                <!--Notifications Info :: START-->
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
                                <!--Notifications Info :: END-->

                                <!--Login :: START-->
                                <div class="col-md-7">  
                                    <!--Username :: START-->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="selfdrive_username" id="selfdrive_username" placeholder="Enter Email Address"/>
                                        </div>
                                        <span id="selfdrive_usernameErr" style="color:red;padding-left:20px;"></span>
                                    </div>                               
                                    <!--Username :: START-->
                                    <!--Password :: START-->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input class="form-control" type="password" name="selfdrive_password" id="selfdrive_password" minlength="4" maxlength="4" placeholder="Enter Pin"/>
                                        </div>
                                        <span id="selfdrive_passwordErr" style="color:red;padding-left:20px;"></span>
                                        <span id="wrong_password" style="color:red;padding-left:20px;"></span>
                                    </div>
                                    <!--Password :: END-->
                                    <div class="col-md-6">                                        
                                    </div>
                                    <div class="col-md-6 text-right">
                                       <a href="<?php echo Yii::app()->params['webURL'] . 'Login/Customer/ForgotPassword' ?>" target="_blank" class="forgot-password">forgot pin?</a>

                                    </div>
                                    <!--Button :: START-->
                                    <div class="col-md-12 text-center mrg-top-20">						
                                        <div id="loginerror_login"></div>
                                        <input type="button" value="Login" id="selfdrive_login_btn" name="selfdrive_login_btn" class="btn btn-theme btn-theme-dark selfdrive_login_btn"/>
                                    </div>
                                    <!--Button :: END-->
                                </div>
                                <!--Login :: END-->
                            </div>
                            <!--Login Tab :: END-->


                            <!--SignUP Tab :: START-->
                            <div class = "tab-pane fade" id = "signuptab">
                                <!--Notification Info :: START-->
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
                                <!--Notification Info :: END-->

                                <!--Register Form :: START-->
                                <div class="col-md-7">	   
                                    <!--Username :: START-->                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input class="form-control alt" type="text" name="selfdrive_reg_uname" id="selfdrive_reg_uname" placeholder="Enter Fullname"/>
                                        </div>
                                        <span id="selfdrive_reg_nameerror"  style="color:red;padding-left:20px;"></span>
                                    </div>		
                                    <!--Username :: END-->
                                    <!--Email :: START-->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input class="form-control alt" type="text" name="selfdrive_reg_email" id="selfdrive_reg_email"  placeholder="Enter Email"/>
                                        </div>
                                        <span id="selfdrive_reg_usernameerror"  style="color:red;padding-left:20px;"></span>
                                    </div>
                                    <!--Email :: END-->
                                    <!--Mobile Number :: START-->
                                    <div class="col-md-12">
                                        <div class="form-group has-icon has-label">
                                            <input type="text" class="form-control alt" id="selfdrive_reg_mob" name="selfdrive_reg_mob" placeholder="Enter Mobile Number" maxlength="10"/>
                                        </div>
                                        <span id="selfdrive_reg_mobileerror"  style="color:red;padding-left:20px;"></span>
                                    </div>
                                    <!--Mobile Number :: END-->
                                    <!--Password :: START-->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input class="form-control alt" type="password" name="selfdrive_reg_pwd" id="selfdrive_reg_pwd" minlength="4" maxlength="4" placeholder="Enter Pin"/>
                                        </div>
                                        <span id="selfdrive_reg_pwderror"  style="color:red;padding-left:20px;"></span>
                                    </div>
                                    <!--Password :: END-->
                                    <!--Button :: START-->
                                    <div class="col-md-12 text-center mrg-top-20">
                                        <input type="button" value="Create Account" id="selfdrive_reg_btn" name="selfdrive_reg_btn" class="btn btn-theme btn-theme-dark"/>
                                    </div>
                                    <div class="col-md-6 mrg-top-20">

                                        <div id="status1"></div>
                                    </div>
                                    <!--Button :: END-->
                                </div>
                                <!--Register Form :: END-->
                            </div>
                            <!--SignUP Tab :: END-->

                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.Registration Sign up Modal -->
    </div>
        
          <!--OTP PopUP :: START-->
    <div id="selfdrive_otp" class="modal fade otp-popup" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div id="verifyform1">
                    <div class="verification-model">
                        <!--OTP Label :: START-->
                        <div class="dwn-app text-center">
                            <i class="fa fa-mobile animated" aria-hidden="true"></i>
                            <h4>OTP Verification</h4>
                        </div>
                        <!--OTP Label :: END-->
                        <!--OTP :: START-->
                        <div class="col-md-12 otp-inputtxt">
                            <div class="form-group">
                                <input class="form-control alt text-center" type="text" name="selfdrive_otp_code" id="selfdrive_otp_code"  placeholder="Enter Vericfication Code" maxlength="6"x/>
                            </div>
                            <span id="selfdrive_invalid_otp"></span>
                        </div>
                        <!--OTP :: END-->
                        <!--Verify OTP :: START-->
                        <div class="col-md-6 text-right">
                            <div id="emailerror1"></div>
                            <input type="button" value="Submit" id="selfdrive_otp_verify" name="selfdrive_otp_verify" class="btn btn-theme submit-otp"/>
                        </div>
                        <!--Verify OTP :: END-->
                        <!--Resend OTP :: START-->
                        <div class="col-md-6 text-left">
                            <div id="emailerror"></div>
                            <input type="button" value="ReSend" id="selfdrive_resend_otp" name="selfdrive_resend_otp" class="btn btn-theme btn-theme-dark submit-otp"/>
                        </div>
                        <!--Resend OTP :: END-->
                        <span id="error"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--OTP PopUP :: END-->

    </div>
    <!-- /CONTENT AREA -->
    
    <script type="text/javascript">
    //Login
    var selfdrive_sms_token = '';
    var selfdrive_customer = '';
    var selfdrive_otp = '';
    var selfdrive_fullname = '';
    var selfdrive_mobile = '';
    var isLoggedIn = '<?php echo Yii::app()->session['customerID']; ?>';
 window.oncontextmenu = function () {
   return false;
}
        $(document).keydown(function(e){
         if(e.which === 123){
            return false;
         }
     });    
if ('' == isLoggedIn) {
        isLoggedIn = 0;
    }
    $("#selfdrive_login_tab").click(function () {
        makeLoginEmpty();
        clearRegErrors();
        $("#selfdrive_passwordErr").html('');
                    $("#selfdrive_usernameErr").html('');
    });
    function makeLoginEmpty() {
        $('#selfdrive_username').val('');
        $('#selfdrive_password').val('');
        return true;
    }

    //SignUp
    $('#selfdrive_login_tab').click(function () {
        makeSignupEmpty();
        clearRegErrors();
    });
    function makeSignupEmpty() {
        $("#selfdrive_reg_uname").val('');
        $("#selfdrive_reg_email").val('');
        $("#selfdrive_reg_mob").val('');
        $("#selfdrive_reg_pwd").val('');
        return true;
    }

    //Login
    $('#selfdrive_login_btn').click(function () {
        var objLogin = {};
        objLogin = {
            username: $('#selfdrive_username').val(),
            password: $('#selfdrive_password').val(),
        };
        if (isLoggedIn < 0 || '' == isLoggedIn) {
            $.post(webUrl + 'Login/Customer/SignIN', objLogin, function (response) {
                if (1 == response.data) {
                    isLoggedIn = response.customer_details.id;
                    
                    selfDriveBook();
                    return true;
                } else {
                    $("#selfdrive_passwordErr").html('');
                    $("#selfdrive_usernameErr").html('');
                    $("#wrong_password").html('');
                    if ('' != response.data.username) {
                        $("#selfdrive_usernameErr").text(response.data.username);
                    }
                    if ('' != response.data.password) {
                        $("#selfdrive_passwordErr").text(response.data.password);
                    }

                    if ('501' == response.code) {
                        $("#wrong_password").text('Invalid Pin Is Given.');
                    }
                    return false;
                }

            });
        } else {
            return true;
        }

    });
    //Register
    $('#selfdrive_reg_btn').click(function () {
        var objReg = {};
        objReg = {
            first_name: $("#selfdrive_reg_uname").val(),
            username: $("#selfdrive_reg_email").val(),
            mobile: $("#selfdrive_reg_mob").val(),
            password: $("#selfdrive_reg_pwd").val(),
        };
        $.post(webUrl + 'Login/Customer/create', objReg, function (response) {
            clearRegErrors();
            var intResponseLen = 0;
            intResponseLen = getSelfObjectLength(response);
            if (intResponseLen > 0 && response.data.customerId > 0) {
                isLoggedIn = response.data.customerId;
                selfdrive_customer = response.data.customerId;
                selfdrive_sms_token = response.data.smsToken;
                selfdrive_fullname = response.data.first_name;
                selfdrive_mobile = response.data.mobile;
                selfdrive_otp = response.data.verifyToken;
                $('#signup-model').modal('hide');
                $('#selfdrive_otp').modal('show');
            } else {
                response = response.data;
                //Fullname
                if ('' != response.first_name) {
                    $('#selfdrive_reg_nameerror').html(response.first_name);
                }
                //Email
                if ('' != response.username) {
                    $('#selfdrive_reg_usernameerror').html(response.username);
                }
                //Mobile
                if ('' != response.mobile) {
                    $('#selfdrive_reg_mobileerror').html(response.mobile);
                }
                //Password
                if ('' != response.password) {
                    $('#selfdrive_reg_pwderror').html(response.password);
                }
            }
        });
    });
    function clearRegErrors() {
        $('#selfdrive_reg_nameerror').html(' ');
        $('#selfdrive_reg_usernameerror').html(' ');
        $('#selfdrive_reg_mobileerror').html(' ');
        $('#selfdrive_reg_pwderror').html(' ');
    }

    function getSelfObjectLength(objData) {
        var intLength = 0;
        if ('' != objData) {
            intLength = Object.keys(objData).length;
        }
        return intLength;
    }

    $('#selfdrive_otp_verify').click(function () {
        var objVerifcationDet = {};
        objVerifcationDet = {
            customerId: selfdrive_customer,
            mobile: selfdrive_mobile,
            otp: $('#selfdrive_otp_code').val(),
            first_name: selfdrive_fullname,
            smsToken: selfdrive_sms_token,
        }
        verfiySelfToken(objVerifcationDet);
    });
    function verfiySelfToken(objVerifcationDet) {
        $.post(webUrl + 'Login/Customer/verifyToken', objVerifcationDet, function (response) {
            $('#selfdrive_invalid_otp').html('');
            var objVerifyResponse = 0;
            objVerifyResponse = getSelfObjectLength(response);
            if (objVerifyResponse > 0 && 'fail' != response.type) {
                $('#selfdrive_otp').modal('hide');
                 selfDriveBook();
                return true;
            } else {
                $('#selfdrive_invalid_otp').html(response.message);
                return false;
            }
        });
    }

    $('#selfdrive_resend_otp').click(function ()
    {
        $('#selfdrive_otp_code').val('');
        var objResendToken = {};
        objResendToken = {
            mobile: selfdrive_mobile,
            customerId: selfdrive_customer,
        };
        $.post(webUrl + 'Login/Customer/resendToken', objResendToken, function (response) {
            var objResendResponse = 0;
            objResendResponse = getSelfObjectLength(response);
            if (objResendResponse > 0 && '' != response.data.smsToken) {
                selfdrive_sms_token = response.data.smsToken;
                selfdrive_otp = response.data.verifyToken;
                return true;
            } else {
                return false;
            }
        });
    });
    
        $('#selfdrive_book').click(function () {
           var intBreakPoint = checkOrderInputs();
        if (1 == intBreakPoint)
          { 
           if (isLoggedIn > 0) {
            $('.signin_signup_form').attr("id", "anonamous");
            selfDriveBook();
       
         }else{
             $('#err_pickuplocation').html('');
               $('#err_droplocation').html('');
                $('#legal').html('');
             $('.signin_signup_form').attr("id", "signup-model");
                
         }
     }else{
         $('.signin_signup_form').attr("id", "anonamous");
            
        
     }
    });
    
    
     $('#selfdrive_book1').click(function () {
           var intBreakPoint = checkOrderInputs();
        if (1 == intBreakPoint)
          { 
           if (isLoggedIn > 0) {
            $('.signin_signup_form').attr("id", "anonamous");
            selfDriveBook();
       
         }else{
             $('#err_pickuplocation').html('');
               $('#err_droplocation').html('');
                $('#legal').html('');
             $('.signin_signup_form').attr("id", "signup-model");
                
         }
     }else{
         $('.signin_signup_form').attr("id", "anonamous");
            
        
     }
    });
   
    function selfDriveBook() {
     
        var intBreakPoint = checkOrderInputs();
        if (1 == intBreakPoint)
          {
           $('#bookSelfdrive').submit();
         } else {
            return false;
      }
   
    }
    
    function checkOrderInputs(){
     var pickuplocation = $('#pickup_location').val();
      var droppinglocation = $('#drop_location').val();
     var isAgree  = $('#self_book_agree').prop("checked");
    if (pickuplocation.trim() && droppinglocation.trim() && true == isAgree ) {
  
            return 1;
                } else {
                      if ('' == pickuplocation) {
                        $('#err_pickuplocation').html('<span class="error-msgtxt">Enter Your Pickup lcoation</span>');
                        $('#err_pickuplocation').focus();
                    } else if ('' == droppinglocation) {
                        $('#err_droplocation').html('<span class="error-msgtxt">Enter your Dropping location</span>');
                        $('#err_droplocation').focus();
                    } else if ('' == isAgree || 0 == isAgree || false == isAgree) {
                        $('#legal').html('<span class="error-msgtxt">Please agree the term and conditions</span>');
                        $('#legal').focus();
                    }
                    return 0;
                }
    }
    
    
    $("#change_loc").click(function(){ 
    $("#self_book_location").show();
    });

    
    $(".geocomplete").geocomplete({
            details: "form",
            types: ["geocode", "establishment"],
        });
    
$(".geocomplete").geocomplete()
.bind("geocode:result", function (event, result) {
    
  $("#pickup_location").val($(".geocomplete").val());
$("#pickup_location_latlng").val($("#location").val());
$("#drop_location_latlng").val($("#location").val());
$("#drop_location").val($(".geocomplete").val());
                    
			
	});



    
    </script>
