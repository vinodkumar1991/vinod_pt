<ul class="nav nav-tabs" role="tablist">
    <li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/User/User/CreateDeliveryBoys">Create Delivery Boy</a></li>
    <li class="active"><a href="<?php echo Yii::app()->baseurl; ?>/index.php/User/User/DeliveryBoysReport">Report</a></li>
</ul>
<div class="col-md-4">
    <form class="form-horizontal lcns" method="POST" enctype="multipart/form-data"> 
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
        <!--Shop Name :: START-->
        <div class="form-group">
            <label class="col-sm-2 control-label">Shop Name</label>
            <div class="col-sm-8">
                <?php
                $strExistShopName = isset($delivery_boy_details[0]['shop_name']) ? $delivery_boy_details[0]['shop_name'] : NULL;
                $strFormShopName = isset($deliveryForm->mechanic_shop) ? $deliveryForm->mechanic_shop : NULL;
                $strFinalShipName = !empty($strFormShopName) ? $strFormShopName : $strExistShopName;
                unset($strExistShopName, $strFormShopName);
                ?>
                <input type="text" class="form-control" name="mechanic_shop" id="mechanic_shop" placeholder="Enter ShopName" value="<?php echo $strFinalShipName; ?>">
                <?php
                if (isset($errors['mechanic_shop'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['mechanic_shop'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div> 
        </div> 
        <!--Shop Name :: END-->

        <!--Name :: START-->
        <div class="form-group">
            <label class="col-sm-2 control-label">Name</label>
            <div class="col-sm-8">
                <?php
                $strExistDeliveryBoy = isset($delivery_boy_details[0]['delivery_boy_name']) ? $delivery_boy_details[0]['delivery_boy_name'] : NULL;
                $strFormDeliveryBoy = isset($deliveryForm->delivery_name) ? $deliveryForm->delivery_name : NULL;
                $strFinalDeliveryBoy = !empty($strFormDeliveryBoy) ? $strFormDeliveryBoy : $strExistDeliveryBoy;
                unset($strExistDeliveryBoy, $strFormDeliveryBoy);
                ?>
                <input type="text" class="form-control" name="delivery_name" id="delivery_name" placeholder="Enter Name" value="<?php echo $strFinalDeliveryBoy; ?>">
                <?php
                if (isset($errors['delivery_name'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['delivery_name'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div> 
            <!--Name :: END-->
        </div>

        
         <!--Code :: START-->
        <div class="form-group">
            <label class="col-sm-2 control-label">Code</label>
            <div class="col-sm-8">
                <?php
                $strExistDeliveryCode = isset($delivery_boy_details[0]['delivery_code']) ? $delivery_boy_details[0]['delivery_code'] : NULL;
                $strFormDeliveryCode = isset($deliveryForm->delivery_code) ? $deliveryForm->delivery_code : NULL;
                $strFinalDeliveryCode = !empty($strFormDeliveryCode) ? $strFormDeliveryCode : $strExistDeliveryCode;
                unset($strExistDeliveryCode, $strFormDeliveryCode);
                ?>
                <input type="text" class="form-control" name="delivery_code" id="delivery_code" placeholder="Enter Code" value="<?php echo $strFinalDeliveryCode; ?>">
                <?php
                if (isset($errors['delivery_code'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['delivery_code'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div> 
            <!--Code :: END-->
        </div>
        
        
        <!--Age :: START-->
        <div class="form-group">
            <label class="col-sm-2 control-label">Age</label>
            <div class="col-sm-8">
                <?php
                $intDeliveryAge = isset($delivery_boy_details[0]['age']) ? $delivery_boy_details[0]['age'] : NULL;
                $intFormDeliveryAge = isset($deliveryForm->delivery_boy_age) ? $deliveryForm->delivery_boy_age : NULL;
                $intFinalDeliveryAge = !empty($intFormDeliveryAge) ? $intFormDeliveryAge : $intDeliveryAge;
                unset($intDeliveryAge, $intFormDeliveryAge);
                ?>
                <input type="text" class="form-control" name="delivery_boy_age" id="delivery_boy_age" placeholder="Enter Age" value="<?php echo $intFinalDeliveryAge; ?>">
                <?php
                if (isset($errors['delivery_boy_age'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['delivery_boy_age'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div> 
            <!--Age :: END-->
        </div>

        <!--Email :: START-->
        <div class="form-group">
            <label class="col-sm-2 control-label">Email</label>
            <div class="col-sm-8">
                <?php
                $strExistDeliveryEmail = isset($delivery_boy_details[0]['delivery_boy_email']) ? $delivery_boy_details[0]['delivery_boy_email'] : NULL;
                $strFormDeliveryEemail = isset($deliveryForm->delivery_email) ? $deliveryForm->delivery_email : NULL;
                $strFinalDeliveryEmail = !empty($strFormDeliveryEemail) ? $strFormDeliveryEemail : $strExistDeliveryEmail;
                unset($strExistDeliveryEmail, $strFormDeliveryEemail);
                ?>
                <input type="text" class="form-control" name="delivery_email" id="delivery_email" placeholder="Enter Email" value="<?php echo $strFinalDeliveryEmail; ?>">
                <?php
                if (isset($errors['delivery_email'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['delivery_email'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div> 
        <!--Email :: END-->


        <!--Mobile :: START-->
        <div class="form-group">
            <label class="col-sm-2 control-label">Mobile</label>
            <div class="col-sm-8">
                <?php
                $strExistDeliveryMobile = isset($delivery_boy_details[0]['delivery_boy_phone']) ? $delivery_boy_details[0]['delivery_boy_phone'] : NULL;
                $strFormDeliveryMobile = isset($deliveryForm->delivery_contact) ? $deliveryForm->delivery_contact : NULL;
                $strFinalDeliveyrMobile = !empty($strFormDeliveryMobile) ? $strFormDeliveryMobile : $strExistDeliveryMobile;
                unset($strExistDeliveryMobile, $strFormDeliveryMobile);
                ?>
                <input type="text" class="form-control" name="delivery_contact" id="delivery_contact" placeholder="Enter Mobile Number" value="<?php echo $strFinalDeliveyrMobile; ?>">
                <?php
                if (isset($errors['delivery_contact'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['delivery_contact'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div> 
        <!--Mobile :: END-->

        <!--Address One :: START-->
        <div class="form-group">
            <label class="col-sm-2 control-label">Address One</label>
            <div class="col-sm-8">
                <?php
                $strExistDeliveryAddressOne = isset($delivery_boy_details[0]['address_one']) ? $delivery_boy_details[0]['address_one'] : NULL;
                $strFormDeliveryAddressOne = isset($deliveryForm->delivery_address_one) ? $deliveryForm->delivery_address_one : NULL;
                $strFinalDeliveryAddressOne = !empty($strFormDeliveryAddressOne) ? $strFormDeliveryAddressOne : $strExistDeliveryAddressOne;
                unset($strExistDeliveryAddressOne, $strFormDeliveryAddressOne);
                ?>
                <input type="text" class="form-control" name="delivery_address_one" id="delivery_address_one" placeholder="Enter Address One" value="<?php echo $strFinalDeliveryAddressOne; ?>">
                <?php
                if (isset($errors['delivery_address_one'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['delivery_address_one'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div> 
        <!--Address One :: END-->

        <!--Address Two :: START-->
        <div class="form-group">
            <label class="col-sm-2 control-label">Address Two</label>
            <div class="col-sm-8">
                <?php
                $strExistDeliveryAddressTwo = isset($delivery_boy_details[0]['address_two']) ? $delivery_boy_details[0]['address_two'] : NULL;
                $strFormDeliveryAddressTwo = isset($deliveryForm->delivery_address_two) ? $deliveryForm->delivery_address_two : NULL;
                $strFinalDeliveryAddressTwo = !empty($strFormDeliveryAddressTwo) ? $strFormDeliveryAddressTwo : $strExistDeliveryAddressTwo;
                ?>
                <input type="text" class="form-control" name="delivery_address_two" id="delivery_address_two" placeholder="Enter Address Two" value="<?php echo $strFinalDeliveryAddressTwo; ?>">
                <?php
                if (isset($errors['delivery_address_two'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['delivery_address_two'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div> 
        <!--Address Two :: END-->

        <!--Address Proof :: START-->
        <div class="form-group">
            <label class="col-sm-2 control-label">Address Proof</label>
            <div class="col-sm-8">
                <input type="file" class="form-control" name="delivery_address_proof" id="delivery_address_proof"/>
                <?php
                if (isset($errors['delivery_address_proof'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['delivery_address_proof'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
                <img style="width:50px;height:50px;" src="<?php echo Yii::app()->params['adminImgURL'] . '/delivery_boys/address/original/' . $delivery_boy_details[0]['address_proof_path']; ?>"/>
            </div>
        </div> 
        <!--Address Proof :: END-->

        <!--ID Proof :: START-->
        <div class="form-group">
            <label class="col-sm-2 control-label">ID Proof</label>
            <div class="col-sm-8">
                <input type="file" class="form-control" name="delivery_id_proof" id="delivery_id_proof"/>
                <?php
                if (isset($errors['delivery_id_proof'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['delivery_id_proof'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
                <img style="width:50px;height:50px;" src="<?php echo Yii::app()->params['adminImgURL'] . '/delivery_boys/id_proofs/original/' . $delivery_boy_details[0]['driving_license_path']; ?>"/>
            </div>
        </div> 
        <!--ID Proof :: END-->


        <!--Photos :: START-->
        <div class="form-group">
            <label class="col-sm-2 control-label">Photos</label>
            <div class="col-sm-8">
                <input type="file" class="form-control" name="delivery_photo" id="delivery_photo"/>
                <?php
                if (isset($errors['delivery_photo'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['delivery_photo'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
                <img style="width:50px;height:50px;" src="<?php echo Yii::app()->params['adminImgURL'] . '/delivery_boys/photo/original/' . $delivery_boy_details[0]['photo_path']; ?>"/>
            </div>
        </div> 
        <!--Photos :: END-->

        <!--Status :: START-->
        <div class="form-group">
            <?php
            if (isset($delivery_boy_details[0]['status']) && 1 == $delivery_boy_details[0]['status']) {
                $strExistDeliveryStatus = 1;
            } elseif (isset($delivery_boy_details[0]['status']) && 0 == $delivery_boy_details[0]['status']) {
                $strExistDeliveryStatus = 0;
            }
            $strFormDeliveryStatus = isset($deliveryForm->delivery_status) ? $deliveryForm->delivery_status : NULL;
            if (0 == $strExistDeliveryStatus) {
                $strFinalDeliveryStatus = 0;
            } else {
                $strFinalDeliveryStatus = !empty($strExistDeliveryStatus) ? $strExistDeliveryStatus : $strFormDeliveryStatus;
            }
            ?>
            <label class="col-sm-2 control-label">Status</label>
            <div class="col-sm-8">
                <select name="delivery_status" id="delivery_status">
                    <option value="">--Select Status--</option>
                    <option value="1" <?php
                    if (isset($strFinalDeliveryStatus) && 1 == $strFinalDeliveryStatus) {
                        echo 'selected ';
                    }
                    ?>
                            >Active
                    </option>
                    <option value="0"
                    <?php
                    if (isset($strFinalDeliveryStatus) && 0 == $strFinalDeliveryStatus) {
                        echo 'selected';
                        ?>
                    <?php } ?>
                            >Inactive</option>
                </select>
            </div>
            <?php
            if (isset($errors['delivery_status'][0])) {
                ?>
                <span id="vmodelerr" style="color:red;">
                    <?php
                    echo $errors['delivery_status'][0];
                    ?>
                </span>
                <?php
            }
            ?>
        </div> 
        <!--Status :: END-->

        <!--Button :: START-->

        <div class="col-md-offset-4 col-md-4">                                
            <div class="form-group">
                <input type="submit" class="btn btn-warning"   id="update_delivery_boys" name="update_delivery_boys" value="Update"/>
                &emsp;
                <a href="<?php echo Yii::app()->baseurl . '/index.php/User/User/DeliveryBoysReport'; ?>">Back</a>
            </div> 
        </div> 


        <!--Button :: END-->
    </form> 
</div> 
