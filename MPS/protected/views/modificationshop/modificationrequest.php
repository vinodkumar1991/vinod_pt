
<script>

$(document).ready(function()


{

	
	

});

	</script>
              

                                    <div class="tab-content">

                                        <ul class="nav nav-tabs">

                                            <li ><a href="../mPSUserRegistration/BookingReports">Book A Service</a></li>

                                           

                                            <li><a href="<?php echo  $this->createUrl('MPSSELFDRIVEAGENCY/selfdrivereports');?>">Self Drive Agent</a></li>              
											<li ><a href="<?php echo  $this->createUrl('HIREAMECHANIC/HireBookings');?>">Hire a Mechanic</a></li>              
											<li><a href="<?php echo $this->createUrl('mPSUserRegistration/Manageruser');?>">Customers</a></li>											<li><a href="<?php echo $this->createUrl('Modificationshop/ModificationSave');?>">Modification Shop</a></li>
                                        </ul>

                                    </div>

									<br/><br/>

									<div id="emailerror"></div>

									     <div class="table-responsive">

                                    <table class="datatable table table-striped" cellspacing="0" width="100%">

                                        <thead>

                                            <tr>

                                                 <th>Sl No.</th>

                                                 <th>ModificationShop Name</th>
												 <th>User Name</th>
												  <th>Vehicle Type</th>
												 <th>Customer Name</th>
												 <th>Type of Modification</th>												 
												  <th>Email</th>
												  <th>Mobile No</th>
                                                <th>Brand Name</th>  
                                                <th>Model Name</th>   
                                                <th>Request Date</th>
                                                <th>Status</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                              <?php

					$i=1;

					foreach( $BookingDetails as  $BookingDetail)

					{

												echo ' <tr>';

											    echo ' 

											    <td>'.$i.'</td>

												<td>'.$BookingDetail['book_id'].'</td>
												<td>'.$BookingDetail['username'].'</td>
												<td>'.$BookingDetail['vehicle_id'].'</td>';
												foreach ($users as $data)
												{
													if($data['id']==$BookingDetail['user_id'])
													{
														echo'<td>'.$data['username'].'</td>
												<td>'.$data['emailid'].'</td>
												<td>'.$data['mobile_no'].'</td>';
													}
												}
												
												echo '<td>'.$BookingDetail['fromdate'].'</td>
												<td>'.$BookingDetail['todate'].'</td>

												<td>'.$BookingDetail['amount'].'</td>
												<td>'.date('d-m-Y',strtotime($BookingDetail['created_date'])).'</td>';
												if($BookingDetail['status']==1)
												{
													echo '<td><font color="red"><b>Booked</b></font></td>';
												}
												else if($BookingDetail['status']==0)
												{
														echo '<td><font color="green"><b>On Going</b></font></td>';
												}

											   echo '</tr>';

											 $i++;
					}

                    ?>   

                                        </tbody>

                                    </table>

                                    </div>
                             

       