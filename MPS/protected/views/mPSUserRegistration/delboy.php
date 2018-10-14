<?php



?>

<script>
jQuery(document).ready(function()
		{
			
			jQuery("#delcon").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
	jQuery("#cont").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
		jQuery("#wldelshop").change(function(){
		var shopid = $('#wldelshop').val();
		//alert(shopid);
		
			$.post('../mPSUserRegistration/getLocationlist',{
		            shopid:shopid,
					beforeSend : function(){ 	}
					},
			function(data)
			{ 
			$('#Locationlist').html("<option>Select Locations</option><option>"+data+'</option>');
			});
		});			
 jQuery("#conpwd").change(function(){
							var password = jQuery('#password').val();
							
							var conpwd = jQuery('#conpwd').val();
							if(password!=conpwd)
							{
							//alert('not matching');
							jQuery("#errpwd").html('<font color="red">Password and confirm password should be match</font>');
							jQuery("#sub").prop('disabled',true);
							
							return false;
							}
							else{
								jQuery("#errpwd").html('');
								jQuery("#sub").prop('disabled',false);
								
							}
				
						}); 
						 jQuery("#delusercnpwd").change(function(){
							var passworddel = jQuery('#deluserpwd').val();
							
							var conpwddel = jQuery('#delusercnpwd').val();
							if(passworddel!=conpwddel)
							{
							//alert('not matching');
							jQuery("#delerrpwd").html('<font color="red">Password and confirm password should be match</font>');
							jQuery("#subdeluserdata").prop('disabled',true);
							
							return false;
							}
							else{
								jQuery("#delerrpwd").html('');
								jQuery("#subdeluserdata").prop('disabled',false);
								
							}
				
			}); 

jQuery("#emailid").change(function(){
				
				    var emailid = $('#emailid').val();
					$.post('../mPSUserRegistration/emailValidation',{
		            emailid:emailid,
					beforeSend : function(){ 	}
					},
			function(data)
			{ 
			
					if(data>0)
					{
						jQuery("#emailer").html('<font color="red">Email Id already exist.</font>');
						return false;
					}
					else{
						
						jQuery("#emailer").html('');
						
					}});
					
					});
					jQuery("#delemailid").change(function(){
				
				var emailid = $('#delemailid').val();
				
				$.post('../mPSUserRegistration/emailValidation',{
		            emailid:emailid,
		
					beforeSend : function(){ 	}
	},
		function(data)
		{ 
			//alert(data);
			if(data>0)
			{
				
				jQuery("#delemailer").html('<font color="red">Email Id already exist.</font>');
				return false;
			}
			else{
				jQuery("#delemailer").html('');
				
			}
			
				
				
			
			
		}); 
       
			});

		});

function getCitydel(stateId) 
			{	
			$.post('../mPSUserRegistration/Getcity',{
							State:stateId,
						},
						function(data)
						{ 
						//alert(data);
							
							
							 $("#wldelcity").html("");
							$("#wldelcity").append(data); 
							
						});
			}
			function getAreadel(cityId)
				{
					
						$.post('../mPSUserRegistration/Getarea',{
							City:cityId,
						},
						function(data)
						{ 
							
							
							//personal location
							
							//work location
							 $("#wldelarea").html("");
							$("#wldelarea").append(data); 
							

						}); 
			   }
			   function getStatedel(countryId)
				{
							$.post('../mPSUserRegistration/Getstate',{
								Country:countryId,
							},
							function(data)
							{ 
								
								
								//personal location
							
								
								
								//work location
								 $("#wldelstate").html("");
								$("#wldelstate").append(data); 
							});
				}
			
		  </script>
 
	<!--<div class="card-header">
                                    <div class="card-title">
                                    	<div class="title">Mechanic Shop Add Delivery Boy</div>
                                    </div>
    </div>-->
	

<div class="col-md-2 pad-top-btm15">
	<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/admin-icon.png" width="120" />
