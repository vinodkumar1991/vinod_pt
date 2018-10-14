<div class="container">
    <div class="invoice-page-wraper">
        <div class="row invoice-outline">
            <div class="col-xs-12">
                <!-- Logo & Mechanic Shop Address -->
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
               <!-- End--->
                <hr>
                <!-- Invoice Billing Info-->
                <table class="table table-condensed" width="100%" align="left" cellspacing="4" cellpadding="4">
                    <tr>
                        <td valign="top" style="width:25%;">
                            <h4>Order Preferences</h4><br/>
                                <strong>Booking ID: </strong><?php echo isset($order_info[0]['order_number']) ? $order_info[0]['order_number'] : NULL; ?><br>
                                <strong>Order Date:</strong> <?php echo isset($order_info[0]['order_booked_date']) ? $order_info[0]['order_booked_date'] : NULL; ?><br>
                                <strong>Brand :</strong> <?php echo isset($order_info[0]['brand_name']) ? $order_info[0]['brand_name'] : NULL; ?><br>
                                <strong>Model :</strong> <?php echo isset($order_info[0]['model_name']) ? $order_info[0]['model_name'] : NULL; ?><br>
                                <strong>Vehicle Type :</strong> <?php echo isset($order_info[0]['vehicle_type']) ? $order_info[0]['vehicle_type'] : NULL; ?><br>
                                <strong>Vehicle Variant :</strong> <?php echo isset($order_info[0]['vehicle_variant']) ? $order_info[0]['vehicle_variant'] : NULL; ?><br>
                                <strong>Invoice Date:</strong> <?php echo isset($order_info[0]['invoice_date']) ? $order_info[0]['invoice_date'] : '-'; ?><br>
                        </td>                        
                        <td valign="top" style="width:25%;">
                            <h4>Billing Details</h4><br/>
                                <strong>Name : <?php echo isset($order_info[0]['customer_primary_fullname']) ? $order_info[0]['customer_primary_fullname'] : NULL; ?></strong><br>	                            
                                <span><strong>Address: </strong><?php echo isset($order_info[0]['customer_address']) ? $order_info[0]['customer_address'] : NULL; ?></span><br>
                                <span><strong>Phone : </strong> <?php echo isset($order_info[0]['customer_primary_phone']) ? $order_info[0]['customer_primary_phone'] : NULL; ?></span><br/>
                                <span><strong>Email : </strong> <?php echo isset($order_info[0]['customer_primary_email']) ? $order_info[0]['customer_primary_email'] : NULL; ?></span>
                        </td>
                        <td valign="top" style="width:25%;">
                            <h4>Payment Information</h4><br/>
                            <strong>Payment Mode : </strong> <?php echo isset($order_info[0]['payment_mode_name']) ? $order_info[0]['payment_mode_name'] : NULL; ?><br>
                        </td>
                        <td valign="top" style="width:25%;">
                            <h4>Shipping Address</h4><br/>
                                <span><strong>Name : </strong> <?php echo isset($order_info[0]['customer_fullname']) ? $order_info[0]['customer_fullname'] : NULL; ?></span><br>	                            
                                <span><strong>Address: </strong> <?php echo isset($order_info[0]['customer_address']) ? $order_info[0]['customer_address'] : NULL; ?></span><br>
                                <span><strong>Phone: </strong><?php echo isset($order_info[0]['customer_phone']) ? $order_info[0]['customer_phone'] : NULL; ?></span>
                        </td>
                    </tr>
                </table>
                <!-- End --->
            </div>
            <!-- Order Summary --->
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="text-center nomargin"><strong>Order summary</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed" width="100%" cellspacing="4" cellpadding="4" align="center" style="border-collapse:collapse;">
                                <thead>
                                    <tr>
                                        <td style="border:1px solid #353d47;"><strong>Item Name</strong></td>
                                        <td style="border:1px solid #353d47;" class="text-center"><strong>Price <i class="fa fa-inr" aria-hidden="true"></i></strong></td>
                                        <td style="border:1px solid #353d47;" class="text-center"><strong>Tax <i class="fa fa-inr" aria-hidden="true"></i></strong></td>
                                        <td style="border:1px solid #353d47;" class="text-right"><strong>Total <i class="fa fa-inr" aria-hidden="true"></i></strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="border:1px solid #353d47;"><?php echo isset($order_info[0]['service_name']) ? $order_info[0]['service_name'] : NULL; ?> <span>(<?php echo isset($order_info[0]['plan_name']) ? $order_info[0]['plan_name'] : NULL; ?>)</span></td>
                                        <td style="border:1px solid #353d47;" class="text-center"><?php echo isset($order_info[0]['basic']) ? number_format($order_info[0]['basic'], 2) : NULL; ?></td>
                                        <td style="border:1px solid #353d47;" class="text-center"><?php echo isset($order_info[0]['tax']) ? number_format($order_info[0]['tax'], 2) : NULL; ?></td>
                                        <td style="border:1px solid #353d47;" class="text-right"><?php echo isset($order_info[0]['final']) ? number_format($order_info[0]['final'], 2) : NULL; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="border:1px solid #353d47;" class="highrow text-right"><strong>Total</strong></td>
                                        <td style="border:1px solid #353d47;" class="highrow text-center"><?php echo isset($order_info[0]['basic']) ? number_format($order_info[0]['basic'], 2) : NULL; ?></td>
                                        <td style="border:1px solid #353d47;" class="highrow text-center"><?php echo isset($order_info[0]['tax']) ? number_format($order_info[0]['tax'], 2) : NULL; ?></td>
                                        <td style="border:1px solid #353d47;" class="highrow text-right"><?php echo isset($order_info[0]['final']) ? number_format($order_info[0]['final'], 2) : NULL; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="border:1px solid #353d47;" class="emptyrow"></td>
                                        <td style="border:1px solid #353d47;" class="emptyrow"></td>
                                        <td style="border:1px solid #353d47;" class="emptyrow text-center"><strong>Shipping</strong></td>
                                        <td style="border:1px solid #353d47;" class="emptyrow text-right">0.00</td>
                                    </tr>
                                    <tr>
                                        <td style="border:1px solid #353d47;" class="highrow"></td>
                                        <td style="border:1px solid #353d47;" class="highrow"></td>
                                        <td style="border:1px solid #353d47;" class="highrow text-center"><strong>Grand Total</strong></td>
                                        <td style="border:1px solid #353d47;" class="highrow text-right"><?php echo isset($order_info[0]['final']) ? number_format($order_info[0]['final'], 2) : NULL; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End -->
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
    body {
    color: #333;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 12px;
    line-height: 1.42857;
}
body h4{
    font-style: italic;
}
</style>

<script type="text/javascript">
    function printInvoice() {
        window.print();
    }
    
</script>

