  <link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
        <script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min.js"></script>
        
<!--Google Address :: START-->
       <script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>            
       <script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/jquery.geocomplete.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/dist/locationpicker.jquery.min.js"></script>
        <!--Google Address :: END-->
<?php ?>
<section class="page-section selfdrive dark">

    <div class="container">
        <form action="<?php echo Yii::app()->params['webURL'] . 'Self/SelfDrive/SelfDrive'; ?>" method="POST" class="form-find-car">
            <div class="row">
                <div class="col-md-2 wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
                    <h2 class="section-title text-left no-margin">
                        <small>Choose Your</small>
                        <span>Favorite Vehicle</span>
                    </h2>
                </div>
                <div class="col-md-10">
                    <!--Vehicle Type :: START-->
                    <div class="col-md-2">
                        <div class="form-group has-icon has-label">
                            <label>Select Vehicle</label>
                            <select name="self_vehicle_id" id="self_vehicle_type" class="form-control">
                                <option value="">Select</option>
                                <?php
                                if (!empty($VehicleTypes)) {
                                    $intVehicleTypeId = isset($selfForm->self_vehicle_id) ? $selfForm->self_vehicle_id : NULL;
                                    foreach ($VehicleTypes as $arrvehicle) {
                                        if ($intVehicleTypeId == $arrvehicle['id']) {
                                            ?>
                                            <option value="<?php echo $arrvehicle['id'] ?>" selected><?php echo $arrvehicle['name'] ?></option>
                                        <?php } else {
                                            ?>
                                            <option value="<?php echo $arrvehicle['id'] ?>"><?php echo $arrvehicle['name'] ?></option>
                                            <?php
                                        }
                                    }
                                    //unset($intVehicleTypeId, $VehicleTypes);
                                }
                                ?>
                            </select>
                        </div>
                        <span class="throw_error">
                            <?php
                            echo isset($errors['self_vehicle_id'][0]) ? $errors['self_vehicle_id'][0] : NULL;
                            ?>
                        </span>
                    </div>
                    <!--Vehicle Type :: END-->

                    <div class="col-md-4">
                        <div class="form-group has-icon has-label">
                            <label>Change Location</label>
                            <input type="text" class="form-control geocomplete" id="self_book_location" name="self_book_location" value="<?php echo isset($selfForm->self_book_location) ? $selfForm->self_book_location : NULL; ?>" placeholder="Current Location">
                            <input type="hidden" name="location" id="location" value="<?php echo isset($selfForm->location) ? $selfForm->location : NULL; ?>">
                             <input type="hidden" id="lat" value="" class="locationone">
                         <input type="hidden" id="lng"  value="" class="locationone">
                            <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                        </div>
                        <span class="throw_error">
                            <?php
                            echo isset($errors['self_book_location'][0]) ? $errors['self_book_location'][0] : NULL;
                            ?>
                        </span>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group has-icon has-label" data-date-format="dd-mm-yyyy H:i p" data-link-field="dtp_input1">
                            <label>Start Trip</label>
                            <input type="text" class="input-group date form_datetime form-control" name="trip_start_date_time" id="trip_start_date_time" value="<?php
                            $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                            $date->modify("+2 hours");
								$moment=strtotime($date->format('d-m-Y H:i'));
				$rounded_seconds = round($moment / (30 * 60)) * (30 * 60);
                            echo isset($selfForm->trip_start_date_time) ? $selfForm->trip_start_date_time : date('d-m-Y H:i',$rounded_seconds);
                            ?>">						
                            <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                        </div>
                        <span class="throw_error">
                            <?php
                            echo isset($errors['trip_start_date_time'][0]) ? $errors['trip_start_date_time'][0] : NULL;
                            ?>
                        </span>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group has-icon has-label" data-date-format="dd-mm-yyyy H:i p" data-link-field="dtp_input1">
                            <label>End Trip</label>
                            <input type="text" class="input-group date form_datetime form-control" name="trip_end_date_time" id="trip_end_date_time" 
                                   value="<?php $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
								$date->modify("+6 hours");
								$moment=strtotime($date->format('d-m-Y H:i'));
				$rounded_seconds = round($moment / (30 * 60)) * (30 * 60);
				$endate=isset($selfForm->trip_end_date_time) ? $selfForm->trip_end_date_time : date('d-m-Y H:i',$rounded_seconds);
								if(isset($endate))
								{
									echo $endate;
								}
								else
								 {
									  echo date('d-m-Y g:i',$rounded_seconds); 
								  }
                                                                  
                                                                  
                                                                  ?>">
                            <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                        </div>
                        <span class="throw_error">
                            <?php
                            echo isset($errors['trip_end_date_time'][0]) ? $errors['trip_end_date_time'][0] : NULL;
                            ?>
                        </span>
                    </div>
                    <div class="col-md-6 clear doorstp">
                        <div class="form-group">
                            <?php
                            $collectionmode = isset($selfForm->self_collection_mode) ? $selfForm->self_collection_mode : NUll;
                            ?>
                            <label class="doorstepcheck">
                                <input type="radio" name="self_collection_mode" id="self_collection_doorstep" checked="" value="doorstep" <?php
                                if ('doorstep' == $collectionmode) {
                                    echo 'checked';
                                } else {
                                    echo false;
                                };
                                ?>> Door Step</label>

                            <label class="pickuppcheck">
                                <input type="radio" name="self_collection_mode" id="self_collection_pickup" value="pickup" <?php
                                if ('pickup' == $collectionmode) {
                                    echo 'checked';
                                } else {
                                    echo false;
                                };
                                ?>> Pickup </label>
                            <span class="throw_error">
                                 <?php echo isset($errors['self_collection_mode'][0]) ? $errors['self_collection_mode'][0] : NULL;?>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group pull-right">
                            <button type="submit" id="self_book" name="self_book" value="search" class="btn ripple-effect btn-theme">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- /PAGE -->
