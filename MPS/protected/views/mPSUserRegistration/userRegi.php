 
<ul class="nav nav-tabs" role="tablist">
    <li class="active"><a href="<?php echo Yii::app()->request->baseUrl ?>/index.php/mPSUserRegistration/userRegister">Create User</a></li>
    <li><a href="<?php echo Yii::app()->request->baseUrl ?>/index.php/mPSUserRegistration/Managermechanicshop">Manage User</a></li>
</ul><!-- Mechanic Shop Form -->



<div class="tab-content">


    <div class="row">
        <div class="form-group">
            <label class="col-sm-4 control-label text-right">Select Role</label>
            <div class="col-sm-8">
                <select class = 'userTypes' id="user_types" name="user_types" style="width:300px;">
                    <option>Select Role</option>
                    <option value="1">Mechanic Shop</option>
                    <option value="4">Self Drive Agent</option>
                    <option value="5">Hire a Mechanic</option>
                    <option value="6">Modification</option>
                </select>
            </div>
        </div>

    </div>
    <font color="green"><h4><div id="message" align="right">
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
        </div>
    </h4>
    </font>

</div>



<form class="form-horizontal lcns 1 userreg-form" id="delshop" method="POST" action="imageupload" enctype="multipart/form-data">



    <input type="hidden" name="roletype" id="roletype">
    <div class="row"><h3 class="col-sm-12">Enter Shop Details</h3></div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Shop Name</label>
            <div class="col-md-6">
                <input type="text" class="form-control" id="shop_nm" name="shop_nm" required>
            </div>
        </div>
        <div class="col-md-6">
            <label class="col-md-6 control-label">Country</label>
            <div class="col-md-6">
                <select name="country" id="country" onChange="getState(this.value)">
                    <option >Select Country</option>
                    <?php
                    foreach ($MPSCOUNTRIES as $MPSCOUNTRY) {
                        echo "<option value='" . $MPSCOUNTRY['id'] . "'>" . $MPSCOUNTRY['name'] . "</option>";
                    }
                    ?>   
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <label class="col-md-6 control-label">State</label>
            <div class="col-md-6">
                <select name="stamt" id="stamt" onChange="getCity(this.value)">
                    <option >Select State</option>

                </select>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-6">
            <label class="col-md-6 control-label">Shop ID</label>
            <div class="col-md-6">
                <input type="text" class="form-control" id="shopid" name="shopid" value="mse00<?php echo $shopuniqueid + 1; ?>" readonly="true" required>
            </div>
        </div>
        <div class="col-md-6">
            <label class="col-md-6 control-label">City</label>
            <div class="col-md-6">
                <select name="city" id="city" onChange="getArea(this.value)">
                    <option >Select City</option>

                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Shop Category</label>
            <div class="col-md-6">
                <select name="veh_type" id="veh_type" class="form-control">
                    <option>Select Vehicle Type</option>
                    <option value="car">Car</option>
                    <option value="bike">Bike</option>

                </select>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Shop Owner Name</label>
            <div class="col-md-6">
                <input type="text" class="form-control" id="ownername" name="ownername" required>
            </div>
        </div>
        <div class="col-md-6">
            <label class="col-md-6 control-label">Sector / Area</label>
            <div class="col-md-6">
                <select name="area" id="area" onChange="getZipcode(this.value)" required>
                    <option>Select Sector / Area</option>

                </select>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Enter Number of Mecanics</label>
            <div class="col-md-6">
                <input type="number" class="form-control" id="num_mech" name="num_mech" placeholder="Enter Number of Mecanics" required>
            </div>
        </div>                                        
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Services offerd</label>
            <div class="col-md-6">
                <select id="typeofservices" name="typeofservices[]" multiple="multiple" required>
                    <option>General Service</option>
                    <option>Periodic Service</option>
                    <option>Denting</option>
                    <option>Washing</option>
                    <option>Oil Service</option>
                </select>
            </div>
        </div>
        <!-- <div class="col-md-6">
             <label class="col-md-6 control-label">Address</label>
             <div class="col-md-6">
                 <textarea class="form-control" name="adrs" id="adrs" placeholder="Enter Shop Address"></textarea>
             </div>
         </div>-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Shop Address</label>
            <div class="col-md-6">
                <input type="text" class="form-control geocomplete" name="adrs" id="adrs" />
                <input type="text" class="form-control" name="location" />

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Address Proof</label>
            <div class="col-md-6">
               <!-- <input type="file" class="form-control" id="imgpic" name="imgpic">-->
                <input type="file" name="adrsroof" id="adrsroof" data-type="image" accept="image/*" capture required/>
            </div>	
        </div>
        <div class="col-md-6">
            <label class="col-md-6 control-label">ID Proof</label>
            <div class="col-md-6">
               <!-- <input type="file" class="form-control" id="imgpic" name="imgpic">-->
                <input type="file" name="userfile" id="userfile" data-type="image" accept="image/*" capture required/>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Upload Photo</label>
            <div class="col-md-6">
               <!-- <input type="file" class="form-control" id="imgpic" name="imgpic">-->
                <input type="file" name="uploadpic" id="uploadpic" data-type="image" accept="image/*" capture required/>
            </div>	
        </div>
        <div class="col-md-6">
            <label class="col-md-6 control-label">Service Capability (Per Day)</label>
            <div class="col-md-6">
                <input type="number" class="form-control" id="servicecap" name="servicecap">
            </div>
        </div>																			
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Email ID</label>
            <div class="col-md-6">
                <input type="email" class="form-control" id="emailid" name="emailid"><div id="emailer"></div>
            </div>
        </div>
        <div class="col-md-6">
            <label class="col-md-6 control-label">Contact No.</label>
            <div class="col-md-6">
                <input type="text" class="form-control" id="cont" name="cont" maxlength="10">
            </div>
        </div>	
    </div>
    <div class="row"><h3 class="col-sm-12">Create Account</h3></div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Create User Name</label>
            <div class="col-md-6">
                <input type="text" class="form-control" id="username" name="username">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Create Password</label>
            <div class="col-md-6">
                <input type="password" class="form-control" id="password" name="password">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Confirm Password</label>
            <div class="col-md-6">
                <input type="password" class="form-control" id="conpwd" name="conpwd">
            </div>

        </div>
        <div id="errpwd"></div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-6 col-sm-6">
            <button type="submit" class="btn btn-warning"  id="sub" name="sub">Create Mechanic Shop</button>
            <span id="loading" style="display:none; align:center"><img src="<?php echo Yii::app()->baseUrl ?>/images/load.gif" width="100px" height="100px"></span>
        </div>
        <div id="succmsg"></div>
    </div>
