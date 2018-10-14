

<script>
	$(document).ready(function()
			{
				


$('#show_cat').hide();
	$("#example").on("click", ".btnsub2", function(){
	// $('.btnsub2').click(function() 
						//{
							
							 data=$(this).attr('id');
							
						    datas=data.split('**');
							makesid=datas[0];
							modelid=datas[1];
							status=datas[2];
							
							$.post('activeVehicles',{
											vmakeid:makesid,
											modelid:modelid,
											status:status
											
											
										},
										function(data)
										{
											location.reload();
 
										});
						}); 
						$('.btnupdate').click(function() 
						{
							
									data=$(this).attr('id');
									
									datas=data.split('**');
									makesid=datas[0];
									modelid=datas[1];
								$('#makes_id_hid').val(makesid);
								$('#model_id_hid').val(modelid);
								
								
						});		


								$('#btnupdate').on('click',function() 
								{
									vmakeid=$('#makes_id_hid').val();
									modelid=$('#model_id_hid').val();
									cate_id=$('#cate').val();
									$.post('UpadateCategory',{
											
											vmakeid:makesid,
											modelid:modelid,
											cate_id:cate_id
											
										},
										function(data)
										{
											$('#show_cat').show();
											location.reload();
										});
								});
				});
				
	</script>

						<?php // var_dump($_GET['id']);  ?>
                                    <div class="tab-content">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/vehicle">Add Vehicle</a></li>
                                        <li class="active"><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/vehiclelist?id=1">Vehicle List</a></li>
                                       <!-- <li class="active"><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/Map">Map</a></li> -->
                                    </ul>
                                    </div>
                                    <div class="tab-content">
									<div id="show_cat">Category Updated Sucessfully</div>
                                        <ul class="nav nav-tabs"><?php if(isset($_GET['id'])) { ?>
                                            <li <?php if($_GET['id']==1) { ?>class="active" <?php } ?>><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/vehiclelist?id=1">Hatchback</a></li>
											
											<li <?php if($_GET['id']==5) { ?>class="active" <?php } ?>><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/vehiclelist?id=5">Hatchback Pro</a></li>
											<li <?php if($_GET['id']==9) { ?>class="active" <?php } ?>><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/vehiclelist?id=9">Hatchback Advance</a></li>
											
                                            <li <?php if($_GET['id']==2) { ?>class="active" <?php } ?>><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/vehiclelist?id=2">Sedan</a></li>  
 <li <?php if($_GET['id']==6) { ?>class="active" <?php } ?>><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/vehiclelist?id=6">Sedan Pro</a></li>  

 <li <?php if($_GET['id']==10) { ?>class="active" <?php } ?>><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/vehiclelist?id=10">Sedan Advance</a></li>  
 
                                            <li <?php if($_GET['id']==3) { ?>class="active" <?php } ?>><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/vehiclelist?id=3">Suv/Luv</a></li>
											
				<li <?php if($_GET['id']==7) { ?>class="active" <?php } ?>><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/vehiclelist?id=7">Suv/Luv Pro</a></li>
							<li <?php if($_GET['id']==11) { ?>class="active" <?php } ?>><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/vehiclelist?id=11">Suv/Luv Advanced</a></li>
											  
											
				 <li <?php if($_GET['id']==4) { ?>class="active" <?php } ?>><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/vehiclelist?id=4">luxury</a></li>
				  <li <?php if($_GET['id']==8) { ?>class="active" <?php } ?>><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/vehiclelist?id=8">luxury Pro</a></li>
				   <li <?php if($_GET['id']==12) { ?>class="active" <?php } ?>><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/vehiclelist?id=12">luxury Advance</a></li>
										<?php }else{ ?>
										
										 <li class="active"><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/vehiclelist?id=1">Hatchback</a></li>
										 <li class=""><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/vehiclelist?id=5">Hatchback Pro</a></li>
										 <li class=""><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/vehiclelist?id=9">Hatchback Advance</a></li>
										 
										 
										 <li ><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/vehiclelist?id=2">Sedan</a></li>
										  <li ><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/vehiclelist?id=6">Sedan Pro</a></li>
										   <li ><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/vehiclelist?id=10">Sedan Advance</a></li>
										   
										 <li ><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/vehiclelist?id=3">Suv/Luv</a></li>
										  <li ><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/vehiclelist?id=7">Suv/Luv Pro</a></li>
										   <li ><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/vehiclelist?id=11">Suv/Luv Advance</a></li>
										   
										 <li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/vehiclelist?id=4">luxury</a></li>
										  <li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/vehiclelist?id=8">luxury Pro</a></li>
										   <li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/vehiclelist?id=12">luxury Advance</a></li>
                                        <?php } ?></ul>
                                    </div>
									     <div class="table-responsive">
                                    <table class="datatable table table-striped" cellspacing="0" width="100%" id="example">
                                        <thead>
                                            <tr>
													<th>Sl No.</th>
													<th>logo</th>
                                                    <th>Brand</th>
                                                    <th>Model</th>
                                                    <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                              <?php
											 
					
				 $i=1;
					$j=0;
		
					foreach( $vlist as  $vehicle_detail)
					{
						
												echo ' <tr>';
											    echo ' 
											    <td align="center">'.$i.'</td>
												<td align="center">
<img src="'.Yii::app()->request->baseUrl.'/'.$vehicle_detail['logo'].'" width="50px" / ></td>
											
												<td align="center">'.$vehicle_detail['makename'].'</td>
											    <td align="center">'.$vehicle_detail['modelname'].'</td>
											  
												  
		 
			 <td align="center">';
			 
			 if($vehicle_detail['status'] > 0)
			 {
				 echo '<a class = "btn btn-theme pull-right btnsub2" id="'.$vehicle_detail['make_id'].'**'.$vehicle_detail['models_id'].'**'.$vehicle_detail['status'].'">DeActivated</a>';
			 }
			 else{
				 echo '<a class = "btn btn-theme pull-right btnsub2" id="'.$vehicle_detail['make_id'].'**'.$vehicle_detail['models_id'].'**'.$vehicle_detail['status'].'">Active</a>';
			 }
			 echo '<a class = "btn btn-theme pull-right btnupdate" id="'.$vehicle_detail['make_id'].'**'.$vehicle_detail['models_id'].'" data-toggle = "modal" data-target = "#signup-model">Update</a></td>';
											   echo '</tr>';
											 $i++;
											 $j++;
					}
					

					
                    ?>   
                                        </tbody>
                                    </table>
                                    </div>
    

