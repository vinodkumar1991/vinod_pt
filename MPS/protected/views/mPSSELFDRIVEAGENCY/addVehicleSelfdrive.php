		

<?php  if(isset($message))
		{
			echo $message;
		}
$user=strtoupper(Yii::app()->user->getState('user'));?>
		<form class="form-horizontal lcns userreg-form" method="POST" action="manageVehicle" enctype="multipart/form-data">
                                        <div class="row"><h3 class="col-sm-12">Enter Vehicle Details</h3></div>
                                        <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Vehicle ID</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="vehicle_id" name="vehicle_id" value="<?php //echo $user=substr($user, 0, 3); ?>VEH00<?php echo $vehicleuniqueid+1; ?>" readonly>
											</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Brand</label>
                                            <div class="col-md-6">
                                                 <select onChange="getModel(this.value)" id="vmake" name="brand_name" required>
                                                    <option value="">Select Vehicle Maker</option>
                                                    <?php
                    foreach ($vmakelist as $vmake) {
                    	echo "<option value='".$vmake['makes_id']."'>".$vmake['makes_name']."</option>";
                    }
                    ?>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Vehicle Type</label>
                                            <div class="col-md-6">
                                                <select name="vehicle_type" required>
                                                    <option>Select Vehicle Type</option>
                                                    <option value="car">Car</option>
                                                    <option value="bike">Bike</option>
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
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-6">
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
                                        </div>                                        
                                        </div>
                                        <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Variant</label>
                                            <div class="col-md-6">
                                                <select name="variant" required>
                                                    <option value="">Select Variant</option>
                                                    <option value="Petrol">Petrol</option>
                                                    <option value="Diesel">Diesel</option>
                                                </select>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="row"><h3 class="col-sm-12">Vehicle Features</h3></div>
                                        	<div class="row">
	                                        	<div class="col-md-offset-3">
		                                        	<div class="col-md-3">
		                                        		<div class="checkbox">
		                                        			<label><input type="checkbox" name="vehicle_features[]" value="AudioSystem"> Audio System</label>
		                                        		</div>
		                                        	</div>
		                                        	<div class="col-md-3">
		                                        		<div class="checkbox">
		                                        			<label><input type="checkbox" name="vehicle_features[]" value="Bluetooth" > Bluetooth</label>
		                                        		</div>
		                                        	</div>
		                                        	<div class="col-md-3">
		                                        		<div class="checkbox">
		                                        			<label><input type="checkbox" name="vehicle_features[]" value="PowerWindow"> Power Window</label>
		                                        		</div>
		                                        	</div>
		                                        	<div class="col-md-3">
		                                        		<div class="checkbox">
		                                        			<label><input type="checkbox" name="vehicle_features[]" value="GPSnavigationsystem"> GPS navigation system </label>
		                                        		</div>
		                                        	</div>
		                                        	<div class="col-md-3">
		                                        		<div class="checkbox">
		                                        			<label><input type="checkbox" name="vehicle_features[]" value="Localandsatelliteradio"> Local and satellite radio </label>
		                                        		</div>
		                                        	</div>
	                                        	</div>
                                        	</div>
                                        <div class="row"><h3 class="col-sm-12">Package 1</h3></div>
                                        <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Price</label>
                                            <div class="col-md-6">
                                                <input type="text" name="price" class="form-control" id="" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Total Kms</label>
                                            <div class="col-md-6">
                                                <input type="text" name="total_kms" class="form-control" id="" required>
                                            </div>
                                        </div>
                                        </div>
										  <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Location</label>
                                            <div class="col-md-6">
											
                                                <input type="text" class="form-control geocomplete" name="name" />
                                                <input type="hidden" class="form-control" name="location" />
                                               
												
                                            </div>
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Extra Rate Per Kms</label>
                                            <div class="col-md-6">
                                                <input type="text" name="extra_rate_per_kms" class="form-control" id="" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Price Per Hour</label>
                                            <div class="col-md-6">
                                                <input type="text" name="price_per_hour"class="form-control" id="" required>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Security Deposit</label>
                                            <div class="col-md-6">
                                                <input type="text" name="security_deposit" class="form-control" id="" required>
                                            </div>
                                        </div>                                        
                                        </div>
										  <div class="col-md-6">
                                            <label class="col-md-6 control-label">Add Your Vehicle Image</label>
                                            <div class="col-md-6">
                                                <input type="file" name="vehicle_image" class="form-control" id="" required>
                                            </div>
                                        </div> 
										<div class="col-md-6">
                                            <label class="col-md-6 control-label">Add Multiple Vehicle Images</label>
                                            <div class="col-md-6">
                                                <input type="file" name="vehicle_images[]" class="form-control" id="" multiple>
                                            </div>
                                        </div>  	
										
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-6 col-sm-6">
                                                <button type="submit" class="btn btn-warning" name="add_vehicle" value="add">Add Vehicle</button>
                                            </div>
                                        </div>
                </form>
				
<script>jQuery(document).ready(function()
		{
			
  $(".geocomplete").geocomplete({
        
          details: "form",
          types: ["geocode", "establishment"],
        });
		});
function getModel(makerId)
{
	$.post('../site/Getvmodel',{
		Maker:makerId,
	},
	function(data)
	{ 
		
		
		$("#vmodel").html("");
		$("#vmodel").append(data);
	});
}
</script>