</form>

<!-- End Mechanic Shop Form -->                                     

<!-- Self Drive Agent Form -->

<form class="form-horizontal lcns 4 userreg-form" id="selfdrive" method="POST" action="../SelfDrive/Agent/Create" enctype="multipart/form-data">
  
</form>
<!-- End Self Drive Agent Form -->

<!-- Hire a Mechanic Form -->
<form class="form-horizontal lcns 5 userreg-form" method="POST" action="../HIREAMECHANIC/FetchHireData/" enctype="multipart/form-data">
    <div class="row"><h3 class="col-sm-12">Create Mechanic</h3></div>
    <div class="row">
        <input type="hidden" name="hroletype" id="hroletype">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Mechanic ID</label>
            <div class="col-md-6">
                <input type="text" class="form-control" id="hmcid" name="hire_mechanic_id" value="HMC00<?php echo $hireid + 1; ?>" readonly="true" >
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Choose Vehicle</label>
            <div class="col-md-6">
                <select name="vehicle_type" required>
                    <option value="">Select Vechile</option>
                    <option value="car">Car</option>
                    <option value="bike">Bike</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Enter Profesionality</label>
            <div class="col-md-6">
                <select multiple="multiple" id="profesionality" name="profesional[]">
                    <option value="">Select Profesionality</option>
                    <option value="Volkswagen">Volkswagen</option>
                    <option value="Skoda">Skoda</option>
                    <option value="Audi">Audi</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Location</label>
            <div class="col-md-6">

                <input type="text" class="form-control geocomplete" name="name" />
                <input type="hidden" class="form-control" name="location" />


            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Booking Charge</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="booking_charge" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Mechanic Description</label>
            <div class="col-md-6">
                <textarea class="form-control" name="description"></textarea>
            </div>
        </div>
    </div>

    <div class="row"><h3 class="col-sm-12">Enter Personal Details</h3></div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Name</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="mechanic_name">
            </div>
        </div>
        <div class="col-md-6">
            <label class="col-md-6 control-label">Enter Company Name</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="company_name">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Mobile No.</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="mobile_no">
            </div>
        </div>
        <div class="col-md-6">
            <label class="col-md-6 control-label">Years of Experience</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="year_of_exp">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Email </label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="email">
            </div>
        </div>
        <div class="col-md-6">
            <label class="col-md-6 control-label">Upload Work Exp Ceritificate</label>
            <div class="col-md-6">
                <input type="file" class="form-control" name="work_cerftificate" accept="image/*" capture required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Address </label>
            <div class="col-md-6">
                <textarea class="form-control" name="address"></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <label class="col-md-6 control-label">Upload any Identity Proof (Licence, Aaadhar)</label>
            <div class="col-md-6">
                <input type="file" class="form-control" name="id_proof" accept="image/*" capture required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Upload Photo </label>
            <div class="col-md-6">
                <input type="file" class="form-control" name="upload_pic" accept="image/*" capture required>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-6 col-sm-6">
            <button type="submit" class="btn btn-warning" name="addhire" value="add">Add Mechanic</button>
        </div>
    </div>
