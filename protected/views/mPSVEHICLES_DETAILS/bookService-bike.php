<?php

?>

<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/dist/locationpicker.jquery.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/jquery.geocomplete.js"></script>


<script>
function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
//document.getElementById('estamt').value='0';
 
/*      function empty() {
    var x;
    x = document.getElementById("services").value;
    if (x ==""|| x=="0") {
        alert("Please Check one of the Service");
        return false;
    };
} */
   			
function checkper(id)
{
	var brandid=document.getElementById('makes_id').value;
	var modelid=document.getElementById('model_id').value;
	
	 var name='chk'+id;
	 var sid=id;
	if(document.getElementById(name).checked == true)
		{
			
				 	$.post('UpdateBikeRepairAmounts',{
							  cache: false,
							  id:sid,
							  brandid:brandid,
							  modelid:modelid,
							  	beforeSend : function(){
				$("#eloading").show();
				$("#generaljob").hide();
			  }

					 },
						 function(data)
						 {  
						 $("#eloading").hide();
						 $("#generaljob").show();
					var init=data;
					var s= document.getElementById('estamt');
					var totalamount=s.value;
					document.getElementById('modelid').value=modelid;					
					document.getElementById('services').value+=id+',';
					/*alert(totalamount);
					var amount=totalamount-init;
					alert(amount); */
					document.getElementById('bamount').value=+init+ +totalamount;
					s.value =+init+ +totalamount;
				});
						
		}
		else if(document.getElementById(name).checked == false)
		{
					
				 	$.post('UpdateBikeRepairAmounts',{
							  cache: false,
							  id:sid,
							  brandid:brandid,
							  modelid:modelid,
							  	beforeSend : function(){
				$("#eloading").show();
				$("#generaljob").hide();
				
			  }

					 },
						 function(data)
						 {  
						 $("#eloading").hide();
						 $("#generaljob").show();
						 var init=data;
					var s= document.getElementById('estamt');
					var totalamount=s.value;
					document.getElementById('modelid').value=modelid;
					var v=document.getElementById('services').value;
					var vr=id+',';
					var vrg=new RegExp(vr,"g");
					var newstr=v.replace(vr,'');					
					document.getElementById('services').value=newstr;
					/*alert(totalamount);
				var amount=totalamount-init;
				alert(amount); parseInt(init)-0 - parseInt(totalamount)-0; */
				document.getElementById('bamount').value=+init+ +totalamount;
				s.value =-init+ +totalamount;
				});
		}			 
}



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
		var picdate1=$("#picdate").val();
		var pichr1=$("#pickhr").val();
		var adrs1=$("#adrs").val();
		  
		 $("#picdate1").val(picdate1);
		 $("#pictime1").val(pichr1);
		// $("#adrs1").val(adrs1);
		$('.tab-content-login').hide();
	
		$('#btnsub').click(function()
		{
			
			carservices_sel=$('#bikeservices_sel').val();
			
			if(carservices_sel=='general')
			{
					 
			}
			else if(carservices_sel=='repairJob')
			{
				
					value=$('#valrep3').val();
					uname=$('#uname').val();
					model_id=$('#model_id').val();
					makes_id=$('#makes_id').val();
					$.post('Updateuserpackage',{
							  uname:uname,
							  value:value,
							  model_id:model_id,
							  makes_id:makes_id,
							  
							 
					 },
						 function(data)
						 {
						//alert(data);
						 if(data==1)
						{
							$("#loginerror").html('<font color=red>Invalid username and password</font>');
						}
						else
						{
							window.location="AddVehicle";
						} 
						 }); 
			}
			else
			{
			// model_id=$("#model_id").val();
					var uname= $("#uname").val();
					var password= $("#password").val();
					
					var makes_id= $("#makes_id").val();
					var model_id= $("#model_id").val();
					var pickadrs= $("#adrs").val();
					var picdate= $("#picdate").val();
					
					var pickhr= $("#pickhr").val(); 
					var amount= $("#amount").val(); 
			
					var packageid= $("#package").val(); 
			
			 $.post('loginuser',{
							  uname:uname,
							  password:password,
							  pickadrs:pickadrs,
							  picdate:picdate,
							  pickhr:pickhr,
							  makes_id:makes_id,
							  model_id:model_id, 
							  amount:amount,
							  packageid:packageid,
							  
							 
					},
						 function(data)
						 {
						//alert(data);
						if(data==1)
						{
							$("#loginerror").html('<font color=red>Invalid username and password</font>');
						}
						else
						{
							window.location="AddVehicle";
						}
						 });  
			}
		});
	
	$('#bikelist li').click(function() {
    
       var vmakeid = $(this).attr('id');
	  $('#makes_id').val(vmakeid);
				$.post('FetchBikeModels',{
						makeid:vmakeid,
					},
					function(data)
					{
						
						$("#span1").html("Select Model");
						$("#modellist").html(data);
						
						
							
					});
			
   });
   
   
   $("#modellist").on('click','li',function (){
	
	   $('#bamount').val('0');
	  //on click
	    var modelid = $(this).attr('id');
	   $('#model_id').val(modelid);
				text1=$(this).text();
						$('#span1').text(text1);
	   $.post('FetchbikemodelImage',{
						
						modelid:modelid
					},
					function(data)
					{
							//alert(data);
							datas=data.split('**');
							 $('#carimg').html("<img src=http://metrepersecond.com/MPS"+datas[0]+" name='carimg' id='carimg' height='100%' width='100%'>");
							 $('#brand').html('<b>'+datas[1]+'</b>');
							 $('#model').html('<b>'+datas[2]+'</b>');
						
					});
	 
carservices_sel=$('#bikeservices_sel').val();
		
		$('#typeservice').html(capitalizeFirstLetter(carservices_sel));
	if(carservices_sel=='general')
	{
		
		modelid=$('#model_id').val();
		$('#modelid').val(modelid);
		$('.bkser-features').hide();
		if(modelid==''){
			$('.tab-content-login').hide();
		}else{
		$('.tab-content-login').show();
		$('#extra').show();
		model_id=$('#model_id').val();
	 
		  $.post('FetchBikegenServiceDetails',{
						model_id:model_id
					},
					function(data)
					{
						//alert(data);
						datas=data.split('**');
						 $('#generaljob').html(datas[0]);
						 $('#estamt').val(datas[1]);
						  document.getElementById('bamount').value=datas[1];
						 $('#bserviceid').val('1');
						/* $("#typeservice").html("General Service"); */
					
							
					}); 
		}
	}
	else if(carservices_sel=='repairJob')
	{
		modelid1=$('#model_id').val();
		$('.bkser-features').hide();
		if(modelid1==''){
			$('.tab-content-login').hide();
		}else{
		$('.tab-content-login').show();
		$('#extra').show();
		  model_id=$('#model_id').val();
		  $.post('FetchBikerepairServiceDetails',{
						model_id:model_id
					},
					function(data)
					{
						
						  datas=data.split('**');
						 // alert(datas[0]);
						 $('#generaljob').html(datas[0]);
						 $('#estamt').val('0');
						  $('#bserviceid').val('2');
						/* $("#typeservice").html("Repair Job");   */
							
					}); 
		}
	}else
	{
		$('#extra').hide();
		$('.tab-content-login').hide();
		 $('#estamt').val('0');
	}
	

            $('.servicelist').hide();
            $('#' + $(this).val()).show();
       
	  // on click
	 
			
	
});

