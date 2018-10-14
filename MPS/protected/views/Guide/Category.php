
<div class="card-body">

    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="<?php echo Yii::app()->params['webURL'] . 'VehicleGuide/GuideCategory' ?>">Guide Category</a></li>
        <li class=""><a href="<?php echo Yii::app()->params['webURL'] . 'VehicleGuide/GuideSubCategory' ?>">Guide Sub Category</a></li>
        <li class=""><a href="<?php echo Yii::app()->params['webURL'] . 'VehicleGuide/Posts' ?>">Posts</a></li>
    </ul>

    <div class="tab-content">
        <!--Operation Message :: START-->
        <?php if (Yii::app()->user->hasFlash('success')) { ?>
            <div class="throw_success">
                <?php echo Yii::app()->user->getFlash('success'); ?>
            </div>
        <?php } else if (Yii::app()->user->hasFlash('failure')) { ?>
            <div class="throw_warning">
                <?php echo Yii::app()->user->getFlash('failure'); ?>
            </div>
            <?php
        }
        ?>
        <div class="col-md-4">
        <!--Operation Message :: END-->
        <form class="form-horizontal lcns" method="post" enctype="multipart/form-data">
            <!--Name :: START-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-8">
                    <input type="text" name="guide_category_name" id="guide_category_name" value="<?php echo isset($guide_category_form['guide_category_name']) ? $guide_category_form['guide_category_name'] : NULL; ?>" class="form-control"/>
                </div>
                <?php
                if (isset($errors['guide_category_name'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['guide_category_name'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div> 
            <!--Name :: END-->

            <!--Code :: START-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Code</label>
                <div class="col-sm-8">
                    <input type="text" name="guide_category_code" id="guide_category_code" value="<?php echo isset($guide_category_form['guide_category_code']) ? $guide_category_form['guide_category_code'] : NULL; ?>" class="form-control"/>
                </div>
                <?php
                if (isset($errors['guide_category_code'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['guide_category_code'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div> 
            <!--Code :: END-->

            <!--Description :: START-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-8">
                    <textarea class="form-control alt" placeholder="Enter Category description." name="guide_category_description" id="guide_category_description" style="height:120px;"><?php echo isset($guide_category_form['guide_category_description']) ? $guide_category_form['guide_category_description'] : NULL; ?></textarea>
                </div>
                <?php
                if (isset($errors['guide_category_description'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['guide_category_description'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div> 
            <!--Description :: END-->

            <!--Status :: START-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-8">
                    <select  name='guide_category_status' id='guide_category_status' class="form-control">
                        <option value=''>--Select Status--</option>
                        <option value='1'>Active</option>
                        <option value='2'>Inactive</option>
                    </select>
                    <?php
                    if (isset($errors['guide_category_status'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['guide_category_status'][0];
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
                    <input type='submit' class="btn btn-warning" name='guide_create_category' id='guide_create_category' value = 'Create'/>
                </div>
            </div>
            <!--Form Submit :: END-->
        </form>
        </div>
        <div class="col-md-8">
        <div class="table-responsive">
            <table class="datatable table table-striped" cellspacing="0" width="100%" id="example">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($guide_categories)) {
                        $i = 0;
                        foreach ($guide_categories as $arrGuideItem) {
                            $i++;
                            ?>
                            <tr data-toggle="modal" data-id="1" data-target="#signup-model">
                                <td align="center">
                                    <?php echo $i; ?>
                                </td>
                                <td align="center">
                                    <?php
                                    echo isset($arrGuideItem['category_name']) ? $arrGuideItem['category_name'] : NULL;
                                    ?>
                                </td>       

                                <td align="center">
                                    <?php
                                    echo isset($arrGuideItem['category_code']) ? $arrGuideItem['category_code'] : NULL;
                                    ?>
                                </td>
                                <td align="center">
                                    <?php
                                    echo isset($arrGuideItem['category_description']) ? $arrGuideItem['category_description'] : NULL;
                                    ?>
                                </td>
                                <td align="center">
                                    <?php
                                    $status = 'Active';
                                    if (isset($arrGuideItem['category_status']) && 2 == $arrGuideItem['category_status']) {
                                        $status = 'Inactive';
                                    }
                                    echo $status;
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        unset($guide_categories);
                        unset($i);
                    }
                    ?>
                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>

