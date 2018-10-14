<script>
$(document).ready(function()
{
		$(".deletedata").click(function(){
			
			shopid=$(this).attr('id');
			 $.post('deleteMshop',{
		            shopid:shopid,
		
					beforeSend : function(){ 	}
	},
		function(data)
		{ 
			
			//alert(data);
			  if(data>0)
			{
				
				$("#emailerror").html('<font color="red">Successfully Deleted.</font>');
				return false;
			}
			else{
				$("#emailerror").html('');
				
			}   
		});  
       
			
			
		});
	
});
	</script>
	 
							 
                                    <div class="tab-content">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li ><a href="<?php echo $this->createUrl('mPSUserRegistration/userRegister');?>">Create User</a></li>
										
										<li class="active"><a href="<?php echo $this->createUrl('mPSUserRegistration/Managermechanicshop');?>">Manage User</a></li>
                                    </ul>
                                    </div>
                                    <div class="tab-content">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="../mPSUserRegistration/Managermechanicshop">Mechanic Shop</a></li>
                                          
                                            <li><a href=" <?php echo $this->createUrl('MPSSELFDRIVEAGENCY/FetchSelfDrivedata');?>">Self Drive Agent</a></li>                                           
                                            <li><a href=" <?php echo $this->createUrl('MPSSELFDRIVEAGENCY/FetchHireData');?>">Hire a Mechanic</a></li>
											
											<li><a href="<?php echo $this->createUrl('mPSUserRegistration/Manageruser');?>">Customers</a></li>
											<li><a href="<?php echo $this->createUrl('Modificationshop/ModificationSave');?>">Modification Shop</a></li>
                                        </ul>
                                    </div>
									<br/><br/>
									<div id="emailerror"></div>
									     <div class="table-responsive">
                                    <table class="datatable table table-striped" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Sl No.</th>
                                                <th>Shop ID</th>
                                               
                                                <th>Owner Name</th>
                                             <!--   <th>Location</th>-->
                                                
                                                <th>Address</th>
                                                
                                               
                                                <th>Created Date</th>
                                                <th>No. of Delivery Boys</th>
                                                <th>Service Capability</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                              <?php
											  /* $mech=$mech_details;
											  $i=1;
                    foreach ($mech_details as $mech_detail) {
                    	
                                              $num_del[]=$mech_detail['num_delv'];
											 // $service_names[]=$mech_detail['service_name'];
											   
                                               
                    }
					$service=implode(',',$service_names); */
					
					
					
					//$service=implode(',', $services);
					
					$i=1;
					$j=0;
					if(!empty($service_name))
		{
			$service_name=$service_name;
		}
					foreach( $mech_details as  $mech_detail)
					{
						
												echo ' <tr>';
											    echo ' 
											    <td>'.$i.'</td>
												<td>'.$mech_detail['shop_id'].'</td>
											  
											    <td>'.$mech_detail['shopowner_nm'].'</td>
												
												
												<td>'.$mech_detail['address'].'</td>
												
												
												
												<td>'.date('d-m-Y',strtotime($mech_detail['created_date'])).'</td>
												<td>'.$mech_detail['num_delv'].'</td>
												<td>'.$mech_detail['count_service'].'</td>
											   <td><a href="Delboydetails?id='.$mech_detail['id'].'&spid='.$mech_detail['shop_id'].'" title="view" class="view-u"><i class="fa fa-eye" aria-hidden="true"></i></a> 
                                                    <a href="#" title="Trash" class="delete-u deletedata" id="'.$mech_detail['id'].'"><i class="fa fa-trash" aria-hidden="true"></i></a></td>';
											   echo '</tr>';
											 $i++;
											 $j++;
					}
					

					
                    ?>   
                                        </tbody>
                                    </table>
                                    </div>
                                   <!-- <div class="table-responsive">
									<?php
									//'shop_nm','shop_id','shopowner_nm','address','city','sector','zipcode','created_date'
                                 /*    $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'schedule-grid',
                'dataProvider'=>$dataProvider,
                //'filter'=>$model,
                'columns'=>array(

                         array(
                        'header'=>'Shop Name',
                        'name'=>'shop_nm',
                        'value'=>'strip_tags($data[\'shop_nm\'])',
                        ),
						 array(
                        'header'=>'Shop Id',
                        'name'=>'shop_id',
                        'value'=>'strip_tags($data[\'shop_id\'])',
                        ),
						 array(
                        'header'=>'Shop Owner name',
                        'name'=>'shopowner_nm',
                        'value'=>'strip_tags($data[\'shopowner_nm\'])',
                        ),
						 array(
                        'header'=>'Address',
                        'name'=>'address',
                        'value'=>'strip_tags($data[\'address\'])',
                        ),
						 array(
                        'header'=>'Contact Number',
                        'name'=>'contact_num',
                        'value'=>'strip_tags($data[\'contact_num\'])',
                        ),
						 array(
                        'header'=>'City',
                        'name'=>'city',
                        'value'=>'strip_tags($data[\'city\'])',
                        ),
						 array(
                        'header'=>'Sector',
                        'name'=>'sector',
                        'value'=>'strip_tags($data[\'sector\'])',
                        ),
						array(
                        'header'=>'Zipcode',
                        'name'=>'zipcode',
                        'value'=>'strip_tags($data[\'zipcode\'])',
                        ),
						array(
                        'header'=>'Created_Date',
                        'name'=>'created_date',
						//'value'=>'strip_tags($data[\'created_date\'])',
                         'value'=>'"".CHtml::encode(date("m-d-Y", strtotime($data["created_date"]))).""',
                        ),
                       ),
        
    )); */
	?>
                                    </div>-->
                             
       