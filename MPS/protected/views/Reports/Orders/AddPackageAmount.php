<div class="card-body">
    <!--Tab Menus :: START-->
    <ul class="nav nav-tabs" role="tablist">
        <li><a href="<?php echo Yii::app()->params['webURL']; ?>UserService/UserService/Repairs">Add Repair</a></li>
        <li><a href="<?php echo Yii::app()->params['webURL']; ?>UserService/UserService/RepairList">Add Repairlist</a></li>
        <li><a href="<?php echo Yii::app()->params['webURL']; ?>UserService/UserService/RepairListBilling">Billing</a></li>
        <li><a href="<?php echo Yii::app()->params['webURL']; ?>UserService/UserService/BillingReport">Billing Report</a></li>
        <li><!--<a href="<?php //echo Yii::app()->params['webURL'];   ?>UserService/UserService/AddCategory">Add Category</a></li>
        <li><a href="<?php //echo Yii::app()->params['webURL'];   ?>UserService/UserService/AddPlans">Add Plans</a></li>-->
        <li class="active"><a href="<?php echo Yii::app()->params['webURL']; ?>Reports/Orders/Orders/AddPackageAmount">Update package</a></li>
        <li class=""><a href="<?php echo Yii::app()->params['webURL']; ?>Reports/Orders/Orders/AddVehiclePackageAmount">Add package</a></li>
    </ul>
    <!--Tab Menus :: END-->
    <br/>  
    <!-- Service Package List-->    
    <div class="table-responsive">
        <table class="datatable table table-striped" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Sl No.</th>
                    <th>Service Type</th>
                    <th>Plan Type</th>         
                    <th>Vehicle Type</th>
                    <th>Vehicle Category</th>
                    <th>Amount</th>                              
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($arrPackage)) {
                    $i = 1;
                    foreach ($arrPackage as $row) {
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo isset($row['servicename']) ? $row['servicename'] : NULL; ?></td>
                            <td><?php echo isset($row['planname']) ? $row['planname'] : NULL; ?></td>
                            <td align="center"><?php echo isset($row['vehicle_type']) ? $row['vehicle_type'] : NULL; ?></td>
                            <td align="center"><?php echo isset($row['vehicle_category_name']) ? $row['vehicle_category_name'] : NULL; ?></td>
                            <td align="right"><?php echo isset($row['amount']) ? $row['amount'] : NULL; ?></td>
                            <td align="center">
                                <a data-toggle="modal" data-target="#UpdatePackage" title="edit" class="clickbtn edit-u" onclick="ViewServiceAmount('<?php echo $row['service_plan_id']; ?>')">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a> 
                            </td>                
                        </tr>
                        <?php
                        $i++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>       
</div>		
<!-- End-->

<!-- Update Package Screen-->
<div id="UpdatePackage" class="modal fade" role="dialog">
    <div class="modal-dialog">   
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Manage Service Package</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal lcns " action="" method="POST">
                    <input type="hidden" name="service_id" id="service_id" />
                    <div class="row">
                        <div class="col-md-6">
                            <label class="col-md-6 control-label">Service Name</label>
                            <div class="col-md-6">
                                <input type="text" id="service_name" name="service_name" class="form-control" readonly="readonly">
                                <!-- <select name="service_name" id="service_name">
                                    <option value="">--Select--</option>
                                <?php
                                /* if(isset($arrServiceType)){
                                  foreach($arrServiceType as $key=>$value){
                                  echo '<option value='.$value['id'].'>'.$value['name'].'</option>';
                                  }

                                  } */
                                ?>
                                </select>-->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="col-md-6 control-label">Plan Name</label>
                            <div class="col-md-6">
                                <input type="text" id="plan_name" name="plan_name" class="form-control" readonly="readonly">
                                <!-- <select name="plan_name" id="plan_name">
                                       <option value="">--Select--</option>
                                <?php
                                /* if(isset($arrPlanType)){
                                  foreach($arrPlanType as $key=>$value){
                                  echo '<option value='.$value['id'].'>'.$value['name'].'</option>';
                                  }

                                  } */
                                ?>
                                </select>-->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="col-md-6 control-label">Vehicle Type</label>
                            <div class="col-md-6">
                                <input type="text" id="vehicle_type" name="vehicle_type" class="form-control" readonly="readonly">
                                <!-- <select name="vehicle_type" id="vehicle_type">
                                    <option value="">--Select--</option>
                                <?php
                                /* if(isset($arrVehicleType)){
                                  foreach($arrVehicleType as $key=>$value){
                                  echo '<option value='.$value['id'].'>'.$value['name'].'</option>';
                                  }

                                  } */
                                ?>
                                </select>-->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="col-md-6 control-label">Vehicle Category</label>
                            <div class="col-md-6">
                                <input type="text" id="vehicle_category" name="vehicle_category" class="form-control" readonly="readonly">
                                <!-- <select name="vehicle_type" id="vehicle_type">
                                    <option value="">--Select--</option>
                                <?php
                                /* if(isset($arrVehicleType)){
                                  foreach($arrVehicleType as $key=>$value){
                                  echo '<option value='.$value['id'].'>'.$value['name'].'</option>';
                                  }

                                  } */
                                ?>
                                </select>-->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="col-md-6 control-label">Package Amount</label>
                            <div class="col-md-6">
                                <input type="text" id="amount" name="amount" class="form-control numeric" required>
                            </div>
                        </div>								
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-6 col-sm-6">
                            <input type="button" id="update" class="btn btn-warning" name="update" value="update" onclick="UpdatePackage();" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End---->

<script>
    jQuery(document).ready(function () {
        jQuery('.numeric').keyup(function () {
            this.value = this.value.replace(/[^0-9\.]/g, '');
        });
    });
//View Details in dialog screen
    function ViewServiceAmount(Service_ID) {
        $("#service_id").val(Service_ID);
        $.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->params['webURL'] . 'Reports/Orders/Orders/ViewPackageDetails' ?>',
            data: '&Service_ID=' + Service_ID,
            catch : false,
            success: function (data) {
                var obj = JSON.parse(data);
                //$("select[name='service_name'] option[value="+obj[0]['service_type_id']+"]").attr("selected","selected");                  
                $("#service_name").val(obj[0]['servicename']);
                $("#plan_name").val(obj[0]['planname']);
                $("#vehicle_type").val(obj[0]['vehicle_type']);
                $("#vehicle_category").val(obj[0]['vehicle_category_name']);
                $("#amount").val(obj[0]['amount']);
            }
        });
    }
    //Update the package details
    function UpdatePackage() {
        if ($('#amount').val() != '') {
            $.ajax({
                type: 'POST',
                url: '<?php echo Yii::app()->params['webURL'] . 'Reports/Orders/Orders/UpdateServicePackage' ?>',
                data: jQuery('form').serialize(),
                catch : false,
                success: function (data) {
                    alert(data);
                    location.reload(true);
                }
            });
        } else {
            alert('Please Enter package Amount');
            return false;
        }
    }
</script>

