
<?php //if(isset($vehicle_details)) var_dump ($vehicle_details); ?>
<link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">

<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/jquery.geocomplete.js"></script>

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
        
        console.log(selector, count, items);
        if (count>0) {
            items.hide().filter(selector).show();
        } else {
            items.show();
        }
    });

});

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
                <form action="<?php echo $this->createUrl('Selfdrive/SelfdrivedetailsSearch'); ?>"" method="POST" class="form-find-car">
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
								  } ?>">						
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
                            <input type="text" class="form-control geocomplete" id="bookloc" name="bookloc1" value="<?php if(isset($bookloc)){ echo $bookloc; }else { echo Yii::app()->session['book-loc']; }?>" placeholder="Current Location">
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

						<?php if(!empty($vehicle_details)){ ?>

		                <?php foreach($vehicle_details as $details) 
								{
									$totamount=$totalhrs*$details['price_per_hour'];
									
							 $feature=explode(',',$details['vehicle_features']); 
						?>
                        <div class="portfolio-item <?php $j=0; while($j<sizeof($feature)-1){ echo $feature[$j]." "; $j++; } ?><?php 

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
                            <a class="media-link" data-gal="prettyPhoto" href="http://www.metrepersecond.com/MPS<?php echo $details['img_path'];?>">
                                <img src="http://www.metrepersecond.com/MPS<?php echo $details['img_path'];?>" alt="" width="100" />
                                <span class="icon-view"><strong><i class="fa fa-eye"></i></strong></span>
                            </a>
                            <div class="col-md-12 text-center"><h4 class="caption-title"><a href="#"><?php echo $details['makename'];?> <?php echo $details['modelname'];?></a></h4>
                            </div>
                            <div class="col-md-12">                            
                            <h5 class="caption-title-sub">Price Per Hour <?php echo $details['price_per_hour'];?>
                            	<span class="pull-right"><?php echo $details['seating_capacity'];?> Seats</span>
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
	<form action="<?php echo $this->createUrl('Selfdrive/selfdrivebook/',array('id'=>$details['ID'])); ?>" method="POST">
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
                                    <td>Rs.<?php echo $details['security_deposit'];?></td>
                                </tr>
                                <tr>
                                    <td>Excess Kms</td>
                                    <td><?php echo $details['extra_rate_per_kms'];?>rs/ per Kms</td>
                                </tr>
								<tr>
                                    <td>Vehicle Featues</td>
                                    <td><?php  $j=0; while($j<sizeof($feature)-1){ 
										echo $feature[$j].", "; $j++; } ?></td>
                                </tr>

                            </table>                            
                            <div class="buttons pull-right">
	                            <div class="est-amount" style="float: left; margin: 0px 20px;">
	                            	<strong><input class="price" type="hidden" id="pricedata" value="<?php echo $details['price'];?>"/>
									<i class="fa fa-inr"></i> <?php echo $totalhrs*$details['price_per_hour']; ?>
									<input type="hidden" name="totalprice" value="<?php echo $totalhrs*$details['price_per_hour']; ?>" /></strong>
	                            </div>
								<input type="hidden" name="fromdate" value="<?php if(isset($fromdates)) { echo $fromdates; }else {  echo date('d-m-Y H:i',$rounded_seconds);  } ?>" />
								<input type="hidden" name="todate" value="<?php if(isset($todates)) { echo $todates; }else { echo date('d-m-Y H:i',$rounded_seconds1); } ?>" />                            
							
								<input type="hidden" name="bookloc" value="<?php if(isset($bookloc)){ echo $bookloc; }else { echo Yii::app()->session['book-loc']; }?>"/>
								<input type="submit" name="selfbook" class = "btn btn-theme" id="btnsub1" value="Book now" />
							 	<input type="hidden" name="booklocation" id="booklocation"/>
							 <!--<a class = "btn btn-theme pull-right"  id="btn2">Book Now</a>-->
							
							  <!-- <a class = "btn btn-theme pull-right" id="btnsub1" data-toggle = "modal" data-target = "#signup-model">Book Now</a>-->
							</form>
						</div>

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

                      



                    </div>

                    <!-- /CONTENT -->



                    <!-- SIDEBAR -->
                    <aside class="col-md-3 sidebar selfaside" id="sidebar">
                    <!-- /widget -->
						<div class="widget shadow widget-filter-price">
    						<h4 class="widget-title">Category</h4>
                            <div class="widget-content category">
                                <a href="<?php echo $this->createUrl('Selfdrive/'); ?>" class="list-group-item <?php if(!isset($_GET['id'])){  echo 'active'; } ?>">ALL</a>
                                                         <a href="?id=business&fromdate=<?php if(isset($fromdates)) echo $fromdates; ?>&todate=<?php if(isset($todates)) echo $todates; ?>" class="list-group-item <?php if(isset($_GET['id'])) { if($_GET['id']=='business'){  echo 'active'; } } ?>">Business Cars</a>
                                                        <a href="?id=economic&fromdate=<?php if(isset($fromdates)) echo $fromdates; ?>&todate=<?php if(isset($todates)) echo $todates; ?>" class="list-group-item <?php if(isset($_GET['id'])) { if($_GET['id']=='economic'){  echo 'active'; } } ?>">Economic Cars</a>
                                                        <a href="?id=premium&fromdate=<?php if(isset($fromdates)) echo $fromdates; ?>&todate=<?php if(isset($todates)) echo $todates; ?>" class="list-group-item <?php if(isset($_GET['id'])) { if($_GET['id']=='premium'){  echo 'active'; } } ?>">Premium Cars</a>
                                                        <a href="?id=luxury&fromdate=<?php if(isset($fromdates)) echo $fromdates; ?>&todate=<?php  if(isset($todates)) echo $todates; ?>" class="list-group-item <?php if(isset($_GET['id'])) { if($_GET['id']=='luxury'){  echo 'active'; } } ?>" >Luxury Cars</a> 
                            </div>
                        </div>
                    <!-- widget Features filter -->
				    <article id="filters">
    				 <div class="widget shadow widget-filter-price">
    				    <h4 class="widget-title">Features</h4>
                            <div id="category" class="widget-content category">
                                
								<div class="checkbox list-group-item">
                                    <label><input type="checkbox"  value="AudioSystem" id="type-AudioSystem" />
                                    AudioSystem</label>
                                </div>
								<div class="checkbox list-group-item">
                                    <label><input type="checkbox" name="cat2" value="PowerWindow" id="type-PowerWindow" />
                                    PowerWindow</label>
                                </div>
                                <div class="checkbox list-group-item">
                                    <label><input type="checkbox" name="cat3" value="Bluetooth" id="type-Bluetooth" />Bluetooth</label>
                                </div>
                                <div class="checkbox list-group-item">
                                    <label><input type="checkbox" name="cat4" value="Localandsatelliteradio" id="type-Localandsatelliteradio" />Local and satellite radio</label>
                                </div>
                                <div class="checkbox list-group-item">
                                    <label><input type="checkbox" name="cat5" value="GPSnavigationsystem" id="type-GPSnavigationsystem" />GPS navigation system</label>
                                </div>
                            </div>
                    </div>
                    <!-- /widget Features filter -->

                    <!-- widget price filter -->
                    <div class="widget shadow widget-filter-price">
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
    	            </div>
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


<?php 

?>

<?php 

?>