<div class="card-body">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="<?php echo Yii::app()->baseurl; ?>/index.php/Vehicles/Vehicles/vehicle">Add Vehicle</a></li>
        <li ><a href="<?php echo Yii::app()->baseurl; ?>/index.php/Vehicles/Vehicles/vehiclesReport">Vehicle List</a></li>
    </ul>


    <div class="tab-content">
        <form class="form-horizontal lcns" method="post" enctype="multipart/form-data">

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
            <!--Operation Message :: END-->
            <!--Vehicle Types :: START-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Vehicle Type</label>
                <div class="col-sm-3">
                    <select  onChange="getVehicleType(this.value)" name='vehicle_types' id='vehicle_types'>
                        <option value=''>--Select Vehicle--</option>
                        <?php
                        if (isset($vehicles) && !empty($vehicles)) {
                            foreach ($vehicles as $arrVehicle) {
                                if ($arrVehicle['id'] == $vehicle_details['vehicle_id']) {
                                    ?>
                                    <option value="<?php echo $arrVehicle['id']; ?>" selected="selected"><?php echo $arrVehicle['name']; ?></option>
                                    <?php
                                } else {
                                    ?>
                                    <option value='<?php echo $arrVehicle['id']; ?>'><?php echo $arrVehicle['name']; ?></option>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </select>
                    <?php
                    if (isset($errors['vehicle_types'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['vehicle_types'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!--Vehicle Types :: END-->

            <!--Vehicle Category :: START-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Vehicle Categories</label>
                <div class="col-sm-3">
                    <select  name="vehicle_categories" id="vehicle_categories">
                        <?php
                        if (!empty($vehicle_details['vehicle_category_id'])) {
                            ?>
                            <option value="<?php echo $vehicle_details['vehicle_category_id']; ?>" selected="selected"><?php echo $vehicle_details['vehicle_category']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <?php
                    if (isset($errors['vehicle_categories'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['vehicle_categories'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!--Vehicle Category :: END-->


            <!--Vehicle Brand :: START-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Vehicle Brand</label>
                <div class="col-sm-3">
                    <select onChange="getBrandModel(this.value)" name="brand" id="brand">
                        <?php
                        if (!empty($vehicle_details['brand_id'])) {
                            ?>
                            <option value="<?php echo $vehicle_details['brand_id']; ?>" selected="selected"><?php echo $vehicle_details['brand_name']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <?php
                    if (isset($errors['brand'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['brand'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>

                </div>
            </div>
            <!--Vehicle Brand :: END-->


            <!--Vehicle Model :: START-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Vehicle Model</label>
                <div class="col-sm-3">
                    <select  name="brandModel" id="brandModel">
                        <?php
                        if (!empty($vehicle_details['model_id'])) {
                            ?>
                            <option value="<?php echo $vehicle_details['model_id']; ?>" selected="selected"><?php echo $vehicle_details['model_name']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <?php
                    if (isset($errors['brandModel'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['brandModel'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!--Vehicle Model :: END-->



            <?php //print_r($vehicle_details["vehicle_year"]);die(); ?>
            <!--Vehicle Years :: START-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Year</label>
                <div class="col-sm-3">
                    <select name="modelYear" id="modelYear">

                        <?php
                        $intEditYear = isset($vehicle_details["vehicle_year"]) ? $vehicle_details["vehicle_year"] : NULL;
                        if (isset($years) && !empty($years)) {
                            foreach ($years as $intYearKey => $intYearValue) {
                                if ($intYearValue == $intEditYear) {
                                    ?>
                                    <option value="<?php echo $intYearKey; ?>" selected><?php echo $intYearValue; ?></option>
                                    <?php
                                } else {
                                    ?>

                                    <option value="<?php echo $intYearKey; ?>"><?php echo $intYearValue; ?></option>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </select>
                    <?php
                    if (isset($errors['modelYear'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['modelYear'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!--Vehicle Years :: START-->

            <!--Status:: START -->
              <div class="form-group">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-3">
                 <?php  $intEditStatus = isset($vehicle_details["status"]) ? $vehicle_details["status"] : NULL; ?>
                        <select name="vehicle_status" id="vehicle_status">
                        <option value="">--Select Status</option>
                        <option value="1" <?php if($intEditStatus == 1) echo "selected";?>>Active</option>
                        <option value="0" <?php if($intEditStatus == 0) echo "selected";?>>In Active</option>
                    </select>
                </div>
              </div>
            <!--Status:: END -->
            
            <!--Form Submit :: START-->
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type='submit' class="btn btn-warning" name='update_vehicle' id='update_vehicle' value = 'Update'/>
                </div>
            </div>
            <!--Form Submit :: END-->

            <font color="green">
            <div id="message">
            </div>
            </font>
        </form>
    </div>
</div>


<script type='text/javascript'>
    function getBrandModel(intVehicleBrand) {
        var objVehicleBrand = {};
        objVehicleBrand = {
            vehicleBrand: intVehicleBrand,
        };
        $.post('<?php echo Yii::app()->params['webURL'] . '/Vehicles/Vehicles/getVehicleBrandModels' ?>', objVehicleBrand, function (response) {
            if (response.length > 0) {
                $('#select2-brandModel-container').html('--Select Model--');
                $("#brandModel").html("");
                $("#brandModel").append(response);
            } else {
                $("#brandModel").html("");
            }
            return true;
        });
        return true;
    }
    function getVehicleType(intVehicleType) {
        var objVehicle = {};
        objVehicle = {
            vehicle_id: intVehicleType,
        };
        $.post('<?php echo Yii::app()->params['webURL'] . '/Vehicles/Vehicles/getVehicleCategories' ?>', objVehicle, function (response) {
            if (response.length > 0) {
                $('#select2-vehicle_categories-container').html('--Select Category--');
                $("#vehicle_categories").html("");
                $("#vehicle_categories").append(response);
            } else {
                $("#vehicle_categories").html("");
            }
            return true;
        });

        $.post('<?php echo Yii::app()->params['webURL'] . '/Vehicles/Vehicles/getVehicleBrands' ?>', objVehicle, function (response) {
            if (response.length > 0) {
                $('#select2-brand-container').html('--Select Brand--');
                $("#brand").html("");
                $("#brand").append(response);
            } else {
                $("#brand").html("");
            }
            return true;
        });

        return true;
    }
</script>
