<!DOCTYPE html>
<html>
<head>
<title>Quick Booking</title>
<!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> -->
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
	integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
	crossorigin="anonymous">
<!-- <link rel="stylesheet" type="text/css" -->
<!-- 	href="css/bootstrap-theme.min.css"> -->

<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- <script src="js/bootstrap.min.js"></script> -->
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
	integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
	crossorigin="anonymous"></script>

<style type="text/css">
img {
	max-width: 100%;
}

.wdth-100 {
	display: inline-block;
	position: relative;
	width: 100%;
}

.car-bg-wrapper {
	background:
		url('http://localhost:8090/14102018/vinod_pt/assets/img/car-bg.jpg')
		no-repeat top center/cover;
	width: 100%;
	max-height: 100%;
	min-height: 630px;
}

.inr-ctn {
	margin: 50px 0 0;
}

.lft-contant {
	background: rgb(255, 255, 255, 0.8);
	padding: 20px 30px;
	float: left;
	width: 58%;
	margin: 0 2% 0;
	min-height: 480px;
	color: #2c2c2c;
}

.lft-contant .title {
	font-size: 60px;
	line-height: 70px;
}

.service-list {
	margin: 30px 0 0;
}

.service-list li {
	margin: 0 0 10px;
	font-size: 24px;
	font-weight: 600;
}

.rght-form-wrap {
	float: left;
	width: 38%;
	background: #f5f5f5;
}

.rght-form-wrap {
	min-height: 480px;
}

.rght-form-wrap .title-text {
	font-weight: 600;
	padding: 0 0 30px;
}

.mrg-btm-15 {
	margin-bottom: 15px;
}
</style>
</head>

<body>

	<div class="wdth-100">
		<div class="car-bg-wrapper">
			<div class="container">
				<div class="inr-ctn">
					<div class="lft-contant">
						<h1 class="title">Car Service, repair, and detailing at your
							doorstep</h1>
						<ul class="list-unstyled service-list">
							<li><img
								src="<?php echo Yii::app()->params['frontImgURL'].'arrow.png';?>">
								90 min service</li>
							<li><img
								src="<?php echo Yii::app()->params['frontImgURL'].'arrow.png';?>">
								6 months service warranty</li>
							<li><img
								src="<?php echo Yii::app()->params['frontImgURL'].'arrow.png';?>">
								Genuine spares</li>
							<li><img
								src="<?php echo Yii::app()->params['frontImgURL'].'arrow.png';?>">
								100% transparent Billing</li>
						</ul>
					</div>
					<div class="rght-form-wrap">
						<div class="col-md-12 order-md-1">
							<h2 class="text-center mb-3 title-text">Book a service now</h2>
							<form class="needs-validation" method="post">
								<div class="row mrg-btm-15">
									<!-- Customer Name :: START -->
									<div class="col-md-6 mb-3">
										<label for="">Name</label> <input type="text"
											class="form-control" name="customer_name" id="customer_name"
											value="" maxlength="100" /> <span id="err_customer_name"></span>
									</div>
									<!-- Customer Name :: END -->
									<!-- Customer Mobile :: START -->
									<div class="col-md-6 mb-3">
										<label for="">Mobile</label> <input type="text"
											class="form-control" id="customer_mobile"
											name="customer_mobile" value="" maxlength="10" /> <span
											id="err_customer_mobile"></span>
									</div>
									<!-- Customer Mobile :: END -->
								</div>

								<div class="row mrg-btm-15">
									<!-- Make :: START -->
									<div class="col-md-6 mb-3">
										<label for="">Make</label> <select class="form-control"
											id="make_id" name="make_id"
											onchange="getMakeModels(this.value)">
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
									<!-- Make :: END -->
									<!-- Model :: START -->
									<div class="col-md-6 mb-3">
										<label for="">Model</label> <select class="form-control"
											id="model_id" name="model_id">
											<option value="">--Choose Model--</option>
										</select> <span id="err_model"></span>
									</div>
									<!-- Model :: END -->
								</div>

								<div class="row mrg-btm-15">
									<div class="col-md-8 mb-3">
										<label for="">Type Of Service</label> <select
											class="form-control" id="vehicle_service_id"
											name="vehicle_service_id">
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
									<div class="col-md-4 mb-3">
										<label for="">Estimated Cost</label> <input type="text"
											class="form-control" id="" value="" required="">
									</div>
								</div>

								<div class="row mrg-btm-15">
									<div class="col-md-6 mb-3">
										<label for="">Date</label> <input type="text"
											class="form-control" id="booking_date" name="booking_date"
											value="" /> <span id="err_booking_date"></span>
									</div>
									<div class="col-md-6 mb-3">
										<label for="">Time Slot</label> <input type="text"
											class="form-control" id="" value="" required="">
									</div>
								</div>
								<div class="text-center">
									<button class="btn btn-primary btn-md" type="button"
										style="margin: 20px 0px;" onclick="doAsapService()">Book a
										Service</button>
								</div>
						
						</div>


						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>

</body>

<script type="text/javascript">
  function doAsapService(){
	     var objInputs = {
                  customer_name : $("#customer_name").val(),
                  customer_mobile : $("#customer_mobile").val(),
                  make_id : $("#make_id").val(),
                  model_id : $("#model_id").val(),
                  vehicle_service_id : $("#vehicle_service_id").val(),
                  booking_date : '018-01-01',
                  booking_time_slot :'',
                   
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
			return true;
	  }

</script>
</html>