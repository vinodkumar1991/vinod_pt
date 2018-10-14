<?php
$statusArray=array('1'=>'Active','0'=>'InActive');
//echo'<pre>';print_r($arrRepairs);exit;
?>
<ul class="nav nav-tabs" role="tablist">
    <li><a href="<?php echo Yii::app()->params['webURL']; ?>/UserService/UserService/Repairs">Add Repair</a></li>
    <li><a href="<?php echo Yii::app()->params['webURL']; ?>/UserService/UserService/RepairList">Add Repairlist</a></li>
    <li><a href="<?php echo Yii::app()->params['webURL']; ?>/UserService/UserService/RepairListBilling">Billing</a></li>
    <li  class="active"><a href="<?php echo Yii::app()->params['webURL']; ?>/UserService/UserService/BillingReport">Billing Report</a></li>
    <!--<li><a href="<?php //echo Yii::app()->params['webURL']; ?>UserService/UserService/AddCategory">Add Category</a></li>
    <li><a href="<?php //echo Yii::app()->params['webURL']; ?>UserService/UserService/AddPlans">Add Plans</a></li>-->
    <li><a href="<?php echo Yii::app()->params['webURL']; ?>Reports/Orders/Orders/AddPackageAmount">Update package</a></li>
</ul>
<br/>
    <div class="panel panel-primary pull-left">
    <div class="panel-heading">
        <h3 class="panel-title">Billing Details</h3>
    </div>    
    <div class="panel-body">             
    <form method="post" name="search_from" id="search_from" action="<?php echo Yii::app()->params['webURL'].'UserService/UserService/BillingReport'?>">
    <!-- Search Filter Start -->
    <table align="center" width="100%" cellspacing="5">
        <tr>
            <td align="right">
                <label>Vehicle Type</label>
            </td>
            <td><b>&nbsp:&nbsp</b></td>
            <td align="left">
                <select name="veh_type" id="veh_type" onchange="getVehicleCategories(this.value);" style="width:250px;">
                    <option value="">All Vehicle Type</option>
                    <option value="1">Car</option>
                    <option value="2">Bike</option>
                </select>
            </td>
             <td align="right">
                <label>Vehicle Category</label>
            </td>
            <td><b>&nbsp:&nbsp</b></td>
            <td align="left">
                <select name="vehicle_category_id" id="vehicle_category_id" style="width:250px;">
                    <option value="">All Vehicle Category Type</option>
                </select>
            </td>
            <td align="left">
                
            </td> 
        </tr>
        <tr>
            <td align="right">
                <label>Service Type</label>
            </td>
            <td><b>&nbsp:&nbsp</b></td>
            <td align="left">
                <select name="service_type_id" id="service_type_id" onchange="getPlans(this.value)" style="width:250px;">
                    <option value="">All Service Type</option>
                   
                </select>
            </td>
             <td align="right">
                <label>Plan</label>
            </td>
            <td><b>&nbsp:&nbsp</b></td>
            <td align="left">
                <select name="plan_id" id="plan_id" style="width:250px;">
                    <option value="">All Plan</option>
                </select>
            </td>
            <td align="right">
                <label>Repair Name</label>
            </td>
            <td><b>&nbsp:&nbsp</b></td>
            <td align="left">
                <select name="repairs_id" id="repairs_id">
                    <option value="">All Repairs</option>
                    <?php
                        if(isset($arrRepairs) && !empty($arrRepairs)){
                         foreach($arrRepairs as $key=>$arrValue){
                            echo '<option value='.$arrValue['id'].'>'.$arrValue['name'].'</option>';                        
                          }
                        }
                    ?>
                </select>
            </td>
            <td align="left">
                <button class="btn btn-warning" type="submit" name="search" id="search" value="Search" style="height:28px;">Search</button>
            </td>
        </tr>       
    </table>
    <!-- End-->
    </form>
        <form name="bill_report" id="bill_report" method="post" action="">
            <button type="button" class="btn btn-warning" id="sub" name="sub" value="update" onclick="updateBillingAmount();">Update</button>        
        <table class="datatable table table-striped" cellspacing="0" width="100%">
            <thead>               
                <tr>
                    <th>Sl No.</th>
                    <th>Repair Name</th>
                    <th>Repairlist Name</th>
                    <th>Vehicle Category</th>
                    <th>Vehicle Type</th>
                    <th>Plan</th>
                    <th>Amount</th>
                    <th>Status</th>                    
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($billing_details)) {
                    $i = 1;
                    foreach ($billing_details as $arrEleBilling) {
                        ?>                                

                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo isset($arrEleBilling['repair_name']) ? $arrEleBilling['repair_name'] : NULL; ?></td>
                            <td><?php echo isset($arrEleBilling['repair_list_name']) ? $arrEleBilling['repair_list_name'] : NULL; ?></td>
                            <td><?php echo isset($arrEleBilling['vehicle_category_name']) ? $arrEleBilling['vehicle_category_name'] : NULL; ?></td>
                            <td><?php echo isset($arrEleBilling['vehicle_name']) ? $arrEleBilling['vehicle_name'] : NULL; ?></td>
                            <td><?php echo isset($arrEleBilling['plan_name']) ? $arrEleBilling['plan_name'] : NULL; ?></td>
                            <td align="center">
                            <input type="text" value="<?php echo isset($arrEleBilling['cost']) ? number_format($arrEleBilling['cost'],2) : NULL; ?>" name="billReport[<?php echo $arrEleBilling['amount_id']?>][amount]" 
                                   id="billReport<?php echo $i;?>" style="width:70%" class="numeric">
                            </td>
                            <td>                                 
                              <?php
                              $strStatus = 'Active';
                                if (isset($arrEleBilling['status']) && 0 == $arrEleBilling['status']) {
                                    $strStatus = 'Inactive';
                                }                               
                                //echo $strStatus;                                
                              ?>
                                <input type="radio" value="1" name="billReport[<?php echo $arrEleBilling['amount_id'];?>][billstatus]" 
                                <?php echo ($arrEleBilling['status'] == '1')?'checked="checked"' : '';?>> Active<br/>
                                <input type="radio" value="0" name="billReport[<?php echo $arrEleBilling['amount_id'];?>][billstatus]" 
                                <?php echo ($arrEleBilling['status'] == '0')?'checked="checked"' : '';?>> InActive
                            </td>                             
                        </tr>
                        <?php
                        $i++;
                    }
                }
                unset($billing_details);
                unset($i);
                ?>   
            </tbody>
        </table>
        </form>
    </div>
    
