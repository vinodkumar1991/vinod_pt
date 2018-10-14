<div class="tab-content">
    <ul class="nav nav-tabs">
        <?php
        if (2 == Yii::app()->session['role_id']) {
            ?>
            <li class = "active"><a href = "<?php echo Yii::app()->params['webURL'] . 'Reports/Orders/Orders/SelfDriveOrders/' ?>">Self Drive Agent</a></li>
            <?php
        } else {
            ?>
            <li><a href="<?php echo Yii::app()->params['webURL'] . 'Reports/Orders/Orders/Orders' ?>">Book A Service</a></li>
            <li class="active"><a href="<?php echo Yii::app()->params['webURL'] . 'Reports/Orders/Orders/SelfDriveOrders/' ?>">Self Drive Agent</a></li>                                           
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
                <th>Order Number</th>
                <th>Basic</th>
                <th>Pickup Charge</th>
                <th>DoorStep Charge</th>
                <th>Tax</th>
                <th>Security Deposit</th>
                <th>Final</th>
                <th>Vehicle Type</th>                 
                <th>Brand</th>
                <th>Model</th>                                     
                <th>Customer Name</th>
                <th>Email Id</th>
                <th>Mobile No</th>
                <th>Drive Start Date & Time</th>
                <th>Drive End Date & Time</th>
                <th>Booked Location</th>
                <th>Pickup Location</th>
                <th>Drop Location</th>
                <th>Action</th>
            </tr>
        </thead>   
        <tbody>
            <?php
            if (isset($orders) && !empty($orders)) {
                $i = 1;
                foreach ($orders as $row) {
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo isset($row['order_number']) ? $row['order_number'] : NULL; ?></td>
                        <td><?php echo isset($row['basic_amount']) ? $row['basic_amount'] : NULL; ?></td>
                        <td><?php echo isset($row['order_pickup_amount']) ? $row['order_pickup_amount'] : NULL; ?></td>
                        <td><?php echo isset($row['order_door_step_amount']) ? $row['order_door_step_amount'] : NULL; ?></td>
                        <td><?php echo isset($row['tax_amount']) ? $row['tax_amount'] : NULL; ?></td>
                        <td><?php echo isset($row['security_deposit']) ? $row['security_deposit'] : NULL; ?></td>
                        <td><?php echo isset($row['final_amount']) ? $row['final_amount'] : NULL; ?></td>
                        <td><?php echo isset($row['vehicle_name']) ? $row['vehicle_name'] : NULL; ?></td>                    
                        <td><?php echo isset($row['vehicle_brand_name']) ? $row['vehicle_brand_name'] : NULL; ?></td>
                        <td><?php echo isset($row['vehicle_brand_model_name']) ? $row['vehicle_brand_model_name'] : NULL; ?></td>                   
                        <td><?php echo isset($row['customer_name']) ? $row['customer_name'] : NULL; ?></td>
                        <td><?php echo isset($row['order_email']) ? $row['order_email'] : NULL; ?></td>
                        <td><?php echo isset($row['order_phone']) ? $row['order_phone'] : NULL; ?></td>

                        <td><?php
                            $strDriveStartDate = isset($row['start_date']) ? $row['start_date'] : NULL;
                            $strDriveStartTime = isset($row['start_time']) ? $row['start_time'] : NULL;
                            $strDriveEndDate = isset($row['end_date']) ? $row['end_date'] : NULL;
                            $strDriveEndTime = isset($row['end_time']) ? $row['end_time'] : NULL;

                            echo $strDriveStartDate . ' ' . $strDriveStartTime;
                            ?></td>
                        <td><?php echo $strDriveEndDate . ' ' . $strDriveEndTime; ?></td>
                        <td><?php echo isset($row['order_location']) ? $row['order_location'] : NULL; ?></td>
                        <td><?php echo isset($row['order_pickup_location']) ? $row['order_pickup_location'] : NULL; ?></td>
                        <td><?php echo isset($row['order_drop_location']) ? $row['order_drop_location'] : NULL; ?></td>
                        <td>
                            <a class="view-u" title="View Invoice" style="cursor:pointer" href="<?php echo Yii::app()->params['webURL'] . 'Invoice/Invoice/Invoice?OrdNo=' . $row['order_number'] ?>">
                                <i aria-hidden="true" class="fa fa-eye"></i>
                            </a> 
                        </td>
                    </tr>
                    <?php
                    $i++;
                }
                unset($orders);
            }
            ?>

        </tbody>
    </table>
</div>