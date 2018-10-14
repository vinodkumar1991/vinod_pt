<?php

/* echo Yii::app()->session['var'];
exit; */
/* echo '<select>'; //echo   Yii::app()->request->baseUrl.'/images/';

//exit;
foreach ($vmakelist as $vmake) {
																					//echo $vmake['makes_name'];
																					echo "<option  value=".$vmake['logo_img'].">".$vmake['logo_img']."</option>";
																				}
echo '</select>'; 
 */
?>

<script>
$(document).ready(function()
{
	$('#carlist li').click(function() {
     //Get the id of list items
       var vmakeid = $(this).attr('id');
	   
	   $( "#makes_id" ).val(vmakeid);
		//return false;
     // alert($( "li " ).text());
	 
				//alert(vmakeid);
				$.post('index.php/mPSVEHICLES_DETAILS/Getvmodel',{
						Maker:vmakeid,
					},
					function(data)
					{
							alert(data);
							
					     $("#modellist").html(data);
							
					});
			
   });
 $("#modellist").on('click','li',function (){
    text1=$(this).text();
	//$('#span1').text(text1);
	alert(text1);
   
});



</script>
<!--<img src="bookAservice/images/uploadimages/models/car/test.jpg" name="a" id="a"/>-->
<img src="http://localhost/bookAservice/images/uploadimages/models/car/phpDA90.tmp" alt="Smiley face" height="42" width="42">
	<input type="text" name="makes_id" id="makes_id"/>
																<input type="text" name="model_id" id="model_id"/>
<link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/owl-carousel2/assets/owl.carousel.min.css" rel="stylesheet">

	<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/dropdownscript.js"></script>

        <!-- PAGE -->
        <section class="page-section no-padding slider">
                    <div class="container full-width">

                        <div class="main-slider">
                            <div class="owl-carousel" id="main-slider">

                            <!-- Add Your Vehicle Slide  -->
                                <div class="item slide0 ver0">
                                    <div class="caption">
                                        <div class="container">
                                            <div class="div-table">
                                                <div class="div-cell">
                                                    <div class="caption-content">
                                                        <!-- Search form -->
                                                        <div class="form-search light">
                                                            <form action="index.php/mPSVEHICLES_DETAILS/saveVehicle" method="post">
                                                                <div class="form-title">
                                                                    <h2>Add Your Vehicle</h2>
                                                                </div>
															
                                                                <div class="row row-inputs">
                                                                    <div class="container-fluid">
                                                                    <div class="vehiclestype">
                                                                    <div class="col-sm-6 text-center">
                                                                        <a href="#addcar"><i class="fa fa-car" aria-hidden="true"></i>
                                                                        <h2>Car</h2></a>
                                                                    </div>
                                                                    <div class="col-sm-6 text-center">
                                                                        <a href="#addbike"><i class="fa fa-motorcycle" aria-hidden="true"></i>
                                                                        <h2>Bike</h2></a>
                                                                    </div>
                                                                    </div>
                                                                    <!-- Add Vehicle Car -->
                                                                    <div id="addcar" class="vehicles">
                                                                    <div class="row row-inputs">
                                                                    <div class="container-fluid">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group has-icon has-label">
                                                                            <label for="formSearchOffLocation3">Choose Brand</label>
																			<div id="carsbrand" class="wrapper-dropdown-3" tabindex="1">
																			<span>Select The Car Brands</span>
																				<ul class="dropdown scrollable-menu" id="carlist">
																					
																					<?php
																			 foreach ($vmakelist as $vmake) {
																					//echo $vmake['makes_name'];

																			echo '<li id="'.$vmake['makes_id'].'"><a href="#">'.$vmake['makes_name'].' <img src="http://localhost/beena/bookAservice'.$vmake['logo_img'].'"></a></li>';
																			
																				} 
																				?>
																				</ul>
																				<div class="form-control-icon"><i class="fa fa-sort-desc" aria-hidden="true"></i></div>
																			</div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group has-icon has-label">
                                                                            <label for="formSearchOffLocation3">Choose Model</label>
																			<!-- <ul class="dropdown"></ul> -->
                                                                            <div id="carsmodel" class="wrapper-dropdown-3" tabindex="1">
																				<span id="span1" name="span1">Select The Model</span>
																				<ul class="dropdown scrollable-menu" id="modellist">
																					
																				</ul>
																			<div class="form-control-icon"><i class="fa fa-sort-desc" aria-hidden="true"></i></div>
																			</div>                                                                            
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row row-inputs">
                                                                    <div class="container-fluid">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group has-icon has-label">
                                                                                <label>Select Variant</label>
                                                                                <select class="form-control" name="variant">
                                                                                    <option>Diesel</option>
                                                                                    <option>Petrol</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group has-icon has-label">
                                                                                <label>Last Service On</label>
                                                                                <input type="text" class="form-control datepicker-date" id="vhlclastService" placeholder="dd/mm/yyyy" name="srvion">
                                                                                <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row row-inputs">
                                                                    <div class="container-fluid">
                                                                        <div class="col-sm-6">
                                                                        <label>Vehicle age</label>
																			<input type="text" class="form-control" name="vehage">
                                                                        </div>
																		<div class="col-sm-6">
                                                                        <label>Vehicle No.</label>
																			<input type="text" class="form-control" name="vehno">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row row-submit">
                                                                    <div class="container-fluid">
                                                                        <div class="addvhlcbtn">
                                                                            <button type="submit" id="formSearchSubmit2" class="btn btn-submit btn-theme pull-right">Add Vehicle</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                                <!-- Add Vehicle Car End -->

                                                                <!-- Add Vehicle Bike -->
                                                                <div id="addbike" class="vehicles">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group has-icon has-label">
                                                                                <label for="formSearchUpLocation2">Select Mechanic Type</label>
                                                                                <select class="form-control" id="sel1">
                                                                                    <option>1</option>
                                                                                    <option>2</option>
                                                                                    <option>3</option>
                                                                                    <option>4</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group has-icon has-label">
                                                                                <label for="formSearchOffLocation2">Pick Location for Mechanic</label>
                                                                                <input id="formSearchOffLocation2" class="geocomplete form-control" type="text" placeholder="Location">
                                                                                <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Add Vehicle Bike End -->
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- /Search form -->
                                                        <h2 class="caption-subtitle">Add Your Vehicle</h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add Your Vehicle slide Ending -->                             

                                <!-- Book a Service slide -->
                                <div class="item slide1 ver1">
                                    <div class="caption">
                                        <div class="container">
                                            <div class="div-table">
                                                <div class="div-cell">
                                                    <div class="caption-content">
                                                        <h2 class="caption-title">All Discounts Just For You</h2>
                                                        <h3 class="caption-subtitle">Book a Service</h3>
                                                        <!-- Search form -->
                                                        <div class="row">
                                                            <div class="col-sm-12 col-md-10 col-md-offset-1">

                                                                <div class="form-search dark">
                                                                    <form action="#">
                                                                        <div class="form-title">
                                                                            <i class="fa fa-globe"></i>
                                                                            <h2>Get your vehicle service here</h2>
                                                                        </div>

                                                                        <div class="row row-inputs">
                                                                            <div class="container-fluid">
                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group has-icon has-label">
                                                                                        <label for="formSearchUpLocation">Picking Up Location</label>
                                                                                        <input type="text" class="geocomplete form-control" id="formSearchUpLocation" placeholder="Airport or Anywhere">
                                                                                        <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                                                                                    </div>
                                                                                    <div>
                                                                                        <a href="" class="btn btn-submit btn-theme"><i class="fa fa-map-marker"></i> use zippr map</a>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-3">
                                                                                    <div class="form-group has-icon has-label">
                                                                                        <label for="formSearchUpDate">Picking Up Date</label>
                                                                                        <input type="text" class="form-control" id="formSearchUpDate" placeholder="dd/mm/yyyy">
                                                                                        <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-3">
                                                                                    <div class="form-group has-icon has-label selectpicker-wrapper">
                                                                                        <label>Picking Up Hour</label>
                                                                                        <select
                                                                                            class="selectpicker input-price" data-live-search="true" data-width="100%"
                                                                                            data-toggle="tooltip" title="Select">
                                                                                            <option>20:00 AM</option>
                                                                                            <option>21:00 AM</option>
                                                                                            <option>22:00 AM</option>
                                                                                        </select>
                                                                                        <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row row-submit">
                                                                            <div class="container-fluid">
                                                                                <div class="inner">
                                                                                   <!-- <i class="fa fa-plus-circle"></i> <a href="#">Advanced Search</a> -->
                                                                                    <button type="submit" id="formSearchSubmit" class="btn btn-submit btn-theme pull-right">Book a Service</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <!-- /Search form -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Book a Service slide End -->

                                <!-- Hire a Mechanic Slide -->
                                <div class="item slide2 ver2">
                                    <div class="caption">
                                        <div class="container">
                                            <div class="div-table">
                                                <div class="div-cell">
                                                    <div class="caption-content">
                                                        <!-- Search form -->
                                                        <div class="form-search light">
                                                            <form action="#">
                                                                <div class="form-title">
                                                                    <i class="fa fa-globe"></i>
                                                                    <h2>Hire a Mechanic</h2>
                                                                </div>

                                                                <div class="row row-inputs">
                                                                    <div class="container-fluid">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group has-icon has-label">
                                                                                <label for="formSearchUpLocation2">Select Mechanic Type</label>
                                                                                <select class="form-control" id="sel1">
                                                                                    <option>1</option>
                                                                                    <option>2</option>
                                                                                    <option>3</option>
                                                                                    <option>4</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group has-icon has-label">
                                                                                <label for="formSearchOffLocation2">Pick Location for Mechanic</label>
                                                                                <input id="formSearchOffLocation2" class="geocomplete form-control" type="text" placeholder="Location">
                                                                                <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row row-submit">
                                                                    <div class="container-fluid">
                                                                        <div class="inner">
                                                                            <i class="fa fa-plus-circle"></i> <a href="#">Advanced Search</a>
                                                                            <button type="submit" id="formSearchSubmit2" class="btn btn-submit btn-theme pull-right">Search</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- /Search form -->
                                                        <h2 class="caption-subtitle">Find Your Mechanic</h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Hire a Mechanic Slide End -->

                                <!-- Self Drive Slide -->
                                <div class="item slide3 ver3">
                                    <div class="caption">
                                        <div class="container">
                                            <div class="div-table">
                                                <div class="div-cell">
                                                    <div class="caption-content">
                                                        <!-- Search form -->
                                                        <div class="form-search light">
                                                            <form action="#">
                                                                <div class="form-title">
                                                                    <i class="fa fa-globe"></i>
                                                                    <h2>Search for vehicle for your journey here.</h2>
                                                                </div>

                                                                <div class="row row-inputs">
                                                                    <div class="container-fluid">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group has-icon has-label">
                                                                            <label for="formSearchOffLocation3">Choose Brand</label>
                                                                            <select name="fancySelect" class="makeMeFancy">
                                                                            <option value="0" selected="selected" data-skip="1">Choose Your Product</option>
                                                                            <option value="1" data-icon="assets/img/vhlc-brands/audi.png" data-html-text="Audi">Audi</option>
                                                                            <option value="2" data-icon="assets/img/vhlc-brands/Honda_logo.png" data-html-text="Honda">Honda</option>
                                                                            <option value="3" data-icon="assets/img/vhlc-brands/Hyundai_logo.png" data-html-text="Hyundai">Hyundai</option>
                                                                            </select>
                                                                            <span class="form-control-icon"><i class="fa fa-sort-desc" aria-hidden="true"></i></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group has-icon has-label">
                                                                            <label for="formSearchOffLocation3">Choose Model</label>
                                                                            <select name="fancySelect" class="makeMeFancyModel">
                                                                            <option value="0" selected="selected" data-skip="1">Choose Your Product</option>
                                                                            <option value="1" data-icon="assets/img/vhls-models/ford-EcoSport.png" data-html-text="EcoSport">EcoSport</option>
                                                                            <option value="2" data-icon="assets/img/vhls-models/ford-endeavour.png" data-html-text="Endeavour">Endeavour</option>
                                                                            <option value="3" data-icon="assets/img/vhls-models/ford-fiesta.png" data-html-text="Fiesta">Fiesta</option>
                                                                            </select>
                                                                            <span class="form-control-icon"><i class="fa fa-sort-desc" aria-hidden="true"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row row-inputs">
                                                                    <div class="container-fluid">
                                                                        <div class="col-sm-7">
                                                                            <div class="form-group has-icon has-label">
                                                                                <label for="formSearchUpDate3">Start Trip Date</label>
                                                                                <input type="text" class="form-control datepicker-date" id="formSearchUpDate3" placeholder="dd/mm/yyyy">
                                                                                <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <div class="form-group has-icon has-label selectpicker-wrapper">
                                                                                <label>Picking Up Hour</label>
                                                                                <select
                                                                                    class="selectpicker input-price" data-live-search="true" data-width="100%"
                                                                                    data-toggle="tooltip" title="Select">
                                                                                    <option>20:00 AM</option>
                                                                                    <option>21:00 AM</option>
                                                                                    <option>22:00 AM</option>
                                                                                </select>
                                                                                <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row row-inputs">
                                                                    <div class="container-fluid">
                                                                        <div class="col-sm-7">
                                                                            <div class="form-group has-icon has-label">
                                                                                <label for="formSearchOffDate3">End Trip Date</label>
                                                                                <input type="text" class="form-control datepicker-date" id="formSearchOffDate3" placeholder="dd/mm/yyyy">
                                                                                <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <div class="form-group has-icon has-label selectpicker-wrapper">
                                                                                <label>End Off Hour</label>
                                                                                <select
                                                                                    class="selectpicker input-price" data-live-search="true" data-width="100%"
                                                                                    data-toggle="tooltip" title="Select">
                                                                                    <option>20:00 AM</option>
                                                                                    <option>21:00 AM</option>
                                                                                    <option>22:00 AM</option>
                                                                                </select>
                                                                                <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row row-submit">
                                                                    <div class="container-fluid">
                                                                        <div class="inner">
                                                                            <i class="fa fa-plus-circle"></i> <a href="#">Advanced Search</a>
                                                                            <button type="submit" id="formSearchSubmit3" class="btn btn-submit btn-theme pull-right">Find Car</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- /Search form -->

                                                        <h2 class="caption-title">For rental Cars</h2>
                                                        <h3 class="caption-subtitle">Self Drive</h3>
                                                        <p class="caption-text">
                                                            Sales Up  %45 Off<br/>
                                                            All Rental Cars Start from  49$
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Self Drive Slide End -->

                            </div>
                        </div>

                    </div>
                </section>
        <!-- /PAGE -->

        <!-- PAGE -->
        <section class="page-section">
            <div class="container">

                <div class="row">
                    <div class="col-md-4 wow flipInY" data-wow-offset="70" data-wow-duration="1s">
                        <div class="thumbnail thumbnail-featured no-border no-padding">
                            <div class="media">
                                <a class="media-link" href="#">
                                    <div class="caption">
                                        <div class="caption-wrapper div-table">
                                            <div class="caption-inner div-cell">
                                                <div class="caption-icon"><i class="fa fa-support"></i></div>
                                                <h4 class="caption-title">7/24 Car Support</h4>
                                                <div class="caption-text">Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque,lacinia at tempor vitae, porta at arcu.</div>
                                                <div class="buttons">
                                                    <span class="btn btn-theme ripple-effect btn-theme-transparent">Read More</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="caption hovered">
                                        <div class="caption-wrapper div-table">
                                            <div class="caption-inner div-cell">
                                                <div class="caption-icon"><i class="fa fa-support"></i></div>
                                                <h4 class="caption-title">7/24 Car Support</h4>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 wow flipInY" data-wow-offset="70" data-wow-duration="1s" data-wow-delay="200ms">
                        <div class="thumbnail thumbnail-featured no-border no-padding">
                            <div class="media">
                                <a class="media-link" href="#">
                                    <div class="caption">
                                        <div class="caption-wrapper div-table">
                                            <div class="caption-inner div-cell">
                                                <div class="caption-icon"><i class="fa fa-calendar"></i></div>
                                                <h4 class="caption-title">Reservation Anytime</h4>
                                                <div class="caption-text">Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque,lacinia at tempor vitae, porta at arcu.</div>
                                                <div class="buttons">
                                                    <span class="btn btn-theme ripple-effect btn-theme-transparent">Read More</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="caption hovered">
                                        <div class="caption-wrapper div-table">
                                            <div class="caption-inner div-cell">
                                                <div class="caption-icon"><i class="fa fa-calendar"></i></div>
                                                <h4 class="caption-title">Reservation Anytime</h4>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 wow flipInY" data-wow-offset="70" data-wow-duration="1s" data-wow-delay="400ms">
                        <div class="thumbnail thumbnail-featured no-border no-padding">
                            <div class="media">
                                <a class="media-link" href="#">
                                    <div class="caption">
                                        <div class="caption-wrapper div-table">
                                            <div class="caption-inner div-cell">
                                                <div class="caption-icon"><i class="fa fa-map-marker"></i></div>
                                                <h4 class="caption-title">Lots of Locations</h4>
                                                <div class="caption-text">Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque,lacinia at tempor vitae, porta at arcu.</div>
                                                <div class="buttons">
                                                    <span class="btn btn-theme ripple-effect btn-theme-transparent">Read More</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="caption hovered">
                                        <div class="caption-wrapper div-table">
                                            <div class="caption-inner div-cell">
                                                <div class="caption-icon"><i class="fa fa-map-marker"></i></div>
                                                <h4 class="caption-title">Lots of Locations</h4>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- /PAGE -->

        <!-- PAGE -->
        <section class="page-section dark">
            <div class="container">

                <div class="row">
                    <div class="col-md-6 wow fadeInLeft" data-wow-offset="200" data-wow-delay="100ms">
                        <h2 class="section-title text-left">
                            <small>What Do You Know About Us</small>
                            <span>Who We Are ?</span>
                        </h2>
                        <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. </p>
                        <ul class="list-icons">
                            <li><i class="fa fa-check-circle"></i>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                            <li><i class="fa fa-check-circle"></i>Proin tempus sapien non iaculis pretium.</li>
                        </ul>
                        <p class="btn-row">
                            <a href="#" class="btn btn-theme ripple-effect btn-theme-md">See All Vehicles</a>
                            <a href="#" class="btn btn-theme ripple-effect btn-theme-md btn-theme-transparent">Reservation Now</a>
                        </p>
                    </div>
                    <div class="col-md-6 wow fadeInRight" data-wow-offset="200" data-wow-delay="300ms">
                        <div class="owl-carousel img-carousel">
                            <div class="item"><a href="assets/img/preview/slider/slide-775x500x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/slider/slide-775x500x1.jpg" alt=""/></a></div>
                            <div class="item"><a href="assets/img/preview/slider/slide-775x500x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/slider/slide-775x500x1.jpg" alt=""/></a></div>
                            <div class="item"><a href="assets/img/preview/slider/slide-775x500x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/slider/slide-775x500x1.jpg" alt=""/></a></div>
                            <div class="item"><a href="assets/img/preview/slider/slide-775x500x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/slider/slide-775x500x1.jpg" alt=""/></a></div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- /PAGE -->

        <!-- PAGE -->
        <section class="page-section">
            <div class="container">

                <h2 class="section-title wow fadeInUp" data-wow-offset="70" data-wow-delay="100ms">
                    <small>What a Kind of Car You Want</small>
                    <span>Great Rental Offers for You</span>
                </h2>

                <div class="tabs wow fadeInUp" data-wow-offset="70" data-wow-delay="300ms">
                    <ul id="tabs" class="nav"><!--
                        --><li class=""><a href="#tab-1" data-toggle="tab">Best Offers</a></li><!--
                        --><li class="active"><a href="#tab-2" data-toggle="tab">Popular Cars</a></li><!--
                        --><li class=""><a href="#tab-3" data-toggle="tab">Economic Cars</a></li>
                    </ul>
                </div>

                <div class="tab-content wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">

                    <!-- tab 1 -->
                    <div class="tab-pane fade" id="tab-1">

                        <div class="swiper swiper--offers-best">
                            <div class="swiper-container">

                                <div class="swiper-wrapper">
                                    <!-- Slides -->
                                    <div class="swiper-slide">
                                        <div class="thumbnail no-border no-padding thumbnail-car-card">
                                            <div class="media">
                                                <a class="media-link" data-gal="prettyPhoto" href="assets/img/preview/cars/car-370x220x1.jpg">
                                                    <img src="assets/img/preview/cars/car-370x220x1.jpg" alt=""/>
                                                    <span class="icon-view"><strong><i class="fa fa-eye"></i></strong></span>
                                                </a>
                                            </div>
                                            <div class="caption text-center">
                                                <h4 class="caption-title"><a href="#">VW POLO TRENDLINE 2.0 TDI</a></h4>
                                                <div class="caption-text">Start from 39$/per a day</div>
                                                <div class="buttons">
                                                    <a class="btn btn-theme ripple-effect" href="#">Rent It</a>
                                                </div>
                                                <table class="table">
                                                    <tr>
                                                        <td><i class="fa fa-car"></i> 2013</td>
                                                        <td><i class="fa fa-dashboard"></i> Diesel</td>
                                                        <td><i class="fa fa-cog"></i> Auto</td>
                                                        <td><i class="fa fa-road"></i> 25000</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="thumbnail no-border no-padding thumbnail-car-card">
                                            <div class="media">
                                                <a class="media-link" data-gal="prettyPhoto" href="assets/img/preview/cars/car-370x220x2.jpg">
                                                    <img src="assets/img/preview/cars/car-370x220x2.jpg" alt=""/>
                                                    <span class="icon-view"><strong><i class="fa fa-eye"></i></strong></span>
                                                </a>
                                            </div>
                                            <div class="caption text-center">
                                                <h4 class="caption-title"><a href="#">VW POLO TRENDLINE 2.0 TDI</a></h4>
                                                <div class="caption-text">Start from 39$/per a day</div>
                                                <div class="buttons">
                                                    <a class="btn btn-theme ripple-effect" href="#">Rent It</a>
                                                </div>
                                                <table class="table">
                                                    <tr>
                                                        <td><i class="fa fa-car"></i> 2013</td>
                                                        <td><i class="fa fa-dashboard"></i> Diesel</td>
                                                        <td><i class="fa fa-cog"></i> Auto</td>
                                                        <td><i class="fa fa-road"></i> 25000</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="thumbnail no-border no-padding thumbnail-car-card">
                                            <div class="media">
                                                <a class="media-link" data-gal="prettyPhoto" href="assets/img/preview/cars/car-370x220x3.jpg">
                                                    <img src="assets/img/preview/cars/car-370x220x3.jpg" alt=""/>
                                                    <span class="icon-view"><strong><i class="fa fa-eye"></i></strong></span>
                                                </a>
                                            </div>
                                            <div class="caption text-center">
                                                <h4 class="caption-title"><a href="#">VW POLO TRENDLINE 2.0 TDI</a></h4>
                                                <div class="caption-text">Start from 39$/per a day</div>
                                                <div class="buttons">
                                                    <a class="btn btn-theme ripple-effect" href="#">Rent It</a>
                                                </div>
                                                <table class="table">
                                                    <tr>
                                                        <td><i class="fa fa-car"></i> 2013</td>
                                                        <td><i class="fa fa-dashboard"></i> Diesel</td>
                                                        <td><i class="fa fa-cog"></i> Auto</td>
                                                        <td><i class="fa fa-road"></i> 25000</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="thumbnail no-border no-padding thumbnail-car-card">
                                            <div class="media">
                                                <a class="media-link" data-gal="prettyPhoto" href="assets/img/preview/cars/car-370x220x4.jpg">
                                                    <img src="assets/img/preview/cars/car-370x220x4.jpg" alt=""/>
                                                    <span class="icon-view"><strong><i class="fa fa-eye"></i></strong></span>
                                                </a>
                                            </div>
                                            <div class="caption text-center">
                                                <h4 class="caption-title"><a href="#">VW POLO TRENDLINE 2.0 TDI</a></h4>
                                                <div class="caption-text">Start from 39$/per a day</div>
                                                <div class="buttons">
                                                    <a class="btn btn-theme ripple-effect" href="#">Rent It</a>
                                                </div>
                                                <table class="table">
                                                    <tr>
                                                        <td><i class="fa fa-car"></i> 2013</td>
                                                        <td><i class="fa fa-dashboard"></i> Diesel</td>
                                                        <td><i class="fa fa-cog"></i> Auto</td>
                                                        <td><i class="fa fa-road"></i> 25000</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="swiper-button-next"><i class="fa fa-angle-right"></i></div>
                            <div class="swiper-button-prev"><i class="fa fa-angle-left"></i></div>

                        </div>

                    </div>

                    <!-- tab 2 -->
                    <div class="tab-pane fade active in" id="tab-2">

                        <div class="swiper swiper--offers-popular">
                            <div class="swiper-container">

                                <div class="swiper-wrapper">
                                    <!-- Slides -->
                                    <div class="swiper-slide">
                                        <div class="thumbnail no-border no-padding thumbnail-car-card">
                                            <div class="media">
                                                <a class="media-link" data-gal="prettyPhoto" href="assets/img/preview/cars/car-370x220x1.jpg">
                                                    <img src="assets/img/preview/cars/car-370x220x1.jpg" alt=""/>
                                                    <span class="icon-view"><strong><i class="fa fa-eye"></i></strong></span>
                                                </a>
                                            </div>
                                            <div class="caption text-center">
                                                <h4 class="caption-title"><a href="#">VW POLO TRENDLINE 2.0 TDI</a></h4>
                                                <div class="caption-text">Start from 39$/per a day</div>
                                                <div class="buttons">
                                                    <a class="btn btn-theme ripple-effect" href="#">Rent It</a>
                                                </div>
                                                <table class="table">
                                                    <tr>
                                                        <td><i class="fa fa-car"></i> 2013</td>
                                                        <td><i class="fa fa-dashboard"></i> Diesel</td>
                                                        <td><i class="fa fa-cog"></i> Auto</td>
                                                        <td><i class="fa fa-road"></i> 25000</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="thumbnail no-border no-padding thumbnail-car-card">
                                            <div class="media">
                                                <a class="media-link" data-gal="prettyPhoto" href="assets/img/preview/cars/car-370x220x2.jpg">
                                                    <img src="assets/img/preview/cars/car-370x220x2.jpg" alt=""/>
                                                    <span class="icon-view"><strong><i class="fa fa-eye"></i></strong></span>
                                                </a>
                                            </div>
                                            <div class="caption text-center">
                                                <h4 class="caption-title"><a href="#">VW POLO TRENDLINE 2.0 TDI</a></h4>
                                                <div class="caption-text">Start from 39$/per a day</div>
                                                <div class="buttons">
                                                    <a class="btn btn-theme ripple-effect" href="#">Rent It</a>
                                                </div>
                                                <table class="table">
                                                    <tr>
                                                        <td><i class="fa fa-car"></i> 2013</td>
                                                        <td><i class="fa fa-dashboard"></i> Diesel</td>
                                                        <td><i class="fa fa-cog"></i> Auto</td>
                                                        <td><i class="fa fa-road"></i> 25000</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="thumbnail no-border no-padding thumbnail-car-card">
                                            <div class="media">
                                                <a class="media-link" data-gal="prettyPhoto" href="assets/img/preview/cars/car-370x220x3.jpg">
                                                    <img src="assets/img/preview/cars/car-370x220x3.jpg" alt=""/>
                                                    <span class="icon-view"><strong><i class="fa fa-eye"></i></strong></span>
                                                </a>
                                            </div>
                                            <div class="caption text-center">
                                                <h4 class="caption-title"><a href="#">VW POLO TRENDLINE 2.0 TDI</a></h4>
                                                <div class="caption-text">Start from 39$/per a day</div>
                                                <div class="buttons">
                                                    <a class="btn btn-theme ripple-effect" href="#">Rent It</a>
                                                </div>
                                                <table class="table">
                                                    <tr>
                                                        <td><i class="fa fa-car"></i> 2013</td>
                                                        <td><i class="fa fa-dashboard"></i> Diesel</td>
                                                        <td><i class="fa fa-cog"></i> Auto</td>
                                                        <td><i class="fa fa-road"></i> 25000</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="thumbnail no-border no-padding thumbnail-car-card">
                                            <div class="media">
                                                <a class="media-link" data-gal="prettyPhoto" href="assets/img/preview/cars/car-370x220x4.jpg">
                                                    <img src="assets/img/preview/cars/car-370x220x4.jpg" alt=""/>
                                                    <span class="icon-view"><strong><i class="fa fa-eye"></i></strong></span>
                                                </a>
                                            </div>
                                            <div class="caption text-center">
                                                <h4 class="caption-title"><a href="#">VW POLO TRENDLINE 2.0 TDI</a></h4>
                                                <div class="caption-text">Start from 39$/per a day</div>
                                                <div class="buttons">
                                                    <a class="btn btn-theme ripple-effect" href="#">Rent It</a>
                                                </div>
                                                <table class="table">
                                                    <tr>
                                                        <td><i class="fa fa-car"></i> 2013</td>
                                                        <td><i class="fa fa-dashboard"></i> Diesel</td>
                                                        <td><i class="fa fa-cog"></i> Auto</td>
                                                        <td><i class="fa fa-road"></i> 25000</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-next"><i class="fa fa-angle-right"></i></div>
                            <div class="swiper-button-prev"><i class="fa fa-angle-left"></i></div>

                        </div>

                    </div>

                    <!-- tab 3 -->
                    <div class="tab-pane fade" id="tab-3">

                        <div class="swiper swiper--offers-economic">
                            <div class="swiper-container">

                                <div class="swiper-wrapper">
                                    <!-- Slides -->
                                    <div class="swiper-slide">
                                        <div class="thumbnail no-border no-padding thumbnail-car-card">
                                            <div class="media">
                                                <a class="media-link" data-gal="prettyPhoto" href="assets/img/preview/cars/car-370x220x1.jpg">
                                                    <img src="assets/img/preview/cars/car-370x220x1.jpg" alt=""/>
                                                    <span class="icon-view"><strong><i class="fa fa-eye"></i></strong></span>
                                                </a>
                                            </div>
                                            <div class="caption text-center">
                                                <h4 class="caption-title"><a href="#">VW POLO TRENDLINE 2.0 TDI</a></h4>
                                                <div class="caption-text">Start from 39$/per a day</div>
                                                <div class="buttons">
                                                    <a class="btn btn-theme ripple-effect" href="#">Rent It</a>
                                                </div>
                                                <table class="table">
                                                    <tr>
                                                        <td><i class="fa fa-car"></i> 2013</td>
                                                        <td><i class="fa fa-dashboard"></i> Diesel</td>
                                                        <td><i class="fa fa-cog"></i> Auto</td>
                                                        <td><i class="fa fa-road"></i> 25000</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="thumbnail no-border no-padding thumbnail-car-card">
                                            <div class="media">
                                                <a class="media-link" data-gal="prettyPhoto" href="assets/img/preview/cars/car-370x220x2.jpg">
                                                    <img src="assets/img/preview/cars/car-370x220x2.jpg" alt=""/>
                                                    <span class="icon-view"><strong><i class="fa fa-eye"></i></strong></span>
                                                </a>
                                            </div>
                                            <div class="caption text-center">
                                                <h4 class="caption-title"><a href="#">VW POLO TRENDLINE 2.0 TDI</a></h4>
                                                <div class="caption-text">Start from 39$/per a day</div>
                                                <div class="buttons">
                                                    <a class="btn btn-theme ripple-effect" href="#">Rent It</a>
                                                </div>
                                                <table class="table">
                                                    <tr>
                                                        <td><i class="fa fa-car"></i> 2013</td>
                                                        <td><i class="fa fa-dashboard"></i> Diesel</td>
                                                        <td><i class="fa fa-cog"></i> Auto</td>
                                                        <td><i class="fa fa-road"></i> 25000</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="thumbnail no-border no-padding thumbnail-car-card">
                                            <div class="media">
                                                <a class="media-link" data-gal="prettyPhoto" href="assets/img/preview/cars/car-370x220x3.jpg">
                                                    <img src="assets/img/preview/cars/car-370x220x3.jpg" alt=""/>
                                                    <span class="icon-view"><strong><i class="fa fa-eye"></i></strong></span>
                                                </a>
                                            </div>
                                            <div class="caption text-center">
                                                <h4 class="caption-title"><a href="#">VW POLO TRENDLINE 2.0 TDI</a></h4>
                                                <div class="caption-text">Start from 39$/per a day</div>
                                                <div class="buttons">
                                                    <a class="btn btn-theme ripple-effect" href="#">Rent It</a>
                                                </div>
                                                <table class="table">
                                                    <tr>
                                                        <td><i class="fa fa-car"></i> 2013</td>
                                                        <td><i class="fa fa-dashboard"></i> Diesel</td>
                                                        <td><i class="fa fa-cog"></i> Auto</td>
                                                        <td><i class="fa fa-road"></i> 25000</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="thumbnail no-border no-padding thumbnail-car-card">
                                            <div class="media">
                                                <a class="media-link" data-gal="prettyPhoto" href="assets/img/preview/cars/car-370x220x4.jpg">
                                                    <img src="assets/img/preview/cars/car-370x220x4.jpg" alt=""/>
                                                    <span class="icon-view"><strong><i class="fa fa-eye"></i></strong></span>
                                                </a>
                                            </div>
                                            <div class="caption text-center">
                                                <h4 class="caption-title"><a href="#">VW POLO TRENDLINE 2.0 TDI</a></h4>
                                                <div class="caption-text">Start from 39$/per a day</div>
                                                <div class="buttons">
                                                    <a class="btn btn-theme ripple-effect" href="#">Rent It</a>
                                                </div>
                                                <table class="table">
                                                    <tr>
                                                        <td><i class="fa fa-car"></i> 2013</td>
                                                        <td><i class="fa fa-dashboard"></i> Diesel</td>
                                                        <td><i class="fa fa-cog"></i> Auto</td>
                                                        <td><i class="fa fa-road"></i> 25000</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-next"><i class="fa fa-angle-right"></i></div>
                            <div class="swiper-button-prev"><i class="fa fa-angle-left"></i></div>

                        </div>

                    </div>
                </div>

            </div>
        </section>
        <!-- /PAGE -->

        <!-- PAGE -->
        <section class="page-section testimonials">
            <div class="container wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
                <div class="testimonials-carousel">
                    <div class="owl-carousel" id="testimonials">
                        <div class="testimonial">
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object testimonial-avatar" src="assets/img/preview/avatars/testimonial-140x140x1.jpg" alt="Testimonial avatar">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <div class="testimonial-text">Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</div>
                                    <div class="testimonial-name">John Anthony Gibson <span class="testimonial-position">Co- founder at Rent It</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial">
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object testimonial-avatar" src="assets/img/preview/avatars/testimonial-140x140x1.jpg" alt="Testimonial avatar">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <div class="testimonial-text">Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</div>
                                    <div class="testimonial-name">John Anthony Gibson <span class="testimonial-position">Co- founder at Rent It</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial">
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object testimonial-avatar" src="assets/img/preview/avatars/testimonial-140x140x1.jpg" alt="Testimonial avatar">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <div class="testimonial-text">Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</div>
                                    <div class="testimonial-name">John Anthony Gibson <span class="testimonial-position">Co- founder at Rent It</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /PAGE -->

        <!-- PAGE -->
        <section class="page-section">
            <div class="container">

                <h2 class="section-title wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
                    <small>Select What You Want</small>
                    <span>Our awesome Rental Fleet cars</span>
                </h2>

                <div class="tabs awesome wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
                    <ul id="tabs1" class="nav"><!--
                        --><li class=""><a href="#tab-x1" data-toggle="tab">Economic cars</a></li><!--
                        --><li class="active"><a href="#tab-x2" data-toggle="tab">Business cars</a></li><!--
                        --><li class=""><a href="#tab-x3" data-toggle="tab">Premium cars</a></li><!--
                        --><li class=""><a href="#tab-x4" data-toggle="tab">Luxury cars</a></li>
                    </ul>
                </div>

                <div class="tab-content wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
                    <!-- tab 1 -->
                    <div class="tab-pane fade" id="tab-x1">
                        <div class="car-big-card">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="tabs awesome-sub">
                                        <ul id="tabs4" class="nav"><!--
                                            --><li class=""><a href="#tab-x1x1" data-toggle="tab">VW Passat CC 2.0 TDI</a></li><!--
                                            --><li class="active"><a href="#tab-x1x2" data-toggle="tab">VW Polo 1.6 TDI Comfortline</a></li><!--
                                            --><li class=""><a href="#tab-x1x3" data-toggle="tab">Toyota Corolla 1.6 Elegant</a></li><!--
                                            --><li class=""><a href="#tab-x1x4" data-toggle="tab">Honda Civic Elegance</a></li><!--
                                            --><li class=""><a href="#tab-x1x4" data-toggle="tab">Renoult Megane</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-9">

                                    <!-- Sub tabs content -->
                                    <div class="tab-content">

                                        <div class="tab-content">

                                            <div class="tab-pane fade" id="tab-x1x1">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <!-- Swiper -->
                                                        <div class="swiper-container" id="swiperSlider1x1">
                                                            <div class="swiper-wrapper">
                                                                <div class="swiper-slide">
                                                                    <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                    <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                    <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                    <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                    <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                                </div>
                                                            </div>
                                                            <!-- Add Pagination -->
                                                            <div class="row car-thumbnails"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="car-details">
                                                            <div class="price">
                                                                <strong>111.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                            </div>
                                                            <div class="list">
                                                                <ul>
                                                                    <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                                    <li>Under 25,000 Km</li>
                                                                    <li>Transmission Manual</li>
                                                                    <li>5 Year service included</li>
                                                                    <li>Manufacturing Year 2014</li>
                                                                    <li>5 Doors and Panorama View</li>
                                                                </ul>
                                                            </div>
                                                            <div class="button">
                                                                <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade active in" id="tab-x1x2">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <!-- Swiper -->
                                                        <div class="swiper-container" id="swiperSlider1x2">
                                                            <div class="swiper-wrapper">
                                                                <div class="swiper-slide">
                                                                    <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                    <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                    <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                    <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                    <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                                </div>
                                                            </div>
                                                            <!-- Add Pagination -->
                                                            <div class="row car-thumbnails"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="car-details">
                                                            <div class="price">
                                                                <strong>112.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                            </div>
                                                            <div class="list">
                                                                <ul>
                                                                    <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                                    <li>Under 25,000 Km</li>
                                                                    <li>Transmission Manual</li>
                                                                    <li>5 Year service included</li>
                                                                    <li>Manufacturing Year 2014</li>
                                                                    <li>5 Doors and Panorama View</li>
                                                                </ul>
                                                            </div>
                                                            <div class="button">
                                                                <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="tab-x1x3">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <!-- Swiper -->
                                                        <div class="swiper-container" id="swiperSlider1x3">
                                                            <div class="swiper-wrapper">
                                                                <div class="swiper-slide">
                                                                    <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                    <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                    <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                    <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                    <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                                </div>
                                                            </div>
                                                            <!-- Add Pagination -->
                                                            <div class="row car-thumbnails"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="car-details">
                                                            <div class="price">
                                                                <strong>113.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                            </div>
                                                            <div class="list">
                                                                <ul>
                                                                    <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                                    <li>Under 25,000 Km</li>
                                                                    <li>Transmission Manual</li>
                                                                    <li>5 Year service included</li>
                                                                    <li>Manufacturing Year 2014</li>
                                                                    <li>5 Doors and Panorama View</li>
                                                                </ul>
                                                            </div>
                                                            <div class="button">
                                                                <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="tab-x1x4">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <!-- Swiper -->
                                                        <div class="swiper-container" id="swiperSlider1x4">
                                                            <div class="swiper-wrapper">
                                                                <div class="swiper-slide">
                                                                    <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                    <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                    <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                    <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                    <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                                </div>
                                                            </div>
                                                            <!-- Add Pagination -->
                                                            <div class="row car-thumbnails"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="car-details">
                                                            <div class="price">
                                                                <strong>114.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                            </div>
                                                            <div class="list">
                                                                <ul>
                                                                    <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                                    <li>Under 25,000 Km</li>
                                                                    <li>Transmission Manual</li>
                                                                    <li>5 Year service included</li>
                                                                    <li>Manufacturing Year 2014</li>
                                                                    <li>5 Doors and Panorama View</li>
                                                                </ul>
                                                            </div>
                                                            <div class="button">
                                                                <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="tab-x1x5">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <!-- Swiper -->
                                                        <div class="swiper-container" id="swiperSlider1x5">
                                                            <div class="swiper-wrapper">
                                                                <div class="swiper-slide">
                                                                    <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                    <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                    <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                    <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                    <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                                </div>
                                                            </div>
                                                            <!-- Add Pagination -->
                                                            <div class="row car-thumbnails"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="car-details">
                                                            <div class="price">
                                                                <strong>115.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                            </div>
                                                            <div class="list">
                                                                <ul>
                                                                    <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                                    <li>Under 25,000 Km</li>
                                                                    <li>Transmission Manual</li>
                                                                    <li>5 Year service included</li>
                                                                    <li>Manufacturing Year 2014</li>
                                                                    <li>5 Doors and Panorama View</li>
                                                                </ul>
                                                            </div>
                                                            <div class="button">
                                                                <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <!-- /Sub tabs content -->

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- tab 2 -->
                    <div class="tab-pane fade active in" id="tab-x2">

                        <div class="car-big-card">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="tabs awesome-sub">
                                        <ul id="tabs-x2" class="nav"><!--
                                            --><li class=""><a href="#tab-x2x1" data-toggle="tab">VW Passat CC 2.0 TDI</a></li><!--
                                            --><li class="active"><a href="#tab-x2x2" data-toggle="tab">VW Polo 1.6 TDI Comfortline</a></li><!--
                                            --><li class=""><a href="#tab-x2x3" data-toggle="tab">Toyota Corolla 1.6 Elegant</a></li><!--
                                            --><li class=""><a href="#tab-x2x4" data-toggle="tab">Honda Civic Elegance</a></li><!--
                                            --><li class=""><a href="#tab-x2x5" data-toggle="tab">Renoult Megane</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-9">

                                    <!-- Sub tabs content -->
                                    <div class="tab-content">

                                        <div class="tab-pane fade" id="tab-x2x1">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <!-- Swiper -->
                                                    <div class="swiper-container" id="swiperSlider2x1">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                            </div>
                                                        </div>
                                                        <!-- Add Pagination -->
                                                        <div class="row car-thumbnails"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="car-details">
                                                        <div class="price">
                                                            <strong>121.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                        </div>
                                                        <div class="list">
                                                            <ul>
                                                                <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                                <li>Under 25,000 Km</li>
                                                                <li>Transmission Manual</li>
                                                                <li>5 Year service included</li>
                                                                <li>Manufacturing Year 2014</li>
                                                                <li>5 Doors and Panorama View</li>
                                                            </ul>
                                                        </div>
                                                        <div class="button">
                                                            <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade active in" id="tab-x2x2">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <!-- Swiper -->
                                                    <div class="swiper-container" id="swiperSlider2x2">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                            </div>
                                                        </div>
                                                        <!-- Add Pagination -->
                                                        <div class="row car-thumbnails"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="car-details">
                                                        <div class="price">
                                                            <strong>122.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                        </div>
                                                        <div class="list">
                                                            <ul>
                                                                <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                                <li>Under 25,000 Km</li>
                                                                <li>Transmission Manual</li>
                                                                <li>5 Year service included</li>
                                                                <li>Manufacturing Year 2014</li>
                                                                <li>5 Doors and Panorama View</li>
                                                            </ul>
                                                        </div>
                                                        <div class="button">
                                                            <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab-x2x3">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <!-- Swiper -->
                                                    <div class="swiper-container" id="swiperSlider2x3">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                            </div>
                                                        </div>
                                                        <!-- Add Pagination -->
                                                        <div class="row car-thumbnails"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="car-details">
                                                        <div class="price">
                                                            <strong>123.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                        </div>
                                                        <div class="list">
                                                            <ul>
                                                                <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                                <li>Under 25,000 Km</li>
                                                                <li>Transmission Manual</li>
                                                                <li>5 Year service included</li>
                                                                <li>Manufacturing Year 2014</li>
                                                                <li>5 Doors and Panorama View</li>
                                                            </ul>
                                                        </div>
                                                        <div class="button">
                                                            <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab-x2x4">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <!-- Swiper -->
                                                    <div class="swiper-container" id="swiperSlider2x4">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                            </div>
                                                        </div>
                                                        <!-- Add Pagination -->
                                                        <div class="row car-thumbnails"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="car-details">
                                                        <div class="price">
                                                            <strong>124.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                        </div>
                                                        <div class="list">
                                                            <ul>
                                                                <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                                <li>Under 25,000 Km</li>
                                                                <li>Transmission Manual</li>
                                                                <li>5 Year service included</li>
                                                                <li>Manufacturing Year 2014</li>
                                                                <li>5 Doors and Panorama View</li>
                                                            </ul>
                                                        </div>
                                                        <div class="button">
                                                            <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab-x2x5">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <!-- Swiper -->
                                                    <div class="swiper-container" id="swiperSlider2x5">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                            </div>
                                                        </div>
                                                        <!-- Add Pagination -->
                                                        <div class="row car-thumbnails"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="car-details">
                                                        <div class="price">
                                                            <strong>125.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                        </div>
                                                        <div class="list">
                                                            <ul>
                                                                <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                                <li>Under 25,000 Km</li>
                                                                <li>Transmission Manual</li>
                                                                <li>5 Year service included</li>
                                                                <li>Manufacturing Year 2014</li>
                                                                <li>5 Doors and Panorama View</li>
                                                            </ul>
                                                        </div>
                                                        <div class="button">
                                                            <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /Sub tabs content -->

                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- tab 3 -->
                    <div class="tab-pane fade" id="tab-x3">

                        <div class="car-big-card">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="tabs awesome-sub">
                                        <ul id="tabs-x3" class="nav"><!--
                                            --><li class=""><a href="#tab-x3x1" data-toggle="tab">VW Passat CC 2.0 TDI</a></li><!--
                                            --><li class="active"><a href="#tab-x3x2" data-toggle="tab">VW Polo 1.6 TDI Comfortline</a></li><!--
                                            --><li class=""><a href="#tab-x3x3" data-toggle="tab">Toyota Corolla 1.6 Elegant</a></li><!--
                                            --><li class=""><a href="#tab-x3x4" data-toggle="tab">Honda Civic Elegance</a></li><!--
                                            --><li class=""><a href="#tab-x3x5" data-toggle="tab">Renoult Megane</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-9">

                                    <!-- Sub tabs content -->
                                    <div class="tab-content">

                                        <div class="tab-pane fade" id="tab-x3x1">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <!-- Swiper -->
                                                    <div class="swiper-container" id="swiperSlider3x1">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                            </div>
                                                        </div>
                                                        <!-- Add Pagination -->
                                                        <div class="row car-thumbnails"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="car-details">
                                                        <div class="price">
                                                            <strong>131.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                        </div>
                                                        <div class="list">
                                                            <ul>
                                                                <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                                <li>Under 25,000 Km</li>
                                                                <li>Transmission Manual</li>
                                                                <li>5 Year service included</li>
                                                                <li>Manufacturing Year 2014</li>
                                                                <li>5 Doors and Panorama View</li>
                                                            </ul>
                                                        </div>
                                                        <div class="button">
                                                            <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade active in" id="tab-x3x2">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <!-- Swiper -->
                                                    <div class="swiper-container" id="swiperSlider3x2">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                            </div>
                                                        </div>
                                                        <!-- Add Pagination -->
                                                        <div class="row car-thumbnails"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="car-details">
                                                        <div class="price">
                                                            <strong>132.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                        </div>
                                                        <div class="list">
                                                            <ul>
                                                                <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                                <li>Under 25,000 Km</li>
                                                                <li>Transmission Manual</li>
                                                                <li>5 Year service included</li>
                                                                <li>Manufacturing Year 2014</li>
                                                                <li>5 Doors and Panorama View</li>
                                                            </ul>
                                                        </div>
                                                        <div class="button">
                                                            <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab-x3x3">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <!-- Swiper -->
                                                    <div class="swiper-container" id="swiperSlider3x3">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                            </div>
                                                        </div>
                                                        <!-- Add Pagination -->
                                                        <div class="row car-thumbnails"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="car-details">
                                                        <div class="price">
                                                            <strong>133.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                        </div>
                                                        <div class="list">
                                                            <ul>
                                                                <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                                <li>Under 25,000 Km</li>
                                                                <li>Transmission Manual</li>
                                                                <li>5 Year service included</li>
                                                                <li>Manufacturing Year 2014</li>
                                                                <li>5 Doors and Panorama View</li>
                                                            </ul>
                                                        </div>
                                                        <div class="button">
                                                            <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab-x3x4">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <!-- Swiper -->
                                                    <div class="swiper-container" id="swiperSlider3x4">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                            </div>
                                                        </div>
                                                        <!-- Add Pagination -->
                                                        <div class="row car-thumbnails"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="car-details">
                                                        <div class="price">
                                                            <strong>134.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                        </div>
                                                        <div class="list">
                                                            <ul>
                                                                <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                                <li>Under 25,000 Km</li>
                                                                <li>Transmission Manual</li>
                                                                <li>5 Year service included</li>
                                                                <li>Manufacturing Year 2014</li>
                                                                <li>5 Doors and Panorama View</li>
                                                            </ul>
                                                        </div>
                                                        <div class="button">
                                                            <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab-x3x5">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <!-- Swiper -->
                                                    <div class="swiper-container" id="swiperSlider3x5">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                            </div>
                                                        </div>
                                                        <!-- Add Pagination -->
                                                        <div class="row car-thumbnails"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="car-details">
                                                        <div class="price">
                                                            <strong>135.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                        </div>
                                                        <div class="list">
                                                            <ul>
                                                                <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                                <li>Under 25,000 Km</li>
                                                                <li>Transmission Manual</li>
                                                                <li>5 Year service included</li>
                                                                <li>Manufacturing Year 2014</li>
                                                                <li>5 Doors and Panorama View</li>
                                                            </ul>
                                                        </div>
                                                        <div class="button">
                                                            <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /Sub tabs content -->

                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- tab 4 -->
                    <div class="tab-pane fade" id="tab-x4">

                        <div class="car-big-card">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="tabs awesome-sub">
                                        <ul id="tabs-x4" class="nav"><!--
                                            --><li class=""><a href="#tab-x4x1" data-toggle="tab">VW Passat CC 2.0 TDI</a></li><!--
                                            --><li class="active"><a href="#tab-x4x2" data-toggle="tab">VW Polo 1.6 TDI Comfortline</a></li><!--
                                            --><li class=""><a href="#tab-x4x3" data-toggle="tab">Toyota Corolla 1.6 Elegant</a></li><!--
                                            --><li class=""><a href="#tab-x4x4" data-toggle="tab">Honda Civic Elegance</a></li><!--
                                            --><li class=""><a href="#tab-x4x5" data-toggle="tab">Renoult Megane</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-9">

                                    <!-- Sub tabs content -->
                                    <div class="tab-content">

                                        <div class="tab-pane fade" id="tab-x4x1">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <!-- Swiper -->
                                                    <div class="swiper-container" id="swiperSlider4x1">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                            </div>
                                                        </div>
                                                        <!-- Add Pagination -->
                                                        <div class="row car-thumbnails"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="car-details">
                                                        <div class="price">
                                                            <strong>141.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                        </div>
                                                        <div class="list">
                                                            <ul>
                                                                <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                                <li>Under 25,000 Km</li>
                                                                <li>Transmission Manual</li>
                                                                <li>5 Year service included</li>
                                                                <li>Manufacturing Year 2014</li>
                                                                <li>5 Doors and Panorama View</li>
                                                            </ul>
                                                        </div>
                                                        <div class="button">
                                                            <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade active in" id="tab-x4x2">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <!-- Swiper -->
                                                    <div class="swiper-container" id="swiperSlider4x2">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                            </div>
                                                        </div>
                                                        <!-- Add Pagination -->
                                                        <div class="row car-thumbnails"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="car-details">
                                                        <div class="price">
                                                            <strong>142.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                        </div>
                                                        <div class="list">
                                                            <ul>
                                                                <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                                <li>Under 25,000 Km</li>
                                                                <li>Transmission Manual</li>
                                                                <li>5 Year service included</li>
                                                                <li>Manufacturing Year 2014</li>
                                                                <li>5 Doors and Panorama View</li>
                                                            </ul>
                                                        </div>
                                                        <div class="button">
                                                            <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab-x4x3">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <!-- Swiper -->
                                                    <div class="swiper-container" id="swiperSlider4x3">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                            </div>
                                                        </div>
                                                        <!-- Add Pagination -->
                                                        <div class="row car-thumbnails"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="car-details">
                                                        <div class="price">
                                                            <strong>143.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                        </div>
                                                        <div class="list">
                                                            <ul>
                                                                <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                                <li>Under 25,000 Km</li>
                                                                <li>Transmission Manual</li>
                                                                <li>5 Year service included</li>
                                                                <li>Manufacturing Year 2014</li>
                                                                <li>5 Doors and Panorama View</li>
                                                            </ul>
                                                        </div>
                                                        <div class="button">
                                                            <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab-x4x4">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <!-- Swiper -->
                                                    <div class="swiper-container" id="swiperSlider4x4">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                            </div>
                                                        </div>
                                                        <!-- Add Pagination -->
                                                        <div class="row car-thumbnails"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="car-details">
                                                        <div class="price">
                                                            <strong>144.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                        </div>
                                                        <div class="list">
                                                            <ul>
                                                                <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                                <li>Under 25,000 Km</li>
                                                                <li>Transmission Manual</li>
                                                                <li>5 Year service included</li>
                                                                <li>Manufacturing Year 2014</li>
                                                                <li>5 Doors and Panorama View</li>
                                                            </ul>
                                                        </div>
                                                        <div class="button">
                                                            <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab-x4x5">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <!-- Swiper -->
                                                    <div class="swiper-container" id="swiperSlider4x5">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                            </div>
                                                        </div>
                                                        <!-- Add Pagination -->
                                                        <div class="row car-thumbnails"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="car-details">
                                                        <div class="price">
                                                            <strong>145.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                        </div>
                                                        <div class="list">
                                                            <ul>
                                                                <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                                <li>Under 25,000 Km</li>
                                                                <li>Transmission Manual</li>
                                                                <li>5 Year service included</li>
                                                                <li>Manufacturing Year 2014</li>
                                                                <li>5 Doors and Panorama View</li>
                                                            </ul>
                                                        </div>
                                                        <div class="button">
                                                            <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /Sub tabs content -->

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>
        <!-- /PAGE -->

        <!-- PAGE -->
        <section class="page-section image">
            <div class="container">

                <div class="row">
                    <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
                        <div class="thumbnail thumbnail-counto no-border no-padding">
                            <div class="caption">
                                <div class="caption-icon"><i class="fa fa-heart"></i></div>
                                <div class="caption-number">5657</div>
                                <h4 class="caption-title">Happy costumers</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
                        <div class="thumbnail thumbnail-counto no-border no-padding">
                            <div class="caption">
                                <div class="caption-icon"><i class="fa fa-car"></i></div>
                                <div class="caption-number">657</div>
                                <h4 class="caption-title">Total car count</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="300ms">
                        <div class="thumbnail thumbnail-counto no-border no-padding">
                            <div class="caption">
                                <div class="caption-icon"><i class="fa fa-flag"></i></div>
                                <div class="caption-number">1.255.657</div>
                                <h4 class="caption-title">Total KM/MIL</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="400ms">
                        <div class="thumbnail thumbnail-counto no-border no-padding">
                            <div class="caption">
                                <div class="caption-icon"><i class="fa fa-comments-o"></i></div>
                                <div class="caption-number">1255</div>
                                <h4 class="caption-title">Call Center Solutions</h4>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- /PAGE -->

        <!-- PAGE -->
        <section class="page-section">
            <div class="container">

                <h2 class="section-title wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
                    <small>See What People Ask to Us</small>
                    <span>FAQS</span>
                </h2>

                <div class="row">
                    <div class="col-md-6 wow fadeInLeft" data-wow-offset="200" data-wow-delay="200ms">
                        <!-- FAQ -->
                        <div class="panel-group accordion" id="accordion" role="tablist" aria-multiselectable="true">
                            <!-- faq1 -->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading1">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                            <span class="dot"></span> How can ı dorp the rental car?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
                                    <div class="panel-body">
                                        Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque, lacinia at tempor vitae, porta at arcu. Vestibulum varius non dui at pulvinar. Ut egestas orci in quam sollicitudin aliquet.
                                    </div>
                                </div>
                            </div>
                            <!-- /faq1 -->
                            <!-- faq2 -->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading2">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                            <span class="dot"></span> Where can I rent a car?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
                                    <div class="panel-body">
                                        Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque, lacinia at tempor vitae, porta at arcu. Vestibulum varius non dui at pulvinar. Ut egestas orci in quam sollicitudin aliquet.
                                    </div>
                                </div>
                            </div>
                            <!-- /faq2 -->
                            <!-- faq3 -->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading3">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                            <span class="dot"></span> If I crash a car. What happens?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3">
                                    <div class="panel-body">
                                        Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque, lacinia at tempor vitae, porta at arcu. Vestibulum varius non dui at pulvinar. Ut egestas orci in quam sollicitudin aliquet.
                                    </div>
                                </div>
                            </div>
                            <!-- /faq3 -->
                        </div>
                        <!-- /FAQ -->
                    </div>
                    <div class="col-md-6 wow fadeInRight" data-wow-offset="200" data-wow-delay="200ms">
                        <!-- FAQ -->
                        <div class="panel-group accordion" id="accordion2" role="tablist" aria-multiselectable="true">
                            <!-- faq1 -->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading21">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse21" aria-expanded="false" aria-controls="collapse21">
                                            <span class="dot"></span> How can ı dorp the rental car?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse21" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading21">
                                    <div class="panel-body">
                                        Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque, lacinia at tempor vitae, porta at arcu. Vestibulum varius non dui at pulvinar. Ut egestas orci in quam sollicitudin aliquet.
                                    </div>
                                </div>
                            </div>
                            <!-- /faq1 -->
                            <!-- faq2 -->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading22">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion2" href="#collapse22" aria-expanded="true" aria-controls="collapse22">
                                            <span class="dot"></span> Where can I rent a car?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse22" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading22">
                                    <div class="panel-body">
                                        Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque, lacinia at tempor vitae, porta at arcu. Vestibulum varius non dui at pulvinar. Ut egestas orci in quam sollicitudin aliquet.
                                    </div>
                                </div>
                            </div>
                            <!-- /faq2 -->
                            <!-- faq3 -->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading23">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse23" aria-expanded="false" aria-controls="collapse23">
                                            <span class="dot"></span> If I crash a car. What happens?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse23" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading23">
                                    <div class="panel-body">
                                        Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque, lacinia at tempor vitae, porta at arcu. Vestibulum varius non dui at pulvinar. Ut egestas orci in quam sollicitudin aliquet.
                                    </div>
                                </div>
                            </div>
                            <!-- /faq3 -->
                        </div>
                        <!-- /FAQ -->
                    </div>
                </div>

            </div>
        </section>
        <!-- /PAGE -->

        <!-- PAGE -->
        <section class="page-section find-car dark">
            <div class="container">

                <form action="#" class="form-find-car">
                    <div class="row">

                        <div class="col-md-3 wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">

                            <h2 class="section-title text-left no-margin">
                                <small>Great Rental Cars</small>
                                <span>Find your car</span>
                            </h2>

                        </div>
                        <div class="col-md-3 wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
                            <div class="form-group has-icon has-label">
                                <label for="formFindCarLocation">Picking Up Location</label>
                                <input type="text" class="form-control" id="formFindCarLocation" placeholder="Airport or Anywhere">
                                <span class="form-control-icon"><i class="fa fa-location-arrow"></i></span>
                            </div>
                        </div>
                        <div class="col-md-2 wow fadeInDown" data-wow-offset="200" data-wow-delay="300ms">
                            <div class="form-group has-icon has-label">
                                <label for="formFindCarDate">Picking Up Date</label>
                                <input type="text" class="form-control" id="formFindCarDate" placeholder="dd/mm/yyyy">
                                <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-2 wow fadeInDown" data-wow-offset="200" data-wow-delay="400ms">
                            <div class="form-group has-icon has-label">
                                <label for="formFindCarCategory">Price Category</label>
                                <input type="text" class="form-control" id="formFindCarCategory" placeholder="Select Car Group">
                                <span class="form-control-icon"><i class="fa fa-bars"></i></span>
                            </div>
                        </div>
                        <div class="col-md-2 wow fadeInDown" data-wow-offset="200" data-wow-delay="500ms">
                            <div class="form-group">
                                <button type="submit" id="formFindCarSubmit" class="btn btn-block btn-submit ripple-effect btn-theme">Find Car</button>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </section>
        <!-- /PAGE -->

        <!-- PAGE -->
        <section class="page-section no-padding no-bottom-space-off">
            <div class="container full-width">

                <!-- Google map -->
                <div class="google-map">
                    <div id="map-canvas"></div>
                </div>
                <!-- /Google map -->

            </div>
        </section>
        <!-- /PAGE -->

        <!-- PAGE -->
        <section class="page-section">
            <div class="container">

                <h2 class="section-title wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
                    <small>Rental Magazine Here</small>
                    <span>Recent Blog Posts</span>
                </h2>

                <div class="row">
                    <div class="col-md-6 wow fadeInLeft" data-wow-offset="200" data-wow-delay="200ms">
                        <div class="recent-post alt">
                            <div class="media">
                                <a class="media-link" href="#">
                                    <div class="badge type">Car Service</div>
                                    <div class="badge post"><i class="fa fa-video-camera"></i></div>
                                    <img class="media-object" src="assets/img/preview/blog/recent-post-570x270x1.jpg" alt="">
                                    <i class="fa fa-plus"></i>
                                </a>
                                <div class="media-left">
                                    <div class="meta-date">
                                        <div class="day">21</div>
                                        <div class="month">Dec</div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="media-meta">
                                        By isamercan
                                        <span class="divider">|</span><a href="#"><i class="fa fa-comment"></i>13</a>
                                        <span class="divider">|</span><a href="#"><i class="fa fa-heart"></i>346</a>
                                        <span class="divider">|</span><a href="#"><i class="fa fa-share-alt"></i></a>
                                    </div>
                                    <h4 class="media-heading"><a href="#">Amazing Cars here and best offer waits for you</a></h4>
                                    <div class="media-excerpt">This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 wow fadeInRight" data-wow-offset="200" data-wow-delay="200ms">
                        <div class="recent-post alt">
                            <div class="media">
                                <a class="media-link" href="#">
                                    <div class="badge type">Repair</div>
                                    <div class="badge post"><i class="fa fa-image"></i></div>
                                    <img class="media-object" src="assets/img/preview/blog/recent-post-570x270x2.jpg" alt="">
                                    <i class="fa fa-plus"></i>
                                </a>
                                <div class="media-left">
                                    <div class="meta-date">
                                        <div class="day">21</div>
                                        <div class="month">Dec</div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="media-meta">
                                        By isamercan
                                        <span class="divider">|</span><a href="#"><i class="fa fa-comment"></i>13</a>
                                        <span class="divider">|</span><a href="#"><i class="fa fa-heart"></i>346</a>
                                        <span class="divider">|</span><a href="#"><i class="fa fa-share-alt"></i></a>
                                    </div>
                                    <h4 class="media-heading"><a href="#">Amazing Cars here and best offer waits for you</a></h4>
                                    <div class="media-excerpt">This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center margin-top wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
                    <a href="#" class="btn btn-theme ripple-effect btn-theme-light btn-more-posts">See All Posts</a>
                </div>

            </div>
        </section>
        <!-- /PAGE -->

        <!-- PAGE -->
        <section class="page-section image subscribe">
            <div class="container">

                <h2 class="section-title wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
                    <small>You Can Follow Us By E Mail</small>
                    <span>Subscrıbe</span>
                </h2>

                <div class="row wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
                    <div class="col-md-8 col-md-offset-2">

                        <p class="text-center">This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris.</p>

                        <!-- Subscribe form -->
                        <form action="#" class="form-subscribe">
                            <div class="form-group">
                                <label for="formSubscribeEmail" class="sr-only">Enter your email here</label>
                                <input type="text" class="form-control" id="formSubscribeEmail" placeholder="Enter your email here" title="Email is required">
                            </div>
                            <button type="submit" class="btn btn-submit btn-theme ripple-effect btn-theme-dark">Subscribe</button>
                        </form>
                        <!-- Subscribe form -->

                    </div>
                </div>

            </div>
        </section>
        <!-- /PAGE -->

        <!-- PAGE -->
        <section class="page-section">
            <div class="container">

                <h2 class="section-title wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
                    <small>Do You Have Any Question or Anything else </small>
                    <span>Costumer service</span>
                </h2>

                <!-- Team row -->
                <div class="row">

                    <!-- Team 1 -->
                    <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
                        <div class="thumbnail thumbnail-team no-border no-padding">
                            <div class="media">
                                <img src="assets/img/preview/team/team-270x270x1.jpg" alt=""/>
                            </div>
                            <div class="caption">
                                <h4 class="caption-title">Kelly Doe Surname <small>Costumer Service</small></h4>
                                <ul class="team-details">
                                    <li>Skype: team.member</li>
                                    <li>Tel: 555 555-5555</li>
                                    <li><a href="mailto:supportname@gmail.com">supportname@gmail.com</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /Team 1 -->

                    <!-- Team 2 -->
                    <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
                        <div class="thumbnail thumbnail-team no-border no-padding">
                            <div class="media">
                                <img src="assets/img/preview/team/team-270x270x2.jpg" alt=""/>
                            </div>
                            <div class="caption">
                                <h4 class="caption-title">Name and Surname <small>Team Title</small></h4>
                                <ul class="team-details">
                                    <li>Skype: team.member</li>
                                    <li>Tel: 555 555-5555</li>
                                    <li><a href="mailto:supportname@gmail.com">supportname@gmail.com</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /Team 2 -->

                    <!-- Team 3 -->
                    <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="300ms">
                        <div class="thumbnail thumbnail-team no-border no-padding">
                            <div class="media">
                                <img src="assets/img/preview/team/team-270x270x3.jpg" alt=""/>
                            </div>
                            <div class="caption">
                                <h4 class="caption-title">Jane Elizabeth <small>Tech-Support</small></h4>
                                <ul class="team-details">
                                    <li>Skype: team.member</li>
                                    <li>Tel: 555 555-5555</li>
                                    <li><a href="mailto:supportname@gmail.com">supportname@gmail.com</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /Team 3 -->

                    <!-- Team 4 -->
                    <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="400ms">
                        <div class="thumbnail thumbnail-team no-border no-padding">
                            <div class="media">
                                <img src="assets/img/preview/team/team-270x270x4.jpg" alt=""/>
                            </div>
                            <div class="caption">
                                <h4 class="caption-title">Anthony Hopkins <small>Costumer Service</small></h4>
                                <ul class="team-details">
                                    <li>Skype: team.member</li>
                                    <li>Tel: 555 555-5555</li>
                                    <li><a href="mailto:supportname@gmail.com">supportname@gmail.com</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Team 4 -->

                </div>
                <!-- /Team row -->

            </div>
        </section>
        <!-- /PAGE -->

        <!-- PAGE -->
        <section class="page-section contact dark">
            <div class="container">

                <!-- Get in touch -->

                <h2 class="section-title wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
                    <small>Feel Free to Say Hello!</small>
                    <span>Get in Touch With Us</span>
                </h2>

                <div class="row">
                    <div class="col-md-6 wow fadeInLeft" data-wow-offset="200" data-wow-delay="200ms">
                        <!-- Contact form -->
                        <form name="contact-form" method="post" action="#" class="contact-form" id="contact-form">

                            <div class="row">
                                <div class="col-md-6">

                                    <div class="outer required">
                                        <div class="form-group af-inner has-icon">
                                            <label class="sr-only" for="name">Name</label>
                                            <input
                                                    type="text" name="name" id="name" placeholder="Name" value="" size="30"
                                                    data-toggle="tooltip" title="Name is required"
                                                    class="form-control placeholder"/>
                                            <span class="form-control-icon"><i class="fa fa-user"></i></span>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="outer required">
                                        <div class="form-group af-inner has-icon">
                                            <label class="sr-only" for="email">Email</label>
                                            <input
                                                    type="text" name="email" id="email" placeholder="Email" value="" size="30"
                                                    data-toggle="tooltip" title="Email is required"
                                                    class="form-control placeholder"/>
                                            <span class="form-control-icon"><i class="fa fa-envelope"></i></span>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="outer required">
                                <div class="form-group af-inner has-icon">
                                    <label class="sr-only" for="subject">Subject</label>
                                    <input
                                            type="text" name="subject" id="subject" placeholder="Subject" value="" size="30"
                                            data-toggle="tooltip" title="Subject is required"
                                            class="form-control placeholder"/>
                                    <span class="form-control-icon"><i class="fa fa-bars"></i></span>
                                </div>
                            </div>

                            <div class="form-group af-inner has-icon">
                                <label class="sr-only" for="input-message">Message</label>
                                <textarea
                                        name="message" id="input-message" placeholder="Message" rows="4" cols="50"
                                        data-toggle="tooltip" title="Message is required"
                                        class="form-control placeholder"></textarea>
                                <span class="form-control-icon"><i class="fa fa-bars"></i></span>
                            </div>

                            <div class="outer required">
                                <div class="form-group af-inner">
                                    <input type="submit" name="submit" class="form-button form-button-submit btn btn-block btn-theme ripple-effect btn-theme-dark" id="submit_btn" value="Send message" />
                                </div>
                            </div>

                        </form>
                        <!-- /Contact form -->
                    </div>
                    <div class="col-md-6 wow fadeInRight" data-wow-offset="200" data-wow-delay="200ms">

                        <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum.</p>

                        <ul class="media-list contact-list">
                            <li class="media">
                                <div class="media-left"><i class="fa fa-home"></i></div>
                                <div class="media-body">Adress: 1600 Pennsylvania Ave NW, Washington, D.C.</div>
                            </li>
                            <li class="media">
                                <div class="media-left"><i class="fa fa"></i></div>
                                <div class="media-body">DC 20500, ABD</div>
                            </li>
                            <li class="media">
                                <div class="media-left"><i class="fa fa-phone"></i></div>
                                <div class="media-body">Support Phone: 01865 339665</div>
                            </li>
                            <li class="media">
                                <div class="media-left"><i class="fa fa-envelope"></i></div>
                                <div class="media-body">E mails: info@example.com</div>
                            </li>
                            <li class="media">
                                <div class="media-left"><i class="fa fa-clock-o"></i></div>
                                <div class="media-body">Working Hours: 09:30-21:00 except on Sundays</div>
                            </li>
                            <li class="media">
                                <div class="media-left"><i class="fa fa-map-marker"></i></div>
                                <div class="media-body">View on The Map</div>
                            </li>
                        </ul>

                    </div>
                </div>

                <!-- /Get in touch -->

            </div>
        </section>
        <!-- /PAGE -->


	

<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/owl-carousel2/owl.carousel.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/swiper/js/swiper.jquery.min.js"></script>
	
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/jquery.geocomplete.js"></script>

<script>
      $(function(){
        $(".geocomplete").geocomplete({
        
          details: "form",
          types: ["geocode", "establishment"],
        });

      
      });
</script>



<script>
$(document).ready(function(){
        
        $('.vehiclestype').each(function(){
        
            var $active, $content, $links = $(this).find('a');

            $active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
            $active.addClass('active');
            $content = $($active.attr('href'));
            
            $links.not($active).each(function () {
                $($(this).attr('href')).hide();
            });
            
            $(this).on('click', 'a', function(e){
                var c = this;
                $active.removeClass('active');
                $content.fadeOut("slow", function()
                                 {
                                     $active = $(c);
                                     $content = $($(c).attr('href'));
                                     
                                     $active.addClass('active');
                                     $content.fadeIn("slow");
                                 });
                e.preventDefault();
            });
        });
        
    });
</script>	
	
	
	