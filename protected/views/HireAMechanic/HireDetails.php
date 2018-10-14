<div class="content-area">
    <!--Hire Details Bread Crub :: START-->
    <section class="page-section breadcrumbs text-right">
        <div class="container">
            <div class="page-header">
                <h1>Hire a Mechanic</h1>
            </div>
            <ul class="breadcrumb">
                <li><a href="<?php echo Yii::app()->params['webURL']; ?>">Home</a></li>
                <li><a href="<?php echo Yii::app()->params['webURL'] . '/HireMechanic/Hire'; ?>">Hire a Mechanic</a></li>
                <li class="active">Booking &amp; Payment</li>
            </ul>
        </div>
    </section>
    <!--Hire Details Bread Crub :: END-->


    <!--Hire Details :: START-->
    <section class="page-section with-sidebar sub-page">
        <div class="container">
            <div class="col-md-9 content" id="content">
                <!--<h3 class="block-title alt">Mechanic Details</h3>--> 
                <div class="car-big-card alt">
                    <div class="row">
                        <div class="col-md-3">
                            <!--Hire A Mechanic Image :: START-->
                            <div class="item">
                                <img class="img-responsive" src="<?php echo Yii::app()->params['adminImgURL'] . $hire_details[0]['hire_image_path'] . $hire_details[0]['hire_image']; ?>" alt=""/>
                            </div>
                            <!--Hire A Mechanic Image :: END-->
                        </div>
                        <div class="col-md-6">
                            <div class="car-details">
                                <div class="list">
                                    <ul>
                                        <!--Mechanic Name :: START-->
                                        <li>
                                            Mechanic Name : <?php
                                            echo isset($hire_details[0]['hire_name']) ? $hire_details[0]['hire_name'] : NULL;
                                            ?></li>
                                        <!--Mechanic Name :: END-->
                                        <!--Mechanic Professionality :: START-->
                                        <li>Professionality In : <?php
                                            $strBrand = isset($hire_details[0]['vehicle_brand_name']) ? $hire_details[0]['vehicle_brand_name'] : NULL;
                                            $strModel = isset($hire_details[0]['vehicle_model_name']) ? $hire_details[0]['vehicle_model_name'] : NULL;
                                            echo $strBrand . ' ( ' . $strModel . ' ) ';
                                            ?></li>
                                        <!--Mechanic Professionality :: END-->
                                        <!--Mechanic Experience :: START-->
                                        <li>Year of Experience : 
                                            <?php
                                            $intYears = isset($hire_details[0]['hire_experience_years']) ? $hire_details[0]['hire_experience_years'] : 0;
                                            $intMonths = isset($hire_details[0]['hire_experience_months']) ? $hire_details[0]['hire_experience_months'] : 0;
                                            echo $intYears . '.' . $intMonths;
                                            ?>
                                        </li>
                                        <!--Mechanic Experience :: END-->
                                        <!--Mechanic Description :: START-->
                                        <li>Description : <?php echo isset($hire_details[0]['hire_description']) ? $hire_details[0]['hire_description'] : NULL; ?> </li>
                                        <!--Mechanic Description :: END-->

                                    </ul>
                                </div>
                                <!--Mechanic Hour Price :: START-->
                                <div class="price">
                                    <strong>
                                        <i class="fa fa-inr"></i>
                                        <?php echo isset($hire_details[0]['hire_price_hr']) ? $hire_details[0]['hire_price_hr'] : '0.00'; ?>
                                    </strong>
                                </div>
                                <!--Mechanic Hour Price :: END-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!--Support :: START-->
            <aside class="col-md-3 sidebar selfaside" id="sidebar">  
                <!--Button :: START-->
                <div class="text-center" style="margin-bottom: 10px;">
                    <a class = "btn ripple-effect btn-theme plsordr" id="hire_book" name="hire_book" data-toggle = "modal" data-target = "#signup-model">Book Now</a>
                </div>
                <!--Button :: END-->
                <div class="widget shadow widget-helping-center">
                    <!--Support Tag :: START-->
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
            </aside>
            <!--Support :: END-->
        </div>
    </section>
    <!--Hire Details :: END-->


















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
                                <a href = "#logintab" data-toggle ="tab" id="hire_login_tab" name="hire_login_tab">Login</a>
                            </li>
                            <!--Login :: END-->
                            <!--SignUp :: START-->
                            <li>
                                <a href = "#signuptab" data-toggle ="tab" id="hire_login_tab" name="hire_login_tab">Sign Up</a>
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
                                            <input class="form-control" type="text" name="hire_username" id="hire_username" placeholder="Enter Email Address"/>
                                        </div>
                                        <span id="hire_usernameErr" style="color:red;padding-left:20px;"></span>
                                    </div>                               
                                    <!--Username :: START-->
                                    <!--Password :: START-->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input class="form-control" type="password" name="hire_password" id="hire_password" placeholder="Enter Password"/>
                                        </div>
                                        <span id="hire_passwordErr" style="color:red;padding-left:20px;"></span>
                                        <span id="wrong_password" style="color:red;padding-left:20px;"></span>
                                    </div>
                                    <!--Password :: END-->
                                    <div class="col-md-6">                                        
                                    </div>
                                    <div class="col-md-6 text-right">
                                         <a href="<?php echo Yii::app()->params['webURL'] . 'Login/Customer/ForgotPassword' ?>" target="_blank" class="forgot-password">forgot password?</a>
                                    </div>
                                    <!--Button :: START-->
                                    <div class="col-md-12 text-center mrg-top-20">						
                                        <div id="loginerror_login"></div>
                                        <input type="button" value="Login" id="hire_login_btn" name="hire_login_btn" class="btn btn-theme btn-theme-dark hire_login_btn"/>
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
                                            <input class="form-control alt" type="text" name="hire_reg_uname" id="hire_reg_uname" placeholder="Enter Fullname"/>
                                        </div>
                                        <span id="hire_reg_nameerror"  style="color:red;padding-left:20px;"></span>
                                    </div>		
                                    <!--Username :: END-->
                                    <!--Email :: START-->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input class="form-control alt" type="text" name="hire_reg_email" id="hire_reg_email"  placeholder="Enter Email"/>
                                        </div>
                                        <span id="hire_reg_usernameerror"  style="color:red;padding-left:20px;"></span>
                                    </div>
                                    <!--Email :: END-->
                                    <!--Mobile Number :: START-->
                                    <div class="col-md-12">
                                        <div class="form-group has-icon has-label">
                                            <input type="text" class="form-control alt" id="hire_reg_mob" name="hire_reg_mob" placeholder="Enter Mobile Number" maxlength="10"/>
                                        </div>
                                        <span id="hire_reg_mobileerror"  style="color:red;padding-left:20px;"></span>
                                    </div>
                                    <!--Mobile Number :: END-->
                                    <!--Password :: START-->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input class="form-control alt" type="password" name="hire_reg_pwd" id="hire_reg_pwd" placeholder="Enter Password"/>
                                        </div>
                                        <span id="hire_reg_pwderror"  style="color:red;padding-left:20px;"></span>
                                    </div>
                                    <!--Password :: END-->
                                    <!--Button :: START-->
                                    <div class="col-md-12 text-center mrg-top-20">
                                        <input type="button" value="Create Account" id="hire_reg_btn" name="hire_reg_btn" class="btn btn-theme btn-theme-dark"/>
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
    <div id="hire_otp" class="modal fade otp-popup" role="dialog">
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
                                <input class="form-control alt text-center" type="text" name="hire_otp_code" id="hire_otp_code"  placeholder="Enter Vericfication Code" maxlength="6"x/>
                            </div>
                            <span id="hire_invalid_otp"></span>
                        </div>
                        <!--OTP :: END-->
                        <!--Verify OTP :: START-->
                        <div class="col-md-6 text-right">
                            <div id="emailerror1"></div>
                            <input type="button" value="Submit" id="hire_otp_verify" name="hire_otp_verify" class="btn btn-theme submit-otp"/>
                        </div>
                        <!--Verify OTP :: END-->
                        <!--Resend OTP :: START-->
                        <div class="col-md-6 text-left">
                            <div id="emailerror"></div>
                            <input type="button" value="ReSend" id="hire_resend_otp" name="hire_resend_otp" class="btn btn-theme btn-theme-dark submit-otp"/>
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