</div>
<div class="col-md-10 mch-dtls">
    <div class="row">
    	<div class="col-md-6"><h3>Shop Details</h3></div>	
    	<div class="col-md-6">
    	<div class="pull-right">
    		<a class="btn btn-success" href="Managermechanicshop" title="Back">
    			<i class="fa fa-arrow-left" aria-hidden="true"></i>
			</a>
    		<button id="edit-mchshop" class="btn btn-warning edit-u" name="edit-mchshop" type="submit" title="Edit">
    			<i class="fa fa-pencil" aria-hidden="true"></i>
    		</button>
    		<a class="btn btn-success" data-toggle="modal" data-target="#AddDeliveryBoy">Add Delivery Boy <i class="fa fa-plus" aria-hidden="true"></i></a>
    	</div>
    	</div>
    </div>
	<?php
			foreach($fetchservices as $serviced)
			{
				$service_name[]= $serviced['service_name'];
			}
			
			if(count($service_name)>1)
			{
				 $sername=implode(',',$service_name);
			}
			else if(count($service_name)==1)
			{
				//$sername=$service_name;
				 $sername=implode(',',$service_name);
			}
	?>
	
	
    <div class="row">
    	<div class="col-md-6">
            <dl class="dl-horizontal">
			<dt>Types of Services</dt>
                <dd><?php echo $sername; ?></dd>
			<?php
			foreach($details as $detail)
			{
				
              echo"
			    <dt>Shop Name</dt>
                <dd>".$detail['shop_nm']."</dd>
                <dt>No. of Delivery boy's</dt>
                <dd>".$detail['num_mechanic']."</dd>
                <dt>Service Capability (Per Day)</dt>
                <dd>".$detail['count_service']."</dd>
				 <dt>Shop Photo:</dt>
				<dd><img src='158.69.118.137/".$detail['shop_img']."' name='spnm' id='spnm' width='80'></dd>
				";
			}
			?>
            </dl>
        </div>
        <div class="col-md-6">
		<?php
			foreach($details as $detail)
			{
            echo "<dl class='dl-horizontal'>
                <dt>Contact No.</dt>
                <dd>".$detail['contact_num']."</dd>
                <dt>Address</dt>
                <dd>".$detail['address']."</dd>
            </dl>";
			}?>			
          
        </div>
    </div>

                                                
<!-- Modal -->
<div id="AddDeliveryBoy" class="modal fade col-md-12" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Delivery Boy</h4>
      </div>
      <div class="modal-body">
        <!-- Delivery Boy Form -->
                                        <form class="form-horizontal lcns 2 userreg-form" method="POST" action="delboysub" enctype="multipart/form-data">
										<input type="hidden" name="delroleid" id="delroleid">
                                        <div class="model-heaftxt"><h4 class="col-sm-12">Personal Details</h4></div>
                                        <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Delivery Boy Name</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="delnm" name="delnm" required >
												
                                            </div>
                                        </div>
										<div class="col-md-6">
                                            <label class="col-md-6 control-label">ID</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="delid" name="delid" value="dlb00<?php 
												if(isset($dlb_unique_id))
												{
												echo $dlb_unique_id+1;
												}
												?>" readonly="true" >
                                            </div>
                                        </div>
                                        </div>                                        
                                        <div class="row">										
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Contact No.</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="delcon" name="delcon" maxlength="10" required>
                                            </div>
                                        </div>
										<div class="col-md-6">
                                            <label class="col-md-6 control-label">Address1</label>
                                            <div class="col-md-6">
                                                <textarea class="form-control" placeholder="Enter Shop Address" id="deladrs" name="deladrs" required></textarea>
                                            </div>
                                        </div>
										
										</div>										
										<div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Age</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="age" name="age" required >
                                            </div>
                                        </div>
										<div class="col-md-6">
                                            <label class="col-md-6 control-label">Address2</label>
                                            <div class="col-md-6">
                                                <textarea class="form-control" placeholder="Enter Shop Address" id="adrs2" name="adrs2" required></textarea>
                                            </div>
                                        </div>
										<div class="col-md-6">
                                            <label class="col-md-6 control-label">Email ID</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="delemailid" name="delemailid" required>
                                            </div>											
                                        </div>	
                                        </div>
                                        <div class="row">
											<div class="col-md-6">
                                            <label class="col-md-6 control-label">Upload Driving Licence</label>
                                            <div class="col-md-6">
                                                <input type="file" class="form-control" id="rc" name="rc" required>
                                            </div>											
                                        	</div>
                                        	<div class="col-md-6">
                                            <label class="col-md-6 control-label">Upload Address Proof</label>
                                            <div class="col-md-6">
                                                <input type="file" class="form-control" id="addressproof" name="addressproof" required>
                                            </div>											
                                        </div>
                                        </div> 										
										<div id="delemailer"></div>										
                                        
										
											<input type="hidden" name="wldelshop" id="wldelshop" value="<?php echo $_GET['spid'];?>">
										<!--working location-->
                                        <!--<div class="row"><h4 class="col-sm-12">Working Location</h4></div>-->
                                    <!--   <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Shop</label>
                                            <div class="col-md-6">
											
										
                                                <select id="wldelshop" name="wldelshop" >
                                                    <option>Select Shop</option>
  <?php
						/* if(!empty($shop_names))
						{
                    	for($i=0;$i<count($shop_names);$i++)
						  {
							   
							   echo "<option value='".$shop_names[$i]['shop_id']."'>".$shop_names[$i]['shop_nm']."</option>";
						  }
						}
                     */
                    ?>   
                                                </select>
                                            </div>-->
                                       <!-- </div>-->
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Photo ID</label>
                                            <div class="col-md-6">
                                                <input type="file" placeholder="Upload any Id Proof" class="form-control" id="picid" name="picid" required>
                                            </div>
                                        </div>
                                      
                                        <div class="row">
										<!--
										<div class="col-md-6">
                                            <label class="col-md-6 control-label">Location</label>
                                            <div class="col-md-6">
                                                <select id="Locationlist" name="Locationlist" onChange="getAreadel(this.value)">
                                                    <option>Select City</option>
                                                  
                                                </select>
                                            </div>
                                        </div>-->
										
										</div>
										
                                        <div class="model-heaftxt mrg-top10"><h4 class="col-sm-12">Create Account</h4></div>
                                        <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Create User Name</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="delusernm" name="delusernm" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Create Password</label>
                                            <div class="col-md-6">
                                                <input type="password" class="form-control" id="deluserpwd" name="deluserpwd" required>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Confirm Password</label>
                                            <div class="col-md-6">
                                                <input type="password" class="form-control" id="delusercnpwd" name="delusercnpwd" required>
                                            </div>
											
                                        </div>
										<div id="delerrpwd">
											</div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-6 col-sm-6">
                                                <button type="submit" class="btn btn-warning" id="subdeluserdata" name="subdeluserdata">Create Delivery Boy</button>
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
</div>            
</div>

