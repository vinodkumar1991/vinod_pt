<!--Google Address :: START-->
<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/jquery.geocomplete.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/dist/locationpicker.jquery.min.js"></script>

<script>
    $(document).ready(function(){
        
      $("#szipcode").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
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
    $("#contact_no").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
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
        $('#scountry').change(function()
      {
          country_id = $('#scountry').val();
           var objCountry = {};
          
            objCountry = {
                country_id: country_id,
            };

            $.post('getState', objCountry, function (response) {
               
             // alert(response);
               
               $('#sstate').html(response);
       
            });
        });
        
        $('#sstate').change(function()
      {
          state_id = $('#sstate').val();
           var objState = {};
          
            objState = {
                state_id: state_id,
            };

            $.post('GetCity', objState, function (response) {
               
                 //alert(response);
               
               $('#scity').html(response);
       
            });
        });
        
         $('#scity').change(function()
      {
          city_id = $('#scity').val();
           var objState = {};
          
            objState = {
                city_id: city_id,
            };

            $.post('GetArea', objState, function (response) {
               
                // alert(response);
               
               $('#sarea').html(response);
       
            });
        });
        
        });
        function checkEmail(str)
{
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(!re.test(str))
    //alert("Please enter a valid email address");
    $('#semailer').html("<font color=red>Please enter a valid email address</font>");
}
</script>

<span id="selfdrivemessage"></span>		
<form class="form-horizontal lcns 4 userreg-form" id="selfdrive" method="POST" action="SelfAgent" enctype="multipart/form-data">
    <input type="hidden" name="sroletype" id="sroletype">
    <div class="row"><h3 class="col-sm-12">Agency Details</h3></div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Agency Name</label>
            <div class="col-md-6">
                <input type="text" class="form-control" id="agency_name" name="agency_name">
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
        <div class="col-md-6">
            <label class="col-md-6 control-label">Country</label>
            <div class="col-md-6">
                <select name="scountry" id="scountry" onChange="getsState(this.value)">
                    <option value="">Select Country</option>
                    <?php
                    foreach ($getCountries as $getCountry) {
                        echo "<option value='" . $getCountry['id'] . "'>" . $getCountry['name'] . "</option>";
                    }
                    ?>   
                </select>
                 <?php
                    if (isset($errors['scountry'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['scountry'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
           <!-- <label class="col-md-6 control-label">ID</label>-->
            <div class="col-md-6">
                <!--<input type="text" class="form-control" id="slfid" name="slfid" value="<?php //echo 'SLD'.$AgentId['id'];?>" readonly="true" >-->
            </div>
        </div>
        <div class="col-md-6">
            <label class="col-md-6 control-label">State</label>
            <div class="col-md-6">
                <select name="sstate" id="sstate" onChange="getsCity(this.value)">
                    <option value="">Select State</option>

                </select>
                 <?php
                    if (isset($errors['sstate'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['sstate'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Address</label>
            <div class="col-md-6">
                <textarea class="form-control" name="saddress" placeholder="Enter Shop Address"></textarea>
                 <?php
                    if (isset($errors['saddress'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['saddress'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
            </div>
        </div>
        <div class="col-md-6">
            <label class="col-md-6 control-label">City</label>
            <div class="col-md-6">
                <select name="scity" id="scity" onChange="getsArea(this.value)">
                    <option value="">Select City</option>

                </select>
                <?php
                    if (isset($errors['scity'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['scity'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Enter Email ID</label>
            <div class="col-md-6">
                <input type="email" id="semail" name="semail" class="form-control" onblur="checkEmail(this.value);">
                 <?php
                    if (isset($errors['semail'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['semail'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
               <div id="semailer">
            </div>

        </div>
        </div>									
        <div class="col-md-6">
            <label class="col-md-6 control-label">Sector / Area</label>
            <div class="col-md-6">
                <select name="sarea" id="sarea" onChange="getsZipcode(this.value)">
                    <option value="">Select Sector / Area</option>

                </select>
                <?php
                    if (isset($errors['sarea'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['sarea'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Contact No.</label>
            <div class="col-md-6">
                <input type="text" name="contact_no" id="contact_no"  class="form-control number-only" maxlength="10">
                <label id="pin-error" style="display:none;">Invalid Contact Number</label>
                 <?php
                    if (isset($errors['contact_no'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['contact_no'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
            </div>
           
        </div>
        <div class="col-md-6">
            <label class="col-md-6 control-label">Zip Code</label>
            <div class="col-md-6">
                <input type="text" class="form-control number-only" id="szipcode" name="szipcode" maxlength="6">
                <?php
                    if (isset($errors['szipcode'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['szipcode'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
            </div>
             
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">ID Proof</label>
            <div class="col-md-6">
                <!--<input type="file" class="form-control">-->
                <input type="file" name="userfile" data-type="image" accept="image/*" capture/>
                <?php
                    if (isset($errors['userfile'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['userfile'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
            </div>
        </div>
    </div>
    <div class="row"><h3 class="col-sm-12">Create Account</h3></div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Create User Name</label>
            <div class="col-md-6">
                <input type="text" name="susername" id="susername" class="form-control">
                <?php
                    if (isset($errors['susername'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['susername'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
            </div>
             
        </div>
        <div id="susermsg">
        </div>
        <div class="col-md-6">
            <label class="col-md-6 control-label">Create Password</label>
            <div class="col-md-6">
                <input type="password" id="spassword" name="spassword" class="form-control">
                <?php
                    if (isset($errors['spassword'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['spassword'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
            </div>
             
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Confirm Password</label>
            <div class="col-md-6">
                <input type="password" id="scpassword" name="scpassword" class="form-control">
                  <?php
                    if (isset($errors['scpassword'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['scpassword'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
            </div>
        </div>
    </div>
    <div id="serrpwd"></div>
    <div class="form-group">
        <div class="col-sm-offset-6 col-sm-6">
            <button type="submit" class="btn btn-warning" id="subs" name="SelfAgentSub" value="self">Create Agency</button>
             <?php
                                if (isset($response['code']) && 200 == $response['code']) {
                                    ?>
                                    <font color="green"><div id="message">
                                        <?php
                                        echo isset($response['message']) ? $response['message'] : NULL;
                                        ?>
                                    </div></font>
                                    <?php
                                }
                                 ?>
        </div>
       
    </div>
</form>
				
<script>
   
     function getModel(brand_id)
    {
        
        $.post('<?php echo $this->createUrl("/selfdrive/SelfVehicles/GetModels"); ?>',{
                brand_id:brand_id,
        },
        function(data)
        { 
            
           var toAppend = ' <option value="">Select State</option>';           
            for(var i=0;i<data.length;i++)
            {
                toAppend += '<option value='+data[i]['id']+'>'+data[i]['name']+'</option>';
            }

            $('#vmodel').html(toAppend);

        });
    }
</script>
<script>

$(".geocomplete").geocomplete({
        
          details: "form",
          types: ["geocode", "establishment"],
        });    
</script>

