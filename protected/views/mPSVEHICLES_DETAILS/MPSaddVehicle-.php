<<<<<<< .mine
<link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/datetimepicker/js/moment-with-locales.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/datetimepicker/js/bootstrap-datetimepicker.js"></script>


<?php
 //echo Yii::app()->baseUrl;
  //echo 'xjzs;';
   //print_r($fetcheconomic);
 //exit;     
  ?>
  
<script>
$(document).ready(function()
{

     $('#carlist li').click(function() {
     //Get the id of list itemstime
       var vmakeid = $(this).attr('id');
       $('#makes_id').val(vmakeid);
    
                $.post('index.php/mPSVEHICLES_DETAILS/Getvmodel',{
                        Maker:vmakeid,
                    },
                    function(data)
                    {
                            //alert(data);
                            
                         $("#modellist").html(data);
                            
                    });
            
   });
   $("#modellist").on('click','li',function (){
       var modelid = $(this).attr('id');
        $('#model_id').val(modelid);
      
    text1=$(this).text();
    $('#span1').text(text1);
    
});

// date and time picker

$('.picupdate').datetimepicker({
    format: 'DD-MM-YYYY'
});


$('.pictimer').datetimepicker({
					format: 'H:mm',
					 stepping: 30,
							   
				});
				   
});



</script>
  

<!--<img src="bookAservice/images/uploadimages/models/car/test.jpg" name="a" id="a"/>-->


<link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/owl-carousel2/assets/owl.carousel.min.css" rel="stylesheet">

    <script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/dropdownscript.js"></script>

    <script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/jquery-ui/jquery-ui.js"></script>

    <!-- PAGE -->
    <section class="page-section no-padding slider">
                <div class="container full-width">

                    <div class="main-slider">
                        <div class="owl-carousel" id="main-slider">

<!-- Book a Service slide -->
<div class="item slide1 ver1">
    <div class="caption">
        <div class="container">
            <div class="div-table">
                <div class="div-cell">
                    <div class="caption-content">
                        <h2 class="caption-title">A hub for car and bike care</h2>
                        <h3 class="caption-subtitle">Car &amp; Bike services</h3>
    <!-- Search form -->
    <div class="row">
    <div class="col-sm-12 col-md-10 col-md-offset-1">

    <div class="form-search dark">
        <form action="<?php echo $this->createUrl('mPSVEHICLES_DETAILS/Savebookservice');?>" method="post">
        
            <div class="form-title">
                <i class="fa fa-globe"></i>
                <h2>Book Now - For a trouble free ride.</h2>
            </div>

            <div class="row row-inputs">
                <div class="container-fluid">
                    <div class="col-sm-6">
                        <div class="form-group has-icon has-label">
                            <label>Pick Location</label>
                            <input type="text" class="form-control geocomplete" id="bookloc" name="bookloc" value="<?php echo Yii::app()->session['location'];?>"placeholder="Current Location">
                            
                            <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                        </div>
                        <div>
                            <a data-target="#us6-dialog" data-toggle="modal" id="r" class="btn btn-submit btn-theme"><i class="fa fa-map-marker"></i>Change Location</a>
                            <input type="hidden" id="l" value="" class="locationone">
                            <input type="hidden" id="t"  value="" class="locationone">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group input-group date has-icon has-label">
                            <label for="picdate">Pick Date</label>
                            <input type='text' id="picdate" name="picdate" class="picupdate form-control input-group-addon" value="<?php $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                                if(isset($fromdates))
                                {
                                    echo $fromdates;
                                }
                                else
                                 {
                                     echo $date->format('d-m-Y'); 
                                  } ?>" />
                            <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group input-group date has-icon has-label">
                            <label>Pick Hour</label>
                                <input type='text' id='pictimer' name="pictimer" class="pictimer form-control input-group-addon" value="<?php $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                                if(isset($fromdates))
                                {
                                    echo $fromdates;
                                }
                                else
                                 {
                                     echo $date->format('H:ii:ss A'); 
                                  } ?>" />
                                <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-submit" style="margin-top: 10px;">
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

                            <!-- Self Drive Slide -->
                            <div class="item slide3 ver3">
                                <div class="caption">
                                    <div class="container">
                                        <div class="div-table">
                                            <div class="div-cell">
                                                <div class="caption-content">
                                                    <!-- Search form -->
                                                    <div class="form-search light">
                                                       <form action="<?php echo $this->createUrl('Selfdrive/SelfdrivedetailsSearch'); ?>"" method="POST" class="form-find-car">
                                                            <div class="form-title">
                                                                <i class="fa fa-globe"></i>
                                                                <h2>Search a vehicle for your journey.</h2>
                                                            </div>
                                                            <div class="row row-inputs">
                                                                <div class="container-fluid">
                                                                    <div class="col-sm-7">
                                                                           <div class="form-group input-group date has-icon has-label">
																				<label for="picdate">Start Trip Date</label>
																				<input type='text' id="spicdate" name="from_date" class="picupdate form-control input-group-addon" value="<?php $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
																					if(isset($fromdates))
																					{
																						echo $fromdates;
																					}
																					else
																					 {
																						 echo $date->format('d-m-Y'); 
																					  } ?>" />
																				<span class="form-control-icon"><i class="fa fa-calendar"></i></span>
																			</div>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                  <div class="form-group input-group date has-icon has-label">
																		<label>Start Hour</label>
																			<input type='text' id='spictimer' name="pictimer" class="pictimer form-control input-group-addon" value="<?php $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
																			$date->modify("+4 hours");
																			if(isset($fromdates))
																			{
																				echo $fromdates;
																			}
																			else
																			 {
																				 echo $date->format('hh:ii:ss'); 
																			  } ?>" />
																			<span class="form-control-icon"><i class="fa fa-clock-o"></i></span>                           
																	</div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row row-inputs">
                                                                <div class="container-fluid">
                                                                    <div class="col-sm-7">
                                                                            <div class="form-group input-group date has-icon has-label">
																				<label for="picdate">End Trip Date</label>
																				<input type='text' id="spicdate" name="to_date" class="picupdate form-control input-group-addon" value="<?php $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
																					$date->modify('+28 hours');
																					if(isset($fromdates))
																					{
																						echo $fromdates;
																					}
																					else
																					 {
																						 echo $date->format('d-m-Y'); 
																					  } ?>" />
																				<span class="form-control-icon"><i class="fa fa-calendar"></i></span>
																			</div>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                      <div class="form-group input-group date has-icon has-label">
																		<label>End Hour</label>
																			<input type='text' id='spictimer' name="pictimer" class="pictimer form-control input-group-addon" value="<?php $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
																			if(isset($fromdates))
																			{
																				echo $fromdates;
																			}
																			else
																			 {
																				 echo $date->format('hh:ii:ss'); 
																			  } ?>" />
																			<span class="form-control-icon"><i class="fa fa-clock-o"></i></span>                           
																	</div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row row-submit">
                                                                <div class="container-fluid">
                                                                    <div class="inner text-center">
																	<button type="submit" id="formFindCarSubmit" name="search" value="search" class="btn btn-submit ripple-effect btn-theme">Find Car</button>
                                                                                                   </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- /Search form -->
                                                    <h2 class="caption-title">Self drive for hire</h2>
                                                    <h3 class="caption-subtitle">Opt for your car</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Self Drive Slide End -->

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
                                                                                <option value="car">Car</option>
                                                                                <option value="bike">Bike</option>                                                                                
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group has-icon has-label">
                                                                            <label for="formSearchOffLocation2">Pick Location for Mechanic</label>
                                                                            <input id="formSearchOffLocation2" class="geocomplete form-control hireloc" type="text" placeholder="Location"  name="hireloc">
                                                                            <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row row-submit">
                                                                <div class="container-fluid">
                                                                    <div class="inner">
                                                                        <button type="submit" id="formSearchSubmit2" class="btn btn-submit btn-theme pull-right">Search</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- /Search form -->
                                                    <h2 class="caption-title">Mechanics for hire.</h2>
                                                    <h3 class="caption-subtitle">Reliable and trust worthy</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Hire a Mechanic Slide End -->
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
                                                <h4 class="caption-title">Round the clock Support</h4>
                                                <div class="caption-text">
                                                    <h5>Collect your vehicle</h5>
                                                    <p>Emergency and breakdown services round the clock. MPS offers services and assistance round the clock to help customers utilize and make the best of the services. Bookings, or other emergency related services we offer 24/7 client support.</p> 
                                                </div>
                                                <!--<div class="buttons">
                                                    <span class="btn btn-theme ripple-effect btn-theme-transparent">Read More</span>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="caption hovered">
                                        <div class="caption-wrapper div-table">
                                            <div class="caption-inner div-cell">
                                                <div class="caption-icon"><i class="fa fa-support"></i></div>
                                                <h4 class="caption-title">Round the clock Support</h4>
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
                                                <h4 class="caption-title">Hire from a range of cars.</h4>
                                                <div class="caption-text">
                                                    <p>MPS offers a range of cars for your journey. Make the best of our hire services any time. We offer different class of vehicles from various brands. Hire, online cars that to suit your needs and occasions.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="caption hovered">
                                        <div class="caption-wrapper div-table">
                                            <div class="caption-inner div-cell">
                                                <div class="caption-icon"><i class="fa fa-calendar"></i></div>
                                                <h4 class="caption-title">Hire from a range of cars.</h4>
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
                                                <h4 class="caption-title">Location based services</h4>
                                                <div class="caption-text">
                                                    <p>Our services span across varying locations, Metre Per Second caters to a wide range of places and offers service networks for various locations, on line. People of a specific locale can access services from that particular locality. </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="caption hovered">
                                        <div class="caption-wrapper div-table">
                                            <div class="caption-inner div-cell">
                                                <div class="caption-icon"><i class="fa fa-map-marker"></i></div>
                                                <h4 class="caption-title">Location based services</h4>
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
        <section class="page-section mobileslide dark">
                <div class="row">
                    <iframe src="<?php echo Yii::app()->baseUrl; ?>/index.php/mPSVEHICLES_DETAILS/appfeature" style="width:100%; height:650px;border:none;"></iframe>
                </div>
        </section>
        <!-- /PAGE -->

        <!-- HAPPY COSTUMERS PAGE -->
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
                                <div class="caption-number">100</div>
                                <h4 class="caption-title">Total Service Centers</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="300ms">
                        <div class="thumbnail thumbnail-counto no-border no-padding">
                            <div class="caption">
                                <div class="caption-icon"><i class="fa fa-flag"></i></div>
                                <div class="caption-number">1000</div>
                                <h4 class="caption-title">No. of Bookings</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="400ms">
                        <div class="thumbnail thumbnail-counto no-border no-padding">
                            <div class="caption">
                                <div class="caption-icon"><i class="fa fa-comments-o"></i></div>
                                <div class="caption-number">1255</div>
                                <h4 class="caption-title">Total Mechanics</h4>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- HAPPY COSTUMERS /PAGE -->

        <!-- PAGE -->
        <section class="page-section home-self-drive">
            <div class="container">

                <h2 class="section-title wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
                    <small>Select What You Want</small>
                    <span>A Fleet of cars for rent</span>
                </h2>

                <div class="tabs awesome wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
                    <ul id="tabs1" class="nav"><!--
                        --><li class="active"><a href="#tab-x1" data-toggle="tab">Economic cars</a></li><!--
                        --><li class=""><a href="#tab-x2" data-toggle="tab">Business cars</a></li><!--
                        --><li class=""><a href="#tab-x3" data-toggle="tab">Premium cars</a></li><!--
                        --><li class=""><a href="#tab-x4" data-toggle="tab">Luxury cars</a></li>
                        
                        
                    </ul>
                </div>

                <div class="tab-content wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
                    <!-- tab 1 -->
                    <div class="tab-pane fade active in" id="tab-x1">

                        <div class="car-big-card">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="tabs awesome-sub">
                                    <ul id="tabs-x1" class="nav">
                                    <?php
                                                        $i=1;
                                                        if(!empty($fetcheconomic))
                                                        {
                                                          foreach($fetcheconomic as $fetchModeleco)
                                                         {
                                                                if($i<2)
                                                                {
                                                                 $activet='active';
                                                                }
                                                                else{
                                                                     $activet='';
                                                                }
                                                                echo '<li class="'.$activet.'"><a href="#tab-x1x'.$i.'" data-toggle="tab">'.$fetchModeleco['models_name'].'</a></li>';
                                                            
                                                        
                                                        
                                                               $i++;
                                                         } 
                                                        }
                                                        else
                                                        {
                                                            echo 'Vehicles are not available';
                                                        } 
                                            ?>
                                    
                                    </ul>
                                       
                                    </div>
                                </div>
                                <div class="col-md-9">

                                    <!-- Sub tabs content -->
                                    <div class="tab-content">

                                    
                                    
                                                <?php
                                 $j=1;
                                 foreach($fetcheconomic as $fetchModeleconm)
                                                         {
                                                     if($j<2)
                                                     {
                                                        $activen='active in';
                                                        
                                                     }
                                                     else{
                                                         $activen='';
                                                     }
                                    echo '<div class="tab-pane fade '.$activen.'" id="tab-x1x'.$j.'">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <!-- Swiper -->
                                                    <div class="swiper-container" id="swiperSliderx1">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="http://www.metrepersecond.com/MPS'.$fetchModeleconm['img_path'].'" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="http://www.metrepersecond.com/MPS'.$fetchModeleconm['img_path'].'" data-gal="prettyPhoto"><img class="img-responsive" src="http://www.metrepersecond.com/MPS'.$fetchModeleconm['img_path'].'" alt=""/></a>
                                                            </div>
                                                            
                                                        </div>
                                                        <!-- Add Pagination -->
                                                        <div class="row car-thumbnails"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="car-details">
                                                       
                                                        <div class="list">
                                                            <ul>
                                                                
                                                                <li>Total KM :'.$fetchModeleconm['total_kms'].'KM</li>
                                                                <li>Price : Rs.'.$fetchModeleconm['price'].'/-</li>
                                                                <li>Price per hour : Rs.'.$fetchModeleconm['price_per_hour'].'/-</li>
                                                               
                                                               
                                                            </ul>
                                                        </div>
                                                        <div class="button">
                                                            <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  </div>        
                                        ';
                                            $j++;
                                        }
                                
                                ?>
                                      
                              
                                        
                                        
                                        

                                    </div>
                                    <!-- /Sub tabs content -->

                                </div>
                            </div>
                        </div>

                    </div>

                    <!--tab2-->
                    <div class="tab-pane fade" id="tab-x2">

                        <div class="car-big-card">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="tabs awesome-sub">
                                    <ul id="tabs-x2" class="nav">
                                    <?php
                                                        $xi=1;
                                                        if(!empty($fetchebusinesscar))
                                                        {
                                                          foreach($fetchebusinesscar as $fetchebusinessca)
                                                         {
                                                                if($xi<2)
                                                                {
                                                                 $activet='active';
                                                                }
                                                                else{
                                                                     $activet='';
                                                                }
                                                                echo '<li class="'.$activet.'"><a href="#tab-x2x'.$xi.'" data-toggle="tab">'.$fetchebusinessca['models_name'].'</a></li>';
                                                            
                                                        
                                                        
                                                               $xi++;
                                                         } 
                                                        }
                                                        else
                                                        {
                                                            echo 'Vehicles are not available';
                                                        } 
                                            ?>
                                    
                                    </ul>
                                       
                                    </div>
                                </div>
                                <div class="col-md-9">

                                    <!-- Sub tabs content -->
                                    <div class="tab-content">

                                    
                                    
                                                <?php
                                 $xj=1;
                                 foreach($fetchebusinesscar as $fetchebusiness)
                                                         {
                                                     if($xj<2)
                                                     {
                                                        $activenb='active in';
                                                        
                                                     }
                                                     else{
                                                         $activenb='';
                                                     }
                                    echo '<div class="tab-pane fade '.$activenb.'" id="tab-x2x'.$xj.'">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <!-- Swiper -->
                                                    <div class="swiper-container" id="swiperSliderx1">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="http://www.metrepersecond.com/MPS'.$fetchebusiness['img_path'].'" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="http://www.metrepersecond.com/MPS'.$fetchebusiness['img_path'].'" data-gal="prettyPhoto"><img class="img-responsive" src="http://www.metrepersecond.com/MPS'.$fetchebusiness['img_path'].'" alt=""/></a>
                                                            </div>
                                                            
                                                        </div>
                                                        <!-- Add Pagination -->
                                                        <div class="row car-thumbnails"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="car-details">
                                                       
                                                        <div class="list">
                                                            <ul>
                                                                
                                                                <li>Total KM :'.$fetchebusiness['total_kms'].'KM</li>
                                                                <li>Price : Rs.'.$fetchebusiness['price'].'/-</li>
                                                                <li>Price per hour : Rs.'.$fetchebusiness['price_per_hour'].'/-</li>
                                                               
                                                               
                                                            </ul>
                                                        </div>
                                                        <div class="button">
                                                            <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  </div>        
                                        ';
                                            $xj++;
                                        }
                                
                                ?>
                                      
                              
                                        
                                        
                                        

                                    </div>
                                    <!-- /Sub tabs content -->

                                </div>
                            </div>
                        </div>

                    </div>
                    <!--tab3-->
                
