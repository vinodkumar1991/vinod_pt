<?php

?>
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
		   if(isset($order_details['order_status']) && 'Aborted' == $order_details['order_status']){
		   ?>
            <h2 class="success-msg">Sorry, Your Payment Was Declined.</h2>     
            <p><?php echo $order_details['payment_message']; ?></p>
			<?php
		   }else{
			?>
			<h2 class="success-msg">Thanks you for shopping with us.</h2>     
            <p><?php echo $order_details['payment_message']; ?></p>
			<?php
		   }
			?>
			<h3 class="bookingno">Payment Status<span>
                    <?php
                    echo isset($order_details['order_status']) ? $order_details['order_status'] : NULL;
                    ?>
                </span>
            </h3>
           <h3 class="bookingno">Tracking Id<span>
                    <?php
                    echo isset($order_details['tracking_id']) ? $order_details['tracking_id'] : NULL;
                    ?>
                </span>
            </h3>
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
                            echo isset($order_details[0]['BrandName']) ? $order_details[0]['BrandName'] : NULL;  echo '-'; echo isset($order_details[0]['ModelName']) ? $order_details[0]['ModelName'] : NULL;
                            ?>
                        </span><br>
                       
                      
                    </h4>
                </div>        
                <div class="col-md-6 vhlc-track-btn"><a href="" class="btn btn-submit btn-theme"><i class="fa fa-thumb-tack" aria-hidden="true"></i>
                        Track My Vehicle</a></div>
            </div>
            <strong class="recivedamount">Rs. <?php
                echo isset($order_details['price']) ? $order_details['price'].'/- only' : '0.00';
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
                <li>Horn</li>
                <li>Meter/Console lights</li>
            </ul>
        </div>
        <div class="col-md-4"><img src="<?php echo Yii::app()->baseUrl; ?>/images/tracking-img.png" class="pull-right"></div>
    </div>
</section>