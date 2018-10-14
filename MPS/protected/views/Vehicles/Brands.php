
<div class="card-body">

    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="<?php echo Yii::app()->baseurl; ?>/index.php/Vehicles/Brands/createBrand">Create Brand</a></li>
        <li ><a href="<?php echo Yii::app()->baseurl; ?>/index.php/Vehicles/Brands/createBrandReport">Brands Report</a></li>
    </ul>

    <div class="tab-content">
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
        <form class="form-horizontal lcns" method="post" enctype="multipart/form-data">
            <!--Vehicle Types :: START-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Vehicle Types</label>
                <div class="col-sm-3">
                    <select name='vehicle_types' id='vehicle_types' class="form-control">
                        <option value=''>--Select Vehicle--</option>
                        <?php
                        if (!empty($vehicle_types)) {
                            foreach ($vehicle_types as $arrVehicle) {
                                ?>
                                <option value='<?php echo $arrVehicle['id']; ?>'>
                                    <?php
                                    echo $arrVehicle['name'] . ' ( ' . $arrVehicle['code'] . ' ) ';
                                    ?>
                                </option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <?php
                    if (isset($errors['vehicle_types'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['vehicle_types'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!--Vehicle Types :: END-->

            <!--Brand :: START-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-3">
                    <input type="text" name="brand_name" id="brand_name" class="form-control"/>
                </div>
                <?php
                if (isset($errors['brand_name'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['brand_name'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div> 
            <!--Brand :: END-->

            <!--Brand Code :: START-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Code</label>
                <div class="col-sm-3">
                    <input type="text" name="brand_code" id="brand_code" class="form-control"/>
                </div>
                <?php
                if (isset($errors['brand_code'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['brand_code'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div> 
            <!--Brand Code :: END-->

            <!--Brand Description :: START-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-3">
                    <textarea class="form-control alt" placeholder="Enter brand description." name="brand_description" id="brand_description" style="height:120px;"></textarea>
                </div>
                <?php
                if (isset($errors['brand_description'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['brand_description'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div> 
            <!--Brand Description :: END-->


            <!--Logo :: START-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Logo (Note * : valid image extensions are jpg, jpeg, png, gif)</label>
                <div class="col-sm-3">
                    <input type="file" name="vehicle_logo" id="vehicle_logo" data-type="image"  accept="image/*"/>
                    <?php
                    if (isset($errors['vehicle_logo'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['vehicle_logo'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!--Logo :: END-->

            <!--Status :: START-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-3">
                    <select  name='brand_status' id='brand_status'>
                        <option value=''>--Select Status--</option>
                        <option value='1'>Active</option>
                        <option value='2'>Inactive</option>
                    </select>
                    <?php
                    if (isset($errors['brand_status'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['brand_status'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!--Status :: END-->

            <!--Form Submit :: START-->
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type='submit' class="btn btn-warning" name='create_brand' id='create_brand' value = 'Create'/>
                </div>
            </div>
            <!--Form Submit :: END-->
        </form>
    </div>
</div>