<script type="text/javascript">
    //Login
    var hire_sms_token = '';
    var hire_customer = '';
    var hire_otp = '';
    var hire_fullname = '';
    var hire_mobile = '';
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
    $("#hire_login_tab").click(function () {
        makeLoginEmpty();
    });
    function makeLoginEmpty() {
        $('#hire_username').val('');
        $('#hire_password').val('');
        return true;
    }

    //SignUp
    $('#hire_login_tab').click(function () {
        makeSignupEmpty();
    });
    function makeSignupEmpty() {
        $("#hire_reg_uname").val('');
        $("#hire_reg_email").val('');
        $("#hire_reg_mob").val('');
        $("#hire_reg_pwd").val('');
        return true;
    }

    //Login
    $('#hire_login_btn').click(function () {
        var objLogin = {};
        objLogin = {
            username: $('#hire_username').val(),
            password: $('#hire_password').val(),
        };
        if (isLoggedIn < 0 || '' == isLoggedIn) {
            $.post(webUrl + 'Login/Customer/SignIN', objLogin, function (response) {
                if (1 == response.data) {
                    isLoggedIn = response.customer_details.id;
                    hireUs();
                    return true;
                } else {
                    $("#hire_passwordErr").html('');
                    $("#hire_usernameErr").html('');
                    $("#wrong_password").html('');
                    if ('' != response.data.username) {
                        $("#hire_usernameErr").text(response.data.username);
                    }
                    if ('' != response.data.password) {
                        $("#hire_passwordErr").text(response.data.password);
                    }

                    if ('501' == response.code) {
                        $("#wrong_password").text('Invalid Password Is Given.');
                    }
                    return false;
                }

            });
        } else {
            return true;
        }

    });
    //Register
    $('#hire_reg_btn').click(function () {
        var objReg = {};
        objReg = {
            first_name: $("#hire_reg_uname").val(),
            username: $("#hire_reg_email").val(),
            mobile: $("#hire_reg_mob").val(),
            password: $("#hire_reg_pwd").val(),
        };
        $.post(webUrl + 'Login/Customer/create', objReg, function (response) {
            clearRegErrors();
            var intResponseLen = 0;
            intResponseLen = getHireObjectLength(response);
            if (intResponseLen > 0 && response.data.customerId > 0) {
                isLoggedIn = response.data.customerId;
                hire_customer = response.data.customerId;
                hire_sms_token = response.data.smsToken;
                hire_fullname = response.data.first_name;
                hire_mobile = response.data.mobile;
                hire_otp = response.data.verifyToken;
                $('#signup-model').modal('hide');
                $('#hire_otp').modal('show');
            } else {
                response = response.data;
                //Fullname
                if ('' != response.first_name) {
                    $('#hire_reg_nameerror').html(response.first_name);
                }
                //Email
                if ('' != response.username) {
                    $('#hire_reg_usernameerror').html(response.username);
                }
                //Mobile
                if ('' != response.mobile) {
                    $('#hire_reg_mobileerror').html(response.mobile);
                }
                //Password
                if ('' != response.password) {
                    $('#hire_reg_pwderror').html(response.password);
                }
            }
        });
    });
    function clearRegErrors() {
        $('#hire_reg_nameerror').html(' ');
        $('#hire_reg_usernameerror').html(' ');
        $('#hire_reg_mobileerror').html(' ');
        $('#hire_reg_pwderror').html(' ');
    }

    function getHireObjectLength(objData) {
        var intLength = 0;
        if ('' != objData) {
            intLength = Object.keys(objData).length;
        }
        return intLength;
    }

    $('#hire_otp_verify').click(function () {
        var objVerifcationDet = {};
        objVerifcationDet = {
            customerId: hire_customer,
            mobile: hire_mobile,
            otp: $('#hire_otp_code').val(),
            first_name: hire_fullname,
            smsToken: hire_sms_token,
        }
        verfiyHireToken(objVerifcationDet);
    });
    function verfiyHireToken(objVerifcationDet) {
        $.post(webUrl + 'Login/Customer/verifyToken', objVerifcationDet, function (response) {
            $('#hire_invalid_otp').html('');
            var objVerifyResponse = 0;
            objVerifyResponse = getHireObjectLength(response);
            if (objVerifyResponse > 0 && 'fail' != response.type) {
                $('#hire_otp').modal('hide');
                hireUs();
                return true;
            } else {
                $('#hire_invalid_otp').html(response.message);
                return false;
            }
        });
    }

    $('#hire_resend_otp').click(function ()
    {
        $('#hire_otp_code').val('');
        var objResendToken = {};
        objResendToken = {
            mobile: hire_mobile,
            customerId: hire_customer,
        };
        $.post(webUrl + 'Login/Customer/resendToken', objResendToken, function (response) {
            var objResendResponse = 0;
            objResendResponse = getHireObjectLength(response);
            if (objResendResponse > 0 && '' != response.data.smsToken) {
                hire_sms_token = response.data.smsToken;
                hire_otp = response.data.verifyToken;
                return true;
            } else {
                return false;
            }
        });
    });
    $('#hire_book').click(function () {
        if (isLoggedIn > 0) {
            $('.signin_signup_form').attr("id", "anonamous");
            hireUs();
        }
    });
    function hireUs() {
        var objHire = {};
        objHire = {
            location: '<?php echo $customer_location['customer_location']; ?>',
            latitude: '<?php echo $customer_location['customer_latitude']; ?>',
            longitude: '<?php echo $customer_location['customer_longitude']; ?>',
            hire_id: '<?php echo $hire_details[0]['hire_id']; ?>',
            hire_price: '<?php echo $hire_details[0]['hire_price_hr']; ?>',
            hire_name: '<?php echo $hire_details[0]['hire_name']; ?>',
            customer_id: isLoggedIn,
            vehicle_id: '<?php echo $hire_details[0]['vehicle_id']; ?>',
            vehicle_brand_models_id: '<?php echo $hire_details[0]['vehicle_brand_models_id']; ?>',
            vehicle_categories_id: '<?php echo $hire_details[0]['vehicle_categories_id']; ?>',
            hire_code: '<?php echo $hire_details[0]['hire_code']; ?>',
            hire_phone: '<?php echo $hire_details[0]['hire_phone']; ?>',
            hire_email: '<?php echo $hire_details[0]['hire_email']; ?>',
        };
        $.post(webUrl + 'HireMechanic/HireUS', objHire, function (response) {
            window.location = webUrl + 'HireMechanic/ThankYou';
        });
    }
</script>
