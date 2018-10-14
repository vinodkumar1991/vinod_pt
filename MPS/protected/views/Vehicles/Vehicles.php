
<div class="card-body">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="<?php echo Yii::app()->baseurl; ?>/index.php/Vehicles/Vehicles/vehicle">Add Vehicle</a></li>
        <li ><a href="<?php echo Yii::app()->baseurl; ?>/index.php/Vehicles/Vehicles/vehiclesReport">Vehicle List</a></li>
    </ul>


    <div class="tab-content">
        <form class="form-horizontal lcns" method="post" enctype="multipart/form-data">

            <?php
            if (!empty($success)) {
                ?>
                <font color="green"><div id="message">
                    <?php
                    echo $success;
                    ?>
                </div></font>
                <?php
            }
            ?>
            <!--Vehicle Types :: START-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Vehicle Type</label>
                <div class="col-sm-3">
                    <select  onChange="getVehicleType(this.value)" name='vehicle_types' id='vehicle_types'>
                        <option value=''>--Select Vehicle--</option>
                        <?php
                        if (isset($vehicles) && !empty($vehicles)) {
                            foreach ($vehicles as $arrVehicle) {
                                ?>
                                <option value='<?php echo $arrVehicle['id']; ?>'><?php echo $arrVehicle['name']; ?></option>
                                <?php
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
                        <option value="">--Select Category--</option>
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
                        <option value=''>--Select Brand--</option>
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
                        <option value="">--Select Model--</option>

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




            <!--Vehicle Years :: START-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Year</label>
                <div class="col-sm-3">
                    <select name="modelYear" id="modelYear">
                        <option value="">--Select Year--</option>
                        <?php
                        if (isset($years) && !empty($years)) {
                            foreach ($years as $intYearKey => $intYearValue) {
                                ?>
                                <option value="<?php echo $intYearKey; ?>"><?php echo $intYearValue; ?></option>
                                <?php
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

            <!--Form Submit :: START-->
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type='submit' class="btn btn-warning" name='createVehicle' id='createVehicle' value = 'Create'/>
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
                $("#vehicle_categories").html("");
                $("#vehicle_categories").append(response);
            } else {
                $("#vehicle_categories").html("");
            }
            return true;
        });

        $.post('<?php echo Yii::app()->params['webURL'] . '/Vehicles/Vehicles/getVehicleBrands' ?>', objVehicle, function (response) {
            if (response.length > 0) {
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

