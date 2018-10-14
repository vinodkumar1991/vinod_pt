<!--Google Address :: START-->
<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/jquery.geocomplete.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/dist/locationpicker.jquery.min.js"></script>
<!--Google Address :: END-->

<!-- TAB SECTION-->
<ul class="nav nav-tabs" role="tablist">
    <li class="active"><a href="javascript:void(0);">Create Modification Shop</a></li>
        <li><a href="<?php echo Yii::app()->params['webURL'].'Modifications/ModificationShop/ManageModificationShop'?>">Modification Shops Report</a></li>
    </ul>

<form class="form-horizontal 6 lcns modification userreg-form" method="POST" action="" enctype="multipart/form-data">
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
<div class="row"><h3 class="col-sm-12">Modification Shop Details</h3></div>
	<div class="row">
		<div class="col-md-6">
		<label class="col-md-6 control-label">Choose Vehicle</label>
			<div class="col-md-6">
                            <select name="vehicle_type" onchange="getVehicleBrand(this.value)">
                                    <option value="">--Select Vehicle Type--</option>
                                    <?php
                                        if (!empty($arrVehicles)) {
                                            foreach ($arrVehicles as $arrVehicle) {
                                                ?>
                                                <option value='<?php echo $arrVehicle['id']; ?>'>
                                                    <?php echo isset($arrVehicle['name']) ? $arrVehicle['name'] : NULL; ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                        ?>
				</select>
                            <?php if(isset($arrErrors['vehicle_type'][0])){ ?>
                                <span id="vtypeErr" style="color: red;"><?php echo $arrErrors['vehicle_type'][0]?></span>
                            <?php }?>
			</div>
		</div>
	</div>
	<div class="row">	
		<div class="col-md-6">
		<label class="col-md-6 control-label">Name</label>
			<div class="col-md-6">
				<input type="text" name="shop_name" class="form-control">
                                <?php if(isset($arrErrors['shop_name'][0])){ ?>
                                <span id="shopnameeErr" style="color: red;"><?php echo $arrErrors['shop_name'][0]?></span>
                                <?php }?>
			</div>
		</div>
		<div class="col-md-6">
		<label class="col-md-6 control-label">Country</label>
			<div class="col-md-6">
				<select name="shop_country" id="shop_country" onChange="getCountryState(this.value)">
				<option value="">--Select Country--</option>
                                    <?php
                                    if (!empty($arrCountry)) {
                                        foreach ($arrCountry as $arrCountry) {
                                            ?>
                                            <option value='<?php echo $arrCountry['country_id']; ?>'><?php echo isset($arrCountry['country_name']) ? $arrCountry['country_name'] : NULL; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                        </select>
                        <?php if(isset($arrErrors['shop_country'][0])){ ?>
                        <span id="countryErr" style="color: red;"><?php echo $arrErrors['shop_country'][0]?></span>
                        <?php }?>    
			</div>
		</div>
		<div class="col-md-6">
		<label class="col-md-6 control-label">State</label>
			<div class="col-md-6">
				<select name="shop_state" id="shop_state" onChange="getStateCity(this.value)" required>
					<option >--Select State--</option>
				</select>
                                <?php if(isset($arrErrors['shop_state'][0])){ ?>
                                <span id="stateErr" style="color: red;"><?php echo $arrErrors['shop_state'][0]?></span>
                                <?php }?> 
			</div>
		</div>
		<div class="col-md-6">
		<label class="col-md-6 control-label">City</label>
			<div class="col-md-6">
				<select name="shop_city" id="shop_city" onChange="getCityArea(this.value)" required>
					<option >--Select City--</option>
				</select>
                                <?php if(isset($arrErrors['shop_city'][0])){ ?>
                                <span id="cityErr" style="color: red;"><?php echo $arrErrors['shop_city'][0]?></span>
                                <?php }?> 
			</div>
		</div>           
		<div class="col-md-6">
		<label class="col-md-6 control-label">Sector / Area</label>
			<div class="col-md-6">
				<select name="shop_area" id="shop_area" onChange="getmZipcode(this.value)" required>
					<option>--Select Sector / Area--</option>
				</select>
                                <?php if(isset($arrErrors['shop_area'][0])){ ?>
                                <span id="areaErr" style="color: red;"><?php echo $arrErrors['shop_area'][0]?></span>
                                <?php }?>
			</div>
		</div>	
	</div>	
	<div class="row">
		<div class="col-md-6">
		<label class="col-md-6 control-label">Owner Name</label>
			<div class="col-md-6">
				<input type="text" name="owner_name" class="form-control">
                                <?php if(isset($arrErrors['owner_name'][0])){ ?>
                                <span id="ownernameErr" style="color: red;"><?php echo $arrErrors['owner_name'][0]?></span>
                                <?php }?>
			</div>
		</div>
		<div class="col-md-6">
		<label class="col-md-6 control-label">Pin Code</label>
			<div class="col-md-6">
				<input type="text" class="form-control number-only" id="shop_pincode" name="shop_pincode" maxlength="6">
                                <?php if(isset($arrErrors['shop_pincode'][0])){ ?>
                                <span id="pincodeErr" style="color: red;"><?php echo $arrErrors['shop_pincode'][0]?></span>
                                <?php }?>
			</div>
			</div>
		</div>
		<div class="col-md-6">
		<label class="col-md-6 control-label">Shop Location</label>
			<div class="col-md-6">
				<input type="text" class="form-control geocomplete" name="adrs" id="adrs" />
				<input type="hidden" class="form-control" name="location" />
                                <?php if(isset($arrErrors['adrs'][0])){ ?>
                                <span id="locationErr" style="color: red;"><?php echo $arrErrors['adrs'][0]?></span>
                                <?php }?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
			<label class="col-md-6 control-label">Shop Address</label>
				<div class="col-md-6">
					<textarea class="form-control" name="shop_adrs"></textarea>
                                        <?php if(isset($arrErrors['shop_adrs'][0])){ ?>
                                        <span id="adrsErr" style="color: red;"><?php echo $arrErrors['shop_adrs'][0]?></span>
                                        <?php }?>
				</div>
			</div> 
			<div class="col-md-6">
			<label class="col-md-6 control-label">Shop Description</label>
				<div class="col-md-6">
					<textarea class="form-control" name="shop_description"></textarea>
                                        <?php if(isset($arrErrors['shop_description'][0])){ ?>
                                        <span id="descriptionErr" style="color: red;"><?php echo $arrErrors['shop_description'][0]?></span>
                                        <?php }?>
				</div>
			</div>
			<div class="col-md-6">
			<label class="col-md-6 control-label">List of Modification</label>
				<div class="col-md-6">
					<select name="list_modification[]" multiple="multiple">
                                            <?php 
                                                if(isset($arrServices)&& !empty($arrServices)){
                                                    foreach ($arrServices as $arrServices){
                                                        echo '<option value='.$arrServices['id'].'>'.$arrServices['name'].'</option>';
                                                    }
                                                }
                                            ?>
					</select>
                                        <?php if(isset($arrErrors['list_modification'][0])){ ?>
                                        <span id="listmodErr" style="color: red;"><?php echo $arrErrors['list_modification'][0]?></span>
                                        <?php }?>
				</div>
			</div>
			<div class="col-md-6">
			<label class="col-md-6 control-label">Brand</label>
				<div class="col-md-6">
                                    <select name="brand_name[]" multiple="multiple" id="brand_name">                                           
                                    </select>
                                    <?php if(isset($arrErrors['brand_name'][0])){ ?>
                                    <span id="bradnameErr" style="color: red;"><?php echo $arrErrors['brand_name'][0]?></span>
                                    <?php }?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
			<label class="col-md-6 control-label">Email</label>
				<div class="col-md-6">
					<input type="text" name="shop_email" class="form-control">
                                         <?php if(isset($arrErrors['shop_email'][0])){ ?>
                                        <span id="emailErr" style="color: red;"><?php echo $arrErrors['shop_email'][0]?></span>
                                        <?php }?>
				</div>                               
			</div>
			<div class="col-md-6">
			<label class="col-md-6 control-label">Mobile</label>
				<div class="col-md-6">
					<input type="text" name="shop_contact" class="form-control numeric" maxlength="10">
                                        <?php if(isset($arrErrors['shop_contact'][0])){ ?>
                                        <span id="contatcErr" style="color: red;"><?php echo $arrErrors['shop_contact'][0]?></span>
                                        <?php }?>
				</div>                                
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
			<label class="col-md-6 control-label">Shop Image</label>
				<div class="col-md-6">
					<input type="file" name="shop_image" class="form-control">
                                        <?php if(isset($arrErrors['shop_image'][0])){ ?>
                                        <span id="shopimageErr" style="color: red;"><?php echo $arrErrors['shop_image'][0]?></span>
                                        <?php }?>
				</div>                                
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
			<label class="col-md-6 control-label">Brand Logo</label>
				<div class="col-md-6">
					<input type="file" name="brand_logo" class="form-control">
                                         <?php if(isset($arrErrors['brand_logo'][0])){ ?>
                                        <span id="brandlogoErr" style="color: red;"><?php echo $arrErrors['brand_logo'][0]?></span>
                                        <?php }?>
				</div>
                               
			</div>
		</div>
		
<div class="row"><h3 class="col-sm-12">Create Account</h3></div>
	<div class="row">
		<div class="col-md-6">
		<label class="col-md-6 control-label">Create User Name</label>
			<div class="col-md-6">
				<input type="text" class="form-control" id="username" name="username">
                                 <?php if(isset($arrErrors['username'][0])){ ?>
                                <span id="vtypeErr" style="color: red;"><?php echo $arrErrors['username'][0]?></span>
                            <?php }?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
		<label class="col-md-6 control-label">Create Password</label>
			<div class="col-md-6">
				<input type="password" class="form-control" id="password" name="password">
                                 <?php if(isset($arrErrors['password'][0])){ ?>
                                <span id="vtypeErr" style="color: red;"><?php echo $arrErrors['password'][0]?></span>
                            <?php }?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
		<label class="col-md-6 control-label">Confirm Password</label>
			<div class="col-md-6">
				<input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                 <?php if(isset($arrErrors['confirm_password'][0])){ ?>
                                <span id="vtypeErr" style="color: red;"><?php echo $arrErrors['confirm_password'][0]?></span>
                            <?php }?>
			</div>
		</div>
	<div id="errpwd"></div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-6 col-sm-6">
			<input type="submit" name="addmodification" class="btn btn-warning" value="Create" />
		</div>
	</div>
</form>

<script type="text/javascript">
jQuery(document).ready(function ()
{
    jQuery('.numeric').keyup(function () { 
		this.value = this.value.replace(/[^0-9\.]/g,'');
	});
});
        //States
    function getCountryState(intCountry) {
        var objCountry = '';
        objCountry = {
            country_type: intCountry
        };

        $.post('<?php echo Yii::app()->params['webURL'] . '/User/User/states'; ?>', objCountry, function (response) {
            $('#shop_state').html(response);
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
            $('#shop_city').html(response);
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
            $('#shop_area').html(response);
            return true;
        });
    }
    //Brand Name
    function getVehicleBrand(intVehicleType){
        var objVehicleType='';
        objVehicleType={vehicle_type:intVehicleType};
        $.post('<?php echo Yii::app()->params['webURL'] . 'Modifications/ModificationShop/brands'; ?>', objVehicleType, function (response) {
        $('#brand_name').html(response);
        return true;
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