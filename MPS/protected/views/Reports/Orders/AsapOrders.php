<div class="tab-content">
	<ul class="nav nav-tabs">
        <?php
        if (2 == Yii::app()->session['role_id']) {
            ?>
            <li class="active"><a href="">Book A Service</a></li>        
            <?php
        } else {
            ?>
            <li class="active"><a
			href="<?php echo Yii::app()->params['webURL'] . 'Reports/Orders/Orders/Orders' ?>">Book
				A Service</a></li>
		<li><a
			href="<?php echo Yii::app()->params['webURL'] . 'Reports/Orders/Orders/SelfDriveOrders/' ?>">Self
				Drive Agent</a></li>
		<li><a
			href="<?php echo Yii::app()->params['webURL'] . 'Reports/Orders/Orders/HireOrders/' ?>">Hire
				A Mechanic</a></li>
		<li><a
			href="<?php echo Yii::app()->params['webURL'] . 'Reports/Orders/Orders/ModificationOrders/' ?>">Modification
				Shops</a></li>
		<li><a
			href="<?php echo Yii::app()->params['webURL'] . 'Reports/Orders/Orders/AsapOrders/' ?>">Quick
				Bookings</a></li>
            <?php
        }
        ?>
    </ul>
</div>
<br />
<br />
<div class="table-responsive">
	<button name="sub" id="sub" class="btn btn-warning" type="button"
		style="float: right;" onclick="fnExcelReport();">Download</button>
	<table class="datatable table table-striped" cellspacing="0"
		width="100%" id="example">
		<thead>
			<tr>
				<th>Sl No.</th>
				<th>OrderId</th>
				<th>Customer Booked Date</th>
				<th>Order Status</th>
				<th>Customer Name</th>
				<th>Customer Mobile</th>
				<th>Brand</th>
				<th>Model</th>
				<th>Vehicle Service Type</th>
				<th>Labour Amount</th>
				<th>Booked Date</th>
				<th>Start Slot</th>
				<th>End Slot</th>
				<th>Vehicle Manfacture Year</th>
				<th>Fuel Type</th>
				<th>Customer Area</th>
			</tr>
		</thead>
		<tbody>
            <?php
            if (isset($arrOrders) && ! empty($arrOrders)) {
                $i = 1;
                foreach ($arrOrders as $row) {
                    ?>
                    <tr>
				<td><?php echo $i; ?></td>
				<td><?php echo isset($row['order_number']) ? $row['order_number'] : NULL; ?></td>
				<td><?php echo isset($row['customer_booked_date_time']) ? $row['customer_booked_date_time'] : NULL; ?></td>
				<td><?php echo isset($row['order_status']) ? $row['order_status'] : NULL; ?></td>
				<td><?php echo isset($row['customer_name']) ? $row['customer_name'] : NULL; ?></td>
				<td><?php echo isset($row['customer_phone']) ? $row['customer_phone'] : NULL; ?></td>
				<td><?php echo isset($row['brand_name']) ? $row['brand_name'] : NULL; ?></td>
				<td><?php echo isset($row['brand_model_name']) ? $row['brand_model_name'] : NULL; ?></td>
				<td><?php echo isset($row['vehicle_service_type']) ? $row['vehicle_service_type'] : NULL; ?></td>
				<td><?php echo isset($row['labour_amount']) ? $row['labour_amount'] : NULL; ?></td>
				<td><?php echo isset($row['order_booked_date']) ? $row['order_booked_date'] : NULL; ?></td>
				<td><?php echo isset($row['order_start_time']) ? $row['order_start_time'] : NULL; ?></td>
				<td><?php echo isset($row['order_end_time']) ? $row['order_end_time'] : NULL; ?></td>
				<td><?php echo isset($row['year_of_manfacture']) ? $row['year_of_manfacture'] : NULL; ?></td>
				<td><?php echo isset($row['fuel_type']) ? $row['fuel_type'] : NULL; ?></td>
				<td><?php echo isset($row['customer_area']) ? $row['customer_area'] : NULL; ?></td>
			</tr>
                    <?php
                    $i ++;
                }
                unset($arrOrders);
            }
            ?>

        </tbody>
	</table>
</div>

<!-- <script type="text/javascript" src="//code.jquery.com/jquery-1.12.3.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>	
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel'
            ]
        });
    });
</script>-->
<script>
    function fnExcelReport()
    {
        var tab_text = "<table border='2px'><tr bgcolor='#87AFC6'>";
        var textRange;
        var j = 0;
        tab = document.getElementById('example'); // id of table

        for (j = 0; j < tab.rows.length; j++)
        {
            tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
            //tab_text=tab_text+"</tr>";
        }

        tab_text = tab_text + "</table>";
        tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
        tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
        tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE ");

        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
        {
            txtArea1.document.open("txt/html", "replace");
            txtArea1.document.write(tab_text);
            txtArea1.document.close();
            txtArea1.focus();
            sa = txtArea1.document.execCommand("SaveAs", true, "Say Thanks to Sumit.xls");
        } else                 //other browser not tested on IE 11
            sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));

        return (sa);
    }
    
    function OrderDelay(strOrderNo,intstatus,intPrevOrderstatus,flag){
        var objDelayorderdetails ={};
        objDelayorderdetails = {
            "order_number":strOrderNo,
            "order_status":intstatus,
            "previous_order_status" : intPrevOrderstatus,
            "delayflag" : flag
        }
        $.post('<?php echo Yii::app()->params['webURL'] . 'Reports/Orders/Orders/DelayOrders' ?>',objDelayorderdetails , function(response){
             location.reload(true);
         });
    }
</script>
