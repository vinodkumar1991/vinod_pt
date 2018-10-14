<?php
//echo '<pre>';
//print_r($delv_details);
//exit;
?>

							 <div class="tab-content">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li ><a href="../mPSUserRegistration/userRegister">Create User</a></li>
										<li class="active"><a href="../mPSUserRegistration/Managermechanicshop">Manage User</a></li>
                                    </ul>
                                    </div>
                                    <div class="tab-content">
                                        <ul class="nav nav-tabs">
                                            <li ><a href="../mPSUserRegistration/Managermechanicshop">Mechanic Shop</a></li>
                                         
                                              <li><a href="../MPSSELFDRIVEAGENCY/FetchSelfDrivedata">Self Drive Agent</a></li>
                                           
                                            <li><a href="../HIREAMECHANIC/FetchHireData">Hire a Mechanic</a></li>
											 <li><a href="<?php echo Yii::app()->baseUrl; ?>/index.php/site/ManageUser">Customers</a></li>
                                            <li><a href="modification-shop.html">Modification Shop</a></li>
                                        </ul>
                                    </div>
                                         <div class="table-responsive">
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
                             
       