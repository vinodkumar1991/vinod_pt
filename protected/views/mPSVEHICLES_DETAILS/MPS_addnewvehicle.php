<?php
//echo 'dsfjklslk'.Yii::app()->session['username'];

/*  var_dump($vmakelist);
exit; */ 
// Yii::app()->session['bookloc'];
  
// $bodytag = str_replace(" ", "+", "Hyderabad International Airport, Shamshabad, Hyderabad, Telangana, India");

		 // $url = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$bodytag&sensor=false&region=india");
				// $response = json_decode($url);

				// echo $lat = $response->results[0]->geometry->location->lat;
				// $long = $response->results[0]->geometry->location->lng; 
				// exit;


?>
<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/dist/locationpicker.jquery.min.js"></script>
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
	
	
	
	
	$("#regemail").change(function(){
				
				var emailid = $('#regemail').val();
				
				$.post('emailValidation',{
		            emailid:emailid,
		
					beforeSend : function(){ 	}
	},
		function(data)
		{ 
			
			 if(data>0)
			{
				
				$("#emailerror").html('<font color="red">Email Id already exist.</font>');
				return false;
			}
			else{
				$("#emailerror").html('');
				
			}  
		}); 
       
			});
		
		
		
		
	
	 $('.addveh').click(function()
	 {
		
		
		var make_id= $("#makes_id").val();
		var model_id= $("#model_id").val();
		
		
		
		 $.post('AddMoreVehicle',{
						 
						  make_id:make_id,
						  model_id:model_id, 
						 
						  
						 
				 },
					 function(data)
					 {
					//alert(data);
					
					location.href="VehicleList";
					 });  
	 });
	
	
	
	
	  
	  
	 
	
	
	$('#carlist li').click(function() {
     //Get the id of list items
       var vmakeid = $(this).attr('id');
	   $('#makes_id').val(vmakeid);
	    $('#makes_idd').val(vmakeid);
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
		 $('#model_idd').val(modelid);
	  
    text1=$(this).text();
	$('#span1').text(text1);
	
});
   
   
});



</script>

<style type="text/css">
.modal-header{
    border-bottom: none;
}
    @media screen and (min-width: 768px) {
        .modal-dialog {
          width: 760px; /* New width for default modal */
        }
        .modal-sm {
          width: 380px; /* New width for small modal */
        }
    }
    @media screen and (min-width: 992px) {
        .modal-lg {
          width: 950px; /* New width for large modal */
        }
    }
</style>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Track Your Vehicle</h4>
      </div>
      <div class="modal-body">
	   
        <p>Track you vehichle by clicking download app button
		 
		
		</p>
		<div class="pull-left dwn-app">
                        <a href="" class="btn btn-submit btn-theme">Download App <i class="fa fa-mobile animated" aria-hidden="true"></i></a>
                    </div>
					<br/><br/><br/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<input type="hidden" name="amount" id="amount"/>
<input type="hidden" name="package" id="package"/>
<?php

				if(empty(Yii::app()->session['username']))
				{
				
				}
				
				?>
