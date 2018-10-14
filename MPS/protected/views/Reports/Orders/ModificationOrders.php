<div class="tab-content">
    <ul class="nav nav-tabs">
        <li><a href="<?php echo Yii::app()->params['webURL'] . 'Reports/Orders/Orders/Orders/' ?>">Book A Service</a></li>
        <li><a href="<?php echo Yii::app()->params['webURL'] . 'Reports/Orders/Orders/SelfDriveOrders/' ?>">Self Drive Agent</a></li>                                           
        <li><a href="<?php echo Yii::app()->params['webURL'] . 'Reports/Orders/Orders/HireOrders/' ?>">Hire A Mechanic</a></li>
        <li class="active"><a href="javascript:void(0);">Modification Shops</a></li>
    </ul>
</div>
<br/><br/>
<div class="table-responsive"> 
    <button name="sub" id="sub" class="btn btn-warning" type="button" style="float: right;" onclick="fnExcelReport();">Download</button>     
    <table class="datatable table table-striped" cellspacing="0" width="100%" id="example">
        <thead>
            <tr>
                <th>Sl No.</th>
                <th>Order Number</th>
                <th>Vehicle Type</th>                    
                <th>Brand</th> 
                <th>Service Name</th>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Address</th>                    
                <th>Customer Location</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Requested Date</th>
                <th>Shop Name</th>
                <th>Owner Name</th>
                <th>Shop Email</th>
                <th>Shop Mobile</th>   
                <th>Shop Address</th>
                <th>Shop Location</th>                                  
                <th>Status</th>                    
            </tr>
        </thead>   
        <tbody>
            <?php
            if (isset($arrModificationOrders) && !empty($arrModificationOrders)) {
                $i = 1;
                foreach ($arrModificationOrders as $row) {
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo isset($row['order_number']) ? $row['order_number'] : NULL; ?></td>
                        <td><?php echo isset($row['vehicle_type']) ? $row['vehicle_type'] : NULL; ?></td>                    
                        <td><?php echo isset($row['brand_name']) ? $row['brand_name'] : NULL; ?></td>
                        <td><?php echo isset($row['service_name']) ? $row['service_name'] : NULL; ?></td>                   
                        <td><?php echo isset($row['name']) ? $row['name'] : NULL; ?></td>
                        <td><?php echo isset($row['email']) ? $row['email'] : NULL; ?></td>
                        <td><?php echo isset($row['phone']) ? $row['phone'] : NULL; ?></td>
                        <td><?php echo isset($row['address']) ? $row['address'] : NULL; ?></td>
                        <td><?php echo isset($row['customer_location']) ? $row['customer_location'] : NULL; ?></td>
                        <td><?php echo isset($row['latitude']) ? $row['latitude'] : NULL; ?></td>
                        <td><?php echo isset($row['longitude']) ? $row['longitude'] : NULL; ?></td>
                        <td><?php echo isset($row['requested_datetime']) ? $row['requested_datetime'] : NULL; ?></td>
                        <td><?php echo isset($row['shop_name']) ? $row['shop_name'] : NULL; ?></td>
                        <td><?php echo isset($row['owner_name']) ? $row['owner_name'] : NULL; ?></td>                       
                        <td><?php echo isset($row['shop_email']) ? $row['shop_email'] : NULL; ?></td>
                        <td><?php echo isset($row['shop_phone']) ? $row['shop_phone'] : NULL; ?></td>                        
                        <td><?php echo isset($row['shop_adrs']) ? $row['shop_adrs'] : NULL; ?></td>
                        <td><?php echo isset($row['shop_location']) ? $row['shop_location'] : NULL; ?></td>                        
                        <td><?php echo Yii::app()->params['order_staus'][$row['order_status']]; ?></td>

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
</script>
