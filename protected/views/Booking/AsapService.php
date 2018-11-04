<!DOCTYPE html>
<html>
<head>
<title>Quick Booking</title>

<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->params['frontAssetURL'].'css/quick-booking-style.css'; ?>">
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->params['frontAssetURL'].'css/bootstrap.min.css'; ?>">
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->params['frontAssetURL'].'css/bootstrap-theme.min.css'; ?>">
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->params['frontAssetURL'].'css/jquery-ui.css'; ?>">

<script
	src="<?php echo Yii::app()->params['frontAssetURL'].'js/jquery.min.js'; ?>"></script>
<script
	src="<?php echo Yii::app()->params['frontAssetURL'].'js/bootstrap.min.js'; ?>"></script>
<script
	src="<?php echo Yii::app()->params['frontAssetURL'].'js/jquery-ui.min.js'; ?>"></script>

<!-- <script type="text/javascript" -->
<!-- 	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDqtP2ENbJEwPAzJBsffFncbWhKyucIX8"></script> -->
<script async defer
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDqtP2ENbJEwPAzJBsffFncbWhKyucIX8&callback=initMap"
	type="text/javascript"></script>
<script type="text/javascript"
	src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=places"></script>
<script type="text/javascript"
	src="<?php echo Yii::app()->params['frontAssetURL'] . 'js/jquery.placepicker.js'; ?>"></script>

</head>

<body>
	<div class="wdth-100">
		<div class="car-bg-wrapper">
			<div class="container">
				<div class="inr-ctn">
					<div class="lft-contant">
						<div class="text-center">
							<img
								src="<?php

        echo Yii::app()->params['frontAssetURL'] . 'img/logo-mps.png';
        ?>">
						</div>
						<h1 class="title">Car Service, repair, and detailing at your
							doorstep</h1>
						<ul class="list-unstyled service-list">
							<li><img
								src="<?php echo Yii::app()->params['frontAssetURL'].'img/arrow.png'; ?>">
								90 min service</li>
							<li><img
								src="<?php echo Yii::app()->params['frontAssetURL'].'img/arrow.png'; ?>">
								6 months service warranty</li>
							<li><img
								src="<?php echo Yii::app()->params['frontAssetURL'].'img/arrow.png'; ?>">
								Genuine spares</li>
							<li><img
								src="<?php echo Yii::app()->params['frontAssetURL'].'img/arrow.png'; ?>">
								100% transparent Billing</li>
						</ul>
						<div class="play-wrap">
							<span>Metrepersecond is now on Google Play Store </span> <img
								src="<?php echo Yii::app()->params['frontAssetURL'].'img/playstore_img.png'; ?>"
								width="180">
						</div>
					</div>
					<div class="rght-form-wrap">
						<div class="col-md-12 order-md-1">
							<h2 class="text-center mb-3 title-text">Book a service now</h2>
							<form class="needs-validation" method="post">
								<div class="row mrg-btm-10">
									<div class="col-md-12 mb-3">
										<label for="">Name</label><input type="text"
											class="form-control" name="customer_name" id="customer_name"
											value="" maxlength="100" /> <span id="err_customer_name"></span>
										<!-- <div class="invalid-feedback">
                                  Valid first name is required.
                                </div> -->
									</div>
									<div class="col-md-12 mb-3">
										<label for="">Mobile No.</label> <input type="text"
											class="form-control" id="customer_mobile"
											name="customer_mobile" value="" maxlength="10" /> <span
											id="err_customer_mobile"></span>
									</div>
								</div>

								<div class="row mrg-btm-10">
									<div class="col-md-6 mb-3">
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
											</select> <span id="err_make"></span>
									</div>
									<div class="col-md-6 mb-3">
										<label for="">Model</label> <select class="form-control"
											id="model_id" name="model_id" onchange="getEstimatedCost()">
											<option value="">--Choose Model--</option>
										</select> <span id="err_model"></span>
									</div>
								</div>

								<div class="row mrg-btm-10">
									<div class="col-md-6 mb-3">
										<label for="">Type Of Service</label> <select
											class="form-control" id="vehicle_service_id"
											name="vehicle_service_id" onchange="getEstimatedCost()">
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
										</select> <span id="err_vehicle_service_id"></span>
									</div>
									<div class="col-md-6 mb-3">
										<label for="">Estimated Cost</label> <input type="text"
											class="form-control" id="total_estimated_cost"
											name="total_estimated_cost" value="" readonly /> <span
											id="err_total_estimated_cost"></span>
									</div>
								</div>

								<div class="row mrg-btm-10">
									<div class="col-md-6 mb-3">
										<label for="">Date</label> <input type="text"
											class="form-control" id="booking_date" name="booking_date"
											value="" /> <span id="err_booking_date"></span>
									</div>
									<input type="hidden" id="hidden_booked_date"
										name="hidden_booked_date" value="" />
									<div class="col-md-6 mb-3">
										<label for="">Time Slot</label> <select class="form-control"
											id="booking_time_slot" name="booking_time_slot">
											<option value="">--Choose Time Slot--</option>
										</select> <span id="err_booking_time_slot"></span>
									</div>
								</div>

								<div class="row mrg-btm-10" data-example>
									<div class="col-md-12">
										<input class="placepicker form-control"
											data-map-container-id="collapseOne" />
										<div id="collapseOne" class="collapse">
											<div class="placepicker-map thumbnail"></div>
										</div>
									</div>
								</div>
								<div class="row mrg-btm-10">
									<div class="col-md-6">
										<button class="btn btn-yellow" type="button"
											onclick="doAsapService()">Book a Service</button>
									</div>
									<div class="col-md-6">
										<div class="mob-no">
											or Call <span>832-862-0888</span>
										</div>
									</div>
								</div>
						
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
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
        maxDate : '+2M',
         onSelect: function(date) {
             getSlots($("#hidden_booked_date").val());
         },
    }).attr('readonly','readonly').attr("placeholder", "Choose Booking Date");

//Google Map geolocation and auto complete Address
$(document).ready(function() {

        // Basic usage
        $(".placepicker").placepicker();

        // Advanced usage
        $("#advanced-placepicker").each(function() {
          var target = this;
          var $collapse = $(this).parents('.form-group').next('.collapse');
          var $map = $collapse.find('.another-map-class');

          var placepicker = $(this).placepicker({
            map: $map.get(0),
            placeChanged: function(place) {
              console.log("place changed: ", place.formatted_address, this.getLocation());
            }
          }).data('placepicker');
        });

      }); // END document.ready

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
		   return false;
           }else{
	            makeFieldsEmpty();
            $("#assign_success").html(response.message);	           
             return true;         
               }
			  });
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
			return true;
	  }

  function getEstimatedCost(){
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
                   //Labour Amount
                   if(undefined != response.amount && response.amount >= 0){
                	   $("#total_estimated_cost").val(response.amount);
             		   } 		  
         		  });
              }
          return true;
	  }


  function loadByDefault(){
	  $("#total_estimated_cost").val(0);
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
</script>
</body>

</html>