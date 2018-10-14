
<ul class="nav nav-tabs" role="tablist">
    <li class="active">
        <a href="<?php echo Yii::app()->params['webURL'] . 'SelfDrive/Agent/VehicleFeatureForm'; ?>">Create</a>
    </li>
    <li>
        <a href="<?php echo Yii::app()->params['webURL'] . 'SelfDrive/Agent/VehicleFeatureReport'; ?>">Vehicle Feature Report</a>
    </li>
</ul>
<!--Operation Message :: START-->
<?php if (Yii::app()->user->hasFlash('success')) { ?>
    <div class="throw_success">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php } else if (Yii::app()->user->hasFlash('failure')) { ?>
    <div class="throw_warning">
        <?php echo Yii::app()->user->getFlash('failure'); ?>
    </div>
    <?php
}
?>
<form class="form-horizontal lcns" method='post' name='vehicle_feature_form' id='vehicle_feature_form' enctype="multipart/form-data">


    <!--Vehicle Type :: START-->
    <div class="form-group">
        <label  class="col-sm-2 control-label">Vehicle Type</label> 
        <div class="col-sm-10">
            <?php
            $intVehicleType = isset($vehicle_details['vehicle_type_id']) ? $vehicle_details['vehicle_type_id'] : NULL;
            ?>
            <select name='vehicle_id' id='vehicle_id'>
                <option value="" >--Vehicle Types--</option>
                <?php
                if (!empty($vehicle_types)) {
                    foreach ($vehicle_types as $arrVehicle) {
                        if ($intVehicleType == $arrVehicle["id"]) {
                            ?>
                            <option value="<?php echo $arrVehicle['id'] ?>" selected><?php echo $arrVehicle['name'] ?></option>
                            <?php
                        } else {
                            ?>
                            <option value="<?php echo $arrVehicle['id'] ?>" >
                                <?php echo $arrVehicle['name'] ?></option>
                            <?php
                        }
                    }
                }
                ?>
            </select>
        </div>
        <span id="vmodelerr" style="color:red;">
            <?php
            echo isset($errors['vehicle_id'][0]) ? $errors['vehicle_id'][0] : NULL
            ?>
        </span>
    </div>
    <!--Vehicle Type :: END-->



    <!--Name :: START-->
    <div class="form-group">
        <label class="col-sm-2 control-label">Name</label> 
        <div class="col-sm-10">
            <?php
            $strEditFeatureName = isset($vehicle_details['name']) ? $vehicle_details['name'] : NULL;
            $strFormFeatureName = isset($vehiclefeatureForm->name) ? $vehiclefeatureForm->name : NULL;
            $strFeatureName = !empty($strFormFeatureName) ? $strFormFeatureName : $strEditFeatureName;
            unset($strEditFeatureName, $strFormFeatureName);
            ?>
            <input type='text' name='vehicle_feature_name' id='vehicle_feature_name' value="<?php echo $strFeatureName; ?>"/>

        </div>
        <?php
        if (isset($errors['vehicle_feature_name'][0])) {
            ?>
            <span id="vmodelerr" style="color:red;">
                <?php
                echo $errors['vehicle_feature_name'][0];
                ?>
            </span>
            <?php
        }
        ?>
    </div>
    <!--Name :: END-->


    <!--Code :: START-->
    <div class="form-group">
        <label class="col-sm-2 control-label">Code</label>
        <div class="col-sm-10">
            <?php
            $strFeatureCode = NULL;
            $strEditFeatureCode = isset($vehicle_details['code']) ? $vehicle_details['code'] : NULL;
            $strFormFeatureCode = isset($vehiclefeatureForm->code) ? $vehiclefeatureForm->code : NULL;
            $strFeatureCode = !empty($strFormFeatureCode) ? $strFormFeatureCode : $strEditFeatureCode;
            ?>
            <input type='text' name='vehicle_feature_code' id='vehicle_feature_code' value="<?php echo $strFeatureCode; ?>"/>

        </div>
        <span id="vmodelerr" style="color:red;">
            <?php
            echo isset($errors['vehicle_feature_code'][0]) ? $errors['vehicle_feature_code'][0] : NULL
            ?>
        </span>
        <!--Code :: END-->
    </div>


    <!--Description :: START-->
    <div class="form-group">
        <label class="col-sm-2 control-label">Description :</label>
        <div class="col-sm-10">
            <?php
            $strFeatureDescription = NULL;
            $strEditFeatureDescription = isset($vehicle_details['description']) ? $vehicle_details['description'] : NULL;
            $strFormFeatureDescription = isset($vehiclefeatureForm->description) ? $vehiclefeatureForm->description : NULL;
            $strFeatureDescription = !empty($strFormFeatureDescription) ? $strFormFeatureDescription : $strEditFeatureDescription;
            ?>
            <textarea class="form-control alt" name='vehicle_feature_description' id='vehicle_feature_description' style="height:120px;"><?php echo $strFeatureDescription; ?></textarea>
        </div>

        <span id="vmodelerr" style="color:red;">
            <?php
            echo isset($errors['vehicle_feature_description'][0]) ? $errors['vehicle_feature_description'][0] : NULL
            ?>
        </span>
        <!--Description :: END-->
    </div>

    <!--Image :: START-->
    <div class="form-group">
        <label class="col-sm-2 control-label">Add Your Vehicle Image :</label>
        <div class="col-sm-10">
            <input type='file' name='vehicle_feature_image' id='vehicle_feature_image'/>
            <?php
            if (isset($vehicle_details['feature_image']) && !empty($vehicle_details['feature_image'])) {
                ?>
                <img style="width:50px;height:50px;" src="<?php echo Yii::app()->params['adminImgURL'] . 'vehicle_features/mobile/72x72/' . $vehicle_details['feature_image']; ?>"/>
                <?php
            }
            ?>
        </div>
        <span id="vmodelerr" style="color:red;">
            <?php
            echo isset($errors['vehicle_feature_image'][0]) ? $errors['vehicle_feature_image'][0] : NULL
            ?>
        </span>
        <!--Image :: END-->

    </div>


    <!--Status :: START-->
    <div class="form-group">
        <label  class="col-sm-2 control-label">Status</label> 
        <div class="col-sm-10">
            <select name='vehicle_feature_status' id='vehicle_feature_status'>
                <?php
                $strFeatureStatus = NULL;
                $strEditFeatureStatus = isset($vehicle_details['status']) ? $vehicle_details['status'] : NULL;
                $strFormFeatureStatus = isset($vehiclefeatureForm->status) ? $vehiclefeatureForm->status : NULL;
                $strFeatureStatus = !empty($strEditFeatureStatus) ? $strEditFeatureStatus : $strFormFeatureStatus;
                ?>

                <option value="" <?php
                if (isset($strFeatureStatus) && 0 == $strFeatureStatus) {
                    echo 'selected';
                    ?>
                        <?php } ?>>--Select Status--</option>
                <option value="1" <?php
                if (isset($strFeatureStatus) && 1 == $strFeatureStatus) {
                    echo 'selected';
                    ?>
                <?php } ?>
                        >Active</option>
                <option value="2"
                <?php
                if (isset($strFeatureStatus) && 2 == $strFeatureStatus) {
                    echo 'selected';
                    ?>
                <?php } ?>
                        >Inactive</option>
            </select>
        </div>
        <span id="vmodelerr" style="color:red;">
            <?php
            echo isset($errors['vehicle_feature_status'][0]) ? $errors['vehicle_feature_status'][0] : NULL
            ?>
        </span>
        <!--Status :: START-->
    </div>












    <!--Form Submit :: START-->
    <!--Button :: START-->
    <?php if (isset($vehicle_details['id']) && !empty($vehicle_details['id'])) { ?>
        <div class="form-group text-center">
            <input type="submit" class="btn btn-large" name="vehicle_feature_create" id="vehicle_feature_create" value="Update">
        </div>
    <?php } else { ?>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type='submit' class="btn btn-warning" name='vehicle_feature_create' id='vehicle_feature_create' value = 'Create'/>
            </div>
        </div>
    <?php }
    ?>
    <!--Form Submit :: END-->


</form>