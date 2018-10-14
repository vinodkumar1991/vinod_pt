<link href="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

<script src="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/datetimepicker/js/moment-with-locales.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

<script>
$(document).ready(function()
{
	$( ".clickbtn" ).click(function() {
 
		$('#hiddenvehicleid').val($(this).attr('id'));
		var id=$(this).attr('id');
		 $.post('../MPSSELFDRIVEAGENCY/UpdateVehicleTime',
						{
						   id:id,
						},
						function(data)
						{
							
							var data=JSON.parse(data);
					
							$('#startdate').val(data[0]['from_date']);
							$('#enddate').val(data[0]['to_date']);
							
							/*  var form=document.createElement('form');
							form.setAttribute('method','post');
							form.setAttribute('action','../MPSSELFDRIVEAGENCY/VehicleList');
							document.body.appendChild(form);
							form.submit();
							$('#updatevehicle').hide();  */
							
						}); 

	});
});

function deletep(id)
{
	var edata=id;
	
	var con=confirm("Are you sure you want to delete!");
	if(con==true)
	{
       $.post('../MPSSELFDRIVEAGENCY/Deleteself',{
		  
			id:edata
		},
		function(data)
		{
			
           var form=document.createElement('form');
			form.setAttribute('method','post');
			form.setAttribute('action','../MPSSELFDRIVEAGENCY/FetchSelfDrivedata');
			document.body.appendChild(form);
			form.submit();
        });
   }
}   
$( document ).ready(function() {
	
setTimeout(function() {
    $('.success').fadeOut('fast');
}, 1300);


	 $('#startdate').datetimepicker({  minDate: moment(1, 'h') });
	 $('#enddate').datetimepicker({   minDate: moment(1, 'h') });

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
                                             <!--  <th>Vehicle Features</th>   <th>Vehicle Brand</th>
                                                 <th>Vehicle Model</th> /*    <td>'.$self_detail['vehicle_features'].'</td><td>'.$self_detail['brand_name'].'</td>
											     <td>'.$self_detail['model_name'].'</td> */ -->
                                                <th>Vehicle Category</th>                                                                                 
                                                <th>Variant</th>
                                              
                                                <th>price/Total kms</th>
                                                <th>Extra Rate Per Kms/Price Per Hour</th>
                                                <th>Security Deposit</th>											
												 <th>From Date</th>
												 <th>To Date</th>
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
											 
											   <td>'.$self_detail['vehicle_category'].'</td>
											    <td>'.$self_detail['variant'].'</td>
											   
												<td>'.$self_detail['price'].'/'.$self_detail['total_kms'].'</td>							
												<td>'.$self_detail['extra_rate_per_kms'].'/'.$self_detail['price_per_hour'].'</td>
												 <td>'.$self_detail['security_deposit'].'</td>												
												<td>'.date('d-m-Y H:i:s',$self_detail['from_date']).'</td>
												<td>'.date('d-m-Y H:i:s',$self_detail['to_date']).'</td>';
												if($self_detail['status']==0)
												{
												echo '<td><a href="#updateavailable"  data-toggle="modal" id="'.$self_detail['id'].'" title="edit" class="btn btn-success clickbtn">Available</a> 
                                                    </td>';
												}else
												{
													echo '<td><a href="#"   class="btn btn-warning clickbtn">Booked</a> 
                                                    </td>';
												}
											   echo '</tr>'; 
											   $i++;
                             ?>  <div id="updateavailable" class="modal fade">
				        <div class="modal-dialog">
				            <div class="modal-content">
				                <div class="modal-header">
				                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                    <h4 class="modal-title">Update Vehicle Status</h4>
				                </div>
				                <div class="modal-body">
				                  

							    <form class="form-horizontal" action="update_vehicle_details" method="POST">
							    <div class="row">
									<div class="form-group">
											<input type="hidden" name="id" id="hiddenvehicleid"/>
							            <label for="available-from" class="control-label col-xs-3">Available From</label>

							            <div class="col-xs-6">

							                <input type="text" class="form-control" name="from_date" id="startdate" placeholder="Picup From Date" style="margin-bottom:10px;">

							            </div>

							        </div>    	
							    </div>
							    <div class="row">
							        <div class="form-group">

							            <label for="available-to" class="control-label col-xs-3">Available To</label>

							            <div class="col-xs-6">

							                <input type="text" class="form-control" name="to_date" id="enddate" placeholder="Picup End Date">

							            </div>

							        </div>
							    </div>

							  

  
				                </div>
				                <div class="form-group col-md-offset-4">
				                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				                    <button type="submit" class="btn btn-primary" name="update" value="update">Upadte</button>
				                </div>
								  </form>
				            </div>
				        </div>
				    </div><?php                  
                    }
					

					
                    ?> 
                    
                                        </tbody>
                                    </table>
                                    </div>
	<!-- Edit popup -->
	