<!DOCTYPE html>
<html>
<head>
<title>Metre Per Second - Quick Booking</title>
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->params['frontAssetURL'].'css/bootstrap.min.css'; ?>">
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->params['frontAssetURL'].'css/bootstrap-theme.min.css'; ?>">
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->params['frontAssetURL'].'css/jquery-ui.css'; ?>">
<link href="https://fonts.googleapis.com/css?family=Lato"
	rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->params['frontAssetURL'].'css/quick-booking-default.css'; ?>">
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->params['frontAssetURL'].'css/quick-booking-custom.css'; ?>">
<link rel="shortcut icon"
	href="<?php echo Yii::app()->params['frontAssetURL'].'img/favicon.ico'; ?>" />

<script
	src="<?php echo Yii::app()->params['frontAssetURL'].'js/jquery.min.js'; ?>"></script>
<script
	src="<?php echo Yii::app()->params['frontAssetURL'].'js/bootstrap.min.js'; ?>"></script>
<script
	src="<?php echo Yii::app()->params['frontAssetURL'].'js/jquery-ui.min.js'; ?>"></script>

<!-- <script type="text/javascript" -->
<!-- 	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDqtP2ENbJEwPAzJBsffFncbWhKyucIX8"></script> -->
<!-- <script async defer -->
<!-- 	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDqtP2ENbJEwPAzJBsffFncbWhKyucIX8&callback=initMap" -->
<!-- 	type="text/javascript"></script> -->
<!-- <script type="text/javascript" -->
<!-- 	src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=places"></script> -->
<!-- <script type="text/javascript" -->
<!-- src="<?php //echo Yii::app()->params['frontAssetURL'] . 'js/jquery.placepicker.js'; ?>"></script> -->
</head>


