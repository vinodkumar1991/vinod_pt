
<div class="card-body">

	<ul class="nav nav-tabs" role="tablist">
		<li class="active"><a
			href="<?php echo Yii::app()->baseurl; ?>/index.php/Vehicles/Vehicles/CategoryBrandModel">Assign
				Vehicle Category</a></li>
		<li><a
			href="<?php echo Yii::app()->baseurl; ?>/index.php/Vehicles/Vehicles/CategoryBrandModelReport">Vehicle
				Category Report</a></li>
	</ul>

	<div class="tab-content">
        <?php
        if (isset($response['code']) && 200 == $response['code']) {
            ?>
            <font color="green"><div id="message">
                <?php
            echo isset($response['message']) ? $response['message'] : NULL;
            ?>
            </div></font>
            <?php
        }
        ?>
        <form class="form-horizontal lcns" method="post"
			enctype="multipart/form-data">
			<!--Vehicle Types :: START-->
			<div class="form-group">
				<label class="col-sm-2 control-label">Vehicle Types</label>
				<div class="col-sm-3">
					<select name='vehicle_type_id' id='vehicle_type_id'
						class="form-control"
						onchange="getBrands(this.value);getVehicleCategories(this.value);makeDynamicDropdowns('vehicle_type')">
						<option value=''>--Select Vehicle Type--</option>
                        <?php
                        if (! empty($vehicle_types)) {
                            foreach ($vehicle_types as $arrVehicle) {
                                ?>
                                <option
							value='<?php echo $arrVehicle['id']; ?>'>
                                    <?php
                                echo $arrVehicle['name'];
                                ?>
                                </option>
                                <?php
                            }
                        }
                        ?>
                    </select> <span id="err_vehicle_type"></span>
				</div>
			</div>
			<!--Vehicle Types :: END-->

			<!--Vehicle Brands :: START-->
			<div class="form-group">
				<label class="col-sm-2 control-label">Vehicle Brands</label>
				<div class="col-sm-3">
					<select name='vehicle_brand_id' id='vehicle_brand_id'
						class="form-control"
						onchange="getVehicleBrandModels(this.value);makeDynamicDropdowns('vehicle_brand')">
						<option value=''>--Select Vehicle Brand--</option>
					</select> <span id="err_vehicle_brand_id"></span>
				</div>
			</div>
			<!--Vehicle Brands :: END-->

			<!--Vehicle Brand Models :: START-->
			<div class="form-group">
				<label class="col-sm-2 control-label">Vehicle Models</label>
				<div class="col-sm-3">
					<select name='vehicle_model_id' id='vehicle_model_id'
						class="form-control">
						<option value=''>--Select Vehicle Model--</option>
					</select> <span id="err_vehicle_model_id"></span>
				</div>
			</div>
			<!--Vehicle Brand Models :: END-->


			<!--Vehicle Categories :: START-->
			<div class="form-group">
				<label class="col-sm-2 control-label">Vehicle Categories</label>
				<div class="col-sm-3">
					<select name='vehicle_category_id' id='vehicle_category_id'
						class="form-control">
						<option value=''>--Select Vehicle Category--</option>
					</select> <span id="err_vehicle_category_id"></span>
				</div>
			</div>
			<!--Vehicle Categories :: END-->



			<!--Form Submit :: START-->
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type='button' class="btn btn-warning"
						name='assign_brand_model_to_category'
						id='assign_brand_model_to_category' value='Assign'
						onclick="assignBrandModelCategory()" />
				</div>
			</div>
			<!--Form Submit :: END-->
		</form>
	</div>
</div>


<script type="text/javascript">
function assignBrandModelCategory(){

        var objInputs ={
                 vehicle_type_id : $("#vehicle_type_id").val(),
                 vehicle_brand_id : $("#vehicle_brand_id").val(),
                 vehicle_model_id : $("#vehicle_model_id").val(),
                 vehicle_category_id : $("#vehicle_category_id").val()
                };
        $.post('<?php echo Yii::app()->params['adminWebURL'].'vehicles/vehicles/saveCategoryInputs';?>',objInputs,function(response){
            alert(response);
            
            });
 }

function getBrands(intVehicleType){
   var objInputs = {
		   vehicle_id : intVehicleType
		   };

   $.post('<?php echo Yii::app()->params['adminWebURL'].'vehicles/vehicles/getVehicleBrands';?>',objInputs,function(response){
	       $("#vehicle_brand_id").select2({placeholder: "--Select Vehicle Brand--"});
	       $("#vehicle_brand_id").html(response);        
	   });
   return true;
	
} 

function getVehicleCategories(intVehicleType){
	   var objInputs = {
			   vehicle_id : intVehicleType
			   };

	   $.post('<?php echo Yii::app()->params['adminWebURL'].'vehicles/vehicles/getVehicleCategories';?>',objInputs,function(response){
		       $("#vehicle_category_id").select2({placeholder: "--Select Vehicle Category--"});
		       $("#vehicle_category_id").html(response);        
		   });
	   return true;
		
	}

function getVehicleBrandModels(intVehicleBrand){
	   var objInputs = {
			   vehicleBrand : intVehicleBrand
			   };

	   $.post('<?php echo Yii::app()->params['adminWebURL'].'vehicles/vehicles/getVehicleBrandModels';?>',objInputs,function(response){
		       $("#vehicle_model_id").select2({placeholder: "--Select Vehicle Model--"});
		       $("#vehicle_model_id").html(response);        
		   });
	   return true;
		
	}

function makeDynamicDropdowns(thing){
	switch (thing) {
    case 'vehicle_type':
    	//Vehicle Model
    	$('#vehicle_model_id').val('').trigger('change');
    	$("#vehicle_model_id").select2({placeholder: "--Select Vehicle Model--"});
    	$("#vehicle_model_id").html("");
    	 
        //Vehicle Brand
    	$('#vehicle_brand_id').val('').trigger('change');
    	$("#vehicle_brand_id").select2({placeholder: "--Select Vehicle Brand--"});
    	$("#vehicle_brand_id").html("");
    	//Vehicle Category
    	$('#vehicle_category_id').val('').trigger('change');
    	$("#vehicle_category_id").select2({placeholder: "--Select Vehicle Category--"});
    	$("#vehicle_category_id").html("");
        break;
    case 'vehicle_brand':
    	//Vehicle Model
    	$('#vehicle_model_id').val('').trigger('change');
    	$("#vehicle_model_id").select2({placeholder: "--Select Vehicle Model--"});
    	$("#vehicle_model_id").html("");
        break;
    }
    return true;
}
</script>