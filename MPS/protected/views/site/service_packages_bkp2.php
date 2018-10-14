<script>

function check(id)
{ 
	var name='id'+id;
	
	var value = document.getElementById(name).value;
	 if(document.getElementById(name).checked == true)
		{
		   alert("checked");
					$.post('../site/updatepackages',{
					  
						id:value
					},
					function(data)
					{
							 
   
	    
  

					  /*  var form=document.createElement('form');
						form.setAttribute('method','post');
						form.setAttribute('action','../MPSSELFDRIVEAGENCY/FetchSelfDrivedata');
						document.body.appendChild(form);
						form.submit(); */
					});
					value=$('#cat_id').val();
						//alert(value);
						$.post('../site/amountCalculation',{
					  
						id:value
					},
					function(data)
					{
						
										var data=JSON.parse(data);
											
											//alert("Total This package"+data);
											$(".basic").text("Basic:"+data['basic']);
											$(".elite").text("Elite"+data['elite']);
											$(".advanced").text("Advanced"+data['adv']);
					});
		}
		else
		{
			alert("unchecked");
			$.post('../site/uncheckpackages',{
					  
						id:value
					},
					function(data)
					{
						
						
					  /*  var form=document.createElement('form');
						form.setAttribute('method','post');
						form.setAttribute('action','../MPSSELFDRIVEAGENCY/FetchSelfDrivedata');
						document.body.appendChild(form);
						form.submit(); */
					});
					value=$('#cat_id').val();
	 
					$.post('../site/amountCalculation',{
								  
									id:value
								},
								function(data)
								{
									//alert("Total This package"+data);
									//$("#basic").text(data);
									var data=JSON.parse(data);
											
											//alert("Total This package"+data);
											$(".basic").text("Basic:"+data['basic']);
											$(".elite").text("Elite"+data['elite']);
											$(".advanced").text("Advanced"+data['adv']);
								});
		}

}
	$(document).ready(function() 
	{
		 
					$("#cat_id").change(function(){
										value=$('#cat_id').val();
										
										$.post('../site/amountCalculation',
											{
						  
												id:value
											},
										function(data)
										{
											var data=JSON.parse(data);
											
											//alert("Total This package"+data);
											$(".basic").text("Basic:"+data['basic']);
											$(".elite").text("Elite"+data['elite']);
											$(".advanced").text("Advanced"+data['adv']); 
										}); 
	  
			});
	});

</script>
                                      <ul class="nav nav-tabs" role="tablist">
                                        <li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/createService">Create Repair</a></li>
                                        <li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/Repairlist">Repair List</a></li>
                                        <li  class="active"><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/Servicepackagelist">Service Package List</a></li>
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
                                            <label class="col-sm-2 control-label">Select Type of Service</label>
                                            <div class="col-sm-4">
                                                <select name="services" id="services">
                                                    <option>Select Service</option>
                                                    <?php foreach($services as $service) { ?>
													<option value="<?php echo $service['id']; ?>">
													<?php echo $service['servicenames']; ?></option>
													<?php } ?>
                                                </select>
												</div>
												 <div class="col-sm-6">
											<strong><span class="basic"></span></strong> <?php echo "&nbsp;&nbsp;"; ?>
											<strong><span class="elite"></strong><?php echo "&nbsp;&nbsp;"; ?>
                                           <strong><span class="advanced"></strong>
                                        </div>
									
										
                                    </div>
									
                                  <?php echo $html; ?>
                                    </div>
                                    </div>