<!--Google Address :: START-->
<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/jquery.geocomplete.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/locationpicker.jquery.min.js"></script>
<!--Google Address :: END-->
<ul class="nav nav-tabs" role="tablist">
    <li class="active">
        <a href="<?php echo Yii::app()->params['webURL'] . 'User/User/Mechanic'; ?>">Create Mechanic</a>
    </li>
    <li>
        <a href="<?php echo Yii::app()->params['webURL'] . 'User/User/MechanicReport'; ?>">Mechanics Report</a>
    </li>
</ul>

<form class="form-horizontal lcns  userreg-form" id="delshop" method="POST"  enctype="multipart/form-data">
    <!-- START :: Display Success Message-->
    <br/>
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

    <div align="center">
        <font color="green">
        <span id="message">
            <b>
                <?php
                echo isset($message) ? $message : NULL;
                ?>  
            </b>
        </span>
        </font>
    </div>
    <!-- END -->
    <div class="row"><h3 class="col-sm-12">Enter Shop Details</h3></div>
    <div class="row">
        <!--Shop Name :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Name</label>
            <div class="col-md-6">
                <?php
                $strFormShopName = isset($editMechanicForm->mechanic_shop_name) ? $editMechanicForm->mechanic_shop_name : NULL;
                $strExistShopName = isset($mechanic_details[0]['shop_name']) ? $mechanic_details[0]['shop_name'] : NULL;
                $strFinalShopName = !empty($strFormShopName) ? $strFormShopName : $strExistShopName;
                unset($strFormShopName, $strExistShopName);
                ?>
                <input type="text" class="form-control" id="mechanic_shop_name" name="mechanic_shop_name" value="<?php echo $strFinalShopName; ?>"/>
                <?php
                if (isset($errors['mechanic_shop_name'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['mechanic_shop_name'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>

        </div>
        <!--Shop Name :: END-->
        
         <!--Shop Code :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Code</label>
            <div class="col-md-6">
                <?php
                $strFormShopCode = isset($editMechanicForm->mechanic_code) ? $editMechanicForm->mechanic_code : NULL;
                $strExistShopCode = isset($mechanic_details[0]['mechanic_code']) ? $mechanic_details[0]['mechanic_code'] : NULL;
                $strFinalShopCode = !empty($strFormShopCode) ? $strFormShopCode : $strExistShopCode;
                unset($strFormShopCode, $strExistShopCode);
                ?>
                <input type="text" class="form-control" id="mechanic_code" name="mechanic_code" value="<?php echo $strFinalShopCode; ?>"/>
                <?php
                if (isset($errors['mechanic_code'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['mechanic_code'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>

        </div>
        <!--Shop Code :: END-->

        <!--Country :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Country</label>
            <div class="col-md-6">
                <select name="mechanic_shop_country" id="mechanic_shop_country" onChange="getCountryState(this.value)">
                    <option value="">--Select Country--</option>
                    <?php
                    if (!empty($countries)) {
                        foreach ($countries as $arrCountry) {
                            if ($arrCountry['country_id'] == $mechanic_details[0]['shop_country']) {
                                ?>
                                <option value='<?php echo $arrCountry['country_id']; ?>' selected="true"><?php echo isset($arrCountry['country_name']) ? $arrCountry['country_name'] : NULL; ?></option>
                                <?php
                            } else {
                                ?>
                                <option value='<?php echo $arrCountry['country_id']; ?>'><?php echo isset($arrCountry['country_name']) ? $arrCountry['country_name'] : NULL; ?></option>
                                <?php
                            }
                        }
                    }
                    ?>
                </select>
                <?php
                if (isset($errors['mechanic_shop_country'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['mechanic_shop_country'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>

        </div>
        <!--Country :: END-->

        <!--State :: START-->
        <div class="col-md-6" style="clear: both;">
            <label class="col-md-6 control-label">State</label>
            <div class="col-md-6">
                <select name="mechanic_shop_state" id="mechanic_shop_state" onChange="getStateCity(this.value)">
                    <?php
                    if (!empty($states)) {
                        foreach ($states as $arrState) {
                            ?>
                            <option value="<?php echo $arrState['state_id']; ?>"><?php echo $arrState['state_name']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
                <?php
                if (isset($errors['mechanic_shop_state'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['mechanic_shop_state'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--State :: END-->

        <!--License :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">License</label>
            <div class="col-md-6">
                <?php
                $strFormLicenseName = isset($editMechanicForm->mechanic_shop_license) ? $editMechanicForm->mechanic_shop_license : NULL;
                $strExistLicenseName = isset($mechanic_details[0]['shop_license']) ? $mechanic_details[0]['shop_license'] : NULL;
                $strFinalLicenseName = !empty($strFormLicenseName) ? $strFormLicenseName : $strExistLicenseName;
                unset($strFormLicenseName, $strExistLicenseName);
                ?>
                <input type="text" class="form-control" id="mechanic_shop_license" name="mechanic_shop_license" value="<?php echo $strFinalLicenseName; ?>"/>
                <?php
                if (isset($errors['mechanic_shop_license'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['mechanic_shop_license'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>

        </div>
        <!--License :: END-->

        <!--City :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">City</label>
            <div class="col-md-6">
                <select name="mechanic_shop_city" id="mechanic_shop_city" onChange="getCityArea(this.value)">
                    <?php
                    if (!empty($cities)) {
                        foreach ($cities as $arrCity) {
                            ?>
                            <option value="<?php echo $arrCity['city_id']; ?>"><?php echo $arrCity['city_name']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
                <?php
                if (isset($errors['mechanic_shop_city'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['mechanic_shop_city'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--City :: END-->

        <!--Vehicle Type :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Vehicle Type</label>
            <div class="col-md-6">
                <select name="mechanic_vehicle_type" id="mechanic_vehicle_type" onChange="getServices(this.value)">
                    <option value=''>--Select Vehicle Type--</option>
                    <?php
                    if (!empty($vehicles)) {
                        foreach ($vehicles as $arrVehicle) {
                            if ($arrVehicle['id'] == $mechanic_details[0]['shop_vehicle_id']) {
                                ?>
                                <option value='<?php echo $arrVehicle['id']; ?>' selected="true">
                                    <?php echo isset($arrVehicle['name']) ? $arrVehicle['name'] : NULL; ?>
                                </option>
                                <?php
                            } else {
                                ?>
                                <option value='<?php echo $arrVehicle['id']; ?>'>
                                    <?php echo isset($arrVehicle['name']) ? $arrVehicle['name'] : NULL; ?>
                                </option>
                                <?php
                            }
                        }
                    }
                    ?>
                </select>
                <?php
                if (isset($errors['mechanic_vehicle_type'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['mechanic_vehicle_type'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--Vehicle Type :: END-->

        <!--Owner Name :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Owner Name</label>
            <div class="col-md-6">
                <?php
                $strFormOwnerName = isset($editMechanicForm->mechanic_owner_name) ? $editMechanicForm->mechanic_owner_name : NULL;
                $strExistOwnerName = isset($mechanic_details[0]['shop_owner']) ? $mechanic_details[0]['shop_owner'] : NULL;
                $strFinalOwnerName = !empty($strFormOwnerName) ? $strFormOwnerName : $strExistOwnerName;
                unset($strFormOwnerName, $strExistOwnerName);
                ?>
                <input type="text" class="form-control" id="mechanic_owner_name" name="mechanic_owner_name" value="<?php echo $strFinalOwnerName; ?>"/>
                <?php
                if (isset($errors['mechanic_owner_name'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['mechanic_owner_name'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--Owner Name :: END-->

        <!--Area :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Area</label>
            <div class="col-md-6">
                <select name="mechanic_area" id="mechanic_area">
                    <?php
                    if ($areas) {
                        foreach ($areas as $arrArea) {
                            ?>
                            <option value="<?php echo $arrArea['area_id']; ?>"><?php echo $arrArea['area_name']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
                <?php
                if (isset($errors['mechanic_area'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['mechanic_area'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--Area :: END-->

        <!--Number Of Mechanics :: START-->
        <div class="col-md-6" style="clear: both;">
            <label class="col-md-6 control-label">Total Mechanics</label>
            <div class="col-md-6">
                <?php
                $strFormTotalMechanics = isset($editMechanicForm->mechanic_total) ? $editMechanicForm->mechanic_total : NULL;
                $strExistTotalMechanics = isset($mechanic_details[0]['total_mechanics']) ? $mechanic_details[0]['total_mechanics'] : NULL;
                $strFinalTotalMechanics = !empty($strFormTotalMechanics) ? $strFormTotalMechanics : $strExistTotalMechanics;
                unset($strFormTotalMechanics, $strExistTotalMechanics);
                ?>
                <input type="text" class="form-control" id="mechanic_total" name="mechanic_total" placeholder="Enter Number of Mecanics" value="<?php echo $strFinalTotalMechanics; ?>"/>
                <?php
                if (isset($errors['mechanic_total'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['mechanic_total'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>

        </div>                                        
        <!--Number Of Mechanics :: END-->

        <div class="col-md-6">
            <label class="col-md-6 control-label">Services offered</label>
            <div class="col-md-6">
                <select id="mechanic_selected_services" name="mechanic_selected_services[]" multiple="multiple">
                    <option value="">--Select Services--</option>
                    <?php
                    if (!empty($vehicle_services)) {
                        foreach ($vehicle_services as $arrVehicleService) {
                            if (in_array($arrVehicleService['id'], $shop_services)) {
                                ?>
                                <option value="<?php echo $arrVehicleService['id']; ?>" selected="true"><?php echo $arrVehicleService['name']; ?></option>
                                <?php
                            } else {
                                ?>
                                <option value="<?php echo $arrVehicleService['id']; ?>"><?php echo $arrVehicleService['name']; ?></option>
                                <?php
                            }
                        }
                    }
                    ?>
                </select>
                <?php
                if (isset($errors['mechanic_selected_services'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['mechanic_selected_services'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>

        <div class="col-md-6" style="clear: both;">
            <label class="col-md-6 control-label">Shop Address</label>
            <div class="col-md-6">
                <?php
                $strFormAddresss = isset($editMechanicForm->adrs) ? $editMechanicForm->adrs : NULL;
                $strExistAddress = isset($mechanic_details[0]['shop_location']) ? $mechanic_details[0]['shop_location'] : NULL;
                $strFinalAddress = !empty($strFormAddresss) ? $strFormAddresss : $strExistAddress;
                unset($strFormAddresss, $strExistAddress);
                ?>
                <input type="text" class="form-control geocomplete" name="adrs" id="adrs" value="<?php echo $strFinalAddress; ?>"/>
                <input type="hidden" class="form-control" name="location" value="<?php echo isset($editMechanicForm->location) ? $editMechanicForm->location : NULL; ?>"/>
                <?php
                if (isset($errors['adrs'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['adrs'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>

            </div>
        </div>

        <!--Address Proof :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Address Proof</label>
            <div class="col-md-6">
                <input type="file" name="mechanic_address_proof" id="mechanic_address_proof" data-type="image" class="form-control" />
                <?php
                if (isset($errors['mechanic_address_proof'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['mechanic_address_proof'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
                <img style="width:50px;height:50px;" src="<?php echo Yii::app()->params['adminImgURL'] . '/mechanics/address/original/' . $mechanic_details[0]['shop_address_image']; ?>"/>
            </div>	
        </div>
        <!--Address Proof :: END-->

        <!--ID Proof :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">ID Proof</label>
            <div class="col-md-6">
                <input type="file" name="mechanic_id_proof" id="mechanic_id_proof" data-type="image" class="form-control"/>
                <?php
                if (isset($errors['mechanic_id_proof'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['mechanic_id_proof'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
                <img style="width:50px;height:50px;" src="<?php echo Yii::app()->params['adminImgURL'] . '/mechanics/id_proofs/original/' . $mechanic_details[0]['shop_id_image']; ?>"/>
            </div>
        </div>
        <!--ID Proof :: END-->

        <!--Photo :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Photo</label>
            <div class="col-md-6">
                <input type="file" name="mechanic_photo" id="mechanic_photo" data-type="image" class="form-control"/>
                <?php
                if (isset($errors['mechanic_photo'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['mechanic_photo'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
                <img style="width:50px;height:50px;" src="<?php echo Yii::app()->params['adminImgURL'] . '/mechanics/photo/original/' . $mechanic_details[0]['shop_photo_image']; ?>"/>
            </div>	
        </div>
        <!--Photo :: END-->

        <div class="col-md-6">
            <label class="col-md-6 control-label">Service Capability (Per Day)</label>
            <div class="col-md-6">
                <?php
                $strFormCapability = isset($editMechanicForm->mechanic_shop_capability) ? $editMechanicForm->mechanic_shop_capability : NULL;
                $strExistCapability = isset($mechanic_details[0]['service_capability']) ? $mechanic_details[0]['service_capability'] : NULL;
                $strFinalCapability = !empty($strFormCapability) ? $strFormCapability : $strExistCapability;
                unset($strFormCapability, $strExistCapability);
                ?>
                <input type="number" class="form-control" id="mechanic_shop_capability" name="mechanic_shop_capability" value="<?php echo $strFinalCapability; ?>"/>
                <?php
                if (isset($errors['mechanic_shop_capability'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['mechanic_shop_capability'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>

        </div>

        <!--Email :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Email</label>
            <div class="col-md-6">
                <?php
                $strFormEmail = isset($editMechanicForm->mechanic_email) ? $editMechanicForm->mechanic_email : NULL;
                $strExistEmail = isset($mechanic_details[0]['shop_email']) ? $mechanic_details[0]['shop_email'] : NULL;
                $strFinalEmail = !empty($strFormEmail) ? $strFormEmail : $strExistEmail;
                unset($strFormEmail, $strExistEmail);
                ?>
                <input type="email" class="form-control" id="mechanic_email" name="mechanic_email" value="<?php echo $strFinalEmail; ?>"/>
                <?php
                if (isset($errors['mechanic_email'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['mechanic_email'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>

        </div>
        <!--Email :: END-->

        <!--Contact Number :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Mobile</label>
            <div class="col-md-6">
                <?php
                $strFormPhone = isset($editMechanicForm->mechanic_contact) ? $editMechanicForm->mechanic_contact : NULL;
                $strExistPhone = isset($mechanic_details[0]['shop_phone']) ? $mechanic_details[0]['shop_phone'] : NULL;
                $strFinalPhone = !empty($strFormPhone) ? $strFormPhone : $strExistPhone;
                unset($strFormPhone, $strExistPhone);
                ?>
                <input type="text" class="form-control" id="mechanic_contact" name="mechanic_contact" minlength="10" maxlength="15" value="<?php echo $strFinalPhone; ?>"/>
                <?php
                if (isset($errors['mechanic_contact'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['mechanic_contact'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>	
        <!--Contact Number :: END-->

        <div class="col-md-6">
            <label class="col-md-6 control-label">Address One</label>
            <div class="col-md-6">
                <?php
                $strFormPresentAddress = isset($editMechanicForm->mechanic_shop_address) ? $editMechanicForm->mechanic_shop_address : NULL;
                $strExistPresentAddress = isset($mechanic_details[0]['present_address']) ? $mechanic_details[0]['present_address'] : NULL;
                $strFinalPresentAddress = !empty($strFormPresentAddress) ? $strFormPresentAddress : $strExistPresentAddress;
                unset($strFormPresentAddress, $strExistPresentAddress);
                ?>
                <textarea class="form-control alt" placeholder="Enter shop address" name="mechanic_shop_address" id="mechanic_shop_address" style="height:120px;"><?php echo $strFinalPresentAddress; ?></textarea>
                <?php
                if (isset($errors['mechanic_shop_address'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['mechanic_shop_address'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>


    </div>

    <!--Button :: START-->
    <div class="form-group">
        <div class="col-sm-offset-6 col-sm-6">
            <input type="submit" class="btn btn-warning"  id="mechanic_update" name="mechanic_update" value="Update"/>
        </div>
    </div>
    <!--Button :: END-->

</form>

<script type='text/javascript'>
    //Vehicle Services
    function getServices(intVehicle) {
        var objVehicle = '';
        objVehicle = {
            vehicle_id: intVehicle
        };

        $.post('<?php echo Yii::app()->params['webURL'] . '/User/User/services'; ?>', objVehicle, function (response) {
            $('#mechanic_selected_services').html();
            $('#mechanic_selected_services').html(response);
            return true;
        });
    }
    //States
    function getCountryState(intCountry) {
        $('#select2-mechanic_shop_state-container').html('--Select State--');
        var objCountry = '';
        objCountry = {
            country_type: intCountry
        };

        $.post('<?php echo Yii::app()->params['webURL'] . '/User/User/states'; ?>', objCountry, function (response) {
            $('#mechanic_shop_state').html();
            $('#mechanic_shop_state').html(response);
            return true;
        });
    }

    //Cities
    function getStateCity(intState) {
        $('#select2-mechanic_shop_city-container').html('--Select City--');
        var objState = '';
        objState = {
            state_type: intState
        };

        $.post('<?php echo Yii::app()->params['webURL'] . '/User/User/cities'; ?>', objState, function (response) {
            $('#mechanic_shop_city').html();
            $('#mechanic_shop_city').html(response);
            return true;
        });
    }

    //Areas
    function getCityArea(intCity) {
        $('#select2-mechanic_area-container').html('--Select Area--');
        var objArea = '';
        objArea = {
            city_type: intCity
        };

        $.post('<?php echo Yii::app()->params['webURL'] . '/User/User/areas'; ?>', objArea, function (response) {
            $('#mechanic_area').html();
            $('#mechanic_area').html(response);
            return true;
        });
    }
</script>
<!--Google Address :: START-->
<script>
    $(function () {
        $(".geocomplete").geocomplete({
            details: "form",
            types: ["geocode", "establishment"],
        });
    });
</script>
<!--Google Address :: END-->
