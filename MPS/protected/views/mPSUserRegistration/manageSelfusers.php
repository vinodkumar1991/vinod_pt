<?php
//echo '<pre>';
//print_r($delv_details);
//exit;
?>
<script>
$(document).ready(function()
{ 
		//update row with ajax
		
	
	// open popup and getting details
	$( ".clickbtn" ).click(function() {
 
		$('#id').val($(this).attr('id'));
		var edata=$(this).attr('id');
		
			$.post('../MPSSELFDRIVEAGENCY/updateSelfdriveDetails',{
			
			id:edata
		},
		function(data)
		{
						var data=JSON.parse(data);					
						$('#self_id').val(data[0]['self_unique_id']);
						$('#agency_name').val(data[0]['agency_name']);
						$('#contact_num').val(data[0]['contact_num']);
						$('#semail').val(data[0]['email']);
						$('#address').val(data[0]['address']);
						
        });
		
	});
		$("#semail").change(function(){
				
				    var semail = $('#semail').val();
						$.post('../MPSSELFDRIVEAGENCY/emailValidation',{
							
										semail:semail,
										beforeSend : function(){ 	}
										},
									function(data)
									{ 				
										if(data>0)
										{
											$("#semailer").html('<font color="red">Email Id already exist.</font>');
											$("#update_selfdrive").prop('disabled',true);
											return false;
										}
										else{
											
											$("#semailer").html('');
											$("#update_selfdrive").prop('disabled',false);
										}}
								);
					});
});
function deletep(id)
{
	var edata=id;
	
	var con=confirm("Are you sure you want to delete!");
	if(con==true)
	{
       $.post('../MPSSELFDRIVEAGENCY/Deleteself',{
		  
			id:edata
		},
		function(data)
		{
			
           var form=document.createElement('form');
			form.setAttribute('method','post');
			form.setAttribute('action','../MPSSELFDRIVEAGENCY/FetchSelfDrivedata');
			document.body.appendChild(form);
			form.submit();
        });
   }
}   
$( document ).ready(function() {
	
setTimeout(function() {
    $('.success').fadeOut('fast');
}, 1300);
});
</script>
							 <div class="tab-content">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li ><a href="../mPSUserRegistration/userRegister">Create User</a></li>
										<li class="active"><a href="../mPSUserRegistration/Managermechanicshop">Manage User</a></li>
                                    </ul>
                                    </div>
                                    <div class="tab-content">
                                        <ul class="nav nav-tabs">
                                            <li ><a href="../mPSUserRegistration/Managermechanicshop">Mechanic Shop</a></li>
                                          <!--  <li><a href="../mPSUserRegistration/FetchDeliveryboydata">Delivery Boy</a></li> -->
                                              <li class="active"><a href="../MPSSELFDRIVEAGENCY/FetchSelfDrivedata">Self Drive Agent</a></li>
                                           
                                            <li><a href="../HIREAMECHANIC/FetchHireData">Hire a Mechanic</a></li>
											 <li><a href="<?php echo $this->createUrl('mPSUserRegistration/Manageruser');?>">Customers</a></li>
                                             <li><a href="<?php echo $this->createUrl('Modificationshop/ModificationSave');?>">Modification Shop</a></li>
                                        </ul>
                                    </div><?php 
									if(isset($message))
									{?>
										<div class="success"><?php echo $message; ?></div><?php
									}
										?>
                                         <div class="table-responsive">
                                    <table class="datatable table table-striped" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Sl No.</th>
                                                <th>Self agency Id</th>
                                                <th>Agency Name</th>
                                                <th>ID Proof</th>
                                                 <th>Email</th>
                                                <th>Contact No.</th>
                                                <th>Address</th>                                               
                                                <th>Created Date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                              <?php
											  
											  $i=1;
                    foreach ($self_details as $self_detail) {
                    	
                                              
											    echo ' <tr>';
											   echo ' 
											    <td>'.$i.'</td>
											   <td>'.$self_detail['self_unique_id'].'</td>
											   <td>'.$self_detail['agency_name'].'</td>
											   <td align="center">
<a href="http://10.10.10.28/mps/MPS/'.$self_detail['img_path'].'" class="imghover"><i class="fa fa-picture-o" aria-hidden="true"></i></a></td>
												
											   
											   <td>'.$self_detail['email'].'</td>
											    <td>'.$self_detail['contact_num'].'</td>
											    <td>'.$self_detail['address'].'</td>							
												
												<td>'.date('d-m-Y',strtotime($self_detail['created_date'])).'</td>
												<td><a data-toggle="modal" data-target="#updateSelfdrive" title="edit" id="'.$self_detail['id'].'" class="clickbtn edit-u"><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                                                    <a href="#" title="Trash" class="delete-u" onclick="deletep('.$self_detail['id'].');" ><i class="fa fa-trash" aria-hidden="true"></i></a></td>';
											   echo '</tr>';
											   $i++;
                                               
                    }
					

					
                    ?>   <script>
