<script>

$(document).ready(function()
{ 
		//update row with ajax
	$("#add_vehicle" ).click(function() {
			
			var id=$('#id').val();
		
		
			var price_per_hour=$('#price_per_hour').val();
			var price=$('#price').val();
			var security_deposit=$('#security_deposit').val();
			var total_kms=$('#total_kms').val();
			var extra_rate_per_kms=$('#extra_rate_per_kms').val();
			
			
			
			
			$.post('../MPSSELFDRIVEAGENCY/updateVehicleList',
						{
						   id:id,
						  
						   price_per_hour:price_per_hour,
						   price:price,
						   security_deposit:security_deposit,
						   total_kms:total_kms,
						   extra_rate_per_kms:extra_rate_per_kms,
						  
						},
						function(data)
						{
							
							alert(data);
							var form=document.createElement('form');
							form.setAttribute('method','post');
							form.setAttribute('action','../MPSSELFDRIVEAGENCY/VehicleList');
							document.body.appendChild(form);
							form.submit();
							$('#updatevehicle').hide();
							
						}); 
	});
		
	
	// open popup and getting details
	$( ".clickbtn" ).click(function() {
 
		$('#id').val($(this).attr('id'));
		var edata=$(this).attr('id');
		
			$.post('../MPSSELFDRIVEAGENCY/editVehicleList',{
		  
			id:edata
		},
		function(data)
		{
					var data=JSON.parse(data);
					
					$('#vehicle_id').val(data[0]['vehicle_id']);			
						$('#seating_capacity').val(data[0]['seating_capacity']);
					
					  $('#MySelect option')
					.filter(function() { return jQuery.trim( $(this).text() ) == 'bike'; })
					.attr('selected',true);
					var mystring =data[0]['vehicle_features'];
					var splittable = mystring.split(',');
					
					string1 = splittable[0];
					string2 = splittable[1];
				
					$('.modal').find('input[type="checkbox"]').each(function()
					{
						   var state = $.inArray(this.value,splittable)!=-1;
						   $(this).prop('checked', state);
					});
					code = $('.vehicle_features').val();
					
					$("#selected").val(splittable); 
					$('#price_per_hour').val(data[0]['price_per_hour']);
					$('#price').val(data[0]['price']);
					$('#total_kms').val(data[0]['total_kms']);
					$('#extra_rate_per_kms').val(data[0]['extra_rate_per_kms']);
					$('#security_deposit').val(data[0]['security_deposit']);
        });
		
	});
});

function deletep(id)
{
	var edata=id;
	
	var con=confirm("Are you sure you want to delete!");
	if(con==true)
	{
       $.post('../MPSSELFDRIVEAGENCY/DeleteSelfdriveVehicle',{
		  
			id:edata
		},
		function(data)
		{
			
           var form=document.createElement('form');
			form.setAttribute('method','post');
			form.setAttribute('action','../MPSSELFDRIVEAGENCY/VehicleList');
			document.body.appendChild(form);
			form.submit();
        });
		
   }
}   
$( document ).ready(function() {
	
setTimeout(function() {
    $('.success').fadeOut('fast');
}, 1300);
});

</script>
<?php 
									if(isset($message))
									{?>
										<div class="success"><?php echo $message; ?></div><?php
									}
										?>
                                         <div class="table-responsive">
                                    <table class="datatable table table-striped" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Sl No.</th>
                                                <th>Vehicle Id</th>
                                                <th>Vehicle Type</th>
                                                <th>Vehicle Brand</th>
                                                 <th>Vehicle Model</th>
                                                <th>Vehicle Category</th>                                                                                 
                                                <th>Variant</th>
                                                <th>Vehicle Features</th>
                                                <th>price/Total kms</th>
                                                <th>Extra Rate Per Kms/Price Per Hour</th>
                                                <th>Security Deposit</th>											
												 <th>Created Date</th>
												 <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                              <?php
											  
											  $i=1;
                    foreach ($self_details as $self_detail) {
                    	
                                              
											   echo ' <tr>';
											   echo ' 
											    <td>'.$i.'</td>
											   <td>'.$self_detail['vehicle_id'].'</td>
											   <td>'.$self_detail['vehicle_type'].'</td>
											    <td>'.$self_detail['makes_id'].'</td>
											     <td>'.$self_detail['model_id'].'</td>
											   <td>'.$self_detail['vehicle_category'].'</td>
											    <td>'.$self_detail['variant'].'</td>
											    <td>'.$self_detail['vehicle_features'].'</td>
												<td>'.$self_detail['price'].'/'.$self_detail['total_kms'].'</td>							
												<td>'.$self_detail['extra_rate_per_kms'].'/'.$self_detail['price_per_hour'].'</td>
												 <td>'.$self_detail['security_deposit'].'</td>												
												<td>'.date('d-m-Y',strtotime($self_detail['created_date'])).'</td>
												<td><a data-toggle="modal" data-target="#updatevehicle" title="edit" id="'.$self_detail['id'].'" class="clickbtn edit-u"><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                                                    <a href="#" title="Trash" class="delete-u" onclick="deletep('.$self_detail['id'].');" ><i class="fa fa-trash" aria-hidden="true"></i></a></td>';
											   echo '</tr>';
											   $i++;
                                               
                    }
					

					
                    ?>   
                                        </tbody>
                                    </table>
                                    </div>

