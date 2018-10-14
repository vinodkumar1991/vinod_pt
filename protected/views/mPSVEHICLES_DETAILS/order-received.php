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
        <h2 class="success-msg">Thank You for choosing us</h2>     
        <p>Soon our Representative will pick your vehicle</p>
        <h3 class="bookingno">Booking No. <span><?php echo $bookid; ?></span></h3>
        <div class="row">
            <div class="col-md-6">
                <h4 class="orderconfirm-bkg-dtls">Vehicle Type: <span><?php echo ucfirst($vehicle_type); ?></span><br>
                    Type of Service: <span><?php echo $typeofservice; ?></span><br>
                   <?php if($vehicle_type=="car") { ?>Package Type: <span>Basic</span> <?php } ?>
                </h4>
            </div>        
            <div class="col-md-6 vhlc-track-btn"><a href="" class="btn btn-submit btn-theme"><i class="fa fa-thumb-tack" aria-hidden="true"></i>
 Track My Vehicle</a></div>
        </div>
        <strong class="recivedamount">Rs <?php echo $amount; ?></strong>            
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