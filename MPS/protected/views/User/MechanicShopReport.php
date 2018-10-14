<div class="card-body">
    <ul class="nav nav-tabs" role="tablist">
        <li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/User/User/Mechanic">Create Mechanic Shop</a></li>
        <li class="active"><a href="<?php echo Yii::app()->baseurl; ?>/index.php/User/User/MechanicReport">Report</a></li>
    </ul>

    <div class="table-responsive">
        <table class="datatable table table-striped" cellspacing="0" width="100%" id="example">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>License</th>
                    <th>Owner</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Username</th>
                    <th>Services</th>
                    <th>Total Mechanics</th>
                    <th>Count of services ( Per Day)</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($mechanic_shops)) {
                    $i = 0;
                    foreach ($mechanic_shops as $arrEleShop) {
                        $i++;
                        ?>
                        <tr data-toggle="modal" data-id="1" data-target="#signup-model">
                            <td>
                                <?php echo $i; ?>
                            </td>
                            <td>
                                <?php
                                echo isset($arrEleShop['shop_name']) ? $arrEleShop['shop_name'] : NULL;
                                ?>
                            </td>       
                            <td>
                                <?php
                                echo isset($arrEleShop['shop_code']) ? $arrEleShop['shop_code'] : NULL;
                                ?>
                            </td>       

                            <td>
                                <?php
                                echo isset($arrEleShop['shop_license']) ? $arrEleShop['shop_license'] : NULL;
                                ?>
                            </td>
                            <td>
                                <?php
                                echo isset($arrEleShop['shop_owner']) ? $arrEleShop['shop_owner'] : NULL;
                                ?>
                            </td>
                            <td>
                                <?php
                                echo isset($arrEleShop['shop_email']) ? $arrEleShop['shop_email'] : NULL;
                                ?>
                            </td>
                            <td>
                                <?php
                                echo isset($arrEleShop['shop_phone']) ? $arrEleShop['shop_phone'] : NULL;
                                ?>
                            </td>
                            <td>
                                <?php
                                echo isset($arrEleShop['username']) ? $arrEleShop['username'] : NULL;
                                ?>
                            </td>
                            <td>
                                <?php
                                echo isset($arrEleShop['service_names']) ? $arrEleShop['service_names'] : NULL;
                                ?>
                            </td>
                            <td>
                                <?php
                                echo isset($arrEleShop['total_mechanics']) ? $arrEleShop['total_mechanics'] : NULL;
                                ?>
                            </td>
                            <td>
                                <?php
                                echo isset($arrEleShop['service_capability']) ? $arrEleShop['service_capability'] : NULL;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                $status = 'Active';
                                if (0 == $arrEleShop['status']) {
                                    $status = 'Inactive';
                                }
                                echo $status;
                                ?>
                            </td>
                            <td align="center">
                                <a href="<?php echo Yii::app()->params['webURL'] . '/User/User/EditMechanic/id/' . $arrEleShop['id']; ?>" class="clickbtn edit-u"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        <?php
                    }
                    unset($mechanic_shops);
                    unset($i);
                }
                ?>
            </tbody>
        </table>
    </div>
</div>