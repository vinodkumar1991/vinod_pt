<link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/owl-carousel2/assets/owl.carousel.min.css" rel="stylesheet">        
        <!-- BREADCRUMBS -->
        <section class="page-section breadcrumbs text-right">
            <div class="container">
                <div class="page-header">
                    <h1>FAQS</h1>
                </div>
                <ul class="breadcrumb">
                    <li><a href="<?php echo Yii::app()->homeUrl;?>">Home</a></li>
                    <li><a href="<?php echo $this->createUrl('VehicleGuide/Vehicleguidedetails/'); ?>">Vehicle Guide</a></li>
                    <li class="active">FAQS</li>
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
                                    <ul class="children  <?php 
									if(isset($_GET['id']))
									{
										foreach($value as $subcat) 
										{
												 
												 if($subcat['cat_id']==$categories['cat_id'])
													 {
														 echo 'active';
														}
												 
									}
									}
									else if(isset($_GET['cat_id']) && $categories['cat_id']==$_GET['cat_id']){ echo 'active'; }
									else if($categories['cat_id']==1) { echo 'active'; }
									?>">
										 <?php foreach($value1 as $subcat) { 
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
                        <h4 class="widget-title">HELP &amp; SUPPORT</h4>
                        <div class="widget-content">
                            <p>Call us for all your car and bike needs.</p>
                            <h5 class="widget-title-sub">+91 801 944 80 35</h5>
                            <p><a href="mailto:support@metrepersecond.com">support@metrepersecond.com</a></p>
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
                                <img src="http://www.metrepersecond.com/MPS<?php echo $post['img_path']; ?>"  alt=""></a>
                            </div>
                            <div class="post-header">
                                <h2 class="post-title"><a href="#"><?php echo $post['sub_cat_name']; ?></a></h2>
                                <div class="post-meta">By <a href="#">MPS</a> / <?php echo $post['created_date']; ?>  / <a href="#">Share This Post</a></div>
                            </div>
                            <div class="post-body">
                              
								<?php echo $post['content'];
								?>
                               
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