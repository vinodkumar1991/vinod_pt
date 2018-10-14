
<div class="card-body">

    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="<?php echo Yii::app()->baseurl; ?>/index.php/Vehicles/Brands/CreateBrandModels">Create Model</a></li>
        <li ><a href="<?php echo Yii::app()->baseurl; ?>/index.php/Vehicles/Brands/CreateBrandModelsReport">Models Report</a></li>
    </ul>

    <div class="tab-content">
        <?php
        if (isset($response['code']) && 200 == $response['code']) {
            ?>
            <font color="green"><div id="message">
                <?php
                echo isset($response['message']) ? $response['message'] : NULL;
                ?>
            </div></font>
            <?php
        }
        ?>
        <form class="form-horizontal lcns" method="post" enctype="multipart/form-data">
            <!--Vehicle Types :: START-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Vehicle Types</label>
                <div class="col-sm-3">
                    <select  onChange="getVehicleType(this.value)" name='vehicle_types' id='vehicle_types'>
                        <option value=''>--Select Vehicle--</option>
                        <?php
                        if (!empty($vehicle_types)) {
                            foreach ($vehicle_types as $arrVehicle) {
                                ?>
                                <option value='<?php echo $arrVehicle['id']; ?>'>
                                    <?php
                                    echo $arrVehicle['name'] . ' ( ' . $arrVehicle['code'] . ' ) ';
                                    ?>
                                </option>
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

            <!--Vehicle Brands :: START-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Vehicle Brand</label>
                <div class="col-sm-3">
                    <select  name='vehicle_brand' id='vehicle_brand' class="form-control">
                    </select>
                    <?php
                    if (isset($errors['vehicle_brand'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['vehicle_brand'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!--Vehicle Brands :: END-->

            <!--Brand :: START-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-3">
                    <input type="text" name="model_name" id="model_name" class="form-control"/>
                </div>
                <?php
                if (isset($errors['model_name'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['model_name'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div> 
            <!--Brand :: END-->

            <!--Brand Code :: START-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Code</label>
                <div class="col-sm-3">
                    <input type="text" name="model_code" id="model_code" class="form-control"/>
                </div>
                <?php
                if (isset($errors['model_code'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['model_code'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div> 
            <!--Brand Code :: END-->

            <!--Brand Description :: START-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-3">
                    <textarea class="form-control alt" placeholder="Enter model description." name="model_description" id="model_description" style="height:120px;"></textarea>
                </div>
                <?php
                if (isset($errors['model_description'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['model_description'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div> 
            <!--Brand Description :: END-->


            <!--Logo :: START-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Logo ( Note *: Valid image extensions are jpg, jpeg, png, gif)</label>
                <div class="col-sm-3">
                    <input type="file" name="vehicle_model_logo" id="vehicle_model_logo" data-type="image"  accept="image/*" class="form-control" />
                    <?php
                    if (isset($errors['vehicle_model_logo'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['vehicle_model_logo'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!--Logo :: END-->

            <!--Status :: START-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-3">
                    <select  name='model_status' id='model_status' class="form-control">
                        <option value=''>--Select Status--</option>
                        <option value='1'>Active</option>
                        <option value='2'>Inactive</option>
                    </select>
                    <?php
                    if (isset($errors['model_status'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['model_status'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!--Status :: END-->

            <!--Form Submit :: START-->
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type='submit' class="btn btn-warning" name='create_model' id='create_model' value = 'Create'/>
                </div>
            </div>
            <!--Form Submit :: END-->
        </form>
    </div>
</div>

<script type="text/javascript">
    function getVehicleType(intVehicle)
    {
        var objVehicle = {};
        objVehicle = {
            vehicle_id: intVehicle,
        };
        $.post('<?php echo Yii::app()->params['webURL'] . 'Vehicles/Brands/GetVehicleBrands' ?>', objVehicle, function (response) {
            $("#vehicle_brand").html("");
            $("#vehicle_brand").html(response);
            return true;
        });
    }
</script>