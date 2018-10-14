<!-- <input type="hidden" value="<?php echo $range[0]['min']; ?>" id="min">

<input type="hidden" value="<?php echo $range[0]['max']; ?>" id="max"> -->

<script>




	
	$(function () {

    var $checkboxes = $("input[id^='type-']");
    $('input[type=checkbox]:checked').attr('checked', false);

    $checkboxes.change(function () {
        var selector = '',
            count = $('input[type=checkbox]:checked').each(function () {
            selector += '.' + this.value;
        }).length,
            items = $('.portfolio-item');
        
        console.log(selector, count, items);
        if (count>0) {
            items.hide().filter(selector).show();
        } else {
            items.show();
        }
    });




/* 	var min=$('#min').val();

var max=$('#max').val();



    $('#slider-container').slider(

	{

		

          range: true,

          min: 0,

          max: max,

          values: [min,max],

          create: function() {

              $("#amount").val("Rs " +min + " - Rs " + max);

          },

          slide: function (event, ui) {

              $("#amount").val("Rs " + ui.values[0] + " - Rs " + ui.values[1]);

              var mi = ui.values[0];

			

              var mx = ui.values[1];

			    filterSystem(mi, mx);

          }

      })

});



  function filterSystem(minPrice, maxPrice) {

      $("#hire_filter div.system").hide().filter(function () {

          var price = parseInt($(this).data("price"), 10);

          return price >= minPrice && price <= maxPrice;

      }).show();

  } */
});
</script>

    <link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">

    <div class="content-area page-hiremch">



        <!-- BREADCRUMBS -->

        <section class="page-section breadcrumbs text-right">

            <div class="container">

                <div class="page-header">

                    <h1>Hire a Mechanic</h1>

                </div>

                <ul class="breadcrumb">

                    <li><a href="<?php echo Yii::app()->homeUrl;?>">Home</a></li>

                    <li  class="active"><a href="#">HireMechanic</a></li>

                    <li><a href="#">Hire it & Payment</a></li>

                </ul>

            </div>

        </section>

        <!-- /BREADCRUMBS -->



        <!-- PAGE WITH SIDEBAR -->

        <section class="page-section with-sidebar sub-page">

            <div class="container">

                <div class="row">

                    <!-- CONTENT -->

                    <div class="col-md-9 content car-listing" id="hire_filter">

						

						<!-- Machanic Listing -->

		 <?php 
		if(!empty($self_details))
		{
		 foreach( $self_details as $hire_detail) { ?>

                        <div class="portfolio-item <?php 

						if($hire_detail['booking_charge']<=100)

						{

							echo "p1"." ";

						}else if($hire_detail['booking_charge']<=500)

						{

							echo "p2"." ";

						}else if($hire_detail['booking_charge']<=1000)

						{

							echo "p3"." ";

						}else if($hire_detail['booking_charge']<=1500)

						{

							echo "p4"." ";

						}else

						{

							echo "p5"." ";

						}

						?>system thumbnail no-border no-padding thumbnail-car-card clearfix" data-price="<?php echo $hire_detail['booking_charge'];?>">

								<div class="pull-left col-md-3"><img src="http://www.metrepersecond.com/MPS/<?php echo $hire_detail['upload_pic_path']; ?>" width="150">
                                </div>
                                <div class="pull-left col-md-9">
                                <div class="rating">
                                    <span class="star"></span>
                                    <span class="star active"></span>
                                    <span class="star active"></span>
                                    <span class="star active"></span>
                                    <span class="star active"></span>
                                </div>
									<h4 class="caption-title"><a href="#"><?php echo Yii::app()->session['sleep'];  echo $hire_detail['name']; ?></a></h4>
									<h5 class="caption-title-sub">Profesional In <?php echo $hire_detail['profesional']; ?></h5>
									<div class="caption-text"><?php echo $hire_detail['description']; ?></div>
								</div>

                                <table class="table">

                                    <tr>

                                        <td><i class="fa fa-cog"></i> <?php echo $hire_detail['Year_of_exp']; ?> Years Exp</td>

                                        <td><i class="fa fa-dashboard"></i> Amount -<?php echo $hire_detail['booking_charge']; ?> RS</td>

                                        <td><i class="fa fa-car"></i> <?php echo $hire_detail['vehicle_type']; ?>	</td>

                                        <td><i class="fa fa-road"></i> </td>

                                        <td class="buttons"><?php
										if(empty(Yii::app()->session['username']))

    						{
                            echo '<a class = "btn btn-theme pull-right" id="btnsub1" data-toggle = "modal" data-target = "#signup-model">Hire</a>';
							}else{

							?>

							<a class = "btn btn-theme pull-right" id="btnsub1" href="<?php echo $this->createUrl('HireMechanic/hireMechanicDetails/',array('id'=>$hire_detail['id'])); ?>">Hire now</a>

							<?php

						}
							?></td>

                                    </tr>

                                </table>

                            </div>
					

		 <?php } 
		 
		}else
		{
			echo "Hire Mechanics not avialable";
		}
		 ?>	

					

