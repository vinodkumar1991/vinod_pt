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
                                            <li ><a href="<?php echo Yii::app()->request->baseUrl?>/index.php/mPSUserRegistration/Managermechanicshop">Mechanic Shop</a></li>

                                           <!-- <li><a href="<?php echo Yii::app()->request->baseUrl?>/index.php/mPSUserRegistration/FetchDeliveryboydata">Delivery Boy</a></li> -->

                                              <li><a href="<?php echo Yii::app()->request->baseUrl?>/index.php/MPSSELFDRIVEAGENCY/FetchSelfDrivedata">Self Drive Agent</a></li>

                                           

                                            <li class=""><a href="<?php echo Yii::app()->request->baseUrl?>/index.php/HIREAMECHANIC/FetchHireData/">Hire a Mechanic</a></li>

											 <li class="active"><a href="<?php echo $this->createUrl('mPSUserRegistration/Manageruser');?>">Customers</a></li>

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
											   <th>Customer ID</th>  
											   <th>Customer Name</th> 
											   <th>Contact No.</th>
												<th>EmailId.</th>
												<th>History</th>
												<th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
					   $i=1;	
					   foreach( $customersdata as  $customersdat){	
					   echo '<tr>';	
					   echo ' <td>'.$i.'</td>
					    <td>CustomerId'.$customersdat['id'].'</td>							
					   <td>'.$customersdat['username'].'</td>
					  																  
					   <td>'.$customersdat['mobile_no'].'</td>	
<td>'.$customersdat['emailid'].'</td>					   <td><a href="FetchUserInfo" class="dropdown-toggle view-u fetchuser" id='.$customersdat['id'].'><i class="fa fa-eye" aria-hidden="true"></i> View </a>											  											  </td>                                                <td><a href="#" title="Active" class="activ-u"><i class="fa fa-check" aria-hidden="true"> </i>Active</a>';
					   echo '</tr>';											 
					   
					   $i++;
					   
					   }										                    ?>      
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
                             
       