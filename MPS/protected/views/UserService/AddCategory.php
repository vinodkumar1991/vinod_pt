
<body>
    <div class="card-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
        <li><a href="<?php echo Yii::app()->params['webURL']; ?>UserService/UserService/Repairs">Add Repair</a></li>
        <li><a href="<?php echo Yii::app()->params['webURL']; ?>UserService/UserService/RepairList">Add Repairlist</a></li>
        <li><a href="<?php echo Yii::app()->params['webURL']; ?>UserService/UserService/RepairListBilling">Billing</a></li>
        <li><a href="<?php echo Yii::app()->params['webURL']; ?>UserService/UserService/BillingReport">Billing Report</a></li>
        <li class="active"><a href="<?php echo Yii::app()->params['webURL']; ?>UserService/UserService/AddCategory">Add Category</a></li>
        <li><a href="<?php echo Yii::app()->params['webURL']; ?>UserService/UserService/AddPlans">Add Plans</a></li>
        <li><a href="<?php echo Yii::app()->params['webURL']; ?>Reports/Orders/Orders/AddPackageAmount">Update package</a></li>
        </ul>
        <!-- Tab panes -->
        <form class="form-horizontal lcns" method="POST" action="AddCategory">							
            <div class="tab-content">
                <div class="col-md-5">                                   
                    <div class="form-group">
                        <label>Vehicle Type :</label>
                        <select name="veh_type" id="veh_type">
                            <option value="">-- Select Vehicle Type --</option>
                            <option value="2">Bike</option>
                            <option value="1">Car</option>
                        </select>
                        <?php
                        if (isset($errors['veh_type'][0])) {
                            ?>
                            <span id="vmodelerr" style="color:red;">
                                <?php
                                echo $errors['veh_type'][0];
                                ?>
                            </span>
                            <?php
                        }
                        ?>
                    </div> 
                    <div class="form-group">
                        <label>Category Name :</label>
                        <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Enter Category Name" >
                        <?php
                        if (isset($errors['category_name'][0])) {
                            ?>
                            <span id="vmodelerr" style="color:red;">
                                <?php
                                echo $errors['category_name'][0];
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
                        <label>Description</label>
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
                        <label>Status</label>
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
                            <button type="submit" class="btn btn-warning"  name="add_cat" id="add_cat" onClick="locsubmit();">Submit</button>
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
                        <th>Vehicle Type</th>
                        <th>Category Name</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Created Date</th>
                        <th>Status</th>




                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($CategoryDetails as $CategoryDetail) {
                        ?>                                

                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $CategoryDetail['VehType']; ?></td>
                            <td><?php echo $CategoryDetail['name']; ?></td>
                            <td><?php echo $CategoryDetail['code']; ?></td>
                            <td><?php echo $CategoryDetail['description']; ?> </td>
                            <td><?php echo date('m/d/Y', strtotime($CategoryDetail['created_date'])); ?> </td>
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