</div>
</body>

<script type="text/javascript">

jQuery(document).ready(function (){
    jQuery('.numeric').keyup(function () { 
		this.value = this.value.replace(/[^0-9\.]/g,'');
                if(this.value==''){
                    alert('Amount should be mandatory');
                    return false;
                }
    });
});

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
        $.post('<?php echo Yii::app()->params['webURL'] . 'Vehicles/Vehicles/getVehicleCategories' ?>', objVehicle, function (response) {
            if (response.length > 0) {
                $("#vehicle_category_id").html("");
                $("#vehicle_category_id").append(response);
            } else {
                $("#vehicle_category_id").html("");
            }
            return true;
        });

        $.post('<?php echo Yii::app()->params['webURL'] . 'UserService/UserService/GetServicesList' ?>', objVehicle, function (response) {
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
    
    //Ajax Update Billing Amount
    function updateBillingAmount(){        
        var datastring = $("#bill_report").serialize();
        $.ajax({
        type:'POST', 
        url:'<?php echo Yii::app()->params['webURL'].'UserService/UserService/UpdateBillingReport'?>',
        data:datastring,
        catch:false,
        success:function(data){
            alert(data);
            location.reload(true);
        }
     }); 
    }
   //Javascript :: END
   
   //Javascript :: Get Plan
   function getPlans(intService){
        var intVehicleType=$("#veh_type").val();
        var objPlan = {};
            objPlan = {
                service_id: intService,
                vehicle_id: intVehicleType,
            };
            $.post('<?php echo Yii::app()->params['webURL'] . 'UserService/UserService/Plans' ?>', objPlan, function (response) {
                if (response.length > 0) {
                    $("#plan_id").html("");
                    $("#plan_id").append(response);
                } else {
                    $("#plan_id").html("");
                }
                return true;
            });
   }
   //Javascript :: END
</script>