</form>
<!-- End Hire a Mechanic Form -->

<!-- modification shop Form -->
<form class="form-horizontal 6 lcns modification userreg-form" method="POST" action="../Modificationshop/ModificationSave/" enctype="multipart/form-data">
    <div class="row"><h3 class="col-sm-12">Modification Shop Details</h3></div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Choose Vehicle</label>
            <div class="col-md-6">
                <select name="vehicle_type">
                    <option>Select Vechile</option>
                    <option value="car">Car</option>
                    <option value="bike">Bike</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <input type="hidden" name="mroletype" id="mroletype">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Shop ID</label>
            <div class="col-md-6">
                <input type="text" class="form-control" id="modification_id" name="modification_id" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <label class="col-md-6 control-label">Shop Name</label>
            <div class="col-md-6">
                <input type="text" name="mshopname" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <label class="col-md-6 control-label">Country</label>
            <div class="col-md-6">
                <select name="mcountry" id="mcountry" onChange="getmState(this.value)" required>
                    <option >Select Country</option>
                    <?php
                    foreach ($MPSCOUNTRIES as $MPSCOUNTRY) {
                        echo "<option value='" . $MPSCOUNTRY['id'] . "'>" . $MPSCOUNTRY['name'] . "</option>";
                    }
                    ?>   
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <label class="col-md-6 control-label">State</label>
            <div class="col-md-6">
                <select name="mstate" id="mstate" onChange="getmCity(this.value)" required>
                    <option >Select State</option>

                </select>
            </div>
        </div>
        <div class="col-md-6">
            <label class="col-md-6 control-label">City</label>
            <div class="col-md-6">
                <select name="mcity" id="mcity" onChange="getmArea(this.value)" required>
                    <option >Select City</option>

                </select>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-6">
            <label class="col-md-6 control-label">Sector / Area</label>
            <div class="col-md-6">
                <select name="marea" id="marea" onChange="getmZipcode(this.value)" required>
                    <option>Select Sector / Area</option>

                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Retiler Name</label>
            <div class="col-md-6">
                <input type="text" name="retiler_name" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <label class="col-md-6 control-label">Zip Code</label>
            <div class="col-md-6">
                <input type="text" class="form-control number-only" id="mzipcode" name="mzipcode" maxlength="6" required>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <label class="col-md-6 control-label">Location</label>
        <div class="col-md-6">

            <input type="text" class="form-control geocomplete" name="name" />
            <input type="text" class="form-control" name="location" />


        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Address</label>
            <div class="col-md-6">
                <textarea class="form-control" name="adress"></textarea>
            </div>
        </div> 
        <div class="col-md-6">
            <label class="col-md-6 control-label">Shop Description</label>
            <div class="col-md-6">
                <textarea class="form-control" name="description"></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <label class="col-md-6 control-label">List of Modification</label>
            <div class="col-md-6">
                <select name="list_mofdifications[]" multiple="multiple">
                    <option value="Car_Painting">Car Painting</option>
                    <option value="Car_Altration">Car Altration</option>
                    <option value="Car_Teflon_Polish">Car Teflon Polish</option>
                    <option value="Car_Painting_Dupont">Car Painting Dupont</option>

                </select>
            </div>
        </div>
        <div class="col-md-6">
            <label class="col-md-6 control-label">Select Brand</label>
            <div class="col-md-6">
                <select name="brand_id">
                    <?php foreach ($vmake as $makes) { ?>
                        <option value="<?php echo $makes['makes_id']; ?>"><?php echo $makes['makes_name']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Enter Email ID</label>
            <div class="col-md-6">
                <input type="text" name="email" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <label class="col-md-6 control-label">Contact No.</label>
            <div class="col-md-6">
                <input type="text" name="contact_no" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Shop Image</label>
            <div class="col-md-6">
                <input type="file" name="idproof" class="form-control" accept="image/*" capture required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Brand Logo</label>
            <div class="col-md-6">
                <input type="file" name="brandlogo" class="form-control" accept="image/*" capture required>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-6 col-sm-6">
            <input type="submit" name="addmodification" class="btn btn-warning" value="Create Modification Shop" />
        </div>
    </div>
</form>
<!-- End modification Shop Form -->


</div>
<script type="text/javascript">
    $(document).ready(function () {


        $("#user_types").change(function () {
            $(this).find("option:selected").each(function () {
                if ($(this).attr("value") == "1") {
                    $(".userreg-form").not(".1").hide();
                    $(".1").show();
                } else if ($(this).attr("value") == "4") {
                    $(".userreg-form").not(".4").hide();
                    location.href='<?php echo $this->createUrl('SelfDrive/SelfAgent/SelfAgent'); ?>';
                    $(".4").show();
                } else if ($(this).attr("value") == "5") {
                    $(".userreg-form").not(".5").hide();
                    $(".5").show();
                } else if ($(this).attr("value") == "6") {
                    $(".userreg-form").not(".6").hide();
                    $(".6").show();
                } else {
                    $(".userreg-form").hide();
                }
            });
        }).change();
    });
</script>

<script>
//modification shop get countryId
    function getmState(countryId)
    {

        $.post('../mPSUserRegistration/Getstate', {
            Country: countryId,
        },
                function (data)
                {

                    $("#mstate").html("");
                    $("#mstate").append(data);
                    //personal location
                    /* $("#pdelstate").html("");
                     $("#pdelstate").append(data);
                     
                     //work location
                     $("#wldelstate").html("");
                     $("#wldelstate").append(data); */
                });
    }
    function getmCity(stateId)
    {

        $.post('../mPSUserRegistration/Getcity', {
            State: stateId,
        },
                function (data)
                {
                    //alert(data);
                    $("#mcity").html("");
                    $("#mcity").append(data);

                    /* $("#wldelcity").html("");
                     $("#wldelcity").append(data); */

                });
    }

    function getmArea(cityId)
    {

        $.post('../mPSUserRegistration/Getarea', {
            City: cityId,
        },
                function (data)
                {
                    //alert(data);
                    $("#marea").html("");
                    $("#marea").append(data);
                    //personal location
                    /* $("#pdelarea").html("");
                     $("#pdelarea").append(data);
                     //work location
                     $("#wldelarea").html("");
                     $("#wldelarea").append(data); */


                });
    }
    function getmZipcode(area)
    {
        $.post('../mPSUserRegistration/getZip', {
            area: area,
        },
                function (data)
                {

                    $("#mzipcode").val(data);



                });

    }
//self drive get country
    function getsState(countryId)
    {
        $.post('../mPSUserRegistration/Getstate', {
            Country: countryId,
        },
                function (data)
                {

                    $("#sstate").html("");
                    $("#sstate").append(data);
                    //personal location
                    /* $("#pdelstate").html("");
                     $("#pdelstate").append(data);
                     
                     //work location
                     $("#wldelstate").html("");
                     $("#wldelstate").append(data); */
                });
    }
    function getsCity(stateId)
    {

        $.post('../mPSUserRegistration/Getcity', {
            State: stateId,
        },
                function (data)
                {
                    //alert(data);
                    $("#scity").html("");
                    $("#scity").append(data);

                    /* $("#wldelcity").html("");
                     $("#wldelcity").append(data); */

                });
    }

    function getsArea(cityId)
    {

        $.post('../mPSUserRegistration/Getarea', {
            City: cityId,
        },
                function (data)
                {
                    //alert(data);
                    $("#sarea").html("");
                    $("#sarea").append(data);
                    //personal location
                    /* $("#pdelarea").html("");
                     $("#pdelarea").append(data);
                     //work location
                     $("#wldelarea").html("");
                     $("#wldelarea").append(data); */


                });
    }
    function getsZipcode(area)
    {
        $.post('../mPSUserRegistration/getZip', {
            area: area,
        },
                function (data)
                {

                    $("#szipcode").val(data);



                });

    }



    //End self drive agency

    jQuery(document).ready(function ()
    {

        $(".geocomplete").geocomplete({
            details: "form",
            types: ["geocode", "establishment"],
        });
        // Selfdrive agency_name
        jQuery(".number-only").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if (jQuery.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A, Command+A
                            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                            // Allow: home, end, left, right, down, up
                                    (e.keyCode >= 35 && e.keyCode <= 40)) {
                        // let it happen, don't do anything
                        return;
                    }
                    // Ensure that it is a number and stop the keypress
                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                        e.preventDefault();
                    }
                });
        var max_chars = 12;
        jQuery('.number-only').keydown(function (e) {
            if (jQuery(this).val().length >= max_chars) {
                jQuery(this).val(jQuery(this).val().substr(0, max_chars));
                //document.getElementById("pin-error").style.display = '';
            }
        });

        jQuery('.number-only').keyup(function (e) {
            if (jQuery(this).val().length >= max_chars) {
                jQuery(this).val(jQuery(this).val().substr(0, max_chars));
                //document.getElementById('pin-error').style.display = '';
            }
        });





        jQuery("#scpassword").change(function () {
            var spassword = jQuery('#spassword').val();
            var sconpwd = jQuery('#scpassword').val();
            if (spassword != sconpwd)
            {
                //alert('not matching');
                jQuery("#serrpwd").html('<font color="red">Password and confirm password should be match</font>');
                jQuery("#subs").prop('disabled', true);

                return false;
            } else {
                jQuery("#serrpwd").html('');
                jQuery("#subs").prop('disabled', false);

            }

        });
        jQuery("#semail").change(function () {

            var semail = $('#semail').val();
            $.post('../MPSSELFDRIVEAGENCY/emailValidation', {
                semail: semail,
                beforeSend: function () { }
            },
                    function (data)
                    {
                        if (data > 0)
                        {
                            jQuery("#semailer").html('<font color="red">Email Id already exist.</font>');
                            jQuery("#subs").prop('disabled', true);
                            return false;
                        } else {

                            jQuery("#semailer").html('');
                            jQuery("#subs").prop('disabled', false);
                        }
                    }
            );
        });
        jQuery("#susername").change(function () {

            var suser = $('#susername').val();
            $.post('../MPSSELFDRIVEAGENCY/userValidation', {
                suser: suser,
                beforeSend: function () { }
            },
                    function (data)
                    {
                        if (data > 0)
                        {
                            jQuery("#susermsg").html('<font color="red">UserName Id already exist.</font>');
                            jQuery("#subs").prop('disabled', true);
                            return false;
                        } else {

                            jQuery("#susermsg").html('');
                            jQuery("#subs").prop('disabled', false);
                        }
                    }
            );
        });



        //end

        jQuery("#delcon").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A, Command+A
                            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                            // Allow: home, end, left, right, down, up
                                    (e.keyCode >= 35 && e.keyCode <= 40)) {
                        // let it happen, don't do anything
                        return;
                    }
                    // Ensure that it is a number and stop the keypress
                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                        e.preventDefault();
                    }
                });
        jQuery("#cont").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A, Command+A
                            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                            // Allow: home, end, left, right, down, up
                                    (e.keyCode >= 35 && e.keyCode <= 40)) {
                        // let it happen, don't do anything
                        return;
                    }
                    // Ensure that it is a number and stop the keypress
                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                        e.preventDefault();
                    }
                });

        jQuery("#age").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A, Command+A
                            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                            // Allow: home, end, left, right, down, up
                                    (e.keyCode >= 35 && e.keyCode <= 40)) {
                        // let it happen, don't do anything
                        return;
                    }
                    // Ensure that it is a number and stop the keypress
                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                        e.preventDefault();
                    }
                });
        /* if(vmakes == '')
         {
         
         $('#vmakeerr').show();
         return false;
         }
         else{
         $('#vmakeerr').hide();
         }
         if(vmodels == ''){
         
         $('#vmodelerr').show();
         return false;
         }
         else{
         $('#vmodelerr').hide();
         }
         if(vyears == ''){
         $('#vyearerr').show();
         return false;
         }
         else{
         $('#vyearerr').hide();
         }
         */
        jQuery("#user_types").change(function () {

            roleval = jQuery("#user_types").val();
            jQuery("#message").val('');
            jQuery("#roletype").val(roleval);
            jQuery("#delroleid").val(roleval);
            jQuery("#sroletype").val(roleval);
            jQuery("#mroletype").val(roleval);
            jQuery("#hroletype").val(roleval);
            $.post('../mPSUserRegistration/getIds', {
                roleval: roleval,
                beforeSend: function () { }
            },
                    function (data)
                    {
                        //alert(data);
                        jQuery('#shopid').val(data);


                    });
            //slf 
            $.post('../MPSSELFDRIVEAGENCY/getIds', {
                roleval: roleval,
                beforeSend: function () { }
            },
                    function (data)
                    {
                        //alert(data);

                        jQuery('#slfid').val(data);

                    });
            $.post('../HIREAMECHANIC/getIds', {
                roleval: roleval,
                beforeSend: function () { }
            },
                    function (data)
                    {
                        //alert(data);

                        jQuery('#hmcid').val(data);

                    });
            $.post('../Modificationshop/getIds', {
                roleval: roleval,
                beforeSend: function () { }
            },
                    function (data)
                    {
                        //alert(data);

                        jQuery('#modification_id').val(data);

                    });



        });


        jQuery("#conpwd").change(function () {
            var password = jQuery('#password').val();

            var conpwd = jQuery('#conpwd').val();
            if (password != conpwd)
            {
                //alert('not matching');
                jQuery("#errpwd").html('<font color="red">Password and confirm password should be match</font>');
                jQuery("#sub").prop('disabled', true);

                return false;
            } else {
                jQuery("#errpwd").html('');
                jQuery("#sub").prop('disabled', false);

            }

        });

        jQuery("#delusercnpwd").change(function () {
            var passworddel = jQuery('#deluserpwd').val();

            var conpwddel = jQuery('#delusercnpwd').val();
            if (passworddel != conpwddel)
            {
                //alert('not matching');
                jQuery("#delerrpwd").html('<font color="red">Password and confirm password should be match</font>');
                jQuery("#subdeluserdata").prop('disabled', true);

                return false;
            } else {
                jQuery("#delerrpwd").html('');
                jQuery("#subdeluserdata").prop('disabled', false);

            }

        });

        jQuery("#emailid").change(function () {

            var emailid = jQuery('#emailid').val();
            $.post('../mPSUserRegistration/emailValidation', {
                emailid: emailid,
                beforeSend: function () { }
            },
                    function (data)
                    {

                        if (data > 0)
                        {
                            jQuery("#emailer").html('<font color="red">Email Id already exist.</font>');
                            return false;
                        } else {

                            jQuery("#emailer").html('');

                        }
                    });
        });



        //---------
        jQuery("#delemailid").change(function () {

            var emailid = jQuery('#delemailid').val();

            $.post('../mPSUserRegistration/emailValidation', {
                emailid: emailid,
                beforeSend: function () { }
            },
                    function (data)
                    {
                        //alert(data);
                        if (data > 0)
                        {

                            jQuery("#delemailer").html('<font color="red">Email Id already exist.</font>');
                            return false;
                        } else {
                            jQuery("#delemailer").html('');

                        }





                    });

        });

    });

    //work location details
    function getCitydelwork(stateId)
    {
        $.post('../mPSUserRegistration/Getcity', {
            State: stateId,
        },
                function (data)
                {
                    //alert(data);
                    /* $("#wldelstate").html("");
                     $("#wldelstate").append(data); */

                    jQuery("#wldelcity").html("");
                    jQuery("#wldelcity").append(data);

                });
    }
    function getStatedelwork(countryId)
    {
        $.post('../mPSUserRegistration/Getstate', {
            Country: countryId,
        },
                function (data)
                {


                    //personal location
                    jQuery("#wldelstate").html("");
                    jQuery("#wldelstate").append(data);

                    //work location
                    /* $("#wldelstate").html("");
                     $("#wldelstate").append(data); */
                });
    }
    function getAreadelwork(cityId)
    {

        $.post('../mPSUserRegistration/Getarea', {
            City: cityId,
        },
                function (data)
                {


                    //personal location
                    jQuery("#wldelarea").html("");
                    jQuery("#wldelarea").append(data);
                    //work location
                    /* $("#wldelarea").html("");
                     $("#wldelarea").append(data); */


                });
    }
    //------------------------------
    function getCitydel(stateId)
    {
        $.post('../mPSUserRegistration/Getcity', {
            State: stateId,
        },
                function (data)
                {
                    //alert(data);
                    jQuery("#pdelcity").html("");
                    jQuery("#pdelcity").append(data);

                    /* $("#wldelcity").html("");
                     $("#wldelcity").append(data); */

                });
    }
    function getZipcode(area)
    {
        $.post('../mPSUserRegistration/getZip', {
            area: area,
        },
                function (data)
                {

                    jQuery("#zipcode").val(data);



                });

    }
    function getAreadel(cityId)
    {

        $.post('../mPSUserRegistration/Getarea', {
            City: cityId,
        },
                function (data)
                {


                    //personal location
                    jQuery("#pdelarea").html("");
                    jQuery("#pdelarea").append(data);
                    //work location
                    /* $("#wldelarea").html("");
                     $("#wldelarea").append(data); */


                });
    }

    function getStatedel(countryId)
    {
        $.post('../mPSUserRegistration/Getstate', {
            Country: countryId,
        },
                function (data)
                {


                    //personal location
                    jQuery("#pdelstate").html("");
                    jQuery("#pdelstate").append(data);

                    //work location
                    /* $("#wldelstate").html("");
                     $("#wldelstate").append(data); */
                });
    }

    //-----------------------------------
    function getCity(stateId)
    {
        //alert()
        $.post('../mPSUserRegistration/Getcity', {
            State: stateId,
        },
                function (data)
                {

                    jQuery("#city").html("");
                    jQuery("#city").append(data);

                    /* $("#wldelcity").html("");
                     $("#wldelcity").append(data); */

                });
    }

    function getArea(cityId)
    {

        $.post('../mPSUserRegistration/Getarea', {
            City: cityId,
        },
                function (data)
                {
                    //alert(data);
                    jQuery("#area").html("");
                    jQuery("#area").append(data);
                    //personal location
                    /* $("#pdelarea").html("");
                     $("#pdelarea").append(data);
                     //work location
                     $("#wldelarea").html("");
                     $("#wldelarea").append(data); */


                });
    }
    function getState(countryId)
    {
        $.post('../mPSUserRegistration/Getstate', {
            Country: countryId,
        },
                function (data)
                {

                    jQuery("#stamt").html("");
                    jQuery("#stamt").append(data);
                    //personal location
                    /* $("#pdelstate").html("");
                     $("#pdelstate").append(data);
                     
                     //work location
                     $("#wldelstate").html("");
                     $("#wldelstate").append(data); */
                });
    }







</script>
