<!--<link href="<?php //echo Yii::app()->request->baseUrl; ?>/admin/lib/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

<script src="<?php //echo Yii::app()->request->baseUrl; ?>/admin/lib/datetimepicker/js/moment-with-locales.min.js"></script>
<script src="<?php //echo Yii::app()->request->baseUrl; ?>/admin/lib/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>-->
<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min.js"></script>


<?php 
									//if(isset($message))
									//{?>
										<div class="success"><?php //echo $message; ?></div><?php
									//}
										?>
                                         <div class="table-responsive">
                                    <table class="datatable table table-striped" cellspacing="0" width="100%" id="example">
                                        <thead>
                                            <tr>
                                          <th>Sl No.</th>
                                          <th>Order No</th>
                                          <th>Vehicle Id</th>
                                          <th>Vehicle Type</th>
                                          <th>Vehicle Category</th>                                                                                 
                                          <th>Variant</th>
                                          <th>Vehicle Features</th>
                                          <th>Security Deposit</th>	
                                          <th>From Date</th>	
                                          <th>To Date</th>	
                                          <th>Actions</th>
												<!-- <th>Created Date</th>-->
												 
                                            </tr>
                                        </thead>
                                        <tbody>
                                              <?php
											  
											  $i=1;
                                                                                          $j =0;
                    foreach ($VehicleDetails as $VehicleDetail) {
                    	
                                              
											   echo ' <tr>';
											   echo ' 
											    <td>'.$i.'</td>
											     <td>'.$VehicleDetail['order_no'].'</td>
											   <td>VEH'.$VehicleDetail['id'].'</td>
                                                                                                   <td>Car</td><td>'.$VehicleDetail['VehicleCategory'].'</td><td>Petrol</td><td>'.$FeatureDetails[$j][0]['Features'].'</td><td>'.$VehicleDetail['deposit'].'</td><td>'.$VehicleDetail['from_date'].'</td><td>'.$VehicleDetail['to_date'].'</td>';
                                                                                           if($VehicleDetail['status'] < 1)
                                                                                           {
                                                                                               ?>
                                                                                                <td><a href="#updateavailable"  data-toggle="modal" id="<?php echo $VehicleDetail['id']; ?>" title="edit" class="btn btn-success clickbtn">Available</a></td>
                                                                                               <?php
                                                                                               
                                                                                           }
                                                                                            else {
                                                                                           ?>
                                                                                                 <td><a href="#" class="btn btn-warning clickbtn">Booked</a> </td>
											  <?php
											 echo '</tr>';
									$i++;
                                                       $j++;
                                               
                    }
					
                    }
					
                    ?>   
                                        </tbody>
                                      <!--  <a data-toggle="modal" data-target="#updatevehicle" title="edit" id="'.$VehicleDetail['id'].'" class="clickbtn edit-u"><i class="fa fa-pencil" aria-hidden="true"></i></a>					 
                                                    <a href="#" title="Trash" class="delete-u" onclick="deletep('.$VehicleDetail['id'].');" ><i class="fa fa-trash" aria-hidden="true"></i></a></td>-->
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
                                   
                                            
                                        </div>
                                        <div class="row">
                                 
                                            
                                        </div>
                                        <div class="row">
                                    
                                            
                                        </div>
                                        <div class="row">
                                      
                                            
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
                                                <input type="submit" class="btn btn-warning" name="update_vehicle" value="update"/>
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
     <div id="updateavailable" class="modal fade">
				        <div class="modal-dialog">
				            <div class="modal-content">
				                <div class="modal-header">
				                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                    <h4 class="modal-title">Update Vehicle Status</h4>
				                </div>
				                <div class="modal-body">
				                  

							    <form class="form-horizontal" action="" method="POST">
							    <div class="row">
									<div class="form-group">
											<input type="hidden" name="id" id="hiddenvehicleid"/>
							            <label for="available-from" class="control-label col-xs-3">Available From</label>

							            <div class="col-xs-6">

							              <!--  <input type="text" class="form-control" name="from_date" id="startdate" placeholder="Pickup From Date" style="margin-bottom:10px;">-->
                                 <input type="text" class="input-group date form_datetime form-control" name="from_date" id="startdate" value="">

							            </div>

							        </div>    	
							    </div>
							    <div class="row">
							        <div class="form-group">

							            <label for="available-to" class="control-label col-xs-3">Available To</label>

							            <div class="col-xs-6">

							              <!--  <input type="text" class="form-control" name="to_date" id="enddate" placeholder="Pickup End Date">-->
                                                                    <input type="text" class="input-group date form_datetime form-control" name="to_date" id="enddate" value="">

							            </div>

							        </div>
							    </div>

							  

  
				                </div>
				                <div class="form-group col-md-offset-4">
				                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				                    <button type="button" class="btn btn-primary update_veh" name="btnupdateveh" id="btnupdateveh" value="update">Update</button>
				                </div>
								  </form>
				            </div>
				        </div>
				    </div>
