<div class="card-body">
    <!--Tab Menus :: START-->
    <ul class="nav nav-tabs" role="tablist">
        <li  class="active"><a href="<?php echo Yii::app()->params['webURL']; ?>UserService/UserService/Repairs">Add Repair</a></li>
        <li><a href="<?php echo Yii::app()->params['webURL']; ?>UserService/UserService/RepairList">Add Repairlist</a></li>
        <li><a href="<?php echo Yii::app()->params['webURL']; ?>UserService/UserService/RepairListBilling">Billing</a></li>
        <li><a href="<?php echo Yii::app()->params['webURL']; ?>UserService/UserService/BillingReport">Billing Report</a></li>
        <!--<li><a href="<?php //echo Yii::app()->params['webURL'];                 ?>UserService/UserService/AddCategory">Add Category</a></li>
        <li><a href="<?php //echo Yii::app()->params['webURL'];                 ?>UserService/UserService/AddPlans">Add Plans</a></li>-->
        <li><a href="<?php echo Yii::app()->params['webURL']; ?>Reports/Orders/Orders/AddPackageAmount">Update package</a></li>
    </ul>
    <!--Tab Menus :: END-->
    <div class="tab-content">
    <div class="col-md-4">
    <form class="form-horizontal lcns" method="POST"> 
                <!--Message :: START-->
                <?php
                if (isset($response['repair_id'])) {
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
                <!--Repair Name :: START-->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-8">
                        <?php
                        $strRepairName = NULL;
                        $strEditRepairName = isset($repair_details['name']) ? $repair_details['name'] : NULL;
                        $strFormRepairName = isset($RepairForm->name) ? $RepairForm->name : NULL;
                        $strRepairName = !empty($strEditRepairName) ? $strEditRepairName : $strFormRepairName;
                        ?>
                        <input type="text" class="form-control" name="repair_name" id="repair_name" placeholder="Enter Name" value="<?php echo $strRepairName; ?>">
                        <?php
                        if (isset($errors['repair_name'][0])) {
                            ?>
                            <span id="vmodelerr" style="color:red;">
                                <?php
                                echo $errors['repair_name'][0];
                                ?>
                            </span>
                            <?php
                        }
                        ?>
                    </div> 
                <!--Repair Name :: END-->
                </div>

                <!--Repair Code :: START-->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Code</label>
                    <div class="col-sm-8">
                    <?php
                    $strRepairCode = NULL;
                    $strEditRepairCode = isset($repair_details['code']) ? $repair_details['code'] : NULL;
                    $strFormRepairCode = isset($RepairForm->code) ? $RepairForm->code : NULL;
                    $strRepairCode = !empty($strEditRepairCode) ? $strEditRepairCode : $strFormRepairCode;
                    ?>
                    <input type="text" class="form-control" name="repair_code" id="repair_code" placeholder="Enter Code" value="<?php echo $strRepairCode; ?>">
                    <?php
                    if (isset($errors['repair_code'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['repair_code'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
                    </div>
                </div> 
                <!--Repair Code :: END-->

                <!--Repair Description :: START-->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-8">
                        <?php
                        $strRepairDescription = NULL;
                        $strEditRepairDescription = isset($repair_details['description']) ? $repair_details['description'] : NULL;
                        $strFormRepairDescription = isset($RepairForm->description) ? $RepairForm->description : NULL;
                        $strRepairDescription = !empty($strEditRepairDescription) ? $strEditRepairDescription : $strFormRepairDescription;
                        ?>
                        <textarea  class="form-control" name="repair_description" id="repair_description" placeholder="Enter Description"><?php echo $strRepairDescription; ?></textarea>
                        <?php
                        if (isset($errors['repair_description'][0])) {
                            ?>
                            <span id="vmodelerr" style="color:red;">
                                <?php
                                echo $errors['repair_description'][0];
                                ?>
                            </span>
                            <?php
                        }
                        ?>
                    </div>
                </div> 
                <!--Repair Description :: END-->

                <!--Repair Status :: START-->
                <div class="form-group">
                    <?php
                    $strRepairStatus = NULL;
                    $strEditRepairStatus = NULL;
                    if (isset($repair_details['status']) && 1 == $repair_details['status']) {
                        $strEditRepairStatus = 1;
                    } else if (isset($repair_details['status']) && 0 == $repair_details['status']) {
                        $strEditRepairStatus = 0;
                    }
                    $strFormRepairStatus = isset($RepairForm->status) ? $RepairForm->status : NULL;
                    $strRepairStatus = !empty($strFormRepairStatus) ? $strFormRepairStatus : $strEditRepairStatus;
                    ?>
                    <label class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-8">
                        <select name="repair_status" id="status_val">
                            <option value="">--Select Status--</option>
                            <option value="1" <?php
                            if (isset($strRepairStatus) && 1 == $strRepairStatus) {
                                echo 'selected';
                                ?>
                            <?php } ?>
                                    >Active
                            </option>
                            <option value="0"
                            <?php
                            if (isset($strRepairStatus) && 0 == $strRepairStatus) {
                                echo 'selected';
                                ?>
                            <?php } ?>
                                    >Inactive</option>
                        </select>
                    </div>
                    <?php
                    if (isset($errors['repair_status'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['repair_status'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
                </div> 
                <!--Repair Status :: END-->

                <!--Button :: START-->
                <div class="col-md-offset-4 col-md-4">                                   
                    <div class="form-group">
                        <input type="submit" class="btn btn-warning"   id="create_repair" name="create_repair" value="Create"/>
                    </div> 
                </div> 
                <!--Button :: END-->
    </form> 
</div> 
    <!--Table Repair List -->
<div class="col-md-8">
        <div class="table-responsive">
            <table class="datatable table table-striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    if (!empty($repairs)) {
                        foreach ($repairs as $arrRepair) {
                            ?>                                

                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo isset($arrRepair['name']) ? $arrRepair['name'] : NULL; ?></td>
                                <td><?php echo isset($arrRepair['code']) ? $arrRepair['code'] : NULL; ?></td>
                                <td><?php echo isset($arrRepair['description']) ? $arrRepair['description'] : NULL; ?></td>
                                <td>
                                    <?php
                                    $strStatus = 'Active';
                                    if (isset($arrRepair['status']) && 0 == $arrRepair['status']) {
                                        $strStatus = 'Inactive';
                                    }
                                    echo $strStatus;
                                    ?>
                                </td>
                                <td align="center">
                                    <a href="<?php echo Yii::app()->params['web_url'] . 'EditRepairs/id/' . $arrRepair['id']; ?>" class="clickbtn edit-u"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                    }
                    unset($repairs);
                    unset($i);
                    ?>   
                </tbody>
            </table>
        </div>
</div>
</div>		
</div>



