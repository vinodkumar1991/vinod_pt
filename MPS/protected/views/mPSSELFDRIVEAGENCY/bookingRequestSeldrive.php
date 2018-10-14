<link href="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

<script src="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/datetimepicker/js/moment-with-locales.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

                                         <div class="table-responsive">
                                    <table class="datatable table table-striped" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Sl No.</th>
												<th>Booking Id</th>
                                                <th>Vehicle Id</th>
                                                <th>Vehicle Type</th>
                                             <!--  <th>Vehicle Features</th>   <th>Vehicle Brand</th>
                                                 <th>Vehicle Model</th> /*    <td>'.$self_detail['vehicle_features'].'</td><td>'.$self_detail['brand_name'].'</td>
											     <td>'.$self_detail['model_name'].'</td> */ -->
                                                <th>Vehicle Category</th>                                                                                 
                                               
                                              
                                                <th>Amount</th>
                                               
                                                <th>Security Deposit</th>											
												 <th>From Date</th>
												 <th>To Date</th>
												
                                            </tr>
                                        </thead>
                                        <tbody>
                                              <?php
											  
											  $i=1;
                    foreach ($self_details as $self_detail) {
                    	
                                              
											   echo ' <tr>';
											   echo ' 
											    <td>'.$i.'</td>
												<td>'.$self_detail['book_id'].'</td>
											   <td>'.$self_detail['vehicle_id'].'</td>
											   <td>'.$self_detail['vehicle_type'].'</td>
											 
											   <td>'.$self_detail['vehicle_category'].'</td>
											    
											   
												<td>'.$self_detail['amount'].'</td>							
												 <td>'.$self_detail['security_deposit'].'</td>												
												<td>'.$self_detail['fromdate'].'</td>
												<td>'.$self_detail['todate'].'</td>
												
											   </tr>';
											   $i++;
                                   
                    }
					

					
                    ?> 
                    
                                        </tbody>
                                    </table>
                                    </div>
	<!-- Edit popup -->
	