<body id="page-top" data-spy="scroll" data-target=".navbar-custom"
	class="frontend-one-page">



	<div>
		<header>
			<div>
				<nav role="navigation" class="navbar navbar-fixed-top">
					<div class="col-sm-12" style="vertical-align: middle;">
						<div class="col-sm-6 col-xs-12 padding-5">
							<a id="logo" href="<?php echo Yii::app()->params['webURL']; ?>">
								<div class="branding-logo">
									<div class="logo"></div>
									<div class="logo-text">
										<div class="name">Metre Per Second</div>
										<div class="caption">Doorstep Car Care</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-sm-6 col-xs-12 text-right">
							<div class="help-text">
								Need help? Call or Whatsapp
								<p id="mpsNumber"><?php echo Yii::app()->params['customer_info']['support_mobile_without_std']; ?></p>
							</div>
						</div>
					</div>

					<div class="row navbar-custom">
						<div
							class="collapse navbar-collapse navbar-right navbar-main-collapse">

						</div>
					</div>

				</nav>
			</div>
		</header>
		<div class="nav-spacing" id="navSpacing"></div>
	</div>

	<section id="home" class="padding-bottom-50">
		<div class="container">
			<div class="jumbotron"
				style="background-color: transparent !important;">
				<div class="row">
					<div class="col-md-6 hidden-xs">
						<h1 class="text-center" style="font-size: 48px;">Car service,
							repair, and detailing</h1>
						<h2 class="text-center padding-bottom-20"
							style="color: rgb(172, 172, 31); font-size: 36px;">Now at your
							doorstep</h2>
						<ul class="intro-info padding-bottom-20">
							<li class="h3"><img
								src="<?php echo Yii::app()->params['frontAssetURL'] . 'img/timer.png'; ?>"
								class="list-icon" />90 min service</li>
							<li class="h3"><img
								src="<?php echo Yii::app()->params['frontAssetURL'] . 'img/gear.png'; ?>"
								class="list-icon" />Genuine spares</li>
							<li class="h3"><img
								src="<?php echo Yii::app()->params['frontAssetURL'] . 'img/transparency.ico'; ?>"
								class="list-icon" />100% transparent Billing</li>
							<li class="h3"><img
								src="<?php echo Yii::app()->params['frontAssetURL'] . 'img/warranty.png'; ?>"
								class="list-icon" />6 months service warranty</li>
						</ul>
						<div class="h4">
							Metre Per Second is now on Google Play Store <a
								href="<?php echo Yii::app()->params['app_download_link']; ?>"
								target="_blank"><img alt='Get it on Google Play'
								src='https://play.google.com/intl/en_us/badges/images/generic/en_badge_web_generic.png'
								width="120" /></a>
						</div>



						<div class="h4 text-center">
							<p class="contactus-number-font">Interact with us</p>
							<div class="social">
								<a href="https://www.Facebook.com/metrepersecond"
									style="background-color: #405890;"
									class="ico-socialize-facebook1 ico-socialize type2 ico-lg"
									target="_blank"></a> <a
									href="http://instagram.com/metrepersecond_hyd" target="_blank"
									style="background-color: #999;"
									class="ico-socialize-google2 ico-socialize type2 ico-lg"><i
									class="fa fa-google-plus"></i></a>
							</div>
						</div>

					</div>
					<div class="col-md-5 col-md-offset-1"
						style="background-color: #ddd; opacity: 0.9; padding: 20px; border-radius: 20px;">
						<form class="needs-validation" method="post">
							<div class="row">
								<div id="order_success" class="text-success"></div>
							</div>
							<div class="row">
								<h2 style="text-align: center;">Book a service now</h2>
							</div>

							<div class="row">
								<div class="col-sm-12 padding-top-10">
									<label>Name</label> <input type="text" class="form-control"
										name="customer_name" id="customer_name" value=""
										maxlength="100" /> <span id="err_customer_name"
										class="text-danger"></span>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-12 padding-top-10">
									<label for="">Mobile No.</label> <input type="text"
										class="form-control" id="customer_mobile"
										name="customer_mobile" value="" maxlength="10" /> <span
										id="err_customer_mobile" class="text-danger"></span>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-6  padding-top-10">
									<label for="">Make</label> <select class="form-control"
										id="make_id" name="make_id"
										onchange="getMakeModels(this.value);getEstimatedCost()">
										<option value="">--Choose Make--</option>
																					<?php

                    if (! empty($makes)) {
                        foreach ($makes as $arrMake) {
                            ?>
                <option value="<?php echo $arrMake['id']; ?>"><?php echo $arrMake['name']; ?></option>
											        <?php
                        }
                    }
                    ?>
									</select> <span id="err_make" class="text-danger"></span>
								</div>
								<div class="col-sm-6 padding-top-10">
									<label for="">Model</label> <select class="form-control"
										id="model_id" name="model_id" onchange="getEstimatedCost()">
										<option value="">--Choose Model--</option>
									</select> <span id="err_model" class="text-danger"></span>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-6  padding-top-10">
									<label for="">Type Of Service</label> <select
										class="form-control" id="vehicle_service_id"
										name="vehicle_service_id"
										onchange="getEstimatedCost();getServiceDescription(this.value)">
										<option value="">--Choose Service Type--</option>
																					<?php

                    if (! empty($services)) {
                        foreach ($services as $arrService) {
                            ?>
											        <option value="<?php echo $arrService['id'];?>"><?php echo $arrService['name'];?></option>
											        <?php
                        }
                    }
                    ?>
									</select> <span id="err_vehicle_service_id" class="text-danger"></span>
								</div>
								<div class="col-sm-6 padding-top-10">
									<label for="">Estimated Cost (In Rupees)</label> <input
										type="text" class="form-control" id="total_estimated_cost"
										name="total_estimated_cost" value="" readonly /> <span
										id="err_total_estimated_cost" class="text-danger"></span> <input
										type="hidden" id="hidden_total_estimated_cost"
										name="hidden_total_estimated_cost" value="" />
								</div>
							</div>

							<div class="row">
								<div class="col-sm-6  padding-top-10">
									<label for="">Date</label> <input type="text"
										class="form-control" id="booking_date" name="booking_date"
										value="" /> <span id="err_booking_date" class="text-danger"></span>
									<input type="hidden" id="hidden_booked_date"
										name="hidden_booked_date" value="" />
								</div>
								<div class="col-sm-6 padding-top-10">
									<label for="">Time Slot</label> <select class="form-control"
										id="booking_time_slot" name="booking_time_slot">
										<option value="">--Choose Time Slot--</option>
									</select> <span id="err_booking_time_slot" class="text-danger"></span>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-6  padding-top-10">
									<label for="">Year Of Manfacture</label> <input type="text"
										class="form-control" id="vehicle_manfacture_year"
										name="vehicle_manfacture_year" value="" maxlength="4" /> <span
										id="err_vehicle_manfacture_year" class="text-danger"></span>
								</div>
								<div class="col-sm-6 padding-top-10">
									<label for="">Fuel Type</label> <select class="form-control"
										id="vehicle_fuel_type" name="vehicle_fuel_type">
										<option value="">--Choose Fuel Type--</option>
																					<?php

                    if (! empty($vehicle_fuel_types)) {
                        foreach ($vehicle_fuel_types as $arrFuelType) {
                            ?>
											        <option value="<?php echo $arrFuelType['name']; ?>"><?php echo $arrFuelType['name']; ?></option>
											        <?php
                        }
                    }
                    ?>
									</select> <span id="err_vehicle_fuel_type" class="text-danger"></span>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-12 padding-top-10" id="cityList">
									<label for="">Enter Your Area</label> <input type="text"
										class="form-control" id="customer_area" name="customer_area"
										value="" maxlength="55" /> <span id="err_customer_area"
										class="text-danger"></span>
								</div>
							</div>

							<div class="row padding-top-10">
								<div class="col-sm-12">
									<span id="service_note" class="text-info"></span>
								</div>
							</div>

							<div class="row padding-top-10">
								<div class="col-sm-7 padding-top-10">
									<input type="button" class="btn btn-primary btn-lg red-button"
										name="btnSubmit" id="btnSubmit" value="Book my service now"
										onclick="doAsapService()" />
								</div>
								<div class="col-sm-5 padding-top-10">
									or call <a href="#"><span class="span-block"><b><span
												class="city-phone"><?php echo Yii::app()->params['customer_info']['support_mobile_without_std']; ?></span></b></span></a>
								</div>
							</div>
						</form>
					</div>
				</div>


			</div>
		</div>
	</section>

	<section id="how-it-works" class="home-section-background-grey">
		<div class="container">
			<p class="section-header">How it Works?</p>
			<hr class="section-hr" />
			<div class="row">
				<div class="col-md-10 col-md-offset-1 center">
					<div class="col-md-3">
						<div class="how-it-works-image how_it_works_search"></div>
						<p class="how-it-works-header">Select Car</p>
						<p class="how-it-works-description">Select your car make, model
							and year</p>
					</div>
					<div class="col-md-1">
						<div class="next-double"></div>
					</div>
					<div class="col-md-3">
						<div class="how-it-works-image how_it_works_select"></div>
						<p class="how-it-works-header">Choose service</p>
						<p class="how-it-works-description">Choose the appropriate service
							according to your need</p>
					</div>
					<div class="col-md-1">
						<div class="next-double"></div>
					</div>
					<div class="col-md-3">
						<div class="how-it-works-image how_it_works_calendar"></div>
						<p class="how-it-works-header">Choose slot</p>
						<p class="how-it-works-description">Choose date and time slot
							according to your convenience and confirm the booking</p>
					</div>
				</div>
			</div>
			<div class="row">
				<p class="how-it-works-footer">Your car will be serviced at your
					doorstep</p>
			</div>
		</div>
	</section>

	<section id="why-mps360" class="home-section-background-white">
		<div class="container">
			<p class="section-header">Why Metre Per Second?</p>
			<hr class="section-hr" />

			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="col-md-6 padding-bottom-50">
						<div class="why-mps-image why_mps_reminder"></div>
						<p class="how-it-works-header">Service at your Dorostep</p>
						<p class="how-it-works-description">There&rsquo;s no picking your
							vehicle, driving it to another remote location and getting it
							serviced there. Because all services at Metre Per Second are
							provided at your Doorstep which gives you one more option to rely
							on us.</p>
					</div>
					<div class="col-md-6 padding-bottom-50">
						<div class="why-mps-image why_mps_service_record"></div>
						<p class="how-it-works-header">90 minute service</p>
						<p class="how-it-works-description">At Metre Per Second, we
							believe time is everything. And Metre Per Second promises all
							Regular services are performed in less than 90 mins which is 90%
							less than any other Multi brand garages you rely on.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="col-md-6 padding-bottom-50">
						<div class="why-mps-image why_mps_informed_choice"></div>
						<p class="how-it-works-header">6 months service warranty</p>
						<p class="how-it-works-description">All services and repairs at
							Metre Per Second are backed by 6 months service warranty which is
							provided by almost none of the multi brand garage in and around
							your Area.</p>
					</div>
					<div class="col-md-6 padding-bottom-50">
						<div class="why-mps-image why_mps_trust"></div>
						<p class="how-it-works-header">100% transparency</p>
						<p class="how-it-works-description">At Metre Per Second, your
							trust us our primary focus and as all of our services are
							provided at your doorstep, you will have 100% visibility to all
							the spares that we are replacing in your car.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- <section id="about-us" class="home-section-background-grey">
            <div class="container">
                <p class="section-header">About Us</p>
                <hr class="section-hr"/>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 aboutus-block">
                        <div class="about_us_group"></div>
                        <p class="aboutus-note">We are a team of motorbike and car lovers. We want to make vehicles safe for you and the environment.<br/> 
                            A well maintained motorbike rarely breaksdown and keeps you stress-free and in control. We found, often times the reason for<br/>
                            ignoring maintenance is the pain of the process of servicing the vehicle. To address this issue, we went ahead and partnered with the most reliable
                            service stations in the city and created a motorbike maintenance platform. Designed to help you service your vehicle
                            without stepping out, keeping all your service records at one place, remind you of the upcoming service, and also to get you
                            immediate help in case of emergency on road.</p>
                    </div>
                </div>
                    
                
            </div>
        </section> -->

	<!--
        <section id="contact-us" class="home-section-background-grey padding-bottom-50">
            <div class="container">
                <p class="section-header">Contact Us</p>
                <hr class="section-hr"/>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 us-block">
                        <div class="col-lg-7">
                            <form id="contactus" name="contactus" action="" method="post">
                                <div class="row">
                                    <div id="feedbackAlertMessage" class="col-lg-12 mbm"></div>
                                    <div class="col-lg-12 padding-bottom-20">
                                        <input type="text" placeholder="Name" class="form-control input-lg" id="cntName" name="cntName" maxlength="100"/>
                                    </div>
                                    <div class="col-lg-12 padding-bottom-20">
                                        <input type="text" placeholder="Email" class="form-control input-lg" id="cntEmail" name="cntEmail" maxlength="100"/>
                                    </div>
                                    <div class="col-lg-12 padding-bottom-20">
                                        <input type="text" placeholder="Phone" class="form-control input-lg" id="cntPhone" name="cntPhone" maxlength="10"/>
                                    </div>
                                    <div class="col-lg-12">
                                        <textarea placeholder="Message..." rows="8" class="form-control input-lg" id="cntMessage" name="cntMessage" maxlength="1000"></textarea>
                                    </div>
                                    <div class="col-lg-12 padding-top-20">
                                        <button type="submit" id="btnContatUs" name="btnContatUs" class="btn red-button button-Contactus">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-4 col-lg-offset-1 contactUs-helpNumbers">
                            <div class="row">
                                <span class="contactus-number-font">Email us</span><br/>
                                <span class="contactus-number-font"><a class="home-blue" href="mailto:support@metrepersecond.com">support@metrepersecond.com</a></span>
                            </div>
                            <div class="row padding-bottom-20 padding-top-20">
                                <span class="contactus-number-font">Call us</span><br/>
                                <span class="contactus-number-font"><a class="home-blue" href="tel:+91 832 862 0888">(+91) 832 862 0888</a></span>
                            </div>
                                
                            <div class="row">
                                <p class="contactus-number-font">Interact with us</p>
                                <div class="social">
                                <a href="<?php echo Yii::app()->params['social_links']['fb']; ?>" style="background-color:#405890;" class="ico-socialize-facebook1 ico-socialize type2 ico-lg" target="_blank"></a>
                                <a href="<?php echo Yii::app()->params['social_links']['gp']; ?>"  target="_blank" style="background-color:#FFF;" class="ico-socialize-google2 ico-socialize type2 ico-lg"><i class="fa fa-google-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>     
