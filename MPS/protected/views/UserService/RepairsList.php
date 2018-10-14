
<div class="card-body">
    <!-- Nav tabs -->
     <ul class="nav nav-tabs" role="tablist">
        <li><a href="<?php echo Yii::app()->params['webURL']; ?>UserService/UserService/Repairs">Add Repair</a></li>
        <li class="active"><a href="<?php echo Yii::app()->params['webURL']; ?>UserService/UserService/RepairList">Add Repairlist</a></li>
        <li><a href="<?php echo Yii::app()->params['webURL']; ?>UserService/UserService/RepairListBilling">Billing</a></li>
        <li><a href="<?php echo Yii::app()->params['webURL']; ?>UserService/UserService/BillingReport">Billing Report</a></li>
        <!--<li><a href="<?php //echo Yii::app()->params['webURL']; ?>UserService/UserService/AddCategory">Add Category</a></li>
        <li><a href="<?php //echo Yii::app()->params['webURL']; ?>UserService/UserService/AddPlans">Add Plans</a></li>-->
        <li><a href="<?php echo Yii::app()->params['webURL']; ?>Reports/Orders/Orders/AddPackageAmount">Update package</a></li>

    </ul>
    <!-- Tab panes -->
    <form class="form-horizontal lcns" method="POST">							
        <div class="tab-content">
            <div class="col-md-3"> 
                <!--Message :: START-->
                <?php
                if (isset($response['repair_list_id'])) {
                    ?>
                    <font color="green">
                    <span id="message" align="left">
                        <?php
                        echo isset($response['message']) ? $response['message'] : NULL;
                        ?>
                    </div>
                    </font>
                    <?php
                } else {
                    ?>
                    <font color="red">
                    <div id="message" align="left">
                        <?php
                        echo isset($response['message']) ? $response['message'] : NULL;
                        ?>
                    </div>
                    </font>
                    <?php
                }
                ?>
                <!--Message :: END-->
                <!--Repairs Id :: START-->
                <div class="form-group">
                    <label>Repair List</label>
                    <?php
            $intRepairType = isset($repairlist_details['repairs_id']) ? $repairlist_details['repairs_id'] : NULL;
          
            
            ?>
                    <select id="repairs_id" name="repairs_id">
                        <option value = "">--Select Repair--</option>
                        <?php
                        if (!empty($repairs)) {
                            foreach ($repairs as $arrRepair) {
                                 if ($intRepairType == $arrRepair["id"]) {
                                ?>
                        <option value="<?php echo $arrRepair['id'] ?>" selected><?php echo $arrRepair['name'] ?></option>
                            <?php
                        } else {
                            ?>
                                <option value = "<?php echo $arrRepair['id']; ?>"><?php echo $arrRepair['name']; ?></option>
                                <?php
                            }
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
                <!--Repairs Id :: END-->

                <!--Repair List :: START-->
                <div class="form-group">
                    <label>Name</label>
                     <?php
                        $strRepairListName = NULL;
                        $strEditRepairListName = isset($repairlist_details['name']) ? $repairlist_details['name'] : NULL;
                        $strFormRepairListName = isset($RepairListForm->name) ? $RepairListForm->name : NULL;
                        $strRepairListName = !empty($strEditRepairListName) ? $strEditRepairListName : $strFormRepairListName;
                        ?>
                    <input type="text" class="form-control" name="repair_list_name" id="repair_list_name" placeholder="Enter Name" value="<?php echo $strRepairListName; ?>"/>
                    <?php
                    if (isset($errors['repair_list_name'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['repair_list_name'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
                </div> 
                <!--Repair List :: END-->

                <!--Repair List Code :: START-->
                <div class="form-group">
                    <label>Code</label>
                    <?php
                        $strRepairListCode = NULL;
                        $strEditRepairListCode = isset($repairlist_details['code']) ? $repairlist_details['code'] : NULL;
                        $strFormRepairListCode = isset($RepairListForm->code) ? $RepairListForm->code : NULL;
                        $strRepairListCode = !empty($strEditRepairListCode) ? $strEditRepairListCode : $strFormRepairListCode;
                        ?>
                    <input type="text" class="form-control" name="repair_list_code" id="repair_list_code" placeholder="Enter Code" value="<?php echo $strRepairListCode; ?>"/>
                    <?php
                    if (isset($errors['repair_list_code'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['repair_list_code'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
                </div> 
                <!--Repair List Code :: END-->

                <!--Repair List Description :: START-->
                <div class="form-group">
                    <label>Description</label>
                     <?php
                        $strRepairListDescription = NULL;
                        $strEditRepairListDescription = isset($repairlist_details['description']) ? $repairlist_details['description'] : NULL;
                        $strFormRepairListDescription = isset($RepairListForm->description) ? $RepairListForm->description : NULL;
                        $strRepairListDescription = !empty($strEditRepairListDescription) ? $strEditRepairListDescription : $strFormRepairListDescription;
                        ?>
                    <textarea  class="form-control" name="repair_list_desc" id="repair_list_desc" placeholder="Enter Description"><?php echo $strRepairListDescription; ?></textarea>
                    <?php
                    if (isset($errors['repair_list_desc'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['repair_list_desc'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
                </div> 
                <!--Repair List Description :: END-->


                <!--Repair List Status :: START-->
                <div class="form-group">
                    <label>Status</label>
                    <?php
                    $strRepairListStatus = NULL;
                    $strEditRepairListStatus = NULL;
                    if (isset($repairlist_details['status']) && 1 == $repairlist_details['status']) {
                        $strEditRepairListStatus = 1;
                    } else if (isset($repairlist_details['status']) && 0 == $repairlist_details['status']) {
                        $strEditRepairListStatus = 0;
                    }
                    $strFormRepairListStatus = isset($RepairListForm->status) ? $RepairListForm->status : NULL;
                    $strRepairListStatus = !empty($strFormRepairListStatus) ? $strFormRepairListStatus : $strEditRepairListStatus;
                    ?>
                    <select name="repair_list_status" id="status_val">
                         <option value="">--Select Status--</option>
                            <option value="1" <?php
                            if (isset($strRepairListStatus) && 1 == $strRepairListStatus) {
                                echo 'selected';
                                ?>
                            <?php } ?>
                                    >Active
                            </option>
                            <option value="0"
                            <?php
                            if (isset($strRepairListStatus) && 0 == $strRepairListStatus) {
                                echo 'selected';
                                ?>
                            <?php } ?>
                                    >Inactive</option>
                    </select> <?php
                    if (isset($errors['repair_list_status'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['repair_list_status'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
                </div> 
                <!--Repair List Status :: END-->


                <!--Button :: START-->
                <div class="col-md-5">                                   
                    <div class="form-group">
                        <input type="submit" class="btn btn-warning"  name="create_repair_list" id="create_repair_list" value="Create"/>
                    </div> 
                </div> 
                <!--Button :: END-->
            </div>  


        </div>

    </form>                  
</div>		
<br/>
<div class="panel panel-primary pull-left">
    <div class="panel-heading">
        <h3 class="panel-title">Repairlist Report</h3>
    </div>
    <div class="panel-body">
        <table class="datatable table table-striped" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Repair Name</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                if (!empty($repairs_lists)) {
                    
                    foreach ($repairs_lists as $arrEleRepairList) {
                        ?>                                

                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo isset($arrEleRepairList['repair_name']) ? $arrEleRepairList['repair_name'] : NULL; ?></td>
                            <td><?php echo isset($arrEleRepairList['name']) ? $arrEleRepairList['name'] : NULL; ?></td>
                            <td><?php echo isset($arrEleRepairList['code']) ? $arrEleRepairList['code'] : NULL; ?></td>
                            <td><?php echo isset($arrEleRepairList['description']) ? $arrEleRepairList['description'] : NULL; ?></td>
                            <td>
                                <?php
                                $strStatus = 'Active';
                                if (isset($arrEleRepairList['status']) && 0 == $arrEleRepairList['status']) {
                                    $strStatus = 'Inactive';
                                }
                                echo $strStatus;
                                ?>
                            </td>
                             <td align="center">
                                <a href="<?php echo Yii::app()->params['web_url'] . 'EditRepairList/id/' . $arrEleRepairList['id']; ?>">Edit</a>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    }
                }
                unset($repairs_lists);
                unset($i);
                ?>   
            </tbody>
        </table>
    </div>
</div>

