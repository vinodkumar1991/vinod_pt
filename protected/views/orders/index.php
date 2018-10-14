<section class="orders-main page-section breadcrumbs">
    <div class="container">
    <div class="col-md-12 text-right">
        <div class="page-header">
            <h1>List of Orders</h1>
        </div>
        <ul class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Pages</a></li>
            <li class="active">List of Orders</li>
        </ul>
    </div>
    </div>
</section>
<section class="page-section with-sidebar sub-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
			<?php if(empty($final)&&empty($data)&&empty($hiredate)) { ?>
		      <h4 style="color:red;text-align:center;">No Orders available</h4>
			<? } ?>
			<?php foreach($final as $sdata) { ?>
			
			   <div class="orders-list-bg">
                <div class="col-md-8">
                    <table class="table borderless">
                        <tr>
                            <td width="50%">Order / Booking Id</td>
                            <td width="50%"><strong><?php echo $sdata['bookid']; ?></strong></td>
                        </tr>
                        <tr>
                            <td>Vehicle Type</td>
                            <td><?php echo $sdata['vehicle_type']; ?></td>
                        </tr>
                        <tr>
                            <td>Type of Service</td>
                            <td><?php echo $sdata['service_name']; ?></td>
                        </tr>
						<?php if(!empty($sdata['plan_name'])) {
							 ?>
                        <tr>
                            <td>Package </td>
                            <td><?php echo $sdata['plan_name']; ?></td>
                        </tr>
						<?php } ?>
						 <tr>
                            <td>Booking Date / Time</td>
                            <td><?php echo date("d-m-Y H:i",strtotime($sdata['timestamp'])); ?></td>
                        </tr>
                        <tr>
                            <td>Payment Type</td>
                            <td>Credit Card</td>
                        </tr>						
                        <tr>
                            <td>Total Amount</td>
                            <td>Rs. <?php echo $sdata['amout']; ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4">
                    <div class="order-btn">
                        <a href="" class="btn btn-theme btn-theme-dark">
                            <i class="fa fa-file-text" aria-hidden="true"></i> Track Vehicle</a><br>
                        <a href="" class="btn btn-theme btn-theme-dark">
                            <i class="fa fa-file-text" aria-hidden="true"></i> View Invoice</a><br>
                        <a href="" class="btn btn-theme btn-theme-dark cancel">
                            <i class="fa fa-ban" aria-hidden="true"></i> Cancel Order</a>
                    </div>
                    <div class="col-md-12 text-right">
                        <div class="suc-txt"><i class="fa fa-check" aria-hidden="true"></i> Success</div><br>
                        <div class="prog-txt"><i class="fa fa-refresh" aria-hidden="true"></i> In Progress</div>
                    </div>
                </div>
                </div>
			
			<?php } ?>
			
			<?php foreach($data as $sdata) { ?> 
                <div class="orders-list-bg">
                <div class="col-md-8">
                    <table class="table borderless">
                        <tr>
                            <td width="50%">Order / Booking Id</td>
                            <td width="50%"><strong><?php echo $sdata['book_id']; ?></strong></td>
                        </tr>
                        <tr>
                            <td>Vehicle Type</td>
                            <td><?php echo $sdata['vehicle_type']; ?></td>
                        </tr>
                        <tr>
                            <td>Start Date / Time</td>
                            <td><?php echo $sdata['fromdate']; ?></td>
                        </tr>
                        <tr>
                            <td>End Date / Time</td>
                            <td><?php echo $sdata['todate']; ?></td>
                        </tr>
						 <tr>
                            <td>Booking Date / Time</td>
                            <td><?php echo date("d-m-Y H:i",strtotime($sdata['created_date'])); ?></td>
                        </tr>
						<tr>
                            <td>Security Deposit</td>
                            <td>Rs. <?php echo $sdata['security_deposit']; ?></td>
                        </tr>
                        <tr>
                            <td>Payment Type</td>
                            <td>Credit Card</td>
                        </tr>
                        <tr>
                            <td>Total Amount</td>
                            <td>Rs. <?php echo $sdata['amount']; ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4">
                    <div class="order-btn">                   
                        <a href="" class="btn btn-theme btn-theme-dark">
                            <i class="fa fa-file-text" aria-hidden="true"></i> View Invoice</a><br>
                        <a href="" class="btn btn-theme btn-theme-dark cancel">
                            <i class="fa fa-ban" aria-hidden="true"></i> Cancel Order</a>
                    </div>
                    <div class="col-md-12 text-right">
                        <div class="suc-txt"><i class="fa fa-check" aria-hidden="true"></i> Success</div><br>
                        <div class="prog-txt"><i class="fa fa-refresh" aria-hidden="true"></i> In Progress</div>
                    </div>
                </div>
                </div>
				
				
				
			<?php } ?>
			
			<?php foreach($hiredate as $sdata)		{ ?>
			        <div class="orders-list-bg">
                <div class="col-md-8">
                    <table class="table borderless">
                        <tr>
                            <td width="50%">Order / Booking Id</td>
                            <td width="50%"><strong><?php echo $sdata['book_id']; ?></strong></td>
                        </tr>
                        <tr>
                            <td>Vehicle Type</td>
                            <td><?php echo $sdata['vehicle_type']; ?></td>
                        </tr>
                        <tr>
                            <td>Mechanic Name</td>
                            <td><?php echo $sdata['name']; ?></td>
                        </tr>
                        <tr>
                            <td>Location</td>
                            <td><?php echo $sdata['location']; ?></td>
                        </tr>
						 <tr>
                            <td>Booking Date / Time</td>
                            <td><?php echo date("d-m-Y H:i",strtotime($sdata['created_date'])); ?></td>
                        </tr>
						<tr>
                            <td>Payment Type</td>
                            <td>Credit Card</td>
                        </tr>
                        <tr>
                            <td>Total Amount</td>
                            <td>Rs. <?php echo $sdata['amount']; ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4">
                    <div class="col-md-12 order-btn">                    
                        <a href="" class="btn btn-theme btn-theme-dark">
                            <i class="fa fa-file-text" aria-hidden="true"></i> View Invoice</a><br>
                        <a href="" class="btn btn-theme btn-theme-dark cancel">
                            <i class="fa fa-ban" aria-hidden="true"></i> Cancel Order</a>
                    </div>
                    <div class="col-md-12 text-right">
                        <div class="suc-txt"><i class="fa fa-check" aria-hidden="true"></i> Success</div><br>
                        <div class="prog-txt"><i class="fa fa-refresh" aria-hidden="true"></i> In Progress</div>
                    </div>
                </div>
                </div>
			<?php } ?>
			
            </div>
        </div>
    </div>
</section>

<?php 

?>

<?php 

?>