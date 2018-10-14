<link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">

<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/jquery.geocomplete.js"></script>

<input type="hidden" value="<?php if(isset($range[0]['min'])) { echo $range[0]['min']; }else {?>0 <?php } ?>" id="min">

<input type="hidden" value="<?php if(isset($range[0]['max'])) { echo $range[0]['max']; }else {?>0 <?php } ?>" id="max">

<script> 

$( document ).ready(function() {

	$('#filters input:checkbox').click(function () {

    if ($('input:checkbox:checked').length) {

        var arrSelected = []; // Create Array of Values

        var arrTypes = []; // Create Array of Types

        $('input:checkbox:checked').each(function () {

            if (arrSelected[$(this).prop('name')] == undefined) {

                arrSelected[$(this).prop('name')] = [];

            }

            arrSelected[$(this).prop('name')].push($(this).val());

            if ($.inArray($(this).prop('name'), arrTypes) < 0) {

                arrTypes.push($(this).prop('name'));

            }

        });

        $('.system').each(function() {

            $(this).hide();   

            var intKeyCount = 0;

            for (key in arrTypes) { // AND (check count of matching types)

                var blnFound = false;

                for (val in arrSelected[arrTypes[key]]) { // OR (check one of values matches type)

                    if ($(this).attr('data-' + arrTypes[key]).indexOf(arrSelected[arrTypes[key]][val]) > -1) {                       

                        blnFound = true;

                        break;

                    }

                }

                if (blnFound) {

                    intKeyCount++;

                }

            }

            if (intKeyCount > 0 && intKeyCount != arrTypes.length - 1) {

                $(this).show();   

            }

        });

    } else {

        $(".system").show();

    }

});

	/*   $('.category').on('change', function(){

      var category_list = [];

      $('#filters :input:checked').each(function(){

        var category = $(this).val();

        category_list.push(category);

      });



      if(category_list.length == 0)

        $('.system').fadeIn();

      else {

        $('.system').each(function(){

          var item = $(this).attr('data-tag');

          if(jQuery.inArray(item,category_list) > -1)

            $(this).fadeIn('slow');

          else

            $(this).hide();

        }); 

      }   

    });  */

	var min=$('#min').val();

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

      });

// datetime picker
     $(".form_datetime").datetimepicker({
        format: 'dd-mm-yyyy hh:ii:ss', 
        autoclose: 1,
        todayHighlight: 1,
		startDate: new Date()
		
    });

// geo location
     $(".geocomplete").geocomplete({
        
          details: "form",
          types: ["geocode", "establishment"],
        });

});




  function filterSystem(minPrice, maxPrice) {

      $("#selfdrive_filter div.system").hide().filter(function () {

          var price = parseInt($(this).data("price"), 10);

          return price >= minPrice && price <= maxPrice;

      }).show();

  }

