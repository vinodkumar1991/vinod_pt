<script>
 function checkper(id,subid)
{ 
	var id=id;
	var subid=subid;
	var catid=$('#cat_id').val();
	var serviceid=$('#services').val();
	var name='id'+id+'/'+subid;
	

	
	 if(document.getElementById(name).checked == true)
		{
			
					$.post('../BikeList/updatepackages',{
					  
						id:id,
						subid:subid,
						cid:catid,
						sid:serviceid
					},
					function(data)
					{
						
							$('#basic').html(data);	
					});
					   
					 
		}
		else if(document.getElementById(name).checked == false)
		{
			 
			$.post('../BikeList/Uncheckupdatepackages',{
					  
						id:id,
						subid:subid,
						cid:catid,
						sid:serviceid
					},
					function(data)
					{
						$('#basic').html(data);		 
					});
					
				
		}

}

	$(document).ready(function(){
		
		
			$('#td1').hide();
            $('#td2').hide(); $('#basic').hide();
   
    $('#services,#cat_id').change(function(){
   
		   if ($('#cat_id').val() == '' || $('#services').val() == '') {
            $('#td1').hide();
            $('#td2').hide();
			$('#basic').hide();
        } else {
        if($('#services').val() == '1') {
			
			$('#basic').show();
			$('#td2').hide();
            $('#td1').show(); 
			
			var catid=$('#cat_id').val();
			var serviceid=$('#services').val();
			$.post('../BikeList/amountcal',{
						
						cid:catid,
						sid:serviceid
					},
					function(data)
					{
						$('#basic').html(data);		 
					});
			
        }		
		if($('#services').val() == '2') {
			$('#basic').show();
			$('#td1').hide();
            $('#td2').show(); 
				var catid=$('#cat_id').val();
			var serviceid=$('#services').val();
			$.post('../BikeList/amountcal',{
						
						cid:catid,
						sid:serviceid
					},
					function(data)
					{
						$('#basic').html(data);		 
					});
        }
		}
			   
    });
	  
	   
		
		
		setTimeout(function() {
    $('.btn-success').fadeOut('fast');
}, 1300);

  });	
	 		 
  </script>


									<ul class="nav nav-tabs" role="tablist">
                                        <li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/createService">Create Repair</a></li>
                                        <li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/Repairlist">Repair List</a></li>
                                        <li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/Servicepackagelist">Service Package List</a></li>
                                        <li  class="active"><a href="<?php echo Yii::app()->baseurl; ?>/index.php/BikeList/bikepackagelist">Bike Package List</a></li>
                                    </ul>

                                    <div class="tab-content servicepack-wrapper">                                  
                                    <div class="table-responsive">
                                    <div class="col-md-4">
                                            <label class="col-sm-5 control-label">Select Category</label>
                                            <div class="col-sm-7">
                                                <select name="vehicle_category" id="cat_id">
                                                    <option value="">Select Category</option>
                                                  
                                                    <?php  foreach($bikecat as $service) { ?>
													<option value="<?php echo $service['id']; ?>"><?php echo $service['category_name']; ?></option>
													<?php }  ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="col-sm-3 control-label">Select Type of Service</label>
                                            <div class="col-sm-4">
                                                <select name="services" id="services">
                                                    <option value="">Select Service</option>
                                                   
                                                    <?php  foreach($services1 as $service) { ?>
													<option value="<?php echo $service['id']; ?>"><?php echo $service['snames']; ?></option>
													<?php }  ?>
                                               
                                                </select>
												</div>
												 <div class="col-sm-6">
											<span id="basic"></span><?php echo "&nbsp;&nbsp;"; ?>
											
                                        </div>
									
                                    </div>
						
									<table class="table responsive" cellspacing="0" width="100%" border="1">
								
                                  <?php echo $html; ?>
							 <?php echo $html1; ?>
                                    </div>