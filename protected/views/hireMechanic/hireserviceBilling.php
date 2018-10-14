<?php //var_dump($bikedetails); ?>
<!-- CONTENT AREA -->

<script>

$(document).ready(function()
		{
			var boxes = $('#checky');

boxes.on('change', function () {
    $('#postme').prop('disabled', !boxes.filter(':checked').length);
}).trigger('change'); 
boxes.on('change', function () {
    $('#postme1').prop('disabled', !boxes.filter(':checked').length);
}).trigger('change'); 
			/* 
			
			$('#finalsub').click(function()
			{
				fnm=$('#nm').val();
				emailid=$('#emailid').val();
				phno=$('#phno').val();
				city=$('#city').val();
				adrs1=$('#adrs1').val();
				adrs2=$('#adrs2').val();
				$.post('<?php echo  $this->createUrl('mPSVEHICLES_DETAILS/FinalBooking');?>',{
					
					fnm:fnm,
					emailid:emailid,
					phno:phno,
					city:city,
					adrs1:adrs1,
					adrs2:adrs2
					
					
					
					
					 },
					 function(data)
					 {
					
					alert(data);
					
					 }); 
			}); */
			
			
		});
		</script>
		
		<?php if(isset($address)) { 
		
			
		$adds=explode('*',$address);
		$adds1=$adds[0];
	
		$adds2=$adds[1];
	
		}  ?>
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
                                    <h4><i class="fa fa-map-marker"></i> Billing Address Details</h4> 
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
												<form action="<?php echo $this->createUrl('HireMechanic/order');?>?transactionid=<?php if(isset($_GET['transactionid'])){ echo $_GET['transactionid']; } else { echo $bookid; } ?>" method="POST">
                                        <div class="col-md-6">
                                            <div class="form-group"><input class="form-control alt" type="text" id="nm" name="uname" value="<?php echo $name; ?>" placeholder="Name and Surname:*" required></div>
                                        </div>
                                        <div class="col-md-6">
										<input type="hidden" name="vehicle_type" value="bike" /> 
										
                                            <div class="form-group"><input class="form-control alt" type="text" id="emailid" name="email" value="<?php echo $email; ?>" placeholder="Your Email Address:*" required></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"><input class="form-control alt" type="text" id="phno" name="phone" value="<?php echo $mobile; ?>" placeholder="Phone Number:*" required></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"><input class="form-control alt" type="text" id="city" name="city" value="<?php if(isset($city)) echo $city; ?>" required></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"><input class="form-control alt" type="text" id="adrs1" name="adress1" placeholder="Address1*" value="<?php if(isset($adds1)) echo $adds1; ?>" required></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"><input class="form-control alt" id="adrs2" name="adress2" type="text" value="<?php if(isset($adds1)) echo $adds2; ?>"  placeholder="Address2"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group"></div>
                                        </div>
                                    </div>
                               
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4>Additional Information</h4> 
                                </div>
                                <div class="form-group">
                                <div class="panel-body">
                                <textarea rows="10" cols="30" id="id" name="name" placeholder="Additional Information" class="form-control alt"></textarea>
                                    <!--<ul>
                                        <li><h4>Pickup Location</h4>
                                            <p></p>
                                        </li>
                                        <li><h4>Booking Date<br>Booking Time
                                           </h4>
                                        </li>
                                        <li></li>
                                    </ul> -->
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
                                                    <span class="dot"></span> Cash on delivery
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
                                                    <span class="dot"></span> Citruspay
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
                                    <div class="form-group pull-right mrg-top-20">
                                        <input type="button" class="btn ripple-effect btn-theme plsordr" id="postme1" value="Place Your Order">
                                    </div>
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
                            <h5>Booking from Date </h5>
                            <h4><?php echo $fromdate; ?></h4>
								 <h5>Booking to Date</h5>
                            <h4><?php echo $todate; ?></h4>


                            <div class="aside-amt-dtls">
                                <h5>Total Amount</h5>
                                <div  class="est-amount">
                                    <i class="fa fa-inr" aria-hidden="true"></i><?php echo $data[0]['booking_charge'];  ?>
								</div>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" id="checky">
                                <label for="checkboxa1">I agree to the following: </label>
                                <a href="#">Universal Terms of Service Agreement Privacy Policy</a>
                            </div>
                            <div class="form-group text-center">
					
                                <input type="submit" class="btn ripple-effect btn-theme plsordr" name="finalselfdrive" id="postme" value="Place Your Order" />
                            </form>  
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