<div id="updatevehicle" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Delivery Boy</h4>
      </div>
      <div class="modal-body">
        <!-- Delivery Boy Form -->
                                       <form class="form-horizontal lcns " enctype="multipart/form-data" action="VehicleList" method="POST">
                                        <div class="row"><h3 class="col-sm-12">Enter Vehicle Details</h3></div>
                                        <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Vehicle ID</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="vehicle_id" name="vehicle_id" value="" readonly>
                                                <input type="hidden" class="form-control" id="id" name="id">
                                               
											</div>
                                        </div>
                                     <!--   <div class="col-md-6">
                                            <label class="col-md-6 control-label">Brand</label>
                                            <div class="col-md-6">
                                                 <select onChange="getModel(this.value)" id="vmake" name="brand_name" required>
                                                    <option value="">Select Vehicle Maker</option>
                                                 
                                                    
                                                </select>
                                            </div>
                                        </div> -->
                                        </div>
                                        <div class="row">
                                   <!-- <div class="col-md-6">
                                            <label class="col-md-6 control-label">Vehicle Type</label>
                                            <div class="col-md-6">
                                                <select id="MySelect" name="options">
												
                                                    <option value="car">car</option>
                                                    <option value="bike">bike</option>
                                                    <option value="ffg">dgf</option>
                                                    <option value="ffg">cxc</option>
                                                </select>
                                            </div>
                                        </div>                                        
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Model</label>
                                            <div class="col-md-6">
                                                 <select id="vmodel" name="model_name" required>
                                                    <option value="">Select Vehicle Model</option>
                                                   
                                                </select>
                                                <span id="vmodelerr" style="color:red;display: none;">Please select Model</span>
                                           
                                            </div>
                                        </div>-->
                                        </div>
                                        <div class="row">
                                      <!--  <div class="col-md-6">
                                            <label class="col-md-6 control-label">Category</label>
                                            <div class="col-md-6">
                                                <select name="vehicle_category" required>
                                                    <option value="">Select Category Type</option>
                                                    <option value="economic">Economic</option>
                                                    <option value="business">Business</option>
                                                    <option value="premium">Premium</option>
                                                    <option value="luxury">Luxury</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Seating Capacity</label>
                                            <div class="col-md-6">
                                                <select name="seating_capacity" required>
                                                    <option value="">Select Seating Capacity</option>
                                                    <option value="4">1 to 4</option>
                                                    <option value="6">4 to 6</option>
                                                    <option value="10">6 to 10</option>
                                                    <option value="10plus">10 plus</option>
                                                </select>
                                            </div>
                                        </div>        -->                                
                                        </div>
                                        <div class="row">
                                       <!-- <div class="col-md-6">
                                            <label class="col-md-6 control-label">Variant</label>
                                            <div class="col-md-6">
                                                <select name="variant" required>
                                                    <option value="">Select Variant</option>
                                                    <option value="Petrol">Petrol</option>
                                                    <option value="Diesel">Diesel</option>
                                                </select>
                                            </div>
                                        </div> -->
                                        </div>
                                        <div class="row"><h3 class="col-sm-12">Vehicle Features</h3></div>
                                        	<div class="row">
	                                        	<div class="col-md-offset-3">
		                                        	<div class="col-md-3">
		                                        		<div class="checkbox">
		                                        			<label><input type="checkbox"  name="vehicle_features[]" class="vehicle_features" value="AudioSystem"> Audio System</label>
		                                        		</div>
		                                        	</div>
		                                        	<div class="col-md-3">
		                                        		<div class="checkbox">
		                                        			<label><input type="checkbox"  name="vehicle_features[]" class="vehicle_features" value="Bluetooth" > Bluetooth</label>
		                                        		</div>
		                                        	</div>
		                                        	<div class="col-md-3">
		                                        		<div class="checkbox">
		                                        			<label><input type="checkbox"  name="vehicle_features[]" class="vehicle_features" value="PowerWindow"> Power Window</label>
		                                        		</div>
		                                        	</div>
		                                        	<div class="col-md-3">
		                                        		<div class="checkbox">
		                                        			<label><input type="checkbox"  name="vehicle_features[]" class="vehicle_features" value="GPSnavigationsystem"> GPS navigation system </label>
		                                        		</div>
		                                        	</div>
		                                        	<div class="col-md-3">
		                                        		<div class="checkbox">
		                                        			<label><input type="checkbox" name="vehicle_features[]" class="vehicle_features" value="Localandsatelliteradio"> Local and satellite radio </label>
		                                        		</div>
		                                        	</div>
	                                        	</div>
                                        	</div>
                                        <div class="row"><h3 class="col-sm-12">Package 1</h3></div>
                                        <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Price</label>
                                            <div class="col-md-6">
                                                <input type="text" id="price" name="price" class="form-control" id="" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Total Kms</label>
                                            <div class="col-md-6">
                                                <input type="text" id="total_kms" name="total_kms" class="form-control" id="" required>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Extra Rate Per Kms</label>
                                            <div class="col-md-6">
                                                <input type="text" id="extra_rate_per_kms" name="extra_rate_per_kms" class="form-control" id="" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Price Per Hour</label>
                                            <div class="col-md-6">
                                                <input type="text" id="price_per_hour" name="price_per_hour"class="form-control" id="" required>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Security Deposit</label>
                                            <div class="col-md-6">
                                                <input type="text" id="security_deposit" name="security_deposit" class="form-control" id="" required>
                                            </div>
                                        </div>                                        
                                        </div>
										<!--  <div class="col-md-6">
                                            <label class="col-md-6 control-label">Add Your Vehicle Image</label>
                                            <div class="col-md-6">
                                                <input type="file" name="vehicle_image" class="form-control" id="" required>
                                            </div>
                                        </div>   -->                                      
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-6 col-sm-6">
                                                <input type="submit" class="btn btn-warning" name="update_vehicle" value="update" / >
                                            </div>
                                        </div>
                </form>
										
                                        <!-- End Delivery Boy Form -->
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> -->
    </div>

  </div>
