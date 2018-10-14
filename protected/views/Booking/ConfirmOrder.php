<div class="content-area bookservice-overview-page">
    <!--Brad crubs :: START-->
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
    <!--Brad crubs :: END-->


    <!-- PAGE WITH SIDEBAR -->
    <section class="page-section with-sidebar sub-page">
        <div class="container">
            <div class="row">
                <!-- CONTENT -->
                <div class="col-md-9 content" id="content">
                    <div class="car-big-card alt">

                        <!--Service Basic Details :: START-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="item">
                                    <img class="img-responsive" src="<?php echo Yii::app()->params['adminImgURL'] . $vehicle_path . $order_details['model_logo']; ?>" alt=""/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="pad-l-r-50">
                                    <!--Brand / Model Name :: START-->
                                    <div class="car-details">
                                        <h3 class="brnd-mdl-name">
                                            <?php
                                            echo isset($order_details['brand_name']) ? $order_details['brand_name'] : NULL . '/' . isset($order_details['model_name']) ? $order_details['model_name'] : NULL;
                                            ?> 
                                        </h3>
                                    </div>
                                    <!--Brand / Model Name :: END-->

                                    <!--Service Type :: START-->
                                    <h5>Type of Service</h5>
                                    <h4>
                                        <?php
                                        echo isset($order_details['service_name']) ? $order_details['service_name'] : NULL;
                                        ?> 
                                    </h4>
                                    <!--Service Type :: END-->

                                    <!--Package Type :: START-->
                                    <h5>Package Type</h5>
                                    <h4>
                                        <?php
                                        echo isset($order_details['plan_name']) ? $order_details['plan_name'] : NULL;
                                        ?> 
                                    </h4>
                                    <!--Package Type :: END-->

                                    <div class="est-amount">
                                        <h5>Estimated Amount</h5>
                                        <strong>
                                            <i class="fa fa-inr"></i> 
                                            <?php echo isset($order_details['total_amount']) ? $order_details['total_amount'] : NULL; ?>
                                        </strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Service Basic Details :: END-->




                        <!--Package Details :: START-->
                        <div class="row bookconfirm">
                            <div class="panel-group accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                <!--Package Description :: START -->
                                <div class="panel panel-default">
                                    <div class="row nopadding panel-heading" role="tab" id="heading2">
                                        <div class="col-md-8 pckg-lft-dtls">
                                            <i class="fa fa-wrench" aria-hidden="true"></i>
                                            <h4 class="panel-title"> Package Details</h4>
                                        </div>
                                        <div class="col-md-4 pckg-rgt-dtls">
                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                                <span class="dot"></span>
                                                <h4 class="panel-title">Click here to view details</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
                                        <div class="panel-body tab-content">
                                            <?php
                                            if (isset($order_info['sheet'])) {
                                                echo $order_info['sheet'];
                                            }
                                            ?>  
                                        </div>
                                    </div>
                                </div>
                                <!--Package Description :: END -->
                            </div>
                        </div>
                        <!--Package Details :: END-->






                        <!--Book Now :: START-->
                        <div class="row">
                            <div class="form-group pull-right">
                                <?php
                                $objSession = Yii::app()->session;
                                if (isset(Yii::app()->session['customerID']) && !empty(Yii::app()->session['customerID'])) {
                                    $objSession['order_info'] = $order_details;
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
                        <!--Book Now :: END-->


                    </div>
                </div>
                <!-- /CONTENT -->
                <!-- SIDEBAR -->
                <aside class="col-md-3 sidebar selfaside" id="sidebar">
                     <div class="text-center" style="margin-bottom: 10px;">
                            
                             <?php
                                $objSession = Yii::app()->session;
                                if (isset(Yii::app()->session['customerID']) && !empty(Yii::app()->session['customerID'])) {
                                    $objSession['order_info'] = $order_details;
                                    ?>
                                    <a class="btn ripple-effect btn-theme plsordr" id="make_order1" name="make_order1">Book Now</a>
                                    <?php
                                } else {
                                    ?>
                                    <a class="btn ripple-effect btn-theme plsordr" id="btnsub1"  data-toggle = "modal" data-target = "#signup-model">Book Now</a>
                                    <?php
                                }
                                ?>
                            
                        </div>
                    <div class="widget shadow widget-helping-center">                    
                        <h4 class="widget-title">Pickup Details</h4>
                        <div class="widget-content">
                            <div id="extra" class="aside-srvs-dtls">
                                <h5>Pickup Location</h5>
                                <p>
                                    <?php echo isset($order_details['location']) ? $order_details['location'] : NULL; ?>
                                </p>

                                <h5>Booking Date</h5>
                                <h4>
                                    <?php echo isset($order_details['booked_date']) ? $order_details['booked_date'] : NULL; ?>
                                </h4>

                                <h5>Booking Time</h5>	
                                <h4>
                                    <?php echo isset($order_details['booked_time']) ? $order_details['booked_time'] : NULL; ?>
                                </h4>

                                <div class="aside-amt-dtls">
                                    <h5>Estimated Amount</h5>
                                    <i class="fa fa-inr" aria-hidden="true"></i>
                                    <div  class="est-amount">
                                        <?php echo isset($order_details['total_amount']) ? $order_details['total_amount'] : '0.00'; ?>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <!-- /widget detail reservation -->
                    </div>
                </aside>
            </div>
        </div>
    </section>
</div>
<!-- /PAGE WITH SIDEBAR -->

<!-- login model -->
<div class = "customer-signup modal fade" id = "signup-model" tabindex = "-1" role = "dialog" 
     aria-labelledby = "myModalLabel" aria-hidden = "true">

    <div class = "modal-dialog">
        <div class = "modal-content pull-left">
            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">&times;</button>       
            <div class = "modal-body pull-left">			
                <div id="form2">
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
                             <div id="BerrMessage" align="center" style="color:red;"></div>
                            <div class="col-md-7">                        
                                <input type="hidden" name="makes_idd" id="makes_idd">
                                <input type="hidden" name="model_idd" id="model_idd">
                                <div class="col-md-12">
                                    <div class="form-group"><input class="form-control" type="text" name="user_name" id="user_name" placeholder="User name or email">
                                     <div id="BusernameErr" style="color:red;padding-left:20px;"></div>  
                                    </div>
                                </div>                               
                                <div class="col-md-12">
                                    <div class="form-group"><input class="form-control" type="password" name="user_password" id="user_password" minlength="4" maxlength="4" placeholder="Enter Pin">
                                    <div id="BpasswordErr" style="color:red;padding-left:20px;"></div>  
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkbox pull-left">
                                        <input type="checkbox" name="remember" id="checkboxa1">
                                        <label for="checkboxa1">Remember me</label>
                                    </div>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="<?php echo Yii::app()->params['webURL'] . 'Login/Customer/ForgotPassword' ?>" target="_blank" class="forgot-password">forgot Pin?</a>

                                </div>
                                <div class="col-md-12 text-center mrg-top-20">								
                                    <div id="loginerror_login"></div>
                                    <input type="button" value="Login" id="btnsub_login" name="btnsub_login" class="btn btn-theme btn-theme-dark"/> 

<!--                                    <a href = "#" onClick = "doLogin()" class="btn btn-fbook"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a>-->

                                </div>

                            </div>
                        </div>

                        <!--Sign UP Process :: START-->
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
                                <!--Name :: START-->
                                <div class="col-md-12">
                                    <div class="form-group"><input class="form-control alt" type="text" name="first_name" id="first_name" placeholder="Name" required>
                                    <div id="nameErr" style="color:red;padding-left: 20px;"></div>
                                    </div>
                                </div>
                                <!--Name :: END-->

                                <!--Email Address :: START-->
                                <div class="col-md-12">
                                    <div class="form-group"><input class="form-control alt" type="text" name="username" id="username"  placeholder="Enter Email" required>
                                    <div id="emailErr" style="color:red;padding-left: 20px;"></div>                                            
                                    </div>
                                </div>                    
                                <!--Email Address :: END-->

                                <!--Mobile :: START-->
                                <div class="col-md-12">
                                    <div class="form-group has-icon has-label">
                                        <input type="text" class="form-control alt" id="mobile" name="mobile" placeholder="Enter Mobile Number" maxlength="10" required>
                                        <div id="mobileErr" style="color:red;padding-left: 20px;"></div>                                            
                                    </div>
                                </div>
                                <!--Mobile :: END-->

                                <!--Password :: START-->
                                <div class="col-md-12">
                                    <div class="form-group"><input class="form-control alt" type="password" name="password" id="password" placeholder="Enter Pin" minlength="4" maxlength="4" required>
                                    <div id="newpasswordErr" style="color:red;padding-left: 20px;"></div>                                            
                                    </div>
                                </div>
                                <!--Password :: END-->

                                <!--Button :: START-->
                                <div class="col-md-12 text-center mrg-top-20">
                                    <div id="emailerror1"></div>
                                    <input type="button" value="Create Account" id="book_register" name="book_register" class="btn btn-theme btn-theme-dark">
                                </div>
                                <!--Button :: END-->

                            </div>
                        </div>	
                        <!--Sign UP Process :: END-->


                    </div>			
                </div>         
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->

    </div><!-- /.Registration Sign up Modal -->
</div>
<!-- End login model -->
<div id="mps-otp1" class="modal fade otp-popup" role="dialog">
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
                        <div class="form-group"><input class="form-control alt text-center" type="text" name="bregemail" id="verifyidd" autocomplete="false"  placeholder="Enter Vericfication code*" required></div>
                     <span id="book_invalid_otp"></span>
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



<script type="text/javascript">
    var intCustomer;
    var strMobileNumber;
    var strTokenAccess;
    var strName;
    var strSMSTokenAccess;
    jQuery(document).ready(function ()
    {
        window.oncontextmenu = function () {
   return false;
}
        $(document).keydown(function(e){
         if(e.which === 123){
            return false;
         }
     });
        
        $('#book_register').click(function () {
            var objCustomer = {};
            var intValidation = 0;
            objCustomer = {
                first_name: $('#first_name').val(),
                username: $('#username').val(),
                mobile: $('#mobile').val(),
                password: $('#password').val(),
            };
            intValidation = validate_registration(objCustomer);
            if (1 == intValidation) {
                strCustomer = encodeData(objCustomer);
                if ('' != strCustomer) {
                    saveNewCustomer(objCustomer);
                } else {
                    //Need to think what we do
                    return false;
                }
            } else {
                return FALSE;
            }
        });

        function encodeData(objectData) {
            var strResponse = objSource = '';
            objSource = objectData;
            strResponse = JSON.stringify(objectData);
            return strResponse;
        }

        function validate_registration(objCustomer) {
            var intResponse = 0;
            intResponse = 1;
            return intResponse;
        }


        function saveNewCustomer(objCustomer) {
            $("#nameErr").text("");
            $("#emailErr").text("");
            $("#mobileErr").text("");
            $("#newpasswordErr").text("");
            $.post(webUrl + 'Login/Customer/create', objCustomer, function (response) {
                var intResponseLen = 0;
                intResponseLen = getLengthOfObject(response);
                if (intResponseLen > 0 && response.data.customerId > 0) {
                    clearRegistrationInputs();
                    strMobileNumber = response.data.mobile;
                    strTokenAccess = response.data.verifyToken;
                    intCustomer = response.data.customerId;
                    strName = response.data.first_name;
                    strSMSTokenAccess = response.data.smsToken;
                    $('#signup-model').modal('hide');
                    $('#mps-otp1').modal('show');
                } else {
                    $("#nameErr").text(response.data.first_name);
                    $("#emailErr").text(response.data.username);
                    $("#mobileErr").text(response.data.mobile);
                    $("#newpasswordErr").text(response.data.password);
                    $('#mps-otp1').modal('hide');
                }

            });
        }

        function getLengthOfObject(objData) {
            var intLength = 0;
            if ('' != objData) {
                intLength = Object.keys(objData).length;
            }
            return intLength;
        }

        function clearRegistrationInputs() {
            $('#first_name').val();
            $('#username').val();
            $('#mobile').val();
            $('#password').val();
            return 1;
        }
        ;


        $('#averify').click(function ()
        {
            var objVerifcationDet = {};
            objVerifcationDet = {
                mobile: strMobileNumber,
                otp: $('#verifyidd').val(),
                customerId: intCustomer,
                first_name: strName,
                smsToken: strSMSTokenAccess,
            }
            verfiyAccessToken(objVerifcationDet);
        });


        function verfiyAccessToken(objVerifcationDet) {
            $.post(webUrl + 'Login/Customer/verifyToken', objVerifcationDet, function (response) {
                $('#book_invalid_otp').html('');
                var objVerifyResponse = 0;
                objVerifyResponse = getLengthOfObject(response);
                if (objVerifyResponse > 0 && 'fail' != response.type) {
                    $('#mps-otp1').modal('hide');
<?php
$objSession['order_info'] = $order_details;
?>
                    window.location = '<?php echo Yii::app()->params['webURL'] . '/Booking/BookAService/billingNewOrder'; ?>';
                    return true;
                } else {
                $('#book_invalid_otp').html(response.message);
                return false;
            }
      
            });
        }


        $('#resendbtn1').click(function ()
        {
            $('#book_invalid_otp').html('');
            $('#verifyidd').val('');
            var objResendToken = {};
            objResendToken = {
                mobile: strMobileNumber,
                customerId: intCustomer,
            };
            $.post(webUrl + 'Login/Customer/resendToken', objResendToken, function (response) {
                $('#book_invalid_otp').html('');
                var objResendResponse = 0;
                objResendResponse = getLengthOfObject(response);
                if (objResendResponse > 0 && '' != response.data.smsToken) {
                    strSMSToken = response.data.smsToken;
                    strToken = response.data.verifyToken;
                     $('#book_invalid_otp').html(response.message);
                    return 1;
                } else {
                     $('#book_invalid_otp').html(response.message);
                    return false;
                }
            });
        });

        $('#btnsub_login').click(function ()
        {
            $("#BerrMessage").html("");            
            $("#BusernameErr").text("");
            $("#BpasswordErr").text("");
            var objLogin = {};
            objLogin = {
                username: $('#user_name').val(),
                password: $('#user_password').val()
            }
            $.post(webUrl + 'Login/Customer/SignIN', objLogin, function (response) {
                if (1 == response.data) {
                    window.location = '<?php echo Yii::app()->params['webURL'] . '/Booking/BookAService/billingNewOrder' ?>';
                    return true;
                } else {
                    $("#BusernameErr").text(response.data.username);                                                      
                    $("#BpasswordErr").text(response.data.password);
                if(!response.data.username && !response.data.username){
                    $("#BerrMessage").html(response.message);                    
                }
                    return false;
                }

            });
        });

        $('#make_order').click(function () {
            window.location = '<?php echo Yii::app()->params['webURL'] . '/Booking/BookAService/billingNewOrder' ?>';
        });
        
        $('#make_order1').click(function () {
            window.location = '<?php echo Yii::app()->params['webURL'] . '/Booking/BookAService/billingNewOrder' ?>';
        });



    });

</script>
