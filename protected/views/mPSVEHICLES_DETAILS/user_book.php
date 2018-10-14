<?php ?>
<script>

</script>
<?php //var_dump($bikedetails);  ?>
<!-- CONTENT AREA -->
<div class="content-area bookservice-overview-page">
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
    <section class="page-section with-sidebar sub-page">
        <div class="container">
            <div class="row">
                <!-- CONTENT -->
                <div class="col-md-9 content" id="content">
                    <div class="car-big-card alt">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="item">
                                    <img class="img-responsive" src="<?php echo $img_path; ?>" alt=""/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="pad-l-r-50">
                                    <div class="car-details">
                                        <h3 class="brnd-mdl-name"><?php echo $brand_name; ?> / <?php echo $model_name; ?></h3>
<?php //echo $html;  ?>                          
                                    </div>
                                    <h5>Type of Service</h5>
                                    <h4><?php echo $servicename; ?></h4>

                                    <h5>Package Type</h5>
                                    <h4><?php if (!empty($planname)) echo $planname; ?></h4>

                                    <div class="est-amount">
                                        <h5>Estimated Amount</h5>
                                        <strong><i class="fa fa-inr"></i> <?php echo $payamount; ?></strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row bookconfirm">
                            <div class="panel-group accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                <!-- list of selected services -->
                                <div class="panel panel-default">
                                    <div class="row nopadding panel-heading" role="tab" id="heading2">
                                        <div class="col-md-8 pckg-lft-dtls">
                                            <i class="fa fa-wrench" aria-hidden="true"></i>
                                            <h4 class="panel-title"> Package Details</h4>
                                        </div>
                                        <div class="col-md-4 pckg-rgt-dtls">
                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                                <span class="dot"></span>
                                                <h4 class="panel-title">Click here to <br/>view details</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
                                        <div class="panel-body tab-content">
<?php
/* if(!empty($html))
  {
  echo $html;
  } */
?>  
                                        </div>
                                    </div>
                                </div>
                                <!-- /list of selected services -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group pull-right">
