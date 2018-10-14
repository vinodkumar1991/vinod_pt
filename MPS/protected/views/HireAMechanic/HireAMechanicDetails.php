  <ul class="nav nav-tabs" role="tablist">
        <li>
            <a href="<?php echo Yii::app()->params['webURL'] . 'SelfDrive/Agent/Create1'; ?>">Create</a>
        </li>
        <li class="active">
            <a href="<?php echo Yii::app()->params['webURL'] . 'SelfDrive/Agent/HireReport'; ?>">Report</a>
        </li>
    </ul>
<div class="row">
    <div class="col-md-offset-2 col-md-9">
        <form name="hire_experience_details_form" id="hire_experience_details_form" method="POST">
            <div class="input_fields_wrap">
                <div class="row">
                    <!--Vehicle Categories :: START-->
                    <div class="col-md-6">
                        <label class="col-md-6">Vehicle Category</label>
                        <div class="col-md-6">
                            <select name="hire_vehicle_category" id="hire_vehicle_category" class="form-control">
                                <option value="">--Select Category--</option>
                                <?php
                                if ($vehicle_categories) {
                                    foreach ($vehicle_categories as $arrCategories) {
                                        ?>
                                        <option value="<?php echo $arrCategories['id']; ?>"><?php echo $arrCategories['name']; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <?php
                            echo isset($errors['hire_vehicle_category'][0]) ? $errors['hire_vehicle_category'][0] : NULL;
                            ?>
                        </div>
                    </div>
                    <!--Vehicle Categories :: END-->

                    <!--Vehicle Brands :: START-->
                    <div class="col-md-6">
                        <label class="col-md-6">Vehicle Brand</label>
                        <div class="col-md-6">
                            <select name="hire_vehicle_brand" id="hire_vehicle_brand" class="form-control" onChange="getBrandModel(this.value)">
                                <option value="">--Select Brand--</option>
                                <?php
                                if (!empty($vehicle_brands)) {
                                    foreach ($vehicle_brands as $arrBrands) {
                                        ?>
                                        <option value="<?php echo $arrBrands['id']; ?>"><?php echo $arrBrands['name']; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <?php
                            echo isset($errors['hire_vehicle_brand'][0]) ? $errors['hire_vehicle_brand'][0] : NULL;
                            ?>
                        </div>
                    </div>
                    <!--Vehicle Brands :: END-->

                    <!--Vehicle Models :: START-->
                    <div class="col-md-6">
                        <label class="col-md-6">Vehicle Model</label>
                        <div class="col-md-6">
                            <select name="hire_vehicle_model" id="hire_vehicle_model" class="form-control">
                                <option value="">--Select Model--</option>
                            </select>
                            <?php
                            echo isset($errors['hire_vehicle_model'][0]) ? $errors['hire_vehicle_model'][0] : NULL;
                            ?>
                        </div>
                    </div>
                    <!--Vehicle Models :: END-->

                    <!--Experience :: START-->
                    <!--Years :: START-->
                    <div class="col-md-6">
                        <label class="col-md-6">Years</label>
                        <div class="col-md-6">
                            <select name="hire_years" id="hire_years" class="form-control">
                                <option value="">--Select Year--</option>
                                <?php
                                for ($i = 0; $i <= 25; $i++) {
                                    ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <?php
                            echo isset($errors['hire_years'][0]) ? $errors['hire_years'][0] : NULL;
                            ?>
                        </div>
                    </div>
                    <!--Years :: END-->
                    <!--Months :: START-->
                    <div class="col-md-6">
                        <label class="col-md-6">Months</label>
                        <div class="col-md-6">
                            <select name="hire_months" id="hire_months" class="form-control">
                                <option value="">--Select Month--</option>
                                <?php
                                for ($j = 0; $j <= 11; $j++) {
                                    ?>
                                    <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <?php
                            echo isset($errors['hire_months'][0]) ? $errors['hire_months'][0] : NULL;
                            ?>
                        </div>
                    </div>
                    <!--Months :: END-->
                    <!--Experience :: END-->

                    <!--Price :: START-->
                    <div class="col-md-6">
                        <label class="col-md-6">Price Per Hour</label>
                        <div class="col-md-6">
                            <input type="text" name="hire_per_hr_price" id="hire_per_hr_price" class="form-control">
                        </div>
                        <?php
                        echo isset($errors['hire_per_hr_price'][0]) ? $errors['hire_per_hr_price'][0] : NULL;
                        ?>
                    </div>
                    <!--Price :: END-->

                </div>  
            </div>
            <div class="form-group text-center">
                <input type="submit" class="btn btn-warning" name="hire_add_experience" id="hire_add_experience" value="Add Experience">
            </div>
        </form>
    </div>
</div>


<div class="card-body">
    <div class="table-responsive">
        <table class="datatable table table-striped" cellspacing="0" width="100%" id="example">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Vehicle Type</th>
                    <th>Vehicle Category</th>
                    <th>Vehicle Brand</th>
                    <th>Vehicle Model</th>
                    <th>Experience</th>
                    <th>Price Per Hour</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($hire_skills)) {
                    $i = 0;
                    foreach ($hire_skills as $arrSkill) {
                        $i++;
                        ?>
                        <tr data-toggle="modal" data-id="1">
                            <td align="center">
                                <?php echo $i; ?>
                            </td>
                            <td align="center">
                                <?php
                                echo isset($arrSkill['vehicle_category']) ? $arrSkill['vehicle_category'] : NULL;
                                ?>
                            </td>       
                            <td align="center">
                                <?php
                                echo isset($arrSkill['vehicle_category']) ? $arrSkill['vehicle_category'] : NULL;
                                ?>
                            </td>       

                            <td align="center">
                                <?php
                                echo isset($arrSkill['vehicle_brand']) ? $arrSkill['vehicle_brand'] : NULL;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                echo isset($arrSkill['vehicle_model']) ? $arrSkill['vehicle_model'] : NULL;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                $intYears = isset($arrSkill['years']) ? $arrSkill['years'] : 0;
                                $intMonths = isset($arrSkill['months']) ? $arrSkill['months'] : 0;
                                echo $intYears . '.' . $intMonths . ' Years';
                                unset($intYears, $intMonths);
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                echo isset($arrSkill['price_per_hr']) ? $arrSkill['price_per_hr'] : 0.00;
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                    unset($hire_skills);
                    unset($i);
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


<script type="text/javascript">
    function getBrandModel(intVehicleBrand) {
        var objVehicleBrand = {};
        objVehicleBrand = {
            vehicleBrand: intVehicleBrand,
        };
        $.post('<?php echo Yii::app()->params['webURL'] . '/Vehicles/Vehicles/getVehicleBrandModels' ?>', objVehicleBrand, function (response) {
            if (response.length > 0) {
                $("#hire_vehicle_model").html("");
                $("#hire_vehicle_model").append(response);
            } else {
                $("#hire_vehicle_model").html("");
            }
            return true;
        });
        return true;
    }
</script>
