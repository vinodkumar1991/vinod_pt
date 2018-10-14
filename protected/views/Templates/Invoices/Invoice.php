<div class="container">
    <div class="invoice-page-wraper">
        <div class="row invoice-outline">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-right icons-print-pdf">
                            <!-- <a href="<?php //echo Yii::app()->params['webURL'] . '/Invoices/Invoices/HTML2pdf?' . $order_info['order_number']; ?>" title="Print Invoice"><i class="fa fa-print" aria-hidden="true"></i></a>-->
                            <a href="<?php echo Yii::app()->params['webURL'] . '/Invoices/Invoices/HTML2pdf?' . $order_info['order_number']; ?>" title="Download Invoice"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-md-2 col-xs-12 text-center">
                        <?php
                        $path1=Yii::app()->params['adminImgURL'] . $order_info['shop_image_path']. $order_info['shop_image'];
                        $path2=Yii::app()->params['adminImgURL'] . $order_info['shop_image_path']. 'logo-invoice.png';
                        ?>
                        
                        <img src="<?php echo $path1; ?>" onerror='this.onerror=null;this.src="<?php echo $path2; ?>"'>
                    </div>
                    <div class="col-md-10 col-xs-12">
                        <div class="invoice-vend-dtls">
                         <?php if(!empty($order_info['invoice_number'])) {?>
                            <h4 class="text-right"><span class="dotted-brdr">Invoice for purchase <?php echo isset($order_info['invoice_number']) ? $order_info['invoice_number'] : ''; ?>
                                </span>
                            </h4>
                            <?php } ?>