//-----------------------------------------------


$('#extra').hide();

$('#bikeservices_sel').change(function(){
		carservices_sel=$('#bikeservices_sel').val();
		
		$('#typeservice').html(capitalizeFirstLetter(carservices_sel));
	if(carservices_sel=='general')
	{
		
		modelid=$('#model_id').val();
		$('#modelid').val(modelid);
		$('.bkser-features').hide();
		if(modelid==''){
			$('.tab-content-login').hide();
		}else{
		$('.tab-content-login').show();
		$('#extra').show();
		model_id=$('#model_id').val();
	 
		  $.post('FetchBikegenServiceDetails',{
						model_id:model_id
					},
					function(data)
					{
						//alert(data);
						datas=data.split('**');
						 $('#generaljob').html(datas[0]);
						 $('#estamt').val(datas[1]);
						  document.getElementById('bamount').value=datas[1];
						 $('#bserviceid').val('1');
						/* $("#typeservice").html("General Service"); */
					
							
					}); 
		}
	}
	else if(carservices_sel=='repairJob')
	{
		modelid1=$('#model_id').val();
		$('.bkser-features').hide();
		if(modelid1==''){
			$('.tab-content-login').hide();
		}else{
		$('.tab-content-login').show();
		$('#extra').show();
		  model_id=$('#model_id').val();
		  $.post('FetchBikerepairServiceDetails',{
						model_id:model_id
					},
					function(data)
					{
						
						  datas=data.split('**');
						 // alert(datas[0]);
						 $('#generaljob').html(datas[0]);
						 $('#estamt').val('0');
						  $('#bserviceid').val('2');
						/* $("#typeservice").html("Repair Job");   */
							
					}); 
		}
	}else
	{
		$('#extra').hide();
		$('.tab-content-login').hide();
		 $('#estamt').val('0');
	}
	

            $('.servicelist').hide();
            $('#' + $(this).val()).show();
        });
		
		
   //---------------------
   
      
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
				<input type="hidden" name="make_id" id="makes_id" value="" />
				    <input type="hidden" name="hidden" id="model_id" value="" />
