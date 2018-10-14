<script>
$(document).ready(function(){
	 $('#carlist li').click(function() {
       var vmakeid = $(this).attr('id');
	   $('#makes_id').val(vmakeid);
	
				$.post('../mPSVEHICLES_DETAILS/Getvmodel',{
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
                    <div class="form-search light col-md-9 col-md-offset-2">
                        <div class="col-md-4">
                            <div class="form-group has-icon has-label">
                                <label for="formSearchOffLocation3">Choose Brand</label>
                                <div id="carsbrand" class="form-control wrapper-dropdown-3" tabindex="1">
									<span>Select The Car Brands</span>
                                <ul class="dropdown scrollable-menu" id="carlist">
								<?php
							 	foreach ($vmakelist as $vmake) {
                                                                            //echo $vmake['makes_name'];

	                            echo '<li id="'.$vmake['makes_id'].'" class="cl"><a href="#">'.$vmake['makes_name'].' <img src="http://metrepersecond.com/MPS'.$vmake['logo_img'].'"></a></li>';
	                            
	                                }
																		?>
								</ul>
                                <div class="form-control-icon"><i class="fa fa-sort-desc"></i></div>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-4">
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
                        <div class="col-md-4">
                            <div class="form-group has-icon has-label">
                                <label for="formFindCarCategory">Type of Modifications</label>
                                <select class="form-control" name="modlist" id="modlist">
                                	<option>Select Modification</option>
                                	<?php foreach($types as $type) { ?>
									<option value="<?php echo $type['id']; ?>"><?php echo $type['mods']; ?></option>
									<?php } ?>
                                </select>
                            </div>
                        </div>
                     
                        <div class="col-md-3 wow fadeInDown col-md-offset-5" data-wow-offset="200" data-wow-delay="500ms">
                            <div class="form-group"><?php if(empty(Yii::app()->session['username'])) { ?>
                                <a href="#" class="dropdown-toggle btn ripple-effect btn-theme" data-toggle="modal" data-target="#myModalmod">Modify Now </a>
							<?php }else { ?> <a href="#" class="dropdown-toggle btn ripple-effect btn-theme" data-toggle="modal" data-target="#">Search Now </a> <?php } ?>
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
            		<div class="col-md-9 content car-listing col-md-offset-2">
            			<div class="thumbnail no-border no-padding thumbnail-car-card clearfix">
                            <div class="media">
                                    <img alt="" src="<?php echo Yii::app()->baseUrl; ?>/assets/img/preview/cars/car-370x220x5.jpg">
                                </a>
                            </div>
                            <div class="caption">
                                <h4 class="caption-title"><a href="#">VW POLO TRENDLINE 2.0 TDI</a></h4>
                                <div class="caption-text">Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</div>
                                <table class="table">
                                    <tbody><tr>
                                        <td><i class="fa fa-car"></i> 2013</td>
                                        <td><i class="fa fa-dashboard"></i> Diesel</td>
                                        <td><i class="fa fa-cog"></i> Auto</td>
                                        <td><i class="fa fa-road"></i> 25000</td>
                                        <td class="buttons"><a href="#" class="btn btn-theme">Book Now</a></td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>
            		</div>
            	</div>
            	<div class="modify-ctn-list">
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
            </div>
            </div>
        </section>
        
<!-- /PAGE -->

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
