<script>
function checkper(repid,pakageid)
{
	
	cat_id=$('#cat_id').val();
	
	name=repid+''+pakageid;
	
	if(document.getElementById(name).checked == true)
							{
								
								$.post('../site/InsertStatusofperiodic',{
					  
						
						repid:repid,
						pakageid:pakageid,
						status:1,
						cat_id:cat_id
						
						
						
					},
					function(data)
					{
						//alert(data);	 
						periid=$("#serper").val();
						
						
			
			     $.post('../site/TypePeriodicService',
											{
										
											    repid:repid,
												periid:periid,
												
											},
										function(data)
										{
											//alert(data);
										$('#td1').html(data);
										
										});    
					});
							}
	else  {
		
		$.post('../site/InsertStatusofperiodic',{
					  
						
						repid:repid,
						pakageid:pakageid,
						status:2
						
						
						
					},
					function(data)
					{
						//alert(data);	 
						periid=$("#serper").val();
			    $.post('../site/TypePeriodicService',
											{
						  
											repid:repid,
											periid:periid
											},
										function(data)
										{
											//alert(data);
										$('#td1').html(data);
										
										});   
					});
	}
	
	
}
function check(id)
{ 
	var name='id'+id;
	 servicesid=$('#services').val();
	
	periid=$("#serper").val();
	
	var value = document.getElementById(name).value;
	
	 if(document.getElementById(name).checked == true)
		{
			//alert(periid);
					$.post('../site/updatepackages',{
					  
						
						servicesid:servicesid,
						id:value,
						periid:periid
						
						
					},
					function(data)
					{
						//alert(data);	 
					});
					   
					 
					  values=$('#cat_id').val();
					  servicesid=$('#services').val();
						//alert(value);
						$.post('../site/amountCalculation',{
						servicesid:servicesid,
						id:values
						
					},
					function(data)
					{
						//alert(data);
										var data=JSON.parse(data);
										if(data['plan']=='general')
															{
															//alert("Total This package"+data);
															$(".basic").text("Basic :"+data['basic']);
															$(".elite").text("Elite :"+data['elite']);
															$(".advanced").text("Advanced :"+data['adv']); 
															$(".one").text('');
															$(".two").text('');
															$(".three").text('');
															}
															else{
																
																$(".basic").text("10000 KM :"+data['Ten']);
															$(".elite").text("20000 KM :"+data['twenty']);
															$(".advanced").text("30000 KM :"+data['thirty']); 
															$(".one").text("40000 KM :"+data['fourty']); 
															$(".two").text("50000 KM :"+data['fifty']);
															$(".three").text("60,0000 KM :"+data['sixty']);  					 															
															}
					}); 
		}
		else if(document.getElementById(name).checked == false)
		{
			 //value=$('#cat_id').val();
			 //alert("unchecked");
			 values=$('#cat_id').val();
			 servicesid=$('#services').val();
			 //alert(servicesid);
			
			$.post('../site/uncheckpackages',{
					  
						servicesid:servicesid,	
						id:value
						
					},
					function(data)
					{
							//alert(data);
					});
					// return false;
					
					
					$.post('../site/amountCalculation',{
								  
									servicesid:servicesid,
									id:values
								},
								function(data)
								{
									//alert(data);
									var data=JSON.parse(data);
											
											//alert("Total This package"+data);
											if(data['plan']=='general')
															{
															//alert("Total This package"+data);
															$(".basic").text("Basic :"+data['basic']);
															$(".elite").text("Elite :"+data['elite']);
															$(".advanced").text("Advanced :"+data['adv']);  
															$(".one").text('');
															$(".two").text('');
															$(".three").text('');
															}
															else{
																
																$(".basic").text("10000 KM :"+data['Ten']);
															$(".elite").text("20000 KM :"+data['twenty']);
															$(".advanced").text("30000 KM :"+data['thirty']);  
															$(".one").text("40000 KM :"+data['fourty']); 
															$(".two").text("50000 KM :"+data['fifty']);	
															$(".three").text("60,0000 KM :"+data['sixty']);															
															}
								});  
		}

}
	$(document).ready(function() 
	{
		
		$(".geocomplete").geocomplete({
        
          details: "form",
          types: ["geocode", "establishment"],
        });
		
		$("#serper").change(function(){
			
			servicesid=$("#services").val();
				periid=$("#serper").val();
				cat_id=$("#cat_id").val();
			  $.post('../site/TypePeriodicService',
											{
						  
											
												periid:periid,
												cat_id:cat_id
											},
										function(data)
										{
											//alert(data);
										$('#td1').html(data);
										
										}); 
		}); 

					$("#typeperiodic").hide();
					$.post('../site/Service',
											{
						  
												servicesid:1,

											},
										function(data)
										{
										//alert(data);
										$('#td1').html(data);
										}); 
										
					$("#services").change(function(){
					
					servicesid=$("#services").val();
					//alert(servicesid);
					if(servicesid==2)
					{
						$("#typeperiodic").show();
					}
					if(servicesid==1)
					{
						
						$("#typeperiodic").hide();
					}
					$.post('../site/Service',
											{
						  
												servicesid:servicesid
											},
										function(data)
										{
										//alert(data);
										
										value=$('#cat_id').val();
										
														 $.post('../site/amountCalculation',
															{
																servicesid:servicesid,
																id:value
																
															},
														function(data)
														{
															//alert(data);
															 var data=JSON.parse(data);
															//alert(data['plan']);
															if(data['plan']=='general')
															{
															//alert("Total This package"+data);
															$(".basic").text("Basic :"+data['basic']);
															$(".elite").text("Elite :"+data['elite']);
															$(".advanced").text("Advanced :"+data['adv']);  
															$(".one").text('');
															$(".two").text('');
															$(".three").text('');
															}
															else{
																
																$(".basic").text("10000 KM :"+data['Ten']);
															$(".elite").text("20000 KM :"+data['twenty']);
															$(".advanced").text("30000 KM :"+data['thirty']);  
															$(".one").text("40000 KM :"+data['fourty']); 
															$(".two").text("50000 KM :"+data['fifty']);	
															$(".three").text("60,0000 KM :"+data['sixty']);															
															}
														});  
														
											$('#td1').html(data);
										}); 


});
		 
					/* $("#cat_id").change(function(){
										
	  
			}); */
	});

