<ul class="nav nav-tabs" role="tablist">
    <li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/User/User/CreateDeliveryBoys">Create Delivery Boy</a></li>
    <li class="active"><a href="<?php echo Yii::app()->baseurl; ?>/index.php/User/User/DeliveryBoysReport">Report</a></li>
</ul>
<div class="tab-content">
    <!--Delivery boys Report Table-->
    <div class="table-responsive">
        <table class="datatable table table-striped" cellspacing="0" width="100%" id="example">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Shop Name</th>
                    <th>Shop Code</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Username</th>
                    <th>Address One</th>
                    <th>Address Two</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($delivery_boys)) {
                    $i = 0;
                    foreach ($delivery_boys as $arrBoy) {
                        $i++;
                        ?>
                        <tr data-toggle="modal" data-id="1" data-target="#signup-model">
                            <td align="center">
                                <?php echo $i; ?>
                            </td>
                            <td align="center">
                                <?php
                                echo isset($arrBoy['shop_name']) ? $arrBoy['shop_name'] : NULL;
                                ?>
                            </td>       
                            <td align="center">
                                <?php
                                echo isset($arrBoy['shop_code']) ? $arrBoy['shop_code'] : NULL;
                                ?>
                            </td>       

                            <td align="center">
                                <?php
                                echo isset($arrBoy['delivery_boy_name']) ? $arrBoy['delivery_boy_name'] : NULL;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                echo isset($arrBoy['delivery_boy_code']) ? $arrBoy['delivery_boy_code'] : NULL;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                echo isset($arrBoy['delivery_boy_email']) ? $arrBoy['delivery_boy_email'] : NULL;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                echo isset($arrBoy['delivery_boy_phone']) ? $arrBoy['delivery_boy_phone'] : NULL;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                echo isset($arrBoy['username']) ? $arrBoy['username'] : NULL;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                echo isset($arrBoy['address_one']) ? $arrBoy['address_one'] : NULL;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                echo isset($arrBoy['address_two']) ? $arrBoy['address_two'] : NULL;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                $status = 'Active';
                                if (0 == $arrBoy['status']) {
                                    $status = 'Inactive';
                                }
                                echo $status;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                if (isset($arrBoy['image']) && !empty($arrBoy['image'])) {
                                    ?>
                                    <img src="<?php echo Yii::app()->params['adminImgURL'] . '/delivery_boys/photo/original/' . $arrBoy['image']; ?>" width="50px"/>
                                    <?php
                                } else {
                                    echo '-';
                                    ?>
                                    <?php
                                }
                                ?>

                            </td>
                            <td align="center">
                                <a href="<?php echo Yii::app()->params['webURL'] . '/User/User/EditDeliveryBoy/id/' . $arrBoy['id']; ?>" class="clickbtn edit-u"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        <?php
                    }
                    unset($delivery_boy_details);
                    unset($delivery_boys);
                    unset($i);
                }
                ?>
            </tbody>
        </table>
    </div>
</div>