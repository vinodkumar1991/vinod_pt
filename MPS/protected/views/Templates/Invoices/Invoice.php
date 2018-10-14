<?php
//echo'<pre>';print_r($order_info);die();
?>
<div class="container">
    <div class="invoice-page-wraper">
        <div class="row invoice-outline" style="border: 1px solid #dcdcdc;">
            <div class="col-xs-12"> 
                	
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6"><h3>Invoice Details</h3></div>
                        <div class="pull-right icons-print-pdf">                            
                            <a title="Back" href="<?php echo Yii::app()->params['webURL'].'Reports/Orders/Orders/Orders'?>" class="btn btn-success">
    			<i aria-hidden="true" class="fa fa-arrow-left"></i>
			</a>
                            <!--<a href="javascript:void(0);" title="Print Invoice" onclick="printInvoice();" class="btn btn-warning edit-u"><i class="fa fa-print" aria-hidden="true"></i></a>-->
                            <a href="<?php echo Yii::app()->params['webURL'] . 'Invoice/Invoice/HTML2pdf?OrdNo='.$OrderNo?>" class="btn btn-warning edit-u" title="Download Invoice"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-md-2 col-xs-12 text-center">
                        <img src="<?php echo Yii::app()->params['imgURL'].'logo-invoice.png'?>" alt="" width="150" height="150"/>                        
                    </div>
                    <div class="col-md-10 col-xs-12">
                        <div class="invoice-vend-dtls">                            
                            <!-- <h2 class="vend-title-name">Xenex Automotivee</h2>
                            <strong>Contact us: 1800 208 9898 || xenex@metrepersecond.com.com</strong><br>
                            <address>Mechanic Shop Address: <span style="text-transform:uppercase;">SY NO 696, GUNDLAPOCHAMPALLY VILLAGE, MEDCHAL MANDAL, RANGA REDDY DIST, SECUNDRABAD, TELENGANA, India - 501401</span></address>-->
                            <h2 class="vend-title-name"><?php echo isset($order_info[0]['shopname']) ? $order_info[0]['shopname'] : 'Not Available'; ?></h2>
                            <strong>Contact us:  <?php echo isset($order_info[0]['shopphone']) ? $order_info[0]['shopphone'] : 'Not Available'; ?> || <?php echo isset($order_info[0]['shopemail']) ? $order_info[0]['shopemail'] : 'Not Available'; ?></strong><br>
                            <address>Mechanic Shop Address: <span style="text-transform:uppercase;"><?php echo isset($order_info[0]['shopaddress']) ? $order_info[0]['shopaddress'] : 'Not Available'; ?></span></address>
                        </div>
                    </div>        	
                </div>

                <hr>
                <div class="row">
                    <div class="col-xs-12 col-md-3 col-lg-3">
                        <div class="panel panel-default height">
                            <div class="panel-heading">Order Preferences</div>
                            <div class="panel-body">
                                <strong>Booking ID: </strong><?php echo isset($order_info[0]['order_number']) ? $order_info[0]['order_number'] : NULL; ?><br>
                                <strong>Order Date:</strong> <?php echo isset($order_info[0]['order_booked_date']) ? $order_info[0]['order_booked_date'] : NULL; ?><br>
                                <strong>Brand :</strong> <?php echo isset($order_info[0]['brand_name']) ? $order_info[0]['brand_name'] : NULL; ?><br>
                                <strong>Model :</strong> <?php echo isset($order_info[0]['model_name']) ? $order_info[0]['model_name'] : NULL; ?><br>
                                <strong>Vehicle Type :</strong> <?php echo isset($order_info[0]['vehicle_type']) ? $order_info[0]['vehicle_type'] : NULL; ?><br>
                                <strong>Vehicle Variant :</strong> <?php echo isset($order_info[0]['vehicle_variant']) ? $order_info[0]['vehicle_variant'] : NULL; ?><br>
                                <strong>Invoice Date:</strong> <?php echo isset($order_info[0]['invoice_date']) ? $order_info[0]['invoice_date'] : '-'; ?><br>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-3 col-lg-3 pull-left">
                        <div class="panel panel-default height">
                            <div class="panel-heading">Billing Details</div>
                            <div class="panel-body">
                                <strong><?php echo isset($order_info[0]['customer_primary_fullname']) ? $order_info[0]['customer_primary_fullname'] : NULL; ?></strong><br>	                            
                                <span><strong>Address: </strong><?php echo isset($order_info[0]['customer_address']) ? $order_info[0]['customer_address'] : NULL; ?></span><br>
                                <span><strong>Phone : </strong> <?php echo isset($order_info[0]['customer_primary_phone']) ? $order_info[0]['customer_primary_phone'] : NULL; ?></span><br/>
                                <span><strong>Email : </strong> <?php echo isset($order_info[0]['customer_primary_email']) ? $order_info[0]['customer_primary_email'] : NULL; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-3 col-lg-3">
                        <div class="panel panel-default height">
                            <div class="panel-heading">Payment Information</div>
                            <div class="panel-body">
                                <strong>Payment Mode : </strong> <?php echo isset($order_info[0]['payment_mode_name']) ? $order_info[0]['payment_mode_name'] : NULL; ?><br>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-3 col-lg-3 pull-right">
                        <div class="panel panel-default height">
                            <div class="panel-heading">Shipping Address</div>
                            <div class="panel-body">
                                <strong><?php echo isset($order_info[0]['customer_fullname']) ? $order_info[0]['customer_fullname'] : NULL; ?></strong><br>	                            
                                <span><?php echo isset($order_info[0]['customer_address']) ? $order_info[0]['customer_address'] : NULL; ?></span><br>
                                <span>Phone: <?php echo isset($order_info[0]['customer_phone']) ? $order_info[0]['customer_phone'] : NULL; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="text-center nomargin"><strong>Order summary</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <td><strong>Item Name</strong></td>
                                        <td class="text-center"><strong>Price <i class="fa fa-inr" aria-hidden="true"></i></strong></td>
                                        <td class="text-center"><strong>Tax <i class="fa fa-inr" aria-hidden="true"></i></strong></td>
                                        <td class="text-right"><strong>Total <i class="fa fa-inr" aria-hidden="true"></i></strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo isset($order_info[0]['service_name']) ? $order_info[0]['service_name'] : NULL; ?> <span>(<?php echo isset($order_info[0]['plan_name']) ? $order_info[0]['plan_name'] : NULL; ?>)</span></td>
                                        <td class="text-center"><?php echo isset($order_info[0]['basic']) ? number_format($order_info[0]['basic'], 2) : NULL; ?></td>
                                        <td class="text-center"><?php echo isset($order_info[0]['tax']) ? number_format($order_info[0]['tax'], 2) : NULL; ?></td>
                                        <td class="text-right"><?php echo isset($order_info[0]['final']) ? number_format($order_info[0]['final'], 2) : NULL; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="highrow text-right"><strong>Total</strong></td>
                                        <td class="highrow text-center"><?php echo isset($order_info[0]['basic']) ? number_format($order_info[0]['basic'], 2) : NULL; ?></td>
                                        <td class="highrow text-center"><?php echo isset($order_info[0]['tax']) ? number_format($order_info[0]['tax'], 2) : NULL; ?></td>
                                        <td class="highrow text-right"><?php echo isset($order_info[0]['final']) ? number_format($order_info[0]['final'], 2) : NULL; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="emptyrow"></td>
                                        <td class="emptyrow"></td>
                                        <td class="emptyrow text-center"><strong>Shipping</strong></td>
                                        <td class="emptyrow text-right">0.00</td>
                                    </tr>
                                    <tr>
                                        <td class="highrow"></td>
                                        <td class="highrow"></td>
                                        <td class="highrow text-center"><strong>Grand Total</strong></td>
                                        <td class="highrow text-right"><?php echo isset($order_info[0]['final']) ? number_format($order_info[0]['final'], 2) : NULL; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .height {
        min-height: 200px;
    }

    .table > tbody > tr > .emptyrow {
        border-top: none;
    }

    .table > thead > tr > .emptyrow {
        border-bottom: none;
    }

    .table > tbody > tr > .highrow {
        border-top: 3px solid;
    }
</style>

<script type="text/javascript">
    function printInvoice() {
        window.print();
    }
    
</script>