<!--                            <h4 class="text-right">
                                   <br/>Invoice Date <?php echo isset($order_info['invoice_date']) ? $order_info['invoice_date'] : '#33221'; ?>
                            </h4>-->
                            <h2 class="vend-title-name"><?php echo isset($order_info['shopname']) ? $order_info['shopname'] : 'Not Available'; ?></h2>
                            <strong>Contact us: <?php echo isset($order_info['shopphone']) ? $order_info['shopphone'] : 'Not Available'; ?> || <?php echo isset($order_info['shopemail']) ? $order_info['shopemail'] : 'Not Available'; ?></strong><br>
                            <address>Mechanic Shop Address: <span style="text-transform:uppercase;"><?php echo isset($order_info['shopaddress']) ? $order_info['shopaddress'] : 'Not Available'; ?></span></address>
                        </div>
                    </div>        	
                </div>

                <hr>
                <div class="row">
                    <div class="col-xs-12 col-md-3 col-lg-3">
                        <div class="panel panel-default height">
                            <div class="panel-heading">Order Preferences</div>
                            <div class="panel-body">
                                <strong>Booking ID: </strong><?php echo isset($order_info['order_number']) ? $order_info['order_number'] : NULL; ?><br>
                                <strong>Order Date:</strong> <?php echo isset($order_info['order_booked_date']) ? $order_info['order_booked_date'] : NULL; ?><br>
                                <strong>Brand :</strong> <?php echo isset($order_info['brand_name']) ? $order_info['brand_name'] : NULL; ?><br>
                                <strong>Model :</strong> <?php echo isset($order_info['model_name']) ? $order_info['model_name'] : NULL; ?><br>
                                <strong>Vehicle Type :</strong> <?php echo isset($order_info['vehicle_name']) ? $order_info['vehicle_name'] : NULL; ?><br>
                                <strong>Vehicle Variant :</strong> <?php echo isset($order_info['vehicle_variant']) ? $order_info['vehicle_variant'] : NULL; ?><br>
                                <strong>Invoice Date:</strong> <?php echo isset($order_info['invoice_date']) ? $order_info['invoice_date'] : '-'; ?><br>
                                <strong>Order Status:</strong> <?php echo isset($order_info['order_status_desc']) ? $order_info['order_status_desc'] : '-'; ?><br>
                            
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-3 col-lg-3 pull-left">
                        <div class="panel panel-default height">
                            <div class="panel-heading">Billing Details</div>
                            <div class="panel-body">
                                <span><strong>Name:</strong><?php echo isset($order_info['customer_primary_fullname']) ? $order_info['customer_primary_fullname'] : NULL; ?></span><br>	                            
                                <span><?php echo isset($order_info['customer_primary_address']) ? $order_info['customer_primary_address'] : NULL; ?></span><br>
                                <span><strong>Email:</strong><?php echo isset($order_info['customer_primary_email']) ? $order_info['customer_primary_email'] : NULL; ?></span><br>	                            
                                <span><strong>Phone :</strong> <?php echo isset($order_info['customer_primary_phone']) ? $order_info['customer_primary_phone'] : NULL; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-3 col-lg-3">
                        <div class="panel panel-default height">
                            <div class="panel-heading">Payment Information</div>
                            <div class="panel-body">
                                <strong>Payment Mode : </strong> <?php echo isset($order_info['payment_mode_name']) ? $order_info['payment_mode_name'] : NULL; ?><br>
                            <?php if(!empty($order_info['payment_mode_id']) && 1 == $order_info['payment_mode_id']) {?> 
 <strong>Payment status : </strong> <?php echo isset($order_info['transaction_status']) ? $order_info['transaction_status'] : 'Success'; ?><br>
                            <?php } else if(!empty($order_info['payment_mode_id']) && 4 == $order_info['payment_mode_id']) {?> 
 <strong>Payment status : </strong> <?php echo isset($order_info['transaction_status']) ? $order_info['transaction_status'] : 'In Progress'; ?><br>
 <?php } else {?>    
                                <strong>Payment status : </strong> <?php echo isset($order_info['transaction_status']) ? $order_info['transaction_status'] : NULL; ?><br>
 <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-3 col-lg-3 pull-right">
                        <div class="panel panel-default height">
                            <div class="panel-heading">Shipping Address</div>
                            <div class="panel-body">
                                <strong><?php echo isset($order_info['customer_fullname']) ? $order_info['customer_fullname'] : NULL; ?></strong><br>	                            
                                <span><?php echo isset($order_info['customer_address']) ? $order_info['customer_address'] : NULL; ?></span><br>
                                <span>Phone: <?php echo isset($order_info['customer_phone']) ? $order_info['customer_phone'] : NULL; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(!empty($extra_repairs)) { ?>
                <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="text-center nomargin"><strong>Extra Repairs summary</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <td><strong>Repair Name</strong></td>
                                        <td class="text-center"><strong>Price <i class="fa fa-inr" aria-hidden="true"></i></strong></td>
                                        <td class="text-right"><strong>Total <i class="fa fa-inr" aria-hidden="true"></i></strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                        <?php 
                                        foreach($extra_repairs as $arr){
                                            
                                            //$i=$i+$arr['repair_amount'];
                                            // print_r($arr);
                                             ?> <tr><td><?php echo isset($arr['repair_name']) ? $arr['repair_name'] : NULL; ?> 
                                                      <td class="text-center"><?php echo isset($arr['repair_amount']) ? number_format($arr['repair_amount'], 2) : NULL; ?></td>
                                        <td class="text-right"><?php echo isset($arr['repair_amount']) ? number_format($arr['repair_amount'], 2) : NULL; ?></td>
                                        
                                                 </td></tr>
                                        
                                            
                                        <?php } ?>
                                        
                                   
                                    <tr>
                                        <td class="emptyrow"></td>
                                        
<!--                                        <td class="emptyrow text-center"><strong>Shipping</strong></td>
                                        <td class="emptyrow text-right">0.00</td>-->
                                    </tr>
                                    <tr>
                                        <td class="highrow"></td>
                                       
                                        <td class="highrow text-center"><strong>Grand Total</strong></td>
                                        <td class="highrow text-right"><?php echo isset($order_info["extra_add_ons"]) ? number_format($order_info["extra_add_ons"],2) : 0.00?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
                
          <?php  }?>
            
            
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
                                        <td class="text-center"><strong>Extra Repairs <i class="fa fa-inr" aria-hidden="true"></i></strong>
                                        <td class="text-right"><strong>Total <i class="fa fa-inr" aria-hidden="true"></i></strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php 
                                        $fare=isset($order_info['basic']) ? $order_info['basic'] : NULL;
                                        $extra_repairs=isset($order_info["extra_add_ons"]) ? $order_info["extra_add_ons"] : NULL ;
                                        $basic_amt= $fare - $extra_repairs;
                                        echo isset($order_info['service_name']) ? $order_info['service_name'] : NULL; ?> <span>(<?php echo isset($order_info['plan_name']) ? $order_info['plan_name'] : NULL; ?>)</span></td>
                                        <td class="text-center"><?php echo number_format($basic_amt, 2); ?></td>
                                        <td class="text-center"><?php echo isset($order_info['tax']) ? number_format($order_info['tax'], 2) : NULL; ?></td>
                                        <td class="text-center"><?php echo isset($order_info["extra_add_ons"]) ? number_format($order_info["extra_add_ons"],2) : 0.00 ; ?></td>
                                        <td class="text-right"><?php echo isset($order_info['final']) ? number_format($order_info['final'], 2) : NULL; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="highrow text-right"><strong>Total</strong></td>
                                        <td class="highrow text-center"><?php echo number_format($basic_amt, 2); ?></td>
                                        <td class="highrow text-center"><?php echo isset($order_info['tax']) ? number_format($order_info['tax'], 2) : NULL; ?></td>
                                        <td class="highrow text-center"><?php echo isset($order_info["extra_add_ons"]) ? number_format($order_info["extra_add_ons"],2) : 0.00?></td>
                                        <td class="highrow text-right"><?php echo isset($order_info['final']) ? number_format($order_info['final'], 2) : NULL; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="emptyrow"></td>
                                        <td class="emptyrow"></td>
                                        <td class="emptyrow"></td>
<!--                                        <td class="emptyrow text-center"><strong>Shipping</strong></td>
                                        <td class="emptyrow text-right">0.00</td>-->
                                    </tr>
                                    <tr>
                                        <td class="highrow"></td>
                                        <td class="highrow"></td>
                                        <td class="highrow"></td>
                                        <td class="highrow text-center"><strong>Grand Total</strong></td>
                                        <td class="highrow text-right"><?php echo isset($order_info['final']) ? number_format($order_info['final'], 2) : NULL; ?></td>
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

    .icon {
        font-size: 47px;
        color: #5CB85C;
    }

    .iconbig {
        font-size: 77px;
        color: #5CB85C;
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

