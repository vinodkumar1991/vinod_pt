<?php


//print_r($SelfImages);
//die();
//print_r($SelfImages['images'][21][0]['image_name']);
//print_r($SelfImages[0]['image_name']);

?>

<link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min.js"></script>
<!--Google Address :: START-->
<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/jquery.geocomplete.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/dist/locationpicker.jquery.min.js"></script>
<!--Google Address :: END-->
<input type="hidden" value="<?php if(isset($range[0]['min'])) { echo $range[0]['min']; }else {?>0 <?php } ?>" id="min">


<input type="hidden" value="<?php if(isset($range[0]['max'])) { echo $range[0]['max']; }else {?>0 <?php } ?>" id="max">

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
       // alert(count);
        
        console.log(selector, count, items);
        //return false;
        if (count>0) {
           // alert(count);
            items.hide().filter(selector).show();
        } else {
            items.show();
        }
    });

});

$( document ).ready(function() {
	
	
	$('#bookloc').keyup(function () {
         $('.booklocation').val($(this).val());
       });
	
        
         /* $('.veh_feature').click(function()
            {
                intVehicleFeaturesid = $(this).attr('id');
                strFromDate = $('#Start-trip').val();
                strToDate = $('#End-trip').val();
                strLocation = $('#location').val();
                //alert(intVehicleFeaturesid);
                location.href='<?php //echo Yii::app()->params['webURL']?>'+'/Self/SelfDrive/SelfDrive?id='+intVehicleFeaturesid+"&fromDate="+''+strFromDate+''+'&toDate='+''+strToDate+'&location='+strLocation;
            });*/
       
         $('.vehcls').click(function()
        {
            intVehicleClassesid = $(this).attr('id');
            strFromDate = $('#Start-trip').val();
            strToDate = $('#End-trip').val();
            strLocation = $('#location').val();
            //alert(intVehicleClassesid);
            location.href='<?php echo Yii::app()->params['webURL']?>'+'/Self/SelfDrive/SelfDrive?id='+intVehicleClassesid+"&fromDate="+''+strFromDate+''+'&toDate='+''+strToDate+'&location='+strLocation;
            return false;
           
            //location.href="<?php //echo Yii::app()->params['webURL'] . '/Self/SelfDrive/SelfDrive?id=';?>"+intVehicleClassesid;
            
        });

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

    
     $("#Start-trip").datetimepicker({
        format: 'dd-mm-yyyy hh:ii', 
        autoclose: 1,
        todayHighlight: 1,
		minuteStep: 30, onSelect: function(date) {
    $("#End-trip").datepicker('option', 'minDate', date);
  },
		startDate: new Date()
		
		
		
    });
	    $("#Start-trip").change(function() {
		$("#End-trip").datetimepicker({
        format: 'dd-mm-yyyy hh:ii', 
        autoclose: 1,
        todayHighlight: 1,
		minuteStep: 30,
		startDate: new Date()
		
		
		
    }).focus();
});
    
$("#End-trip").datetimepicker({
        format: 'dd-mm-yyyy hh:ii', 
        autoclose: 1,
        todayHighlight: 1,
		minuteStep: 30,
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
                <form action="<?php echo Yii::app()->params['webURL'].'Self/SelfDrive/SelfDriveSearch'; ?>" method="POST" class="form-find-car">
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
								$date->modify("+4 hours");
								$moment=strtotime($date->format('d-m-Y H:i'));
				$rounded_seconds = round($moment / (30 * 60)) * (30 * 60);
				
								if(isset($fromdates))
								{
									echo $fromdates;
								}
								else
								 {
									  echo date('d-m-Y H:i',$rounded_seconds); 
								  }
                                                                  
                                                                  
                                                                  ?>">						
                                <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>

                        <div class="col-md-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="300ms">
                            <div class="form-group has-icon has-label" data-date-format="mm-dd-yyyy HH:ii p" data-link-field="dtp_input1">
                                <label>End Trip</label>
                                <input type="text" class="input-group date form_datetime form-control" name="to_date" id="End-trip" value="<?php $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
							$date->modify('+28 hours');
							$moment=strtotime($date->format('d-m-Y H:i'));
				$rounded_seconds = round($moment / (30 * 60)) * (30 * 60);
				
								if(isset($todates))
								{
									echo $todates;
								}else
								{ echo date('d-m-Y H:i',$rounded_seconds); } ?>">
                                <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                        </div>

                        </div>
                        <div class="col-md-6">
                        <div class="form-group has-icon has-label">
                            <label>Change Location</label>
                            <input type="text" class="form-control geocomplete" id="bookloc" name="bookloc" value="" placeholder="Current Location" required>
                            <input type="hidden" name="location" id="location">
                            <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                        </div>
                        </div>

                        <div class="col-md-6 doorstp">
                            <div class="form-group">
                            	<label class="doorstepcheck"><input type="checkbox" name="doorstep" value="door" checked="checked"> Door Step Delivery</label>
								
                            </div>
                        </div>
                    </div>
					
                    <div class="col-md-2 wow fadeInDown" data-wow-offset="200" data-wow-delay="500ms">
                        <div class="form-group">
                            <button type="submit" id="formFindCarSubmit" onclick="return validation();" name="search" value="search" class="btn btn-block btn-submit ripple-effect btn-theme slf-search">Search</button>
                        </div>
                    </div>

                    </div>

                </form>



            </div>

        </section>

        <!-- /PAGE -->

<?php
                                                            if(isset($fromdates))
								{
									
									$moment=strtotime($fromdates);
									$rounded_seconds = round($moment / (60 * 60)) * (60 * 60);
									// date functionality									
									$moment1=strtotime($todates);
									$rounded_seconds1 = round($moment1 / (60 * 60)) * (60 * 60);

									$diff=$moment1-$moment;
									$days = $diff / 86400;
									$day_explode = explode(".", $days);
									$days = $day_explode[0];

									$hours = '.'.$day_explode[1].'';
									$hour = $hours * 24;
									$hourr = explode(".", $hour);
									$hours =$hourr[0];

									$minute = '.'.$hourr[1].'';
									$minutes = $minute * 60;
									$minute = explode(".", $minutes);
									if($minute[0]==0)
									{
									$min =0;
									}
									else
									{
									$min =30;
									}
										$hours1 = floor(($diff)/(60 * 60));
										$totalhrs=$hours1;
									
									
								}
								else
								{
									$date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
									$date->modify("+4 hours");
									$moment=strtotime($date->format('d-m-Y H:i'));
									$rounded_seconds = round($moment / (60 * 60)) * (60 * 60);
									// date functionality
									$date1 = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
									$date1->modify('+28 hours');
									$moment1=strtotime($date1->format('d-m-Y H:i'));
									$rounded_seconds1 = round($moment1 / (60 * 60)) * (60 * 60);

									$diff=$rounded_seconds1-$rounded_seconds;

									$days = floor($diff/86400);
									$hours = floor(($diff-$days*86400)/(60 * 60));
									$min = floor(($diff-($days*86400+$hours*3600))/60);		
									$hours1 = floor(($diff)/(60 * 60));
										$totalhrs=$hours1;
										
								}
				
							?>

        <!-- PAGE WITH SIDEBAR -->

        <section class="page-section with-sidebar sub-page">

            <div class="container">

                <div class="row">

                    <!-- CONTENT -->

                    <div class="col-md-9 content car-listing" id="selfdrive_filter">



                        <!-- Car Listing -->

						<?php if(!empty($VehicleDetails)){ ?>
                                            
		                <?php 
                                    $j = 0;
                                foreach($VehicleDetails as $details) 
								{
					$totamount=$totalhrs*$details['priceperhr'];
									
							$feature=explode(',',$FeatureDetails[$j][0]['Features']); 
						?>
                        <div class="portfolio-item<?php $k=0; while($k<sizeof($feature)-1){ echo $feature[$k]." "; $k++; } ?><?php echo $FeatureDetails[$j][0]['Features']; ?>  <?php 

						if($totamount<=500)

						{

							echo "p1"." ";

						}else if($totamount<=1000)

						{

							echo "p2"." ";

						}else if($totamount<=1500)

						{

							echo "p3"." ";

						}else if($totamount<=2000)

						{

							echo "p4"." ";

						}else

						{

							echo "p5"." ";

						}

						 ?>system game thumbnail no-border no-padding thumbnail-car-card clearfix">

						
                        <div class="media col-md-4">
                            <a class="media-link" data-gal="prettyPhoto" href="http://localhost/beena/mps/MPS/images/uploadimages/selfdrive/cars/web/450X260/<?php echo $details['image_name'];?>">
                                <img src="http://localhost/beena/mps/MPS/images/uploadimages/selfdrive/cars/web/450X260/<?php echo $details['image_name'];?>" alt="" width="100" />
                                <span class="icon-view"><strong><i class="fa fa-eye"></i></strong></span>
                            </a>
                            <div class="col-md-12 text-center"><h4 class="caption-title"><a href="#"><?php echo $details['BrandName'];?> <?php echo $details['ModelName'];?></a></h4>
                            </div>
                            <div class="col-md-12">                            
                            <h5 class="caption-title-sub">Price Per Hour <?php echo $details['priceperhr'];?>
                            	<span class="pull-right"><?php echo $details['seating'];?> Seats</span>
                            </h5>
                            <div class="rating text-center">
                                    <span class="star"></span>
                                    <span class="star active"></span>
                                    <span class="star active"></span>
                                    <span class="star active"></span>
                                    <span class="star active"></span>
                                </div>
                            </div>
                        </div>
	<form action="<?php echo Yii::app()->params['webURL'].'Self/SelfDrive/SelfDriveOrder?id='.$details['id']; ?>" method="POST">
            <input type="hidden" name="booklocation" id="booklocation" class="booklocation"/>
            <div class="col-md-8">
                   <table class="table">
                        <tr>
                                <td> <?php echo $days; ?> Days, <?php echo $hours; ?> Hours, <?php echo $min; ?> Minutes </td>
                                <td><?php echo $totalhrs*5;  ?> Free Kms</td>
			</tr>

                        <tr>
                            <td>From </td>
                            <td><?php $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
								$date->modify("+4 hours");
								$moment=strtotime($date->format('d-m-Y H:i'));
								$rounded_seconds = round($moment / (60 * 60)) * (60 * 60);
				
								if(isset($fromdates))
								{
									echo $fromdates;
								}
								else
								 {
									  echo date('d-m-Y H:i',$rounded_seconds); 
								 } ?></td>
                        </tr>

                                <tr>
                                	<td>To</td>
                                	<td><?php 
				
								if(isset($todates))
								{
									echo $todates;
								}else
								{ echo date('d-m-Y H:i',$rounded_seconds1); } ?></td>
                                </tr>
                                <tr>
                                    <td>Security Deposit </td>
                                    <td>Rs.<?php echo $details['deposit'];?></td>
                                </tr>
                                <tr>
                                    <td>Excess Kms</td>
                                    <td><?php echo $details['kmperhr'];?>rs/ per Kms</td>
                                </tr>
								<tr>
                                    <td>Vehicle Featues</td>
                                    <td><?php //$h=0;  while($h<sizeof($feature)-1){ 
	
                                        echo $FeatureDetails[$j][0]['Features'];
                                        //echo $feature[$h];
                                         
                                       //  $h++; 
       
      
                                       //}
                                        ?>
                                    </td>
                                    
                                </tr>

                            </table>                            
        <div class="buttons pull-right">
	    <div class="est-amount" style="float: left; margin: 0px 20px;">
	        <strong><input class="price" type="hidden" id="pricedata" value="<?php echo $details['priceperhr'];?>"/>
			<!--<i class="fa fa-inr"></i>--> <?php //echo $totalhrs*$details['priceperhr']; ?>
				<input type="hidden" name="totalprice" value="<?php echo $totalhrs*$details['priceperhr']; ?>" /></strong>
	                            </div>
				<input type="hidden" name="fromdate" value="<?php if(isset($fromdates)) { echo $fromdates; }else {  echo date('d-m-Y H:i',$rounded_seconds);  } ?>" />
                              
				<input type="hidden" name="todate" value="<?php if(isset($todates)) { echo $todates; }else { echo date('d-m-Y H:i',$rounded_seconds1); } ?>" />                            
				
				<input type="submit" name="SelfOrder" class = "btn btn-theme" id="SelfOrder" value="Book now" />
				
                                <input type="hidden" name="location" id="location"/>
                               
				<!--<a class = "btn btn-theme pull-right"  id="btn2">Book Now</a>-->
							
							  <!-- <a class = "btn btn-theme pull-right" id="btnsub1" data-toggle = "modal" data-target = "#signup-model">Book Now</a>-->
							
			    </div>

            </div>
    </form>
</div>
                <?php $j++;
                        } 
                }else
                {

							echo "No vehicles Available in this Time";

		}

		?>

                        <!-- /Car Listing -->

                    <?php 

                   

                     ?>

                      



                    </div>

                    <!-- /CONTENT -->



                    <!-- SIDEBAR -->
                    <aside class="col-md-3 sidebar selfaside" id="sidebar">
                    <!-- /widget -->
						<div class="widget shadow widget-filter-price">
    						<h4 class="widget-title">Category</h4>
                            <div class="widget-content category">
                                 <?php
                               foreach($selfVehicleDetails as  $vehicleClasses)
                               {
                                   ?>
                                 <a href="" id="<?php echo $vehicleClasses['id']; ?>" class="list-group-item vehcls"><?php echo $vehicleClasses['name']; ?> </a>     
                                <?php
                               }
                               
                               ?>
                            </div>
                        </div>
<!--                     widget Features filter 
				    <article id="filters">
    				 <div class="widget shadow widget-filter-price">
    				    <h4 class="widget-title">Features</h4>
                            <div id="category" class="widget-content category">
                                
                                <?php
                               // foreach($selfVehicleFeatures as $selfVehicleFeature)
                                //{
                                    ?>
                                <div class="checkbox list-group-item">
                                    <label><input type="checkbox"  name="cat<?php //echo $selfVehicleFeature['id'];?>"value="<?php //echo $selfVehicleFeature['name'];?>" id="<?php //echo $selfVehicleFeature['id'];?>" class="veh_feature"/>
                                    <?php //echo $selfVehicleFeature['name'];?></label>
                                </div>
                                <?php
                                //}
                                ?>
                                
								
                            </div>
                    </div>
                     /widget Features filter -->

                    <!-- widget price filter -->
<!--                    <div class="widget shadow widget-filter-price">
                        <h4 class="widget-title">Price Filter</h4>
                            <div id="price" class="widget-content category">
                                <div class="checkbox list-group-item">
                                    <label><input type="checkbox" name="price" value="p1" id="type-p1" />100 to 500 rs</label>
                                </div>
                                <div class="checkbox list-group-item">
                                    <label><input type="checkbox" name="price" value="p2" id="type-p2" />500 to 1000 rs</label>
                                </div>
                                <div class="checkbox list-group-item">
                                    <label><input type="checkbox" name="price" value="p3" id="type-p3" />1000to 1500 rs</label>
                                </div>
                                <div class="checkbox list-group-item">
                                    <label><input type="checkbox" name="price" value="p4" id="type-p4" />1500 to 2000rs</label>
                                </div>
                                <div class="checkbox list-group-item">
                                    <label><input type="checkbox" name="price" value="p5" id="type-p5" />2000 +</label>
                                </div>
                            </div>
    	            </div>-->
                    <!-- /widget price filter -->
                    </article>
                    <!-- /widget -->

                    <!-- widget helping center -->

                        <div class="widget shadow widget-helping-center">
                            <h4 class="widget-title">HELP &amp; SUPPORT</h4>
                            <div class="widget-content">
                                <p>Call us for all your car and bike needs.</p>
                                <h5 class="widget-title-sub">+91 801 944 80 35</h5>
                                <p><a href="mailto:support@metrepersecond.com">support@metrepersecond.com</a></p>
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
