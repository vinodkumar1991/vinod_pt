
<body>
    <div class="card-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li><a href="<?php echo Yii::app()->params['webURL']; ?>UserService/UserService/Repairs">Add Repair</a></li>
            <li><a href="<?php echo Yii::app()->params['webURL']; ?>UserService/UserService/RepairList">Add Repairlist</a></li>
            <li><a href="<?php echo Yii::app()->params['webURL']; ?>UserService/UserService/RepairListBilling">Billing</a></li>
            <li><a href="<?php echo Yii::app()->params['webURL']; ?>UserService/UserService/BillingReport">Billing Report</a></li>
            <li><a href="<?php echo Yii::app()->params['webURL']; ?>UserService/UserService/AddCategory">Add Category</a></li>
            <li class="active"><a href="<?php echo Yii::app()->params['webURL']; ?>UserService/UserService/AddPlans">Add Plans</a></li>
            <li><a href="<?php echo Yii::app()->params['webURL']; ?>Reports/Orders/Orders/AddPackageAmount">Update package</a></li>

        </ul>
        <!-- Tab panes -->
        <form class="form-horizontal lcns" method="POST" action="AddPlans">							
            <div class="tab-content">
                <div class="col-md-7">                                   

                    <div class="form-group">
                        <label>Plan Name :</label>
                        <input type="text" class="form-control" name="plan_name" id="plan_name" placeholder="Enter Plan Name" >
                        <?php
                        if (isset($errors['plan_name'][0])) {
                            ?>
                            <span id="vmodelerr" style="color:red;">
                                <?php
                                echo $errors['plan_name'][0];
                                ?>
                            </span>
                            <?php
                        }
                        ?>

                    </div> 
                    <div class="form-group">
                        <label>Code :</label>
                        <input type="text" class="form-control" name="code" id="code" placeholder="Enter Code Here" >
                        <?php
                        if (isset($errors['code'][0])) {
                            ?>
                            <span id="vmodelerr" style="color:red;">
                                <?php
                                echo $errors['code'][0];
                                ?>
                            </span>
                            <?php
                        }
                        ?>
                    </div> 
                    <div class="form-group">
                        <label>Description :</label>
                        <textarea  class="form-control" name="desc" id="desc" placeholder="Enter Descriptions Here"></textarea>
                        <?php
                        if (isset($errors['desc'][0])) {
                            ?>
                            <span id="vmodelerr" style="color:red;">
                                <?php
                                echo $errors['desc'][0];
                                ?>
                            </span>
                            <?php
                        }
                        ?>
                    </div> 
                    <div class="form-group">
                        <label>Status :</label>
                        <select name="status_val" id="status_val">
                            <option value="">-- Select Status --</option>
                            <option value="1">Active</option>
                            <option value="0">In Active</option>
                        </select>
                        <?php
                        if (isset($errors['status_val'][0])) {
                            ?>
                            <span id="vmodelerr" style="color:red;">
                                <?php
                                echo $errors['status_val'][0];
                                ?>
                            </span>
                            <?php
                        }
                        ?>
                    </div> 
                    <div class="col-md-5">                                   
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning"  name="add_plan" id="add_plan" onClick="locsubmit();">Submit</button>
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
                </div>  


            </div>

        </form>                  
    </div>
    <div class="panel panel-primary pull-left">
        <div class="panel-heading">
            <h3 class="panel-title">Category List</h3>
        </div>
        <div class="panel-body">
            <table class="datatable table table-striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Sl No.</th>
                        <th>Plan Name</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Created Date</th>
                        <th>Status</th>




                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($PlanDetails as $PlanDetail) {
                        ?>                                

                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $PlanDetail['name']; ?></td>
                            <td><?php echo $PlanDetail['code']; ?></td>
                            <td><?php echo $PlanDetail['description']; ?> </td>
                            <td><?php echo date('m/d/Y', strtotime($PlanDetail['created_date'])); ?> </td>
                            <td>Active</td>

                        </tr>


                        <?php
                        $i++;
                    }
                    unset($CategoryDetails);
                    ?>   
                </tbody>
            </table>
        </div>
    </div>
</body>