</script>
        <!-- PAGE -->
        <section class="page-section selfdrive dark">

            <div class="container">
                <form action="SelfdrivedetailsSearch" method="POST" class="form-find-car">
                    <div class="row">
                        <div class="col-md-3 wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
                            <h2 class="section-title text-left no-margin">
                                <small>Choose Your</small>
                                <span>Favorite Vehicle</span>
                            </h2>
                        </div>
                        <div class="col-md-7">
                        <div class="col-md-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
                        <div class="form-group has-icon has-label" data-date-format="mm-dd-yyyy HH:ii p" data-link-field="dtp_input1">
                                <label>Start Trip</label>
                                <input type="text" class="input-group date form_datetime form-control" name="from_date" id="Start-trip" value="<?php $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
								
 if(isset($fromdates)){

									echo $fromdates;

								}else

								 {echo $date->format('d-m-Y H:i:s'); } ?>">						
                                <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>

                        <div class="col-md-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="300ms">
                            <div class="form-group has-icon has-label" data-date-format="mm-dd-yyyy HH:ii p" data-link-field="dtp_input1">
                                <label>End Trip</label>
                                <input type="text" class="input-group date form_datetime form-control" name="to_date" id="End-trip" value="<?php $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
							$date->modify('+1 day');
								if(isset($todates))
								{
									echo $todates;
								}else
								{ echo $date->format('d-m-Y H:i:s'); } ?>">
                                <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                        </div>

                        </div>
                        <div class="col-md-6">
                        <div class="form-group has-icon has-label">
                            <label>Change Location</label>
                            <input type="text" class="form-control geocomplete" id="bookloc" name="bookloc" value="<?php echo Yii::app()->session['location'];?>" placeholder="Current Location">
                            <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                        </div>
                        </div>

                        <div class="col-md-6 doorstp">
                            <div class="form-group">
                            	<label class="doorstepcheck"><input type="checkbox" value="Search" /> Door Step Delivery</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 wow fadeInDown" data-wow-offset="200" data-wow-delay="500ms">
                        <div class="form-group">
                            <button type="submit" id="formFindCarSubmit" name="search" value="search" class="btn btn-block btn-submit ripple-effect btn-theme slf-search">Search</button>
                        </div>
                    </div>

                    </div>

                </form>



            </div>

        </section>

        <!-- /PAGE -->



        <!-- PAGE WITH SIDEBAR -->

        <section class="page-section with-sidebar sub-page">

            <div class="container">

                <div class="row">

                    <!-- CONTENT -->

                    <div class="col-md-9 content car-listing" id="selfdrive_filter">



                        <!-- Car Listing -->

						<?php if(!empty($vehicle_details)){ ?>

		              <?php foreach($vehicle_details as $details) {

						

$feature=explode(',',$details['vehicle_features']); 



					?>



                        <div class="system game thumbnail no-border no-padding thumbnail-car-card clearfix" 

						 data-price="<?php 

						if($details['price']<=100)

						{

							echo 'p1';

						}else if($details['price']<=500)

						{

							echo 'p2';

						}else if($details['price']<=1000)

						{

							echo 'p3';

						}else if($details['price']<=1500)

						{

							echo 'p4';

						}else

						{

							echo 'p5';

						}

						?>" 

						data-cat1="<?php $j=0; while($j<sizeof($feature)-1)

						{  if($feature[$j]=='AudioSystem') echo "AudioSystem";$j++; } ?> "

					

						 data-cat2="<?php $j=0; while($j<sizeof($feature)-1)

						{  if($feature[$j]=='PowerWindow') echo "PowerWindow";$j++; } ?>"

					

					data-cat3="<?php $j=0; while($j<sizeof($feature)-1)

						{  if($feature[$j]=='Bluetooth') echo "Bluetooth"; $j++; } ?>"

					

					data-cat4="<?php $j=0; while($j<sizeof($feature)-1)

						{  if($feature[$j]=='Localandsatelliteradio') echo "Localandsatelliteradio"; $j++;}?>"

					

					data-cat5="<?php $j=0; while($j<sizeof($feature)-1)

						{  if($feature[$j]=='GPSnavigationsystem') echo "GPSnavigationsystem";$j++; }?>">

                        <div class="media col-md-4">
                            <a class="media-link" data-gal="prettyPhoto" href="http://www.metrepersecond.com/MPS<?php echo $details['img_path'];?>">
                                <img src="http://www.metrepersecond.com/MPS<?php echo $details['img_path'];?>" alt="" width="100" />
                                <span class="icon-view"><strong><i class="fa fa-eye"></i></strong></span>
                            </a>
                            <div class="col-md-12 text-center"><h4 class="caption-title"><a href="#"><?php echo $details['makename'];?> <?php echo $details['modelname'];?></a></h4>
                            </div>
                            <div class="col-md-12">                            
                            <h5 class="caption-title-sub">Price Per Hour <?php echo $details['price_per_hour'];?> <span class="pull-right"><?php echo $details['seating_capacity'];?> Seats</span></h5>
                            </div>
                        </div>

                            <div class="caption col-md-8">
                            <table class="table">
							    <tr>
                                    <td>Price </td>
                                    <td><?php echo $details['price'];?>Rs</td>
                                </tr>

                                <tr>
                                   <td>From </td>
					               <td><?php echo date('d-m-Y H:m:s',$details['from_date']);?></td>
                                </tr>

                                <tr>
                                	<td>To</td>
                                	<td><?php echo date('d-m-Y H:m:s',$details['to_date']);?></td>
                                </tr>
                                <tr>
                                    <td>Security Deposit </td>
                                    <td><?php echo $details['security_deposit'];?>Rs</td>
                                </tr>
                                <tr>
                                    <td>Excess Kms</td>
                                    <td><?php echo $details['extra_rate_per_kms'];?>rs/ per Kms</td>
                                </tr>

                            </table>

                                <div class="rating pull-left">
                                    <span class="star"></span>
                                    <span class="star active"></span>
                                    <span class="star active"></span>
                                    <span class="star active"></span>
                                    <span class="star active"></span>
                                </div>

                                <div class="pull-right buttons">
                                <?php

							if(empty(Yii::app()->session['username']))

    						{

                                echo '<a class = "btn btn-theme pull-right" id="btnsub1" data-toggle = "modal" data-target = "#signup-model">Book Now</a>';

    						}else

    						{

							?>

							<a class = "btn btn-theme pull-right" id="btnsub1" href="<?php echo $this->createUrl('Selfdrive/selfdrivebook').'?id='.$details['ID']; ?>">Book now</a>

							<?php

						}



							?></div>

                            </div>

                        </div>

<?php } 

						}else

						{

							echo "No vehicles Available in this Time";

						}

		?>

                        <!-- /Car Listing -->