<section class="with-sidebar sub-page">

    <div class="container">

        <div class="row">

            <!-- CONTENT -->

            <div class="col-md-9 content car-listing" id="selfdrive_filter">

                <!-- Car Listing -->

                <?php
                if (!empty($VehicleDetails)) {
                    foreach ($VehicleDetails as $details) {
                        ?>
                        <form action="<?php echo Yii::app()->params['webURL'] . 'Self/SelfDrive/SelfDriveOrder/id/' . $details['self_vehicle_id']; ?>" method="POST" id="selfdetails_<?php echo $details['self_vehicle_id'];  ?>" name="selfdetails_<?php echo $details['self_vehicle_id'];  ?>" class="thumbnail no-border no-padding thumbnail-car-card clearfix">
                            <input type="hidden" name="selfcustomerlocation" id="selfcustomerlocation" class="selfcustomerlocation" value="<?php echo isset($selfForm->self_book_location) ? $selfForm->self_book_location : NUll; ?>"/>
                             <input type="hidden" name="location" id="location" value="<?php echo isset($selfForm->location) ? $selfForm->location : NULL; ?>" />
                            <input type="hidden" name="selfagentlocation" id="selfagentlocation" class="selfagentlocation" value="<?php echo isset($details['agent_location']) ? $details['agent_location'] : NUll; ?>"/>
                            <input type="hidden" name="Trip_agent_location" id="Trip_agent_location" value="<?php echo isset($details['agent_latitude']) ? $details['agent_latitude'] . "," . $details['agent_longitude'] : NULL; ?>"/>       
                            <input type="hidden" name="TripStart" value="<?php echo isset($selfForm->trip_start_date_time) ? $selfForm->trip_start_date_time : NUll; ?>" />
                            <input type="hidden" name="TripEnd" value="<?php echo isset($selfForm->trip_end_date_time) ? $selfForm->trip_end_date_time : NUll; ?>" />                            
                            <input type="hidden" name="pickupmode" id="pickupmode" value="<?php echo isset($selfForm->self_collection_mode) ? $selfForm->self_collection_mode : NUll; ?>" />	 
                            <input type="hidden" name="VehicleType" id="VehicleType" value="<?php echo isset($details['vehicle_type_id']) ? $details['vehicle_type_id'] : Null; ?>" />                 
                            <div >
                                <div class="media">
                                    <a class="media-link">
                                                <?php
                                                if (!empty($details["vehicle_images"])) {
                                                    foreach ($details["vehicle_images"] as $images) {
                                                        if ($images["is_parent"] == 1) {
                                                         
                                                                    $path1 = Yii::app()->params['adminImgURL'] . $images["vehicle_parent_image_path"] . $images["self_vehicle_image"];
                                                                    $path2 = Yii::app()->params['adminImgURL'] . $images["vehicle_parent_image_path"] . 'car_default.jpg';
                                                                  
                                                            ?>
                                                            <img src="<?php echo $path1; ?>" onerror='this.onerror=null;this.src="<?php echo $path2; ?>"' style="width:370px;" />
                                                                
                                                        <?php } 
                                                    }
                                                }
                                            
                                            ?>
                                    </a>
                                </div>
                                <div class="caption">
                                    <h4 class="caption-title"><a href="#"><?php echo isset($details['vehicle_brand_name'])? $details['vehicle_brand_name'] : NULL ; ?> <?php echo isset($details['vehicle_model_name']) ? $details['vehicle_model_name'] :NULL; ?> / <?php echo isset($details['vehicle_seating_capacity']) ? ($details['vehicle_seating_capacity'] . '-Seater') : NUll; ?></a></h4>                                    
                                    <h5 class="caption-title-sub">Kms / hr: <?php echo isset($details['kmph']) ? $details['kmph'] : NUll; ?>
                                        Price / hr: <?php echo isset($details['pphr']) ? $details['pphr'] : NUll; ?></h5>
                                        <?php 
//                                    if (isset($details['agent_location']) && !empty($details['agent_location'])) {
//                                        $location = explode(",", $details['agent_location']);
//                                        ?> 
<!--                                        <span class="text-left" style="padding-left: 30px;padding-right: 30px;"> <i class="fa fa-map-marker" aria-hidden="true"></i> <?php //echo $location[0]; ?></span>-->
    <?php
//                                    }
//                                    ?>
                                    <div class="caption-text">
                                    <ul class="list-inline vhlc-features">
                                        <?php
                                        if (!empty($details['vehicle_features'])) {
                                            foreach ($details['vehicle_features'] as $features) {
                                               ?> <li> <?php echo $features['feature_name']; ?></li>
                                           <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                    </div>
                                    <table class="table">
                                        <tbody><tr>
                                                <td><i class="fa fa-car"></i> <?php echo isset($details['vehicle_class_name']) ? $details['vehicle_class_name'] : NUll; ?></td>
                                                <td><img src="<?php echo Yii::app()->params['imgURL'] .'fual_icon.png'; ?>" width="18"/> <?php echo isset($details['vehicle_variant_name']) ? $details['vehicle_variant_name'] : NUll; ?></td>
                                                <td><i class="fa fa-inr" aria-hidden="true"></i> <?php echo isset($details['total_amount']) ? $details['total_amount'] : NUll; ?></td>

                                                <td class="buttons"> <input type="submit" name="BookOrder" class = "btn btn-theme pull-right" id="BookOrder" value="Book now" /></td>


                                            </tr>
                                        </tbody></table>
                                </div>
                            </div>
                        </form>
                            <?php
                        }
                    } else {
                        ?>
                       
                        
                    <?php }
                    ?>
                    <!-- /Car Listing -->
            </div>

            <!-- /CONTENT -->
        </div>

    </div>
  <?php  if (!empty($VehicleDetails)) { ?>
<div class="default-img selfdrive-bg" style="display:none"></div>
 <?php }else{?>

<div class="default-img selfdrive-bg"></div>
 <?php }?>
</section>


<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/jquery-ui/jquery-ui.min.js"></script>


<script>


    $(document).ready(function () {


// datetime picker


        $("#trip_start_date_time").datetimepicker({
            format: 'dd-mm-yyyy hh:ii',
            autoclose: 1,
            todayHighlight: 1,
            minuteStep: 15, onSelect: function (date) {
                $("#trip_end_date_time").datepicker('option', 'minDate', date);
            },
            startDate: new Date()

        });
        $("#trip_start_date_time").change(function () {
            $("#trip_end_date_time").datetimepicker({
                format: 'dd-mm-yyyy hh:ii',
                autoclose: 1,
                todayHighlight: 1,
                minuteStep: 15,
                startDate: new Date()



            }).focus();
        });

        $("#trip_end_date_time").datetimepicker({
            format: 'dd-mm-yyyy hh:ii',
            autoclose: 1,
            todayHighlight: 1,
            minuteStep: 15,
            startDate: new Date()
        });
// geo location
        $(".geocomplete").geocomplete({
            details: "form",
            types: ["geocode", "establishment"],
        });

    });


</script>
<script>
                        $(document).ready(function () {
                            var startPos;
                            var geoOptions = {
                                enableHighAccuracy: false

                            }
                            var i = 0;
                            $("#r").on('click', function () {
                                if (i == 0)
                                {
                                    mark_active_menu1();
                                }
                            });
                            var geoSuccess = function (position) {
                                startPos = position;

                                var la = startPos.coords.latitude;
                                var lo = startPos.coords.longitude;
                                document.getElementsByClassName("locationone")[0].setAttribute("value", la);
                                document.getElementsByClassName("locationone")[1].setAttribute("value", lo);
                                i = 1;
                                mark_active_menu();



                            };

                            var geoError = function (error) {
                                console.log('Error occurred. Error code: ' + error.code);
                                // error.code can be:
                                //   0: unknown error
                                //   1: permission denied
                                //   2: position unavailable (error response from location provider)
                                //   3: timed out

                            };

                            navigator.geolocation.getCurrentPosition(geoSuccess, geoError);
                        });
                         function mark_active_menu() {
                            $('#self_book_location').locationpicker({
                                location: {
                                    latitude: $('#lat').val(),
                                    longitude: $('#lng').val()
                                },
                                radius: 2,
                                inputBinding: {
                                   locationNameInput: $('#self_book_location')
                                },
                                enableAutocomplete: true,
                               
                            });
                           
                        }
                        function mark_active_menu1() {
                            $('#self_book_location').locationpicker({
                                location: {
                                    latitude: 17.485267,
                                    longitude: 78.65892
                                },
                                radius: 2,
                                inputBinding: {
                                    locationNameInput: $('#self_book_location')
                                },
                                enableAutocomplete: true,
                               // markerIcon: 'http://www.metrepersecond.com/bookaservice/assets/img/map-marker.png'
                            });
                           
                        }
                          $('#self_book_location').on('change', function () {
                            var lat=$('#lat').val();
                            var lng=$('#lng').val();
                            $("#location").val(lat+','+lng);
                          
                        });
</script>