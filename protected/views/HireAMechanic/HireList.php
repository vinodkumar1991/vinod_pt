<!--Google Address & maps :: START-->
<script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=geometry,places&key=AIzaSyDiNV189wilYblkavEk0dNUdASR3GY3Qm8'></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/jquery.geocomplete.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/dist/locationpicker.jquery.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/maplace.min.js" type="text/javascript"></script>
<!--Google Address & maps :: END-->
<script>

    $(function () {
        var map;
        var hirePoints = '';
        hirePoints = <?php echo $hires; ?>;
        map = new Maplace({
            locations: hirePoints,
            map_div: '#gmap',
            controls_on_map: false,
            start: 0,
            map_options: {
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                zoom: 12,
                scrollwheel: false
            }
        }).Load();
        $(".loc_link").hover(function () {
            var loc = '';
            loc = $(this).data('loc');
            map.ViewOnMap(loc);
        }, function ()
        {
            map.ViewOnMap(0);
        });

    });
</script>
<style>
    body{
        overflow:hidden;
    }
    .page-section{
        overflow: inherit;
    }
    #gmap{
        width: 66%;
        height: 540px;
        margin: 0 auto;
        max-height: 100%;
        padding:0px !important;
    }

    #menu {
        margin: 15px auto;
        text-align:center;
    }
    #menu span.loc_link {
        background: #0f89cf;
        color: #fff;
        cursor: pointer;
        margin-right: 10px;
        display: inline-block;
        margin-bottom:10px;
        padding: 5px;
        border-radius: 3px;
    }
    #menu span#tool_tip {
        display: inline-block;
        margin-top: 10px;
    }
    .hired-mch-list{
        margin-top: 0 !important;
        max-height: 540px;
        overflow-y: scroll;
        padding: 0;
    }
    .categ-filter{
        margin:50px 0 0;
    }
    .categ-filter h4{
        color:#fff;
    }
    .categ-filter a{
        color:#fff;
    }
    .page-hiremch .page-section.sub-page{
        padding-top:0px;
    }
    .hired-mch-list a div.portfolio-item:hover{
        background:#f5f5f5;
        color:#000;
    }
    .hired-mch-list .price > strong {
        display: inline-block;
        font-size: 30px;
        margin: 5px 0 0;
    }
    .hired-mch-list .price > strong i{
        color: #329866;
        padding-right: 5px;
    }
    .hired-mch-list .car-listing .thumbnail-car-card .rating {
        margin-left: 10px;
        margin-right: 0;
        margin-top: 3px;
    }
    .hired-mch-list .car-listing .thumbnail-car-card .exp,
    .hired-mch-list .car-listing .thumbnail-car-card .vhls-type {
        display: inline-block;
        margin-right: 20px;
    }
    .hired-mch-list .thumbnail .price{
        margin-bottom: 0px;
    }
    .page-hiremch .section-title{
        color: #fff;
        display: inline-block;
        margin-bottom: 0;
        margin-top: 10px;
    }
