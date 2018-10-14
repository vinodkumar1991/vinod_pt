
<body>
    <div class="card-body">
        <ul class="nav nav-tabs" role="tablist">
            <li><a href="<?php echo Yii::app()->params['webURL']; ?>UserService/UserService/Repairs">Add Repair</a></li>
            <li><a href="<?php echo Yii::app()->params['webURL']; ?>UserService/UserService/RepairList">Add Repairlist</a></li>
            <li class="active"><a href="<?php echo Yii::app()->params['webURL']; ?>UserService/UserService/RepairListBilling">Billing</a></li>
            <li><a href="<?php echo Yii::app()->params['webURL']; ?>UserService/UserService/BillingReport">Billing Report</a></li>
            <!--<li><a href="<?php //echo Yii::app()->params['webURL']; ?>UserService/UserService/AddCategory">Add Category</a></li>
            <li><a href="<?php //echo Yii::app()->params['webURL']; ?>UserService/UserService/AddPlans">Add Plans</a></li>-->
            <li><a href="<?php echo Yii::app()->params['webURL']; ?>Reports/Orders/Orders/AddPackageAmount">Update package</a></li>
        </ul>
        
        <form class="form-horizontal lcns" method="POST">							
            <div class="tab-content">
                <div class="col-md-4">   
                    <!--Message :: START-->
                    <?php
                    if (isset($response['bill_id'])) {
                        ?>
                        <font color="green">
                        <div id="message">
                            <?php
                            echo isset($response['message']) ? $response['message'] : NULL;
                            ?>
                        </div>
                        </font>
                        <?php
                    } else {
                        ?>
                        <font color="red">
                        <div id="message">
                            <?php
                            echo isset($response['message']) ? $response['message'] : NULL;
                            ?>
                        </div>
                        </font>
                        <?php
                    }
                    ?>
                    <!--Message :: END-->
                    <!--Repirs :: START-->
                    <div class="form-group">
                        <label>Repairs</label>
                        <select name="repairs_id" id="repairs_id" onChange="getRepairsList(this.value)">
                            <option value=""> --Select Repairs--</option>
                            <?php
                            if (!empty($repairs)) {
                                foreach ($repairs as $arrEleRepair) {
                                    ?>
                                    <option value="<?php echo $arrEleRepair['id']; ?>"><?php echo $arrEleRepair['name']; ?></option>
                                    <?php
                                }
                            }
                            ?>

                        </select>
                        <?php
                        if (isset($errors['repairs_id'][0])) {
                            ?>
                            <span id="vmodelerr" style="color:red;">
                                <?php
                                echo $errors['repairs_id'][0];
                                ?>
                            </span>
                            <?php
                        }
                        ?>
                    </div> 
                    <!--Repirs :: END-->


                    <!--Repairs List :: START-->
                    <div class="form-group">
                        <label>Repairslist</label>
                        <select name="repairs_lists_id" id="repairs_lists_id">
                            <option value="">--Select Repairslist--</option>
                        </select>
                        <?php
                        if (isset($errors['repairs_lists_id'][0])) {
                            ?>
                            <span id="vmodelerr" style="color:red;">
                                <?php
                                echo $errors['repairs_lists_id'][0];
                                ?>
                            </span>
                            <?php
                        }
                        ?>
                    </div> 
                    <!--Repairs List :: END-->

                    <!--Vehicle Types :: START-->
                    <div class="form-group">
                        <label>Vehicle Type :</label>
                        <select name="vehicle_id" id="vehicle_id" onChange="getVehicleCategories(this.value)">
                            <option value="">--Select Vehicle--</option>
                            <?php
                            if (!empty($vehicle_types)) {
                                foreach ($vehicle_types as $arrEleVehicle) {
                                    ?>
                                    <option value="<?php echo $arrEleVehicle['id']; ?>"><?php echo $arrEleVehicle['name']; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <?php
                        if (isset($errors['vehicle_id'][0])) {
                            ?>
                            <span id="vmodelerr" style="color:red;">
                                <?php
                                echo $errors['vehicle_id'][0];
                                ?>
                            </span>
                            <?php
                        }
                        ?>
                    </div> 
                    <!--Vehicle Types :: END-->


                    <!--Vehicle Categories :: START-->
                    <div class="form-group">
                        <label>Vehicle Category :</label>
                        <select name="vehicle_category_id" id="vehicle_category_id">
                            <option value="">--Select Vehicle Category--</option>
                        </select>
                        <?php
                        if (isset($errors['vehicle_category_id'][0])) {
                            ?>
                            <span id="vmodelerr" style="color:red;">
                                <?php
                                echo $errors['vehicle_category_id'][0];
                                ?>
                            </span>
                            <?php
                        }
                        ?>
                    </div> 
                    <!--Vehicle Categories :: END-->

                    <!--Service Types :: START-->
                    <div class="form-group">
                        <label>Service Type :</label>
                        <select name="service_type_id" id="service_type_id">
                            <option value=""> -- Select Service Type --</option>
                        </select>
                        <?php
                        if (isset($errors['service_type_id'][0])) {
                            ?>
                            <span id="vmodelerr" style="color:red;">
                                <?php
                                echo $errors['service_type_id'][0];
                                ?>
                            </span>
                            <?php
                        }
                        ?>
                    </div>
                    <!--Service Types :: END-->

                    <!--Is Recommended :: START-->
                    <div class="form-group" id="is_recommended_div" style="display:none;">
                        <label>Is Recommended :</label>
                        <select name="is_recommended" id="is_recommended">
                            <option value="">--Recommended Type--</option>
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                        </select> 
                    </div> 
                    <!--Is Recommended :: END-->

                    <!--Plan Type :: START-->
                    <div class="form-group" id="service_plan_div" style="display: none;">
                        <label>Plan Type :</label>
                        <select name="plan_id" id="plan_id">
                            <option value="">--Select Plan--</option>  
                        </select>
                    </div> 
                    <!--Plan Type :: END-->

                    <!--Cost :: START-->
                    <div class="form-group">
                        <label>Cost :</label>
                        <input type="text" class="form-control" name="cost" id="cost" placeholder="Enter Cost" >
                        <?php
                        if (isset($errors['cost'][0])) {
                            ?>
                            <span id="vmodelerr" style="color:red;">
                                <?php
                                echo $errors['cost'][0];
                                ?>
                            </span>
                            <?php
                        }
                        ?>
                    </div> 
                    <!--Cost :: END-->

                    <!--Status :: START-->
                    <div class="form-group">
                        <label>Status :</label>
                        <select name="status" id="status">
                            <option value="">--Select Status--</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        <?php
                        if (isset($errors['status'][0])) {
                            ?>
                            <span id="vmodelerr" style="color:red;">
                                <?php
                                echo $errors['status'][0];
                                ?>
                            </span>
                            <?php
                        }
                        ?>
                    </div> 
                    <!--Status :: END-->

                    <!--Button :: START-->
                    <div class="col-md-5">                                   
                        <div class="form-group">
                            <input type="submit" class="btn btn-warning"  name="do_billing" id="do_billing" value="Create"/>
                        </div> 
                    </div> 
                    <!--Button :: END-->
                </div>  
            </div>
        </form>                  
    </div>		
</body>

<script type="text/javascript">
    var intVehicle = '';
    var intService = '';
    //Jquery :: START
    $(document).ready(function () {

        //Vehicle Type
        $('#vehicle_id').change(function ()
        {
            intVehicle = $('#vehicle_id').val();
        });

        //Service Type
        $('#service_type_id').change(function ()
        {
            var objPlan = {};
            intService = $('#service_type_id').val();
            //Show Or Hide Recommended Section
            if (1 == intVehicle && 2 == intService) {
                $('#is_recommended_div').show();
            } else {
                $('#is_recommended_div').hide();
            }

            //Show Or Hide Plans ( General, Periodic, Oiling, Washing )
            if ((1 == intVehicle && 1 == intService) || (1 == intVehicle && 2 == intService) || (1 == intVehicle && 6 == intService) || (1 == intVehicle && 7 == intService)) {
                objPlan = {
                    vehicle_id: intVehicle,
                    service_id: intService,
                };
                $.post('<?php echo Yii::app()->params['webURL'] . 'UserService/UserService/Plans' ?>', objPlan, function (response) {
                    if (response.length > 0) {
                        $("#service_plan_div").show();
                        $("#plan_id").html("");
                        $("#plan_id").append(response);
                    } else {
                        $("#plan_id").html("");
                        $("#service_plan_div").hide();
                    }
                    return true;
                });
            } else {
                $("#plan_id").html("");
                $("#service_plan_div").hide();
            }

        });
    });
    //Jquery :: END

    //Javascript :: START
    function getRepairsList(intRepair)
    {
        var objRepair = {};
        objRepair = {
            repair_id: intRepair,
        };
        $.post('<?php echo Yii::app()->params['webURL'] . 'UserService/UserService/GetRepairsList' ?>', objRepair, function (response) {
            if (response.length > 0) {
                $("#repairs_lists_id").html("");
                $("#repairs_lists_id").append(response);
            } else {
                $("#repairs_lists_id").html("");
            }
            return true;
        });
    }

    function getVehicleCategories(intVehicleType) {
        var objVehicle = {};
        objVehicle = {
            vehicle_id: intVehicleType,
        };
        $.post('<?php echo Yii::app()->params['webURL'] . '/Vehicles/Vehicles/GetVehicleCategories' ?>', objVehicle, function (response) {
            if (response.length > 0) {
                $("#vehicle_category_id").html("");
                $("#vehicle_category_id").append(response);
            } else {
                $("#vehicle_category_id").html("");
            }
            return true;
        });

        $.post('<?php echo Yii::app()->params['webURL'] . '/UserService/UserService/GetServicesList' ?>', objVehicle, function (response) {
            if (response.length > 0) {
                $("#service_type_id").html("");
                $("#service_type_id").append(response);
            } else {
                $("#service_type_id").html("");
            }
            return true;
        });
        return true;
    }
    //Javascript :: END
</script>