<div class="tab-pane fade" id="tab-x3">

                        <div class="car-big-card">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="tabs awesome-sub">
                                    <ul id="tabs-x3" class="nav">
                                    <?php
                                                        $xyi=1;
                                                        if(!empty($premiumcars))
                                                        {
                                                          foreach($premiumcars as $premiumca)
                                                         {
                                                                if($xyi<2)
                                                                {
                                                                 $activet='active';
                                                                }
                                                                else{
                                                                     $activet='';
                                                                }
                                                                echo '<li class="'.$activet.'"><a href="#tab-x3x'.$xyi.'" data-toggle="tab">'.$premiumca['models_name'].'</a></li>';
                                                            
                                                        
                                                        
                                                               $xyi++;
                                                         } 
                                                        }
                                                        else
                                                        {
                                                            echo 'Vehicles are not available';
                                                        } 
                                            ?>
                                    
                                    </ul>
                                       
                                    </div>
                                </div>
                                <div class="col-md-9">

                                    <!-- Sub tabs content -->
                                    <div class="tab-content">

                                    
                                    
                                                <?php
                                 $xjj=1;
                                 foreach($premiumcars as $premiumc)
                                                         {
                                                     if($xjj<2)
                                                     {
                                                        $activenn='active in';
                                                        
                                                     }
                                                     else{
                                                         $activenn='';
                                                     }
                                    echo '<div class="tab-pane fade '.$activenn.'" id="tab-x3x'.$xjj.'">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <!-- Swiper -->
                                                    <div class="swiper-container" id="swiperSliderx1">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="http://www.metrepersecond.com/MPS'.$premiumc['img_path'].'" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="http://www.metrepersecond.com/MPS'.$premiumc['img_path'].'" data-gal="prettyPhoto"><img class="img-responsive" src="http://www.metrepersecond.com/MPS'.$premiumc['img_path'].'" alt=""/></a>
                                                            </div>
                                                            
                                                        </div>
                                                        <!-- Add Pagination -->
                                                        <div class="row car-thumbnails"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="car-details">
                                                       
                                                        <div class="list">
                                                            <ul>
                                                                
                                                                <li>Total KM :'.$premiumc['total_kms'].'KM</li>
                                                                <li>Price : Rs.'.$premiumc['price'].'/-</li>
                                                                <li>Price per hour : Rs.'.$premiumc['price_per_hour'].'/-</li>
                                                               
                                                               
                                                            </ul>
                                                        </div>
                                                        <div class="button">
                                                            <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  </div>        
                                        ';
                                            $xjj++;
                                        }
                                
                                ?>
                                      
                              
                                        
                                        
                                        

                                    </div>
                                    <!-- /Sub tabs content -->

                                </div>
                            </div>
                        </div>

                    </div>
                    
                    <!--tab4-->
                    <div class="tab-pane fade" id="tab-x4">

                        <div class="car-big-card">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="tabs awesome-sub">
                                    <ul id="tabs-x4" class="nav">
                                    <?php
                                                        $xyyi=1;
                                                        if(!empty($fetchluxury))
                                                        {
                                                          foreach($fetchluxury as $fetchl)
                                                         {
                                                                if($xyyi<2)
                                                                {
                                                                 $activet='active';
                                                                }
                                                                else{
                                                                     $activet='';
                                                                }
                                                                echo '<li class="'.$activet.'"><a href="#tab-x4x'.$xyyi.'" data-toggle="tab">'.$fetchl['models_name'].'</a></li>';
                                                            
                                                        
                                                        
                                                               $xyyi++;
                                                         } 
                                                        }
                                                        else
                                                        {
                                                            echo 'Vehicles are not available';
                                                        } 
                                            ?>
                                    
                                    </ul>
                                       
                                    </div>
                                </div>
                                <div class="col-md-9">

                                    <!-- Sub tabs content -->
                                    <div class="tab-content">

                                    
                                    
                                                <?php
                                 $xjjj=1;
                                 foreach($fetchluxury as $fetchlux)
                                                         {
                                                     if($xjjj<2)
                                                     {
                                                        $activenn='active in';
                                                        
                                                     }
                                                     else{
                                                         $activenn='';
                                                     }
                                    echo '<div class="tab-pane fade '.$activenn.'" id="tab-x4x'.$xjjj.'">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <!-- Swiper -->
                                                    <div class="swiper-container" id="swiperSliderx1">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="http://www.metrepersecond.com/MPS'.$fetchlux['img_path'].'" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="http://www.metrepersecond.com/MPS'.$fetchlux['img_path'].'" data-gal="prettyPhoto"><img class="img-responsive" src="http://www.metrepersecond.com/MPS'.$fetchlux['img_path'].'" alt=""/></a>
                                                            </div>
                                                            
                                                        </div>
                                                        <!-- Add Pagination -->
                                                        <div class="row car-thumbnails"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="car-details">
                                                       
                                                        <div class="list">
                                                            <ul>
                                                                
                                                                <li>Total KM :'.$premiumc['total_kms'].'KM</li>
                                                                <li>Price : Rs.'.$premiumc['price'].'/-</li>
                                                                <li>Price per hour : Rs.'.$premiumc['price_per_hour'].'/-</li>
                                                               
                                                               
                                                            </ul>
                                                        </div>
                                                        <div class="button">
                                                            <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  </div>        
                                        ';
                                            $xjjj++;
                                        }
                                
                                ?>
                                      
                              
                                        
                                        
                                        

                                    </div>
                                    <!-- /Sub tabs content -->

                                </div>
                            </div>
                        </div>

                    </div>
                    <!--end-->
                    </div>
                    <!--end-->
                        </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>
        <!-- /PAGE -->
        
        <!-- FIND MECHANICS PAGE -->
        <section class="page-section find-car dark">
            <div class="container">
                <form class="form-find-car">
                    <div class="row">
                        <div class="col-md-3 wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
                            <h2 class="section-title text-left no-margin">
                                <small>Find Your</small>
                                <span>Mechanic</span>
                            </h2>                   
                        </div>
                        <div class="col-md-7 wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
                            <div class="form-group has-icon has-label">
                                <input type="text" class="form-control locbook geocomplete" name="adrsvalue" id="pic_input" placeholder="Pull Location">
                                <!--<span class="form-control-icon"><i class="fa fa-location-arrow"></i></span>-->
                                <input type="hidden"  id="location" name="location" value="" />
                            </div>
                        </div>
                        <div class="col-md-2 wow fadeInDown" data-wow-offset="200" data-wow-delay="500ms">
                            <div class="form-group">
                                <button type="button" id="b" class="btn btn-block ripple-effect btn-theme">FIND</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- FIND MECHANICS PAGE /PAGE -->

        <!-- PAGE -->
        <section class="page-section no-padding no-bottom-space-off">
            <div class="container full-width">
                <!-- Google map -->

               <div class="google-map" id="ex">
              <!--  <input type="hidden" id="t" value="17.385044">
               <input type="hidden" id="l" value="78.486671"> -->
                    <div id="mapmachho"></div> 
                </div>
    <script>
                $(document).ready(function()
{
     $(".geocomplete").geocomplete({
        
          details: "form",
          types: ["geocode", "establishment"],
        });
    
    $('body').on('change',function() {
    var s=$('#location').val();
    var res=s.split(',');
    
    
      if(s){
          
       $('#b').click(function() {
        
$.post('index.php/MPSVEHICLES_DETAILS/Maps',{
                                
                            },
                            function(data)
                            { 
                               
                           // alert(data);
                            var locations=JSON.parse(data);

    //console.log(locations);
    /* var locations = [
      ['dfsd', '17.4138277', '78.43975840000007']]; */
    //alert(locations[0][1]);
    var a=$('#location').val();
    var res1=a.split(',');
    
    var l=$('#us3-lat').val();
    var t=$('#us3-lon').val();
    
if(locations){

    var map = new google.maps.Map(document.getElementById('mapmachho'), {
      zoom: 12,
	   scaleControl: false,
  scrollwheel: false,
      center: new google.maps.LatLng(res1[0],res1[1]),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
	   mapTypeControl: false,
	     styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]
 
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) { 
   // alert(locations[i][1]);
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon: 'http://www.metrepersecond.com/bookaservice/assets/img/map-marker.png'
      });

      google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
        return function() {
          infowindow.setContent('<div class="map_details"><h3>'+locations[i][4]+'</h3><strong>&#x20B9;'+locations[i][3]+'</strong><a href="index.php/HireMechanic/hireMechanicDetails/'+locations[i][5]+'" class="btn btn-block btn-submit btn-theme">Hire</a></div>');
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
}
});
       });
      }else
      {
          
          $.post('index.php/MPSVEHICLES_DETAILS/Maps',{
                                
                            },
                            function(data)
                            { 
                               
                            
                            var locations=JSON.parse(data);

    //console.log(locations);
    /* var locations = [
      ['dfsd', '17.4138277', '78.43975840000007']]; */
    //alert(locations[0][1]);
    var l=$('#us3-lat').val();
    var t=$('#us3-lon').val();
        
          if(locations){

    var map = new google.maps.Map(document.getElementById('mapmachho'), {
      zoom: 12,
	   scaleControl: false,
		scrollwheel: false,
      center: new google.maps.LatLng(l,t),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
	   mapTypeControl: false,
      styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) { 
   // alert(locations[i][1]);
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon: 'http://www.metrepersecond.com/bookaservice/assets/img/map-marker.png'
      });

      google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
        return function() {
		
          infowindow.setContent('<div class="map_details"><h3>'+locations[i][4]+'</h3><strong>&#x20B9;'+locations[i][3]+'</strong><a href="index.php/HireMechanic/hireMechanicDetails/'+locations[i][5]+'" class="btn btn-block btn-submit btn-theme">Hire</a></div>');
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
}
      
    

     });
}
});
        
            
});
  </script>
                <!-- /Google map -->

            </div>
        </section>
        <!-- /PAGE -->

        <!-- TESTMONIALS PAGE -->
        <section class="page-section testimonials">
            <div class="container wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
                <div class="testimonials-carousel">
                    <div class="owl-carousel" id="testimonials">
                        <div class="testimonial">
                            <div class="media">
                                <div class="pull-left">
                                    <a href="#">
                                        <img class="media-object testimonial-avatar" src="<?php echo Yii::app()->baseUrl; ?>/images/profile_default.png" alt="Testimonial avatar">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <div class="testimonial-text">I was lacking time to get my vehicle serviced but when I came across the application I was delighted in learning that one can get serviced multiple brands from a single application without roaming around service centers.</div>
                                    <div class="testimonial-name">Praveen Kumar <!-- <span class="testimonial-position">Founder at MPS</span> --></div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial">
                            <div class="media">
                                <div class="pull-left">
                                    <a href="#">
                                        <img class="media-object testimonial-avatar" src="<?php echo Yii::app()->baseUrl; ?>/images/profile_default.png" alt="Testimonial avatar">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <div class="testimonial-text">Hired a car through Metre per second and had the privilege of driving it on my own. Fabulous cars and fabulous services.</div>
                                    <div class="testimonial-name">Venkat <!-- <span class="testimonial-position">Co- founder at MPS</span> --></div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="testimonial">
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object testimonial-avatar" src="assets/img/preview/avatars/testimonial-140x140x1.jpg" alt="Testimonial avatar">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <div class="testimonial-text">Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</div>
                                    <div class="testimonial-name">Venkat <span class="testimonial-position">Customer</span></div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </section>
        <!-- TESTMONIALS /PAGE -->

        <!-- FAQ'S PAGE -->
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
                                            <span class="dot"></span>Knowing more about Car Battery Drain 
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
                                    <div class="panel-body">
                                      Batteries often go dead and the reasons could be many. There could be electrical problems in your car that is draining your battery or other problems     </div>
                                </div>
                            </div>
                            <!-- /faq1 -->
                            <!-- faq2 -->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading2">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                            <span class="dot"></span> How Long Does a Power Brake Booster Last? 
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
                                    <div class="panel-body">
                                      When you press the brake pedal, your car slows down and eventually stops. Most of us put little more thought into it. We know that our brake pads      </div>
                                </div>
                            </div>
                            <!-- /faq2 -->
                            <!-- faq3 -->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading3">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                            <span class="dot"></span> Door Latch and the signs of it giving up.
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3">
                                    <div class="panel-body">
                                       A door latch is located on every door on your vehicle. It is what keeps the doors shut while you are driving down the road. Each door has two     </div>
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
                                            <span class="dot"></span>Wheel Alignment And The Aspects Involved 
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse21" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading21">
                                    <div class="panel-body">
                                       When your car drifts or pulls in one direction and the steering wheel does not center align when  driving straight down the road. Its time to align your wheels.  </div>
                                </div>
                            </div>
                            <!-- /faq1 -->
                            <!-- faq2 -->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading22">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion2" href="#collapse22" aria-expanded="true" aria-controls="collapse22">
                                            <span class="dot"></span>Assessing the shape of the tires. 
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse22" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading22">
                                    <div class="panel-body">
                                        Tires only have a certain period of life. A vehicle must have tires fit for normal driving conditions. </div>
                                </div>
                            </div>
                            <!-- /faq2 -->
                            <!-- faq3 -->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading23">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse23" aria-expanded="false" aria-controls="collapse23">
                                            <span class="dot"></span>Tire Rotation and How. 
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse23" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading23">
                                    <div class="panel-body">
                                       Refer to your owner's manual for the exact tire rotation schedule for your car. The general recommendation is that tires be rotated every 5,000 to 8,000 miles, and this often coincides with oil changes. Consider exploring an in depth article about how often you should rotate your tires for more information.</div>
                                </div>
                            </div>
                            <!-- /faq3 -->
                        </div>
                        <!-- /FAQ -->
                    </div>
                </div>
                <div class="outer required col-md-3 col-md-offset-5">
                    <div class="form-group af-inner">
                        <a href="http://www.metrepersecond.com/bookaservice/index.php/VehicleGuide" class="form-button form-button-submit btn btn-block btn-theme ripple-effect btn-theme-dark">More</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- FAQ'S /PAGE -->
        <!-- Change location map model popup -->
        <div id="us6-dialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Change Your Current Location</h4>
                </div>

                <div class="modal-body">
                    <div class="form-horizontal" style="width: 550px">
                        <div class="form-group">                                
                            <label class="col-sm-2 control-label">Location:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="us3-address" />
                            </div>
                        </div>
                        <div id="us3" style="width: 100%; height: 400px;"></div>                        
                        <div class="clearfix">&nbsp;</div>
                        <div class="m-t-small">
                            <!-- <label class="p-r-small col-sm-1 control-label">Lat.:</label> -->
                            <div class="col-sm-3">
                                <input type="hidden" class="form-control" style="width: 110px" id="us3-lat" value="17.4405022" />
                            </div>
                            <!-- <label class="p-r-small col-sm-2 control-label">Long.:</label> -->
                            <div class="col-sm-3">
                                <input type="hidden" class="form-control" style="width: 110px" id="us3-lon" value="78.4001641" />
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <script>
				   function mark_active_menu(){
                            $('#us3').locationpicker({
                    
                    
                        
                                location: {
                                    latitude: $('#l').val(),
                                    longitude: $('#t').val()
                                },
                                radius: 2,
                                inputBinding: {
                                    latitudeInput: $('#us3-lat'),
                                    longitudeInput: $('#us3-lon'),
                                    radiusInput: $('#us3-radius'),
                                    locationNameInput: $('#us3-address')
                                },
                                enableAutocomplete: true,
                                markerIcon: 'http://www.metrepersecond.com/bookaservice/assets/img/map-marker.png'
                            });
                            $('#us6-dialog').on('shown.bs.modal', function () {
                        
                                $('#us3').locationpicker('autosize');
                    
                            });
                            }
                            function mark_active_menu1(){
                            $('#us3').locationpicker({
                    
                    
                        
                                location: {
                                    latitude: 17.485267,
                                    longitude: 78.65892
                                },
                                radius: 2,
                                inputBinding: {
                                    latitudeInput: $('#us3-lat'),
                                    longitudeInput: $('#us3-lon'),
                                    radiusInput: $('#us3-radius'),
                                    locationNameInput: $('#us3-address')
                                },
                                enableAutocomplete: true,
                                markerIcon: 'http://www.metrepersecond.com/bookaservice/assets/img/map-marker.png'
                            });
                            $('#us6-dialog').on('shown.bs.modal', function () {
                        
                                $('#us3').locationpicker('autosize');
                    
                            });
                            }
                            $('#us3-address').on('change', function() {
                                var getloc=$('#us3-address').val();
                                $("#bookloc").val(getloc);
                                $("#pic_input").val(getloc);
                            });
                        </script>
                       
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        </div>
        
        
        
        
        <!-- /. End Change location map model popup -->

<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/owl-carousel2/owl.carousel.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/swiper/js/swiper.jquery.min.js"></script>

<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/dist/locationpicker.jquery.min.js"></script>
<script>
$(document).ready(function() {
                var startPos;
   var geoOptions = {
    enableHighAccuracy: false

  } 
var i=0;
$("#r").on('click',function(){
if(i==0)
{
	mark_active_menu1();
}
});
  var geoSuccess = function(position) {
    startPos = position;

    var la=startPos.coords.latitude;    
    var lo=startPos.coords.longitude;
    document.getElementsByClassName("locationone")[0].setAttribute("value",la); 
    document.getElementsByClassName("locationone")[1].setAttribute("value",lo); 
	i=1;
  mark_active_menu();

  
  
  };

   var geoError = function(error) {
    console.log('Error occurred. Error code: ' + error.code);
    // error.code can be:
    //   0: unknown error
    //   1: permission denied
    //   2: position unavailable (error response from location provider)
    //   3: timed out
    
  }; 

navigator.geolocation.getCurrentPosition(geoSuccess, geoError);
});
</script>

<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/jquery.geocomplete.js"></script>

<script>
      $(function(){
       

      
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


    $('#mobilepresent').carousel({
      interval: 3000,
      cycle: true
    });
        
    });
 

</script>

 <!-- 
   <script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -33.8688, lng: 151.2195},
          zoom: 13
        });
        
        
        
          if (navigator.geolocation) {
             
          navigator.geolocation.getCurrentPosition(function(position) {
              // alert(position.coords);
                $('#txtLatitude').val(position.coords.latitude);
                $('#txtLongitude').val(position.coords.longitude);
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            
            //getting address based on longitude and latitude
            var lat = parseFloat(document.getElementById("txtLatitude").value);
            var lng = parseFloat(document.getElementById("txtLongitude").value);
            var latlng = new google.maps.LatLng(lat, lng);
            var geocoder = geocoder = new google.maps.Geocoder();
            geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[1]) {
                        //alert("Location: " + results[1].formatted_address);
                        $('#bookloc').val(results[1].formatted_address);
                        $('.hireloc').val(results[1].formatted_address);
                        $('.locbook').val(results[1].formatted_address);
                        $('#adrs').val(results[1].formatted_address);
                        
                        
                        
                    }
                    else{
                        
                    }
                }
            }); 
            //-----------------------------
            //alert(position.coords.latitude);
            var marker = new google.maps.Marker({
                position: pos,
                title:"Hello World!"
            });
            marker.setMap(map);
            map.setCenter(pos);
            
          }, function() {
            //handleLocationError(true, infoWindow, map.getCenter());
          });
        }
        var input = /** @type {!HTMLInputElement} */(
            document.getElementById('pac-input'));

        var types = document.getElementById('type-selector');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
        

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
            
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
         
          if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setIcon(/** @type {google.maps.Icon} */({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
          }));
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

          infowindow.setContent('<div align="left"><strong>'+ place.name + '</strong><br>' + address+'<br/><br/><br/><br/>'+'<a href="index.php/mPSVEHICLES_DETAILS/Hiremechanicdetails" class="btn btn-block btn-submit ripple-effect btn-theme">Hire Mechanic</a>');
          infowindow.open(map, marker);
        });

        
    
    
     
      google.maps.event.addListener(marker, 'click', function() {
            
      //$.post('ajax/fetchstationdetails.php',{gas_station_id:gas_station_id},function(data){
      var place = autocomplete.getPlace();
          if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setIcon(/** @type {google.maps.Icon} */({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
          }));
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }
      infowindow.setContent('<div><a href="index.php/mPSVEHICLES_DETAILS/Hiremechanicdetails">Hire it<strong>'+ place.name + '</strong><br>' + address);
          infowindow.open(map, marker);
                
              //  });  
    
        
      });
    
        
        
        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
          var radioButton = document.getElementById(id);
          radioButton.addEventListener('click', function() {
            autocomplete.setTypes(types);
          });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);
      }
    </script>
     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvY-U7jBqVaWpSTf4YZ65J2XAii2-ax58&libraries=places&callback=initMap"
        async defer></script>   -->

    
    <!--<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>-->


    
    