<div class="panel panel-primary pull-left">
        <div class="panel-heading">
            <h3 class="panel-title">List Of Delivery Boys</h3>
        </div>
<div class="panel-body">
	<table class="datatable table table-striped" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Sl No.</th>
                <th>Delivery Boy ID</th>
                <th>Name</th>
                <th>ID Proof</th>
                 <th>Age</th>
                <th>Contact No.</th>
                <th>Address</th>
                <th>Workshop</th>
                <th>RC</th>
                <th>Created Date</th>
                <th>Status</th>
            </tr>
        </thead>
		<tbody>
		<?php
											  
											  $i=1;
		            foreach ($delv_details as $delv_detail) {	            	
		                                      
				   echo ' <tr>';
				   echo ' 
				    <td>'.$i.'</td>
				   <td>'.$delv_detail['delv_id'].'</td>
				   <td>'.$delv_detail['del_nm'].'</td>
				   <td><a target="_new" 
					href="'.Yii::app()->baseUrl.'/users_images/dlb/idproof/'.$delv_detail['reg_cert'].'">'.$delv_detail['img_path'].'</a>
				   </td>
				   
				   <td>'.$delv_detail['age'].'</td>
				    <td>'.$delv_detail['contact'].'</td>
				    <td>'.$delv_detail['adrs'].'</td>
				    <td>'.$delv_detail['shop_nm'].'</td>
					
					<td><a target="_new" 
					href="'.Yii::app()->baseUrl.'/users_images/dlb/rc/'.$delv_detail['reg_cert'].'">'.$delv_detail['reg_cert'].'</a></td>
					<td>'.date('d-m-Y',strtotime($delv_detail['created_date'])).'</td>
					<td><a href="#" title="edit" class="edit-u"><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                        <a href="#" title="Trash" class="delete-u"><i class="fa fa-trash" aria-hidden="true"></i></a></td>';
				   echo '</tr>';
				   $i++;
		                                       
		            }
					

					
		            ?>   
		    </tbody>
        </table>
    </div>
</div>





