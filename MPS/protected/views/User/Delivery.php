
<ul class="nav nav-tabs" role="tablist">
    <li class="active">
        <a href="<?php echo Yii::app()->params['webURL'] . 'User/User/CreateDeliveryBoys'; ?>">Create Delivery Boy</a>
    </li>
    <li>
        <a href="<?php echo Yii::app()->params['webURL'] . 'User/User/DeliveryBoysReport'; ?>">Report</a>
    </li>
</ul>
<br/>
<form class="form-horizontal lcns  userreg-form" id="delshop" method="POST"  enctype="multipart/form-data">

    <!-- START :: Display Success Message-->
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
    <div class="row"><h3 class="col-sm-12">Delivery Boy Creation</h3></div>    
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Mechanic Shops</label>
            <div class="col-md-6">
                <select name="mechanic_shop" id="mechanic_shop">
                    <option value="">--Select Shop--</option>
                    <?php
                    if (!empty($mechanic_shops)) {
                        foreach ($mechanic_shops as $arrShop) {
                            ?>
                            <option value='<?php echo $arrShop['id']; ?>'>
                                <?php
                                echo $arrShop['shop_name'] . ' ::' . ' ( ' . $arrShop['shop_code'] . ' ) ::' . ' ( ' . $arrShop['shop_owner'] . ' ) ';
                                ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
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


        <!--Shop Name :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Name</label>
            <div class="col-md-6">
                <input type="text" class="form-control" id="delivery_name" name="delivery_name" value="<?php echo isset($deliveryForm->delivery_name) ? $deliveryForm->delivery_name : NULL; ?>">
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
        </div>
    </div>
    <!--Shop Name :: END-->








    <div class="row">
        <!--Age :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Age</label>
            <div class="col-md-6">
                <input type="text" class="form-control" id="delivery_boy_age" name="delivery_boy_age" value="<?php echo isset($deliveryForm->delivery_boy_age) ? $deliveryForm->delivery_boy_age : NULL; ?>">
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
        </div>
        <!--Age :: END-->
    </div>

    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Address One</label>
            <div class="col-md-6">
                <textarea class="form-control alt" placeholder="Enter address one" name="delivery_address_one" id="delivery_address_one" style="height:120px;"><?php echo isset($deliveryForm->delivery_address_one) ? $deliveryForm->delivery_address_one : NULL; ?></textarea>
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
        <div class="col-md-6">
            <label class="col-md-6 control-label">Address Two</label>
            <div class="col-md-6">
                <textarea class="form-control alt" placeholder="Enter address two." name="delivery_address_two" id="delivery_address_two" style="height:120px;"><?php echo isset($deliveryForm->delivery_address_two) ? $deliveryForm->delivery_address_two : NULL; ?></textarea>
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

    </div>



    <div class="row">
        <!--Address Proof :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Address Proof</label>
            <div class="col-md-6">
                <input type="file" name="delivery_address_proof" id="delivery_address_proof" data-type="image"/>
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
            </div>	
        </div>
        <!--Address Proof :: END-->

        <!--ID Proof :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">ID Proof</label>
            <div class="col-md-6">
                <input type="file" name="delivery_id_proof" id="delivery_id_proof" data-type="image"/>
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
            </div>

        </div>
        <!--ID Proof :: END-->
    </div>
    <div class="row">

        <!--Photo :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Photo</label>
            <div class="col-md-6">
                <input type="file" name="delivery_photo" id="delivery_photo" data-type="image"/>
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
            </div>	
        </div>
        <!--Photo :: END-->
    </div>
    <div class="row">
        <!--Email :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Email</label>
            <div class="col-md-6">
                <input type="email" class="form-control" id="delivery_email" name="delivery_email" value="<?php echo isset($deliveryForm->delivery_email) ? $deliveryForm->delivery_email : NULL; ?>"/>
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

        <!--Contact Number :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Mobile</label>
            <div class="col-md-6">
                <input type="text" class="form-control numeric" id="delivery_contact" name="delivery_contact" minlength="10" maxlength="11" value="<?php echo isset($deliveryForm->delivery_contact) ? $deliveryForm->delivery_contact : NULL; ?>">
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
        <!--Contact Number :: END-->
    </div>



    <!--Mechanic Shop Credentials :: START-->
    <div class="row">
        <h3 class="col-sm-12">Create Account</h3>
    </div>
    <!--Username :: START-->
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Username</label>
            <div class="col-md-6">
                <input type="text" class="form-control" id="delivery_username" name="delivery_username" value="<?php echo isset($deliveryForm->delivery_username) ? $deliveryForm->delivery_username : NULL; ?>"/>
                <?php
                if (isset($errors['delivery_username'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['delivery_username'][0];
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
                <input type="password" class="form-control" id="delivery_password" name="delivery_password">
                <?php
                if (isset($errors['delivery_password'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['delivery_password'][0];
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
                <input type="password" class="form-control" id="delivery_confirm_password" name="delivery_confirm_password">
                <?php
                if (isset($errors['delivery_confirm_password'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['delivery_confirm_password'][0];
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
            <input type="submit" class="btn btn-warning"  id="delivery_create" name="delivery_create" value="Create"/>
        </div>
    </div>
    <!--Button :: END-->

</form>
<script>

    jQuery(document).ready(function ()
    {
        jQuery('.numeric').keyup(function () {
            this.value = this.value.replace(/[^0-9\.]/g, '');
        });
    });

</script>