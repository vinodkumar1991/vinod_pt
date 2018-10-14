<?php
$isHaveValue = Yii::app()->request->getQueryString();
$isHaveValue = !empty($isHaveValue) ? $isHaveValue : 0;
?>
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

    <div class="row">
        <!--Name :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Agency Name</label>
            <div class="col-md-6">
                <?php
                $strFormAgencyName = isset($agentUpdateForm->agency_name) ? $agentUpdateForm->agency_name : NULL;
                $strEditAgencyName = isset($agent_details[0]['agency_name']) ? $agent_details[0]['agency_name'] : NULL;
                $strFinalAgencyName = isset($strFormAgencyName) ? $strFormAgencyName : $strEditAgencyName;
                ?>
                <input type="text" class="form-control" id="agency_name" name="agency_name"value="<?php echo $strFinalAgencyName; ?>">
                <?php
                if (isset($errors['agency_name'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['agency_name'][0];
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
                <?php
                $strEditAgentOwner = isset($agent_details[0]['agent_owner']) ? $agent_details[0]['agent_owner'] : NULL;
                $strFormAgentOwner = isset($agentUpdateForm->agent_owner) ? $agentUpdateForm->agent_owner : NULL;
                $strFinalAgentOwner = isset($strFormAgentOwner) ? $strFormAgentOwner : $strEditAgentOwner;
                ?>
                <input type="text" class="form-control" id="agent_owner" name="agent_owner" value="<?php echo $strFinalAgentOwner; ?>">
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
        
        <!-- Code :: START -->
        
          <div class="col-md-6">
            <label class="col-md-6 control-label">Agency Code</label>
            <div class="col-md-6">
                <?php
                $strFormAgencyCode = isset($agentUpdateForm->agent_code) ? $agentUpdateForm->agent_code : NULL;
                $strEditAgencyCode = isset($agent_details[0]['agent_code']) ? $agent_details[0]['agent_code'] : NULL;
                $strFinalAgencyCode = isset($strFormAgencyCode) ? $strFormAgencyCode : $strEditAgencyCode;
                ?>
                <input type="text" class="form-control" id="agent_code" name="agent_code"value="<?php echo $strFinalAgencyCode; ?>">
                <?php
                if (isset($errors['agent_code'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['agent_code'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        
        <!-- Code :: END -->
        <!--Country :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Country</label>
            <div class="col-md-6">

                <select name="agent_country" id="agent_country" class="form-control" onChange="getCountryState(this.value)">
                    <option value="">--Select Country--</option>
                    <?php
                    if (!empty($countries)) {

                        foreach ($countries as $arrCountry) {
                            if ($arrCountry['country_id'] == $agent_details[0]['agent_country_id']) {
                                ?>
                                <option value="<?php echo $arrCountry['country_id']; ?>" selected="selected"><?php echo $arrCountry['country_name']; ?></option>
                                <?php
                            } else {
                                ?>
                                <option value="<?php echo $arrCountry['country_id']; ?>"><?php echo $arrCountry['country_name']; ?></option>
                                <?php
                            }
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
                    <?php
                    if (!empty($agent_states)) {
                        foreach ($agent_states as $arrState) {
                            if ($agent_details[0]['agent_state_id'] == $arrState['state_id']) {
                                ?>
                                <option value="<?php echo $arrState['state_id']; ?>" selected="selected"><?php echo $arrState['state_name']; ?></option>
                                <?php
                            } else {
                                ?>
                                <option value="<?php echo $arrState['state_id']; ?>"><?php echo $arrState['state_name']; ?></option>
                                <?php
                            }
                        }
                    }
                    ?>
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
                    <?php
                    if (!empty($agent_cities)) {
                        foreach ($agent_cities as $arrCity) {
                            if ($agent_details[0]['agent_city_id'] == $arrCity['city_id']) {
                                ?>
                                <option value="<?php echo $arrCity['city_id']; ?>" selected="selected"><?php echo $arrCity['city_name']; ?></option>
                                <?php
                            } else {
                                ?>
                                <option value="<?php echo $arrCity['city_id']; ?>"><?php echo $arrCity['city_name']; ?></option>
                                <?php
                            }
                        }
                    }
                    ?>

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
                    <?php
                    if (!empty($agent_areas)) {
                        foreach ($agent_areas as $arrArea) {
                            if ($agent_details[0]['agent_area_id'] == $arrArea['area_id']) {
                                ?>
                                <option value="<?php echo $arrArea['area_id']; ?>" selected="selected"><?php echo $arrArea['area_name']; ?></option>
                                <?php
                            } else {
                                ?>
                                <option value="<?php echo $arrArea['area_id']; ?>"><?php echo $arrArea['area_name']; ?></option>
                                <?php
                            }
                        }
                    }
                    ?>
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
                <?php
                $strEditAgentAddress = isset($agent_details[0]['agent_address']) ? $agent_details[0]['agent_address'] : NULL;
                $strFormAgentAddress = isset($agentUpdateForm->agent_address) ? $agentUpdateForm->agent_address : NULL;
                $strFinalAgentAddress = isset($strFormAgentAddress) ? $strFormAgentAddress : $strEditAgentAddress;
                ?>
                <textarea class="form-control" name="agent_address" placeholder="Enter Address"><?php echo $strFinalAgentAddress; ?></textarea>
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
                <?php
                $strEditAgentPincode = isset($agent_details[0]['agent_pincode']) ? $agent_details[0]['agent_pincode'] : NULL;
                $strFormAgentPincode = isset($agentUpdateForm->agent_pincode) ? $agentUpdateForm->agent_pincode : NULL;
                $strFinalAgentPincode = isset($strFormAgentPincode) ? $strFormAgentPincode : $strEditAgentPincode;
                ?>
                <input type="text" class="form-control number-only" id="agent_pincode" name="agent_pincode" maxlength="6" value="<?php echo $strFinalAgentPincode; ?>">
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
                <?php
                $strEditAgentEmail = isset($agent_details[0]['agent_email']) ? $agent_details[0]['agent_email'] : NULL;
                $strFormAgentEmail = isset($agentUpdateForm->agent_email) ? $agentUpdateForm->agent_email : NULL;
                $strFinalAgentEmail = isset($strFormAgentEmail) ? $strFormAgentEmail : $strEditAgentEmail;
                ?>
                <input type="email" id="agent_email" name="agent_email" class="form-control" value="<?php echo $strFinalAgentEmail; ?>">
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
                <?php
                $strEditAgentPhone = isset($agent_details[0]['agent_phone']) ? $agent_details[0]['agent_phone'] : NULL;
                $strFormAgentPhone = isset($agentUpdateForm->agent_phone) ? $agentUpdateForm->agent_phone : NULL;
                $strFinalAgentPhone = isset($strFormAgentPhone) ? $strFormAgentPhone : $strEditAgentPhone;
                ?>
                <input type="text" name="agent_phone" id="agent_phone"  class="form-control number-only" maxlength="10" value="<?php echo $strEditAgentPhone; ?>">
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
                <?php
                $strEditAgentLandline = isset($agent_details[0]['agent_landline']) ? $agent_details[0]['agent_landline'] : NULL;
                $strFormAgentLandline = isset($agentUpdateForm->agent_landline) ? $agentUpdateForm->agent_landline : NULL;
                $strFinalAgentLandline = isset($strFormAgentLandline) ? $strFormAgentLandline : $strEditAgentLandline;
                ?>
                <input type="text" name="agent_landline" id="agent_landline"  class="form-control number-only" maxlength="15" value="<?php echo $strFinalAgentLandline; ?>">
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
                <img style="width:50px;height:50px;" src="<?php echo Yii::app()->params['adminImgURL'] . '/selfdrive/agents/id_proofs/original/' . $agent_details[0]['id_image']; ?>"/>
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
                <img style="width:50px;height:50px;" src="<?php echo Yii::app()->params['adminImgURL'] . '/selfdrive/agents/photo/original/' . $agent_details[0]['agent_photo']; ?>"/>
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
                <img style="width:50px;height:50px;" src="<?php echo Yii::app()->params['adminImgURL'] . '/selfdrive/agents/address/original/' . $agent_details[0]['address_image']; ?>"/>
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
                <img style="width:50px;height:50px;" src="<?php echo Yii::app()->params['adminImgURL'] . '/selfdrive/agents/registration/original/' . $agent_details[0]['register_image']; ?>"/> 
            </div>
        </div>
        <!--Registration Certificate :: END-->
        <!--Location :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Location</label>
            <div class="col-md-6">
                <?php
                $strEditAgentLocation = isset($agent_details[0]['agent_location']) ? $agent_details[0]['agent_location'] : NULL;
                ?>
                <input type="text" class="form-control geocomplete" name="agent_location" id="agent_location" value="<?php echo $strEditAgentLocation; ?>" >
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
    <!--Button :: START-->
    <div class="form-group">
        <div class="col-sm-offset-6 col-sm-6">
            <input type="submit" class="btn btn-warning" id="update_agent" name="update_agent" value="Update"/>
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
    function getCountryState(intCountry, selectedText) {
        var objCountry = '';
        objCountry = {
            country_type: intCountry

        };
        $.post('<?php echo Yii::app()->params['webURL'] . '/User/User/states'; ?>', objCountry, function (response) {
            $('#agent_state').html();
            $('#agent_state').html(response);
            return true;
        });
    }

    //Cities
    function getStateCity(intState, selectedText) {
        var objState = '';
        objState = {
            state_type: intState
        };

        $.post('<?php echo Yii::app()->params['webURL'] . '/User/User/cities'; ?>', objState, function (response) {
            $('#agent_city').html();
            $('#agent_city').html(response);
            return true;
        });
    }

    //Areas

    function getCityArea(intCity, selectedText) {
        var objArea = '';
        objArea = {
            state_type: intCity
        };

        $.post('<?php echo Yii::app()->params['webURL'] . '/User/User/areas'; ?>', objArea, function (response) {
            $('#agent_area').html();
            $('#agent_area').html(response);
            return true;
        });
    }
    //Edit Data : END
</script>



