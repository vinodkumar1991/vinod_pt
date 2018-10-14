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
		   <?php
		   if(isset($payment_details['order_status']) && 'Aborted' == $payment_details['order_status']){
		   ?>
            <h2 class="success-msg">Sorry, Your Payment Was Declined.</h2>     
            <p><?php echo $payment_details['payment_message']; ?></p>
			<?php
		   }else{
			?>
			<h2 class="success-msg">Thanks you for shopping with us.</h2>     
            <p><?php echo $payment_details['payment_message']; ?></p>
			
			<h3 class="bookingno">Payment Status<span>
                    <?php
                    echo isset($payment_details['order_status']) ? $payment_details['order_status'] : NULL;
                    ?>
                </span>
            </h3>
            <?php
		   }
			?>
           <h3 class="bookingno">Tracking Id<span>
                    <?php
                    echo isset($payment_details['tracking_id']) ? $payment_details['tracking_id'] : NULL;
                    ?>
                </span>
            </h3>
			
            <h3 class="bookingno">Booking No. <span>
                    <?php
                    echo isset(Yii::app()->session['order_number']) ? Yii::app()->session['order_number'] : NULL;
                    ?>
                    
                </span>
            </h3>
             <div class="row">
                <div class="col-md-6">
                    <h4 class="orderconfirm-bkg-dtls">Vehicle Type: <span>
                            <?php
                            echo isset($order_details['vehicle_type']) ? $order_details['vehicle_type'] : NULL;
                            ?>
                        </span><br>
                        Vehicle Brand:  <span>
                            <?php
                            echo isset($order_details['vehicle_brand_name']) ? $order_details['vehicle_brand_name'] : NULL;
                            ?>
                        </span>
                        <br>
                          Vehicle Model:  <span>
                            <?php
                            echo isset($order_details['vehicle_model_name']) ? $order_details['vehicle_model_name'] : NULL;
                            ?>
                        </span>
                    </h4>
                </div>  
                
<!--                <div class="col-md-6 vhlc-track-btn"><a href="#" class="btn btn-submit btn-theme"><i class="fa fa-thumb-tack" aria-hidden="true"></i>
                        Track My Vehicle</a></div>-->
            </div>
            
            <strong class="recivedamount">Rs <?php
                echo isset($order_details['final_amount']) ? $order_details['final_amount'] : '0.00';
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
                 <!-- <li>Horn</li>
                <li>Meter/Console lights</li> -->
            </ul>
        </div>
        <div class="col-md-4">
            <img src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/easings-slider/images/2self-drive.jpg" class="pull-right" alt="Self Drive">
        </div>
    </div>
</section>