</style>
<div class="content-area page-hiremch">
    <section class="page-section breadcrumbs ">
        <div class="container">
        <div class="row">
            <form method="POST" name="hire_form" id="hire_form" class="hire-filter-form">
                <!--Location :: START-->
                <div class="col-md-4">
                    <input class="form-control alt geocomplete" type="text" name="hire_location" id="hire_location" placeholder="Enter location" value="<?php echo isset($hireForm->hire_location) ? $hireForm->hire_location : NULL; ?>"/>
                    <input type="hidden" class="form-control" name="location" id="location" value='<?php echo isset($hireForm->location) ? $hireForm->location : NULL; ?>' placeholder="Enter location"/>
                       <input type="hidden" id="lat" value="" class="locationone">
                         <input type="hidden" id="lng"  value="" class="locationone">
                    <span class="text-danger"><?php echo isset($errors['hire_location'][0]) ? $errors['hire_location'][0] : NULL; ?></span>
                </div>
                <!--Location :: END-->

                <!--Vehicles :: START-->
                <div class="col-md-2">
                    <select  name='hire_vehicle_id' id='hire_vehicle_id' onChange="getBrands(this.value,'')" class="form-control">
                        <option value=''>--Select Vehicle--</option>
                        <?php
                        $intVehicle = isset($hireForm->hire_vehicle_id) ? $hireForm->hire_vehicle_id : NULL;
                        if (isset($vehicles) && !empty($vehicles)) {
                            foreach ($vehicles as $arrVehicle) {
                                if ($intVehicle == $arrVehicle['id']) {
                                    ?>
                                    <option value='<?php echo $arrVehicle['id']; ?>' selected="true"><?php echo $arrVehicle['name']; ?></option>
                                    <?php
                                } else {
                                    ?>
                                    <option value='<?php echo $arrVehicle['id']; ?>'><?php echo $arrVehicle['name']; ?></option>
                                    <?php
                                }
                            }
                        }
                        ?>   
                    </select>
                    <span class="text-danger"><?php echo isset($errors['hire_vehicle_id'][0]) ? $errors['hire_vehicle_id'][0] : NULL; ?></span>
                </div>
                <!--Vehicles :: END-->

                <!--Brand :: START-->
                <div class="col-md-2">
                    <select name="hire_vehicle_brands" id="hire_vehicle_brands" onChange="getBrandModel(this.value,'')" class="form-control">
                        <option value=''>--Select Brand--</option>
                    </select>
                    <span class="text-danger"><?php echo isset($errors['hire_vehicle_brands'][0]) ? $errors['hire_vehicle_brands'][0] : NULL; ?></span>
                </div>
                <!--Brand :: END-->

                <!--Model :: START-->
                <div class="col-md-2">
                    <select  name="hire_vehicle_model" id="hire_vehicle_model" class="form-control">
                        <option value="">--Select Model--</option>
                    </select>
                    <span class="text-danger"><?php echo isset($errors['hire_vehicle_model'][0]) ? $errors['hire_vehicle_model'][0] : NULL; ?></span>
                </div>
                <!--Model :: END-->

                <!--Button :: START-->
                <div class="col-md-2">
                    <input type="submit" name="hire_mechanic_search" id="hire_mechanic_search" value="Search" class="btn btn-submit btn-theme pull-right" />
                </div>

                <!--Button :: END-->
            </form>
            <!--Form :: END-->
            <!--Root Map :: START-->
            <!-- <div class="col-md-6 text-right">
                <div class="page-header"><h1>Hire a Mechanic</h1></div>
                <ul class="breadcrumb text-right">
                    <li><a href="<?php //echo Yii::app()->homeUrl; ?>">Home</a></li>
                    <li  class="active"><a href="#">HireMechanic</a></li>
                    <li><a href="#">Hire it &amp; Payment</a></li>
                </ul>
            </div> -->
            <!--Root Map :: END-->
            </div>
        </div>
    </section>


    <!--Map and Hires List :: START-->
    <section class="page-section with-sidebar sub-page">
        <div id="gmap" class="col-md-8"></div>
        <div class="col-md-4 hired-mch-list">
            <div class="car-listing" id="hire_filter">
                <!-- Mechanic Listing -->
                <?php
                if (!empty($hireList)) {
                    $i = 1;
                    foreach ($hireList as $arrHireList) {
                        ?>
                        <!--Hire ID :: START-->
                        <a id="btnsub1" href="<?php echo Yii::app()->params['webURL'] . 'HireMechanic/HireDetails/id/' . $arrHireList['hire_id'] . '/model/' . $arrHireList['vehicle_brand_models_id'] . '/vehicle_id/' . $arrHireList['vehicle_id']; ?>">
                            <!--Hire Hour Price :: START-->
                            <div data-loc="<?php echo $i; ?>" class="loc_link portfolio-item system thumbnail-car-card thumbnail clearfix" data-price="<?php echo $arrHireList['hire_price_hr']; ?>">
                                <!--Right Side Panel :: START-->
                                <div class="col-md-4 pull-left text-center">
                                    <!--Hire Image :: START-->
                                    <img src="<?php echo Yii::app()->params['adminImgURL'] . $arrHireList['hire_image_path'] . $arrHireList['hire_image']; ?>" width="150" height="120"/>
                                    <!--Hire Image :: END-->
                                    <!--Hire Hour Price :: START-->
                                    <div class="price">
                                        <strong>
                                            <i class="fa fa-inr" aria-hidden="true"></i>
                                            <?php echo $arrHireList['hire_price_hr']; ?>
                                        </strong>
                                    </div>
                                    <!--Hire Hour Price :: START-->
                                </div>
                                <!--Hire Name :: START-->
                                <div class="pull-left col-md-8">
                                    <h4 class="caption-title">
                                        <?php echo $arrHireList['hire_name']; ?>
                                    </h4>
                                    <!--Hire Description :: START-->
                                    <div class="caption-text">
                                        <p><?php echo $arrHireList['hire_description']; ?></p>
                                        <span><?php echo 'Brand : ' . $arrHireList['vehicle_brand_name']; ?></span><br>
                                        <span><?php echo 'Model : ' . $arrHireList['vehicle_model_name']; ?></span>
                                    </div>
                                    <!--Hire Description :: END-->
                                    <div class="pull-left">
                                        <!--Hire Experience :: START-->
                                        <span class="exp">
                                            <i class="fa fa-cog"></i>
                                            <?php echo $arrHireList['hire_experience_years']; ?> Years,<?php echo $arrHireList['hire_experience_months']; ?> Months
                                        </span>
                                        <!--Hire Experience :: END-->
                                        <!--Hire Vehicle Type :: START-->
                                        <span class="vhls-type">
                                            <i class="<?php echo $arrHireList['class_css']; ?>"></i> 
                                            <?php echo $arrHireList['vehicle_name']; ?>
                                        </span>
                                        <!--Hire Vehicle Type :: START-->
                                    </div>
                                </div>
                                <!--Hire Name :: END-->
                            </div>
                            <!--Right Side Panel :: END-->
                            <!--Hire Hour Price :: END-->
                        </a>
                        <!--Hire ID :: END-->
                        <?php
                        $i++;
                    }
                    unset($hireList);
                } else {
                    echo "No data is available.";
                }
                ?> 

            </div>


        </div>
    </section>
    <!--Map and Hires List :: END-->