||||||| .r444
<link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/datetimepicker/js/moment-with-locales.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/datetimepicker/js/bootstrap-datetimepicker.js"></script>


<?php
 //echo Yii::app()->baseUrl;
  //echo 'xjzs;';
   //print_r($fetcheconomic);
 //exit;     
  ?>
  
<script>
$(document).ready(function()
{

     $('#carlist li').click(function() {
     //Get the id of list itemstime
       var vmakeid = $(this).attr('id');
       $('#makes_id').val(vmakeid);
    
                $.post('index.php/mPSVEHICLES_DETAILS/Getvmodel',{
                        Maker:vmakeid,
                    },
                    function(data)
                    {
                            //alert(data);
                            
                         $("#modellist").html(data);
                            
                    });
            
   });
   $("#modellist").on('click','li',function (){
       var modelid = $(this).attr('id');
        $('#model_id').val(modelid);
      
    text1=$(this).text();
    $('#span1').text(text1);
    
});

// date and time picker

$('.picupdate').datetimepicker({
    format: 'DD-MM-YYYY'
});


$('.pictimer').datetimepicker({
					format: 'H:mm',
					 stepping: 30,
							   
				});
				   
});
});



</script>
  

<!--<img src="bookAservice/images/uploadimages/models/car/test.jpg" name="a" id="a"/>-->


<link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/owl-carousel2/assets/owl.carousel.min.css" rel="stylesheet">

    <script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/dropdownscript.js"></script>

    <script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/jquery-ui/jquery-ui.js"></script>

    <!-- PAGE -->
    <section class="page-section no-padding slider">
                <div class="container full-width">

                    <div class="main-slider">
                        <div class="owl-carousel" id="main-slider">

