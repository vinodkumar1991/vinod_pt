                       <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">  <script src="//code.jquery.com/jquery-1.10.2.js"></script>  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>  <link rel="stylesheet" href="/resources/demos/style.css">							<script>$(document).ready(function()		{						$(".fetchuser").click(function(){				alert($(this).attr('id'));				$.post('../mPSUserRegistration/emailValidation',{		            emailid:emailid,					beforeSend : function(){ 	}					},			function(data)			{ 								if(data>0)					{						jQuery("#emailer").html('<font color="red">Email Id already exist.</font>');						return false;					}					else{												jQuery("#emailer").html('');											}});			});		});					</script>   							                                     <div class="tab-content">                                    <ul class="nav nav-tabs" role="tablist">                                        <li ><a href="../mPSUserRegistration/userRegister">Create User</a></li>										<li class="active"><a href="../mPSUserRegistration/Managermechanicshop">Manage User</a></li>                                    </ul>                                    </div>                                    <div class="tab-content">                                        <ul class="nav nav-tabs">                                            <li class="active"><a href="../mPSUserRegistration/Managermechanicshop">Mechanic Shop</a></li>                                                                                       <li><a href="../MPSSELFDRIVEAGENCY/FetchSelfDrivedata">Self Drive Agent</a></li>                                                                                       <li><a href="../HIREAMECHANIC/FetchHireData">Hire a Mechanic</a></li>											 <li><a href="../site/ManageUser">Customers</a></li>                                            <li><a href="modification-shop.html">Modification Shop</a></li>                                        </ul>                                    </div>									     <div class="table-responsive">                  <table class="datatable table table-striped" cellspacing="0" width="100%">                                        <thead>                                            <tr>                                                <th>Sl No.</th>												<th>Customer Name</th>                                                <th>Customer ID</th>                                                <th>Contact No.</th>                                                <th>List of Vehicles</th>                                                <th>History</th>                                                <th>Status</th>                                            </tr>                                        </thead>                                        <tbody>                                                                                      <?php											  					$i=1;									foreach( $customersdata as  $customersdat)					{																		echo '<tr>';											    echo ' 											    <td>'.$i.'</td>												<td>'.$customersdat['username'].'</td>												<td>CustomerId'.$customersdat['id'].'</td>																							   <td>'.$customersdat['mobile_no'].'</td>												 																																														  <td>											  <a href="#" class="dropdown-toggle view-u fetchuser" id='.$customersdat['id'].' data-toggle = "modal" data-target = "#dispalyuserdata"><i class="fa fa-eye" aria-hidden="true"></i> View </a>											  											  </td>                                                <td><a href="#" title="Active" class="activ-u"><i class="fa fa-check" aria-hidden="true"> </i>Active</a>';											   echo '</tr>';											 $i++;											 					}										                    ?>                                           </tbody>                                        </tbody>                                    </table>                                    </div>                                   <!-- <div class="table-responsive">									<?php				?>                                    </div>-->          <div id="dispalyuserdata" class="modal fade" role="dialog">  <div class="modal-dialog">    <!-- Modal content-->    <div class="modal-content">      <div class="modal-header">        <button type="button" class="close" data-dismiss="modal">&times;</button>        <h4 class="modal-title">Add Delivery Boy</h4>      </div>      <div class="modal-body">        <!-- Delivery Boy Form -->                                        							                                        <!-- End Delivery Boy Form -->      </div>      <!-- <div class="modal-footer">        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>      </div> -->    </div>  </div></div>                          