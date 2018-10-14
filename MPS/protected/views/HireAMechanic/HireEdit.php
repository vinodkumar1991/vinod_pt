<!--Google Address :: START-->
<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
<script src="<?php echo Yii::app()->params['assets_url'] . 'js/jquery.geocomplete.js'; ?>"></script>
<script src="<?php echo Yii::app()->params['assets_url'] . 'js/locationpicker.jquery.min.js'; ?>"></script>
<!--Google Address :: END-->

<ul class="nav nav-tabs" role="tablist">
    <li class="active">
        <a href="<?php echo Yii::app()->params['webURL'] . 'SelfDrive/Agent/Create1'; ?>">Create</a>
    </li>
    <li>
        <a href="<?php echo Yii::app()->params['webURL'] . 'SelfDrive/Agent/HireReport'; ?>">Report</a>
    </li>
</ul>

<form id="hire_form" name="hire_form" method="POST" enctype="multipart/form-data">
    <div class="row">
        <h3 class="col-sm-12">
            Hire Mechanic 
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
            <label class="col-md-6 control-label">Name</label>
            <div class="col-md-6">
                <?php
                $strFormHireName = isset($hireForm->hire_name) ? $hireForm->hire_name : NULL;
                $strExistHireName = isset($hire_details[0]['first_name']) ? $hire_details[0]['first_name'] : NULL;
                $strFinalHireName = !empty($strFormHireName) ? $strFormHireName : $strExistHireName;
                unset($strFormHireName, $strExistHireName);
                ?>
                <input type="text" class="form-control" id="hire_name" name="hire_name" value="<?php echo $strFinalHireName; ?>"/>
                <?php
                if (isset($errors['hire_name'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['hire_name'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--Name :: END-->

        <!--Vehicle Type :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Vehicle Type</label>
            <div class="col-md-6">
                <?php
                $strFormVehicleId = isset($hireForm->hire_vehicle_id) ? $hireForm->hire_vehicle_id : NULL;
                $strExistVehicleId = isset($hire_details[0]['vehicle_id']) ? $hire_details[0]['vehicle_id'] : NULL;
                $strFinalVehicleId = !empty($strFormVehicleId) ? $strFormVehicleId : $strExistVehicleId;
                unset($strFormVehicleId, $strExistVehicleId);
                ?>
                <select name="hire_vehicle_id" id="hire_vehicle_id">
                    <option value="">--Select Vehicle Type--</option>
                    <?php
                    if ($vehicles) {
                        foreach ($vehicles as $arrVehicle) {
                            if ($arrVehicle['id'] == $strFinalVehicleId) {
                                ?>
                                <option value="<?php echo $arrVehicle['id']; ?>" selected="true"><?php echo $arrVehicle['name']; ?></option>
                                <?php
                            } else {
                                ?>
                                <option value="<?php echo $arrVehicle['id']; ?>"><?php echo $arrVehicle['name']; ?></option>
                                <?php
                            }
                        }
                    }
                    ?>
                </select>
                <?php
                if (isset($errors['hire_vehicle_id'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['hire_vehicle_id'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--Vehicle Type :: END-->
    </div>

    
    <!--Code :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Code</label>
            <div class="col-md-6">
                <?php
                $strFormHireCode = isset($hireForm->hire_code) ? $hireForm->hire_code : NULL;
                $strExistHireCode = isset($hire_details[0]['hire_code']) ? $hire_details[0]['hire_code'] : NULL;
                $strFinalHireCode = !empty($strFormHireCode) ? $strFormHireCode : $strExistHireCode;
                unset($strFormHireCode, $strExistHireCode);
                ?>
                <input type="text" class="form-control" id="hire_code" name="hire_code" value="<?php echo $strFinalHireCode; ?>"/>
                <?php
                if (isset($errors['hire_code'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['hire_code'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--code :: END-->
    

    <div class="row">
        <!--Permanent Address :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Permanent Address</label>
            <div class="col-md-6">
                <?php
                $strFormPermanentAddress = isset($hireForm->hire_permanent_address) ? $hireForm->hire_permanent_address : NULL;
                $strExistPermanentAddress = isset($hire_details[0]['permenant_address']) ? $hire_details[0]['permenant_address'] : NULL;
                $strFinalPermanentAddress = !empty($strFormPermanentAddress) ? $strFormPermanentAddress : $strExistPermanentAddress;
                unset($strFormPermanentAddress, $strExistPermanentAddress);
                ?>
                <textarea class="form-control" name="hire_permanent_address" id="hire_permanent_address" placeholder="Enter Address"><?php echo $strFinalPermanentAddress; ?></textarea>
                <?php
                if (isset($errors['hire_permanent_address'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['hire_permanent_address'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--Permanent Addresss :: END-->

        <!--Present Address :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Present Address</label>
            <div class="col-md-6">
                <?php
                $strFormPresentAddress = isset($hireForm->hire_present_address) ? $hireForm->hire_present_address : NULL;
                $strExistPresentAddress = isset($hire_details[0]['present_address']) ? $hire_details[0]['present_address'] : NULL;
                $strFinalPresentAddress = !empty($strFormPresentAddress) ? $strFormPresentAddress : $strExistPresentAddress;
                unset($strFormPresentAddress, $strExistPresentAddress);
                ?>
                <textarea class="form-control" name="hire_present_address" id="hire_present_address" placeholder="Enter Address"><?php echo $strFinalPresentAddress; ?></textarea>
                <?php
                if (isset($errors['hire_present_address'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['hire_present_address'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--Present Address :: END-->
    </div>

    <div class="row">


        <!--Location :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Location</label>
            <div class="col-md-6">
                <?php
                $strFormLocation = isset($hireForm->hire_location) ? $hireForm->hire_location : NULL;
                $strExistLocation = isset($hire_details[0]['hire_location']) ? $hire_details[0]['hire_location'] : NULL;
                $strFinalLocation = !empty($strFormLocation) ? $strFormLocation : $strExistLocation;
                unset($strFormLocation, $strExistLocation);
                ?>
                <input type="text" class="form-control geocomplete" name="hire_location" id="hire_location" value="<?php echo $strFinalLocation; ?>"/>
                <input type="hidden" class="form-control" name="location"/>
                <?php
                if (isset($errors['hire_location'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['hire_location'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--Location :: END-->
        <!--Description :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Description</label>
            <div class="col-md-6">
                <?php
                $strFormDescription = isset($hireForm->hire_description) ? $hireForm->hire_description : NULL;
                $strExistDescription = isset($hire_details[0]['hire_description']) ? $hire_details[0]['hire_description'] : NULL;
                $strFinalDescription = !empty($strFormDescription) ? $strFormDescription : $strExistDescription;
                unset($strFormDescription, $strExistDescription);
                ?>
                <textarea class="form-control" name="hire_description" id="hire_description"><?php echo $strFinalDescription; ?></textarea>
                <?php
                if (isset($errors['hire_description'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['hire_description'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--Description :: END-->

    </div>


    <div class="row">
        <!--Email :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Email</label>
            <div class="col-md-6">
                <?php
                $strFormEmail = isset($hireForm->hire_email) ? $hireForm->hire_email : NULL;
                $strExistEmail = isset($hire_details[0]['hire_email']) ? $hire_details[0]['hire_email'] : NULL;
                $strFinalEmail = !empty($strFormEmail) ? $strFormEmail : $strExistEmail;
                unset($strFormEmail, $strExistEmail);
                ?>
                <input type="email" id="hire_email" name="hire_email" class="form-control" value="<?php echo $strFinalEmail; ?>"/>
                <?php
                if (isset($errors['hire_email'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['hire_email'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--Email :: END-->

        <!--Phone :: END-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Phone</label>
            <div class="col-md-6">
                <?php
                $strFormPhone = isset($hireForm->hire_phone) ? $hireForm->hire_phone : NULL;
                $strExistPhone = isset($hire_details[0]['hire_phone']) ? $hire_details[0]['hire_phone'] : NULL;
                $strFinalPhone = !empty($strFormPhone) ? $strFormPhone : $strExistPhone;
                unset($strFormPhone, $strExistPhone);
                ?>
                <input type="text" name="hire_phone" id="hire_phone"  class="form-control number-only" maxlength="10" value="<?php echo $strFinalPhone; ?>">
                <?php
                if (isset($errors['hire_phone'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['hire_phone'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--Phone :: END-->

    </div>


    <div class="row">
        <!--ID Proof :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">ID Proof</label>
            <div class="col-md-6">
                <input type="file" name="hire_id_proof" id="hire_id_proof"/>
                <?php
                if (isset($errors['hire_id_proof'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['hire_id_proof'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
                <img style="width:50px;height:50px;" src="<?php echo Yii::app()->params['adminImgURL'] . '/hireamechanic/id_proofs/original/' . $hire_details[0]['hire_id_image']; ?>"/>
            </div>
        </div>
        <!--ID Proof :: END-->

        <!--Certificate :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Certificates</label>
            <div class="col-md-6">
                <input type="file" name="hire_certificates[]" id="hire_certificates" multiple/>
                <?php
                if (isset($errors['hire_certificates'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['hire_certificates'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
                <?php
                if (!empty($hire_certificates)) {
                    foreach ($hire_certificates as $arrCertificate) {
                        ?>
                        <img style="width:50px;height:50px;" src="<?php echo Yii::app()->params['adminImgURL'] . '/hireamechanic/certificates/original/' . $arrCertificate['image_name']; ?>"/>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <!--Certificate :: END-->
    </div>

    <div class="row">
        <!--Photo :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Photo</label>
            <div class="col-md-6">
                <input type="file" name="hire_photo" id="hire_photo"/>
                <?php
                if (isset($errors['hire_photo'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['hire_photo'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
                <img style="width:50px;height:50px;" src="<?php echo Yii::app()->params['adminImgURL'] . '/hireamechanic/photo/60X35/' . $hire_details[0]['hire_image']; ?>"/>
            </div>
        </div>
        <!--Photo :: END-->

        <!--Address :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Address Proof</label>
            <div class="col-md-6">
                <input type="file" id="hire_address_proof" name="hire_address_proof">
                <?php
                if (isset($errors['hire_address_proof'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['hire_address_proof'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
                <img style="width:50px;height:50px;" src="<?php echo Yii::app()->params['adminImgURL'] . '/hireamechanic/address/original/' . $hire_details[0]['hire_address_image']; ?>"/>
            </div>
        </div>
        <!--Address :: END-->
    </div>

    <!--Button :: START-->
    <div class="form-group">
        <div class="col-sm-offset-6 col-sm-6">
            <input type="submit" class="btn btn-warning" id="update_hire" name="update_hire" value="Update"/>
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