<!-- Book a Service slide -->
<div class="item slide1 ver1">
    <div class="caption">
        <div class="container">
            <div class="div-table">
                <div class="div-cell">
                    <div class="caption-content">
                        <h2 class="caption-title">A hub for car and bike care</h2>
                        <h3 class="caption-subtitle">Car &amp; Bike services</h3>
    <!-- Search form -->
    <div class="row">
    <div class="col-sm-12 col-md-10 col-md-offset-1">

    <div class="form-search dark">
        <form action="<?php echo $this->createUrl('mPSVEHICLES_DETAILS/Savebookservice');?>" method="post">
        
            <div class="form-title">
                <i class="fa fa-globe"></i>
                <h2>Book Now - For a trouble free ride.</h2>
            </div>

            <div class="row row-inputs">
                <div class="container-fluid">
                    <div class="col-sm-6">
                        <div class="form-group has-icon has-label">
                            <label>Pick Location</label>
                            <input type="text" class="form-control geocomplete" id="bookloc" name="bookloc" value="<?php echo Yii::app()->session['location'];?>"placeholder="Current Location">
                            
                            <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                        </div>
                        <div>
                            <a data-target="#us6-dialog" data-toggle="modal" id="r" class="btn btn-submit btn-theme"><i class="fa fa-map-marker"></i>Change Location</a>
                            <input type="hidden" id="l" value="" class="locationone">
                            <input type="hidden" id="t"  value="" class="locationone">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group input-group date has-icon has-label">
                            <label for="picdate">Pick Date</label>
                            <input type='text' id="picdate" name="picdate" class="picupdate form-control input-group-addon" value="<?php $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                                if(isset($fromdates))
                                {
                                    echo $fromdates;
                                }
                                else
                                 {
                                     echo $date->format('d-m-Y'); 
                                  } ?>" />
                            <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group input-group date has-icon has-label">
                            <label>Pick Hour</label>
                                <input type='text' id='pictimer' name="pictimer" class="pictimer form-control input-group-addon" value="<?php $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                                if(isset($fromdates))
                                {
                                    echo $fromdates;
                                }
                                else
                                 {
                                     echo $date->format('H:ii:ss A'); 
                                  } ?>" />
                                <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-submit" style="margin-top: 10px;">
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

                            <!-- Self Drive Slide -->
                            <div class="item slide3 ver3">
                                <div class="caption">
                                    <div class="container">
                                        <div class="div-table">
                                            <div class="div-cell">
                                                <div class="caption-content">
                                                    <!-- Search form -->
                                                    <div class="form-search light">
                                                       <form action="<?php echo $this->createUrl('Selfdrive/SelfdrivedetailsSearch'); ?>"" method="POST" class="form-find-car">
                                                            <div class="form-title">
                                                                <i class="fa fa-globe"></i>
                                                                <h2>Search a vehicle for your journey.</h2>
                                                            </div>
                                                            <div class="row row-inputs">
                                                                <div class="container-fluid">
                                                                    <div class="col-sm-7">
                                                                           <div class="form-group input-group date has-icon has-label">
																				<label for="picdate">Start Trip Date</label>
																				<input type='text' id="spicdate" name="from_date" class="picupdate form-control input-group-addon" value="<?php $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
																					if(isset($fromdates))
																					{
																						echo $fromdates;
																					}
																					else
																					 {
																						 echo $date->format('d-m-Y'); 
																					  } ?>" />
																				<span class="form-control-icon"><i class="fa fa-calendar"></i></span>
																			</div>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                  <div class="form-group input-group date has-icon has-label">
																		<label>Start Hour</label>
																			<input type='text' id='spictimer' name="pictimer" class="pictimer form-control input-group-addon" value="<?php $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
																			$date->modify("+4 hours");
																			if(isset($fromdates))
																			{
																				echo $fromdates;
																			}
																			else
																			 {
																				 echo $date->format('hh:ii:ss'); 
																			  } ?>" />
																			<span class="form-control-icon"><i class="fa fa-clock-o"></i></span>                           
																	</div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row row-inputs">
                                                                <div class="container-fluid">
                                                                    <div class="col-sm-7">
                                                                            <div class="form-group input-group date has-icon has-label">
																				<label for="picdate">End Trip Date</label>
																				<input type='text' id="spicdate" name="to_date" class="picupdate form-control input-group-addon" value="<?php $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
																					$date->modify('+28 hours');
																					if(isset($fromdates))
																					{
																						echo $fromdates;
																					}
																					else
																					 {
																						 echo $date->format('d-m-Y'); 
																					  } ?>" />
																				<span class="form-control-icon"><i class="fa fa-calendar"></i></span>
																			</div>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                      <div class="form-group input-group date has-icon has-label">
																		<label>End Hour</label>
																			<input type='text' id='spictimer' name="pictimer" class="pictimer form-control input-group-addon" value="<?php $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
																			if(isset($fromdates))
																			{
																				echo $fromdates;
																			}
																			else
																			 {
																				 echo $date->format('hh:ii:ss'); 
																			  } ?>" />
																			<span class="form-control-icon"><i class="fa fa-clock-o"></i></span>                           
																	</div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row row-submit">
                                                                <div class="container-fluid">
                                                                    <div class="inner text-center">
																	<button type="submit" id="formFindCarSubmit" name="search" value="search" class="btn btn-submit ripple-effect btn-theme">Find Car</button>
                                                                                                   </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- /Search form -->
                                                    <h2 class="caption-title">Self drive for hire</h2>
                                                    <h3 class="caption-subtitle">Opt for your car</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Self Drive Slide End -->

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
                                                                                <option value="car">Car</option>
                                                                                <option value="bike">Bike</option>                                                                                
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group has-icon has-label">
                                                                            <label for="formSearchOffLocation2">Pick Location for Mechanic</label>
                                                                            <input id="formSearchOffLocation2" class="geocomplete form-control hireloc" type="text" placeholder="Location"  name="hireloc">
                                                                            <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row row-submit">
                                                                <div class="container-fluid">
                                                                    <div class="inner">
                                                                        <button type="submit" id="formSearchSubmit2" class="btn btn-submit btn-theme pull-right">Search</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- /Search form -->
                                                    <h2 class="caption-title">Mechanics for hire.</h2>
                                                    <h3 class="caption-subtitle">Reliable and trust worthy</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Hire a Mechanic Slide End -->
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
                                                <h4 class="caption-title">Round the clock Support</h4>
                                                <div class="caption-text">
                                                    <h5>Collect your vehicle</h5>
                                                    <p>Emergency and breakdown services round the clock. MPS offers services and assistance round the clock to help customers utilize and make the best of the services. Bookings, or other emergency related services we offer 24/7 client support.</p> 
                                                </div>
                                                <!--<div class="buttons">
                                                    <span class="btn btn-theme ripple-effect btn-theme-transparent">Read More</span>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="caption hovered">
                                        <div class="caption-wrapper div-table">
                                            <div class="caption-inner div-cell">
                                                <div class="caption-icon"><i class="fa fa-support"></i></div>
                                                <h4 class="caption-title">Round the clock Support</h4>
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
                                                <h4 class="caption-title">Hire from a range of cars.</h4>
                                                <div class="caption-text">
                                                    <p>MPS offers a range of cars for your journey. Make the best of our hire services any time. We offer different class of vehicles from various brands. Hire, online cars that to suit your needs and occasions.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="caption hovered">
                                        <div class="caption-wrapper div-table">
                                            <div class="caption-inner div-cell">
                                                <div class="caption-icon"><i class="fa fa-calendar"></i></div>
                                                <h4 class="caption-title">Hire from a range of cars.</h4>
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
                                                <h4 class="caption-title">Location based services</h4>
                                                <div class="caption-text">
                                                    <p>Our services span across varying locations, Metre Per Second caters to a wide range of places and offers service networks for various locations, on line. People of a specific locale can access services from that particular locality. </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="caption hovered">
                                        <div class="caption-wrapper div-table">
                                            <div class="caption-inner div-cell">
                                                <div class="caption-icon"><i class="fa fa-map-marker"></i></div>
                                                <h4 class="caption-title">Location based services</h4>
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
        <section class="page-section mobileslide dark">
                <div class="row">
                    <div class="container"><iframe src="<?php echo Yii::app()->baseUrl; ?>/index.php/mPSVEHICLES_DETAILS/appfeature" style="width:100%; height:650px;border:none;"></iframe></div>
                </div>
        </section>
        <!-- /PAGE -->

        <!-- HAPPY COSTUMERS PAGE -->
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
                                <div class="caption-number">100</div>
                                <h4 class="caption-title">Total Service Centers</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="300ms">
                        <div class="thumbnail thumbnail-counto no-border no-padding">
                            <div class="caption">
                                <div class="caption-icon"><i class="fa fa-flag"></i></div>
                                <div class="caption-number">1000</div>
                                <h4 class="caption-title">No. of Bookings</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="400ms">
                        <div class="thumbnail thumbnail-counto no-border no-padding">
                            <div class="caption">
                                <div class="caption-icon"><i class="fa fa-comments-o"></i></div>
                                <div class="caption-number">1255</div>
                                <h4 class="caption-title">Total Mechanics</h4>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- HAPPY COSTUMERS /PAGE -->

        <!-- PAGE -->
        <section class="page-section home-self-drive">
            <div class="container">

                <h2 class="section-title wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
                    <small>Select What You Want</small>
                    <span>A Fleet of cars for rent</span>
                </h2>

                <div class="tabs awesome wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
                    <ul id="tabs1" class="nav"><!--
                        --><li class="active"><a href="#tab-x1" data-toggle="tab">Economic cars</a></li><!--
                        --><li class=""><a href="#tab-x2" data-toggle="tab">Business cars</a></li><!--
                        --><li class=""><a href="#tab-x3" data-toggle="tab">Premium cars</a></li><!--
                        --><li class=""><a href="#tab-x4" data-toggle="tab">Luxury cars</a></li>
                        
                        
                    </ul>
                </div>

                <div class="tab-content wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
                    <!-- tab 1 -->
                    <div class="tab-pane fade active in" id="tab-x1">

                        <div class="car-big-card">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="tabs awesome-sub">
                                    <ul id="tabs-x1" class="nav">
                                    <?php
                                                        $i=1;
                                                        if(!empty($fetcheconomic))
                                                        {
                                                          foreach($fetcheconomic as $fetchModeleco)
                                                         {
                                                                if($i<2)
                                                                {
                                                                 $activet='active';
                                                                }
                                                                else{
                                                                     $activet='';
                                                                }
                                                                echo '<li class="'.$activet.'"><a href="#tab-x1x'.$i.'" data-toggle="tab">'.$fetchModeleco['models_name'].'</a></li>';
                                                            
                                                        
                                                        
                                                               $i++;
                                                         } 
                                                        }
                                                        else
                                                        {
                                                            echo 'Vehicles are not available';
                                                        } 
                                            ?>
                                    
                                    </ul>
                                       
                                    </div>
                                </div>
                                <div class="col-md-9">

                                    <!-- Sub tabs content -->
                                    <div class="tab-content">

                                    
                                    
                                                <?php
                                 $j=1;
                                 foreach($fetcheconomic as $fetchModeleconm)
                                                         {
                                                     if($j<2)
                                                     {
                                                        $activen='active in';
                                                        
                                                     }
                                                     else{
                                                         $activen='';
                                                     }
                                    echo '<div class="tab-pane fade '.$activen.'" id="tab-x1x'.$j.'">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <!-- Swiper -->
                                                    <div class="swiper-container" id="swiperSliderx1">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="http://www.metrepersecond.com/MPS'.$fetchModeleconm['img_path'].'" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="http://www.metrepersecond.com/MPS'.$fetchModeleconm['img_path'].'" data-gal="prettyPhoto"><img class="img-responsive" src="http://www.metrepersecond.com/MPS'.$fetchModeleconm['img_path'].'" alt=""/></a>
                                                            </div>
                                                            
                                                        </div>
                                                        <!-- Add Pagination -->
                                                        <div class="row car-thumbnails"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="car-details">
                                                       
                                                        <div class="list">
                                                            <ul>
                                                                
                                                                <li>Total KM :'.$fetchModeleconm['total_kms'].'KM</li>
                                                                <li>Price : Rs.'.$fetchModeleconm['price'].'/-</li>
                                                                <li>Price per hour : Rs.'.$fetchModeleconm['price_per_hour'].'/-</li>
                                                               
                                                               
                                                            </ul>
                                                        </div>
                                                        <div class="button">
                                                            <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  </div>        
                                        ';
                                            $j++;
                                        }
                                
                                ?>
                                      
                              
                                        
                                        
                                        

                                    </div>
                                    <!-- /Sub tabs content -->

                                </div>
                            </div>
                        </div>

                    </div>

                    <!--tab2-->
                    <div class="tab-pane fade" id="tab-x2">

                        <div class="car-big-card">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="tabs awesome-sub">
                                    <ul id="tabs-x2" class="nav">
                                    <?php
                                                        $xi=1;
                                                        if(!empty($fetchebusinesscar))
                                                        {
                                                          foreach($fetchebusinesscar as $fetchebusinessca)
                                                         {
                                                                if($xi<2)
                                                                {
                                                                 $activet='active';
                                                                }
                                                                else{
                                                                     $activet='';
                                                                }
                                                                echo '<li class="'.$activet.'"><a href="#tab-x2x'.$xi.'" data-toggle="tab">'.$fetchebusinessca['models_name'].'</a></li>';
                                                            
                                                        
                                                        
                                                               $xi++;
                                                         } 
                                                        }
                                                        else
                                                        {
                                                            echo 'Vehicles are not available';
                                                        } 
                                            ?>
                                    
                                    </ul>
                                       
                                    </div>
                                </div>
                                <div class="col-md-9">

                                    <!-- Sub tabs content -->
                                    <div class="tab-content">

                                    
                                    
                                                <?php
                                 $xj=1;
                                 foreach($fetchebusinesscar as $fetchebusiness)
                                                         {
                                                     if($xj<2)
                                                     {
                                                        $activenb='active in';
                                                        
                                                     }
                                                     else{
                                                         $activenb='';
                                                     }
                                    echo '<div class="tab-pane fade '.$activenb.'" id="tab-x2x'.$xj.'">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <!-- Swiper -->
                                                    <div class="swiper-container" id="swiperSliderx1">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="http://www.metrepersecond.com/MPS'.$fetchebusiness['img_path'].'" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="http://www.metrepersecond.com/MPS'.$fetchebusiness['img_path'].'" data-gal="prettyPhoto"><img class="img-responsive" src="http://www.metrepersecond.com/MPS'.$fetchebusiness['img_path'].'" alt=""/></a>
                                                            </div>
                                                            
                                                        </div>
                                                        <!-- Add Pagination -->
                                                        <div class="row car-thumbnails"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="car-details">
                                                       
                                                        <div class="list">
                                                            <ul>
                                                                
                                                                <li>Total KM :'.$fetchebusiness['total_kms'].'KM</li>
                                                                <li>Price : Rs.'.$fetchebusiness['price'].'/-</li>
                                                                <li>Price per hour : Rs.'.$fetchebusiness['price_per_hour'].'/-</li>
                                                               
                                                               
                                                            </ul>
                                                        </div>
                                                        <div class="button">
                                                            <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  </div>        
                                        ';
                                            $xj++;
                                        }
                                
                                ?>
                                      
                              
                                        
                                        
                                        

                                    </div>
                                    <!-- /Sub tabs content -->

                                </div>
                            </div>
                        </div>

                    </div>
                    <!--tab3-->
                
