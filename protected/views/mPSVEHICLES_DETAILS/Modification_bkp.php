<script>
$(document).ready(function()
{
	 $('#carlist li').click(function() {
     //Get the id of list items
       var vmakeid = $(this).attr('id');
	   $('#makes_id').val(vmakeid);
	
				$.post('Getvmodel',{
						Maker:vmakeid,
					},
					function(data)
					{
							alert(data);
							
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
<script>
  jQuery(document).ready(function()
		{
			
			
			
			$('#verifyformmod').hide();
		$('#modregister').click(function()
		{
			
					var a = Math.floor(100000 + Math.random() * 900000);		
							a = a.toString();
							a = a.substring(-2);
								$.post('Verify',{
											  
										mobileno:$('#modregmobNo').val(),
										otp:a ,
											 
									 }, 
										 function(data)
										 {
											
										console.log(data[0]);
										$('#formmod').hide(); 
										$('#verifyformmod').show();
											$('#modverify').click(function()
											{
												var b=$('#modverifyid').val();
												
												if(a==b)
												{
														 var regemail= $("#moddregemail").val();
		 var upwd= $("#modregupwd").val();
		  	var mobNo= $("#modregmobNo").val();
			 var uname= $("#modreguname").val();
			 
			  var makes_id= $("#makes_id").val();
			   var models_id= $("#models_id").val();
			    var modlist= $("#modlist").val();
				var formFindCarDate= $("#formFindCarDate").val();
	
		
		 $.post('SaveModificationdetails',{
						           regemail:regemail,
						           upwd:upwd,
								   mobNo:mobNo, 
								   uname:uname,
								   makes_id:makes_id,
								   models_id:models_id,
								   modlist:modlist,
								   formFindCarDate:formFindCarDate,
								   
						  
						   
						   
				 },
					 function(data)
					 {
						 alert(data);
					/* alert("Vericfication Successful");
					if(data==1)
					{
					 window.location="AddVehicle";
					}    */
					 });  
					 
			  
														
												}
												else
												{
													$('#error').html( "<Strong>Vericfication Code error</strong>" );
												}
											});
			});
	
	 });
	 
		}); 
</script>       

	   <!-- PAGE -->
        <section class="page-section find-car modification">
        <!-- <div class="bgimg-dark"></div> -->
            <div class="container">
            <div class="col-md-12 wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
            	<h2 class="caption-title">Find</h2>
				<h3 class="caption-subtitle">Modification Shop</h3>
            </div>
                <form action="#" class="form-find-car">
				<input type="hidden" name="makes_id" id="makes_id">
                <input type="hidden" name="model_id" id="model_id">
                    <div class="row">
                    <div class="form-search light col-md-8 col-md-offset-2">
                        <div class="col-md-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
                            <div class="form-group has-icon has-label">
                                <label for="formSearchOffLocation3">Choose Brand</label>
                                <div id="carsbrand" class="form-control wrapper-dropdown-3" tabindex="1">
									<span>Select The Car Brands</span>
                                <ul class="dropdown scrollable-menu" id="carlist">
								<?php
									 foreach ($vmakelist as $vmake) {
                                                                                    //echo $vmake['makes_name'];

                                                                            echo '<li id="'.$vmake['makes_id'].'" class="cl"><a href="#">'.$vmake['makes_name'].' <img src="http://10.10.10.28/mps/MPS'.$vmake['logo_img'].'"></a></li>';
                                                                            
                                                                                }
																				?>
								</ul>
                                <div class="form-control-icon"><i class="fa fa-sort-desc"></i></div>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="300ms">
                            <div class="form-group has-icon has-label">
                                <label for="formFindCarDate">Choose Model</label>
                                <div id="carsmodel" class="form-control wrapper-dropdown-3" tabindex="1">
									<span>Select The Car Model</span>
									<ul class="dropdown scrollable-menu" id="modellist">
										
									</ul>
								<div class="form-control-icon"><i class="fa fa-sort-desc" aria-hidden="true"></i></div>
								</div>
                                <div class="form-control-icon"><i class="fa fa-sort-des"></i></div>
                            </div>
                        </div>
                        <div class="col-md-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="400ms">
                            <div class="form-group has-icon has-label">
                                <label for="formFindCarCategory">Type of Modifications</label>
                                <select class="form-control" name="modlist" id="modlist">
                                	<option>Select Modification</option>
                                	<option value="1">List 1</option>
                                	<option value="2">List 2</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="300ms">
                            <div class="form-group has-icon has-label">
                                <label for="formFindCarDate">Picking Up Date</label>
                                <input type="text" class="form-control" id="formFindCarDate" placeholder="dd/mm/yyyy">
                                <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-3 wow fadeInDown col-md-offset-5" data-wow-offset="200" data-wow-delay="500ms">
                            <div class="form-group">
                               <!-- <button type="submit" id="formFindCarSubmit" class="btn btn-block btn-submit ripple-effect btn-theme">Modify Now</button>-->
							   <a href="#" class="dropdown-toggle btn btn-block btn-submit ripple-effect btn-theme" data-toggle="modal" data-target="#myModalmod">Modify Now </a>
                            </div>
                        </div>
					</div>
                    </div>
                </form>

            </div>
        </section>
        <!-- /PAGE -->

        <!-- PAGE -->
		<section class="page-section">
            <div class="container">
                <div class="row">
                    <div data-wow-delay="100ms" data-wow-offset="200" class="col-md-6 wow fadeInLeft">
                        <h2 class="section-title text-left">
                            <small>Modification</small>
                            <span>Over View of Modifications</span>
                        </h2>
                        <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. </p>
                        <ul class="list-icons">
                            <li><i class="fa fa-check-circle"></i>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                            <li><i class="fa fa-check-circle"></i>Proin tempus sapien non iaculis pretium.</li>
                        </ul>
                    </div>
                    <div data-wow-delay="300ms" data-wow-offset="200" class="col-md-6 wow fadeInRight">
                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/modification.jpg">
                    </div>
                </div>
                <div class="row mdf-dntng">                
                    <div data-wow-delay="300ms" data-wow-offset="200" class="col-md-6 wow fadeInRight">
                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/modification-denting.jpg">
                    </div>
                    <div data-wow-delay="100ms" data-wow-offset="200" class="col-md-6 wow fadeInLeft">
                        <h2 class="section-title text-left">
                            <span>Modifications Denting</span>
                        </h2>
                        <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. </p>
                        <ul class="list-icons">
                            <li><i class="fa fa-check-circle"></i>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                            <li><i class="fa fa-check-circle"></i>Proin tempus sapien non iaculis pretium.</li>
                        </ul>
                    </div>
                </div>

            </div>
        </section>
        <!-- /PAGE -->
<div id="myModalmod" class="modal fade register-model" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create Account</h4>
                  </div>
                  <div class="modal-body">
				   <div id="verifyformmod">
				     <div class="col-md-12">
                        <div class="form-group"><input class="form-control alt" type="text" name="modregemail" id="modverifyid"  placeholder="Enter Vericfication code*" required></div>
                    </div>
					 <div class="col-md-12 text-center"> <div id="emailerror1"></div><input type="button" value="Submit" id="modverify" name="register" class="col-md-12 btn btn-theme"></div>
					<span id="error"></span>
					
				  </div>
                  <form action="#" id="formmod" class="create-account">
                   <div class="col-md-12">
                        <div class="form-group"><input class="form-control alt" type="text" name="moddregemail" id="moddregemail"  placeholder="Enter Email*" required></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"><input class="form-control alt" type="text" name="modreguname" id="modreguname" placeholder="Name" required></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group has-icon has-label">
                            <input type="text" class="form-control alt" id="modregmobNo" name="modregmobNo" placeholder="Enter Mobile Number*" maxlength="10" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"><input class="form-control alt" type="password" name="modregupwd" id="modregupwd" placeholder="Enter Password*" required></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"><input class="form-control alt" type="password" name="modcpwd" id="modcpwd" placeholder="Enter Confirm Password*" required></div>
                        <div class="col-md-6">                    
                    </div>
                   </div>
                  
                   <div class="col-md-12 text-center"> <div id="emailerror1"></div><input type="button" value="Create Account" id="modregister" name="modregister" class="col-md-12 btn btn-theme"></div>
                   <!--<div class="col-md-6 mrg-top-20">
                        <a href="#" class="btn btn-theme btn-block btn-icon-left facebook"><i class="fa fa-facebook"></i>Sign in with Facebook</a>
                    </div>-->
					<div class="col-md-6 mrg-top-20">
                       	<fb:login-button size='large' show_faces='false'  onlogin="checkLoginState();">
								</fb:login-button>
								<div id="status1">
									</div>
                    </div>
				
                   
                    </form>
                   </div>
                  </div>
                </div>

              </div>
        <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>

        <script type="text/javascript">
        	function DropDown(el) {
				this.carsbrand = el;
				this.placeholder = this.carsbrand.children('span');
				this.opts = this.carsbrand.find('ul.dropdown > li');
				this.val = '';
				this.index = -1;
				this.initEvents();
			}
			DropDown.prototype = {
				initEvents : function() {
					var obj = this;

					obj.carsbrand.on('click', function(event){
						$(this).toggleClass('active');
						return false;
					});

					obj.opts.on('click',function(){
						var opt = $(this);
						obj.val = opt.text();
						obj.index = opt.index();
						obj.placeholder.text(obj.val);
					});
				},
				getValue : function() {
					return this.val;
				},
				getIndex : function() {
					return this.index;
				}
			}

			$(function() {

				var carsbrand = new DropDown( $('#carsbrand') );

				$(document).click(function() {
					// all dropdowns
					$('.wrapper-dropdown-3').removeClass('active');
				});

			});
			
			
			function DropDown(el) {
				this.carsmodel = el;
				this.placeholder = this.carsmodel.children('span');
				this.opts = this.carsmodel.find('ul.dropdown > li');
				this.val = '';
				this.index = -1;
				this.initEvents();
			}
			DropDown.prototype = {
				initEvents : function() {
					var obj = this;

					obj.carsmodel.on('click', function(event){
						$(this).toggleClass('active');
						return false;
					});

					obj.opts.on('click',function(){
						var opt = $(this);
						obj.val = opt.text();
						obj.index = opt.index();
						obj.placeholder.text(obj.val);
					});
				},
				getValue : function() {
					return this.val;
				},
				getIndex : function() {
					return this.index;
				}
			}

			$(function() {

				var carsmodel = new DropDown( $('#carsmodel') );

				$(document).click(function() {
					// all dropdowns
					$('.wrapper-dropdown-3').removeClass('active');
				});

			});
        </script>