<script>
  $(document).ready(function()
  {	
  
    $("#example").on("click", ".btnupdate", function(){
  
	  bike_brand_id=$(this).attr('id');
	//  alert(bike_brand_id);
	  bike_brand_ids = $("#brandid").val(bike_brand_id);
	  });
	  
  $("#example").on("click", ".btndelete1", function(){
  
	  bike_brand_id=$(this).attr('id');
	//  alert(bike_brand_id);
	  bike_brand_ids = $("#bike_brand_id").val(bike_brand_id);
	  });		

	  $("#btndelete").click(function(){	
	  bike_brand_id= $("#bike_brand_id").val();		   
	  $.post('DeleteBike_data',{
		  bike_brand_id:bike_brand_id																																						},		
		  function(data){		
		  location.reload();
		  });		 
		  });	
		  $("#bike_cat").change(function(){
			  bike_cat = $("#bike_cat").val();	
			  $.post('FetchBike_data',{	
			  bike_cat:bike_cat	
			  },function(data){	
			  $("#tdata").html(data); 
			  });
			  });
      var i=1;
     $("#add_row").click(function(){
      $('#addr'+i).html("<td>"+ (i+1) +"</td><td><input name='user[]' type='text' placeholder='Repair Name' class='form-control input-md'  /></td>");

      $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
      i++; 
  });
     $("#delete_row").click(function(){
         if(i>1){
         $("#addr"+(i-1)).html('');
         i--;
         }
     });

});
</script>
<body>
<div class="card-body">
                                <!-- Nav tabs -->
                                        <ul class="nav nav-tabs" role="tablist">
											<li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/BikeList/CreateBikeBrand">Create Bike Brand</a></li>
											<li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/BikeList/CreateBikeModel">Create Bike Model</a></li>
											<li class="active"><a href="<?php echo Yii::app()->baseurl; ?>/index.php/BikeList/allBikeList">All Bike List</a></li>
										</ul>
                                <!-- Tab panes -->								<br/><br/>								Select Category:<select name="bike_cat" id="bike_cat">	<option value="">All</option>						<?php								foreach($bike_categories as $bike_cat)								{									?>									<option value="<?php echo $bike_cat['id'];?>"><?php echo $bike_cat['category_name'];?></option>									<?php																	}																?>								</select>								<br/><br/>
                                <div class="table-responsive">
                                    <table class="datatable table table-striped" cellspacing="0" width="100%" id="example">
                                        <thead>
                                            <tr>
                                                <th>Sl No.</th>
												 <th>Brand Logo</th>
                                                <th>Bike Brand</th>
                                                <th>Bike Model</th>  
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tdata">
                                              <?php 

											  
											  $i=1;
                    foreach ($bikelist as $self_detail) {
                    	
                                              
											    echo ' <tr>';
											   echo ' 
											    <td>'.$i.'</td>
											   <td>
<img src="'.Yii::app()->request->baseUrl.'/'.$self_detail['brandlogo'].'" width="50px" / ></td>
												<td>'.$self_detail['brand_name'].'</td>	  
												<td>'.$self_detail['model_name'].'</td>
												<td>	';																																			 
                                                  
								  echo '<a class = "btn btn-theme pull-right btnupdate" id="'.$self_detail['bike_model_id'].'*1" data-toggle = "modal" data-target = "#updateavailable">Update</a>';
									 echo '<a class = "btn btn-theme pull-right btndelete1" id="'.$self_detail['bike_model_id'].'" data-toggle = "modal" data-target = "#warning-model">Delete</a>';
														
													
													
												echo '</td>';
											   echo '</tr>';
											   $i++;
                                               
                    }
					

					
                    ?>
					
                                        </tbody>
                                    </table>
                                    </div>
                            </div>								<div class = "customer-signup modal fade" id = "warning-model" tabindex = "-1" role = "dialog"    aria-labelledby = "myModalLabel" aria-hidden = "true">      <div class = "modal-dialog">      <div class = "modal-content pull-left">      <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">&times;</button>                <div class = "modal-body pull-left">            								<div class="col-md-8" id="form2">                								<!---login block-->				<div id = "myTabContent" class = "tab-content">                   <div class = "tab-pane fade in active" id = "logintab">                      <div class="col-sm-12">                       <div class="form-group">										<input type="hidden" id="bike_brand_id" name="bike_brand_id"/>										<div class="row">                    <div class="col-md-12">                     Are you sure want to delete ?                    </div>					</div>					<div class="row">                    <div class="col-md-12">                       <input class="form-control alt" type="button" name="btndelete" id="btndelete" data-dismiss="modal" value="Yes"/>					                       </div>					 <div class="col-md-12">                       <input class="form-control alt" type="button" name="btncancel" id="btncancel" data-dismiss="modal" value="Cancel"/>					                       </div>					</div>                      </div>                                                                                   </div>                                                                                                                                           </div>                </div>                                                  </div>			         </div>               </div><!-- /.modal-content -->   </div><!-- /.modal-dialog -->  </div>

							
							
			<div id="updateavailable" class="modal fade">
				        <div class="modal-dialog">
				            <div class="modal-content">
				                <div class="modal-header">
				                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                    <h4 class="modal-title">Update Bike Details</h4>
				                </div>
				                <div class="modal-body">
				                  
 
							    <form class="form-horizontal" action="updateBikeLogo" method="POST" enctype='multipart/form-data'>
							    <div class="row">
									<div class="form-group">
											<input type="hidden" name="model_id" id="brandid" value=""/>
							            <label for="available-from" class="control-label col-xs-3">Bike Logo</label>

							            <div class="col-xs-6">

							                <input type="file" class="form-control" name="brand_logo_path" id="carlogo_file" style="margin-bottom:10px;">

							            </div>

							        </div>    	
							    </div>
							 <div class="row">
									<div class="form-group">
											<input type="hidden" name="id" id="hiddenvehicleid"/>
							            <label for="available-from" class="control-label col-xs-3">Bike Model</label>

							            <div class="col-xs-6">
							                <input type="file" class="form-control" name="bikemodel_file" id="bikemodel_file" style="margin-bottom:10px;">

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
				    </div>