$(document).ready(function(){
$container = $('<div/>').attr('id', 'imgPreviewWithStyles').append('<img width="200"/>').hide().css('position', 'absolute').appendTo('body'),

$img = $('img', $container),
    $('a.imghover:not(.brand)').mousemove(function (e) {
    $container.css({
        top: e.pageY + 20 + 'px',
        left: e.pageX + 20 + 'px'
    });

}).hover(function () {

    var link = this;
    $container.show();
    $img.load(function () {
        //$container.removeClass(s.containerLoadingClass);
        $img.addClass('img-rounded');
        $img.show();
        //s.onLoad.call($img[0], link);
    }).attr('src', $(link).prop('href'));
    //alert($(link).prop('href'));
    //s.onShow.call($container[0], link);

}, function () {

    $container.hide();
    $img.unbind('load').attr('src', '').hide();
    //s.onHide.call($container[0], this);

});	
});
</script>					
                                        </tbody>
                                    </table>
                                    </div>
                             
     
<div id="updateSelfdrive" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Manage Selfdrive Agent</h4>
      </div>
      <div class="modal-body">
        <!-- Delivery Boy Form -->
                                      <form class="form-horizontal lcns " action="../MPSSELFDRIVEAGENCY/UpdateSelfdrive" method="POST">
                                      <input type="hidden" name="sroletype" id="sroletype">
                                        <div class="row"><h3 class="col-sm-12">Agency Details</h3></div>
                                        <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Agency Name</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="agency_name" name="agency_name" required>
												<input type="hidden" id="id" name="id">
                                            </div>
                                        </div>
									
                                        </div>
                                        <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">SelfDrive ID</label>
                                             <div class="col-md-6">
                                                <input type="text" class="form-control" id="self_id" name="slfid" value="" readonly="true" >
                                            </div>
                                        </div>
										
                                        </div>
                                        <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Address</label>
                                            <div class="col-md-6">
                                                <textarea class="form-control" id="address" name="saddress" placeholder="Enter Shop Address" required></textarea>
                                            </div>
                                        </div>
									
                                        </div>
                                        <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Enter Email ID</label>
                                            <div class="col-md-6">
                                                <input type="email" id="semail" name="semail" class="form-control" required>
                                            </div>
											
                                        </div>	<div id="semailer">
										</div>									
                                   
                                        </div>
                                        <div class="row">
										<div class="col-md-6">
                                            <label class="col-md-6 control-label">Contact No.</label>
                                            <div class="col-md-6">
                                                <input type="text" name="contact_num" id="contact_num" class="form-control number-only" required>
												<label id="pin-error" style="display:none;">Invalid Contact Number</label>
											</div>
                                        </div>
									   <div class="form-group">
                                            <div class="col-sm-offset-6 col-sm-6">
                                                <input type="submit" id="update_selfdrive" class="btn btn-warning" name="update_selfdrive" value="update" / >
                                            </div>
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
  