<!-- BREADCRUMBS -->
 <form method="post" action="addmorevehicle" enctype="multipart/form-data">
        <section class="bookservice-main page-section breadcrumbs">
            <div class="container">			
			<?php
			if(empty(Yii::app()->session['username']) && isset(Yii::app()->session['bookloc']) && isset(Yii::app()->session['picdate']) && isset(Yii::app()->session['bookhour']))
						{
							
						}
						if(empty(Yii::app()->session['username']) && !isset(Yii::app()->session['bookloc']) && 
						!isset(Yii::app()->session['picdate']) && !isset(Yii::app()->session['bookhour']))
						{
							
						}
						else{
							
							
					 
						}
						
			
			?>
            
            <div class="col-md-6 text-right">
                <div class="page-header">
                    <h1>Book a Service</h1>
                </div>
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Pages</a></li>
                    <li class="active">Booking &amp; Payment</li>
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
                </div>
                    <!-- CONTENT -->
                    <div class="col-md-9 content" id="content">
                   
                    <div class="form-group has-icon has-label">
                        <h2>Vehicle Category</h2>
                        <div class="vehiclestype">
                            <div class="col-sm-6 text-center">
                                <a href="#addcar" class="active"><i aria-hidden="true" class="fa fa-car"></i>
                                <h2>Car</h2></a>
                            </div>
                            <div class="col-sm-6 text-center">
                                <a href="#addbike"><i aria-hidden="true" class="fa fa-motorcycle"></i>
                                <h2>Bike</h2></a>
                            </div>
                        </div>
                    </div>

                    <!-- Vehicle Category Car -->
                    <div id="addcar" class="vehicles">
						<?php
			if(!empty(Yii::app()->session['username']))
						{
                           
                       echo '<div class="row">
                            <div class="col-sm-6">
                                    <div class="form-group has-icon has-label booksel">
                                    <label for="formSearchOffLocation3">Select Brand</label>
                                    <div id="carsbrand" class="wrapper-dropdown-3" tabindex="1">
									<span>Select The Car Brands</span>
									<ul class="dropdown scrollable-menu" id="carlist" require>';
										  foreach($vmakelist as $vmake) {
																					//echo $vmake['makes_name'];
																					if(!empty($vmake['makes_name']))
																					{

																			echo '<li id="'.$vmake['makes_id'].'" class="cl">
																			<a href="#">'.$vmake['makes_name'].'
																			<img src="http://metrepersecond.com/MPS'.$vmake['logo_img'].'"></a></li>';
																					}
																			
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
						
						?>                        
					     
                            </div>
							<br/><br/><br/>
							<div class="row">
                            <div class="col-sm-3">
							 <a href="#" class="dropdown-toggle btn btn-block btn-submit ripple-effect btn-theme addveh">Add Vehicle </a>
							 </div>
							 </div>
							</form>
                         <!-- End Vehicle Category Car -->

                         <!-- Vehicle Category Bike -->
                            <div id="addbike" class="vehicles">
                                Bike
                            </div>
                         <!-- End Vehicle Category Bike -->

                    <!--</form>-->
                    </div>
                    <!-- /CONTENT -->

                    <!-- SIDEBAR -->
                    <aside class="col-md-3 sidebar" id="sidebar">
                    <!-- widget Vehicle Servicing Details -->
                        <div class="widget shadow widget-helping-center estimate-widget">
                            <h4 class="widget-title">Vehicle Servicing</h4>
                            <div class="widget-content">
                                <h5>Type of Service</h5>
								<span><div id="typeserve"></div></span>
                                <!--<ul>
                                    <li>oil Service</li>
                                    <li>Washing<li>
                                    <li>General Service<li>
                                </ul>-->
                                <h5>Estimated Hour</h5>
								<span><div id="esthour"></div></span>
                                <span><?php echo Yii::app()->session['bookhour'];?></span>
                                <h5>Estimated Amount</h5>
                               <span><div id="estamt"></div></span>
								
                            </div>
                        </div>
                        <!-- widget testimonials -->
                        <div class="widget shadow">
                            <div class="widget-title">Testimonials</div>
                             <div class="carousel slide" id="testimonials" data-ride="carousel">   
                                <div class="carousel-inner">
                                    <div class="item active">
                                          <div class="media">
                                            <div class="media-body">
                                              <div class="testimonial-text">Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</div>
                                              <div class="testimonial-name">John Doe <span class="testimonial-position">Co- founder at Rent It</span></div>
                                            </div>
                                          </div>
                                        </div>
                                        
                                        <div class="item">
                                          <div class="media">
                                            <div class="media-body">
                                              <div class="testimonial-text">Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</div>
                                              <div class="testimonial-name">John Doe <span class="testimonial-position">Co- founder at Rent It</span></div>
                                            </div>
                                          </div>
                                        </div>
                                        
                                        <div class="item">
                                          <div class="media">
                                            <div class="media-body">
                                              <div class="testimonial-text">Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</div>
                                              <div class="testimonial-name">John Doe <span class="testimonial-position">Co- founder at Rent It</span></div>
                                            </div>
                                          </div>
                                        </div>
                                        <ol class="carousel-indicators">
                                            <li data-target="#testimonials" data-slide-to="0" class="active"></li>
                                            <li data-target="#testimonials" data-slide-to="1"></li>
                                            <li data-target="#testimonials" data-slide-to="2"></li>
                                        </ol>
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
        </section>
        <!-- /PAGE WITH SIDEBAR -->
			
<script type="text/javascript">
//vehicle category code
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
                $content.fadeOut(300, function()
                                 {
                                     $active = $(c);
                                     $content = $($(c).attr('href'));
                                     
                                     $active.addClass('active');
                                     $content.fadeIn(300);
                                 });
                e.preventDefault();
            });
        });
    // services selct options
    $('#carservices_sel').change(function(){
		
	//alert($('#carservices_sel').val();
		// makes_id=$("#makes_id").val();
		 model_id=$("#model_id").val();
		//alert(model_id);
		  $.post('FetchRepairLists',{
						//makes_id:makes_id,
						model_id:model_id,
					},
					function(data)
					{
						//alert(data);
						datas=data.split('**');
						$("#basicdata").html(datas[0]);
						$("#estamt").html(datas[1]);
						 $("#amount").val(datas[1]);
						 $("#esthour").html(datas[2]);
					      $("#package").val('1'); 
							
					}); 
	  
		
            $('.servicelist').hide();
            $('#' + $(this).val()).show();
        });
</script>

<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/dropdownscript.js"></script>