<div class="tab-pane fade" id="tab-x3">

                        <div class="car-big-card">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="tabs awesome-sub">
                                    <ul id="tabs-x3" class="nav">
                                    <?php
                                                        $xyi=1;
                                                        if(!empty($premiumcars))
                                                        {
                                                          foreach($premiumcars as $premiumca)
                                                         {
                                                                if($xyi<2)
                                                                {
                                                                 $activet='active';
                                                                }
                                                                else{
                                                                     $activet='';
                                                                }
                                                                echo '<li class="'.$activet.'"><a href="#tab-x3x'.$xyi.'" data-toggle="tab">'.$premiumca['models_name'].'</a></li>';
                                                            
                                                        
                                                        
                                                               $xyi++;
                                                         } 
                                                        }
                                                        else
                                                        {
                                                            echo 'Vehicles are not available';
                                                        } 
                                            ?>
                                    
                                    </ul>
                                       
                                    </div>
                                </div>
                                <div class="col-md-9">

                                    <!-- Sub tabs content -->
                                    <div class="tab-content">

                                    
                                    
                                                <?php
                                 $xjj=1;
                                 foreach($premiumcars as $premiumc)
                                                         {
                                                     if($xjj<2)
                                                     {
                                                        $activenn='active in';
                                                        
                                                     }
                                                     else{
                                                         $activenn='';
                                                     }
                                    echo '<div class="tab-pane fade '.$activenn.'" id="tab-x3x'.$xjj.'">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <!-- Swiper -->
                                                    <div class="swiper-container" id="swiperSliderx1">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="http://www.metrepersecond.com/MPS'.$premiumc['img_path'].'" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="http://www.metrepersecond.com/MPS'.$premiumc['img_path'].'" data-gal="prettyPhoto"><img class="img-responsive" src="http://www.metrepersecond.com/MPS'.$premiumc['img_path'].'" alt=""/></a>
                                                            </div>
                                                            
                                                        </div>
                                                        <!-- Add Pagination -->
                                                        <div class="row car-thumbnails"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="car-details">
                                                       
                                                        <div class="list">
                                                            <ul>
                                                                
                                                                <li>Total KM :'.$premiumc['total_kms'].'KM</li>
                                                                <li>Price : Rs.'.$premiumc['price'].'/-</li>
                                                                <li>Price per hour : Rs.'.$premiumc['price_per_hour'].'/-</li>
                                                               
                                                               
                                                            </ul>
                                                        </div>
                                                        <div class="button">
                                                            <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  </div>        
                                        ';
                                            $xjj++;
                                        }
                                
                                ?>
                                      
                              
                                        
                                        
                                        

                                    </div>
                                    <!-- /Sub tabs content -->

                                </div>
                            </div>
                        </div>

                    </div>
                    
                    <!--tab4-->
                    <div class="tab-pane fade" id="tab-x4">

                        <div class="car-big-card">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="tabs awesome-sub">
                                    <ul id="tabs-x4" class="nav">
                                    <?php
                                                        $xyyi=1;
                                                        if(!empty($fetchluxury))
                                                        {
                                                          foreach($fetchluxury as $fetchl)
                                                         {
                                                                if($xyyi<2)
                                                                {
                                                                 $activet='active';
                                                                }
                                                                else{
                                                                     $activet='';
                                                                }
                                                                echo '<li class="'.$activet.'"><a href="#tab-x4x'.$xyyi.'" data-toggle="tab">'.$fetchl['models_name'].'</a></li>';
                                                            
                                                        
                                                        
                                                               $xyyi++;
                                                         } 
                                                        }
                                                        else
                                                        {
                                                            echo 'Vehicles are not available';
                                                        } 
                                            ?>
                                    
                                    </ul>
                                       
                                    </div>
                                </div>
                                <div class="col-md-9">

                                    <!-- Sub tabs content -->
                                    <div class="tab-content">

                                    
                                    
                                                <?php
                                 $xjjj=1;
                                 foreach($fetchluxury as $fetchlux)
                                                         {
                                                     if($xjjj<2)
                                                     {
                                                        $activenn='active in';
                                                        
                                                     }
                                                     else{
                                                         $activenn='';
                                                     }
                                    echo '<div class="tab-pane fade '.$activenn.'" id="tab-x4x'.$xjjj.'">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <!-- Swiper -->
                                                    <div class="swiper-container" id="swiperSliderx1">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="http://www.metrepersecond.com/MPS'.$fetchlux['img_path'].'" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="http://www.metrepersecond.com/MPS'.$fetchlux['img_path'].'" data-gal="prettyPhoto"><img class="img-responsive" src="http://www.metrepersecond.com/MPS'.$fetchlux['img_path'].'" alt=""/></a>
                                                            </div>
                                                            
                                                        </div>
                                                        <!-- Add Pagination -->
                                                        <div class="row car-thumbnails"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="car-details">
                                                       
                                                        <div class="list">
                                                            <ul>
                                                                
                                                                <li>Total KM :'.$premiumc['total_kms'].'KM</li>
                                                                <li>Price : Rs.'.$premiumc['price'].'/-</li>
                                                                <li>Price per hour : Rs.'.$premiumc['price_per_hour'].'/-</li>
                                                               
                                                               
                                                            </ul>
                                                        </div>
                                                        <div class="button">
                                                            <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  </div>        
                                        ';
                                            $xjjj++;
                                        }
                                
                                ?>
                                      
                              
                                        
                                        
                                        

                                    </div>
                                    <!-- /Sub tabs content -->

                                </div>
                            </div>
                        </div>

                    </div>
                    <!--end-->
                    </div>
                    <!--end-->
                        </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>
        <!-- /PAGE -->
        
        <!-- FIND MECHANICS PAGE -->
        <section class="page-section find-car dark">
            <div class="container">
                <form class="form-find-car">
                    <div class="row">
                        <div class="col-md-3 wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
                            <h2 class="section-title text-left no-margin">
                                <small>Find Your</small>
                                <span>Mechanic</span>
                            </h2>                   
                        </div>
                        <div class="col-md-7 wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
                            <div class="form-group has-icon has-label">
                                <input type="text" class="form-control locbook geocomplete" name="adrsvalue" id="pic_input" placeholder="Pull Location">
                                <!--<span class="form-control-icon"><i class="fa fa-location-arrow"></i></span>-->
                                <input type="hidden"  id="location" name="location" value="" />
                            </div>
                        </div>
                        <div class="col-md-2 wow fadeInDown" data-wow-offset="200" data-wow-delay="500ms">
                            <div class="form-group">
                                <button type="button" id="b" class="btn btn-block ripple-effect btn-theme">FIND</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- FIND MECHANICS PAGE /PAGE -->

        <!-- PAGE -->
        <section class="page-section no-padding no-bottom-space-off">
            <div class="container full-width">
                <!-- Google map -->

               <div class="google-map" id="ex">
              <!--  <input type="hidden" id="t" value="17.385044">
               <input type="hidden" id="l" value="78.486671"> -->
                    <div id="mapmachho"></div> 
                </div>
    <script>
                $(document).ready(function()
{
     $(".geocomplete").geocomplete({
        
          details: "form",
          types: ["geocode", "establishment"],
        });
    
    $('body').on('change',function() {
    var s=$('#location').val();
    var res=s.split(',');
    
    
      if(s){
          
       $('#b').click(function() {
        
$.post('index.php/MPSVEHICLES_DETAILS/Maps',{
                                
                            },
                            function(data)
                            { 
                               
                           // alert(data);
                            var locations=JSON.parse(data);

    //console.log(locations);
    /* var locations = [
      ['dfsd', '17.4138277', '78.43975840000007']]; */
    //alert(locations[0][1]);
    var a=$('#location').val();
    var res1=a.split(',');
    
    var l=$('#us3-lat').val();
    var t=$('#us3-lon').val();
    
if(locations){

    var map = new google.maps.Map(document.getElementById('mapmachho'), {
      zoom: 12,
	   scaleControl: false,
  scrollwheel: false,
      center: new google.maps.LatLng(res1[0],res1[1]),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
	   mapTypeControl: false,
	     styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]
 
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) { 
   // alert(locations[i][1]);
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon: 'http://www.metrepersecond.com/bookaservice/assets/img/map-marker.png'
      });

      google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
        return function() {
          infowindow.setContent('<div class="map_details"><h3>'+locations[i][4]+'</h3><strong>&#x20B9;'+locations[i][3]+'</strong><a href="index.php/mPSVEHICLES_DETAILS/Hiremechanicdetails" class="btn btn-block btn-submit ripple-effect btn-theme">Hire It</a>');
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
}
});
       });
      }else
      {
          
          $.post('index.php/MPSVEHICLES_DETAILS/Maps',{
                                
                            },
                            function(data)
                            { 
                               
                            
                            var locations=JSON.parse(data);

    //console.log(locations);
    /* var locations = [
      ['dfsd', '17.4138277', '78.43975840000007']]; */
    //alert(locations[0][1]);
    var l=$('#us3-lat').val();
    var t=$('#us3-lon').val();
        
          if(locations){

    var map = new google.maps.Map(document.getElementById('mapmachho'), {
      zoom: 12,
	   scaleControl: false,
		scrollwheel: false,
      center: new google.maps.LatLng(l,t),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
	   mapTypeControl: false,
      styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) { 
   // alert(locations[i][1]);
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon: 'http://www.metrepersecond.com/bookaservice/assets/img/map-marker.png'
      });

      google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
        return function() {
		
          infowindow.setContent('<div class="map_details"><h3>'+locations[i][4]+'</h3><strong>&#x20B9;'+locations[i][3]+'</strong><a href="index.php/mPSVEHICLES_DETAILS/Hiremechanicdetails" class="btn btn-block btn-submit btn-theme">Hire It</a></div>');
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
}
      
    

     });
}
});
        
            
});
  </script>
                <!-- /Google map -->

            </div>
        </section>
        <!-- /PAGE -->

        <!-- TESTMONIALS PAGE -->
        <section class="page-section testimonials">
            <div class="container wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
                <div class="testimonials-carousel">
                    <div class="owl-carousel" id="testimonials">
                        <div class="testimonial">
                            <div class="media">
                                <div class="pull-left">
                                    <a href="#">
                                        <img class="media-object testimonial-avatar" src="<?php echo Yii::app()->baseUrl; ?>/images/profile_default.png" alt="Testimonial avatar">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <div class="testimonial-text">I was lacking time to get my vehicle serviced but when I came across the application I was delighted in learning that one can get serviced multiple brands from a single application without roaming around service centers.</div>
                                    <div class="testimonial-name">Praveen Kumar <!-- <span class="testimonial-position">Founder at MPS</span> --></div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial">
                            <div class="media">
                                <div class="pull-left">
                                    <a href="#">
                                        <img class="media-object testimonial-avatar" src="<?php echo Yii::app()->baseUrl; ?>/images/profile_default.png" alt="Testimonial avatar">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <div class="testimonial-text">Hired a car through Metre per second and had the privilege of driving it on my own. Fabulous cars and fabulous services.</div>
                                    <div class="testimonial-name">Venkat <!-- <span class="testimonial-position">Co- founder at MPS</span> --></div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="testimonial">
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object testimonial-avatar" src="assets/img/preview/avatars/testimonial-140x140x1.jpg" alt="Testimonial avatar">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <div class="testimonial-text">Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</div>
                                    <div class="testimonial-name">Venkat <span class="testimonial-position">Customer</span></div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </section>
        <!-- TESTMONIALS /PAGE -->

        <!-- FAQ'S PAGE -->
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
                                            <span class="dot"></span>Knowing more about Car Battery Drain 
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
                                    <div class="panel-body">
                                      Batteries often go dead and the reasons could be many. There could be electrical problems in your car that is draining your battery or other problems     </div>
                                </div>
                            </div>
                            <!-- /faq1 -->
                            <!-- faq2 -->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading2">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                            <span class="dot"></span> How Long Does a Power Brake Booster Last? 
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
                                    <div class="panel-body">
                                      When you press the brake pedal, your car slows down and eventually stops. Most of us put little more thought into it. We know that our brake pads      </div>
                                </div>
                            </div>
                            <!-- /faq2 -->
                            <!-- faq3 -->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading3">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                            <span class="dot"></span> Door Latch and the signs of it giving up.
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3">
                                    <div class="panel-body">
                                       A door latch is located on every door on your vehicle. It is what keeps the doors shut while you are driving down the road. Each door has two     </div>
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
                                            <span class="dot"></span>Wheel Alignment And The Aspects Involved 
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse21" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading21">
                                    <div class="panel-body">
                                       When your car drifts or pulls in one direction and the steering wheel does not center align when  driving straight down the road. Its time to align your wheels.  </div>
                                </div>
                            </div>
                            <!-- /faq1 -->
                            <!-- faq2 -->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading22">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion2" href="#collapse22" aria-expanded="true" aria-controls="collapse22">
                                            <span class="dot"></span>Assessing the shape of the tires. 
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse22" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading22">
                                    <div class="panel-body">
                                        Tires only have a certain period of life. A vehicle must have tires fit for normal driving conditions. </div>
                                </div>
                            </div>
                            <!-- /faq2 -->
                            <!-- faq3 -->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading23">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse23" aria-expanded="false" aria-controls="collapse23">
                                            <span class="dot"></span>Tire Rotation and How. 
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse23" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading23">
                                    <div class="panel-body">
                                       Refer to your owner's manual for the exact tire rotation schedule for your car. The general recommendation is that tires be rotated every 5,000 to 8,000 miles, and this often coincides with oil changes. Consider exploring an in depth article about how often you should rotate your tires for more information.</div>
                                </div>
                            </div>
                            <!-- /faq3 -->
                        </div>
                        <!-- /FAQ -->
                    </div>
                </div>
                <div class="outer required col-md-3 col-md-offset-5">
                    <div class="form-group af-inner">
                        <a href="http://www.metrepersecond.com/bookaservice/index.php/VehicleGuide" class="form-button form-button-submit btn btn-block btn-theme ripple-effect btn-theme-dark">More</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- FAQ'S /PAGE -->
        <!-- Change location map model popup -->
        <div id="us6-dialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Change Your Current Location</h4>
                </div>

                <div class="modal-body">
                    <div class="form-horizontal" style="width: 550px">
                        <div class="form-group">                                
                            <label class="col-sm-2 control-label">Location:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="us3-address" />
                            </div>
                        </div>
                        <div id="us3" style="width: 100%; height: 400px;"></div>                        
                        <div class="clearfix">&nbsp;</div>
                        <div class="m-t-small">
                            <!-- <label class="p-r-small col-sm-1 control-label">Lat.:</label> -->
                            <div class="col-sm-3">
                                <input type="hidden" class="form-control" style="width: 110px" id="us3-lat" value="17.4405022" />
                            </div>
                            <!-- <label class="p-r-small col-sm-2 control-label">Long.:</label> -->
                            <div class="col-sm-3">
                                <input type="hidden" class="form-control" style="width: 110px" id="us3-lon" value="78.4001641" />
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <script>
				   function mark_active_menu(){
                            $('#us3').locationpicker({
                    
                    
                        
                                location: {
                                    latitude: $('#l').val(),
                                    longitude: $('#t').val()
                                },
                                radius: 2,
                                inputBinding: {
                                    latitudeInput: $('#us3-lat'),
                                    longitudeInput: $('#us3-lon'),
                                    radiusInput: $('#us3-radius'),
                                    locationNameInput: $('#us3-address')
                                },
                                enableAutocomplete: true,
                                markerIcon: 'http://www.metrepersecond.com/bookaservice/assets/img/map-marker.png'
                            });
                            $('#us6-dialog').on('shown.bs.modal', function () {
                        
                                $('#us3').locationpicker('autosize');
                    
                            });
                            }
                            function mark_active_menu1(){
                            $('#us3').locationpicker({
                    
                    
                        
                                location: {
                                    latitude: 17.485267,
                                    longitude: 78.65892
                                },
                                radius: 2,
                                inputBinding: {
                                    latitudeInput: $('#us3-lat'),
                                    longitudeInput: $('#us3-lon'),
                                    radiusInput: $('#us3-radius'),
                                    locationNameInput: $('#us3-address')
                                },
                                enableAutocomplete: true,
                                markerIcon: 'http://www.metrepersecond.com/bookaservice/assets/img/map-marker.png'
                            });
                            $('#us6-dialog').on('shown.bs.modal', function () {
                        
                                $('#us3').locationpicker('autosize');
                    
                            });
                            }
                            $('#us3-address').on('change', function() {
                                var getloc=$('#us3-address').val();
                                $("#bookloc").val(getloc);
                                $("#pic_input").val(getloc);
                            });
                        </script>
                       
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        </div>
        
        
        
        
        <!-- /. End Change location map model popup -->

<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/owl-carousel2/owl.carousel.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/swiper/js/swiper.jquery.min.js"></script>

<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/dist/locationpicker.jquery.min.js"></script>
<script>
$(document).ready(function() {
                var startPos;
   var geoOptions = {
    enableHighAccuracy: false

  } 
var i=0;
$("#r").on('click',function(){
if(i==0)
{
	mark_active_menu1();
}
});
  var geoSuccess = function(position) {
    startPos = position;

    var la=startPos.coords.latitude;    
    var lo=startPos.coords.longitude;
    document.getElementsByClassName("locationone")[0].setAttribute("value",la); 
    document.getElementsByClassName("locationone")[1].setAttribute("value",lo); 
	i=1;
  mark_active_menu();

  
  
  };

   var geoError = function(error) {
    console.log('Error occurred. Error code: ' + error.code);
    // error.code can be:
    //   0: unknown error
    //   1: permission denied
    //   2: position unavailable (error response from location provider)
    //   3: timed out
    
  }; 

navigator.geolocation.getCurrentPosition(geoSuccess, geoError);
});
</script>

<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/jquery.geocomplete.js"></script>

<script>
      $(function(){
       

      
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


    $('#mobilepresent').carousel({
      interval: 3000,
      cycle: true
    });
        
    });
 

</script>

 <!-- 
   <script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -33.8688, lng: 151.2195},
          zoom: 13
        });
        
        
        
          if (navigator.geolocation) {
             
          navigator.geolocation.getCurrentPosition(function(position) {
              // alert(position.coords);
                $('#txtLatitude').val(position.coords.latitude);
                $('#txtLongitude').val(position.coords.longitude);
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            
            //getting address based on longitude and latitude
            var lat = parseFloat(document.getElementById("txtLatitude").value);
            var lng = parseFloat(document.getElementById("txtLongitude").value);
            var latlng = new google.maps.LatLng(lat, lng);
            var geocoder = geocoder = new google.maps.Geocoder();
            geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[1]) {
                        //alert("Location: " + results[1].formatted_address);
                        $('#bookloc').val(results[1].formatted_address);
                        $('.hireloc').val(results[1].formatted_address);
                        $('.locbook').val(results[1].formatted_address);
                        $('#adrs').val(results[1].formatted_address);
                        
                        
                        
                    }
                    else{
                        
                    }
                }
            }); 
            //-----------------------------
            //alert(position.coords.latitude);
            var marker = new google.maps.Marker({
                position: pos,
                title:"Hello World!"
            });
            marker.setMap(map);
            map.setCenter(pos);
            
          }, function() {
            //handleLocationError(true, infoWindow, map.getCenter());
          });
        }
        var input = /** @type {!HTMLInputElement} */(
            document.getElementById('pac-input'));

        var types = document.getElementById('type-selector');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
        

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
            
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
         
          if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setIcon(/** @type {google.maps.Icon} */({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
          }));
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

          infowindow.setContent('<div align="left"><strong>'+ place.name + '</strong><br>' + address+'<br/><br/><br/><br/>'+'<a href="index.php/mPSVEHICLES_DETAILS/Hiremechanicdetails" class="btn btn-block btn-submit ripple-effect btn-theme">Hire Mechanic</a>');
          infowindow.open(map, marker);
        });

        
    
    
     
      google.maps.event.addListener(marker, 'click', function() {
            
      //$.post('ajax/fetchstationdetails.php',{gas_station_id:gas_station_id},function(data){
      var place = autocomplete.getPlace();
          if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setIcon(/** @type {google.maps.Icon} */({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
          }));
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }
      infowindow.setContent('<div><a href="index.php/mPSVEHICLES_DETAILS/Hiremechanicdetails">Hire it<strong>'+ place.name + '</strong><br>' + address);
          infowindow.open(map, marker);
                
              //  });  
    
        
      });
    
        
        
        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
          var radioButton = document.getElementById(id);
          radioButton.addEventListener('click', function() {
            autocomplete.setTypes(types);
          });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);
      }
    </script>
     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvY-U7jBqVaWpSTf4YZ65J2XAii2-ax58&libraries=places&callback=initMap"
        async defer></script>   -->

    
    <!--<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>-->


    
    
