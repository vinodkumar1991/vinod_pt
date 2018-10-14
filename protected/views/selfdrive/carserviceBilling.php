<?php
/* @var $this SelfdriveController */
?>
<?php //var_dump($bikedetails); ?>
<!-- CONTENT AREA -->
    <div class="content-area">
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
        <section class="page-section with-sidebar sub-page billing-page-wraper">
            <div class="container">
                <div class="row">
                    <!-- CONTENT -->
                    <div class="col-md-9 content">
                        <div class="row">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4><i class="fa fa-map-marker"></i> Location Details</h4> 
                                </div>
                                <div class="panel-body">
                                    <ul>
                                        <li><h4>Pic Location</h4>
                                            <p><?php 
											if(isset($_GET['pickadrs']))
											{
												echo $_GET['pickadrs'];
											}
											else
											{
												echo $pickadrs;
											}
											?></p>
                                        </li>
                                        <li><h4><?php 
											if(isset($_GET['picdate']))
											{
												echo $_GET['picdate'];
											}
											else
											{
												echo $pickdate;
											}
											?><br>
                                            <?php 
											if(isset($_GET['pickhr']))
											{
												echo $_GET['pickhr'];
											}
											else
											{
												echo $pickhr;
											}
											?></h4>
                                        </li>
                                        <li></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4><i class="fa fa-map-marker"></i> Billing Address Details</h4> 
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea rows="10" cols="30" id="id" name="name" placeholder="Addıtıonal Informatıon" class="form-control alt"></textarea>
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
                                    <div class="panel radio panel-default">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" aria-controls="collapseOne">
                                                    <span class="dot"></span> Citruspay
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
                                                    <span class="dot"></span> CCAvenue
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
                                            <div class="panel-body">
                                                Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.
                                            </div>
                                        </div>
                                    </div>
									<!--<a class="btn btn-theme pull-right mrg-top-20" href="<?php //echo create_url('mPSVEHICLES_DETAILS/CarDetails');?>">Back</a>-->
                                    <a class="btn btn-theme pull-right mrg-top-20" href="#">Place Your Order</a>
                                </div>                                  
                                </div>
                            </div>
                        </div>
                        </div>
                    <!-- /CONTENT -->

                    <!-- SIDEBAR -->
                    <aside class="col-md-3 sidebar selfaside" id="sidebar">
				    <div class="widget shadow widget-helping-center estimate-widget">                    
						 <h4 class="widget-title">Order Summary</h4>
                            <div class="widget-content">
                            <div class="aside-amt-dtls">
                                <h5>Total Amount</h5>
                                <div  class="est-amount">
                                    <i class="fa fa-inr" aria-hidden="true"></i><?php if(isset($_GET['amount']))
									{
										echo $_GET['amount'];
									}
																			
										?>
									</div>
                                <div class="checkbox">
                                    <input type="checkbox" id="checkboxa1">
                                    <label for="checkboxa1">I agree to the following: </label>
                                    <a href="#">Universal Terms of Service Agreement Privacy Policy</a>
                                </div>
                                    <a class="btn btn-theme" href="#">Place Your Order</a>
                                </div>
                            </div>
                        <!-- /widget detail reservation -->
                    </div>
                    </aside>
                    <!-- /SIDEBAR -->
                </div>
            </div>
        </section>
        <!-- /PAGE WITH SIDEBAR -->
