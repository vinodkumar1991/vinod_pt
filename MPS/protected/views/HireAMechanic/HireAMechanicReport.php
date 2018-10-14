<div class="card-body">
    <!--Menu :: START-->
    <ul class="nav nav-tabs" role="tablist">
        <li>
            <a href="<?php echo Yii::app()->params['webURL'] . 'SelfDrive/Agent/Create1'; ?>">Create</a>
        </li>
        <li class="active">
            <a href="<?php echo Yii::app()->params['webURL'] . 'SelfDrive/Agent/HireReport'; ?>">Report</a>
        </li>
    </ul>
    <!--Menu :: END-->
    <div class="table-responsive">
        <table class="datatable table table-striped" cellspacing="0" width="100%" id="example">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Vehicle Type</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Permanent Address</th>
                    <th>Present Address</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($hires)) {
                    $i = 0;
                    foreach ($hires as $arrHire) {
                        $i++;
                        ?>
                        <tr data-toggle="modal" data-id="1">
                            <td align="center">
                                <?php echo $i; ?>
                            </td>
                            <td align="center">
                                <?php
                                echo isset($arrHire['first_name']) ? $arrHire['first_name'] : NULL;
                                ?>
                            </td>       
                            <td align="center">
                                <?php
                                echo isset($arrHire['vehicle_name']) ? $arrHire['vehicle_name'] : NULL;
                                ?>
                            </td>       

                            <td align="center">
                                <?php
                                echo isset($arrHire['hire_email']) ? $arrHire['hire_email'] : NULL;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                echo isset($arrHire['hire_phone']) ? $arrHire['hire_phone'] : NULL;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                echo isset($arrHire['permenant_address']) ? $arrHire['permenant_address'] : NULL;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                echo isset($arrHire['present_address']) ? $arrHire['present_address'] : NULL;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                echo isset($arrHire['hire_status']) ? $arrHire['hire_status'] : NULL;
                                ?>
                            </td>
                            <td align="center" class="btn-wdth-90">
                                <a href="<?php echo Yii::app()->params['webURL'] . '/SelfDrive/Agent/AddExperience/id/' . $arrHire['hire_id'] . '/vehicle_type/' . $arrHire['vehicle_id']; ?>" class="btn btn-primary">Add Experience</a><br>
                                <a href="<?php echo Yii::app()->params['webURL'] . '/SelfDrive/Agent/EditHire/id/' . $arrHire['hire_id']; ?>" class="btn btn-primary">Edit</a><br>
                            </td>
                        </tr>
                        <?php
                    }
                    unset($hires);
                    unset($i);
                }
                ?>
            </tbody>
        </table>
    </div>
</div>