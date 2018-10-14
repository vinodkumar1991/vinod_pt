<script>


  $(document).ready(function(){
      var i=1;
     $("#add_row").click(function(){
      $('#addr'+i).html("<td>"+ (i+1) +"</td><td>  <input type='text' class='vmodel form-control input-md' name='model_name[]'/></td><td><select name='category_name[]'><option value='1'>100cc</option><option value='2'>110cc</option><option value='3'>125cc</option><option value='4'>135cc</option><option value='5'>150cc</option><option value='6'>160cc</option><option value='7'>180cc</option><option value='8'>200cc</option><option value='9'>220cc</option><option value='10'>250cc</option><option value='11'>320-350cc</option><option value='12'>390-450cc</option><option value='13'>500cc</option></select></td><td align='center'><div class='form-group'><input type='file' name='bikemodelfile[]' data-type='image' /></div></td>");

      $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
      i++; 
  });
     $("#delete_row").click(function(){
         if(i>1){
         $("#addr"+(i-1)).html('');
         i--;
         }
     });
	 setTimeout(function() {
    $('.success').fadeOut('fast');
}, 1300);
	
});
</script>

<body>
<div class="card-body">
                                <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/BikeList/CreateBikeBrand">Create Bike Brand</a></li>
                                        <li class="active"><a href="<?php echo Yii::app()->baseurl; ?>/index.php/BikeList/CreateBikeModel">Create Bike Model</a></li>
                                        <li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/BikeList/allBikeList">All Bike List</a></li>
										
                                    </ul>
                                <!-- Tab panes --><?php 
									if(isset($message))
									{?>
										<div class="success alert alert-success"><?php echo $message; ?></div><?php
									}
										?>
                                    <div class="tab-content">
									
                                            <form class="form-horizontal lcns" method="post" enctype="multipart/form-data" action="CreateBikeModel">
                            <div class="col-md-8 brand_side">    
                           <div class="form-group">
                                            <label class="col-sm-3 control-label">Bike Brand Name</label>
                                            <div class="col-md-3">
                                              <select name="brand_name">
											  
												<?php foreach($brands as $brand)
												{
													?>
													
													<option value="<?php echo $brand['brand_id'];  ?>"><?php echo $brand['brand_name'];  ?></option>
													<?php
												}
												?>
											  </select>
                                              
                                            </div>
                                        </div> 
                                        </div> 
										
									<div class="col-md-12">	
									<h2>Bike Modal List</h2>
									<div class="form-group" id="armps">
                                        
                                        <div>
                                 <table class="table table-bordered table-hover" id="tab_logic">
                <thead>
                    <tr >
                        <th class="text-center">
                            SI.No
                        </th>
                        <th class="text-center">
                            Model Name
                        </th>
						<th class="text-center">
                            Select Bike CC
                        </th>
						<th class="text-center">
                            Upload Model Image
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr id='addr0'>
                        <td>
                        1
                        </td>
                        <td class="form-group">
                       <input type="text" name="model_name[]" class="vmodel form-control input-md"/>
                        </td>
						<td>
						<select name="category_name[]">
							<option value="1">100cc</option>
							<option value="2">110cc</option>
							<option value="3">125cc</option>
							<option value="4">135cc</option>
							<option value="5">150cc</option>
							<option value="6">160cc</option>
							<option value="7">180cc</option>
							<option value="8">200cc</option>
							<option value="9">220cc</option>
							<option value="10">250cc</option>
							<option value="11">320-350cc</option>
							<option value="12">390-450cc</option>
							<option value="13">500cc</option>
						</select>
						</td>
						  <td align="center">
                       <div class="form-group">

                                            <div class="col-sm-10">
                                                 <input type="file" name="bikemodelfile[]" data-type="image" ID="carfile" />
                                                <!--<span id="vmodelerr" style="color:red;display: none;">Please select Model</span>-->
                                            </div>
                                        </div>
                        </td>
                        
                    </tr>
                    <tr id='addr1'>
					
					</tr>
                </tbody>
            </table>
			<div class="col-md-10">
			<a id="add_row" class="btn btn-default">Add Row</a>
			<a id='delete_row' class="btn btn-default">Delete Row</a>
			</div>
			<div class="col-md-2">
			<div class="form-group">
				<button type="submit" class="btn btn-warning"  name="addmodel" onClick="locsubmit();">Submit</button>
			<span id="loading" style="display:none; align:center"><img src="<?php echo Yii::app()->baseUrl?>/images/load.gif" width="100px" height="100px"></span>
		</div>
		</div>
		</div>

                                    </div>
                                    </div>
                                   
                                    <!--<div class="form-group">
                                        <label class="col-sm-2 control-label">Location</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" id="" placeholder="Enter Location">
                                        </div>
                                    </div>-->
                                        
                                        </form>
                                </div>

                            </div>