=======
<link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/datetimepicker/js/moment-with-locales.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/datetimepicker/js/bootstrap-datetimepicker.js"></script>


<?php
 //echo Yii::app()->baseUrl;
  //echo 'xjzs;';
   //print_r($fetcheconomic);
 //exit;     
  ?>
  
<script>
$(document).ready(function()
{

     $('#carlist li').click(function() {
     //Get the id of list itemstime
       var vmakeid = $(this).attr('id');
       $('#makes_id').val(vmakeid);
    
                $.post('index.php/mPSVEHICLES_DETAILS/Getvmodel',{
                        Maker:vmakeid,
                    },
                    function(data)
                    {
                            //alert(data);
                            
                         $("#modellist").html(data);
                            
                    });
            
   });
   $("#modellist").on('click','li',function (){
       var modelid = $(this).attr('id');
        $('#model_id').val(modelid);
      
    text1=$(this).text();
    $('#span1').text(text1);
    
});

// date and time picker

$('.picupdate').datetimepicker({
    format: 'DD-MM-YYYY'
});


$('.pictimer').datetimepicker({
					format: 'H:mm',
					 stepping: 30,
							   
				});
				   
});



</script>
  

<!--<img src="bookAservice/images/uploadimages/models/car/test.jpg" name="a" id="a"/>-->


<link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/owl-carousel2/assets/owl.carousel.min.css" rel="stylesheet">

    <script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/dropdownscript.js"></script>

    <script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/jquery-ui/jquery-ui.js"></script>

    <!-- PAGE -->
    <section class="page-section no-padding slider">
                <div class="container full-width">

                    <div class="main-slider">
                        <div class="owl-carousel" id="main-slider">

<!-- Book a Service slide -->
<div class="item slide1 ver1">
    <div class="caption">
        <div class="container">
            <div class="div-table">
                <div class="div-cell">
                    <div class="caption-content">
                        <h2 class="caption-title">A hub for car and bike care</h2>
                        <h3 class="caption-subtitle">Car &amp; Bike services</h3>
    <!-- Search form -->
    <div class="row">
    <div class="col-sm-12 col-md-10 col-md-offset-1">

    <div class="form-search dark">
        <form action="<?php echo $this->createUrl('mPSVEHICLES_DETAILS/Savebookservice');?>" method="post">
        
            <div class="form-title">
                <i class="fa fa-globe"></i>
                <h2>Book Now - For a trouble free ride.</h2>
            </div>

            <div class="row row-inputs">
                <div class="container-fluid">
                    <div class="col-sm-6">
                        <div class="form-group has-icon has-label">
                            <label>Pick Location</label>
                            <input type="text" class="form-control geocomplete" id="bookloc" name="bookloc" value="<?php echo Yii::app()->session['location'];?>"placeholder="Current Location">
                            
                            <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                        </div>
                        <div>
                            <a data-target="#us6-dialog" data-toggle="modal" id="r" class="btn btn-submit btn-theme"><i class="fa fa-map-marker"></i>Change Location</a>
                            <input type="hidden" id="l" value="" class="locationone">
                            <input type="hidden" id="t"  value="" class="locationone">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group input-group date has-icon has-label">
                            <label for="picdate">Pick Date</label>
                            <input type='text' id="picdate" name="picdate" class="picupdate form-control input-group-addon" value="<?php $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                                if(isset($fromdates))
                                {
                                    echo $fromdates;
                                }
                                else
                                 {
                                     echo $date->format('d-m-Y'); 
                                  } ?>" />
                            <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group input-group date has-icon has-label">
                            <label>Pick Hour</label>
                                <input type='text' id='pictimer' name="pictimer" class="pictimer form-control input-group-addon" value="<?php $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                                if(isset($fromdates))
                                {
                                    echo $fromdates;
                                }
                                else
                                 {
                                     echo $date->format('H:ii:ss A'); 
                                  } ?>" />
                                <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-submit" style="margin-top: 10px;">
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

                            <!-- Self Drive Slide -->
                            <div class="item slide3 ver3">
                                <div class="caption">
                                    <div class="container">
                                        <div class="div-table">
                                            <div class="div-cell">
                                                <div class="caption-content">
                                                    <!-- Search form -->
                                                    <div class="form-search light">
                                                       <form action="<?php echo $this->createUrl('Selfdrive/SelfdrivedetailsSearch'); ?>"" method="POST" class="form-find-car">
                                                            <div class="form-title">
                                                                <i class="fa fa-globe"></i>
                                                                <h2>Search a vehicle for your journey.</h2>
                                                            </div>
                                                            <div class="row row-inputs">
                                                                <div class="container-fluid">
                                                                    <div class="col-sm-7">
                                                                           <div class="form-group input-group date has-icon has-label">
																				<label for="picdate">Start Trip Date</label>
																				<input type='text' id="spicdate" name="from_date" class="picupdate form-control input-group-addon" value="<?php $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
																					if(isset($fromdates))
																					{
																						echo $fromdates;
																					}
																					else
																					 {
																						 echo $date->format('d-m-Y'); 
																					  } ?>" />
																				<span class="form-control-icon"><i class="fa fa-calendar"></i></span>
																			</div>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                  <div class="form-group input-group date has-icon has-label">
																		<label>Start Hour</label>
																			<input type='text' id='spictimer' name="pictimer" class="pictimer form-control input-group-addon" value="<?php $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
																			$date->modify("+4 hours");
																			if(isset($fromdates))
																			{
																				echo $fromdates;
																			}
																			else
																			 {
																				 echo $date->format('hh:ii:ss'); 
																			  } ?>" />
																			<span class="form-control-icon"><i class="fa fa-clock-o"></i></span>                           
																	</div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row row-inputs">
                                                                <div class="container-fluid">
                                                                    <div class="col-sm-7">
                                                                            <div class="form-group input-group date has-icon has-label">
																				<label for="picdate">End Trip Date</label>
																				<input type='text' id="spicdate" name="to_date" class="picupdate form-control input-group-addon" value="<?php $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
																					$date->modify('+28 hours');
																					if(isset($fromdates))
																					{
																						echo $fromdates;
																					}
																					else
																					 {
																						 echo $date->format('d-m-Y'); 
																					  } ?>" />
																				<span class="form-control-icon"><i class="fa fa-calendar"></i></span>
																			</div>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                      <div class="form-group input-group date has-icon has-label">
																		<label>End Hour</label>
																			<input type='text' id='spictimer' name="pictimer" class="pictimer form-control input-group-addon" value="<?php $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
																			if(isset($fromdates))
																			{
																				echo $fromdates;
																			}
																			else
																			 {
																				 echo $date->format('hh:ii:ss'); 
																			  } ?>" />
																			<span class="form-control-icon"><i class="fa fa-clock-o"></i></span>                           
																	</div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row row-submit">
                                                                <div class="container-fluid">
                                                                    <div class="inner text-center">
																	<button type="submit" id="formFindCarSubmit" name="search" value="search" class="btn btn-submit ripple-effect btn-theme">Find Car</button>
                                                                                                   </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- /Search form -->
                                                    <h2 class="caption-title">Self drive for hire</h2>
                                                    <h3 class="caption-subtitle">Opt for your car</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Self Drive Slide End -->

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
                                                                                <option value="car">Car</option>
                                                                                <option value="bike">Bike</option>                                                                                
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group has-icon has-label">
                                                                            <label for="formSearchOffLocation2">Pick Location for Mechanic</label>
                                                                            <input id="formSearchOffLocation2" class="geocomplete form-control hireloc" type="text" placeholder="Location"  name="hireloc">
                                                                            <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row row-submit">
                                                                <div class="container-fluid">
                                                                    <div class="inner">
                                                                        <button type="submit" id="formSearchSubmit2" class="btn btn-submit btn-theme pull-right">Search</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- /Search form -->
                                                    <h2 class="caption-title">Mechanics for hire.</h2>
                                                    <h3 class="caption-subtitle">Reliable and trust worthy</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Hire a Mechanic Slide End -->
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
                                                <h4 class="caption-title">Round the clock Support</h4>
                                                <div class="caption-text">
                                                    <h5>Collect your vehicle</h5>
                                                    <p>Emergency and breakdown services round the clock. MPS offers services and assistance round the clock to help customers utilize and make the best of the services. Bookings, or other emergency related services we offer 24/7 client support.</p> 
                                                </div>
                                                <!--<div class="buttons">
                                                    <span class="btn btn-theme ripple-effect btn-theme-transparent">Read More</span>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="caption hovered">
                                        <div class="caption-wrapper div-table">
                                            <div class="caption-inner div-cell">
                                                <div class="caption-icon"><i class="fa fa-support"></i></div>
                                                <h4 class="caption-title">Round the clock Support</h4>
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
                                                <h4 class="caption-title">Hire from a range of cars.</h4>
                                                <div class="caption-text">
                                                    <p>MPS offers a range of cars for your journey. Make the best of our hire services any time. We offer different class of vehicles from various brands. Hire, online cars that to suit your needs and occasions.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="caption hovered">
                                        <div class="caption-wrapper div-table">
                                            <div class="caption-inner div-cell">
                                                <div class="caption-icon"><i class="fa fa-calendar"></i></div>
                                                <h4 class="caption-title">Hire from a range of cars.</h4>
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
                                                <h4 class="caption-title">Location based services</h4>
                                                <div class="caption-text">
                                                    <p>Our services span across varying locations, Metre Per Second caters to a wide range of places and offers service networks for various locations, on line. People of a specific locale can access services from that particular locality. </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="caption hovered">
                                        <div class="caption-wrapper div-table">
                                            <div class="caption-inner div-cell">
                                                <div class="caption-icon"><i class="fa fa-map-marker"></i></div>
                                                <h4 class="caption-title">Location based services</h4>
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
        <section class="page-section mobileslide dark">
                <div class="row">
                    <iframe src="<?php echo Yii::app()->baseUrl; ?>/index.php/mPSVEHICLES_DETAILS/appfeature" style="width:100%; height:650px;border:none;"></iframe>
                </div>
        </section>
        <!-- /PAGE -->

        <!-- HAPPY COSTUMERS PAGE -->
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
                                <div class="caption-number">100</div>
                                <h4 class="caption-title">Total Service Centers</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="300ms">
                        <div class="thumbnail thumbnail-counto no-border no-padding">
                            <div class="caption">
                                <div class="caption-icon"><i class="fa fa-flag"></i></div>
                                <div class="caption-number">1000</div>
                                <h4 class="caption-title">No. of Bookings</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="400ms">
                        <div class="thumbnail thumbnail-counto no-border no-padding">
                            <div class="caption">
                                <div class="caption-icon"><i class="fa fa-comments-o"></i></div>
                                <div class="caption-number">1255</div>
                                <h4 class="caption-title">Total Mechanics</h4>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- HAPPY COSTUMERS /PAGE -->

        <!-- PAGE -->
        <section class="page-section home-self-drive">
            <div class="container">

                <h2 class="section-title wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
                    <small>Select What You Want</small>
                    <span>A Fleet of cars for rent</span>
                </h2>

                <div class="tabs awesome wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
                    <ul id="tabs1" class="nav"><!--
                        --><li class="active"><a href="#tab-x1" data-toggle="tab">Economic cars</a></li><!--
                        --><li class=""><a href="#tab-x2" data-toggle="tab">Business cars</a></li><!--
                        --><li class=""><a href="#tab-x3" data-toggle="tab">Premium cars</a></li><!--
                        --><li class=""><a href="#tab-x4" data-toggle="tab">Luxury cars</a></li>
                        
                        
                    </ul>
                </div>

                <div class="tab-content wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
                    <!-- tab 1 -->
                    <div class="tab-pane fade active in" id="tab-x1">

                        <div class="car-big-card">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="tabs awesome-sub">
                                    <ul id="tabs-x1" class="nav">
                                    <?php
                                                        $i=1;
                                                        if(!empty($fetcheconomic))
                                                        {
                                                          foreach($fetcheconomic as $fetchModeleco)
                                                         {
                                                                if($i<2)
                                                                {
                                                                 $activet='active';
                                                                }
                                                                else{
                                                                     $activet='';
                                                                }
                                                                echo '<li class="'.$activet.'"><a href="#tab-x1x'.$i.'" data-toggle="tab">'.$fetchModeleco['models_name'].'</a></li>';
                                                            
                                                        
                                                        
                                                               $i++;
                                                         } 
                                                        }
                                                        else
                                                        {
                                                            echo 'Vehicles are not available';
                                                        } 
                                            ?>
                                    
                                    </ul>
                                       
                                    </div>
                                </div>
                                <div class="col-md-9">

                                    <!-- Sub tabs content -->
                                    <div class="tab-content">

                                    
                                    
                                                <?php
                                 $j=1;
                                 foreach($fetcheconomic as $fetchModeleconm)
                                                         {
                                                     if($j<2)
                                                     {
                                                        $activen='active in';
                                                        
                                                     }
                                                     else{
                                                         $activen='';
                                                     }
                                    echo '<div class="tab-pane fade '.$activen.'" id="tab-x1x'.$j.'">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <!-- Swiper -->
                                                    <div class="swiper-container" id="swiperSliderx1">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="http://www.metrepersecond.com/MPS'.$fetchModeleconm['img_path'].'" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="http://www.metrepersecond.com/MPS'.$fetchModeleconm['img_path'].'" data-gal="prettyPhoto"><img class="img-responsive" src="http://www.metrepersecond.com/MPS'.$fetchModeleconm['img_path'].'" alt=""/></a>
                                                            </div>
                                                            
                                                        </div>
                                                        <!-- Add Pagination -->
                                                        <div class="row car-thumbnails"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="car-details">
                                                       
                                                        <div class="list">
                                                            <ul>
                                                                
                                                                <li>Total KM :'.$fetchModeleconm['total_kms'].'KM</li>
                                                                <li>Price : Rs.'.$fetchModeleconm['price'].'/-</li>
                                                                <li>Price per hour : Rs.'.$fetchModeleconm['price_per_hour'].'/-</li>
                                                               
                                                               
                                                            </ul>
                                                        </div>
                                                        <div class="button">
                                                            <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  </div>        
                                        ';
                                            $j++;
                                        }
                                
                                ?>
                                      
                              
                                        
                                        
                                        

                                    </div>
                                    <!-- /Sub tabs content -->

                                </div>
                            </div>
                        </div>

                    </div>

                    <!--tab2-->
                    <div class="tab-pane fade" id="tab-x2">

                        <div class="car-big-card">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="tabs awesome-sub">
                                    <ul id="tabs-x2" class="nav">
                                    <?php
                                                        $xi=1;
                                                        if(!empty($fetchebusinesscar))
                                                        {
                                                          foreach($fetchebusinesscar as $fetchebusinessca)
                                                         {
                                                                if($xi<2)
                                                                {
                                                                 $activet='active';
                                                                }
                                                                else{
                                                                     $activet='';
                                                                }
                                                                echo '<li class="'.$activet.'"><a href="#tab-x2x'.$xi.'" data-toggle="tab">'.$fetchebusinessca['models_name'].'</a></li>';
                                                            
                                                        
                                                        
                                                               $xi++;
                                                         } 
                                                        }
                                                        else
                                                        {
                                                            echo 'Vehicles are not available';
                                                        } 
                                            ?>
                                    
                                    </ul>
                                       
                                    </div>
                                </div>
                                <div class="col-md-9">

                                    <!-- Sub tabs content -->
                                    <div class="tab-content">

                                    
                                    
                                                <?php
                                 $xj=1;
                                 foreach($fetchebusinesscar as $fetchebusiness)
                                                         {
                                                     if($xj<2)
                                                     {
                                                        $activenb='active in';
                                                        
                                                     }
                                                     else{
                                                         $activenb='';
                                                     }
                                    echo '<div class="tab-pane fade '.$activenb.'" id="tab-x2x'.$xj.'">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <!-- Swiper -->
                                                    <div class="swiper-container" id="swiperSliderx1">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="http://www.metrepersecond.com/MPS'.$fetchebusiness['img_path'].'" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="http://www.metrepersecond.com/MPS'.$fetchebusiness['img_path'].'" data-gal="prettyPhoto"><img class="img-responsive" src="http://www.metrepersecond.com/MPS'.$fetchebusiness['img_path'].'" alt=""/></a>
                                                            </div>
                                                            
                                                        </div>
                                                        <!-- Add Pagination -->
                                                        <div class="row car-thumbnails"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="car-details">
                                                       
                                                        <div class="list">
                                                            <ul>
                                                                
                                                                <li>Total KM :'.$fetchebusiness['total_kms'].'KM</li>
                                                                <li>Price : Rs.'.$fetchebusiness['price'].'/-</li>
                                                                <li>Price per hour : Rs.'.$fetchebusiness['price_per_hour'].'/-</li>
                                                               
                                                               
                                                            </ul>
                                                        </div>
                                                        <div class="button">
                                                            <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  </div>        
                                        ';
                                            $xj++;
                                        }
                                
                                ?>
                                      
                              
                                        
                                        
                                        

                                    </div>
                                    <!-- /Sub tabs content -->

                                </div>
                            </div>
                        </div>

                    </div>
                    <!--tab3-->
                