</div>
<!--Google Address :: START-->
<script>
getBrands('<?php echo isset($hireForm->hire_vehicle_id) ? $hireForm->hire_vehicle_id : NULL; ?>','<?php echo isset($hireForm->hire_vehicle_brands) ? $hireForm->hire_vehicle_brands : NULL; ?>');
getBrandModel('<?php echo isset($hireForm->hire_vehicle_brands) ? $hireForm->hire_vehicle_brands : NULL; ?>','<?php echo isset($hireForm->hire_vehicle_model) ? $hireForm->hire_vehicle_model : NULL; ?>');
 
    //Google Location :: START
    $(function () {
        $(".geocomplete").geocomplete({
            details: "form",
            types: ["geocode", "establishment"],
        });
        //select
        $('.selectpicker').selectpicker();
        $(".caret").wrap("<div class='form-control-icon'></div>");
    });
    //Google Location :: END



    //Vehicle Brands
    function getBrands(intVehicle, selectedText) {
        var objVehicle = {};
        objVehicle = {
            vehicle_id: intVehicle,
        };
        $.post('<?php echo Yii::app()->params['webURL'] . '/HireMechanic/getVehicleBrands' ?>', objVehicle, function (response) {
            if (response.length > 0) {
                $("#hire_vehicle_brands").html("");
                $("#hire_vehicle_brands").append(response);
            }
            if (selectedText != '') {
                $("#hire_vehicle_brands option[value=" + selectedText + "]").attr("selected", "selected");
                $("#hire_vehicle_brands").next(".custom-select").text(selectedText);
            } else {
                $("#hire_vehicle_brands").attr("selected", false);
                $("#hire_vehicle_brands").next(".custom-select").text('--Select Brand--');
            }
        });
        return true;
    }

    //Vehicel Brand Models
    function getBrandModel(intVehicleBrand, selectedText) {
        var objVehicleBrand = {};
        objVehicleBrand = {
            vehicleBrand: intVehicleBrand,
        };
        $.post('<?php echo Yii::app()->params['webURL'] . '/HireMechanic/getVehicleBrandModels' ?>', objVehicleBrand, function (response) {
            if (response.length > 0) {
                $("#hire_vehicle_model").html("");
                $("#hire_vehicle_model").append(response);
            }
             if (selectedText != '') {
                $("#hire_vehicle_model option[value=" + selectedText + "]").attr("selected", "selected");
                $("#hire_vehicle_model").next(".custom-select").text(selectedText);
            } else {
                $("#hire_vehicle_model").attr("selected", false);
                $("#hire_vehicle_model").next(".custom-select").text('--Select Model--');
            }
        });
        return true;
    }
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
                            $('#hire_location').locationpicker({
                                location: {
                                    latitude: $('#lat').val(),
                                    longitude: $('#lng').val()
                                },
                                radius: 2,
                                inputBinding: {
                                   locationNameInput: $('#hire_location')
                                },
                                enableAutocomplete: true,
                               
                            });
                           
                        }
                        function mark_active_menu1() {
                            $('#hire_location').locationpicker({
                                location: {
                                    latitude: 17.485267,
                                    longitude: 78.65892
                                },
                                radius: 2,
                                inputBinding: {
                                    locationNameInput: $('#hire_location')
                                },
                                enableAutocomplete: true,
                               // markerIcon: 'http://www.metrepersecond.com/bookaservice/assets/img/map-marker.png'
                            });
                           
                        }
                          $('#hire_location').on('change', function () {
                            var lat=$('#lat').val();
                            var lng=$('#lng').val();
                            $("#location").val(lat+','+lng);
                          
                        });
</script>

