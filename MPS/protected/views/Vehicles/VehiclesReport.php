<div class="card-body">
    <ul class="nav nav-tabs" role="tablist">
        <li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/Vehicles/Vehicles/vehicle">Add Vehicle</a></li>
        <li class="active"><a href="<?php echo Yii::app()->baseurl; ?>/index.php/Vehicles/Vehicles/vehiclesReport">Vehicle List</a></li>
    </ul>

    <div class="table-responsive">
        <table class="datatable table table-striped" cellspacing="0" width="100%" id="example">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Vehicle</th>
                    <th>Vehicle Category</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($vehicle_mapping)) {
                    $i = 0;
                    foreach ($vehicle_mapping as $arrEleMap) {
                        $i++;
                        ?>
                        <tr data-toggle="modal" data-id="1" data-target="#signup-model">
                            <td align="center">
                                <?php echo $i; ?>
                            </td>
                            <td align="center">
                                <?php
                                echo isset($arrEleMap['vehicle_name']) ? $arrEleMap['vehicle_name'] : NULL;
                                ?>
                            </td>       
                            <td align="center">
                                <?php
                                echo isset($arrEleMap['vehicle_category']) ? $arrEleMap['vehicle_category'] : NULL;
                                ?>
                            </td>       

                            <td align="center">
                                <?php
                                echo isset($arrEleMap['brand_name']) ? $arrEleMap['brand_name'] : NULL;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                echo isset($arrEleMap['model_name']) ? $arrEleMap['model_name'] : NULL;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                echo isset($arrEleMap['vehicle_year']) ? $arrEleMap['vehicle_year'] : NULL;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                $status = 'Active';
                                if (0 == $arrEleMap['status']) {
                                    $status = 'Inactive';
                                }
                                echo $status;
                                ?>
                            </td>
                             <td align="center">
                                    <a href="<?php echo Yii::app()->params['webURL'] . 'Vehicles/Vehicles/EditVehiclesReport/id/' . $arrEleMap['vehicleid']; ?>" class="clickbtn edit-u"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                </td>
                        </tr>
                        <?php
                    }
                    unset($vehicle_mapping);
                    unset($i);
                }
                ?>
            </tbody>
        </table>
    </div>
</div>