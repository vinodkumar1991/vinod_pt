<?php
$order_info = Yii::app()->session['order_info'];
//print_r($order_info);
?>
<div class="content-area">
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
    <section class="page-section with-sidebar sub-page billing-page-wraper">
        <div class="container">
            <div class="row">
                <div class="col-md-9 content">
                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4><i class="fa fa-map-marker"></i> Billing Address Details</h4> 
                            </div>
                            <div class="panel-body">
                                <form action="" class="form-delivery" method="post">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="radio radio-inline">
                                                <input type="radio" id="inlineRadio1" value="option1" name="radioInline" checked="">
                                                <label for="inlineRadio1">Mr</label>
                                            </div>
                                            <div class="radio radio-inline" style="margin-top:10px;">
                                                <input type="radio" id="inlineRadio2" value="option1" name="radioInline">
                                                <label for="inlineRadio2">Ms</label>
                                            </div>
                                        </div>
                                        <!--Name :: START-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input class="form-control alt" type="text" id="order_name" name="order_name" value="<?php
                                                echo isset($customer_info['first_name']) ? $customer_info['first_name'] : NULL;
                                                ?>" placeholder="Enter Full Name" required>
                                            </div>
                                            <div id="err_order_name"></div>
                                        </div>
                                        <!--Name :: END-->

                                        <!--Email :: START-->
                                        <div class="col-md-6">
                                            <div class="form-group"><input class="form-control alt" type="text" id="order_email" name="order_email" placeholder="Enter Email" value="<?php
                                                echo isset($customer_info['email']) ? $customer_info['email'] : NULL;
                                                ?>" required></div>
                                            <div id="err_order_email"></div>
                                        </div>
                                        <!--Email :: END-->

                                        <!--Mobile :: START-->
                                        <div class="col-md-6">
                                            <div class="form-group"><input class="form-control alt" type="text" id="order_phone" name="order_phone" placeholder="Enter Phone" value="<?php
                                                echo isset($customer_info['phone']) ? $customer_info['phone'] : NULL;
                                                ?>" required></div>
                                            <div id="err_order_phone"></div>
                                        </div>
                                        <!--Mobile :: END-->

                                        <!--City :: START-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input class="form-control alt" type="text" id="order_city"  name="order_city" value="<?php echo isset($order_info['order_city']) ? $order_info['order_city'] : NULL; ?>" placeholder="Enter city" required/>
                                            </div>
                                            <div id="err_order_city"></div>
                                        </div>
                                        <!--City :: END-->

                                        <!--Pincode :: START-->
                                        <div class="col-md-6">
                                            <div class="form-group"><input class="form-control alt" type="text" id="order_pincode"  name="order_pincode" placeholder="Enter pincode" required></div>
                                            <div id="err_order_pincode"></div>
                                        </div>
                                        <!--Pincode :: END-->

                                        <!--Address :: START-->
                                        <div class="col-md-6">
                                            <div class="form-group"><input class="form-control alt" type="text" id="order_address1" name="order_address1" placeholder="Enter Address" value="<?php
                                                echo isset($order_info['location']) ? $order_info['location'] : NULL;
                                                ?>" required></div>
                                            <div id="err_order_address1"></div>
                                        </div>
                                        <!--Address :: END-->

                                        <!--Address Two :: START-->
                                        <div class="col-md-6">
                                            <div class="form-group"><input class="form-control alt" id="order_address2" name="order_address2" type="text" placeholder="Enter Landmark"></div>
                                            <div id="err_order_address2"></div>
                                        </div>
                                        <!--Address Two :: END-->
                                        <div class="col-md-12">
                                            <div class="form-group"></div>
                                        </div>
                                    </div>

                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Choose Payment Options</h4> 
                            </div>
                            <div class="panel-body">
                                <div class="panel-group payments-options" id="accordion" role="tablist" aria-multiselectable="true">
                                    <?php
                                    //if (!empty($payment_modes)) {
                                    //    foreach ($payment_modes as $arrPaymentMode) {
                                            ?>

                                            <div class="panel radio panel-default col-md-4">
                                                <div class="panel-heading" role="tab" id="headingOne">
                                                    <h4 class="panel-title">
                                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="<?php
                                                       // $intPaymentMode = isset($arrPaymentMode['id']) ? $arrPaymentMode['id'] : 1;
                                                       // echo "#" . $intPaymentMode;
                                                        ?>" aria-expanded="true" aria-controls="collapseOne">
                                                            <span class="dot" data-id="<?php //echo $arrPaymentMode['id']; ?>"></span> 
                                                            CC Avenue
                                                            <?php
                                                           // echo isset($arrPaymentMode['name']) ? $arrPaymentMode['name'] : NULL;
                                                            ?>
                                                        </a>
                                                    </h4>
                                                </div>

                                                <div id="<?php// echo isset($arrPaymentMode['id']) ? $arrPaymentMode['id'] : 1; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading1">
                                                    <div class="panel-body">
                                                        <div class="alert alert-success" role="alert">
                                                            <?php
                                                          //  echo isset($arrPaymentMode['description']) ? $arrPaymentMode['description'] : NULL;
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                       // }
                                //    }
                                    ?>
                                </div>                                  
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SIDEBAR -->
                <aside class="col-md-3 sidebar selfaside aside-mrg-top0" id="sidebar">
                    <div class="widget shadow widget-helping-center estimate-widget">                    
                        <h4 class="widget-title">Order Summary</h4>
                        <div class="widget-content">
                            <h5>Start Trip</h5>
                            <h4>
                                <?php
                                echo isset($order_info['FromDate']) ? date('m-D-Y h:i',strtotime($order_info['FromDate'])) : NULL;
                                ?>
                            </h4>

                            <h5>End Trip</h5>   
                            <h4>
                                <?php
                                echo isset($order_info['ToDate']) ? date('m-D-Y h:i',strtotime($order_info['ToDate'])) : NULL;
                                ?>
                            </h4>

                            <div class="aside-amt-dtls">
                                <h5>Total Amount</h5>
                                <div  class="est-amount">
                                    <i class="fa fa-inr" aria-hidden="true"></i>
                                    <?php
                                    echo isset($order_info['price']) ? $order_info['price'] : NULL;
                                    ?>
                                </div>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" id="checkboxa1">
                                <label for="checkboxa1">I agree to the following: </label>
                            </div>
                            <a href="#">Universal Terms of Service Agreement Privacy Policy</a>
                            <div id="legal"></div>
                            <div class="form-group pull-right mrg-top-20">
                                <input type="button" class="btn ripple-effect btn-theme plsordr" name="finalsub" id="finalsub" value="Place Your Order">
                            </div>
                        </div>
                    </div>
                </aside>
                </form>
            </div>
        </div>
    </section>

    <!--Payment :: START-->
    <form method="post" id="redirect" name="redirect" action="<?php echo Yii::app()->params['payment_keys']['ccavenue']['secure_url']; ?>"> 
        <input type='hidden' name='encRequest' id='encRequest'>
        <input type='hidden' name='access_code' id='access_code' value ="<?php echo Yii::app()->params['payment_keys']['ccavenue']['access_code']; ?>">
    </form>
    <!--Payment :: END-->


    <script>
        jQuery(document).ready(function ()
        {
            $('#finalsub').click(function ()
            {
                var intBreakPoint = checkOrderInputs();
               // alert(intBreakPoint);
                //return false;
                if (1 == intBreakPoint)
                {
                    $('#legal').html();
                    saveOrder();
                } else {
                    return false;
                }

            });
            function saveOrder() {
                
               
                
                var objOrderDetails = {};
                var intPaymentMode = '';
                intPaymentMode = 2;//Cc Avenue
                objOrderDetails = {
                    name: $('#order_name').val(),
                    email: $('#order_email').val(),
                    phone: $('#order_phone').val(),
                    city: $('#order_city').val(),
                    pincode: $('#order_pincode').val(),
                    address1: $('#order_address1').val(),
                    address2: $('#order_address2').val(),
                    additional: 'TEXT',
                    payment_mode:2 ,
                    latitude: '<?php echo isset($order_info['latitude']) ? $order_info['latitude'] : NULL; ?>',
                    longitude: '<?php echo isset($order_info['longitude']) ? $order_info['longitude'] : NULL; ?>',
                };
                $.post('<?php echo Yii::app()->params['webURL'] . '/Self/SelfDrive/saveOrder' ?>', objOrderDetails, function (response) {
            
                    if (response > 1) {
                        //alert(intPaymentMode);
                       // return false;
                        switch (intPaymentMode) {
                            case 1: //1 => Cash On Delivery
                                //window.location = '<?php //echo Yii::app()->params['webURL'] . '/Booking/BookAService/FinalOrder';                                                                                                                                                                                       ?>';
                                break;
                            case 2: //2 => CCAvenue
                                $.post('<?php echo Yii::app()->params['webURL'] . '/Self/SelfDrive/doEncrypt' ?>', objOrderDetails, function (response) {
                                    //alert(response);
                                    //return false;
                                   if ('' != response && response.length > 0) {
                                       location.href = '<?php echo Yii::app()->params['webURL'] . '/Self/SelfDrive/FinalOrder' ?>';
                                       // $('#encRequest').val(response);
                                       // $('#redirect').submit();
                                    } else {
                                        return false;
                                    }
                                });
                                break;
                            case 3:
                                $.post('<?php echo Yii::app()->params['webURL'] . '/Self/SelfDrive/doEncrypt' ?>', objOrderDetails, function (response) {
                                    if ('' != response && response.length > 0) {
                                        $('#encRequest').val(response);
                                        $('#redirect').submit();
                                    } else {
                                        return false;
                                    }
                                });
                                break;
                        }
                    } else {
                        return false;
                    }
                });
            }

            function checkOrderInputs() {
                var name = $('#order_name').val();
                var email = $('#order_email').val();
                var phone = $('#order_phone').val();
                var city = $('#order_city').val();
                var pincode = $('#order_pincode').val();
                var location = $('#order_address1').val();
                var landmark = $('#order_address2').val();
                var paymentMode = 3;
                var isAgree = $('#checkboxa1').prop("checked");
                //alert(name+'-'+email+'-'+phone+'-'+city+'-'+pincode+'-'+location+'-'+landmark+'-'+);
               // return false;
                if ('' != name && '' != email && '' != phone && '' != city && '' != pincode && '' != location && '' != landmark && '' != paymentMode && (true == isAgree || 1 == isAgree)) {
                    return 1;
                } else {
                    if ('' == name) {
                        $('#err_order_name').html('<span class="error-msgtxt">Enter your full name.</span>');
                        $('#err_order_name').focus();
                    } else if ('' == email) {
                        $('#err_order_email').html('<span class="error-msgtxt">Enter your email address.</span>');
                        $('#err_order_email').focus();
                    } else if ('' == phone) {
                        $('#err_order_phone').html('<span class="error-msgtxt">Enter your phone.</span>');
                        $('#err_order_phone').focus();
                    } else if ('' == city) {
                        $('#err_order_city').html('<span class="error-msgtxt">Enter your city.</span>');
                        $('#err_order_city').focus();
                    } else if ('' == pincode) {
                        $('#err_order_pincode').html('<span class="error-msgtxt">Enter your pincode.</span>');
                        $('#err_order_pincode').focus();
                    } else if ('' == location) {
                        $('#err_order_address1').html('<span class="error-msgtxt">Enter your location.</span>');
                        $('#err_order_address1').focus();
                    } else if ('' == landmark) {
                        $('#err_order_address2').html('<span class="error-msgtxt">Enter your landmark.</span>');
                        $('#err_order_address2').focus();
                    } else if ('' == isAgree || 0 == isAgree) {
                        $('#legal').html('<span class="error-msgtxt">Please agree the term and conditions</span>');
                        $('#legal').focus();
                    }
                    return 0;
                }
            }
        });
    </script>