<input type="hidden" name="amount" id="amount" value=""/>
<input type="hidden" name="package" id="package" value="" />


<!-- BREADCRUMBS -->
 <form method="post" action="Bookingsevicedetails" enctype="multipart/form-data">
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
                    <div class="form-group has-icon col-sm-6">
                      <input class="form-control alt geocomplete" type="text" name="adrs" id="adrs" placeholder="picked customer location address" 
					  value="<?php echo Yii::app()->session['bookloc'];?>" required>
                      <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>  
                    </div>
                    <div class="form-group has-icon col-sm-3">
                        <input type="text" class="picupdate form-control" id="picdate" name="picdate" placeholder="Picking Up Date" value="<?php if(empty(Yii::app()->session['picdate'])){  $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
								
								if(isset($fromdates))
								{
									echo $fromdates;
								}
								else
								 {
									 echo $date->format('d-m-Y'); 
								  }  }else { echo Yii::app()->session['picdate']; }  ?>" required>
                        <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                    </div>
                    <div class="form-group has-icon col-sm-3">
                        <input type="text" class="pictimer form-control" id="pickhr" name="pickhr" placeholder="Picking Up Hour" value="<?php if(empty(Yii::app()->session['bookhour'])){  $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
								
								if(isset($fromdates))
								{
									echo $fromdates;
								}
								else
								 {
									 echo $date->format('h:i'); 
								  }  }else { echo Yii::app()->session['bookhour']; }  ?>" required>
                        <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                    </div>
            	</div>
            </div>  	</form>       
            
            </div>
        </section>
        <!-- /BREADCRUMBS -->

        <!-- PAGE WITH SIDEBAR -->
        <section class="page-section with-sidebar sub-page">
            <div class="container">
                    <!-- CONTENT -->
                    <div class="col-md-9 content" id="content">
                   
                    <div class="form-group has-icon has-label">
                        <div class="vehiclestype">
                            <div class="col-sm-6 text-center">
                                <a href="<?php echo $this->createUrl('mPSVEHICLES_DETAILS/Booking');?>"><i aria-hidden="true" class="fa fa-car"></i>
                                <h2>Car</h2></a>
                            </div>
                            <div class="col-sm-6 text-center">
                                <a href="<?php echo $this->createUrl('mPSVEHICLES_DETAILS/BikeDetails');?>" class="active"><i aria-hidden="true" class="fa fa-motorcycle"></i>
                                <h2>Bike</h2></a>
                            </div>
                        </div>
                    </div>

                    <!-- Vehicle Category Bike -->
                    <div class="vehicles">
                    <div class="row">
                    <div class="col-sm-4">
                                    <div class="form-group has-icon has-label booksel">
                                    <label for="formSearchOffLocation3">Select Brand</label>
                                    <div id="carsbrand" class="wrapper-dropdown-3" tabindex="1">
									<span>Select The Bike Brands</span>
									<ul class="dropdown scrollable-menu" id="bikelist" require>
										<?php
										
										 foreach($bikebrands as $bikemakes) {
																					//echo $vmake['makes_name'];

																			echo '<li id="'.$bikemakes['brand_id'].'" class="cl">
																			<a href="#">'.$bikemakes['brand_name'].'
																			<img src="http://localhost/beena/mps/MPS/images/uploadimages/bikes/brands/'.$bikemakes['brand_logo_path'].'"></a></li>';
																			
																				}
										?>
									</ul>
									<div class="form-control-icon"><i class="fa fa-sort-desc" aria-hidden="true"></i></div>
                                    </div>
                                    
                                    </div>
                                </div>
                            <div class="col-sm-4">
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
                            <div class="col-sm-4 bookingvhlc">                                    
							 <div class="form-group booksel">
							 <label for="formSearchOffLocation3">Select Service</label>
                                <select id="bikeservices_sel" class="form-control selectpicker">
                                    <option value="">Select Services</option>
                                    <option value="general">General</option>
                                    <option value="repairJob">RepairJob</option>
                                        
                                </select> 
                            </div>                         
                            </div>
                            </div>
							<span id="eloading" style="display:none"><img src="<?php echo Yii::app()->baseUrl?>/images/ajax.gif" align="center"></span>
                            <!-- General Service Code Start -->
                            <div class="row">
                            <div class="tab-content-login clearfix">
                                      <div id="generaljob" class="bike-service-lst"></div>
										<div class="bottomservice-btn overflowed reservation-now">
											
										</div>									  
								   </div>
					<!-- book a service features -->
					<div class="bkser-features">
					<div class="row">
						<div class="col-md-4 text-center">
							<div class="media">
								<div class="media-left">
									<img src="<?php echo Yii::app()->baseUrl; ?>/images/choose-icon.png">
								</div>
								<div class="media-body">
									<h3>Choose your service</h3>
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
									<p>Our vehicle collection personnel collects your vehicle from the location specified and ensures that it is assigned to the work shop or the service centre.    </p>
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
									<p>After the work progresses the owners of the vehicles are kept informed of the same through the application.  </p>
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
									<p>The service status is tracked through the various stages and the client or the customer is notified of the same.</p>
								</div>
							</div>
						</div>							
						<div class="col-md-4 text-center">
							<div class="media">
								<div class="media-left">
									<img src="<?php echo Yii::app()->baseUrl; ?>/images/payment-through the-app.png">
								</div>
								<div class="media-body">
									<h3>Payment through the app</h3>
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
									<p>After service and with the bill paid the vehicle is delivered to the customer’s location which is specified.</p>
								</div>
							</div>
						</div>
					</div>
					</div>
					<!-- /-end book a service features -->
                         
									</div>
									</div>
						
                      
                    </div>
                    <!-- /CONTENT -->

                    <!-- SIDEBAR -->
                    <aside class="col-md-3 sidebar" id="sidebar">
                    <!-- widget Vehicle Servicing Details -->
                        <div class="widget shadow widget-helping-center estimate-widget">
                            <h4 class="widget-title">Service Details</h4>
                            <div class="widget-content dflt-vhlc-icon">
                             <div class="aside-vhls-dtls">                            
	                           	<div id="carimg">
								<i class="fa fa-motorcycle" aria-hidden="true"></i>
								</div>
	                        <span class="brnd-name" id="brand"></span><br>
	                        <span class="mdl-name" id="model"></span>
                            </div>
                            </div>

                            <div class="widget-content">
                            <div id="extra" class="aside-srvs-dtls">
                                <h5>Type of Service</h5>
								<div id="typeserve">
									<div id="typeservice" class="type-serv-txt"></div>
								</div>

								<h5>Package Type</h5>

	                            <!-- <div class="aside-hour-dtls">
	                            	<h5>Estimated Hour</h5>
									<div id="esthour" class="est-hour">
									<i class="fa fa-clock-o" aria-hidden="true"></i> 00:00:00</div>
								</div> -->
							<div class="aside-amt-dtls">
                                <h5>Estimated Amount</h5>
                                	<!-- <div id="estamt" class="est-amount">
                               		1000.00
                               	</div> -->
								
								<i class="fa fa-inr" aria-hidden="true"></i><input type="text" class="est-amount" id="estamt" name="df" value=""/>
                            </div>							
							<form method="POST" action="BookBikeSummary">
								<input type="hidden" id="bamount" name="bamount" />
								<input type="hidden" id="picdate1" name="picdate1" />
								<input type="hidden" id="pictime1" name="pictime1" />
								<input type="hidden" id="adrs1" name="adrs1" value="Hyderguda, Hyderabad, Telangana, India"  required>
								<input type="hidden" id="modelid" name="modelid" />
								<input type="hidden" id="services" name="services" />  
								<input type="hidden" id="bserviceid" name="bserviceid" />
								<div class="form-group">
									<!-- <a class="btn btn-theme btn-theme-dark" href="<?php echo $this->createUrl('mPSVEHICLES_DETAILS/BikeDetails');?>">Cancel</a> -->
									<input type="submit" class="btn ripple-effect btn-theme nextbtn" id="btnsub1" name="summary" value="Next" onClick="return empty()" />
								</div>
							</form>							
                            </div>
                        </div>
                        </div>
                        
                        <!-- widget helping center -->
                        <div class="widget shadow widget-helping-center">
                            <h4 class="widget-title">Helping Center</h4>
                            <div class="widget-content">
                                <p>Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros.</p>
                                <h5 class="widget-title-sub">+91 999 666 44 44</h5>
                                <p><a href="mailto:support@supportcenter.com">support@supportcenter.com</a></p>
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
   /*  $('.vehiclestype').each(function(){
        
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
        }); */
    // services selct options
    
</script>
<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/dist/locationpicker.jquery.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/jquery.geocomplete.js"></script>

<script>
      $(function(){
        $(".geocomplete").geocomplete({
        
          details: "form",
          types: ["geocode", "establishment"],
        });
        //select
        $('.selectpicker').selectpicker();
        $( ".caret" ).wrap( "<div class='form-control-icon'></div>" );
      
      });
</script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/dropdownscript.js"></script>
