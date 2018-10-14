<style>
    #preloader,
    .sticky-wrapper,
    .sticky-wrapper.is-sticky,
    .header.fixed,
    .subscribe,
    .footer{
        display: none !important;
    }
</style>
<section class="page-section with-sidebar sub-page billing-page-wraper">
    <div class="container">
        <form action="" class="form-delivery" method="post">
            <div class="row">
                <div class="col-md-9 content">
                    <!--Billing Address Details :: START-->
                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4><i class="fa fa-map-marker"></i> 
                                    Billing Address Details
                                </h4> 
                            </div>
                            <div class="panel-body">
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
                                            <?php
                                            $strFormName = isset($payment_form->first_name) ? $payment_form->first_name : NULL;
                                            $strExisName = isset($order_info['first_name']) ? $order_info['first_name'] : NULL;
                                            $strFinalName = isset($strFormName) ? $strFormName : $strExisName;
                                            ?>
                                            <input class="form-control alt" type="text" id="first_name" name="first_name" value="<?php echo $strFinalName; ?>" placeholder="Enter Full Name"/>
                                            <?php
                                            echo isset($errors['first_name'][0]) ? $errors['first_name'][0] : NULL;
                                            ?>
                                        </div>

                                    </div>
                                    <!--Name :: END-->

                                    <!--Email :: START-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            $strFormEmail = isset($payment_form->email) ? $payment_form->email : NULL;
                                            $strExisEmail = isset($order_info['email']) ? $order_info['email'] : NULL;
                                            $strFinalEmail = isset($strFormEmail) ? $strFormEmail : $strExisEmail;
                                            ?>
                                            <input class="form-control alt" type="text" id="email" name="email" placeholder="Enter Email" value="<?php echo $strFinalEmail; ?>"/>
                                            <?php
                                            echo isset($errors['email'][0]) ? $errors['email'][0] : NULL;
                                            ?>
                                        </div>
                                    </div>
                                    <!--Email :: END-->

                                    <!--Mobile :: START-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            $strFormMobile = isset($payment_form->phone) ? $payment_form->phone : NULL;
                                            $strExisMobile = isset($order_info['phone']) ? $order_info['phone'] : NULL;
                                            $strFinalMobile = isset($strFormMobile) ? $strFormMobile : $strExisMobile;
                                            ?>
                                            <input class="form-control alt" type="text" id="phone" name="phone" placeholder="Enter Phone" value="<?php echo $strFinalMobile; ?>"/>
                                            <?php
                                            echo isset($errors['phone'][0]) ? $errors['phone'][0] : NULL;
                                            ?>
                                        </div>
                                    </div>
                                    <!--Mobile :: END-->

                                    <!--City :: START-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            $strFormCity = isset($payment_form->order_city) ? $payment_form->order_city : NULL;
                                            $strExisCity = isset($order_info['order_city']) ? $order_info['order_city'] : NULL;
                                            $strFinalCity = isset($strFormCity) ? $strFormCity : $strExisCity;
                                            ?>
                                            <input class="form-control alt" type="text" id="order_city"  name="order_city" value="<?php echo $strFinalCity; ?>" placeholder="Enter city"/>
                                            <?php
                                            echo isset($errors['order_city'][0]) ? $errors['order_city'][0] : NULL;
                                            ?>
                                        </div>
                                    </div>
                                    <!--City :: END-->

                                    <!--Pincode :: START-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            $strFormPincode = isset($payment_form->order_pincode) ? $payment_form->order_pincode : NULL;
                                            $strExistPincode = isset($order_info['order_pincode']) ? $order_info['order_pincode'] : NULL;
                                            $strFinalPincode = isset($strFormPincode) ? $strFormPincode : $strExistPincode;
                                            ?>
                                            <input class="form-control alt" type="text" id="order_pincode"  name="order_pincode" value="<?php echo $strFinalPincode; ?>" placeholder="Enter pincode"/>
                                            <?php
                                            echo isset($errors['order_pincode'][0]) ? $errors['order_pincode'][0] : NULL;
                                            ?>
                                        </div>
                                    </div>
                                    <!--Pincode :: END-->

                                    <!--Address :: START-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            $strFormAddrss = isset($payment_form->customer_address) ? $payment_form->customer_address : NULL;
                                            $strExistAddress = isset($order_info['customer_address']) ? $order_info['customer_address'] : NULL;
                                            $strFinalAddress = isset($strFormAddrss) ? $strFormAddrss : $strExistAddress;
                                            ?>
                                            <input class="form-control alt" type="text" id="customer_address" name="customer_address" placeholder="Enter Address" value="<?php echo $strFinalAddress; ?>"/>
                                            <?php
                                            echo isset($errors['customer_address'][0]) ? $errors['customer_address'][0] : NULL;
                                            ?>
                                        </div>
                                    </div>
                                    <!--Address :: END-->

                                    <!--Address Two :: START-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            $strFormLocalArea = isset($payment_form->order_address2) ? $payment_form->order_address2 : NULL;
                                            $strExistLocalArea = isset($order_info['order_address2']) ? $order_info['order_address2'] : NULL;
                                            $strFinalLocalArea = isset($strFormLocalArea) ? $strFormLocalArea : $strExistLocalArea;
                                            ?>
                                            <input class="form-control alt" id="order_address2" name="order_address2" type="text" value="<?php echo $strFinalLocalArea; ?>" placeholder="Enter Landmark">
                                            <?php
                                            echo isset($errors['order_address2'][0]) ? $errors['order_address2'][0] : NULL;
                                            ?>
                                        </div>
                                    </div>
                                    <!--Address Two :: END-->
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--Billing Address Details :: END-->
                </div>

                <!-- SIDEBAR -->
                <aside class="col-md-3 sidebar selfaside aside-mrg-top0" id="sidebar">
                    <div class="widget shadow widget-helping-center estimate-widget">                    
                        <h4 class="widget-title">Order Summary</h4>
                        <div class="widget-content">
                            <h5>Booking Date</h5>
                            <h4>
                                <?php
                                echo isset($order_info['booked_date']) ? $order_info['booked_date'] : NULL;
                                ?>
                            </h4>

                            <h5>Booking Time</h5>   
                            <h4>
                                <?php
                                echo isset($order_info['booked_time']) ? $order_info['booked_time'] : NULL;
                                ?>
                            </h4>

                            <div class="aside-amt-dtls">
                                <h5>Total Amount</h5>
                                <div  class="est-amount">
                                    <i class="fa fa-inr" aria-hidden="true"></i>
                                    <?php
                                    echo isset($order_info['final']) ? $order_info['final'] : NULL;
                                    ?>
                                </div>
                            </div>
                            <div class="checkbox">
                                <?php
                                $isChecked = NULL;
                                if (isset($errors['terms_conditions'][0]) && !empty($errors['terms_conditions'][0])) {
                                    $isChecked = 'false';
                                } else if (isset($payment_form->terms_conditions) && !empty($payment_form->terms_conditions)) {
                                    $isChecked = 'true';
                                }
                                ?>

                                <?php
                                if (true == $isChecked) {
                                    ?>
                                    <input type="checkbox" id="terms_conditions" name='terms_conditions' value="1" checked="checked">
                                    <?php
                                } else {
                                    ?>
                                    <input type="checkbox" id="terms_conditions" name='terms_conditions' value="0" checked="checked">
                                    <?php
                                }
                                ?>
                                <label for="checkboxa1">I agree to the following: </label>
                                <?php
                                echo isset($errors['terms_conditions'][0]) ? $errors['terms_conditions'][0] : NULL;
                                ?>
                            </div>
                            <a href="#">Universal Terms of Service Agreement Privacy Policy</a>
                            <div id="legal"></div>
                            <div class="form-group pull-right mrg-top-20">
                                <input type="submit" class="btn ripple-effect btn-theme plsordr" name="do_payment" id="do_payment" value="Place Your Order">
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </form>
    </div>
</section>






