
<script>

$(document).ready(function()

{
});

	</script>

	

							 

                                   

                                    <div class="tab-content">

                                        <ul class="nav nav-tabs">

                                            <li class="active"><a href="<?php echo  $this->createUrl('mPSUserRegistration/BookingReports');?>">Book A Service</a></li>
 
                                         

                                            <li><a href="  <?php echo  $this->createUrl('MPSSELFDRIVEAGENCY/selfdrivereports');?>">Self Drive Agent</a></li>                                           

                                            <li><a href="<?php echo  $this->createUrl('HIREAMECHANIC/HireBookings');?>">Hire a Mechanic</a></li>

											

											<li><a href="#">Modification Shop</a></li>

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
												  <th>Vehicle Type</th>
												 <th>Customer Name</th>
												 <th>Email Id</th>
												 <th>Mobile No</th>
												  <th>Address</th>
                                               

                                                <th>Service Name</th>

                                             <!--   <th>Location</th>-->

                                                

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

												<td><a href="#" data-target = "#signup-model"><font color="blue">'.$BookingDetail['bookid'].'</font></a></td>
												<td>'.$BookingDetail['vehicle_type'].'</td>
												<td>'.$BookingDetail['f_name'].'</td>
												<td>'.$BookingDetail['emailid'].'</td>
												<td>'.$BookingDetail['mobno'].'</td>
												<td>'.$BookingDetail['pickadrs'].'</td>
												<td>'.$BookingDetail['service_name'].'('.$BookingDetail['plan_name'].')'.'</td>

												<td>'.$BookingDetail['amout'].'</td>
												<td>'.date('d-m-Y',strtotime($BookingDetail['timestamp'])).'</td>';
												if($BookingDetail['status']==0)
												{
													echo '<td><font color="green"><b>Pending</b></font></td>';
												}
												else if($BookingDetail['status']==1 && $BookingDetail['mech_status']==0)
												{
													echo '<td><font color="green"><b>Booked</b></font></td>';
												}
												else if($BookingDetail['status']==1 && $BookingDetail['mech_status']==1)
												{
														echo '<td><font color="blue"><b>Received</b></font></td>';
												}
												else if($BookingDetail['status']==1 && $BookingDetail['mech_status']==1 && $BookingDetail['delv_status']==1)
												{
														echo '<td><font color="blue"><b>On going</b></font></td>';
												}
												else if($BookingDetail['status']==1 && $BookingDetail['mech_status']==3 && $BookingDetail['delv_status']==1)
												{
														echo '<td><font color="blue"><b>Completed</b></font></td>';
												}

											   echo '</tr>';

											 $i++;

											

					}

					



					

                    ?>   

                                        </tbody>

                                    </table>

                                    </div>

                               
                             

       