<?php
// Yii::app()->session['bookloc'];
/*  
 echo Yii::app()->session['location'];
 exit; */

?>

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
$(document).ready(function()
{
	
	
	
	
	$('.services').change(function() {
		services=$('.services').val();
		$("#servnm").val(services);
	});
	$('#carlist li').click(function() {
     //Get the id of list items
       var vmakeid = $(this).attr('id');
	   $('#makes_id').val(vmakeid);
		//return false;
     // alert($( "li " ).text());
	 
				//alert(vmakeid);
				$.post('Getvmodel',{
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
   
   
});



</script>
<!-- BREADCRUMBS -->
        <section class="bookservice-main page-section breadcrumbs">
            <div class="container">
			<form method="post" action="Bookingsevicedetails" enctype="multipart/form-data">
			
			<?php
			if(empty(Yii::app()->session['username']) && isset(Yii::app()->session['bookloc']) && isset(Yii::app()->session['picdate']) && isset(Yii::app()->session['bookhour']))
						{
							echo '<div class="col-md-6">
                <div class="page-header">
                    <div class="form-group has-icon has-label col-sm-6 no-pading-left">
                      <label>Your Pickup Location</label>
                      <input class="form-control alt geocomplete" type="text" name="adrs" id="adrs" placeholder="picked customer location address" value="'.Yii::app()->session['bookloc'].'" required>
                      <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>  
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group has-icon has-label">
                        <label>Picking Up Date</label>
                        <input type="text" class="form-control" id="pickhr" name="pickhr" placeholder="Picking Up Hour" value="'.Yii::app()->session['bookhour'].'" required>
                        <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                    </div>
                    </div>
					<div class="col-sm-6 no-pading-left">
                    <div class="form-group has-icon has-label">
                        <label>Picking Up Date</label>
                        <input type="text" class="form-control" id="picdate" name="picdate" placeholder="Picking Up Date" value="'.Yii::app()->session['picdate'].'" required>
                        <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                    </div>
                    </div>
                    <div class="col-sm-6 no-pading-right">
                        <div class="form-group has-icon has-label">
                            <label>Type of Vehicle</label>
                            <select class="form-control" name="variant" id="variant" required>
                                <option>Vehicle type</option>
                                <option>Car</option>
                                <option>Bike</option>
                            </select>
                        </div>
                </div>
            </div>
            </div>';
						}
						if(empty(Yii::app()->session['username']) && !isset(Yii::app()->session['bookloc']) && 
						!isset(Yii::app()->session['picdate']) && !isset(Yii::app()->session['bookhour']))
						{
							echo '<div class="col-md-6">
                <div class="page-header">
                    <div class="form-group has-icon has-label col-sm-6 no-pading-left">
                      <label>Your Pickup Location</label>
                      <input class="form-control alt geocomplete" type="text" name="adrs" id="adrs" placeholder="picked customer location address" value="'.Yii::app()->session['bookloc'].'" required>
                      <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>  
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group has-icon has-label">
                        <label>Picking Up Date</label>
                        <input type="text" class="form-control" id="pickhr" name="pickhr" placeholder="Picking Up Hour" value="'.Yii::app()->session['bookhour'].'" required>
                        <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                    </div>
                    </div>
					<div class="col-sm-6 no-pading-left">
                    <div class="form-group has-icon has-label">
                        <label>Picking Up Date</label>
                        <input type="text" class="form-control" id="picdate" name="picdate" placeholder="Picking Up Date" value="'.Yii::app()->session['picdate'].'" required>
                        <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                    </div>
                    </div>
                    <div class="col-sm-6 no-pading-right">
                        <div class="form-group has-icon has-label">
                            <label>Type of Vehicle</label>
                            <select class="form-control" name="variant" id="variant" required>
                                <option>Vehicle type</option>
                                <option>Car</option>
                                <option>Bike</option>
                            </select>
                        </div>
                </div>
            </div>
            </div>';
						}
						else{
							
							echo '
                      <input class="form-control alt geocomplete" type="hidden" name="adrs" id="adrs" placeholder="picked customer location address" value="'.Yii::app()->session['bookloc'].'" required>
                     <input type="hidden" class="form-control" id="pickhr" name="pickhr" placeholder="Picking Up Hour" value="'.Yii::app()->session['bookhour'].'"
					 <input type="text" class="form-control" id="picdate" name="picdate" placeholder="Picking Up Date" value="'.Yii::app()->session['picdate'].'" required>
					 
					 ';
					 
						}
						
			
			?>
            
            <div class="col-md-6 text-right">
                <div class="page-header">
                    <h1>Book a Service</h1>
                </div>
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Pages</a></li>
                    <li class="active">Booking & Payment</li>
                </ul>
            </div>
            </div>
        </section>
        <!-- /BREADCRUMBS -->

        <!-- PAGE WITH SIDEBAR -->
        <section class="page-section with-sidebar sub-page">
            <div class="container">
                <div class="row">
									<input type="hidden" name="makes_id" id="makes_id">
								  <input type="hidden" name="model_id" id="model_id">
								  <input type="hidden" name="servnm" id="servnm">
								  <input type="hidden" class="form-control alt"  name="location" id="location" placeholder="Enter Your Location">
                    <!-- CONTENT -->
                    <div class="col-md-9 content" id="content">
                      
						<?php
			if(empty(Yii::app()->session['username']))
						{
                           
                       echo '<div class="row">
                            <div class="col-sm-6">
                                    <div class="form-group has-icon has-label booksel">
                                    <label for="formSearchOffLocation3">Select Brand</label>
                                    <div id="carsbrand" class="wrapper-dropdown-3" tabindex="1">
									<span>Select The Car Brands</span>
									<ul class="dropdown scrollable-menu" id="carlist">';
										foreach($vmakelist as $vmake) {
																					//echo $vmake['makes_name'];

																			echo '<li id="'.$vmake['makes_id'].'" class="cl"><a href="#">'.$vmake['makes_name'].' <img src="'.Yii::app()->request->baseUrl.''.$vmake['logo_img'].'"></a></li>';
																			
																				}
									echo'</ul>
									<div class="form-control-icon"><i class="fa fa-sort-desc" aria-hidden="true"></i></div>
                                    </div>
                                    
                                    </div>
                                </div>
                            <div class="col-sm-6">
                                <div class="form-group has-icon has-label booksel">
                                    <label for="formSearchOffLocation3">Select Model</label>
                                    <div id="carsmodel" class="wrapper-dropdown-3" tabindex="1">
									<span id="span1">Select The Model</span>
									<ul class="dropdown scrollable-menu" id="modellist">
										
									</ul>
									<div class="form-control-icon"><i class="fa fa-sort-desc" aria-hidden="true"></i></div>
                                    </div>
                                    
                                </div>
                            </div>
                            </div>';
						}
						else if(!empty(Yii::app()->session['username']))
						{
							     echo '<div class="row">
                         
                            <div class="col-sm-6">
                                <div class="form-group has-icon has-label booksel">
                                    <label for="formSearchOffLocation3">Select Model</label>
                                    <div id="carsmodel" class="wrapper-dropdown-3" tabindex="1">
									<span id="span1">Select The Model</span>
									<ul class="dropdown scrollable-menu" id="modellist">';
									if(!empty($vmodel))
									{
										foreach($vmodel as $vmode) {
																					//echo $vmake['makes_name'];

																			echo '<li id="'.$vmode['models_id'].'" class="cl"><a href="#">'.$vmode['models_name'].' <img src="'.Yii::app()->request->baseUrl.''.$vmode['imgpath'].'"></a></li>';
																			
																				}
						     }
								echo'</ul>
									<div class="form-control-icon"><i class="fa fa-sort-desc" aria-hidden="true"></i></div>
                                    </div>
                                    
                                </div>
                            </div>
                            </div>';
						}
						?>
                        
					    <div class="row">
                            <div class="col-md-12 bookingvhlc">
							<select id="example-getting-started"  name="services" class="services" multiple="multiple" required>
							<?php
							foreach($getservices as $service)
							{
								echo ' <option value="'.$service['id'].'">'.$service['servicenames'].'</option>';
							}
							
							?>
							</select>
                          
                            </div>
                            </div>
							     <h3 class="block-title alt">Additional Information</h3>
                      
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <textarea class="form-control alt" placeholder="Addıtıonal Informatıon" name="addinfo" id="addinfo" cols="30" rows="10" style="height:120px;"></textarea></div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-12">
                                <h3 class="block-title alt describe">Describe More</h3>
                                <div class="form-group">
                                <div class="text-right"><i class="fa fa-headphones" aria-hidden="true"></i> | 
                                <i class="fa fa-video-camera" aria-hidden="true"></i></div>
                                <input type="file" name="vefinfo" id="vefinfo" class="form-control">
                                </div>  
                            </div>
                            </div>
	<?php
			if(empty(Yii::app()->session['username']))
						{
                           
                      echo '<h3 class="block-title alt">Customer Information</h3>
                       
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="radio radio-inline">
                                        <input type="radio" id="inlineRadio1" value="option1" name="radioInline" checked="">
                                        <label for="inlineRadio1">Mr</label>
                                    </div>
                                    <div class="radio radio-inline">
                                        <input type="radio" id="inlineRadio2" value="option1" name="radioInline">
                                        <label for="inlineRadio2">Ms</label>
                                    </div>
                                </div>
                               <div class="col-md-6">
                                    <div class="form-group"><input class="form-control alt" type="text" name="uname" id="uname" placeholder="Name:*" required></div>
                                </div>
                               
                                <div class="col-md-6">
                                    <div class="form-group"><input class="form-control alt" type="text" name="emailId" id="emailId" placeholder="Your Email Address:*" required></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-icon has-label">
                                        <input type="text" class="form-control alt" id="mobNo" name="mobNo" placeholder="Mobile Number:" maxlength="10" required>
                                    </div>
                                </div>
								
								<div class="col-md-12"><h3 class="block-title alt">Create Account</h3></div>
                                <div class="col-md-12">
                                    <div class="form-group"><input class="form-control alt" type="text" name="Usernmame" id="Usernmame"  placeholder="Enter User Name:*" required></div>
								</div>
								<div class="col-md-12">
									<div class="form-group"><input class="form-control alt" type="password" name="upwd" id="upwd" placeholder="Enter Password:" required></div>
                                </div>
                                <div class="col-md-12">
									<div class="form-group"><input class="form-control alt" type="password" name="cpwd" id="cpwd" placeholder="Enter Confirm Password:" required></div>
                                </div>
                            </div>
                       ';
						}?>
                        
                   
                      

                        <div class="bottomservice-btn overflowed reservation-now">
                            <div class="checkbox pull-left">
                                <input id="checkboxa1" type="checkbox">
                                <label for="checkboxa1">I accept all information and Payments etc</label>
                            </div><br/><br/>
                           <!-- <a class="btn btn-theme pull-right" href="#">Book a Service</a>-->
						     <a class="btn btn-theme pull-right btn-theme-dark" href="#">Cancel</a>
							<input type="submit" name="books" id="books" value="Book a Service" class="btn btn-theme pull-right">
                          
                        </div>

                    </div>
					</form>
                    <!-- /CONTENT -->

                    <!-- SIDEBAR -->
                    <aside class="col-md-3 sidebar" id="sidebar">
                    <!-- widget Vehicle Servicing Details -->
                        <div class="widget shadow widget-helping-center estimate-widget">
                            <h4 class="widget-title">Vehicle Servicing</h4>
                            <div class="widget-content">
                                <h5>Type of Service</h5>
                                <ul>
                                    <li>oil Service</li>
                                    <li>Washing<li>
                                    <li>General Service<li>
                                </ul>
                                <h5>Estimated Hour</h5>
                                <span><?php echo Yii::app()->session['bookhour'];?></span>
                                <h5>Estimated Amount</h5>
                                <span>2000.00</span>
                            </div>
                        </div>
                        <!-- widget testimonials -->
                        <div class="widget shadow">
                            <div class="widget-title">Testimonials</div>
                            <div class="testimonials-carousel">
                                <div class="owl-carousel" id="testimonials">
                                    <div class="testimonial">
                                        <div class="media">
                                            <div class="media-body">
                                                <div class="testimonial-text">Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</div>
                                                <div class="testimonial-name">John Doe <span class="testimonial-position">Co- founder at Rent It</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="testimonial">
                                        <div class="media">
                                            <div class="media-body">
                                                <div class="testimonial-text">Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</div>
                                                <div class="testimonial-name">John Doe <span class="testimonial-position">Co- founder at Rent It</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="testimonial">
                                        <div class="media">
                                            <div class="media-body">
                                                <div class="testimonial-text">Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</div>
                                                <div class="testimonial-name">John Doe <span class="testimonial-position">Co- founder at Rent It</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /widget testimonials -->
                        <!-- widget helping center -->
                        <div class="widget shadow widget-helping-center">
                            <h4 class="widget-title">Helping Center</h4>
                            <div class="widget-content">
                                <p>Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros.</p>
                                <h5 class="widget-title-sub">+90 555 444 66 33</h5>
                                <p><a href="mailto:support@supportcenter.com">support@supportcenter.com</a></p>
                                <div class="button">
                                    <a href="#" class="btn btn-block btn-theme btn-theme-dark">Support Center</a>
                                </div>
                            </div>
                        </div>
                        <!-- /widget helping center -->
                    </aside>
                    <!-- /SIDEBAR -->

                </div>
            </div>
        </section>
        <!-- /PAGE WITH SIDEBAR -->

        <!-- PAGE -->
        <section class="page-section contact dark">
            <div class="container">

                <!-- Get in touch -->

                <h2 class="section-title">
                    <small>Feel Free to Say Hello!</small>
                    <span>Get in Touch With Us</span>
                </h2>

                <div class="row">
                    <div class="col-md-6">
                        <!-- Contact form -->
                        <form name="contact-form" method="post" action="#" class="contact-form alt" id="contact-form">

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
                                    <input type="submit" name="submit" class="form-button form-button-submit btn btn-block btn-theme" id="submit_btn" value="Send message" />
                                </div>
                            </div>

                       
                        <!-- /Contact form -->
                    </div>
                    <div class="col-md-6">

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
		
<script type="text/javascript">
    $(document).ready(function() {
        $('#example-getting-started').multiselect();
    });
</script>

<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/dropdownscript.js"></script>