<div class = "customer-signup modal fade" id = "signup-model" tabindex = "-1" role = "dialog" 
   aria-labelledby = "myModalLabel" aria-hidden = "true">
   
   <div class = "modal-dialog">
      <div class = "modal-content pull-left">
      <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">&times;</button>       
         <div class = "modal-body pull-left">
            
			
		
			<div class="col-md-8" id="form2">
                

				
				<!---login block-->
				<div id = "myTabContent" class = "tab-content">
                   <div class = "tab-pane fade in active" id = "logintab">
                      <div class="col-sm-12">
                       <div class="form-group">
					
					<input type="hidden" id="makes_id_hid" name="makes_id_hid"/>
					<input type="hidden" id="model_id_hid" name="model_id_hid"/>
                    <div class="col-md-6">
                       <div class="form-group has-icon has-label">
                            Select Category<select name="cate" id="cate" class="form-control">
							<?php
										  foreach($categories as $categori) {
											  ?>
																				
											<option value="<?php echo $categori['id'];?>"><?php echo $categori['categoryname'];?></option>
																			
																			
										<?php
											}  
										?>
							</select>
                        </div>
                    </div>
                    <div class="col-md-12">
                       <input class="form-control alt" type="button" name="btnupdate" id="btnupdate" data-dismiss="modal" value="Update"/>
                      
					   
					   </div>
                      </div>                               
                                
                    </div>
                                                               
                                
                        
                    </div>
                </div>                   
                   
            </div>
			
         </div>
         
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
  </div>
						
                             
       