<div class="tab-pane fade" id="tab-x3">

                        <div class="car-big-card">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="tabs awesome-sub">
                                    <ul id="tabs-x3" class="nav">
                                    <?php
                                                        $xyi=1;
                                                        if(!empty($premiumcars))
                                                        {
                                                          foreach($premiumcars as $premiumca)
                                                         {
                                                                if($xyi<2)
                                                                {
                                                                 $activet='active';
                                                                }
                                                                else{
                                                                     $activet='';
                                                                }
                                                                echo '<li class="'.$activet.'"><a href="#tab-x3x'.$xyi.'" data-toggle="tab">'.$premiumca['models_name'].'</a></li>';
                                                            
                                                        
                                                        
                                                               $xyi++;
                                                         } 
                                                        }
                                                        else
                                                        {
                                                            echo 'Vehicles are not available';
                                                        } 
                                            ?>
                                    
                                    </ul>
                                       
                                    </div>
                                </div>
                                <div class="col-md-9">

                                    <!-- Sub tabs content -->
                                    <div class="tab-content">

                                    
                                    
                                                <?php
                                 $xjj=1;
                                 foreach($premiumcars as $premiumc)
                                                         {
                                                     if($xjj<2)
                                                     {
                                                        $activenn='active in';
                                                        
                                                     }
                                                     else{
                                                         $activenn='';
                                                     }
                                    echo '<div class="tab-pane fade '.$activenn.'" id="tab-x3x'.$xjj.'">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <!-- Swiper -->
                                                    <div class="swiper-container" id="swiperSliderx1">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="http://www.metrepersecond.com/MPS'.$premiumc['img_path'].'" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="http://www.metrepersecond.com/MPS'.$premiumc['img_path'].'" data-gal="prettyPhoto"><img class="img-responsive" src="http://www.metrepersecond.com/MPS'.$premiumc['img_path'].'" alt=""/></a>
                                                            </div>
                                                            
                                                        </div>
                                                        <!-- Add Pagination -->
                                                        <div class="row car-thumbnails"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="car-details">
                                                       
                                                        <div class="list">
                                                            <ul>
                                                                
                                                                <li>Total KM :'.$premiumc['total_kms'].'KM</li>
                                                                <li>Price : Rs.'.$premiumc['price'].'/-</li>
                                                                <li>Price per hour : Rs.'.$premiumc['price_per_hour'].'/-</li>
                                                               
                                                               
                                                            </ul>
                                                        </div>
                                                        <div class="button">
                                                            <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  </div>        
                                        ';
                                            $xjj++;
                                        }
                                
                                ?>
                                      
                              
                                        
                                        
                                        

                                    </div>
                                    <!-- /Sub tabs content -->

                                </div>
                            </div>
                        </div>

                    </div>
                    
                    <!--tab4-->
                    <div class="tab-pane fade" id="tab-x4">

                        <div class="car-big-card">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="tabs awesome-sub">
                                    <ul id="tabs-x4" class="nav">
                                    <?php
                                                        $xyyi=1;
                                                        if(!empty($fetchluxury))
                                                        {
                                                          foreach($fetchluxury as $fetchl)
                                                         {
                                                                if($xyyi<2)
                                                                {
                                                                 $activet='active';
                                                                }
                                                                else{
                                                                     $activet='';
                                                                }
                                                                echo '<li class="'.$activet.'"><a href="#tab-x4x'.$xyyi.'" data-toggle="tab">'.$fetchl['models_name'].'</a></li>';
                                                            
                                                        
                                                        
                                                               $xyyi++;
                                                         } 
                                                        }
                                                        else
                                                        {
                                                            echo 'Vehicles are not available';
                                                        } 
                                            ?>
                                    
                                    </ul>
                                       
                                    </div>
                                </div>
                                <div class="col-md-9">

                                    <!-- Sub tabs content -->
                                    <div class="tab-content">

                                    
                                    
                                                <?php
                                 $xjjj=1;
                                 foreach($fetchluxury as $fetchlux)
                                                         {
                                                     if($xjjj<2)
                                                     {
                                                        $activenn='active in';
                                                        
                                                     }
                                                     else{
                                                         $activenn='';
                                                     }
                                    echo '<div class="tab-pane fade '.$activenn.'" id="tab-x4x'.$xjjj.'">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <!-- Swiper -->
                                                    <div class="swiper-container" id="swiperSliderx1">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <a class="btn btn-zoom" href="http://www.metrepersecond.com/MPS'.$fetchlux['img_path'].'" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                <a href="http://www.metrepersecond.com/MPS'.$fetchlux['img_path'].'" data-gal="prettyPhoto"><img class="img-responsive" src="http://www.metrepersecond.com/MPS'.$fetchlux['img_path'].'" alt=""/></a>
                                                            </div>
                                                            
                                                        </div>
                                                        <!-- Add Pagination -->
                                                        <div class="row car-thumbnails"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="car-details">
                                                       
                                                        <div class="list">
                                                            <ul>
                                                                
                                                                <li>Total KM :'.$premiumc['total_kms'].'KM</li>
                                                                <li>Price : Rs.'.$premiumc['price'].'/-</li>
                                                                <li>Price per hour : Rs.'.$premiumc['price_per_hour'].'/-</li>
                                                               
                                                               
                                                            </ul>
                                                        </div>
                                                        <div class="button">
                                                            <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  </div>        
                                        ';
                                            $xjjj++;
                                        }
                                
                                ?>
                                      
                              
                                        
                                        
                                        

                                    </div>
                                    <!-- /Sub tabs content -->

                                </div>
                            </div>
                        </div>

                    </div>
                    <!--end-->
                    </div>
                    <!--end-->
                        </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>
        <!-- /PAGE -->
        
        <!-- FIND MECHANICS PAGE -->
        <section class="page-section find-car dark">
            <div class="container">
                <form class="form-find-car">
                    <div class="row">
                        <div class="col-md-3 wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
                            <h2 class="section-title text-left no-margin">
                                <small>Find Your</small>
                                <span>Mechanic</span>
                            </h2>                   
                        </div>
                        <div class="col-md-7 wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
                            <div class="form-group has-icon has-label">
                                <input type="text" class="form-control locbook geocomplete" name="adrsvalue" id="pic_input" placeholder="Pull Location">
                                <!--<span class="form-control-icon"><i class="fa fa-location-arrow"></i></span>-->
                                <input type="hidden"  id="location" name="location" value="" />
                            </div>
                        </div>
                        <div class="col-md-2 wow fadeInDown" data-wow-offset="200" data-wow-delay="500ms">
                            <div class="form-group">
                                <button type="button" id="b" class="btn btn-block ripple-effect btn-theme">FIND</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- FIND MECHANICS PAGE /PAGE -->

        <!-- PAGE -->
        <section class="page-section no-padding no-bottom-space-off">
            <div class="container full-width">
                <!-- Google map -->

               <div class="google-map" id="ex">
              <!--  <input type="hidden" id="t" value="17.385044">
               <input type="hidden" id="l" value="78.486671"> -->
                    <div id="mapmachho"></div> 
                </div>
				<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/jquery.geocomplete.js"></script>
    <script>
                $(document).ready(function()
{
     $(".geocomplete").geocomplete({
        
          details: "form",
          types: ["geocode", "establishment"],
        });
    
    $('body').on('change',function() {
    var s=$('#location').val();
    var res=s.split(',');
    
    
      if(s){
          
       $('#b').click(function() {
        
$.post('index.php/MPSVEHICLES_DETAILS/Maps',{
                                
                            },
                            function(data)
                            { 
                               
                           // alert(data);
                            var locations=JSON.parse(data);

    //console.log(locations);
    /* var locations = [
      ['dfsd', '17.4138277', '78.43975840000007']]; */
    //alert(locations[0][1]);
    var a=$('#location').val();
    var res1=a.split(',');
    
    var l=$('#us3-lat').val();
    var t=$('#us3-lon').val();
    
if(locations){

    var map = new google.maps.Map(document.getElementById('mapmachho'), {
      zoom: 12,
	   scaleControl: false,
  scrollwheel: false,
      center: new google.maps.LatLng(res1[0],res1[1]),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
	   mapTypeControl: false,
	     styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]
 
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) { 
   // alert(locations[i][1]);
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon: 'http://www.metrepersecond.com/bookaservice/assets/img/map-marker.png'
      });

      google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
        return function() {
          infowindow.setContent('<div class="map_details"><h3>'+locations[i][4]+'</h3><strong>&#x20B9;'+locations[i][3]+'</strong><a href="index.php/HireMechanic/hireMechanicDetails/'+locations[i][5]+'" class="btn btn-block btn-submit btn-theme">Hire</a></div>');
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
}
});
       });
      }else
      {
          
          $.post('index.php/MPSVEHICLES_DETAILS/Maps',{
                                
                            },
                            function(data)
                            { 
                               
                            
                            var locations=JSON.parse(data);

    //console.log(locations);
    /* var locations = [
      ['dfsd', '17.4138277', '78.43975840000007']]; */
    //alert(locations[0][1]);
    var l=$('#us3-lat').val();
    var t=$('#us3-lon').val();
        
          if(locations){

    var map = new google.maps.Map(document.getElementById('mapmachho'), {
      zoom: 12,
	   scaleControl: false,
		scrollwheel: false,
      center: new google.maps.LatLng(l,t),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
	   mapTypeControl: false,
      styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) { 
   // alert(locations[i][1]);
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon: 'http://www.metrepersecond.com/bookaservice/assets/img/map-marker.png'
      });

      google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
        return function() {
		
          infowindow.setContent('<div class="map_details"><h3>'+locations[i][4]+'</h3><strong>&#x20B9;'+locations[i][3]+'</strong><a href="index.php/HireMechanic/hireMechanicDetails/'+locations[i][5]+'" class="btn btn-block btn-submit btn-theme">Hire</a></div>');
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
}
      
    

     });
}
});
        
            
});
  </script>
                <!-- /Google map -->

            </div>
        </section>
        <!-- /PAGE -->

        <!-- TESTMONIALS PAGE -->
        <section class="page-section testimonials">
            <div class="container wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
                <div class="testimonials-carousel">
                    <div class="owl-carousel" id="testimonials">
                        <div class="testimonial">
                            <div class="media">
                                <div class="pull-left">
                                    <a href="#">
                                        <img class="media-object testimonial-avatar" src="<?php echo Yii::app()->baseUrl; ?>/images/profile_default.png" alt="Testimonial avatar">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <div class="testimonial-text">I was lacking time to get my vehicle serviced but when I came across the application I was delighted in learning that one can get serviced multiple brands from a single application without roaming around service centers.</div>
                                    <div class="testimonial-name">Praveen Kumar <!-- <span class="testimonial-position">Founder at MPS</span> --></div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial">
                            <div class="media">
                                <div class="pull-left">
                                    <a href="#">
                                        <img class="media-object testimonial-avatar" src="<?php echo Yii::app()->baseUrl; ?>/images/profile_default.png" alt="Testimonial avatar">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <div class="testimonial-text">Hired a car through Metre per second and had the privilege of driving it on my own. Fabulous cars and fabulous services.</div>
                                    <div class="testimonial-name">Venkat <!-- <span class="testimonial-position">Co- founder at MPS</span> --></div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="testimonial">
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object testimonial-avatar" src="assets/img/preview/avatars/testimonial-140x140x1.jpg" alt="Testimonial avatar">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <div class="testimonial-text">Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</div>
                                    <div class="testimonial-name">Venkat <span class="testimonial-position">Customer</span></div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </section>
        <!-- TESTMONIALS /PAGE -->

        <!-- FAQ'S PAGE -->
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
                                            <span class="dot"></span>Knowing more about Car Battery Drain 
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
                                    <div class="panel-body">
                                      Batteries often go dead and the reasons could be many. There could be electrical problems in your car that is draining your battery or other problems     </div>
                                </div>
                            </div>
                            <!-- /faq1 -->
                            <!-- faq2 -->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading2">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                            <span class="dot"></span> How Long Does a Power Brake Booster Last? 
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
                                    <div class="panel-body">
                                      When you press the brake pedal, your car slows down and eventually stops. Most of us put little more thought into it. We know that our brake pads      </div>
                                </div>
                            </div>
                            <!-- /faq2 -->
                            <!-- faq3 -->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading3">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                            <span class="dot"></span> Door Latch and the signs of it giving up.
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3">
                                    <div class="panel-body">
                                       A door latch is located on every door on your vehicle. It is what keeps the doors shut while you are driving down the road. Each door has two     </div>
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
                                            <span class="dot"></span>Wheel Alignment And The Aspects Involved 
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse21" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading21">
                                    <div class="panel-body">
                                       When your car drifts or pulls in one direction and the steering wheel does not center align when  driving straight down the road. Its time to align your wheels.  </div>
                                </div>
                            </div>
                            <!-- /faq1 -->
                            <!-- faq2 -->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading22">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion2" href="#collapse22" aria-expanded="true" aria-controls="collapse22">
                                            <span class="dot"></span>Assessing the shape of the tires. 
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse22" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading22">
                                    <div class="panel-body">
                                        Tires only have a certain period of life. A vehicle must have tires fit for normal driving conditions. </div>
                                </div>
                            </div>
                            <!-- /faq2 -->
                            <!-- faq3 -->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading23">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse23" aria-expanded="false" aria-controls="collapse23">
                                            <span class="dot"></span>Tire Rotation and How. 
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse23" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading23">
                                    <div class="panel-body">
                                       Refer to your owner's manual for the exact tire rotation schedule for your car. The general recommendation is that tires be rotated every 5,000 to 8,000 miles, and this often coincides with oil changes. Consider exploring an in depth article about how often you should rotate your tires for more information.</div>
                                </div>
                            </div>
                            <!-- /faq3 -->
                        </div>
                        <!-- /FAQ -->
                    </div>
                </div>
                <div class="outer required col-md-3 col-md-offset-5">
                    <div class="form-group af-inner">
                        <a href="http://www.metrepersecond.com/bookaservice/index.php/VehicleGuide" class="form-button form-button-submit btn btn-block btn-theme ripple-effect btn-theme-dark">More</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- FAQ'S /PAGE -->
        <!-- Change location map model popup -->
        <div id="us6-dialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Change Your Current Location</h4>
                </div>

                <div class="modal-body">
                    <div class="form-horizontal" style="width: 550px">
                        <div class="form-group">                                
                            <label class="col-sm-2 control-label">Location:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="us3-address" />
                            </div>
                        </div>
                        <div id="us3" style="width: 100%; height: 400px;"></div>                        
                        <div class="clearfix">&nbsp;</div>
                        <div class="m-t-small">
                            <!-- <label class="p-r-small col-sm-1 control-label">Lat.:</label> -->
                            <div class="col-sm-3">
                                <input type="hidden" class="form-control" style="width: 110px" id="us3-lat" value="17.4405022" />
                            </div>
                            <!-- <label class="p-r-small col-sm-2 control-label">Long.:</label> -->
                            <div class="col-sm-3">
                                <input type="hidden" class="form-control" style="width: 110px" id="us3-lon" value="78.4001641" />
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <script>
				   function mark_active_menu(){
                            $('#us3').locationpicker({
                    
                    
                        
                                location: {
                                    latitude: $('#l').val(),
                                    longitude: $('#t').val()
                                },
                                radius: 2,
                                inputBinding: {
                                    latitudeInput: $('#us3-lat'),
                                    longitudeInput: $('#us3-lon'),
                                    radiusInput: $('#us3-radius'),
                                    locationNameInput: $('#us3-address')
                                },
                                enableAutocomplete: true,
                                markerIcon: 'http://www.metrepersecond.com/bookaservice/assets/img/map-marker.png'
                            });
                            $('#us6-dialog').on('shown.bs.modal', function () {
                        
                                $('#us3').locationpicker('autosize');
                    
                            });
                            }
                            function mark_active_menu1(){
                            $('#us3').locationpicker({
                    
                    
                        
                                location: {
                                    latitude: 17.485267,
                                    longitude: 78.65892
                                },
                                radius: 2,
                                inputBinding: {
                                    latitudeInput: $('#us3-lat'),
                                    longitudeInput: $('#us3-lon'),
                                    radiusInput: $('#us3-radius'),
                                    locationNameInput: $('#us3-address')
                                },
                                enableAutocomplete: true,
                                markerIcon: 'http://www.metrepersecond.com/bookaservice/assets/img/map-marker.png'
                            });
                            $('#us6-dialog').on('shown.bs.modal', function () {
                        
                                $('#us3').locationpicker('autosize');
                    
                            });
                            }
                            $('#us3-address').on('change', function() {
                                var getloc=$('#us3-address').val();
                                $("#bookloc").val(getloc);
                                $("#pic_input").val(getloc);
                            });
                        </script>
                       
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        </div>
        
        
        
        
        <!-- /. End Change location map model popup -->

<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/owl-carousel2/owl.carousel.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/swiper/js/swiper.jquery.min.js"></script>

<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/dist/locationpicker.jquery.min.js"></script>
<script>
$(document).ready(function() {
                var startPos;
   var geoOptions = {
    enableHighAccuracy: false

  } 
var i=0;
$("#r").on('click',function(){
if(i==0)
{
	mark_active_menu1();
}
});
  var geoSuccess = function(position) {
    startPos = position;

    var la=startPos.coords.latitude;    
    var lo=startPos.coords.longitude;
    document.getElementsByClassName("locationone")[0].setAttribute("value",la); 
    document.getElementsByClassName("locationone")[1].setAttribute("value",lo); 
	i=1;
  mark_active_menu();

  
  
  };

   var geoError = function(error) {
    console.log('Error occurred. Error code: ' + error.code);
    // error.code can be:
    //   0: unknown error
    //   1: permission denied
    //   2: position unavailable (error response from location provider)
    //   3: timed out
    
  }; 

navigator.geolocation.getCurrentPosition(geoSuccess, geoError);
});
</script>



<script>
      $(function(){
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


    $('#mobilepresent').carousel({
      interval: 3000,
      cycle: true
    });
        
    });
 

</script>

 <!-- 
   <script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -33.8688, lng: 151.2195},
          zoom: 13
        });
        
        
        
          if (navigator.geolocation) {
             
          navigator.geolocation.getCurrentPosition(function(position) {
              // alert(position.coords);
                $('#txtLatitude').val(position.coords.latitude);
                $('#txtLongitude').val(position.coords.longitude);
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            
            //getting address based on longitude and latitude
            var lat = parseFloat(document.getElementById("txtLatitude").value);
            var lng = parseFloat(document.getElementById("txtLongitude").value);
            var latlng = new google.maps.LatLng(lat, lng);
            var geocoder = geocoder = new google.maps.Geocoder();
            geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[1]) {
                        //alert("Location: " + results[1].formatted_address);
                        $('#bookloc').val(results[1].formatted_address);
                        $('.hireloc').val(results[1].formatted_address);
                        $('.locbook').val(results[1].formatted_address);
                        $('#adrs').val(results[1].formatted_address);
                        
                        
                        
                    }
                    else{
                        
                    }
                }
            }); 
            //-----------------------------
            //alert(position.coords.latitude);
            var marker = new google.maps.Marker({
                position: pos,
                title:"Hello World!"
            });
            marker.setMap(map);
            map.setCenter(pos);
            
          }, function() {
            //handleLocationError(true, infoWindow, map.getCenter());
          });
        }
        var input = /** @type {!HTMLInputElement} */(
            document.getElementById('pac-input'));

        var types = document.getElementById('type-selector');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
        

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
            
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
         
          if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setIcon(/** @type {google.maps.Icon} */({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
          }));
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

          infowindow.setContent('<div align="left"><strong>'+ place.name + '</strong><br>' + address+'<br/><br/><br/><br/>'+'<a href="index.php/mPSVEHICLES_DETAILS/Hiremechanicdetails" class="btn btn-block btn-submit ripple-effect btn-theme">Hire Mechanic</a>');
          infowindow.open(map, marker);
        });

        
    
    
     
      google.maps.event.addListener(marker, 'click', function() {
            
      //$.post('ajax/fetchstationdetails.php',{gas_station_id:gas_station_id},function(data){
      var place = autocomplete.getPlace();
          if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setIcon(/** @type {google.maps.Icon} */({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
          }));
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }
      infowindow.setContent('<div><a href="index.php/mPSVEHICLES_DETAILS/Hiremechanicdetails">Hire it<strong>'+ place.name + '</strong><br>' + address);
          infowindow.open(map, marker);
                
              //  });  
    
        
      });
    
        
        
        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
          var radioButton = document.getElementById(id);
          radioButton.addEventListener('click', function() {
            autocomplete.setTypes(types);
          });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);
      }
    </script>
     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvY-U7jBqVaWpSTf4YZ65J2XAii2-ax58&libraries=places&callback=initMap"
        async defer></script>   -->

    
    <!--<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>-->


    
    
>>>>>>> .r480
    