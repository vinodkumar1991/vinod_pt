
<section class="bookservice-main page-section breadcrumbs">
    <div class="container">
        <div class="col-md-12 text-right">
            <div class="page-header">
                <h1>Order Confirmed</h1>
            </div>
        </div>
    </div>
</section>

<section class="page-section sub-page no-padding-bottom">
    <div class="container">
        <div class="col-md-4">
            <img src="<?php echo Yii::app()->baseUrl; ?>/images/tracking-icon.png">
        </div>
        <div class="col-md-8">
            <h2 class="success-msg">Thanks you for chossing us.</h2>
            <h3 class="bookingno">Order Number : <span>
                    <?php
                    echo isset($order_details[0]['order_number']) ? $order_details[0]['order_number'] : NULL;
                    ?>
                </span>
            </h3>
            <div class="row">
                <div class="col-md-6">
                    <h4 class="orderconfirm-bkg-dtls">
                        Vehicle Type: 
                        <span>
                            <?php
                            echo isset($order_details[0]['vehicle_name']) ? $order_details[0]['vehicle_name'] : NULL;
                            ?>
                        </span>
                        <br>
                        Vehicle Brand: 
                        <span>
                            <?php
                            echo isset($order_details[0]['vehicle_brand_name']) ? $order_details[0]['vehicle_brand_name'] : NULL;
                            ?>
                        </span>
                        <br>
                        Vehicle Model: 
                        <span>
                            <?php
                            echo isset($order_details[0]['vehicle_model_name']) ? $order_details[0]['vehicle_model_name'] : NULL;
                            ?>
                        </span>
                        <br>
                        Mechanic Model:
                        <span>
                            <?php
                            echo isset($order_details[0]['hire_name']) ? $order_details[0]['hire_name'] : NULL;
                            ?>
                        </span>
                        <br/>
                        Mechanic Code:
                        <span>
                            <?php
                            echo isset($order_details[0]['hire_code']) ? $order_details[0]['hire_code'] : NULL;
                            ?>
                        </span>
                    </h4>
                </div>        
            </div>
            <strong class="recivedamount">Rs <?php
                echo isset($order_details[0]['hire_hour_price']) ? $order_details[0]['hire_hour_price'] : '0.00';
                ?>
            </strong>            
        </div> 
    </div>
</div>
</section>

<!--<section class="page-section section-green sub-page trackprocess">
    <div class="container car-big-card">    
        <div class="col-md-8 car-details">
            <h2>Process for the tracking</h2>
            <ul>
                <li>Download Mobile App</li>
                <li>Go to My Orders</li>
                <li>Click Track My Vehicles</li>
                <li>Horn</li>
                <li>Meter/Console lights</li>
            </ul>
        </div>
        <div class="col-md-4"><img src="<?php //echo Yii::app()->baseUrl; ?>/images/tracking-img.png" class="pull-right"></div>
    </div>
</section>-->