-->

	<!-- <footer>
            <div class="container padding-top-10">
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="col-md-2">
                            <p class="footer-links-header">mps360</p>
                            
                            <ul class="footer-links-list">
                                <li><a href="#home">Home</a></li>
                                <li><a href="#how-it-works">How it works?</a></li>
                                <li><a href="#why-mps360">Why mps360?</a></li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <p class="footer-links-header">ABOUT</p>
                            
                            <ul class="footer-links-list">
                                <li><a href="#about-us">About Us</a></li>
                                <li><a href="http://mps360.com/blog/" target="new">Blog</a></li>
                                <li><a href="BookingTermsAndConditions.html" target="_blank">Terms and Conditions</a></li>
                                <li><a href="PrivacyPolicy.html" target="_blank">Privacy Policy</a></li>
                                <li><a href="Cancellations.html" target="_blank">Cancellation and Refund Policy</a></li>
                            </ul>
                        </div>
                        <div class="col-md-2">
                            <p class="footer-links-header">SUPPORT</p>
                            
                            <ul class="footer-links-list">
                                <li><a href="FAQ.aspx">Help Center</a></li>
                                <li><a href="#contact-us">Contact Us</a></li>
                            </ul>
                        </div>
                        <div class="col-md-2">
                            <p class="footer-links-header">CONNECT</p>
                            
                            <ul class="footer-links-list">
                                <li><a href="https://www.facebook.com/mps360" target="_blank">facebook</a></li>
                                <li><a href="https://www.twitter.com/mps360" target="_blank">twitter</a></li>
                                <li><a href="https://plus.google.com/110405995764752280060" target="_blank">google +</a></li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <p class="footer-links-header">KEEP UP WITH mps360</p>
                            <p id="news-letter-confirmation" style="display:none; color:red!important;">Thank you! You are awesome.</p>
                            <form action="" method="post" id="newsletterForm" name="newsletter">
                                <div class="input-group input-group-sm padding-top-10">
                                    <input type="text" class="form-control" placeholder="Enter email address" id="subscriberEmail" name="subscriberEmail"/>
                                    <span class="input-group-btn"><button type="submit" class="btn red-button">Connect</button></span>
                                </div>
                                <span class='error-container'></span>
                                <p class="email-subscription">Spam free and Secure always</p>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>

        </footer> -->

	<footer>
		<p class="text-center copyright"><?php echo '&copy'.' '.date('Y');?> Metre Per Second - Doorstep
			Car Care</p>
	</footer>





	<script type="text/javascript">

	//Date Picker
		$('#booking_date').datepicker({
			
			autoSize : true,
			//changeMonth: true,
			//changeYear: true,
			//showButtonPanel: true,
			//appendText: "(date month year)",
			altField: "#hidden_booked_date",
			altFormat: 'yy-mm-dd',
			dateFormat: "dd M yy",
			minDate:0,
			//stepMonths: 0//Used to show only current month calendar
			//numberOfMonths:2
			maxDate : '+6D',
			onSelect: function(date) {
				getSlots($("#hidden_booked_date").val());
			},
		}).attr('readonly','readonly').attr("placeholder", "Choose Booking Date");

	// //Google Map geolocation and auto complete Address
	// $(document).ready(function() {

	//         // Basic usage
	//         $(".placepicker").placepicker();

	//         // Advanced usage
	//         $("#advanced-placepicker").each(function() {
	//           var target = this;
	//           var $collapse = $(this).parents('.form-group').next('.collapse');
	//           var $map = $collapse.find('.another-map-class');

	//           var placepicker = $(this).placepicker({
	//             map: $map.get(0),
	//             placeChanged: function(place) {
	//               console.log("place changed: ", place.formatted_address, this.getLocation());
	//             }
	//           }).data('placepicker');
	//         });

	//       }); // END document.ready

	</script>

	<script type="text/javascript">
		loadByDefault();
	function doAsapService(){
			var objInputs = {
					customer_name : $("#customer_name").val(),
					customer_mobile : $("#customer_mobile").val(),
					make_id : $("#make_id").val(),
					model_id : $("#model_id").val(),
					vehicle_service_id : $("#vehicle_service_id").val(),
					booking_date : $("#hidden_booked_date").val(),
					booking_time_slot :$("#booking_time_slot").val(),
					total_estimated_cost : $("#hidden_total_estimated_cost").val(),
					vehicle_manfacture_year : $("#vehicle_manfacture_year").val(),
					vehicle_fuel_type : $("#vehicle_fuel_type").val(),
					customer_area : $("#customer_area").val(), 
					};
			$.post('<?php echo Yii::app()->params['webURL'].'/Booking/BookAService/SaveAsapService'; ?>',objInputs,function(response){
				makeEmpty();
				var response = $.parseJSON(response);
		if(response.hasOwnProperty('errors')){
			//Customer Name
			if(undefined != response.errors.customer_name && response.errors.customer_name.length > 0){
				$("#err_customer_name").html(response.errors.customer_name);
				}
			//Customer Mobile
			if(undefined != response.errors.customer_mobile && response.errors.customer_mobile.length > 0){
				$("#err_customer_mobile").html(response.errors.customer_mobile);
				}
			//Make
			if(undefined != response.errors.make_id && response.errors.make_id.length > 0){
				$("#err_make").html(response.errors.make_id);
				}
			//Model
			if(undefined != response.errors.model_id && response.errors.model_id.length > 0){
				$("#err_model").html(response.errors.model_id);
				}
			//Vehicle Service Type
			if(undefined != response.errors.vehicle_service_id && response.errors.vehicle_service_id.length > 0){
				$("#err_vehicle_service_id").html(response.errors.vehicle_service_id);
				}
			//Booking Date
			if(undefined != response.errors.booking_date && response.errors.booking_date.length > 0){
				$("#err_booking_date").html(response.errors.booking_date);
				}
			//Total Estimated Cost
			if(undefined != response.errors.total_estimated_cost && response.errors.total_estimated_cost.length > 0){
				$("#err_total_estimated_cost").html(response.errors.total_estimated_cost);
				}
			//Booking Time Slot
			if(undefined != response.errors.booking_time_slot && response.errors.booking_time_slot.length > 0){
				$("#err_booking_time_slot").html(response.errors.booking_time_slot);
				}
			//Year Of Manfacture
			if(undefined != response.errors.vehicle_manfacture_year && response.errors.vehicle_manfacture_year.length > 0){
				$("#err_vehicle_manfacture_year").html(response.errors.vehicle_manfacture_year);
				}
			//Vehicle Fuel Type
			if(undefined != response.errors.vehicle_fuel_type && response.errors.vehicle_fuel_type.length > 0){
				$("#err_vehicle_fuel_type").html(response.errors.vehicle_fuel_type);
				}
			//Customer Area
			if(undefined != response.errors.customer_area && response.errors.customer_area.length > 0){
				$("#err_customer_area").html(response.errors.customer_area);
				}
			return false;
			}else{
					makeFieldsEmpty();
				$("#order_success").html(response.message+" Your Order Number Is : "+response.order_number);	           
				return true;         
				}
				});
			}
			

		function makeFieldsEmpty(){
			$("#customer_name").val("");
			$("#customer_mobile").val("");
			$("#make_id").val("");
			$("#model_id").val("");
			$("#model_id").html("");
			$("#vehicle_service_id").val("");
			$("#hidden_booked_date").val("");
			$('#booking_date').val("");
			$("#booking_time_slot").val("");
			$("#booking_time_slot").html("");
			$("#total_estimated_cost").val("");
			$("#vehicle_manfacture_year").val("");
			$("#vehicle_fuel_type").val("");
			$("#customer_area").val("");
			$("#order_success").html("");
			$("#service_note").empty();
			$("#hidden_total_estimated_cost").val("");
			return true;
			}

	function getMakeModels(make_id){
		var objInputs = {
					brandId : make_id
				};
		$.post('<?php echo Yii::app()->params['webURL'].'/Booking/BookAService/GetVehicleModels'; ?>',objInputs,function(response){
			$("#model_id").html("");
			$("#model_id").html(response);
			});
			return true;
		}

	function makeEmpty(){
				$("#err_customer_name").empty();
				$("#err_customer_mobile").empty();
				$("#err_make").empty();
				$("#err_model").empty();
				$("#err_vehicle_service_id").empty();
				$("#err_total_estimated_cost").empty();
				$("#err_booking_date").empty();
				$("#err_booking_time_slot").empty();
				$("#err_vehicle_manfacture_year").empty();
				$("#err_vehicle_fuel_type").empty();
				$("#err_customer_area").empty();
				$("#order_success").empty();
				$("#service_note").empty();
				return true;
		}

	function getEstimatedCost(){
		$("#total_estimated_cost").val(0);
			var intMakeId = intModelId = intVehicleServiceId = '';
			intMakeId = $("#make_id").val();
			intModelId = $("#model_id").val();
			intVehicleServiceId = $("#vehicle_service_id").val();
			if(intMakeId != "" && intModelId !="" && intVehicleServiceId != ""){
				var objInputs = {
							brand_id : intMakeId,
							model_id : intModelId,
							vehicle_id : 1,//Default Car
							plan_id : 26,//Default Basic Plan
							service_id : intVehicleServiceId,
						};
				$.post('<?php echo Yii::app()->params['webURL'].'/Booking/BookAService/GetRepairs'; ?>',objInputs,function(response){
						$("#total_estimated_cost").val(0);
						$("#hidden_total_estimated_cost").val(0);
					//Labour Amount
					if(undefined != response.amount && response.amount >= 0){
						$("#total_estimated_cost").val(response.amount);
						$("#hidden_total_estimated_cost").val(response.amount);
						} 		  
					});
				}
			return true;
		}


	function loadByDefault(){
		$("#total_estimated_cost").val(0);
		$("#service_note").empty();
		$("#service_note").empty();
		return true;
		}

	function getSlots(booking_date){
		var objInputs = {
				booking_date : booking_date
				};
		$.post('<?php echo Yii::app()->params['webURL'].'/Booking/BookAService/GetTimeSlots'; ?>',objInputs,function(response){
			makeSlotsEmpty();
						var response = $.parseJSON(response);
						//Error Response
					if(undefined != response.time_gap_in_hrs && response.time_gap_in_hrs ==  0){
						$("#err_booking_time_slot").html(response.err_response);
						}
						$("#booking_time_slot").html(response.time_slots_booked_date);
			});
						return true;
		}

	function makeSlotsEmpty(){
		$("#err_booking_time_slot").empty();
		$("#booking_time_slot").empty();
		return true;
	}

	function getServiceDescription(intVehicleServiceType){
		var strDescription = '';
		makeEmptyNote();
		switch (intVehicleServiceType) {
			case '1':
				strDescription = '* Price shown here is labor only. Spares and consumables used will be charged extra as per MRP'; 
				$("#service_note").html(strDescription);     
				break;
			case '3':
				strDescription = '* Price shown here is visiting charge only. Final price will be based on the scope of work after inspection.'; 
				$("#service_note").html(strDescription);
				break;
			case '8':
				strDescription = '* Price shown here is Inspection charge only. If there is any additional repair, it will be adjusted in the final price'; 
				$("#service_note").html(strDescription);
				break;
				return true;
		}
		}

	function makeEmptyNote(){
			$("#service_note").empty();
			return true;
		}

	</script>
</body>

</html>