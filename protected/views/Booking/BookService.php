<link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/datetimepicker/js/moment-with-locales.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/datetimepicker/js/bootstrap-datetimepicker.js"></script>

<!--Google Address :: START-->
<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/jquery.geocomplete.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/dist/locationpicker.jquery.min.js"></script>
<!--Google Address :: END-->

<form method="post"  enctype="multipart/form-data">
    <section class="bookservice-main page-section breadcrumbs">
        <div class="container">
            <div class="col-md-12 text-right">
                <div class="page-header">
                    <h1>Book a Service</h1>
                </div>
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Pages</a></li>
                    <li class="active">Booking &amp; Payment</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="headerbottom-search">
                    <?php
                    if (isset($_GET['message']) == 'success') {
                        ?>
                        <div align="center" id="sucmsg"><font color="white">Successfully Submitted</font></div>
                        <?php
                    }
                    ?>
                    <div class="form-group has-icon col-sm-6">
                        <input class="form-control alt geocomplete" type="text" name="adrs" id="adrs" placeholder="picked customer location address" 
                               value="<?php echo isset($book_location) ? $book_location : NULL; ?>" required>
                        <input type="hidden" class="form-control" name="location" id="location"/>
                        <input type="hidden" id="lat" value="" class="locationone">
                        <input type="hidden" id="lng"  value="" class="locationone">
                        <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>  
                    </div>
                    <div class="form-group has-icon col-sm-3">
                        <input type="text" class="picupdate form-control" id="picdate" name="picdate" placeholder="Picking Up Date" value="<?php
                        if (empty(Yii::app()->session['picdate'])) {
                            $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));

                            if (isset($fromdates)) {
                                echo $fromdates;
                            } else {
                                echo isset($booked_date) ? $booked_date : $date->format('d-m-Y');
                                //echo $date->format('d-m-Y');
                            }
                        } else {
                            echo isset($booked_date) ? $booked_date : NULL;
                        }
                        ?>" required>
                        <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                    </div>
                    <div class="form-group has-icon col-sm-3">
                        <input type="text" class="pictimer form-control" id="pickhr" name="pickhr" placeholder="Picking Up Hour" value="<?php
                        if (empty(Yii::app()->session['bookhour'])) {
                            $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));

                            if (isset($fromdates)) {
                                echo $fromdates;
                            } else {
                                echo isset($booked_time) ? $booked_time : $date->format('h:i');
                                //echo $date->format('h:i');
                            }
                        } else {

                            echo isset($booked_time) ? $booked_time : NULL;
                        }
                        ?>" required>
                        <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /BREADCRUMBS -->




    <!-- PAGE WITH SIDEBAR -->
    <section class="page-section with-sidebar sub-page">
        <div class="container">
            <!-- <div class="row">
                <input type="hidden" class="form-control alt"  name="location" id="location" placeholder="Enter Your Location">
            </div> -->
            <!-- CONTENT -->
            <div class="col-md-9 content" id="content">
                <!--Service Types :: START-->
                <div class="form-group has-icon has-label">
                    <div class="vehiclestype">
                        <?php
                        if (!empty($vehicles)) {

                            foreach ($vehicles as $eleVehicle) {
                                $strActive = '';
                                if (2 == $eleVehicle['id'] && 0 == $isCar && 1 == $isBike) {
                                    $strActive = 'active';
                                } else if (1 == $isCar && 1 == $eleVehicle['id'] && 0 == $isBike) {
                                    $strActive = 'active';
                                }

                                $eleVehicle['isActive'] = $strActive;
                                ?>
                                <div class="col-sm-6 text-center">
                                    <a class="<?php
                                    echo $eleVehicle['isActive'];
                                    ?>" href="<?php
                                       echo Yii::app()->params['webURL'] . $eleVehicle['service_url'];
                                       ?>" 
                                       data-vehicleType ="<?php echo $eleVehicle['id']; ?>"><i aria-hidden="true" class="<?php echo $eleVehicle['class_css']; ?>"></i>
                                        <h2><?php echo $eleVehicle['name']; ?></h2></a>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <!--Service Types :: END-->
                <!-- Vehicle Category Car -->
                <div id="addcar" class="vehicles">
                    <div class="row">
                        <!--Car Brand :: START-->
                        <div class="col-sm-4">
                            <div class="form-group has-icon has-label booksel">
                                <label for="brand">Brand</label>
                                <div id="carsbrand" class="wrapper-dropdown-3" tabindex="1">
                                    <span>--Select Brand--</span>
                                    <ul class="dropdown scrollable-menu">
                                        <?php
                                        if (!empty($brands)) {
                                            foreach ($brands as $arrBrand) {
                                                ?>
                                                <li  class="cl">
                                                    <a href="#" data-id='<?php echo $arrBrand['id']; ?>' data-brand_name ='<?php echo $arrBrand['name']; ?>' class='brands'><?php echo $arrBrand['name']; ?><img src='<?php echo Yii::app()->params['adminImgURL'] . $vehicleFolderPath . $arrBrand['logo']; ?>'/></a>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                    <div class="form-control-icon">
                                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Car Brand :: END-->

                        <!--Car Model :: START-->
                        <div class="col-sm-4">
                            <div class="form-group has-icon has-label booksel">
                                <label for="model">Model</label>
                                <div id="carsmodel" class="wrapper-dropdown-3" tabindex="1">

                                    <span id="modelItem">--Select Model--</span>
                                    <ul class="dropdown scrollable-menu" id="brandModels">
                                    </ul>
                                    <div class="form-control-icon">
                                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Car Model :: END-->

                        <!--Service :: START-->
                        <div class="col-sm-4 bookingvhlc">
                            <div class="form-group booksel">
                                <label for="formSearchOffLocation3">Service</label>
                                <select id="vehicle_service" class="form-control selectpicker">
                                    <option value="">--Select Service--</option>
                                    <?php
                                    if (!empty($services)) {
                                        foreach ($services as $arrService) {
                                            ?>
                                            <option value='<?php echo $arrService['id']; ?>'><?php echo $arrService['name']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select> 
                            </div>
                        </div>
                        <!--Service :: END-->

                        <!--Repairs And Repairs List :: START-->

                        <!--Oiling Service :: START-->
                        <div id="oil_general_serv" class="servicelist col-md-12" style="display:none;">
                            <div id="oil_general_servtab"> 
                                <ul class="nav nav-pills">
                                    <li class="active"><a  href="#oil_general_basic_plns" name="oil_basic" id="oil_basic" data-toggle="tab" value='1'>Basic</a></li>
                                    <li><a href="#oil_general_elite_plns" data-toggle="tab" name="oil_elite" id="oil_elite" value='2'>Elite</a></li>
                                    <li><a href="#oil_general_advanced_plns" data-toggle="tab" name="oil_advance" id="oil_advance" value='3'>Advanced</a></li>
                                </ul>
                                <div class="tab-content clearfix">
                                    <div class="tab-pane active" id="oil_general_basic_plns">
                                        <div id="oil_basicdata"></div>                                 
                                    </div>
                                    <div class="tab-pane" id="oil_general_elite_plns">
                                        <div id="oil_elitedata"></div>                                 
                                    </div>
                                    <div class="tab-pane" id="oil_general_advanced_plns">
                                        <div id="oil_advancedata"></div>                                 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Oiling Service :: END-->

                        <!--Washing Service :: START-->
                        <div id="wash_general_serv" class="servicelist col-md-12" style="display:none;">
                            <div id="wash_general_servtab"> 
                                <ul class="nav nav-pills">
                                    <li class="active"><a  href="#wash_general_basic_plns" name="wash_basic" id="wash_basic" data-toggle="tab" value='1'>Basic</a></li>
                                    <li><a href="#wash_general_elite_plns" data-toggle="tab" name="wash_elite" id="wash_elite" value='2'>Elite</a></li>
                                    <li><a href="#wash_general_advanced_plns" data-toggle="tab" name="wash_advance" id="wash_advance" value='3'>Advanced</a></li>
                                </ul>
                                <div class="tab-content clearfix">
                                    <div class="tab-pane active" id="wash_general_basic_plns">
                                        <div id="wash_basicdata"></div>                                 
                                    </div>
                                    <div class="tab-pane" id="wash_general_elite_plns">
                                        <div id="wash_elitedata"></div>                                 
                                    </div>
                                    <div class="tab-pane" id="wash_general_advanced_plns">
                                        <div id="wash_advancedata"></div>                                 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Washing Service :: END-->


                        <!--General Service :: START-->
                        <div id="general_serv" class="servicelist col-md-12" style="display:none;">
                            <div id="general_servtab"> 
                                <ul class="nav nav-pills">
                                    <li class="active"><a  href="#general_basic_plns" name="basic" id="basic" data-toggle="tab" value='1'>Basic</a></li>
                                    <li><a href="#general_elite_plns" data-toggle="tab" name="elite" id="elite" value='2'>Elite</a></li>
                                    <li><a href="#general_advanced_plns" data-toggle="tab" name="advance" id="advance" value='3'>Advanced</a></li>
                                </ul>
                                <div class="tab-content clearfix">
                                    <div class="tab-pane active" id="general_basic_plns">
                                        <div id="load_image" style="display:none;" class="loading-icon">
                                            <img src="<?php echo Yii::app()->params['imgURL'] . 'service_load.gif'; ?>" alt="Smiley face" height="42" width="42"/>
                                        </div>
                                        <div id="basicdata"></div>                                 
                                    </div>
                                    <div class="tab-pane" id="general_elite_plns">
                                        <div id="elitedata"></div>                                 
                                    </div>
                                    <div class="tab-pane" id="general_advanced_plns">
                                        <div id="advancedata"></div>                                 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--GENERAL Service :: END-->
                        <!--PERIODIC Service :: START-->
                        <div id="periodic_serv" class="servicelist col-md-12" style="display:none;">
                            <div id="periodic_servtab"> 
                                <ul class="nav nav-pills">
                                    <li class="active"><a href="#periodic_list8" id="onet" name="onet" data-toggle="tab">1000</a></li>
                                    <li><a href="#periodic_list9" id="five" name="five"data-toggle="tab">5000</a></li>
                                    <li><a href="#periodic_list1" id="ten" name="ten "data-toggle="tab">10,000</a></li>
                                    <li><a href="#periodic_list2" data-toggle="tab" id="twenty" name="twenty" >20,000</a></li>
                                    <li><a href="#periodic_list3" data-toggle="tab" id="thirty" name="thirty">30,000</a></li>
                                    <li><a href="#periodic_list4" data-toggle="tab" id="fourty" name="fourty">40,000</a></li>
                                    <li><a href="#periodic_list5" data-toggle="tab" id="fifty" name="fifty">50,000</a></li>
                                    <li><a href="#periodic_list6" data-toggle="tab" id="sixty" name="sixty">60,000</a></li>  
                                    <li><a href="#periodic_list7" data-toggle="tab" id="msixty" name="msixty">60,000 + </a></li>  
                                </ul>
                                <div class="tab-content clearfix">
                                    <div class="tab-pane active" id="periodic_list8"></div>
                                    <div class="tab-pane" id="periodic_list9"></div>
                                    <div class="tab-pane" id="periodic_list1"></div>
                                    <div class="tab-pane" id="periodic_list2"></div>
                                    <div class="tab-pane" id="periodic_list3"></div>
                                    <div class="tab-pane" id="periodic_list4"></div>
                                    <div class="tab-pane" id="periodic_list5"></div>
                                    <div class="tab-pane" id="periodic_list6"></div> 
                                    <div class="tab-pane" id="periodic_list7"></div>
                                </div>
                            </div>  
                        </div>
                        <!--PERIODIC Service :: END-->
                        <!--REPAIR Service :: START-->
                        <div id="repair_serv" class="servicelist" style="display:none;">
                            <div id="repjob"></div>
                        </div>
                        <!--REPAIR Service :: END-->
                        <!--General Service :: Bike :: START-->
                        <div id="bike_general_serv" class="bike-service-lst col-md-12" style="display:none;">
                            <div id="bike_general_serv_job"></div>
                        </div>
                        <!--General Service :: Bike :: START-->
                        <!--REPAIR Service :: Bike :: START-->
                        <div id="bike_repair_serv" class="bike-service-lst col-md-12" style="display:none;">
                            <div id="bike_repair_serv"></div>
                        </div>
                        <!--REPAIR Service :: Bike :: END-->
                        </form>
                        <!--Exclusive Service :: Start-->
                        <form  method="post" action="bookExclusive" name="exclusiveForm" id="exclusiveForm">
                            <div id="notsoure_serv" class="servicelist" style="display:none;">
                                <input type="hidden" class="form-control" name="location"/>
                                <input type="hidden" name="book_a_exclusiveservice" id="book_a_exclusiveservice"/>
                                <div class="form-group">
                                    <textarea class="form-control alt" placeholder="Enter Vehicle Problem Here" name="additional_information" id="other_exlusive_info" cols="30" rows="10" style="height:120px;" required="required"></textarea>
                                </div>
                                <div class="form-group">
                                    <input class="form-control alt" placeholder="Enter your name" name="other_name" id="other_exclusive_name"  required/>
                                </div>
                                <div class="form-group">
                                    <input class="form-control alt" placeholder="Enter your mobile number" name="other_mobile" id="other_exlusive_mobile"  required/>
                                </div>
                                <input type="submit" name="other_exlusive_service" id="other_exlusive_service" class="btn ripple-effect btn-theme nextbtn" onclick="return getOrderInfo(2);">
                            </div>
                        </form>
                        <!--Exclusive Service :: End-->
                        <!--Others :: START-->
                        <form  method="post" action="bookOthers" name="otherform" id="otherform"  enctype="multipart/form-data">
                            <div id="other_serv" class="col-md-12 servicelist" style="display:none;">
                                <input type="hidden" class="form-control" name="location"/>
                                <input type="hidden" name="book_a_otherservice" id="book_a_otherservice"/>
                                <h3 class="block-title alt describe">Describe More</h3>
                                <div class="form-group">
                                    <textarea class="form-control alt" placeholder="Enter your service details" name="additional_information" id="additional_information" cols="30" rows="10" style="height:120px;" required></textarea>
                                </div>
                                <div class="form-group">
                                    <input class="form-control alt" placeholder="Enter your name" name="other_name" id="other_name"  required/>
                                </div>
                                <div class="form-group">
                                    <input class="form-control alt" placeholder="Enter your mobile number" name="other_mobile" id="other_mobile"  required/>
                                </div>
                                <div class="form-group">
                                    <div class="text-right"><i class="fa fa-headphones" aria-hidden="true"></i> | 
                                        <i class="fa fa-video-camera" aria-hidden="true"></i></div>
                                    <input type="file" name="others_file" id="others_file" class="form-control"/>
                                </div>
                                <input type="submit" name="book_other_service" id="book_other_service" class="btn ripple-effect btn-theme nextbtn" onclick="return getOrderInfo(1);">
                            </div>   
                        </form>
                    </div>
                    <!--Others :: END-->
                    <!--Repairs And Repairs List :: END-->

                    <!-- book a service features -->
                    <div class="bkser-features" id="footerone">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/choose-icon.png">
                                    </div>
                                    <div class="media-body">
                                        <h3>Select your service</h3>
                                        <p>Please choose the type of the service and we will initiate the service process.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/collect-your-vehicle.png">
                                    </div>
                                    <div class="media-body">
                                        <h3>We collect your vehicle</h3>
                                        <p>Our vehicle collection personnel will collect your vehicle from the location specified and ensures that it is assigned to the work shop or the service centre.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/start-working.png">
                                    </div>
                                    <div class="media-body">
                                        <h3>Start working </h3>
                                        <p>The work status is tracked after the work progresses and the owners of the vehicles are kept informed of the same through the application.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">           
                            <div class="col-md-4 text-center">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/track-your-service.png">
                                    </div>
                                    <div class="media-body">
                                        <h3>Track your service</h3>
                                        <p>The service status is tracked through the various stages and the customer is notified of the same.</p>
                                    </div>
                                </div>
                            </div>                          
                            <div class="col-md-4 text-center">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/payment-through the-app.png">
                                    </div>
                                    <div class="media-body">
                                        <h3>Payments Made Easy</h3>
                                        <p>Enable payments through various payment gate ways after the service is complete.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/delivery-at-your door-steps.png">
                                    </div>
                                    <div class="media-body">
                                        <h3>Delivery at your door steps</h3>
                                        <p>After service and with the bill paid the vehicle is delivered to the customer’s location which is specified for an everlasting service experience.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /-end book a service features -->
                    <div class="bottomservice-btn overflowed reservation-now"> 
        <!--<input type="submit" name="books" id="books" value="Book a Service" data-target = "#signup-model" class="btn btn-theme pull-right">-->                          
                        <!--<a class = "btn btn-theme pull-right" id="btnsub1" data-toggle = "modal" data-target = "#signup-model">Next</a>-->                  
                    </div> 
                </div>
            </div>

            <aside class="col-md-3 sidebar" id="sidebar">
                <div class="widget shadow widget-helping-center estimate-widget" id='service_widget_info'>
                    <h4 class="widget-title">Service Details</h4>
                    <div class="widget-content widget-topimg">
                        <!--Vehicle Type :: START-->
                        <div class="aside-vhls-dtls">
                            <?php
                            if (isset($vehicleType) && !empty($vehicleType) && 1 == $vehicleType) {
                                ?>
                                <div id="model_image"><i class="fa fa-car" aria-hidden="true"></i></div>
                                <?php
                            } else {
                                ?>
                                <div id="model_image"><i class="fa fa-motorcycle" aria-hidden="true"></i></div>
                                <?php
                            }
                            ?>
                            <span class="vehicle_brand_name" name="vehicle_brand_name" id="vehicle_brand_name"></span>
                            <br>
                            <span class="vehicle_model_name" name="vehicle_model_name" id="vehicle_model_name"></span>
                        </div>
                        <!--Vehicle Type :: START-->

                        <div class="service_content">
                            <span class="service"><strong>Service</strong>                         
                                <span id="service_type"></span>
                            </span>
                            <span class="package">
                                <strong class="p_t">Package</strong>
                                <span id="package_type"></span>
                            </span>
                            <span class="amount">
                                <strong class="e_a">Amount</strong>
                                <div class="amt-dtls">
                                    <i class="fa fa-inr" aria-hidden="true"></i><span id="estimated_amount" class="showrs"></span>
                                </div>
                            </span>
                            <span id="Error"></span>
                        </div>

                        <!--Submit The Order :: Start-->
                        <form method="post" action ='Booking/BookAService/ConfirmOrder' class="servicebook-dtl-form">
                            <input type="hidden" name="book_a_vehicle" id="book_a_vehicle"/>                            
                            <div class="form-group text-center">
                                <input type="hidden" class="form-control" name="location"/>
                                <input type="submit" class = "btn ripple-effect btn-theme nextbtn" name="move_to_confirm" id="move_to_confirm" value="Next" onclick="return getOrderInfo();" style="display: none;"/>
                            </div>
                        </form>
                        <!--Submit The Order :: End-->

                    </div>
                </div>

                <!--Support :: START-->
                <div class="widget shadow widget-helping-center">
                    <h4 class="widget-title"><?php echo Yii::app()->params['customer_info']['tag']; ?></h4>
                    <div class="widget-content">
                        <p><?php echo Yii::app()->params['customer_info']['message']; ?></p>
                        <h5 class="widget-title-sub"><?php echo Yii::app()->params['customer_info']['support_mobile']; ?></h5>
                        <p><a href="<?php echo 'mailto:' . Yii::app()->params['customer_info']['support_mail']; ?>"><?php echo Yii::app()->params['customer_info']['support_mail']; ?></a></p>
                    </div>
                </div>
                <!--Support :: START-->
            </aside>
            <!-- /SIDEBAR -->

        </div>
    </section>
</form>
<!-- /PAGE WITH SIDEBAR -->
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/dropdownscript.js"></script>
<?php
if (empty(Yii::app()->session['username'])) {
    ?>
    <div class = "customer-signup modal fade" id = "signup-model" tabindex = "-1" role = "dialog" 
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
                                    <form method="post" class="form-login" action="loginuser"><!-- FOR LOGIN USER-->
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
                                            <input type="submit" value="Login" id="btnsub" name="btnsub" class="col-md-12 btn btn-theme"></div>
                                        <fb:login-button autologoutlink="true"  scope="public_profile,email" perms="id,name,email,user_birthday,status_update,publish_stream"></fb:login-button>   
                                        <div id="login" style ="display:none"></div>                           

                                    </form>
                                </div>
                            </div>                   
                            <div class = "tab-pane fade" id = "signuptab">

                                <div class="col-md-12">
                                    <div class="form-group"><input class="form-control alt" type="text" name="Usernmame" id="Usernmame"  placeholder="Enter Email*" required></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"><input class="form-control alt" type="text" name="uname" id="uname" placeholder="Name" required></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-icon has-label">
                                        <input type="text" class="form-control alt" id="mobNo" name="mobNo" placeholder="Enter Mobile Number*" maxlength="10" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"><input class="form-control alt" type="password" name="upwd" id="upwd" placeholder="Enter Password*" required></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"><input class="form-control alt" type="password" name="cpwd" id="cpwd" placeholder="Enter Confirm Password*" required></div>
                                    <div class="col-md-6">                    
                                    </div>
                                </div>
                                <div class="col-md-12 text-center"><input type="button" value="Create Account" id="register" name="register" class="col-md-12 btn btn-theme"></div>
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
    </div>
    <?php
}
?>



<script type='text/javascript'>
                                    var intBrand = '';
                                    var strBrandName = '';
                                    var intModel = '';
                                    var strModelName = '';
                                    var intVehicle = '';
                                    var intService = '';
                                    var strService = '';
                                    var intPlanId = '';
                                    var strPlanName = '';
                                    var order_summary = '';
                                    var strModelImgName = '';
                                    $(document).ready(function () {
                                        $('.service_content').hide();
                                        //Brands
                                        $('.brands').click(function () {
                                            $('#modelItem').text('--Select Model--');
                                            var objBrand = {};
                                            intBrand = $(this).data("id");
                                            strBrandName = $(this).data("brand_name");
                                            objBrand = {
                                                brandId: intBrand,
                                                vehicle_type_id: <?php echo $vehicleType; ?>,
                                                vehicle_folder_path: '<?php echo $vehicleModelFolderPath; ?>',
                                                vehicle_right_folder_path: '<?php echo $vehicleModelRightFolderPath; ?>',
                                            };
                                            $.post('<?php echo Yii::app()->params['webURL'] . '/Booking/BookAService/getVehicleBrandModels' ?>', objBrand, function (response) {
                                                if (response.length > 0) {
                                                    $("#brandModels").html("");
                                                    $("#brandModels").append(response);
                                                } else {
                                                    $("#brandModels").html("");
                                                }
                                                return true;
                                            });
                                        });
                                        //Modles
                                        $("#brandModels").on('click', 'li', function () {
                                            var strIdImageName = '';
                                            var arrChunks = '';
                                            $('#modelItem').text($(this).text());
                                            strIdImageName = this.id;
                                            arrChunks = strIdImageName.split("_");
                                            intModel = arrChunks[0];
                                            strModelName = $(this).text();
                                            strModelImgName = arrChunks[1];
                                        });
                                        //Plans
                                        $('#vehicle_service').change(function () {
                                            intPlanId = '';
                                            strPlanName = '';
                                            intService = $('#vehicle_service').val();
                                            strService = $('#vehicle_service option:selected').text();
                                            intVehicle = <?php echo $vehicleType; ?>;
                                            if ('' != intBrand && '' != intModel && '' != intService) {
                                                //Right side image :: START
                                                $('#model_image').html('<img src=' + strModelImgName + '>');
                                                $('#vehicle_brand_name').html(strBrandName);
                                                $('#vehicle_model_name').html(strModelName);
                                                //Right side image :: END
                                                $('.service_content').show();
                                                if (1 == intService) { // 1 => Basic
                                                    other_exclusive_show();
                                                    if (1 == intVehicle) {
                                                        $('#notsoure_serv').hide();
                                                        $('#other_serv').hide();
                                                        $('#repair_serv').hide();
                                                        $('#periodic_serv').hide();
                                                        $('#oil_general_serv').hide();
                                                        $('#wash_general_serv').hide();
                                                        $('#general_serv').show();
                                                        intPlanId = 1;
                                                        strPlanName = 'Basic';
                                                    } else if (2 == intVehicle) {
                                                        $('#notsoure_serv').hide();
                                                        $('#other_serv').hide();
                                                        $('#general_serv').hide();
                                                        $('#periodic_serv').hide();
                                                        $('#repair_serv').hide();
                                                        $('#bike_repair_serv').hide();
                                                        $('#bike_general_serv').show();
                                                        intPlanId = 21;
                                                        strPlanName = 'Bike';
                                                    }
                                                    getRepairs(intService, intVehicle, intPlanId);
                                                } else if (2 == intService) { //4 => 1,000 KM
                                                    other_exclusive_show();
                                                    $('#notsoure_serv').hide();
                                                    $('#other_serv').hide();
                                                    $('#repair_serv').hide();
                                                    $('#general_serv').hide();
                                                    $('#oil_general_serv').hide();
                                                    $('#wash_general_serv').hide();
                                                    $('#periodic_serv').show();
                                                    intPlanId = 4;
                                                    strPlanName = '1,000 KM';
                                                    getRepairs(intService, intVehicle, intPlanId);
                                                } else if (3 == intService) {
                                                    other_exclusive_show();
                                                    if (1 == intVehicle) {
                                                        $('#notsoure_serv').hide();
                                                        $('#other_serv').hide();
                                                        $('#general_serv').hide();
                                                        $('#periodic_serv').hide();
                                                        $('#oil_general_serv').hide();
                                                        $('#wash_general_serv').hide();
                                                        $('#repair_serv').show();
                                                    } else if (2 == intVehicle) {
                                                        $('#bike_general_serv').hide();
                                                        $('#bike_repair_serv').show();
                                                    }
                                                    intPlanId = 8;
                                                    strPlanName = 'Repair';
                                                    getRepairs(intService, intVehicle, intPlanId);
                                                } else if (4 == intService) {
                                                    other_exclusive_hide();
                                                    $('#notsoure_serv').hide();
                                                    $('#general_serv').hide();
                                                    $('#periodic_serv').hide();
                                                    $('#repair_serv').hide();
                                                    $('#oil_general_serv').hide();
                                                    $('#wash_general_serv').hide();
                                                    strService = 'Others';
                                                    $('#other_serv').show();
                                                } else if (5 == intService) {
                                                    other_exclusive_hide();
                                                    $('#general_serv').hide();
                                                    $('#periodic_serv').hide();
                                                    $('#repair_serv').hide();
                                                    $('#other_serv').hide();
                                                    $('#oil_general_serv').hide();
                                                    $('#wash_general_serv').hide();
                                                    strService = 'Exclusive';
                                                    $('#notsoure_serv').show();
                                                } else if (6 == intService) {
                                                    other_exclusive_show();
                                                    $('#general_serv').hide();
                                                    $('#periodic_serv').hide();
                                                    $('#repair_serv').hide();
                                                    $('#other_serv').hide();
                                                    $('#notsoure_serv').hide();
                                                    $('#wash_general_serv').hide();
                                                    strService = 'Oiling';
                                                    $('#oil_general_serv').show();
                                                    strPlanName = 'Basic';
                                                    intPlanId = 22;
                                                    getRepairs(intService, intVehicle, intPlanId);
                                                } else if (7 == intService) {
                                                    other_exclusive_show();
                                                    $('#general_serv').hide();
                                                    $('#periodic_serv').hide();
                                                    $('#repair_serv').hide();
                                                    $('#other_serv').hide();
                                                    $('#notsoure_serv').hide();
                                                    $('#oil_general_serv').hide();
                                                    strService = 'Washing';
                                                    $('#wash_general_serv').show();
                                                    strPlanName = 'Basic';
                                                    intPlanId = 26;
                                                    getRepairs(intService, intVehicle, intPlanId);
                                                }

                                            } else {
                                                $('#general_serv').hide();
                                            }
                                        });
                                        /**
                                         * @author Ctel
                                         * @param integer intService                                          * @param integer intVehicle
                                         * @param integer intPlan
                                         * @returns boolean It will return TRUE or FALSE
                                         */
                                        function getRepairs(intService, intVehicle, intPlan) {
                                            var objRepairs = {};
                                            objRepairs = {
                                                service_id: intService,
                                                vehicle_id: intVehicle,
                                                model_id: intModel,
                                                brand_id: intBrand,
                                                plan_id: intPlan,
                                            };
                                            $.post('<?php echo Yii::app()->params['webURL'] . '/Booking/BookAService/getRepairs' ?>', objRepairs, function (response) {
                                                $("#load_image").show();
                                                setTimeout(function () {
                                                    $("#load_image").hide();
                                                    var intReapirsLength = getObjectLength(response);
                                                    if (intReapirsLength > 0) {
                                                        order_summary = response;
                                                        //response = $.parseJSON(response);
                                                        strRepairSheet = response.sheet;
                                                        if (null == strRepairSheet) {
                                                            strRepairSheet = '<span class="no_records">No data is found.</span>';
                                                        }
                                                        doubleAmount = response.amount;
                                                        setSheet(intService, strRepairSheet, doubleAmount, intPlan);
                                                        return true;
                                                    } else {
                                                        return false;
                                                    }
                                                }, 100);
                                            });
                                        }

                                        /**
                                         * @author Ctel
                                         * @param object objData
                                         * @returns integer It will return length of the object
                                         */
                                        function getObjectLength(objData) {
                                            var intLength = 0;
                                            if ('' != objData) {
                                                intLength = Object.keys(objData).length;
                                            }
                                            return intLength;
                                        }

                                        /**
                                         * @author Ctel
                                         * @param integer intService
                                         * @param string strRepairSheet
                                         * @param double doubleAmount         
                                         * @returns boolean It will return TRUE
                                         */
                                        function setSheet(intService, strRepairSheet, doubleAmount, intPlan) {
                                            $("#service_type").html();
                                            $("#package_type").html();
                                            wake_up();
                                            if (1 == intService) {
                                                switch (intPlan) {
                                                    case 1:
                                                        $('#elitedata').html();
                                                        $('#advancedata').html();
                                                        $("#service_type").html(strService);
                                                        $("#package_type").html('Basic');
                                                        $("#footerone").hide();
                                                        $('#basicdata').html();
                                                        $('#basicdata').html(strRepairSheet);
                                                        break;
                                                    case 2:
                                                        $('#basicdata').html();
                                                        $('#advancedata').html();
                                                        $("#service_type").html(strService);
                                                        $("#package_type").html('Elite');
                                                        $("#footerone").hide();
                                                        $('#elitedata').html();
                                                        $('#elitedata').html(strRepairSheet);
                                                        break;
                                                    case 3:
                                                        $('#basicdata').html();
                                                        $('#elitedata').html();
                                                        $("#service_type").html(strService);
                                                        $("#package_type").html('Advanced');
                                                        $("#footerone").hide();
                                                        $('#advancedata').html();
                                                        $('#advancedata').html(strRepairSheet);
                                                        break;
                                                    case 21:
                                                        $(".package").addClass('hidden');
                                                        $("#service_type").html(strService);
                                                        $("#footerone").hide();
                                                        $('#bike_general_serv_job').html();
                                                        $('#bike_general_serv_job').html(strRepairSheet);
                                                        break;
                                                }

                                            } else if (2 == intService) {
                                                switch (intPlan) {
                                                    case 4:
                                                        $('#periodic_list9').html();
                                                        $("#package_type").html('<b>1,000 KM</b>');
                                                        $("#service_type").html('<b>' + strService + '</b>');
                                                        $("#footerone").hide();
                                                        $('#periodic_list8').html();
                                                        $('#periodic_list8').html(strRepairSheet);
                                                        break;
                                                    case 5:
                                                        $('#periodic_list8').html();
                                                        $("#service_type").html('<b>' + strService + '</b>');
                                                        $("#package_type").html('<b>5,000 KM</b>');
                                                        $("#footerone").hide();
                                                        $('#periodic_list9').html();
                                                        $('#periodic_list9').html(strRepairSheet);
                                                        break;
                                                    case 6:
                                                        $('#periodic_list8').html();
                                                        $('#periodic_list9').html();
                                                        $("#service_type").html('<b>' + strService + '</b>');
                                                        $("#package_type").html('<b>10,000 KM</b>');
                                                        $("#footerone").hide();
                                                        $('#periodic_list1').html();
                                                        $('#periodic_list1').html(strRepairSheet);
                                                        break;
                                                    case 7:
                                                        $('#periodic_list8').html();
                                                        $('#periodic_list9').html();
                                                        $('#periodic_list1').html();
                                                        $("#service_type").html('<b>' + strService + '</b>');
                                                        $("#package_type").html('<b>20,000 KM</b>');
                                                        $("#footerone").hide();
                                                        $('#periodic_list2').html();
                                                        $('#periodic_list2').html(strRepairSheet);
                                                        break;
                                                    case 16:
                                                        $('#periodic_list8').html();
                                                        $('#periodic_list9').html();
                                                        $('#periodic_list1').html();
                                                        $('#periodic_list2').html();
                                                        $("#service_type").html('<b>' + strService + '</b>');
                                                        $("#package_type").html('<b>30,000 KM</b>');
                                                        $("#footerone").hide();
                                                        $('#periodic_list3').html();
                                                        $('#periodic_list3').html(strRepairSheet);
                                                        break;
                                                    case 17:
                                                        $('#periodic_list8').html();
                                                        $('#periodic_list9').html();
                                                        $('#periodic_list1').html();
                                                        $('#periodic_list2').html();
                                                        $('#periodic_list3').html();
                                                        $("#service_type").html('<b>' + strService + '</b>');
                                                        $("#package_type").html('<b>40,000 KM</b>');
                                                        $("#footerone").hide();
                                                        $('#periodic_list4').html();
                                                        $('#periodic_list4').html(strRepairSheet);
                                                        break;
                                                    case 18:
                                                        $('#periodic_list8').html();
                                                        $('#periodic_list9').html();
                                                        $('#periodic_list1').html();
                                                        $('#periodic_list2').html();
                                                        $('#periodic_list3').html();
                                                        $('#periodic_list4').html();
                                                        $("#service_type").html('<b>' + strService + '</b>');
                                                        $("#package_type").html('<b>50,000 KM</b>');
                                                        $("#footerone").hide();
                                                        $('#periodic_list5').html();
                                                        $('#periodic_list5').html(strRepairSheet);
                                                        break;
                                                    case 19:
                                                        $('#periodic_list8').html();
                                                        $('#periodic_list9').html();
                                                        $('#periodic_list1').html();
                                                        $('#periodic_list2').html();
                                                        $('#periodic_list3').html();
                                                        $('#periodic_list4').html();
                                                        $('#periodic_list5').html();
                                                        $("#service_type").html('<b>' + strService + '</b>');
                                                        $("#package_type").html('<b>60,000 KM</b>');
                                                        $("#footerone").hide();
                                                        $('#periodic_list6').html();
                                                        $('#periodic_list6').html(strRepairSheet);
                                                        break;
                                                    case 20:
                                                        $('#periodic_list8').html();
                                                        $('#periodic_list9').html();
                                                        $('#periodic_list1').html();
                                                        $('#periodic_list2').html();
                                                        $('#periodic_list3').html();
                                                        $('#periodic_list4').html();
                                                        $('#periodic_list5').html();
                                                        $('#periodic_list6').html();
                                                        $("#service_type").html('<b>' + strService + '</b>');
                                                        $("#package_type").html('<b>60,000 KM +</b>');
                                                        $("#footerone").hide();
                                                        $('#periodic_list7').html();
                                                        $('#periodic_list7').html(strRepairSheet);
                                                        break;
                                                }
                                            } else if (3 == intService)
                                            {
                                                $("#package_type").html('<b>Repair Job</b>');
                                                $('#move_to_confirm').hide();
                                                if (2 == intVehicle) {
                                                    $('#bike_repair_serv').html();
                                                    $('#bike_repair_serv').html(strRepairSheet);
                                                } else if (1 == intVehicle) {
                                                    $('#repjob').html();
                                                    $('#repjob').html(strRepairSheet);
                                                }
                                            } else if (6 == intService) {
                                                switch (intPlan) {
                                                    case 22:
                                                        $('#oil_elitedata').html();
                                                        $('#oil_advancedata').html();
                                                        $("#service_type").html(strService);
                                                        $("#package_type").html('Basic');
                                                        $("#footerone").hide();
                                                        $('#oil_basicdata').html();
                                                        $('#oil_basicdata').html(strRepairSheet);
                                                        break;

                                                    case 23:
                                                        $('#oil_basicdata').html();
                                                        $('#oil_advancedata').html();
                                                        $("#service_type").html(strService);
                                                        $("#package_type").html('Elite');
                                                        $("#footerone").hide();
                                                        $('#oil_elitedata').html();
                                                        $('#oil_elitedata').html(strRepairSheet);
                                                        break;
                                                    case 24:
                                                        $('#oil_basicdata').html();
                                                        $('#oil_elitedata').html();
                                                        $("#service_type").html(strService);
                                                        $("#package_type").html('Advanced');
                                                        $("#footerone").hide();
                                                        $('#oil_advancedata').html();
                                                        $('#oil_advancedata').html(strRepairSheet);
                                                        break;
                                                }

                                            } else if (7 == intService) {
                                                switch (intPlan) {
                                                    case 26:
                                                        $('#wash_elitedata').html();
                                                        $('#wash_advancedata').html();
                                                        $("#service_type").html(strService);
                                                        $("#package_type").html('Basic');
                                                        $("#footerone").hide();
                                                        $('#wash_basicdata').html();
                                                        $('#wash_basicdata').html(strRepairSheet);
                                                        break;
                                                    case 27:
                                                        $('#wash_basicdata').html();
                                                        $('#wash_advancedata').html();
                                                        $("#service_type").html(strService);
                                                        $("#package_type").html('Elite');
                                                        $("#footerone").hide();
                                                        $('#wash_elitedata').html(strRepairSheet);
                                                        break;
                                                    case 28:
                                                        $('#wash_basicdata').html();
                                                        $('#wash_elitedata').html();
                                                        $("#service_type").html(strService);
                                                        $("#package_type").html('Advanced');
                                                        $("#footerone").hide();
                                                        $('#wash_advancedata').html(strRepairSheet);
                                                        break;
                                                }

                                            }
                                            $('#estimated_amount').html(doubleAmount);
                                            return true;
                                        }

                                        //General Service :: START
                                        //Basic
                                        $("#basic").click(function () {
                                            intPlanId = 1;
                                            strPlanName = 'Basic';
                                            getRepairs(intService, intVehicle, intPlanId);
                                        });
                                        //Elite
                                        $("#elite").click(function () {
                                            intPlanId = 2;
                                            strPlanName = 'Elite';
                                            getRepairs(intService, intVehicle, intPlanId);
                                        });
                                        //Advanced
                                        $("#advance").click(function () {
                                            intPlanId = 3;
                                            strPlanName = 'Advanced';
                                            getRepairs(intService, intVehicle, intPlanId);
                                        });
                                        //General Service :: END

                                        //Periodic Service :: START
                                        $("#onet").click(function () {
                                            intPlanId = 4;
                                            strPlanName = '1,000 KM';
                                            getRepairs(intService, intVehicle, intPlanId);
                                        });
                                        $("#five").click(function () {
                                            intPlanId = 5;
                                            strPlanName = '5,000 KM';
                                            getRepairs(intService, intVehicle, intPlanId);
                                        });
                                        $("#ten").click(function () {
                                            intPlanId = 6;
                                            strPlanName = '10,000 KM';
                                            getRepairs(intService, intVehicle, intPlanId);
                                        });
                                        $("#twenty").click(function () {
                                            intPlanId = 7;
                                            strPlanName = '20,000 KM';
                                            getRepairs(intService, intVehicle, intPlanId);
                                        });
                                        $("#thirty").click(function () {
                                            intPlanId = 16;
                                            strPlanName = '30,000 KM';
                                            getRepairs(intService, intVehicle, intPlanId);
                                        });
                                        $("#fourty").click(function () {
                                            intPlanId = 17;
                                            strPlanName = '40,000 KM';
                                            getRepairs(intService, intVehicle, intPlanId);
                                        });
                                        $("#fifty").click(function () {
                                            intPlanId = 18;
                                            strPlanName = '50,000 KM';
                                            getRepairs(intService, intVehicle, intPlanId);
                                        });
                                        $("#sixty").click(function () {
                                            intPlanId = 19;
                                            strPlanName = '60,000 KM';
                                            getRepairs(intService, intVehicle, intPlanId);
                                        });
                                        $("#msixty").click(function () {
                                            intPlanId = 20;
                                            strPlanName = '>60,000 KM';
                                            getRepairs(intService, intVehicle, intPlanId);
                                        });
                                        //Periodic Service :: END


                                        function other_exclusive_hide() {
                                            $("#service_type").html('<b>' + strService + '</b>');
                                            $('#package_type').html('');
                                            $('#estimated_amount').html('');
                                            $('.p_t').hide();
                                            $('.e_a').hide();
                                            $('.amt-dtls').addClass('hidden');
                                            $('#move_to_confirm').hide();
                                            return true;
                                        }

                                        function other_exclusive_show() {
                                            $('.p_t').show();
                                            $('.e_a').show();
                                            $('.amt-dtls').removeClass('hidden');
                                            $('#move_to_confirm').show();
                                            return true;
                                        }

                                        function wake_up() {
                                            $('.p_t').show();
                                            $('.amt-dtls').removeClass('hidden');
                                        }


                                        //Oiling Service :: START
                                        //Basic
                                        $("#oil_basic").click(function () {
                                            intPlanId = 22;
                                            strPlanName = 'Basic';
                                            getRepairs(intService, intVehicle, intPlanId);
                                        });
                                        //Elite
                                        $("#oil_elite").click(function () {
                                            intPlanId = 23;
                                            strPlanName = 'Elite';
                                            getRepairs(intService, intVehicle, intPlanId);
                                        });
                                        //Advanced
                                        $("#oil_advance").click(function () {
                                            intPlanId = 24;
                                            strPlanName = 'Advanced';
                                            getRepairs(intService, intVehicle, intPlanId);
                                        });
                                        //Oiling Service :: END

                                        //Washing Service :: START
                                        //Basic
                                        $("#wash_basic").click(function () {
                                            intPlanId = 26;
                                            strPlanName = 'Basic';
                                            getRepairs(intService, intVehicle, intPlanId);
                                        });
                                        //Elite
                                        $("#wash_elite").click(function () {
                                            intPlanId = 27;
                                            strPlanName = 'Elite';
                                            getRepairs(intService, intVehicle, intPlanId);
                                        });
                                        //Advanced
                                        $("#wash_advance").click(function () {
                                            intPlanId = 28;
                                            strPlanName = 'Advanced';
                                            getRepairs(intService, intVehicle, intPlanId);
                                        });
                                        //Washing Service :: END


                                    });
                                    //periodic service :: Suggested :: START
                                    function getRepairAmount(strRepairList) {
                                        var objReparisList = {};
                                        objReparisList = {
                                            repairsList: strRepairList,
                                        };
                                        $.post('<?php echo Yii::app()->params['webURL'] . '/Booking/BookAService/getRepairAmount' ?>', objReparisList, function (response) {
                                            var isChecked = '';
                                            var obJRepairs = '';
                                            var intRepairId = '';
                                            var service_unique_id = '';
                                            var doubleEstimatedAmount = 0.00;
                                            obJRepairs = JSON.parse(objReparisList.repairsList);
                                            intRepairId = obJRepairs.repairId;
                                            service_unique_id = obJRepairs.service_unique_id;
                                            isChecked = $('#' + service_unique_id + '_' + intRepairId + obJRepairs.plan_id).is(':checked');
                                            doubleEstimatedAmount = document.getElementById("estimated_amount");
                                            if (response > 0 && true == isChecked) {
                                                doubleEstimatedAmount = parseFloat(doubleEstimatedAmount.innerHTML) + parseFloat(response);
                                                $('#move_to_confirm').show();
                                                $("#estimated_amount").html(doubleEstimatedAmount);
                                            } else if (false == isChecked) {
                                                doubleEstimatedAmount = parseFloat(doubleEstimatedAmount.innerHTML) - parseFloat(response);
                                                if ('' != doubleEstimatedAmount && doubleEstimatedAmount > 0) {
                                                    $('#move_to_confirm').show();
                                                } else {
                                                    $('#move_to_confirm').hide();
                                                }
                                                $("#estimated_amount").html(doubleEstimatedAmount);
                                            }
                                            return true;
                                        });
                                    }
                                    //periodic service :: Suggested :: END

                                    function getOrderInfo(intSign = '') {

                                        var totalmt = document.getElementById("estimated_amount").innerHTML;
                                        if ('' == totalmt || totalmt == 0) {
                                            $("#Error").html("<p style='color:red;'>Amount Should be greater than 0</p>");
                                            return false;
                                        }
                                        var object_order_details = '';
                                        object_order_details = {
                                            brand_name: strBrandName,
                                            brand_id: intBrand,
                                            model_name: strModelName,
                                            model_id: intModel,
                                            service_name: strService,
                                            service_id: intService,
                                            plan_name: strPlanName,
                                            plan_id: intPlanId,
                                            vehicle_type: '<?php echo!empty($vehicleType) ? $vehicleType : 1; ?>',
                                            vehicle_name: '<?php echo!empty($vehicleName) ? $vehicleName : 'Car'; ?>',
                                            total_amount: document.getElementById("estimated_amount").innerHTML,
                                            location: $('#adrs').val(),
                                            lati_longitude: $("#location").val(),
                                            booked_date: $('#picdate').val(),
                                            booked_time: $('#pickhr').val(),
                                            order_summary: order_summary,
                                        };
                                        if (1 == intSign) {
                                            document.getElementById("book_a_otherservice").value = JSON.stringify(object_order_details);
                                        } else if (2 == intSign) {
                                            document.getElementById("book_a_exclusiveservice").value = JSON.stringify(object_order_details);
                                        } else {
                                            document.getElementById("book_a_vehicle").value = JSON.stringify(object_order_details);
                                        }
                                        return true;
                                    }


</script>

<!--Google Address :: START-->
<script>
    $(function () {
        $(".geocomplete").geocomplete({
            details: "form",
            types: ["geocode", "establishment"],
        });
        //date and time
        $('.picupdate').datetimepicker({
            format: 'DD-MM-YYYY'
        });
        $('.pictimer').datetimepicker({
            format: 'hh:mm'
        });
        //select
        $('.selectpicker').selectpicker();
        $(".caret").wrap("<div class='form-control-icon'></div>");
    });
</script>
<!--Google Address :: END-->


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
        $('#adrs').locationpicker({
            location: {
                latitude: $('#lat').val(),
                longitude: $('#lng').val()
            },
            radius: 2,
            inputBinding: {
                locationNameInput: $('#adrs')
            },
            enableAutocomplete: true,

        });

    }
    function mark_active_menu1() {
        $('#adrs').locationpicker({
            location: {
                latitude: 17.485267,
                longitude: 78.65892
            },
            radius: 2,
            inputBinding: {
                locationNameInput: $('#adrs')
            },
            enableAutocomplete: true,
            markerIcon: 'http://www.metrepersecond.com/bookaservice/assets/img/map-marker.png'
        });

    }
    $('#adrs').on('change', function () {
        var lat = $('#lat').val();
        var lng = $('#lng').val();
        $("#location").val(lat + ',' + lng);

    });
</script>
