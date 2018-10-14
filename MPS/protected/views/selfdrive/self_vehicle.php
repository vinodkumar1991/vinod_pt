<!--Google Address :: START-->
<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/jquery.geocomplete.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/dist/locationpicker.jquery.min.js"></script>

<?php
if (isset($message)) {
    echo $message;
}
$user = strtoupper(Yii::app()->user->getState('user'));
?>

<span id="selfdrivemessage"></span>		
<form class="form-horizontal lcns userreg-form"  action="create" method="POST" name="selfVehicle" id="selfdriveform1" enctype="multipart/form-data">
    <div class="row"><h3 class="col-sm-12">Enter Vehicle Details</h3></div>
    <div class="row">

        <div class="col-md-6">
            <label class="col-md-6 control-label">Brand</label>
            <div class="col-md-6">
                <select onChange="getModel(this.value)" id="vehicle_brand_models_id" name="brand_name">
                    <option value="">Select Vehicle Maker</option>
                    <?php
                    if (isset($vehicle_Brands) && !empty($vehicle_Brands)) {
                        foreach ($vehicle_Brands as $vehicle_Brand) {
                            ?>
                            <option value="<?php echo $vehicle_Brand['id']; ?>"><?php echo $vehicle_Brand['name']; ?></option>
                            <?php
                        }
                    }
                    ?>      

                </select>
                <?php
                if (isset($errors['vehicle_brand_models_id'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['vehicle_brand_models_id'][0];
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
            <label class="col-md-6 control-label">Vehicle Type</label>
            <div class="col-md-6">
                <select name="vehicle_types_id" id="vehicle_types_id">
                    <option>Select Vehicle Type</option>
                    <?php
                    if (isset($vehicle_types) && !empty($vehicle_types)) {
                        foreach ($vehicle_types as $vehicle_type) {
                            ?>
                            <option value="<?php echo $vehicle_type['id']; ?>"><?php echo $vehicle_type['name']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
                <?php
                if (isset($errors['vehicle_types_id'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['vehicle_types_id'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>                                        
        <div class="col-md-6">
            <label class="col-md-6 control-label">Model</label>
            <div class="col-md-6">
                <select id="vmodel" name="vehicle_brand_models_id">
                    <option value="">Select Vehicle Model</option>

                </select>
                <?php
                if (isset($errors['vehicle_brand_models_id'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['vehicle_brand_models_id'][0];
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
            <label class="col-md-6 control-label">Category</label>
            <div class="col-md-6">
                <select name="vehicle_classes_id" id="vehicle_classes_id">
                    <option value="">Select Category Type</option>
                    <?php
                    if (isset($vehicle_classes) && !empty($vehicle_classes)) {
                        foreach ($vehicle_classes as $vehicle_class) {
                            ?>
                            <option value="<?php echo $vehicle_class['id']; ?>"><?php echo $vehicle_class['name']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
                <?php
                if (isset($errors['vehicle_classes_id'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['vehicle_classes_id'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>

            </div>
        </div>
        <div class="col-md-6">
            <label class="col-md-6 control-label">Seating Capacity</label>
            <div class="col-md-6">
                <select name="seating" id="seating">
                    <option value="">Select Seating Capacity</option>
                    <option value="4">1 to 4</option>
                    <option value="6">4 to 6</option>
                    <option value="10">6 to 10</option>
                    <option value="10plus">10 plus</option>
                </select>
                <?php
                if (isset($errors['seating'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['seating'][0];
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
            <label class="col-md-6 control-label">Variant</label>
            <div class="col-md-6">
                <select name="vehicle_variants_id" id="vehicle_variants_id">
                    <option value="">Select Variant</option>
                    <?php
                    if (isset($arrayVeriants) && !empty($arrayVeriants)) {
                        foreach ($arrayVeriants as $arrayVeriant) {
                            ?>
                            <option value="<?php echo $arrayVeriant['id']; ?>"><?php echo $arrayVeriant['name']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
                <?php
                if (isset($errors['vehicle_variants_id'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['vehicle_variants_id'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

    <div class="row"><h3 class="col-sm-12">Vehicle Features</h3></div>
    <div class="row">
        <div class="col-md-offset-3">
            <?php
            if (isset($arrayFeatures) && !empty($arrayFeatures)) {
                foreach ($arrayFeatures as $arrayFeature) {
                    ?>
                    <div class="col-md-3">
                        <div class="checkbox">
                            <label><input type="checkbox" id="veh_features"  name="veh_features[]" value="<?php echo $arrayFeature['id']; ?>"><?php echo $arrayFeature['name']; ?></label>

                        </div>
                    </div>

                    <?php
                }
            }
            ?>
            <?php
            if (isset($errors['veh_features'][0])) {
                ?>
                <span id="vmodelerr" style="color:red;">
                    <?php
                    echo $errors['veh_features'][0];
                    ?>
                </span>
                <?php
            }
            ?>

        </div>


    </div>
    <div class="row"><h3 class="col-sm-12">Package 1</h3></div>
    <div class="row">                                  
        <div class="col-md-6">
            <label class="col-md-6 control-label">Kms per Hour</label>
            <div class="col-md-6">
                <input type="text" name="kmperhr" class="form-control" id='kmperhr'>
                <?php
                if (isset($errors['kmperhr'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['kmperhr'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>

        </div>
        <div class="col-md-6">
            <label class="col-md-6 control-label">Location</label>
            <div class="col-md-6">

                <input type="text" class="form-control geocomplete" name="loc_adrs" id="loc_adrs" />

                <input type="hidden" class="form-control" name="location" value="17.255,78.2555" id="location" name="location" />
                <?php
                if (isset($errors['loc_adrs'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['loc_adrs'][0];
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
            <label class="col-md-6 control-label">Extra Rate Per Kms</label>
            <div class="col-md-6">
                <input type="text" name="extrarate" class="form-control" id='extrarate'>
                <?php
                if (isset($errors['extrarate'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['extrarate'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>

        </div>
        <div class="col-md-6">
            <label class="col-md-6 control-label">Price Per Hour</label>
            <div class="col-md-6">
                <input type="text" name="priceperhr"class="form-control" id='priceperhr'>

                <?php
                if (isset($errors['priceperhr'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['priceperhr'][0];
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
            <label class="col-md-6 control-label">Security Deposit</label>
            <div class="col-md-6">
                <input type="text" name="deposit" class="form-control" id='deposit'>
                <?php
                if (isset($errors['deposit'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['deposit'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>

        </div>                                        
    </div>
    <div class="col-md-6">
        <label class="col-md-6 control-label">Add Your Vehicle Image</label>
        <div class="col-md-6">
            <input type="file"  id="file" name="vehicle_image" class="form-control">
            <?php
            if (isset($errors['vehicle_image'][0])) {
                ?>
                <span id="vmodelerr" style="color:red;">
                    <?php
                    echo $errors['vehicle_image'][0];
                    ?>
                </span>
                <?php
            }
            ?>
        </div>

    </div> 
    <div class="col-md-6">
        <label class="col-md-6 control-label">Add Multiple Vehicle Images</label>
        <div class="col-md-6">
            <input type="file" name="vehicle_multiple_images[]" class="form-control" id="" multiple>
            <?php
            if (isset($errors['vehicle_multiple_images'][0])) {
                ?>
                <span id="vmodelerr" style="color:red;">
                    <?php
                    echo $errors['vehicle_multiple_images'][0];
                    ?>
                </span>
                <?php
            }
            ?>
        </div>

    </div>  	

</div>
<div class="form-group">
    <div class="col-sm-offset-6 col-sm-6">
        <button type="submit" class="addvehicle btn btn-warning" id="addvehicle" name="addvehicle" >Add Vehicle</button>
    </div>
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
</form>

<script>

    function getModel(brand_id)
    {

        $.post('<?php echo $this->createUrl("/selfdrive/SelfVehicles/GetModels"); ?>', {
            brand_id: brand_id,
        },
                function (data)
                {

                    var toAppend = ' <option value="">Select State</option>';
                    for (var i = 0; i < data.length; i++)
                    {
                        toAppend += '<option value=' + data[i]['id'] + '>' + data[i]['name'] + '</option>';
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

