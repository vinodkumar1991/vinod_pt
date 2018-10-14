<div class="tab-content">
    <ul class="nav nav-tabs">
        <?php
        if (2 == Yii::app()->session['role_id']) {
            ?>
            <li class="active"><a href="">Book A Service</a></li>        
            <?php
        } else {
            ?>
            <li class="active"><a href="<?php echo Yii::app()->params['webURL'] . 'Reports/Orders/Orders/Orders' ?>">Book A Service</a></li>
            <li><a href="<?php echo Yii::app()->params['webURL'] . 'Reports/Orders/Orders/SelfDriveOrders/' ?>">Self Drive Agent</a></li>                                           
            <li><a href="<?php echo Yii::app()->params['webURL'] . 'Reports/Orders/Orders/HireOrders/' ?>">Hire A Mechanic</a></li>
            <li><a href="<?php echo Yii::app()->params['webURL'] . 'Reports/Orders/Orders/ModificationOrders/' ?>">Modification Shops</a></li>
            <?php
        }
        ?>
    </ul>
</div>
<br/><br/>
<div class="table-responsive"> 
    <button name="sub" id="sub" class="btn btn-warning" type="button" style="float: right;" onclick="fnExcelReport();">Download</button>     
    <table class="datatable table table-striped" cellspacing="0" width="100%" id="example">
        <thead>
            <tr>
                <th>Sl No.</th>
                <th>OrderId</th>
                <th>Vehicle Type</th>                    
                <th>Brand</th>
                <th>Model</th>                                     
                <th>Customer Name</th>
                <th>Email Id</th>
                <th>Mobile No</th>
                <th>Address</th>
                <th>Service Name</th>
                <th>Plan Name</th>                         
                <th>Amount</th>
                <th>Book Date</th>
                <th>PickUp Date&Time</th>
                <th>Location</th>
                <th>Latitude</th>
                <th>Longitude</th>   
                <th>Status</th>
                <th>Action</th>                    
            </tr>
        </thead>   
        <tbody>
            <?php
            if (isset($arrOrders) && !empty($arrOrders)) {
                $i = 1;
                foreach ($arrOrders as $row) {
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo isset($row['order_number']) ? $row['order_number'] : NULL; ?></td>
                        <td><?php echo isset($row['vehicle_type']) ? $row['vehicle_type'] : NULL; ?></td>                    
                        <td><?php echo isset($row['brand_name']) ? $row['brand_name'] : NULL; ?></td>
                        <td><?php echo isset($row['model_name']) ? $row['model_name'] : NULL; ?></td>                   
                        <td><?php echo isset($row['customer_primary_fullname']) ? $row['customer_primary_fullname'] : NULL; ?></td>
                        <td><?php echo isset($row['customer_primary_email']) ? $row['customer_primary_email'] : NULL; ?></td>
                        <td><?php echo isset($row['customer_primary_phone']) ? $row['customer_primary_phone'] : NULL; ?></td>
                        <td><?php echo isset($row['customer_address']) ? $row['customer_address'] : NULL; ?></td>
                        <td><?php echo isset($row['service_name']) ? $row['service_name'] : NULL; ?></td>
                        <td><?php echo isset($row['plan_name']) ? $row['plan_name'] : NULL; ?></td>
                        <td><?php echo isset($row['amount']) ? $row['amount'] : NULL; ?></td>
                        <td><?php echo isset($row['order_created_date']) ? $row['order_created_date'] : NULL; ?></td>
                        <td><?php echo isset($row['order_booked_date']) ? $row['order_booked_date'] : NULL; ?></td>
                        <td><?php echo isset($row['location']) ? $row['location'] : NULL; ?></td>
                        <td><?php echo isset($row['latitude']) ? $row['latitude'] : NULL; ?></td>
                        <td><?php echo isset($row['longitude']) ? $row['longitude'] : NULL; ?></td>
                        <td><?php echo Yii::app()->params['order_staus'][$row['order_status']]; ?></td>
                        <td>
                            <a class="view-u" title="View Invoice" style="cursor:pointer" href="<?php echo Yii::app()->params['webURL'] . 'Invoice/Invoice/Invoice?OrdNo=' . $row['order_number'] ?>">
                                <i aria-hidden="true" class="fa fa-eye"></i>
                            </a> 
                            <?php if( (!empty($row['order_status'])) && (5 == $row['order_status'] || 13 == $row['order_status']) ) { ?>
                            <button class="btn btn-info" name="order_delay" id="order_delay" value="<?php echo $row['order_number'];?>" onclick="OrderDelay(this.value,<?php echo $row['order_status']; ?>,'',1)">Delay </button>    
                            
                            <?php } ?>
                             <?php if( (!empty($row['order_status'])) && (14 == $row['order_status'])) { ?>
                            <button class="btn btn-primary" name="order_relay" id="order_relay" value="<?php echo $row['order_number'];?>" onclick="OrderDelay(this.value,<?php echo $row['order_status']; ?>,<?php echo $row['previous_order_status']; ?>,0)">Relay </button>    
                            
                            <?php } ?>
                        </td>
                    </tr>
                    <?php
                    $i++;
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