<!-- Pagination -->

<?php 

if(isset($pages))

{

 $this->widget('CLinkPager', array(

    'pages' => $pages,

)); 

}

 ?>                      <!--  <div class="pagination-wrapper">

                            <ul class="pagination">

                                <li class="disabled"><a href="#"><i class="fa fa-angle-double-left"></i> Previous</a></li>

                                <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>

                                <li><a href="#">2</a></li>

                                <li><a href="#">3</a></li>

                                <li><a href="#">4</a></li>

                                <li><a href="#">Next <i class="fa fa-angle-double-right"></i></a></li>

                            </ul>

                        </div> -->

                        <!-- /Pagination -->

    </div>
    <!-- SIDEBAR -->
                    <aside class="col-md-3 sidebar selfaside" id="sidebar">
                        <!-- widget -->
                       

                        <!-- vehicle guide helping center -->
						<div class="widget shadow widget-filter-price">
    						<h4 class="widget-title">Category</h4>
                            <div class="widget-content category">
                                <a href="MechanicDetails" class="list-group-item <?php if(!isset($_GET['id'])){  echo 'active'; } ?>">ALL</a>
        						<a href="?id=car" class="list-group-item <?php if($_GET['id']=='car'){  echo 'active'; } ?>">Car</a>
        						<a href="?id=bike" class="list-group-item <?php if($_GET['id']=='bike'){  echo 'active'; } ?>">Bike</a>
        						
                            </div>
                        </div>
                       <div class="widget shadow widget-filter-price">
                        <h4 class="widget-title">Price Filter</h4>
                            <div id="price" class="widget-content category">
                                <div class="checkbox list-group-item">
                                    <label><input type="checkbox" name="price" value="p1" id="type-p1" />100</label>
                                </div>
                                <div class="checkbox list-group-item">
                                    <label><input type="checkbox" name="price" value="p2" id="type-p2" />500</label>
                                </div>
                                <div class="checkbox list-group-item">
                                    <label><input type="checkbox" name="price" value="p3" id="type-p3" />1000</label>
                                </div>
                                <div class="checkbox list-group-item">
                                    <label><input type="checkbox" name="price" value="p4" id="type-p4" />1500</label>
                                </div>
                                <div class="checkbox list-group-item">
                                    <label><input type="checkbox" name="price" value="p5" id="type-p5" />1500 +</label>
                                </div>
                            </div>
    	            </div>

                        <!-- /vehicle guide helping center -->

                        <!-- widget helping center -->

                        <div class="widget shadow widget-helping-center">

                            <h4 class="widget-title">Support Center</h4>

                            <div class="widget-content">

                                <p>Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros.</p>

                                <h5 class="widget-title-sub">+90 555 444 66 33</h5>

                                <p><a href="mailto:support@supportcenter.com">support@supportcenter.com</a></p>

                            </div>

                        </div>

                        <!-- /widget helping center -->

                    </aside>

                    <!-- /SIDEBAR -->

    </div>

    </div>

    </section>



    <script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/jquery-ui/jquery-ui.min.js"></script>

		<?php



				if(empty(Yii::app()->session['username']))

				{

				echo  '<div class = "customer-signup modal fade" id = "signup-model" tabindex = "-1" role = "dialog" 

   aria-labelledby = "myModalLabel" aria-hidden = "true">

   

   <div class = "modal-dialog">

      <div class = "modal-content pull-left">

      <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">&times;</button>       

         <div class = "modal-body pull-left">

            <div class="aside-signup col-md-4">

                <h3 class="block-title">Signup Today and You will be able to</h3>

                    <ul class="list-check">

                        <li>Online Order Status</li>

                        <li>See Ready Hot Deals</li>

                        <li>Love List</li>

                        <li>Sign up to receive exclusive news and private sales</li>

                        <li>Quick Buy Stuffs</li>

                    </ul>

            </div><div class="col-md-8">

                <ul id = "myTab" class = "nav nav-tabs">

                    <li class = "active">

                        <a href = "#logintab" data-toggle = "tab">Login</a>

                    </li>

                    <li>

                        <a href = "#signuptab" data-toggle = "tab">Sign Up</a>

                    </li>   

                </ul>



				

				<!---login block-->

				<div id = "myTabContent" class = "tab-content">

                   <div class = "tab-pane fade in active" id = "logintab">

                      <div class="col-sm-12">

                        

						<input type="hidden" name="makes_idd" id="makes_idd">

				    <input type="hidden" name="model_idd" id="model_idd">

                                <div class="col-md-12">

                                    <div class="form-group"><input class="form-control" type="text" name="uname" id="uname" placeholder="User name or email"></div>

                                </div>                               

                                <div class="col-md-12">

                                    <div class="form-group"><input class="form-control" type="password" name="password" id="password" placeholder="Enter Password"></div>

                                </div>

                                <div class="bottomservice-btn overflowed reservation-now col-md-12 col-lg-6">

                                    <div class="checkbox pull-left">

                                        <input type="checkbox" name="remember" id="checkboxa1">

                                        <label for="checkboxa1">Remember me</label>

                                    </div>

                                </div>

                                <div class="col-md-12 col-lg-6 text-right-lg">

                                    <a href="#" class="forgot-password">forgot password?</a>

                                </div>

                                <div class="col-md-12 text-center">

								

								<div id="loginerror"></div>

								<input type="submit" value="Login" id="btnsub" name="btnsub" class="col-md-12 btn btn-theme"></div>

                                <div class="col-md-6 mrg-top-20">

                                    <a href="#" class="btn btn-theme btn-block btn-icon-left facebook"><i class="fa fa-facebook"></i>Login with Facebook</a>

                                </div>

                                <div class="col-md-6 mrg-top-20">

                                    <a href="#" class="btn btn-theme btn-block btn-icon-left google"><i class="fa fa-google-plus" aria-hidden="true"></i>Login with Google</a>

                                </div>                                

                                

                        

                    </div>

                   </div>                   

                   <div class = "tab-pane fade" id = "signuptab">

				 

                    <div class="col-md-12">

                        <div class="form-group"><input class="form-control alt" type="text" name="regemail" id="regemail"  placeholder="Enter Email*" required></div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group"><input class="form-control alt" type="text" name="reguname" id="reguname" placeholder="Name" required></div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group has-icon has-label">

                            <input type="text" class="form-control alt" id="regmobNo" name="regmobNo" placeholder="Enter Mobile Number*" maxlength="10" required>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group"><input class="form-control alt" type="password" name="regupwd" id="regupwd" placeholder="Enter Password*" required></div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group"><input class="form-control alt" type="password" name="cpwd" id="cpwd" placeholder="Enter Confirm Password*" required></div>

                        <div class="col-md-6">                    

                    </div>

                   </div>

				  

                   <div class="col-md-12 text-center"> <div id="emailerror"></div><input type="button" value="Create Account" id="register" name="register" class="col-md-12 btn btn-theme"></div>

                   <div class="col-md-6 mrg-top-20">

                        <a href="#" class="btn btn-theme btn-block btn-icon-left facebook"><i class="fa fa-facebook"></i>Sign in with Facebook</a>

                    </div>

                    <div class="col-md-6 mrg-top-20">

                        <a href="#" class="btn btn-theme btn-block btn-icon-left google"><i class="fa fa-google-plus" aria-hidden="true"></i>Sign in with Google</a>

                    </div>

                   </div>

				   

            </div>

			

         </div>

         

      </div><!-- /.modal-content -->

   </div><!-- /.modal-dialog -->

  

</div><!-- /.Registration Sign up Modal -->

</div>';

				}

				

				?>