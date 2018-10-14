<?php



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

jQuery(document).ready(function()
		{
			
			jQuery("#mobNo").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
jQuery("#register").click(function(){
				
				var uname = $('#uname').val();
				
				var emailId = $('#emailId').val();
			    var mobNo = $('#mobNo').val();
			    var location = $('#location1').val();
				var longlatdata = $('#location').val();
				var username = $('#Usernmame').val();
				
				data=longlatdata.split(',');
				longitude=data[0];
				latitude=data[1];
				var Usernmame = $('#Usernmame').val();
				
				var upwd = $('#upwd').val();  
				if(uname=="")
				{
					$('#delemailer').html('<font color="red">Please Enter First Name</font>');
					$('#uname').focus();
					return false;
				}
				
				else if(emailId=="")
				{
					$('#delemailer').html('<font color="red">Please Enter EmailId</font>');
					$('#emailId').focus();
					return false;
				}
				else if(mobNo=="")
				{
					$('#delemailer').html('<font color="red">Please Enter MobileNo.</font>');
					$('#mobNo').focus();
					return false;
				}
				else if(location=="")
				{
					$('#delemailer').html('<font color="red">Please Enter MobileNo.</font>');
					$('#location1').focus();
					return false;
				}
				else if(Usernmame=="")
				{
					$('#delemailer').html('<font color="red">Please Enter Username</font>');
					$('#Usernmame').focus();
					return false;
				}
				else if(upwd=="")
				{
					$('#delemailer').html('<font color="red">Please Enter Password</font>');
					$('#upwd').focus();
					return false;
				}
				else if($("input[type='checkbox'][name='agreemnt']:checked").length < 1)
				{
					$('#delemailer').html('<font color="red">Please Checked</font>');
					$('#agreemnt').focus();
					return false;
				}
					
				else
				{
					return true;
				
				}
       
	});
	
	 jQuery("#cpwd").change(function(){
							var password = jQuery('#upwd').val();
							
							var conpwd = jQuery('#cpwd').val();
							if(password!=conpwd)
							{
							//alert('not matching');
							jQuery("#delemailer").html('<font color="red">Password and confirm password should be match</font>');
							
							
							return false;
							}
							else{
								jQuery("#delemailer").html('');
								
								
							}
				
						});
	//--------------------
	jQuery("#emailId").change(function(){
				
				var emailid = $('#emailId').val();
				
				$.post('../mPSVEHICLES_DETAILS/emailValidation',{
		            emailid:emailid,
		
					beforeSend : function(){ 	}
	},
		function(data)
		{ 
			//alert(data);
			if(data>0)
			{
				
				jQuery("#delemailer").html('<font color="red">Email Id already exist.</font>');
				return false;
			}
			else{
				jQuery("#delemailer").html('');
				
			}
			
				
				
			
			
		}); 
       
			});
});
		</script>

<!-- BREADCRUMBS -->
        <section class="bookservice-main page-section breadcrumbs">
            <div class="container">
                <div class="col-md-12">
                    <div class="page-header text-right">
                        <h1>Add a Vehicle</h1>
                    </div>
                    <ul class="breadcrumb text-right">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Pages</a></li>
                        <li class="active">Booking &amp; Payment</li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="page-section addvhlc">
            <div class="container">
			
                <div class="col-md-offset-1 col-md-5">
                <h2 class="addvhlc-title"><?php echo Yii::app()->session['getcarmake'];?> <?php echo Yii::app()->session['getcarnmodel'];?></h2>
                    <ul class="addvhlc-details text-left">
                        <li>Variant: <strong><?php echo Yii::app()->session['Variant'];?></strong></li>
                        <li>Last Service: <strong><?php echo Yii::app()->session['LastService'];?></strong></li>
                        <li>Vehicle Age: <strong><?php echo Yii::app()->session['Age'];?></strong></li>
                        <li>Vehicle No.: <strong><?php echo Yii::app()->session['VehicleNo'];?></strong></li>
                    </ul>                    
                </div>
                <div class="col-md-6 text-center">
				
                    <img src="<?php echo Yii::app()->baseUrl.Yii::app()->session['car_img'];?>">
                </div>
            </div>
        </section>

        <!-- /BREADCRUMBS -->

        <!-- PAGE WITH SIDEBAR -->
        <section class="page-section with-sidebar sub-page addvhlregister">
            <div class="container">
                <div class="row">
                    <!-- CONTENT -->
                    <div class="col-md-9 content" id="content">
                        <h3 class="block-title alt">Register With Us Add This Vehicle in your Account.</h3>
                        <form action="VehicleInfo" class="form-delivery" method="post">
						<input type="hidden" name="modelid" id="modelid" value="<?php echo Yii::app()->session['model_id'];?>"/>
			<input type="hidden" name="makeid" id="makeid" value="<?php echo Yii::app()->session['makes_id'];?>"/>
			<input type="hidden" name="getcarnmodel" id="getcarnmodel" value="<?php echo Yii::app()->session['getcarnmodel'];?>"/>
			<input type="hidden" name="getcarmake" id="getcarmake" value="<?php echo Yii::app()->session['getcarmake'];?>"/>
                            <div class="row">
							 <div class="col-md-12">
                                   	<div id="delemailer" align="center"></div>
									 <input type="hidden" class="form-control alt geocomplete"  name="location" id="location" placeholder="Enter Your Location">
                                </div>
						
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
                                    <div class="form-group"><input class="form-control alt" type="text" name="emailId" id="emailId" placeholder="Your Email Address:*"required></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-icon has-label">
                                        <input type="text" class="form-control alt" id="mobNo" name="mobNo" placeholder="Mobile Number:" maxlength="10">
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group has-icon has-label">
                                        <input type="text" class="form-control alt geocomplete"  name="location1" id="location1" placeholder="Enter Your Location">
                                        <span class="form-control-icon"><i class="fa fa-location-arrow"></i></span>
                                    </div>
                                </div>
								<div class="col-md-12"><h3 class="block-title alt">Create Account</h3></div>
                                <div class="col-md-12">
                                    <div class="form-group"><input class="form-control alt" type="text" name="Usernmame" id="Usernmame"  placeholder="Enter User Name:*"></div>
								</div>
								<div class="col-md-12">
									<div class="form-group"><input class="form-control alt" type="password" name="upwd" id="upwd" placeholder="Enter Password:"></div>
                                </div>
                                <div class="col-md-12">
									<div class="form-group"><input class="form-control alt" type="password" name="cpwd" id="cpwd" placeholder="Enter Confirm Password:"></div>
                                </div>
								
                            </div>
							
							 <div class="bottomservice-btn overflowed reservation-now">
                            <div class="checkbox pull-left">
                                <input id="agreemnt" name="agreemnt" type="checkbox">
                                <label for="agreemnt">I accept all information and Payments etc</label>
                            </div><br/>
                            <input type="submit" name="register" id="register" value="Register">
							
                        </div>
                        </form>
                       
					<font color="green"><div id="sucmsg"></div></font>
                    </div>
                    <!-- /CONTENT -->

                    <!-- SIDEBAR -->
                    <aside class="col-md-3 sidebar" id="sidebar">
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

                        </form>
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

    </div>