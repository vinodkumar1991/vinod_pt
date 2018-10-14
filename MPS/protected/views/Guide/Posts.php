
<ul class="nav nav-tabs" role="tablist">
    <li class=""><a href="<?php echo Yii::app()->params['webURL'] . 'VehicleGuide/GuideCategory' ?>">Guide Category</a></li>
    <li class=""><a href="<?php echo Yii::app()->params['webURL'] . 'VehicleGuide/GuideSubCategory' ?>">Guide Sub Category</a></li>
    <li class="active"><a href="<?php echo Yii::app()->params['webURL'] . 'VehicleGuide/Posts' ?>">Posts</a></li>
</ul>
<div class="table-responsive">
    <table class="datatable table table-striped" cellspacing="0" width="100%" id="example">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Category</th>
                <th>Name</th>
                <th>Code</th>
                <th>Image</th>
                <th>Description</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($guide_sub_categories)) {
                $i = 0;
                foreach ($guide_sub_categories as $arrGuideItem) {
                    $i++;
                    ?>
                    <tr data-toggle="modal" data-id="1" data-target="#signup-model">
                        <td>
                            <?php echo $i; ?>
                        </td>
                        <td>
                            <?php
                            echo isset($arrGuideItem['category_name']) ? $arrGuideItem['category_name'] : NULL;
                            ?>
                        </td>       

                        <td>
                            <?php
                            echo isset($arrGuideItem['sub_category_name']) ? $arrGuideItem['sub_category_name'] : NULL;
                            ?>
                        </td>
                        <td>
                            <?php
                            echo isset($arrGuideItem['sub_category_code']) ? $arrGuideItem['sub_category_code'] : NULL;
                            ?>
                        </td>
                        <td>
                            <img src="<?php echo $guide_images_path . '/' . $arrGuideItem['image_name']; ?>" width="50px" />
                        </td>
                        <td>
                            <?php
                            echo isset($arrGuideItem['sub_category_description']) ? $arrGuideItem['sub_category_description'] : NULL;
                            ?>
                        </td>
                        <td>
                            <?php
                            $status = 'Active';
                            if (isset($arrGuideItem['sub_category_status']) && 2 == $arrGuideItem['sub_category_status']) {
                                $status = 'Inactive';
                            }
                            echo $status;
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                unset($guide_sub_categories);
                unset($i);
            }
            ?>
        </tbody>
    </table>
</div>