<?php //echo'<pre>';print_r($arrShops);exit;?>
<div class="tab-content">
    <ul class="nav nav-tabs" role="tablist">
        <li><a href="<?php echo Yii::app()->params['webURL'].'Modifications/ModificationShop/CreateModificationShop'?>">Create Modification Shop</a></li>
        <li class="active"><a href="javascript:void(0);">Modification Shops Report</a></li>
    </ul>
</div>
<br/><br/>
    <div class="table-responsive">         
        <table class="datatable table table-striped" cellspacing="0" width="100%" id="example">
            <thead>
                <tr>
                    <th>Sl No.</th>
                    <th>Code</th>
                    <th>Vehicle Type</th>                    
                    <th>Brand</th>                    
                    <th>Service Name</th> 
                    <th>Shop Name</th>
                    <th>Owner Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Address</th>                                      
                    <th>Location</th>
                    <th>Latitude</th>
                    <th>Longitude</th> 
                    <th>Status</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($arrShops) && !empty($arrShops)){
                    $i=1;foreach($arrShops as $row){?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo isset($row['shop_id']) ? $row['shop_id'] : NULL;?></td>
                        <td><?php echo isset($row['vehicle_type']) ? $row['vehicle_type'] : NULL;?></td>
                        <td><?php echo isset($row['vehicle_name']) ? $row['vehicle_name'] : NULL;?></td>
                        <td><?php echo isset($row['service_name'])? $row['service_name'] : NULL; ?></td>
                        <td><?php echo isset($row['shop_name']) ? $row['shop_name'] : NULL;?></td>
                        <td><?php echo isset($row['owner_name']) ? $row['owner_name'] : NULL;?></td>
                        <td><?php echo isset($row['email']) ? $row['email'] : NULL;?></td>
                        <td><?php echo isset($row['phone']) ? $row['phone'] : NULL;?></td>
                        <td><?php echo isset($row['shop_address']) ? $row['shop_address'] : NULL;?></td>
                        <td><?php echo isset($row['shop_location']) ? $row['shop_location'] : NULL;?></td>
                        <td><?php echo isset($row['latitude']) ? $row['latitude'] : NULL;?></td>
                        <td><?php echo isset($row['longitude']) ? $row['longitude'] : NULL;?></td>
                        <td><?php echo isset($row['shop_status']) ? $row['shop_status'] : NULL;?></td> 
                    </tr>
                    <?php $i++;}}?>
            </tbody>
        </table>
    </div> 