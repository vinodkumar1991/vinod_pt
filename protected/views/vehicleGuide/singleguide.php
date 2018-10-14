<style>
.sticky-wrapper,
.footer{
	display:none;
}
.page-section.sub-page{
	padding-top:0px;
}
</style>    
        <!-- BREADCRUMBS -->

  

        <!-- /BREADCRUMBS -->



        <!-- PAGE WITH SIDEBAR -->

        <section class="page-section with-sidebar sub-page">

            <div class="container">

                <div class="row">

                    <!-- SIDEBAR -->

                 

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
      

        <!-- /PAGE WITH SIDEBAR -->