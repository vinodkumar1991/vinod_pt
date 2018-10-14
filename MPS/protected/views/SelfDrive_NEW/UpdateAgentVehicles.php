<!--Menu :: START-->
<ul class="nav nav-tabs" role="tablist">
    <li class="active">
        <a href="<?php echo Yii::app()->params['webURL'] . 'SelfDrive/Agent/EditAgentVehicle'; ?>">Create</a>
    </li>
    <li>
        <a href="<?php echo Yii::app()->params['webURL'] . 'SelfDrive/Agent/AgentVehiclesReport'; ?>">Report</a>
    </li>
</ul>
<!--Menu :: END-->
<form class="form-horizontal lcns userreg-form"  method="POST" name="agent_vehicle_form" id="agent_vehicle_form" enctype="multipart/form-data">
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

    <!--Vehicle Details Label :: START-->
    <div class="row">
        <h3 class="col-sm-12">
            Vehicle Details
        </h3>
    </div>
    <!--Vehicle Details Label :: END-->


    <div class="row">
        <!--Agents :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Agents</label>
            <div class="col-md-6">
                <select name="vehicle_agent_id" id="vehicle_agent_id">
                    <option value="">--Select Agent--</option>
                    <?php
                    if (isset($agents) && !empty($agents)) {
                        foreach ($agents as $arrAgent) {
                            if ($selfVehicles[0]['agents_id'] == $arrAgent["agent_id"]) {
                                ?>
                                <option value="<?php echo $arrAgent['agent_id'] ?>" selected><?php echo $arrAgent['agency_name'] ?></option>
                                <?php
                            } else {
                                ?>
                                <option value="<?php echo $arrAgent['agent_id']; ?>">
                                    <?php echo $arrAgent['agency_name']; ?>
                                </option>
                                <?php
                            }
                        }
                    }
                    ?>
                </select>
                <?php
                if (isset($errors['vehicle_agent_id'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['vehicle_agent_id'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div> 
        <!--Agents :: END-->

        <!--Vehicle Type :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Vehicle Type</label>
            <div class="col-md-6">
                <select name="vehicle_type_id" id="vehicle_type_id" onChange="getVehicleBrands(this.value)">
                    <option value="">--Select Vehicle--</option>
                    <?php
                    if (isset($vehicles) && !empty($vehicles)) {
                        foreach ($vehicles as $arrVehicle) {
                            if ($selfVehicles[0]['vehicle_type_id'] == $arrVehicle["id"]) {
                                ?>
                                <option value="<?php echo $arrVehicle['id'] ?>" selected><?php echo $arrVehicle['name'] ?></option>
                                <?php
                            } else {
                                ?>
                                <option value="<?php echo $arrVehicle['id']; ?>">
                                    <?php echo $arrVehicle['name']; ?>
                                </option>
                                <?php
                            }
                        }
                    }
                    ?>
                </select>
                <?php
                if (isset($errors['vehicle_type_id'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['vehicle_type_id'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div> 
        <!--Vehicle Type :: END-->

        <!--Brand :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Brand</label>
            <div class="col-md-6">
                <select name="vehicle_brand_id" id="vehicle_brand_id" onChange="getBrandModel(this.value)">
                    <?php
                    if (isset($selfVehicles[0]['vehicle_brand_id']) && !empty($selfVehicles[0]['vehicle_brand_id'])) {
                        ?>
                        <option value="<?php echo $selfVehicles[0]['vehicle_brand_id']; ?>"><?php echo $selfVehicles[0]['vehicle_brand_name']; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <?php
                if (isset($errors['vehicle_brand_id'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['vehicle_brand_id'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--Registration Number :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Registration Number</label>
            <div class="col-md-6">
                <?php
                $strExistRegisterNo = isset($selfVehicles[0]['vehicle_registration_number']) ? $selfVehicles[0]['vehicle_registration_number'] : NULL;
                $strFormRegisterNo = isset($agentVehicleForm->vehicle_registration_number) ? $agentVehicleForm->vehicle_registration_number : NULL;
                $strFinalRegisterNo = !empty($strFormRegisterNo) ? $strFormRegisterNo : $strExistRegisterNo;
                unset($strExistRegisterNo, $strFormRegisterNo);
                ?>
                <input type="text" name="vehicle_registration_number" id="vehicle_registration_number" class="form-control"  value="<?php echo $strFinalRegisterNo; ?>" />
                <?php
                if (isset($errors['vehicle_registration_number'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['vehicle_registration_number'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--Registration Number :: END-->

        <!--Model :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Model</label>
            <div class="col-md-6">
                <select id="vehicle_brand_model_id" name="vehicle_brand_model_id">
                    <?php
                    if (isset($selfVehicles[0]['vehicle_model_id']) && !empty($selfVehicles[0]['vehicle_model_id'])) {
                        ?>
                        <option value="<?php echo $selfVehicles[0]['vehicle_model_id']; ?>"><?php echo $selfVehicles[0]['vehicle_model_name']; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <?php
                if (isset($errors['vehicle_brand_model_id'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['vehicle_brand_model_id'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--Model :: END-->

        <!--Vehicle Class :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Category</label>
            <div class="col-md-6">
                <select name="vehicle_class_id" id="vehicle_class_id">
                    <?php
                    if (isset($selfVehicles[0]['vehicle_class_id']) && !empty($selfVehicles[0]['vehicle_class_id'])) {
                        ?>
                        <option value="<?php echo $selfVehicles[0]['vehicle_class_id']; ?>"><?php echo $selfVehicles[0]['vehicle_class_name']; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <?php
                if (isset($errors['vehicle_class_id'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['vehicle_class_id'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--Vehicle Class :: END-->
        <!--Seating Capacity :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Seating Capacity</label>
            <div class="col-md-6">
                <select name="vehicle_seating_capacity" id="vehicle_seating_capacity">
                    <option value="">--Select Seating--</option>
                    <?php
                    if (!empty($vehicle_seating)) {
                        foreach ($vehicle_seating as $seatingId => $seatingValue) {
                            if ($selfVehicles[0]['seating'] == $seatingId) {
                                ?>
                                <option value="<?php echo $seatingId; ?>" selected><?php echo $seatingValue; ?></option>
                                <?php
                            } else {
                                ?>
                                <option value="<?php echo $seatingId; ?>"><?php echo $seatingValue; ?></option>
                                <?php
                            }
                        }
                        unset($vehicle_seating);
                    }
                    ?>
                </select>
                <?php
                if (isset($errors['vehicle_seating_capacity'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['vehicle_seating_capacity'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>    
        <!--Seating Capacity :: END-->

        <!--Vehicle Variants :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Vehicle Variant</label>
            <div class="col-md-6">
                <select name="vehicle_variant_id" id="vehicle_variant_id">
                    <option value="">Select Variant</option>
                    <?php
                    if (isset($vehicle_variants) && !empty($vehicle_variants)) {
                        foreach ($vehicle_variants as $arrVariant) {
                            if ($selfVehicles[0]['vehicle_variant_id'] == $arrVariant["id"]) {
                                ?>
                                <option value="<?php echo $arrVariant['id'] ?>" selected><?php echo $arrVariant['name'] ?></option>
                                <?php
                            } else {
                                ?>
                                <option value="<?php echo $arrVariant['id']; ?>"><?php echo $arrVariant['name']; ?></option>
                                <?php
                            }
                        }
                        unset($vehicle_variants);
                    }
                    ?>
                </select>
                <?php
                if (isset($errors['vehicle_variant_id'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['vehicle_variant_id'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--Vehicle Variants :: END-->
    </div>

    <div class="row">
        <h3 class="col-sm-12">
            Vehicle Features
        </h3>
    </div>

    <!--Vehicle Features :: START-->
    <div class="row">
        <div class="col-md-offset-3 col-md-9">
            <?php
            if (isset($vehicle_features) && !empty($vehicle_features)) {
                foreach ($vehicle_features as $arrFeature) {
                    ?>
                    <div class="col-md-3">
                        <div class="checkbox">
                            <?php
                            if (in_array($arrFeature['id'], $self_existed_features)) {
                                ?>
                                <label> 
                                    <input type="checkbox" id="vehicle_features"  name="vehicle_features[]" value="<?php echo $arrFeature['id']; ?>" checked="true"/>
                                    <?php echo $arrFeature['name']; ?>
                                </label>

                                <?php
                            } else {
                                ?>
                                <input type="checkbox" id="vehicle_features"  name="vehicle_features[]" value="<?php echo $arrFeature['id']; ?>"/>
                                <?php echo $arrFeature['name']; ?>
                                <?php
                            }
                            ?>
                        </div>
                    </div>

                    <?php
                }
            }
            ?>
            <?php
            if (isset($errors['vehicle_features'][0])) {
                ?>
                <span id="vmodelerr" style="color:red;">
                    <?php
                    echo $errors['vehicle_features'][0];
                    ?>
                </span>
                <?php
            }
            ?>

        </div>
        <!--Vehicle Features :: END-->
        <div class="col-md-12">
            <label class="col-md-3 control-label">Vehicle Description</label>
            <div class="col-md-9">
                <?php
                $strExistDecription = isset($selfVehicles[0]['description']) ? $selfVehicles[0]['description'] : NULL;
                $strFormDescription = isset($agentVehicleForm->vehicle_description) ? $agentVehicleForm->vehicle_description : NULL;
                $strFinalDescription = !empty($strFormDescription) ? $strFormDescription : $strExistDecription;
                unset($strExistDecription, $strFormDescription);
                ?>
                <textarea name="vehicle_description" id="vehicle_description" class="form-control"><?php echo $strFinalDescription; ?></textarea>
            </div>
        </div>

        <!--Vehicle Primary Image :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Add Your Vehicle Image</label>
            <div class="col-md-6">
                <input type="file"  id="file" name="vehicle_primary_image" class="form-control">
                <?php
                if (isset($errors['vehicle_primary_image'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['vehicle_primary_image'][0];
                        ?>
                    </span>
                    <?php
                }
                if (!empty($vehicle_images)) {
                    foreach ($vehicle_images as $arrVehicleImage) {
                        if (1 == $arrVehicleImage['is_parent']) {
                            ?>
                            <img style="width:50px;height:50px;" src="<?php echo Yii::app()->params['adminImgURL'] . $vehicle_image_path . $arrVehicleImage['self_vehicle_image']; ?>"/> 
                            <?php
                        }
                    }
                }
                ?>
            </div>

        </div> 
        <!--Vehicle Primary Image :: END-->

        <!--Vehicle Multiple Images :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Add Multiple Vehicle Images</label>
            <div class="col-md-6">
                <input type="file" name="vehicle_multiple_images[]" class="form-control" id="" multiple>
                <?php
                if (isset($errors['vehicle_multiple_images'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['vehicle_multiple_images'][0];
                        ?>
                    </span>
                    <?php
                }
                if (isset($vehicle_images[1]['self_vehicle_image']) && !empty($vehicle_images[1]['self_vehicle_image'])) {
                    $arrVehicleImages = $vehicle_images;
                    foreach ($arrVehicleImages as $arrVehicle) {
                        if (0 == $arrVehicle['is_parent']) {
                            ?>
                            <img style="width:50px;height:50px;" src="<?php echo Yii::app()->params['adminImgURL'] . $vehicle_multiimages_path . $arrVehicle['self_vehicle_image']; ?>"/> 
                            <?php
                        }
                    }
                    unset($arrVehicleImages, $vehicle_images);
                }
                ?>
            </div>
        </div>
        <!--Vehicle Multiple Images :: END-->

    </div>

    <!--Button :: START-->
    <div class="form-group">
        <div class="col-sm-offset-6 col-sm-6">
            <input type="submit" class="addvehicle btn btn-warning" id="update_agent_vehicle" name="update_agent_vehicle" value="Update"/>
        </div>
    </div>
    <!--Button :: END-->
</form>



<script type = "text/javascript" >
    //Vehicle Brands
    function getVehicleBrands(intVehicle)
    {
        //Brands
        var objVehicle = {};
        objVehicle = {
            vehicle_id: intVehicle,
        };
        $.post('<?php echo Yii::app()->params['webURL'] . 'Vehicles/Brands/GetVehicleBrands' ?>', objVehicle, function (response) {
            $('#select2-vehicle_brand_id-container').html('--Select Brand--');
            $('#select2-vehicle_brand_model_id-container').html('--Select Model--');
            $("#vehicle_brand_id").html("");
            $("#vehicle_brand_id").html(response);
            return true;
        });


        //Vehicle Classes
        $.post('<?php echo Yii::app()->params['webURL'] . 'SelfDrive/Agent/GetVehicleClasses' ?>', objVehicle, function (response) {
            $('#select2-vehicle_class_id-container').html('--Select Category--');
            $("#vehicle_class_id").html("");
            $("#vehicle_class_id").html(response);
            return true;
        });
    }

    //Vehicle Brand Models
    function getBrandModel(intVehicleBrand) {
        $('#select2-vehicle_brand_model_id-container').html('--Select Model--');
        var objVehicleBrand = {};
        objVehicleBrand = {
            vehicleBrand: intVehicleBrand,
        };
        $.post('<?php echo Yii::app()->params['webURL'] . '/Vehicles/Vehicles/getVehicleBrandModels' ?>', objVehicleBrand, function (response) {
            if (response.length > 0) {
                $("#vehicle_brand_model_id").html("");
                $("#vehicle_brand_model_id").append(response);
            } else {
                $("#vehicle_brand_model_id").html("");
            }
            return TRUE;
        });
        return TRUE;
    }



</script>




