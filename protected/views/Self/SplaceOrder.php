<style>
            .btn-theme{
                margin-left: -10px;
            }
            .plsordr{
                width: 109%;
            }
        </style>
<div class="content-area">
    <section class="bookservice-main page-section breadcrumbs">
        <div class="container">    
            <div class="col-md-12 text-right">
                <div class="page-header">
                    <h1>Book a <?php
                        echo isset($order_info['vehicle_type']) ? $order_info['vehicle_type'] : NULL;
                        ?></h1>
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
<!--                                <form action="<?php //echo Yii::app()->params['webURL'] . 'Self/SelfDrive/SaveOrder/'   ?>" class="form-delivery" method="post">-->
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php $radioSelect = isset($orderdetails->radioInline) ? $orderdetails->radioInline : Null; ?>
                                            <div class="radio radio-inline">
                                                <input type="radio" id="inlineRadio1" value="option1" name="radioInline" <?php
                                                if ('option1' == $radioSelect) {
                                                    echo 'checked';
                                                } else {
                                                    echo false;
                                                };
                                                ?>  checked="">
                                                <label for="inlineRadio1">Mr</label>
                                            </div>
                                            <div class="radio radio-inline" style="margin-top:10px;">
                                                <input type="radio" id="inlineRadio2" value="option2" name="radioInline" <?php
                                                if ('option2' == $radioSelect) {
                                                    echo 'checked';
                                                } else {
                                                    echo false;
                                                };
                                                ?>>
                                                <label for="inlineRadio2">Ms</label>
                                            </div>
                                        </div>
                                        <!--Name :: START-->
                                        <div class="col-md-6">
                                            <?php
                                            $strFormname = isset($orderdetails->self_order_name) ? $orderdetails->self_order_name : NULL;
                                            $strExistName = isset($customer_info['first_name']) ? $customer_info['first_name'] : NULL;
                                            $strFinalName = !empty($strFormname) ? $strFormname : $strExistName;
                                            unset($strFormname, $strExistName);
                                            ?>
                                            <div class="form-group">
                                                <input class="form-control alt" type="text" id="self_order_name" name="self_order_name" value="<?php
                                            echo $strFinalName;
                                            ?>" placeholder="Enter Full Name" >
                                            </div>
                                            <span class="throw_error" style="color:#FF0000; ">
                                                <?php
                                                echo isset($errors['self_order_name'][0]) ? $errors['self_order_name'][0] : NULL;
                                                ?>
                                            </span>
                                        </div>
                                        <!--Name :: END-->

                                        <!--Email :: START-->
                                        <div class="col-md-6">
                                            <?php
                                            $strFormEmail = isset($orderdetails->self_order_email) ? $orderdetails->self_order_email : NULL;
                                            $strExistEmail = isset($customer_info['email']) ? $customer_info['email'] : NULL;
                                            $strFinalEmail = !empty($strFormEmail) ? $strFormEmail : $strExistEmail;
                                            unset($strFormEmail, $strExistEmail);
                                            ?>
                                            <div class="form-group"><input class="form-control alt" type="email" id="self_order_email" name="self_order_email" placeholder="Enter Email" value="<?php
                                                echo $strFinalEmail;
                                            ?>" ></div>
                                            <span class="throw_error" style="color:#FF0000; ">
                                                <?php
                                                echo isset($errors['self_order_email'][0]) ? $errors['self_order_email'][0] : NULL;
                                                ?>
                                            </span>
                                        </div>
                                        <!--Email :: END-->

                                        <!--Mobile :: START-->
                                        <div class="col-md-6">
                                            <?php
                                            $strFormPhone = isset($orderdetails->self_order_phone) ? $orderdetails->self_order_phone : NULL;
                                            $strExistPhone = isset($customer_info['phone']) ? $customer_info['phone'] : NULL;
                                            $strFinalPhone = !empty($strFormPhone) ? $strFormPhone : $strExistPhone;
                                            unset($strFormPhone, $strExistPhone);
                                            ?>
                                            <div class="form-group"><input class="form-control alt" type="text" id="self_order_phone" name="self_order_phone" placeholder="Enter Phone" value="<?php
                                                echo $strFinalPhone;
                                            ?>" ></div>
                                            <span class="throw_error" style="color:#FF0000; ">
                                                <?php
                                                echo isset($errors['self_order_phone'][0]) ? $errors['self_order_phone'][0] : NULL;
                                                ?>
                                            </span>
                                        </div>
                                        <!--Mobile :: END-->

                                        <!--City :: START-->
                                        <div class="col-md-6">

                                            <?php
                                            $strFormCity = isset($orderdetails->self_order_city) ? $orderdetails->self_order_city : NULL;
                                            $strExistCity = isset($order_info['order_city']) ? $order_info['order_city'] : NULL;
                                            $strFinalCity = !empty($strFormCity) ? $strFormCity : $strExistCity;
                                            unset($strFormCity, $strExistCity);
                                            ?>

                                            <div class="form-group">
                                                <input class="form-control alt" type="text" id="self_order_city"  name="self_order_city" 
                                                       value="<?php echo $strFinalCity; ?>" placeholder="Enter city" />
                                            </div>
                                            <span class="throw_error" style="color:#FF0000; ">
                                                <?php
                                                echo isset($errors['self_order_city'][0]) ? $errors['self_order_city'][0] : NULL;
                                                ?>
                                            </span>
                                        </div>
                                        <!--City :: END-->

                                        <!--Pincode :: START-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input class="form-control alt" type="text" id="self_order_pincode"  name="self_order_pincode" placeholder="Enter pincode" value="<?php echo isset($orderdetails->self_order_pincode) ? $orderdetails->self_order_pincode : NULL; ?>"></div>
                                            <span class="throw_error" style="color:#FF0000; ">
                                                <?php
                                                echo isset($errors['self_order_pincode'][0]) ? $errors['self_order_pincode'][0] : NULL;
                                                ?>
                                            </span>
                                        </div>
                                        <!--Pincode :: END-->

                                        <!--Address :: START-->
                                        <div class="col-md-6">
                                            <?php
                                            $strFormLocation = isset($orderdetails->self_order_address1) ? $orderdetails->self_order_address1 : NULL;
                                            $strExistLocation = isset($order_info['pickup_location']) ? $order_info['pickup_location'] : NULL;
                                            $strFinallocation = !empty($strFormLocation) ? $strFormLocation : $strExistLocation;
                                            unset($strFormLocation, $strExistLocation);
                                            ?>
                                            <div class="form-group"><input class="form-control alt" type="text" id="self_order_address1" name="self_order_address1" placeholder="Enter Address" value="<?php
                                                echo trim($strFinallocation);
                                            ?>" ></div>
                                            <span class="throw_error" style="color:#FF0000; ">
                                                <?php
                                                echo isset($errors['self_order_address1'][0]) ? $errors['self_order_address1'][0] : NULL;
                                                ?>
                                            </span>
                                        </div>
                                        <!--Address :: END-->

                                        <!--Address Two :: START-->
                                        <div class="col-md-6">
                                            
                                            <div class="form-group"><input class="form-control alt" id="self_order_address2" name="self_order_address2" type="text" placeholder="Enter Landmark" value="<?php echo isset($orderdetails->self_order_address2) ? $orderdetails->self_order_address2 : NULL; ?>"></div>
                                            <span class="throw_error" style="color:#FF0000; ">
                                                <?php
                                                echo isset($errors['self_order_address2'][0]) ? $errors['self_order_address2'][0] : NULL;
                                                ?>
                                            </span>
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
                                   

                                                   <div class="col-md-6">
                                            <?php $paymenttype = isset($orderdetails->payment_mode_id) ? $orderdetails->payment_mode_id : Null; ?>
                                            <div class="radio radio-inline">
                                                <input type="radio" id="paymenttype1" value="1" name="payment_mode_id" <?php
                                                if (1 == $paymenttype) {
                                                    echo 'checked';
                                                } else {
                                                    echo false;
                                                };
                                                ?> checked="">
                                                <label for="paymenttype1">Cash On Delivery</label>
                                            </div>
                                                   </div>
                                                <div class="col-md-6">
                                            <div class="radio radio-inline" style="margin-top:10px;">
                                                <input type="radio" id="paymenttype2" value="3" name="payment_mode_id" <?php
                                                if (3 == $paymenttype) {
                                                    echo 'checked';
                                                } else {
                                                    echo false;
                                                };
                                                ?> >
                                                <label for="paymenttype2">Online</label>
                                            </div>
                                                       
                                        </div>
                                    <span class="throw_error" style="color:#FF0000; ">
                                                <?php
                                                echo isset($errors['payment_mode_id'][0]) ? $errors['payment_mode_id'][0] : NULL;
                                                ?>
                                            </span>
                                           
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
                            <!-- Vehicle name :: Start!--> 
                            <div class="aside-amt-dtls">
                                <h5>Vehicle Details :</h5>
                                <div  class="est-reg_num">
                            <?php echo isset($order_info['vehicle_brand_name']) ? $order_info['vehicle_brand_name'] : NULL; ?> 
                                <?php echo isset($order_info['vehicle_model_name']) ? $order_info['vehicle_model_name'] : NULL; ?>/ 
                                    <span><?php echo isset($order_info['vehicle_variant_name']) ? $order_info['vehicle_variant_name'] : NUll; ?></span>

                                    / <?php echo isset($order_info['vehicle_seating_capacity']) ? ($order_info['vehicle_seating_capacity'] . '-Seater') : NUll; ?>

                                </div>
                            </div>
                            <!-- Vehicle name :: End!--> 

                            <!-- Registration Number :: Start!-->
                            <div class="aside-amt-dtls">
                                <h6>Registration Number :
                                    <?php
                                    echo isset($order_info['vehicle_registration_number']) ? $order_info['vehicle_registration_number'] : NULL;
                                    ?>
                                </h6></br>
                            </div>
                            <!-- Registration Number :: END!-->
                            <!-- Trip Start Date :: Start!-->
                            <div  class="est-reg_num">
                                <h5>Trip Start Date</h5>
                                <h4>
                                    <?php
                                    echo isset($order_info['start_date']) ? $order_info['start_date'] : NULL;
                                    ?>
                                </h4>
                            </div>
                            <!-- Trip Start Date :: END!-->

                            <!-- Trip End Date :: Start!-->
                            <h5>Trip End Date</h5>   
                            <h4>
                                <?php
                                echo isset($order_info['end_date']) ? $order_info['end_date'] : NULL;
                                ?>
                            </h4>
                            <!-- Trip End Date :: END!-->

                            <!-- Total Amount :: Start!-->
                            <div class="aside-amt-dtls">
                                <h5>Total Amount</h5>
                                <div  class="est-amount">
                                    <i class="fa fa-inr" aria-hidden="true"></i>
                                    <?php
                                    echo isset($order_info['final_amount']) ? $order_info['final_amount'] : NULL;
                                    ?>
                                </div>
                            </div>
                            <!-- Total Amount :: END!-->
                            <div class="checkbox">
                                <input type="checkbox" id="checkboxa1" name="checkboxa1" checked>
                                <label for="checkboxa1">I agree to the following: </label>
                            </div>
                            <span class="throw_error" style="color:#FF0000; ">
                                                <?php
                                                echo isset($errors['checkboxa1'][0]) ? $errors['checkboxa1'][0] : NULL;
                                                ?>
                            </span></br>
                            <a href="#">Universal Terms of Service Agreement Privacy Policy</a>
                            <div id="legal"></div>
                            <input type="hidden" value="<?php echo isset($order_info['start_date']) ? $order_info['start_date'] : NULL; ?>" id="start_date" name="start_date"/>
                            <input type="hidden" value="<?php echo isset($order_info['end_date']) ? $order_info['end_date'] : NULL; ?>" id="end_date" name="end_date"/>
                            <input type="hidden" value="<?php echo isset($order_info['pickup_location']) ? $order_info['pickup_location'] : NULL; ?>" id="pickup_location" name="pickup_location"/>
                            <input type="hidden" value="<?php echo isset($order_info['drop_location']) ? $order_info['drop_location'] : NULL; ?>" id="drop_location" name="drop_location"/>
                             <input type="hidden" name="selflocation" id="selflocation" class="selflocation" value="<?php echo isset($order_info['selflocation']) ? $order_info['selflocation'] : NUll; ?>"/>
                             <input type="hidden" name="location" id="location" value="<?php echo isset($order_info['location']) ? $order_info['location'] : NULL; ?>" />
                             <input type="hidden" name="pickup_location_latlng" id="pickup_location_latlng" value="<?php echo isset($order_info['pickup_location_latlng']) ? $order_info['pickup_location_latlng'] : NULL; ?>" />
                              <input type="hidden" name="drop_location_latlng" id="drop_location_latlng" value="<?php echo isset($order_info['drop_location_latlng']) ? $order_info['drop_location_latlng'] : NULL; ?>" />
                             
                               <?php $pickuplocation = isset($order_info['is_door_step']) ? $order_info['is_door_step'] : Null;
                                       if($pickuplocation == 1) { ?>
                                <input type="hidden" name="is_door_step" id="is_door_step" value="1" />
                                <input type="hidden" name="is_pickup" id="is_pickup" value="0" />
                               <?php }else{ ?>
                               <input type="hidden" name="is_pickup" id="is_pickup" value="1" />
                               <input type="hidden" name="is_door_step" id="is_door_step" value="0" />
                            <?php }?>
                            <div class="form-group mrg-top-20">
                                <input type="submit" class="btn ripple-effect btn-theme plsordr" name="final_self_book" id="final_self_book" value="Place Your Order">
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
        <input type='hidden' name='encRequest' id='encRequest'/>
        <input type='hidden' name='access_code' id='access_code' value ="<?php echo Yii::app()->params['payment_keys']['ccavenue']['access_code']; ?>"/>
    </form>
    <!--Payment :: END-->



    