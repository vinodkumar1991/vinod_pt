<!--Menu :: START-->
<ul class="nav nav-tabs" role="tablist">
    <li>
        <a href="<?php echo Yii::app()->params['webURL'] . 'SelfDrive/Agent/AgentVehicle'; ?>">Create</a>
    </li>
    <li class="active">
        <a href="<?php echo Yii::app()->params['webURL'] . 'SelfDrive/Agent/AgentVehiclesReport'; ?>">Report</a>
    </li>
</ul>
<!--Menu :: END-->

<form class="form-horizontal lcns userreg-form"  action="" method="POST" name="self_vehicles_week_form" id="self_vehicles_week_form" enctype="multipart/form-data">
<div class="row"><h3 class="col-sm-12">Week Days Prices</h3></div>
    <div class="row"> 
        
        <!--Agent Name :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Agent Name</label>
            <div class="col-md-6">
                <?php
                $doubleAgent = isset($vehicle_billing['agent_name']) ? $vehicle_billing['agent_name'] : NULL;
                ?>       
                <input type="text" name="agent_name" class="form-control" id='agent_name' value="<?php echo $doubleAgent; ?>" disabled>
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
        <!--Agent Name :: END-->   
        
        <!--Kms Per Hour :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Kms per Hour</label>
            <div class="col-md-6">
                <?php
                $doubleTxtKph = 0.00;
                $doubleFormKph = isset($weekForm->kms_per_hr) ? $weekForm->kms_per_hr : NULL;
                $doubleKph = isset($vehicle_billing['km_per_hr']) ? $vehicle_billing['km_per_hr'] : NULL;
                $doubleTxtKph = isset($doubleFormKph) ? $doubleFormKph : $doubleKph;
                ?>       
                <input type="text" name="kms_per_hr" class="form-control" id='kms_per_hr' value="<?php echo $doubleTxtKph; ?>">
                <?php
                if (isset($errors['kms_per_hr'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['kms_per_hr'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--Kms Per Hour :: END-->   

        <!--Price Per Hour :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Price Per Hour</label>
            <div class="col-md-6">
                <?php
                $doubleTxPph = 0.00;
                $doubleFormPph = isset($weekForm->Price_per_hr) ? $weekForm->Price_per_hr : NULL;
                $doublePph = isset($vehicle_billing['price_per_hr']) ? $vehicle_billing['price_per_hr'] : NULL;
                $doubleTxtPph = isset($doubleFormPph) ? $doubleFormPph : $doublePph;
                ?>   
                <input type="text" class="form-control" name="price_per_hr" id="price_per_hr" value="<?php echo $doubleTxtPph; ?>">
                <?php
                if (isset($errors['price_per_hr'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['price_per_hr'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--Price Per Hour :: END-->
    </div>



    <div class="row">
        <!--Extra Rate Per Km :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Extra Rate Per Kms</label>
            <div class="col-md-6">
                <?php
                $doubleTxtErpk = 0.00;
                $doubleFormErpk = isset($weekForm->extra_rate_per_km) ? $weekForm->extra_rate_per_km : NULL;
                $doubleErpk = isset($vehicle_billing['extra_rate_km']) ? $vehicle_billing['extra_rate_km'] : NULL;
                $doubleTxtErpk = isset($doubleFormErpk) ? $doubleFormErpk : $doubleErpk;
                ?>   
                <input type="text" name="extra_rate_per_km" class="form-control" id='extra_rate_per_km' value="<?php echo $doubleTxtErpk; ?>">
                <?php
                if (isset($errors['extra_rate_per_km'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['extra_rate_per_km'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <!--Extra Rate Per Km :: START-->

        <!--Security Deposit :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Security Deposit</label>
            <div class="col-md-6">
                <?php
                $doubleTxtSd = 0.00;
                $doubleFormSd = isset($weekForm->security_deposit) ? $weekForm->security_deposit : NULL;
                $doubleSd = isset($vehicle_billing['security_deposit']) ? $vehicle_billing['security_deposit'] : NULL;
                $doubleTxtSd = isset($doubleFormSd) ? $doubleFormSd : $doubleSd;
                ?>   
                <input type="text" name="security_deposit" class="form-control" id='security_deposit' value="<?php echo $doubleTxtSd; ?>">
                <?php
                if (isset($errors['security_deposit'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['security_deposit'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>    
        <!--Security Deposit :: END-->  

        <!--Pickup Amount :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Pickup Charge</label>
            <div class="col-md-6">
                <?php
                $doubleTxtPa = 0.00;
                $doubleFormPa = isset($weekForm->pickup_amount) ? $weekForm->pickup_amount : NULL;
                $doublePa = isset($vehicle_billing['pickup_amount']) ? $vehicle_billing['pickup_amount'] : NULL;
                $doubleTxtPa = isset($doubleFormPa) ? $doubleFormPa : $doublePa;
                ?>   
                <input type="text" name="pickup_amount" class="form-control" id='pickup_amount' value="<?php echo $doubleTxtPa; ?>">
                <?php
                if (isset($errors['pickup_amount'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['pickup_amount'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>    
        <!--Pickup Amount :: END-->      
        <!--Drop Amount :: START-->
        <div class="col-md-6">
            <label class="col-md-6 control-label">Drop Charge</label>
            <div class="col-md-6">
                <?php
                $doubleTxtDa = 0.00;
                $doubleFormDa = isset($weekForm->drop_amount) ? $weekForm->drop_amount : NULL;
                $doubleDa = isset($vehicle_billing['drop_amount']) ? $vehicle_billing['drop_amount'] : NULL;
                $doubleTxtDa = isset($doubleFormDa) ? $doubleFormDa : $doubleDa;
                ?>   
                <input type="text" name="drop_amount" class="form-control" id='drop_amount' value="<?php echo $doubleTxtDa; ?>">
                <?php
                if (isset($errors['drop_amount'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['drop_amount'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>    
        <!--Drop Amount :: END-->      
    </div>

    <div class="row"> 
        
    <!--Back Button :: START-->
    <div class="form-group">
        <div class="col-sm-offset-6 col-sm-6">
           <a href="<?php echo Yii::app()->params['webURL']. '/SelfDrive/Agent/AgentVehiclesReport';?>" class="addvehicle btn btn-warning"> Back </a>
            </div>
    </div>     
    <!--Back Button :: END-->
    
    <!--Update Button :: START-->
    <div class="form-group">
        <div class="col-sm-offset-6 col-sm-6">
            <?php
            if (!empty($doubleTxtKph)) {
                ?>
                <input type="hidden" class="addvehicle btn btn-warning" id="week_form_id" name="week_form_id" value="<?php echo $vehicle_billing['id']; ?>"/>
                <input type="submit" class="addvehicle btn btn-warning" id="add_self_vehicle_price" name="add_self_vehicle_price" value="Update"/>
                <?php
            } else {
                ?>
                <input type="hidden" class="addvehicle btn btn-warning" id="week_form_id" name="week_form_id" value="0"/>
                <input type="submit" class="addvehicle btn btn-warning" id="add_self_vehicle_price" name="add_self_vehicle_price" value="Add"/>
                <?php
            }
            ?>
        </div>
    </div>     
    <!--Update Button :: END-->
    
    </div>     


</form>
</script>

