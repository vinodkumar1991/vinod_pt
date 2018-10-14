<style>
    #preloader,
    .sticky-wrapper,
    .sticky-wrapper.is-sticky,
    .header.fixed,
    .subscribe,
    .footer{
        display: none !important;
    }
</style>
<section class="page-section with-sidebar sub-page">
    <div class="container">
        <div class="row">
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
                                <div class="post-meta">By <a href="#">MPS </a> /  <?php echo isset($arrSubCategoryItem['post_created_date']) ? $arrSubCategoryItem['post_created_date'] : NULL; ?>/<a href="#">Share This Post</a>
                                </div>
                            </div>
                            <div class="post-body">
                                <div class="post-excerpt">
                                    <?php
                                    echo isset($arrSubCategoryItem['sub_category_description']) ? $arrSubCategoryItem['sub_category_description'] : NULL;
                                    ?>
                                </div>
                            </div>
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



