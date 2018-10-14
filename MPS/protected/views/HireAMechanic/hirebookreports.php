
<script>

$(document).ready(function()

{

	
	

});

	</script>

	

							 

                                   

                                    <div class="tab-content">

                                        <ul class="nav nav-tabs">

                                            <li ><a href="../mPSUserRegistration/BookingReports">Book A Service</a></li>

                                           

                                            <li><a href="<?php echo  $this->createUrl('MPSSELFDRIVEAGENCY/selfdrivereports');?>">Self Drive Agent</a></li>              
											<li class="active"><a href="<?php echo  $this->createUrl('HIREAMECHANIC/HireBookings');?>">Hire a Mechanic</a></li>              
											
                                        </ul>

                                    </div>

									<br/><br/>

									<div id="emailerror"></div>

									     <div class="table-responsive">

                                    <table class="datatable table table-striped" cellspacing="0" width="100%">

                                        <thead>

                                            <tr>

                                                 <th>Sl No.</th>

                                                 <th>OrderId</th>
												  <th>Mechanic Id</th>
												 <th>Customer Name</th>
												 <th>Email Id</th>
												 <th>Mobile No</th>
												  <th>Mechanic Name</th>
                                                <th>Amount</th>
                                                <th>Book Date</th>
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
												<td>'.$BookingDetail['hire_mechanic_id'].'</td>';
												foreach ($users as $data)
												{
													if($data['id']==$BookingDetail['userid'])
													{
														echo'<td>'.$data['username'].'</td>
												<td>'.$data['emailid'].'</td>
												<td>'.$data['mobile_no'].'</td>';
													}
												}
												
												echo '<td>'.$BookingDetail['name'].'</td>
												

												<td>'.$BookingDetail['amount'].'</td>
												<td>'.date('d-m-Y',strtotime($BookingDetail['created_date'])).'</td>';
												if($BookingDetail['status']==1)
												{
													echo '<td><font color="green"><b>Booked</b></font></td>';
												}
												else if($BookingDetail['status']==0)
												{
														echo '<td><font color="red"><b>Pending</b></font></td>';
												}

											   echo '</tr>';

											 $i++;

											

					}

					



					

                    ?>   

                                        </tbody>

                                    </table>

                                    </div>

                                   <!-- <div class="table-responsive">

									<?php

								

	?>

                                    </div>-->

                             

       