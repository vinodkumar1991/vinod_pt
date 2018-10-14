
<link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/owl-carousel2/assets/owl.carousel.min.css" rel="stylesheet">        
<!--Bread Crumb :: START-->
<section class="page-section breadcrumbs text-right">
    <div class="container">
        <div class="page-header">
            <h1>Vehicle Guide</h1>
        </div>
        <ul class="breadcrumb">
            <li><a href="<?php echo Yii::app()->homeUrl; ?>">Home</a></li>
            <li><a href="#">Vehicle Guide</a></li>

        </ul>
    </div>
</section>
<!--Bread Crumb :: END-->

<section class="page-section with-sidebar sub-page">
    <div class="container">
        <div class="row">
            <!--Left Panel :: START-->
            <aside class="col-md-3 sidebar" id="sidebar">
                <!--Search :: START-->
                <div class="widget shadow">
                    <div class="widget-search">
                        <input class="form-control" type="text" placeholder="Search">
                        <button><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <!--Search :: END-->

                <!--Categories And Sub Categories :: START-->
                <div class="widget shadow car-categories">
                    <h4 class="widget-title">Categories</h4>
                    <div class="widget-content">
                        <ul>
                            <?php
                            if (!empty($modified_categories)) {
                                foreach ($modified_categories as $strCategory => $arrSubCategory) {
                                    ?>
                                    <li>
                                        <span class="arrow"><i class="fa fa-angle-down"></i></span>

                                        <a href="<?php echo Yii::app()->params['webURL'] . '/VehicleGuide/Home/id/' . $primary_categories[$strCategory]; ?>"> 
                                            <?php echo $strCategory; ?>
                                        </a>
                                        <ul class="children">
                                            <?php
                                            foreach ($arrSubCategory as $arrSubCategoryItem) {
                                                ?>
                                                <li>
                                                    <a href="<?php echo Yii::app()->params['webURL'] . '/VehicleGuide/Home/sub_category_id/' . $arrSubCategoryItem['sub_category_id']; ?>">
                                                        <?php
                                                        echo isset($arrSubCategoryItem['sub_category_name']) ? $arrSubCategoryItem['sub_category_name'] : NULL;
                                                        ?>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </li>

                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <!--Categories And Sub Categories :: END-->

                <!--Help :: START-->
                <div class="widget shadow widget-helping-center">
                    <h4 class="widget-title">
                        <?php
                        echo Yii::app()->params['customer_info']['tag'];
                        ?>
                    </h4>
                    <div class="widget-content">
                        <p>
                            <?php
                            echo Yii::app()->params['customer_info']['message'];
                            ?>
                        </p>
                        <h5 class="widget-title-sub">
                            <?php
                            echo Yii::app()->params['customer_info']['support_mobile'];
                            ?>
                        </h5>
                        <p>
                            <a href="mailto:<?php
                            echo Yii::app()->params['customer_info']['support_mail'];
                            ?>">
                                   <?php
                                   echo Yii::app()->params['customer_info']['support_mail'];
                                   ?>
                            </a>
                        </p>
                    </div>
                </div>
                <!--Help :: END-->
            </aside>
            <!--Left Panel :: END-->


            <!--Content :: START-->
            <div class="col-md-9 content" id="content">
                <?php
                if (!empty($all_sub_categories)) {
                    foreach ($all_sub_categories as $arrSubCategoryItem) {
                        ?>
                        <!-- Blog posts -->
                        <article class="post-wrap">
                            <!--Image :: START-->
                            <div class="post-media">
                                <a href="" data-gal="prettyPhoto">
                                    <img src="<?php echo Yii::app()->params['adminImgURL'] . $source_image_url . $arrSubCategoryItem['image_name']; ?>" alt="">
                                </a>
                            </div>
                            <!--Image :: END-->

                            <div class="post-header">
                                <h2 class="post-title">
                                    <!--Category Name :: START-->
                                    <a href="">
                                        <?php echo isset($arrSubCategoryItem['sub_category_name']) ? $arrSubCategoryItem['sub_category_name'] : NULL; ?>
                                    </a>
                                    <!--Category Name :: END-->
                                </h2>
                                <div class="post-meta">By <a href="#">MPS </a> /  <?php echo isset($arrSubCategoryItem['post_created_date']) ? $arrSubCategoryItem['post_created_date'] : NULL; ?>/<a href="#">Share This Post</a>
                                </div>
                            </div>
                            <div class="post-body">
                                <div class="post-excerpt">
                                    <?php
                                    //$strSubCategoryDescription = strip_tags($arrSubCategoryItem['sub_category_description']);
                                    $strSubCategoryDescription = $arrSubCategoryItem['sub_category_description'];
                                    if (!empty($strSubCategoryDescription) && strlen($strSubCategoryDescription) > 2 && 0 == $read_more) {
                                        $strMinimized = substr($strSubCategoryDescription, 0, 150);
                                        $strSubCategoryDescription = substr($strMinimized, 0, strrpos($strMinimized, ' '));
                                    }
                                    echo $strSubCategoryDescription;
                                    ?>
                                </div>
                            </div>
                            <?php
                            if (0 == $read_more) {
                                ?>
                                <div class="post-footer">
                                    <span class="post-read-more">
                                        <a href="<?php echo Yii::app()->params['webURL'] . 'VehicleGuide/Home/sub_category_read_more/' . $arrSubCategoryItem['sub_category_id']; ?>" class="btn btn-theme btn-theme-transparent btn-icon-left">Read more</a>
                                    </span>
                                </div>
                                <?php
                            }
                            ?>
                        </article>
                        <?php
                    }
                }
                ?>
            </div>
            <!--Content :: START-->
        </div>
    </div>
</section>


<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/owl-carousel2/owl.carousel.min.js"></script>
