<section class="bookservice-main page-section breadcrumbs">
    <div class="container">
        <div class="col-md-12 text-right">
            <div class="page-header">
                <h1>Track My Vehicle</h1>
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
            <?php
            if (isset($payment_details['order_status']) && !empty($payment_details['order_status'])) {
                ?>
                <h3 class="bookingno">Payment Status : <span>
                        <?php
                        echo $payment_details['order_status'];
                        ?>
                    </span>
                </h3>
                <h3 class="bookingno">Tracking Id<span>
                        <?php
                        echo isset($payment_details['tracking_id']) ? $payment_details['tracking_id'] : NULL;
                        ?>
                    </span>
                </h3>
                <?php
            }
            ?>

            <h3 class="bookingno">Booking No. <span>
                    <?php
                    echo isset($order_details['order_number']) ? $order_details['order_number'] : NULL;
                    ?>
                </span>
            </h3>
            <div class="row">
                <div class="col-md-6">
                    <h4 class="orderconfirm-bkg-dtls">Vehicle Type: <span>
                            <?php
                            echo isset($order_details['vehicle_name']) ? $order_details['vehicle_name'] : NULL;
                            ?>
                        </span><br>
                        Type of Service: <span>
                            <?php
                            echo isset($order_details['service_name']) ? $order_details['service_name'] : NULL;
                            ?>
                        </span>
                        <br>
                        Package Type: <span>
                            <?php
                            echo isset($order_details['plan_name']) ? $order_details['plan_name'] : NULL;
                            ?>
                        </span>
                    </h4>
                </div>        
                <div class="col-md-6 vhlc-track-btn"><a href="<?php echo Yii::app()->params['app_download_link'] ?>" class="btn btn-submit btn-theme"><i class="fa fa-thumb-tack" aria-hidden="true"></i>
                        Track My Vehicle</a></div>
            </div>
            <strong class="recivedamount">Rs <?php
                echo isset($order_details['total_amount']) ? $order_details['total_amount'] : '0.00';
                ?>
            </strong>            
        </div> 
    </div>
</div>
</section>

<section class="page-section section-green sub-page trackprocess">
    <div class="container car-big-card">    
        <div class="col-md-8 car-details">
            <h2>Process for the tracking</h2>
            <ul>
                <li>Download Mobile App</li>
                <li>Go to My Orders</li>
                <li>Click Track My Vehicles</li>
                <!--                <li>Horn</li>
                                <li>Meter/Console lights</li>-->
            </ul>
        </div>
        <div class="col-md-4"><img src="<?php echo Yii::app()->baseUrl; ?>/images/tracking-img.png" class="pull-right"></div>
    </div>
</section>
