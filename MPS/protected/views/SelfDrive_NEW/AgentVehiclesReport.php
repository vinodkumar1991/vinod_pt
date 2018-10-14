<div class="card-body">
    <!--Menu :: START-->
    <ul class="nav nav-tabs" role="tablist">
        <li>
            <a href="<?php echo Yii::app()->params['webURL'] . 'SelfDrive/Agent/AgentVehicle'; ?>">Create</a>
        </li>
        <li class="active">
            <a href="<?php echo Yii::app()->params['webURL'] . 'SelfDrive/Agent/AgentVehiclesReport'; ?>">Report</a>
        </li>
    </ul>
    <!--Menu :: END-->
    <div class="table-responsive">
        <table class="datatable table table-striped" cellspacing="0" width="100%" id="example">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Agent</th>
                    <th>Vehicle Type</th>
                    <th>Vehicle Category</th>
                    <th>Vehicle Variant</th>
                    <th>Vehicle Model</th>
                    <th>Vehicle Brand</th>
                    <th>Vehicle Seating Capacity</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($vehicles_report)) {
                    $i = 0;
                    foreach ($vehicles_report as $arrAgentVehicle) {
                        $i++;
                        ?>
                        <tr data-toggle="modal" data-id="1">
                            <td align="center">
                                <?php echo $i; ?>
                            </td>
                            <td align="center">
                                <?php
                                echo isset($arrAgentVehicle['agent_name']) ? $arrAgentVehicle['agent_name'] : NULL;
                                ?>
                            </td>       
                            <td align="center">
                                <?php
                                echo isset($arrAgentVehicle['vehicle_type']) ? $arrAgentVehicle['vehicle_type'] : NULL;
                                ?>
                            </td>       

                            <td align="center">
                                <?php
                                echo isset($arrAgentVehicle['vehicle_class_name']) ? $arrAgentVehicle['vehicle_class_name'] : NULL;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                echo isset($arrAgentVehicle['vehicle_variant_name']) ? $arrAgentVehicle['vehicle_variant_name'] : NULL;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                echo isset($arrAgentVehicle['vehicle_model_name']) ? $arrAgentVehicle['vehicle_model_name'] : NULL;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                echo isset($arrAgentVehicle['vehicle_brand_name']) ? $arrAgentVehicle['vehicle_brand_name'] : NULL;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                echo isset($arrAgentVehicle['vehicle_seating_capacity']) ? $arrAgentVehicle['vehicle_seating_capacity'] : NULL;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                echo $arrAgentVehicle['agent_vehicle_status'];
                                ?>
                            </td>
                            <td align="center" class="btn-wdth-90">
                                <a href="<?php echo Yii::app()->params['webURL'] . '/SelfDrive/Agent/WeekEndORDays/type/1/id/' . $arrAgentVehicle['self_vehicle_id']; ?>" class="btn btn-primary">Week End</a><br>
                                <a href="<?php echo Yii::app()->params['webURL'] . '/SelfDrive/Agent/WeekEndORDays/type/2/id/' . $arrAgentVehicle['self_vehicle_id']; ?>" class="btn btn-primary">Week Days</a><br>
                                <a href="<?php echo Yii::app()->params['webURL'] . '/SelfDrive/Agent/VehicleTimings/id/' . $arrAgentVehicle['self_vehicle_id']; ?>" class="btn btn-primary">Add Timing</a>
                                <a href="<?php echo Yii::app()->params['webURL'] . '/SelfDrive/Agent/EditAgentVehicle/id/' . $arrAgentVehicle['self_vehicle_id']; ?>" class="btn btn-primary">Edit</a>
                            </td>
                        </tr>
                        <?php
                    }
                    unset($vehicles_report);
                    unset($i);
                }
                ?>
            </tbody>
        </table>
    </div>
</div>