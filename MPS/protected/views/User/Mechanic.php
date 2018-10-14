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
                <input type="text" class="form-control" id="mechanic_shop_name" name="mechanic_shop_name" value="<?php echo isset($mechanicForm->mechanic_shop_name) ? $mechanicForm->mechanic_shop_name : NULL; ?>"/>
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

        <!--Country :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Country</label>
            <div class="col-md-6">
                <select name="mechanic_shop_country" id="mechanic_shop_country" onChange="getCountryState(this.value)">
                    <option value="">--Select Country--</option>
                    <?php
                    if (!empty($countries)) {
                        foreach ($countries as $arrCountry) {
                            ?>
                            <option value='<?php echo $arrCountry['country_id']; ?>'><?php echo isset($arrCountry['country_name']) ? $arrCountry['country_name'] : NULL; ?></option>
                            <?php
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
                    <option value="">--Select State--</option>
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
                <input type="text" class="form-control" id="mechanic_shop_license" name="mechanic_shop_license" value="<?php echo isset($mechanicForm->mechanic_shop_license) ? $mechanicForm->mechanic_shop_license : NULL; ?>"/>
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
                    <option value="">--Select City--</option>
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
                            ?>
                            <option value='<?php echo $arrVehicle['id']; ?>'>
                                <?php echo isset($arrVehicle['name']) ? $arrVehicle['name'] : NULL; ?>
                            </option>
                            <?php
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
                <input type="text" class="form-control" id="mechanic_owner_name" name="mechanic_owner_name" value="<?php echo isset($mechanicForm->mechanic_owner_name) ? $mechanicForm->mechanic_owner_name : NULL; ?>"/>
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
                <select name="mechanic_area" id="mechanic_area" onChange="getZipcode(this.value)">
                    <option value="">--Select Area--</option>
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
                <input type="text" class="form-control" id="mechanic_total" name="mechanic_total" placeholder="Enter Number of Mecanics" value="<?php echo isset($mechanicForm->mechanic_total) ? $mechanicForm->mechanic_total : NULL; ?>"/>
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
            <label class="col-md-6 control-label">Services offerd</label>
            <div class="col-md-6">
                <select id="mechanic_selected_services" name="mechanic_selected_services[]" multiple="multiple">
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
            <label class="col-md-6 control-label">Shop Address ( Google Location )</label>
            <div class="col-md-6">
                <input type="text" class="form-control geocomplete" name="adrs" id="adrs" value="<?php echo isset($mechanicForm->adrs) ? $mechanicForm->adrs : NULL; ?>"/>
                <input type="hidden" class="form-control" name="location" value="<?php echo isset($mechanicForm->location) ? $mechanicForm->location : NULL; ?>"/>
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
            </div>	
        </div>
        <!--Photo :: END-->

        <div class="col-md-6">
            <label class="col-md-6 control-label">Service Capability (Per Day)</label>
            <div class="col-md-6">
                <input type="number" class="form-control" id="mechanic_shop_capability" name="mechanic_shop_capability" value="<?php echo isset($mechanicForm->mechanic_shop_capability) ? $mechanicForm->mechanic_shop_capability : NULL; ?>"/>
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
                <input type="email" class="form-control" id="mechanic_email" name="mechanic_email" value="<?php echo isset($mechanicForm->mechanic_email) ? $mechanicForm->mechanic_email : NULL; ?>"/>
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
                <input type="text" class="form-control" id="mechanic_contact" name="mechanic_contact" minlength="10" maxlength="15" value="<?php echo isset($mechanicForm->mechanic_contact) ? $mechanicForm->mechanic_contact : NULL; ?>"/>
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
                <textarea class="form-control alt" placeholder="Enter shop address" name="mechanic_shop_address" id="mechanic_shop_address" style="height:120px;"><?php echo isset($mechanicForm->mechanic_shop_address) ? $mechanicForm->mechanic_shop_address : NULL; ?></textarea>
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

    <!--Mechanic Shop Credentials :: START-->
    <div class="row"><h3 class="col-sm-12">Create Account</h3></div>
    <!--Username :: START-->
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Username</label>
            <div class="col-md-6">
                <input type="text" class="form-control" id="mechanic_username" name="mechanic_username" value="<?php echo isset($mechanicForm->mechanic_username) ? $mechanicForm->mechanic_username : NULL; ?>"/>
                <?php
                if (isset($errors['mechanic_username'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['mechanic_username'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>

        </div>
    </div>
    <!--Username :: END-->

    <!--Password :: START-->
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Password</label>
            <div class="col-md-6">
                <input type="password" class="form-control" id="mechanic_password" name="mechanic_password">
                <?php
                if (isset($errors['mechanic_password'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['mechanic_password'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>

        </div>
    </div>
    <!--Password :: END-->

    <!--Confirm Password :: START-->
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Confirm Password</label>
            <div class="col-md-6">
                <input type="password" class="form-control" id="mechanic_confirm_password" name="mechanic_confirm_password">
                <?php
                if (isset($errors['mechanic_confirm_password'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['mechanic_confirm_password'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>

        </div>
    </div>
    <!--Confirm Password :: END-->

    <!--Button :: START-->
    <div class="form-group">
        <div class="col-sm-offset-6 col-sm-6">
            <input type="submit" class="btn btn-warning"  id="mechanic_create" name="mechanic_create" value="Create"/>
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
            $('#mechanic_selected_services').html(response);
            return true;
        });
    }
    //States
    function getCountryState(intCountry) {
        var objCountry = '';
        objCountry = {
            country_type: intCountry
        };

        $.post('<?php echo Yii::app()->params['webURL'] . '/User/User/states'; ?>', objCountry, function (response) {
            $('#mechanic_shop_state').html(response);
            return true;
        });
    }

    //Cities
    function getStateCity(intState) {
        var objState = '';
        objState = {
            state_type: intState
        };

        $.post('<?php echo Yii::app()->params['webURL'] . '/User/User/cities'; ?>', objState, function (response) {
            $('#mechanic_shop_city').html(response);
            return true;
        });
    }

    //Areas
    function getCityArea(intCity) {
        var objArea = '';
        objArea = {
            city_type: intCity
        };

        $.post('<?php echo Yii::app()->params['webURL'] . '/User/User/areas'; ?>', objArea, function (response) {
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
