<?php
//echo '<pre>';
//print_r($delv_details);
//exit;
?>
<script>
function deleteh(id)
{
	var edata=id;
	
	var con=confirm("Are you sure you want to delete!");
	if(con==true)
	{
       $.post('<?php echo Yii::app()->request->baseUrl?>/index.php/HIREAMECHANIC/Deletehire',{
		  
			id:edata
		},
		function(data)
		{
			
           var form=document.createElement('form');
			form.setAttribute('method','post');
			form.setAttribute('action','<?php echo Yii::app()->request->baseUrl?>/index.php/HIREAMECHANIC/FetchHireData');
			document.body.appendChild(form);
			form.submit();
        });
   }
}   
$( document ).ready(function() {
	
	$( ".clickbtn" ).click(function() 
	{
			
		$('#id').val($(this).attr('id'));
		
		var edata=$(this).attr('id');
		
			$.post('../HIREAMECHANIC/UpdateHire',
			{
		  
				id:edata
			},
		function(data)
		{
					var data=JSON.parse(data);					
						$('#hiremechanicid').val(data[0]['hire_mechanic_id']);
						$('#booking_charge').val(data[0]['booking_charge']);
						$('#name').val(data[0]['name']);
						$('#mobileno').val(data[0]['mobileno']);
						$('#email').val(data[0]['email']);
						$('#company_name').val(data[0]['company_name']);
						$('#Year_of_exp').val(data[0]['Year_of_exp']);
						$('#location').val(data[0]['location']);
           
        });
		
	});
	
setTimeout(function() {
    $('.success').fadeOut('fast');
}, 1300);
});
</script> 
							 <div class="tab-content">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li ><a href="<?php echo Yii::app()->request->baseUrl?>/index.php/mPSUserRegistration/userRegister">Create User</a></li>
										<li class="active"><a href="<?php echo Yii::app()->request->baseUrl?>/index.php/mPSUserRegistration/Managermechanicshop">Manage User</a></li>
                                    </ul>
                                    </div>
                                    <div class="tab-content">
                                        <ul class="nav nav-tabs">
                                            <li ><a href="<?php echo Yii::app()->request->baseUrl?>/index.php/mPSUserRegistration/Managermechanicshop">Mechanic Shop</a></li>
                                           <!-- <li><a href="<?php echo Yii::app()->request->baseUrl?>/index.php/mPSUserRegistration/FetchDeliveryboydata">Delivery Boy</a></li> -->
                                              <li><a href="<?php echo Yii::app()->request->baseUrl?>/index.php/MPSSELFDRIVEAGENCY/FetchSelfDrivedata">Self Drive Agent</a></li>
                                           
                                            <li class="active"><a href="<?php echo Yii::app()->request->baseUrl?>/index.php/HIREAMECHANIC/FetchHireData/">Hire a Mechanic</a></li>
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
                                                <th>Hiremechanic Id</th>
                                                <th>Vehicle Type</th>
                                                <th>Profesional</th>
                                                <th>Booking Charge</th>
                                                <th>Mechanic Name</th>
												<th>Company Name</th>
                                                <th>Mobile No</th>
                                                                                            
                                              <!-- <th>Email</th>  	<td>'.$self_detail['email'].'</td><td>'.$self_detail['address'].'</td> <th>Address</th>       -->                                        
                                                <th>Year Of Exp</th>                                          
												<th>Id Proof</th>                                               
                                                <th>Created Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                              <?php 

											  
											  $i=1;
                    foreach ($self_details as $self_detail) {
                    	
                                              
											    echo ' <tr>';
											   echo ' 
											    <td>'.$i.'</td>
											   `<td>'.$self_detail['hire_mechanic_id'].'</td>
												<td>'.$self_detail['vehicle_type'].'</td>	  
												<td>'.$self_detail['profesional'].'</td>
												<td>'.$self_detail['booking_charge'].'</td>
												<td>'.$self_detail['name'].'</td>
												<td>'.$self_detail['company_name'].'</td>
												<td>'.$self_detail['mobileno'].'</td>
												<td>'.$self_detail['Year_of_exp'].'</td>							
												<td align="center">
													<a href="'.Yii::app()->request->baseUrl.'/'.$self_detail['upload_pic_path'].'" class="imghover"><i class="fa fa-picture-o" aria-hidden="true"></i></a></td>
												 
												<td>'.date('d-m-Y',strtotime($self_detail['created_date'])).'</td>
												<td><a data-toggle="modal" data-target="#updateHiremechanic" title="edit" id="'.$self_detail['id'].'" class="clickbtn edit-u"><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                                                    <a href="#" title="Trash" class="delete-u" onclick="deleteh('.$self_detail['id'].');" ><i class="fa fa-trash" aria-hidden="true"></i></a></td>';
											   echo '</tr>';
											   $i++;
                                               
                    }
					

					
                    ?>
<script>
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
									
<div id="updateHiremechanic" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Manage Hire Mechanic</h4>
      </div>
      <div class="modal-body">
        <!-- Delivery Boy Form -->
                                      <form class="form-horizontal lcns 5 userreg-form" method="POST" action="Updatehiredata" enctype="multipart/form-data">
                                       
                                        <div class="row">
										<input type="hidden" name="hroletype" id="hroletype">
											<div class="col-md-6">
												<label class="col-md-6 control-label">Mechanic ID</label>
												<div class="col-md-6">
													<input type="text" class="form-control" id="hiremechanicid" name="hire_mechanic_id" readonly="true" >
													<input type="hidden" id="id" name="id"> 
												</div>
											</div>
                                        </div>
									
                                 
								
                                        <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Booking Charge</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="booking_charge" name="booking_charge" />
                                            </div>
                                        </div>
                                        </div>
									
										
                                        <div class="row"><h3 class="col-sm-12">Enter Personal Details</h3></div>
                                        <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Name</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="name" name="name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Enter Company Name</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="company_name" name="company_name">
                                            </div>
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Mobile No.</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="mobileno" name="mobileno">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Years of Experience</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="Year_of_exp" name="Year_of_exp">
                                            </div>
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Email </label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="email" name="email">
                                            </div>
                                        </div>
                                        
                                        </div>
                                   
                                    
                                     
                                        <div class="form-group">
                                            <div class="col-sm-offset-6 col-sm-6">
                                                <input type="submit"  name="updateHired" value="Update" />
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
                             
       