</script>
                                      <ul class="nav nav-tabs" role="tablist">
                                        <li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/createService">Create Repair</a></li>
                                        <li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/Repairlist">Repair List</a></li>
                                        <li  class="active"><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/Servicepackagelist">Service Package List</a></li>
                                   <li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/BikeList/bikepackagelist">Bike Package List</a></li>
                                 
								  </ul>

                                    <div class="tab-content servicepack-wrapper">                                  
                                    <div class="table-responsive">
                                    <div class="col-md-4">
                                            <label class="col-sm-5 control-label">Select Category</label>
                                            <div class="col-sm-7">
                                                <select name="vehicle_category" id="cat_id">
                                                    <option>Select Category</option>
                                                    <?php foreach($categories as $service) { ?>
													<option value="<?php echo $service['id']; ?>"><?php echo $service['categoryname']; ?></option>
													<?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="col-sm-4 control-label">Select Type of Service</label>
                                            <div class="col-sm-4">
                                                <select name="services" id="services">
                                                    <option>Select Service</option>
                                                    <?php foreach($services as $service) { ?>
													<option value="<?php echo $service['id']; ?>"><?php echo $service['servicenames']; ?></option>
													<?php } ?>
                                                </select>
												</div>
												 <div class="col-sm-6">
											<strong><span class="basic"></span></strong> <?php echo "&nbsp;&nbsp;"; ?>
											<strong><span class="elite"></strong><?php echo "&nbsp;&nbsp;"; ?>
                                           <strong><span class="advanced"></strong>
										    <strong><span class="one"></strong>
											 <strong><span class="two"></strong>
											  <strong><span class="three"></strong>
										   
										   
										   
                                        </div>
									
										
                                    </div>
									  <div class="col-md-2" id="typeperiodic">
                                            <label class="col-sm-3 control-label">Set Periodic Service</label>
                                            <div class="col-sm-4">
                                                <select name="serper" id="serper">
                                                    <option>Select Service</option>
													<option value="4">Recommended Services</option>
													<option value="5">Normal</option>
													</option>
													</select>
												</div>
											</div>
									<table class="table responsive" cellspacing="0" width="100%" border="1">
								<div id="td1">
                                  <?php //echo $html; ?>
								</div>
                                    </div>