<!--Google Address :: START-->
<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
<script src="<?php echo Yii::app()->params['assets_url'] . 'js/jquery.geocomplete.js'; ?>"></script>
<script src="<?php echo Yii::app()->params['assets_url'] . 'js/locationpicker.jquery.min.js'; ?>"></script>
<!--Google Address :: END-->
<ul class="nav nav-tabs" role="tablist">
    <li class="active">
        <a href="<?php echo Yii::app()->params['webURL'] . 'SelfDrive/Agent/Create'; ?>">Create Agent</a>
    </li>
    <li>
        <a href="<?php echo Yii::app()->params['webURL'] . 'SelfDrive/Agent/AgentsReport'; ?>">Agent Report</a>
    </li>
</ul>
<form id="agent_form" name="agent_form" method="POST" enctype="multipart/form-data" class="form-horizontal">
    <div class="row">
        <h3 class="col-sm-12">
            Agent Details
        </h3>
    </div>

    <!--Messages :: START-->
    <?php
    if (!empty($message)) {
        ?>
        <font color="green"><div id="message">
            <?php
            echo isset($message) ? $message : NULL;
            ?>
        </div></font>
        <?php
    }
    ?>
    <!--Messages :: END-->

    <div class="row">
        <!--Name :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Agency Name</label>
            <div class="col-md-6">
                <input type="text" class="form-control" id="agent_name" name="agent_name">
                <?php
                if (isset($errors['agent_name'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['agent_name'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--Name :: END-->

        <!--Owner :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Owner</label>
            <div class="col-md-6">
                <input type="text" class="form-control" id="agent_owner" name="agent_owner">
                <?php
                if (isset($errors['agent_owner'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['agent_owner'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--Owner :: END-->

        <!--Country :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Country</label>
            <div class="col-md-6">
                <select name="agent_country" id="agent_country" class="form-control" onChange="getCountryState(this.value)">
                    <option value="">--Select Country--</option>
                    <?php
                    if (!empty($countries)) {
                        
                        foreach ($countries as $arrCountry) {
                            ?>
                            <option value="<?php echo $arrCountry['country_id']; ?>"><?php echo $arrCountry['country_name']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
                <?php
                if (isset($errors['agent_country'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['agent_country'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--Country :: END-->
        <!--State :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">State</label>
            <div class="col-md-6">
                <select name="agent_state" id="agent_state" class="form-control" onChange="getStateCity(this.value)">
                    <option value="">--Select State--</option>
                </select>
                <?php
                if (isset($errors['agent_state'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['agent_state'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--State :: END-->
        <!--City :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">City</label>
            <div class="col-md-6">
                <select name="agent_city" id="agent_city" class="form-control" onChange="getCityArea(this.value)">
                    <option value="">--Select City--</option>
                </select>
                <?php
                if (isset($errors['agent_city'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['agent_city'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--City :: END-->        
        <!--Area :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Area</label>
            <div class="col-md-6">
                <select name="agent_area" id="agent_area" class="form-control">
                    <option value="">--Select Area--</option>
                </select>
                <?php
                if (isset($errors['agent_area'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['agent_area'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--Area :: END-->
        <!--Agent Address :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Address</label>
            <div class="col-md-6">
                <textarea class="form-control" name="agent_address" placeholder="Enter Address"></textarea>
                <?php
                if (isset($errors['agent_address'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['agent_address'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--Agent Address :: END-->
        <!--Pincode :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Zip Code</label>
            <div class="col-md-6">
                <input type="text" class="form-control number-only" id="agent_pincode" name="agent_pincode" maxlength="6">
                <?php
                if (isset($errors['agent_pincode'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['agent_pincode'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--Pincode :: END-->       

        <!--Email :: START-->
        <div class="col-md-6" style="clear: both;">
            <label class="col-md-6 control-label">Email</label>
            <div class="col-md-6">
                <input type="email" id="agent_email" name="agent_email" class="form-control">
                <?php
                if (isset($errors['agent_email'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['agent_email'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>	
        <!--Email :: END-->        

        <!--Phone :: START-->
        <div class="col-md-6" style="clear: both;">
            <label class="col-md-6 control-label">Phone</label>
            <div class="col-md-6">
                <input type="text" name="agent_phone" id="agent_phone"  class="form-control number-only" maxlength="10">
                <?php
                if (isset($errors['agent_phone'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['agent_phone'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>

        </div>
        <!--Phone :: END-->

        <!--Landline :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Landline</label>
            <div class="col-md-6">
                <input type="text" name="agent_landline" id="agent_landline"  class="form-control number-only" maxlength="15">
                <?php
                if (isset($errors['agent_landline'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['agent_landline'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>

        </div>
        <!--Landline :: End-->
        
    </div>

    <div class="row">
        <!--ID Proof :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">ID Proof</label>
            <div class="col-md-6">
                <input type="file" name="agent_id_proof" id="agent_id_proof" class="form-control"/>
                <?php
                if (isset($errors['agent_id_proof'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['agent_id_proof'][0];
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
                <input type="file" name="agent_photo" id="agent_photo" class="form-control"/>
                <?php
                if (isset($errors['agent_photo'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['agent_photo'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--Photo :: END-->
        <!--Address Proof :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Address Proof</label>
            <div class="col-md-6">
                <input type="file" name="agent_address_proof" id="agent_address_proof" class="form-control"/>
                <?php
                if (isset($errors['agent_address_proof'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['agent_address_proof'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--Address Proof :: END-->
        <!--Registration Certificate :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Registration Certificate</label>
            <div class="col-md-6">
                <input type="file" name="agent_registration_certificate" class="form-control" id="agent_registration_certificate"/>
                <?php
                if (isset($errors['agent_registration_certificate'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['agent_registration_certificate'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--Registration Certificate :: END-->
        <!--Location :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Location</label>
            <div class="col-md-6">
                <input type="text" class="form-control geocomplete" name="agent_location" id="agent_location" />
                <input type="hidden" class="form-control" name="location"/>
                <?php
                if (isset($errors['agent_location'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['agent_location'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>

            </div>
        </div>
        <!--Location :: END-->
    </div>


    <div class="row">
        <h3 class="col-sm-12">Account Details</h3>
    </div>
    <div class="row">
        <!--Username :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Username</label>
            <div class="col-md-6">
                <input type="text" name="agent_username" id="agent_username" class="form-control">
                <?php
                if (isset($errors['agent_username'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['agent_username'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>

        </div>
        <!--Username :: END-->

        <!--Password :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Password</label>
            <div class="col-md-6">
                <input type="password" id="agent_password" name="agent_password" class="form-control">
                <?php
                if (isset($errors['agent_password'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['agent_password'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--Password :: END-->
        <!--Confirm Password :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Confirm Password</label>
            <div class="col-md-6">
                <input type="password" id="agent_confirm_password" name="agent_confirm_password" class="form-control">
                <?php
                if (isset($errors['agent_confirm_password'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['agent_confirm_password'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--Confirm Password :: END-->
    </div>
    <!--Button :: START-->
    <div class="form-group">
        <div class="col-sm-offset-6 col-sm-6">
            <input type="submit" class="btn btn-warning" id="create_agent" name="create_agent" value="Create"/>
        </div>
    </div>
    <!--Button :: END-->
</form>

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

<script type='text/javascript'>
    //States
    function getCountryState(intCountry) {
        var objCountry = '';
        objCountry = {
            country_type: intCountry
            
        };

        $.post('<?php echo Yii::app()->params['webURL'] . '/User/User/states'; ?>', objCountry, function (response) {
            $('#agent_state').html(response);
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
            $('#agent_city').html(response);
            return true;
        });
    }

    //Areas
    function getCityArea(intCity) {
        var objArea = '';
        objArea = {
            state_type: intCity
        };

        $.post('<?php echo Yii::app()->params['webURL'] . '/User/User/areas'; ?>', objArea, function (response) {
            $('#agent_area').html(response);
            return true;
        });
    }
</script>
