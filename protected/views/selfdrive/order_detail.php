<?php

/* @var $this SelfdriveController */







?>

<?php //var_dump($bikedetails); ?>

<!-- CONTENT AREA -->

    <div class="content-area">

        <!-- BREADCRUMBS -->

         <section class="bookservice-main page-section breadcrumbs">

            <div class="container">

            <div class="col-md-6">

                <div class="page-header">

                    <div class="form-group has-icon has-label col-sm-12">

                      <label>&nbsp;</label>

                     <input class="form-control alt geocomplete" type="text" name="adrs" id="adrs" placeholder="picked customer location address" value="" required>

                      <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>  

                    </div>

                    <div class="col-sm-6">

                    <div class="form-group has-icon has-label">

                        <label>&nbsp;</label>

                        <input type="text" class="form-control" id="picdate" name="picdate" placeholder="Picking Up Date" value="">

                        <span class="form-control-icon"><i class="fa fa-calendar"></i></span>

                    </div>

                    </div>

                    <div class="col-sm-6">

                    <div class="form-group has-icon has-label">

                        <label>&nbsp;</label>

                        <input type="text" class="form-control" id="pickhr" name="pickhr" placeholder="Picking Up Hour" value="" >

                        <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>

                    </div>

                    </div>

            </div>

            </div>     	</form>       

            <div class="col-md-6 text-right">

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

        <section class="page-section with-sidebar sub-page bike-service-page">

            <div class="container">

                <div class="row">

                    <!-- CONTENT -->

                    <div class="col-md-9 content" id="content">
                        <div class="car-big-card alt">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="item">
                                        <img class="img-responsive" src="http://www.metrepersecond.com/MPS/<?php  echo $bikedetails[0]['model_img']; ?>" alt=""/>
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="car-details">
									<h3 class="brnd-mdl-name">Billing Information</h3>                                                              
										</div>
                                        <div class="price text-center">
                                         <?php //echo  Yii::app()->session['username']; ?>
										 <?php //echo $user_details['emailid']; ?>
										 <?php //echo $user_details['mobile_no']; ?>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
						
						  <h3 class="block-title alt">Payments options</h3>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading" style="background-color: #253b80;border-color: #253b80;">
                                    <a href="" style="color:#fff;"><i class="fa fa-paypal" aria-hidden="true"></i> PayPal</a>
                                </div>                        
                            </div>
                        </div>
                      
                        <div class="checkbox pull-left">
                            <input id="checkboxa1" type="checkbox">
                            <label for="checkboxa1">I accept all information and Payments etc</label>
                        </div> 
                     
                        <a class="btn btn-theme pull-right btn-theme-dark" href="#">Place Your Order</a>
                    </div>

                    <!-- /CONTENT -->

                    <!-- SIDEBAR -->

                    <aside class="col-md-3 sidebar selfaside" id="sidebar">
				<div class="widget shadow widget-helping-center estimate-widget">
                    
						 <h4 class="widget-title">Vehicle Servicing</h4>
                            <div class="widget-content">
                             <div class="aside-vhls-dtls">                            
	                           	<div id="carimg"></div>
	                        
                            <div id="extra" class="aside-srvs-dtls">
                                <h5>Order Summary</h5>
								<h4><?php //echo $service_cat[0]['cat_name']; ?></h4>
                            
							<div class="aside-amt-dtls">
                                <h5>Total Amount</h5>
                                	<!-- <div id="estamt" class="est-amount">
                               		1000.00
                               	</div> -->
								<i class="fa fa-inr" aria-hidden="true"></i><div  class="est-amount"><?php echo $total_amount; ?></div>
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


