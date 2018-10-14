
<div class="card-body">
    <!--Tab Menus :: START-->
    <ul class="nav nav-tabs" role="tablist">
        <li><a href="<?php echo Yii::app()->params['webURL']; ?>UserService/UserService/Repairs">Add Repair</a></li>
        <li><a href="<?php echo Yii::app()->params['webURL']; ?>UserService/UserService/RepairList">Add Repairlist</a></li>
        <li><a href="<?php echo Yii::app()->params['webURL']; ?>UserService/UserService/RepairListBilling">Billing</a></li>
        <li><a href="<?php echo Yii::app()->params['webURL']; ?>UserService/UserService/BillingReport">Billing Report</a></li>
        <li><!--<a href="<?php //echo Yii::app()->params['webURL'];                                                             ?>UserService/UserService/AddCategory">Add Category</a></li>
        <li><a href="<?php //echo Yii::app()->params['webURL'];                                                             ?>UserService/UserService/AddPlans">Add Plans</a></li>-->
        <li><a href="<?php echo Yii::app()->params['webURL']; ?>Reports/Orders/Orders/AddPackageAmount">Update package</a></li>
        <li class="active"><a href="<?php echo Yii::app()->params['webURL']; ?>Reports/Orders/Orders/AddVehiclePackageAmount">Add package</a></li>
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

            <!--Vehicle Services :: START-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Vehicle Services</label>
                <div class="col-sm-3">
                    <select  name="service_type_id" id="service_type_id">
                        <option value="">--Select Service--</option>
                    </select>
                    <?php
                    if (isset($errors['service_type_id'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['service_type_id'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!--Vehicle Services :: END-->

            <!--Vehicle Plans :: START-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Plans</label>
                <div class="col-sm-3">
                    <select  name="plan_id" id="plan_id">
                        <option value="">--Select Plan--</option>
                        <?php
                        if (!empty($plans)) {
                            foreach ($plans as $arrPlan) {
                                ?>
                                <option value="<?php echo $arrPlan['id']; ?>"><?php echo $arrPlan['name']; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <?php
                    if (isset($errors['plan_id'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['plan_id'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!--Vehicle Plans :: END-->

            <!--Vehicle Amount :: START-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Amount</label>
                <div class="col-sm-3">
                    <input type="text" name="amount" id="amount" value="<?php echo isset($packageForm->amount) ? $packageForm->amount : NULL; ?>"/>
                    <?php
                    if (isset($errors['amount'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['amount'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!--Vehicle Amount :: END-->


            <!--Form Submit :: START-->
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type='submit' class="btn btn-warning" name='create_package' id='create_package' value = 'Create'/>
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

        $.post('<?php echo Yii::app()->params['webURL'] . '/UserService/UserService/GetServicesList' ?>', objVehicle, function (response) {
            if (response.length > 0) {
                $("#service_type_id").html("");
                $("#service_type_id").append(response);
            } else {
                $("#service_type_id").html("");
            }
            return true;
        });

        return true;
    }
</script>

