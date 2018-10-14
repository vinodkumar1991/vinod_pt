<div class="card-body">
    <ul class="nav nav-tabs" role="tablist">
        <li>
            <a href="<?php echo Yii::app()->params['webURL'] . 'SelfDrive/Agent/VehicleFeatureForm'; ?>">Create</a>
        </li>
        <li class="active">
            <a href="<?php echo Yii::app()->params['webURL'] . 'SelfDrive/Agent/VehicleFeatureReport'; ?>"> Vehicle Feature Reports</a>
        </li>
    </ul>
    <div class="table-responsive">
        <table class="datatable table table-striped" cellspacing="0" width="100%" id="example">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Vehicle Type</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Edit</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($vehicle_report)) {
                    $i = 0;
                    foreach ($vehicle_report as $arrVehicleFeatures) {
                        $i++;
                        ?>
                        <tr data-toggle="modal" data-id="1">
                            <td align="center">
                                <?php echo $i; ?>
                            </td>
                            <td align="center">
                                <?php
                                echo isset($arrVehicleFeatures['name']) ? $arrVehicleFeatures['name'] : NULL;
                                ?>
                            </td>       

                            <td align="center">
                                <?php
                                echo isset($arrVehicleFeatures['code']) ? $arrVehicleFeatures['code'] : NULL;
                                ?>
                            </td>
                            
                            <td align="center">
                                
                                <?php
                                echo isset($arrVehicleFeatures['vehicle_type_name']) ? $arrVehicleFeatures['vehicle_type_name'] : NULL;
                                ?>
                            </td>


                            <td align="center">
                                <?php
                                echo isset($arrVehicleFeatures['description']) ? $arrVehicleFeatures['description'] : NULL;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                $status = 'Active';
                                if (0 == $arrVehicleFeatures['status']) {
                                    $status = 'Inactive';
                                }
                                echo $status;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                if (isset($arrVehicleFeatures['image_name']) && !empty($arrVehicleFeatures['image_name'])) {
                                    ?>
                                    <img src="<?php echo Yii::app()->params['adminImgURL'] . '/vehicle_features/mobile/24x24/' . $arrVehicleFeatures['image_name']; ?>" width="50px"/>
                                    <?php
                                } else {
                                    echo '-';
                                    ?>
                                    <?php
                                }
                                ?>

                            </td>
                            <td align="center">
                                <a href="<?php echo Yii::app()->params['web_url'] . 'EditVehicleFeature/id/' . $arrVehicleFeatures['id']; ?>">Edit</a>
                            </td>
                        </tr>
                        <?php
                    }
                    unset($vehicle_report);
                    unset($i);
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

