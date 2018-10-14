<?php
/* @var $this SelfdriveController */



?>
<link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/owl-carousel2/assets/owl.carousel.min.css" rel="stylesheet">
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/owl-carousel2/owl.carousel.min.js"></script>

<!-- CONTENT AREA -->
    <div class="content-area">

        <!-- BREADCRUMBS -->
        <section class="page-section breadcrumbs text-right">
            <div class="container">
                <div class="page-header">
                    <h1>Car Booking</h1>
                </div>
                <ul class="breadcrumb">
                    <li><a href="<?php echo Yii::app()->homeUrl;?>">Home</a></li>
                    <li><a href="<?php echo $this->createUrl('mPSVEHICLES_DETAILS/Booking');?>">Self Drive</a></li>
                    <li class="active">Booking & Payment</li>
                </ul>
            </div>
        </section>
        <!-- /BREADCRUMBS -->

        <!-- PAGE WITH SIDEBAR -->
        <section class="page-section with-sidebar sub-page self-fullview-book">
            <div class="container">
                <div class="row">
                    <!-- CONTENT -->
                    <div class="col-md-9 content" id="content">

                        <h3 class="block-title alt">Car Information</h3>
                        <div class="car-big-card alt">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="owl-carousel img-carousel">
                                        <div class="item">
                                            <a class="btn btn-zoom" href="http://www.metrepersecond.com/MPS<?php echo $bookorder['img_path']; ?>" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                            <a href="http://www.metrepersecond.com/MPS<?php echo $bookorder['img_path']; ?>" data-gal="prettyPhoto"><img class="img-responsive" src="http://www.metrepersecond.com/MPS<?php echo $bookorder['img_path']; ?>" alt=""/></a>
                                        </div>
										
           
										    <?php $bookimages=unserialize($bookorder['imagespath']);
										
									$i=0; while($i<sizeof($bookimages))
									{ 
									?>
										<div class="item">
                                            <a class="btn btn-zoom" href="http://www.metrepersecond.com/MPS<?php echo $images[$i]; ?>" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                            <a href="http://www.metrepersecond.com/MPS<?php echo $bookimages[$i]; ?>" data-gal="prettyPhoto"><img class="img-responsive" src="http://www.metrepersecond.com/MPS<?php echo $bookimages[$i]; ?>" alt="<?php echo $bookorder['makename'];?>"/></a>
                                        </div>
                                     <?php $i++; } ?> 
                                    </div>
                                    <div class="row car-thumbnails">
									<?php 
										$bookimages=unserialize($bookorder['imagespath']);
										
									?>
                                        <div class="col-xs-2 col-sm-2 col-md-3"><a href="#" onclick="jQuery('.img-carousel').trigger('to.owl.carousel', [0,300]);"><img src="http://www.metrepersecond.com/MPS<?php echo $bookorder['img_path']; ?>" width="70" alt="<?php echo $bookorder['makename'];?>"/></a></div>
                                        <?php 
									$j=0; while($j<sizeof($bookimages))
									{ 
									?>
                                        <div class="col-xs-2 col-sm-2 col-md-3"><a href="#" onclick="jQuery('.img-carousel').trigger('to.owl.carousel', [<?php echo $j+1; ?>,300]);"><img src="http://www.metrepersecond.com/MPS<?php echo $bookimages[$j]; ?>" width="70" alt="<?php echo $bookorder['makename'];?>"/></a></div>
                                       
									<?php $j++; } ?> 
									</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="car-details">
                                        <div class="list">
                                            <ul>
                                                <li class="title">
                                                    <h2><?php echo $bookorder['makename'];?><?php echo $bookorder['modelname']?> <span><?php echo $bookorder['variant']; ?></span></h2>
                                                    Excess Kms <?php echo $bookorder['extra_rate_per_kms'];?>Rs/ per Kms
                                                </li>
                                                <li>Security Deposit <?php echo $bookorder['security_deposit'];?>Rs</li>
                                                <li>Price Per Hour <?php echo $bookorder['price_per_hour'];?>Rs</li>
                                                <li>Seating Capacity <?php echo $bookorder['seating_capacity'];?></li>
                                            </ul>
                                        </div>
                                        <div class="price">
                                            <strong><i class="fa fa-inr"></i><?php echo $bookorder['price']; ?></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="page-divider half transparent"/>

                        <h3 class="block-title alt">Extras & Frees</h3>
                        <form role="form" class="form-extras">
							<?php $features=explode(',',$bookorder['vehicle_features']);
								$i=0; while($i<sizeof($features)-1) {
								?>
                                <div class="col-md-3 checkbox checkbox-danger">
                                    <input id="checkboxl1" type="checkbox" disabled="disabled" checked="checked">
                                    <label for="checkboxl1"><?php echo $features[$i]; ?></label>
                                </div>
								<?php $i++; } ?>
                        </form>
                        <div class="clearfix">&nbsp;</div>
                        <h3 class="block-title alt">Customer Information</h3>
                        <form action="#" class="form-delivery">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group"><input class="form-control alt" type="text" value="<?php echo Yii::app()->session['username']; ?>" ></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"><input class="form-control alt" type="text" value="<?php echo $user_details['emailid']; ?>" ></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"><input class="form-control alt" type="text" value="<?php echo $user_details['mobile_no']; ?>" ></div>
                                </div>
                                
                            </div>
                        </form>
                        <div class="clearfix">&nbsp;</div>
                        <h3 class="block-title alt">Payments options</h3>
                        <div class="panel-group payments-options" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel radio panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" aria-controls="collapseOne">
                                            <span class="dot"></span> Direct Bank Transfer
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
                                    <div class="panel-body">
                                        <div class="alert alert-success" role="alert">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sollicitudin ultrices suscipit. Sed commodo vel mauris vel dapibus.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false" aria-controls="collapseTwo">
                                            <span class="dot"></span> Cheque Payment
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
                                    <div class="panel-body">
                                        Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="false" aria-controls="collapseThree">
                                            <span class="dot"></span> Credit Card
                                        </a>
                                <span class="overflowed pull-right">
                                    <img src="<?php echo Yii::app()->baseUrl; ?>/assets/img/preview/payments/mastercard-2.jpg" alt=""/>
                                    <img src="<?php echo Yii::app()->baseUrl; ?>/assets/img/preview/payments/visa-2.jpg" alt=""/>
                                    <img src="<?php echo Yii::app()->baseUrl; ?>/assets/img/preview/payments/american-express-2.jpg" alt=""/>
                                    <img src="<?php echo Yii::app()->baseUrl; ?>/assets/img/preview/payments/discovery-2.jpg" alt=""/>
                                    <img src="<?php echo Yii::app()->baseUrl; ?>/assets/img/preview/payments/eheck-2.jpg" alt=""/>
                                </span>
                                    </h4>
                                </div>
                                <div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3"></div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading4">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                            <span class="dot"></span> PayPal
                                        </a>
                                        <span class="overflowed pull-right"><img src="assets/img/preview/payments/paypal-2.jpg" alt=""/></span>
                                    </h4>
                                </div>
                                <div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading4"></div>
                            </div>
                        </div>
                        <div class="overflowed">
                            <div class="checkbox pull-left">
                                <input id="checkboxa1" type="checkbox">
                                <label for="checkboxa1">I accept all information and Payments etc</label>
                            </div>
                            <a class="btn btn-theme pull-right" href="#" style="margin-left:10px;">Pay Now</a>
                            <a class="btn btn-theme pull-right btn-theme-dark" href="#">Cancel</a>
                        </div>

                    </div>
                    <!-- /CONTENT -->

                    <!-- SIDEBAR -->
                    <aside class="col-md-3 sidebar" id="sidebar">
                        <!-- widget detail reservation -->
                        <div class="widget shadow widget-details-reservation">
                            <h4 class="widget-title">Detail Reservation</h4>
                            <div class="widget-content">
                                <h5 class="widget-title-sub">Picking Up Location</h5>
                                <div class="media">
                                    <span class="media-object pull-left"><i class="fa fa-calendar"></i></span>
                                    <div class="media-body"><p><?php echo date('d M Y H:i:s ',$bookorder['from_date']); ?></p></div>
                                </div>
                                <div class="media">
                                    <span class="media-object pull-left"><i class="fa fa-location-arrow"></i></span>
                                   <div class="media-body"><p><?php echo $bookorder['location'] ?> </p></div> 
                                </div>
                                <h5 class="widget-title-sub">Droping Off Time</h5>
                                <div class="media">
                                    <span class="media-object pull-left"><i class="fa fa-calendar"></i></span>
                                    <div class="media-body"><p><?php echo date('d M Y H:i:s ',$bookorder['to_date']); ?></p></div>
                                </div>
                                <div class="media">
                                    <span class="media-object pull-left"><i class="fa fa-location-arrow"></i></span>
                                    <!--  <div class="media-body"><p>From SkyLine AirPort</p></div> -->
                                </div>
                                <div class="button">
                                    <a href="#" class="btn btn-theme">Pay Now</a>
                                </div>
                            </div>
                        </div>
                        <!-- /widget detail reservation -->
                        <!-- widget helping center -->
                        <div class="widget shadow widget-helping-center">
                            <h4 class="widget-title">Support Center</h4>
                            <div class="widget-content">
                                <p>Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros.</p>
                                <h5 class="widget-title-sub">+90 555 444 66 33</h5>
                                <p><a href="mailto:support@supportcenter.com">support@supportcenter.com</a></p>
                            </div>
                        </div>
                        <!-- /widget helping center -->
                    </aside>
                    <!-- /SIDEBAR -->

                </div>
            </div>
        </section>
        <!-- /PAGE WITH SIDEBAR -->