<?php 

if(isset($pages))

{

 $this->widget('CLinkPager', array(

    'pages' => $pages,

)); 

}

 ?>

                        <!-- Pagination -->

                     <!--   <div class="pagination-wrapper">

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

                    <!-- /CONTENT -->



                    <!-- SIDEBAR -->
                    <aside class="col-md-3 sidebar selfaside" id="sidebar">
                    <!-- /widget -->
						<div class="widget shadow widget-filter-price">
    						<h4 class="widget-title">Category</h4>
                            <div class="widget-content category">
                                <a href="Selfdrivedetails" class="list-group-item">ALL</a>
        						<a href="?id=business" class="list-group-item <?php if($_GET['id']=='business'){  echo 'active'; } ?>">Business Cars</a>
        						<a href="?id=economic" class="list-group-item <?php if($_GET['id']=='economic'){  echo 'active'; } ?>">Economic Cars</a>
        						<a href="?id=premium" class="list-group-item <?php if($_GET['id']=='premium'){  echo 'active'; } ?>">Premium Cars</a>
        						<a href="?id=luxury" class="list-group-item <?php if($_GET['id']=='luxury'){  echo 'active'; } ?>" >Luxury Cars</a>
                            </div>
                        </div>
                    <!-- widget Features filter -->
				    <article id="filters">
    				 <div class="widget shadow widget-filter-price">
    				    <h4 class="widget-title">Features</h4>
                            <div id="category" class="widget-content category">
                                <div class="checkbox list-group-item">
                                    <label><input type="checkbox" name="cat2" value="PowerWindow" id="PowerWindow" />
                                    PowerWindow</label>
                                </div>
                                <div class="checkbox list-group-item">
                                    <label><input type="checkbox" name="cat3" value="Bluetooth" id="Bluetooth" />Bluetooth</label>
                                </div>
                                <div class="checkbox list-group-item">
                                    <label><input type="checkbox" name="cat4" value="Localandsatelliteradio" id="Localandsatelliteradio" />Local and satellite radio</label>
                                </div>
                                <div class="checkbox list-group-item">
                                    <label><input type="checkbox" name="cat5" value="GPSnavigationsystem" id="GPSnavigationsystem" />GPS navigation system</label>
                                </div>
                            </div>
                    </div>
                    <!-- /widget Features filter -->

                    <!-- widget price filter -->
                    <div class="widget shadow widget-filter-price">
                        <h4 class="widget-title">Price Filter</h4>
                            <div id="price" class="widget-content category">
                                <div class="checkbox list-group-item">
                                    <label><input type="checkbox" name="price" value="p1" id="p1" />100</label>
                                </div>
                                <div class="checkbox list-group-item">
                                    <label><input type="checkbox" name="price" value="p2" id="p2" />500</label>
                                </div>
                                <div class="checkbox list-group-item">
                                    <label><input type="checkbox" name="price" value="p3" id="p3" />1000</label>
                                </div>
                                <div class="checkbox list-group-item">
                                    <label><input type="checkbox" name="price" value="p4" id="p4" />1500</label>
                                </div>
                                <div class="checkbox list-group-item">
                                    <label><input type="checkbox" name="price" value="p5" id="p5" />1500 +</label>
                                </div>
                            </div>
    	            </div>
                    <!-- /widget price filter -->
                    </article>
                    <!-- /widget -->

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

        <!-- /PAGE WITH SIDEBAR -->

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

        

     

