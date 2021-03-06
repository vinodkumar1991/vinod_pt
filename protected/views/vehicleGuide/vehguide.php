
<link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/owl-carousel2/assets/owl.carousel.min.css" rel="stylesheet">        
        <!-- BREADCRUMBS -->

        <section class="page-section breadcrumbs text-right">

            <div class="container">

                <div class="page-header">

                    <h1>Vehicle Guide</h1>

                </div>

                <ul class="breadcrumb">

                    <li><a href="<?php echo Yii::app()->homeUrl;?>">Home</a></li>

                    <li><a href="#">Vehicle Guide</a></li>

                   

                </ul>

            </div>

        </section>

        <!-- /BREADCRUMBS -->



        <!-- PAGE WITH SIDEBAR -->

        <section class="page-section with-sidebar sub-page">

            <div class="container">

                <div class="row">

                    <!-- SIDEBAR -->

                    <aside class="col-md-3 sidebar" id="sidebar">

                    <!-- widget search -->

                    <div class="widget shadow">

                        <div class="widget-search">

                            <input class="form-control" type="text" placeholder="Search">

                            <button><i class="fa fa-search"></i></button>

                        </div>

                    </div>

                    <!-- /widget search -->

                    <!-- widget car categories -->

                    <div class="widget shadow car-categories">

                        <h4 class="widget-title">Categories</h4>

                        <div class="widget-content">

                            <ul>
						<?php foreach($cat as $categories) { ?>
                                <li>
                                    <span class="arrow"><i class="fa fa-angle-down"></i></span>
						
                                    <a href="<?php echo $this->createUrl('VehicleGuide/Vehicleguidedetails'); ?>?cat_id=<?php echo $categories['cat_id']; ?>"> <?php echo $categories['category_name']; ?> </a>

                                    <ul class="children <?php if($categories['cat_id']==1) { echo 'active'; }else if(isset($_GET['cat_id']) && $categories['cat_id']==$_GET['cat_id']){ echo 'active'; } ?>">
										 <?php foreach($value as $subcat) { 
										 if($categories['cat_id']==$subcat['cat_id']) {   ?>
                                        <li><a href="<?php echo $this->createUrl('VehicleGuide/singleguidedetail/',array('id'=>$subcat['id'])); ?>"><?php echo $subcat['sub_cat_name']; ?></a></li>
										 <?php } } ?>
                                    </ul>

                                </li>
						<?php } ?>

                            </ul>

                        </div>

                    </div>

                    <!-- /widget car categories -->

                    <!-- widget helping center -->

                    <div class="widget shadow widget-helping-center">

                        <h4 class="widget-title">Helping Center</h4>

                        <div class="widget-content">

                            <p>Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros.</p>

                            <h5 class="widget-title-sub">+90 555 444 66 33</h5>

                            <p><a href="mailto:support@supportcenter.com">support@supportcenter.com</a></p>

                            <div class="button">

                                <a href="#" class="btn btn-block btn-theme btn-theme-dark">Support Center</a>

                            </div>

                        </div>

                    </div>

                    <!-- /widget helping center -->

                    </aside>

                    <!-- /SIDEBAR -->



                    <!-- CONTENT -->
                    <div class="col-md-9 content" id="content">
			<?php foreach($value as $post){ ?>
                        <!-- Blog posts -->
                        <article class="post-wrap">
                            <div class="post-media">
                                <a href="http://www.metrepersecond.com/MPS<?php echo $post['img_path']; ?>" data-gal="prettyPhoto">
                                <img src="http://www.metrepersecond.com/MPS<?php echo $post['img_path']; ?>" alt=""></a>
                            </div>
                            <div class="post-header">
                                <h2 class="post-title"><a href="<?php echo $this->createUrl('VehicleGuide/singleguidedetails/',array('id'=>$post['id'])); ?>"><?php echo $post['sub_cat_name']; ?></a></h2>
                                <div class="post-meta">By <a href="#">MPS </a> /  <?php echo $post['created_date']; ?>/<a href="#">Share This Post</a></div>
                            </div>
                            <div class="post-body">
                                <div class="post-excerpt">
									<?php $string = strip_tags($post['content']);

										if (strlen($string) > 2) {

											// truncate string
											$stringCut = substr($string, 0, 150);

											// make sure it ends in a word so assassinate doesn't become ass...
											$string = substr($stringCut, 0, strrpos($stringCut, ' '));
											
										}
										echo $string;
										
								?>
                                </div>
                            </div>
                            <div class="post-footer">
                                <span class="post-read-more"><a href="<?php echo $this->createUrl('VehicleGuide/singleguidedetails/',array('id'=>$post['id'])); ?>" class="btn btn-theme btn-theme-transparent btn-icon-left">Read more</a></span>
                            </div>
                        </article>
			<?php } ?>
                       
                    </div>
                    <!-- /CONTENT -->



                </div>

            </div>

        </section>
        <script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/owl-carousel2/owl.carousel.min.js"></script>

        <!-- /PAGE WITH SIDEBAR -->