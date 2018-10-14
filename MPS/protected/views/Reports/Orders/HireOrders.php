<div class="tab-content">
    <ul class="nav nav-tabs">
        <li><a href="<?php echo Yii::app()->params['webURL'] . 'Reports/Orders/Orders/Orders' ?>">Book A Service</a></li>
        <li><a href="<?php echo Yii::app()->params['webURL'] . 'Reports/Orders/Orders/SelfDriveOrders/' ?>">Self Drive Agent</a></li>                                           
        <li class="active"><a href="<?php echo Yii::app()->params['webURL'] . 'Reports/Orders/Orders/HireOrders/' ?>">Hire A Mechanic</a></li>
        <li><a href="<?php echo Yii::app()->params['webURL'] . 'Reports/Orders/Orders/ModificationOrders/' ?>">Modification Shops</a></li>
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
                <th>Booked Location(Customer)</th>
                <th>Hr Price Of Mechanic</th>
                <th>Customer Name</th>
                <th>Email Id</th>
                <th>Mobile No</th>
                <th>Hire A Mechanic</th>
                <th>Email Id</th>
                <th>Mobile No</th>
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
                        <td><?php echo isset($row['location']) ? $row['location'] : NULL; ?></td>
                        <td><?php echo isset($row['order_hr_price']) ? $row['order_hr_price'] : NULL; ?></td>
                        <td><?php echo isset($row['first_name']) ? $row['first_name'] : NULL; ?></td>
                        <td><?php echo isset($row['email']) ? $row['email'] : NULL; ?></td>
                        <td><?php echo isset($row['phone']) ? $row['phone'] : NULL; ?></td>
                        <td><?php echo isset($row['hire_name']) ? $row['hire_name'] : NULL; ?></td>
                        <td><?php echo isset($row['hire_phone']) ? $row['hire_phone'] : NULL; ?></td>
                        <td><?php echo isset($row['hire_email']) ? $row['hire_email'] : NULL; ?></td>
                        <td><?php echo isset($row['hire_email']) ? $row['hire_email'] : NULL; ?></td>
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