<?php
if (empty(Yii::app()->session['username'])) {
    ?>
                                    <a class = "btn btn-theme ripple-effect booknow-lst" id="btnsub2" data-toggle = "modal" data-target = "#signup-model">Book Now</a>
                                <?php } else {
                                    ?>
                                    <a class="btn btn-theme btn-theme-dark booknow-lst" id="btnsub1"  href="<?php echo $this->createUrl('mPSVEHICLES_DETAILS/CarServiceOrderSummary?amount=' . $payamount . '&pickadrs=' . $adrs . '&picdate=' . $picdate . '&pickhr=' . $pickhr . ''); ?>">Book Now</a>
                                <?php } ?>

                                <a class="btn btn-theme ripple-effect btn-theme-dark" href="<?php echo $this->createUrl('mPSVEHICLES_DETAILS/Booking'); ?>">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /CONTENT -->
                <!-- SIDEBAR -->
                <aside class="col-md-3 sidebar selfaside" id="sidebar">
                    <div class="widget shadow widget-helping-center">                    
                        <h4 class="widget-title">Pickup Details</h4>
                        <div class="widget-content">
                            <div id="extra" class="aside-srvs-dtls">
                                <h5>Pickup Location</h5>
                                <p>Rd Number 35, Aditya Enclave, Venkatagiri, Jubilee Hills, Hyderabad, Telangana 500033, India</p>

                                <h5>Booking Date</h5>
                                <h4>11/07/2016</h4>

                                <h5>Booking Time</h5>	
                                <h4>01:55 pm</h4>

                                <div class="aside-amt-dtls">
                                    <h5>Estimated Amount</h5>
                                    <i class="fa fa-inr" aria-hidden="true"></i>
                                    <div  class="est-amount"><?php echo $payamount; ?></div>
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
</div>
<!-- /PAGE WITH SIDEBAR -->
<script>
    function testAPI() {

        FB.api('/me', {fields: 'gender, first_name, last_name, email,name'}, function (response) {
            console.log(response);
            $.post('<?php echo $this->createUrl('Orders/fblogin'); ?>', {
                regemail: response.email,
                uname: response.name,
                id: response.id



            },
                    function (data)
                    {

                        if (data == 1)
                        {
                            repair_id = "<?php echo $repair_ids; ?>";

                            amount = "<?php echo $payamount; ?>";
                            serviceid = "<?php echo $sernm; ?>";

                            planid = "<?php echo $planname; ?>";
                            pkid = "<?php echo $planid; ?>";
                            service_id = "<?php echo $service_id; ?>";

                            model_id = "<?php echo $model_id; ?>";
                            makes_id = "<?php echo $brand_id; ?>";

                            brand_name = "<?php echo $brand_name; ?>";
                            model_name = "<?php echo $model_name; ?>";

                            category_id = "<?php echo $category_id; ?>";

                            pickadrs = "<?php echo $adrs; ?>";
                            pickdate = "<?php echo $picdate; ?>";
                            //alert(pickdate);
                            pickhr = "<?php echo $pickhr; ?>";
                            $.post('<?php echo $this->createUrl('mPSVEHICLES_DETAILS/saveInput'); ?>', {
                                repair_id: repair_id,
                                amount: amount,
                                serviceid: serviceid,
                                planid: planid,
                                pkid: pkid,
                                category_id: category_id,
                                model_id: model_id,
                                makes_id: makes_id,
                                brand_name: brand_name,
                                model_name: model_name,
                                pickadrs: pickadrs,
                                pickdate: pickdate,
                                pickhr: pickhr


                            },
                                    function (data)
                                    {
                                        window.location = "<?php echo $this->createUrl('mPSVEHICLES_DETAILS/CarServiceOrderSummary?amount=' . $payamount . '&pickadrs=' . $adrs . '&picdate=' . $picdate . '&pickhr=' . $pickhr . ''); ?>";
                                        //alert(data);

                                    });
                        }
                    });

        });
    }
    jQuery(document).ready(function ()
    {
        //$('#verifyform1').hide();
        $('#btnsub1').click(function ()
        {

            repair_id = "<?php echo $repair_ids; ?>";

            amount = "<?php echo $payamount; ?>";
            serviceid = "<?php echo $sernm; ?>";

            planid = "<?php echo $planname; ?>";
            pkid = "<?php echo $planid; ?>";
            service_id = "<?php echo $service_id; ?>";

            model_id = "<?php echo $model_id; ?>";
            makes_id = "<?php echo $brand_id; ?>";

            brand_name = "<?php echo $brand_name; ?>";
            model_name = "<?php echo $model_name; ?>";

            category_id = "<?php echo $category_id; ?>";

            pickadrs = "<?php echo $adrs; ?>";
            pickdate = "<?php echo $picdate; ?>";
            //alert(pickdate);
            pickhr = "<?php echo $pickhr; ?>";

            //alert(pickhr);





            $.post('<?php echo $this->createUrl('mPSVEHICLES_DETAILS/saveInput'); ?>', {
                repair_id: repair_id,
                amount: amount,
                serviceid: serviceid,
                planid: planid,
                pkid: pkid,
                category_id: category_id,
                model_id: model_id,
                makes_id: makes_id,
                brand_name: brand_name,
                model_name: model_name,
                pickadrs: pickadrs,
                pickdate: pickdate,
                pickhr: pickhr





            },
                    function (data)
                    {

                        //alert(data);
                        if (data == 1)
                        {
                            window.location = "CarServiceOrderSummary?amount=<?php echo $payamount; ?>&pickadrs=" + pickadrs + "&picdate=" + pickdate + "&pickhr=" + pickhr;
                        }

                    });


        });
        $('#btnsub_login').click(function ()
        {


            //customer vehicle added details


            var uname = $("#user_name").val();
            alert(uname);
            var password = $("#user_password").val();
            repair_id = "<?php echo $repair_ids; ?>";

            amount = "<?php echo $payamount; ?>";
            serviceid = "<?php echo $sernm; ?>";
            pkid = "<?php echo $planid; ?>";
            service_id = "<?php echo $service_id; ?>";


            planid = "<?php echo $planname; ?>";

            model_id = "<?php echo $model_id; ?>";
            makes_id = "<?php echo $brand_id; ?>";

            brand_name = "<?php echo $brand_name; ?>";
            model_name = "<?php echo $model_name; ?>";

            category_id = "<?php echo $category_id; ?>";

            pickadrs = "<?php echo $adrs; ?>";
            pickdate = "<?php echo $picdate; ?>";
            //alert(pickdate);
            pickhr = "<?php echo $pickhr; ?>";

            //alert(pickhr);



            $.post('<?php echo $this->createUrl('mPSVEHICLES_DETAILS/Checklogin'); ?>', {
                uname: uname,
                password: password,
            },
                    function (data)
                    {
                        alert(data);
                        if (data == 1)
                        {
                            $("#loginerror_login").html('<font color=red>Invalid username and password</font>');
                        } else
                        {

                            $.post('<?php echo $this->createUrl('mPSVEHICLES_DETAILS/saveInput'); ?>', {
                                repair_id: repair_id,
                                amount: amount,
                                serviceid: serviceid,
                                planid: planid,
                                category_id: category_id,
                                model_id: model_id,
                                makes_id: makes_id,
                                brand_name: brand_name,
                                model_name: model_name,
                                pickadrs: pickadrs,
                                pickdate: pickdate,
                                pickhr: pickhr,
                                pkid: pkid





                            },
                                    function (data)
                                    {

                                        //alert(data);
                                        if (data == 1)
                                        {
                                            window.location = "CarServiceOrderSummary?amount=<?php echo $payamount; ?>&pickadrs=" + pickadrs + "&picdate=" + pickdate + "&pickhr=" + pickhr;
                                        }

                                    });

                        }
                    });
        });

        $('#resendbtn1').click(function ()
        {
            a = $('#hidvalue1').val();
            $.post('<?php echo $this->createUrl('mPSVEHICLES_DETAILS/Verify'); ?>', {
                mobileno: $('#aregmobNo').val(),
                otp: a,
            },
                    function (data)
                    {

                        //alert(data);

                    });
        });

        $('#aregister').click(function ()
        {
            $('#signup-model').modal('toggle');
            var a = Math.floor(100000 + Math.random() * 900000);
            a = a.toString();
            a = a.substring(-2);
            $('#hidvalue1').val(a);
            $.post('<?php echo $this->createUrl('mPSVEHICLES_DETAILS/Verify'); ?>', {
                mobileno: $('#aregmobNo').val(),
                otp: a,
            },
                    function (data)
                    {

                        console.log(data[0]);
                        //	$('#content1').hide(); 
                        //$('#form2').hide(); 
                        //$('#verifyform1').show();
                        $('#averify').click(function ()
                        {
                            var b = $('#verifyidd').val();

                            if (a == b)
                            {
                                var regemail = $("#aregemail").val();
                                var upwd = $("#aregupwd").val();
                                var mobNo = $("#aregmobNo").val();
                                var uname = $("#areguname").val();
                                model_id = "<?php echo $model_id; ?>";
                                makes_id = "<?php echo $brand_id; ?>";
                                brand_name = "<?php echo $brand_name; ?>";
                                model_name = "<?php echo $model_name; ?>";

                                $.post('	<?php echo $this->createUrl('mPSVEHICLES_DETAILS/RegisterCustlogin'); ?>', {
                                    regemail: regemail,
                                    upwd: upwd,
                                    mobNo: mobNo,
                                    uname: uname,
                                    model_id: model_id,
                                    makes_id: makes_id,
                                    brand_name: brand_name,
                                    model_name: model_name,
                                },
                                        function (data)
                                        {

                                            alert("Vericfication Successful");

                                            if (data == 1)
                                            {
                                                window.location = "CarServiceOrderSummary?amount=<?php echo $payamount; ?>";
                                            }

                                        });

                            } else
                            {
                                $('#error').html("<Strong>Vericfication Code error</strong>");
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
                                    <div class="col-md-12"></div>
                               </div> -->

                                <div class="col-md-12 text-center mrg-top-20">
                                    <div id="emailerror1"></div>
                                    <input type="button" value="Create Account" id="aregister" name="aregister" class="btn btn-theme btn-theme-dark" data-toggle="modal" data-target="#mps-otp1">

                                </div>
                                <!--<div class="col-md-6 mrg-top-20">
                                     <a href="#" class="btn btn-theme btn-block btn-icon-left facebook"><i class="fa fa-facebook"></i>Sign in with Facebook</a>
                                 </div>-->
                                <!--<div class="col-md-6 mrg-top-20">
        <fb:login-button size='large' show_faces='false'  onlogin="checkLoginState();">
                                                </fb:login-button>
                                                <div id="status1"></div>
        </div>-->

                            </div>
                        </div>				   
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
                        <div class="form-group"><input class="form-control alt text-center" type="text" name="bregemail" id="verifyidd"  placeholder="Enter Vericfication code*" required></div>
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