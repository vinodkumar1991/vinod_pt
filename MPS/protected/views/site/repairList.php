
  <script>
  
	$(document).ready(function(){
		
		 if($('#type').val() == 'car') {
			$('#bike1').hide();
            $('#car').show(); 
        }		
		if($('#type').val() == 'bike') {
			$('#car').hide();
            $('#bike1').show(); 
        }
    $('#type').change(function(){
		
        if($('#type').val() == 'car') {
			$('#bike1').hide();
            $('#car').show(); 
        }		
		if($('#type').val() == 'bike') {
			$('#car').hide();
            $('#bike1').show(); 
        }
    });
		
		
		
		setTimeout(function() {
    $('.btn-success').fadeOut('fast');
}, 1300);

					
 /*   $('.test').click(function()
  {
	
	  var rid=$(this).attr('id');
	  var par = $(this).parent().parent(); 
//tr var tdName = par.children("td:nth-child(1)");
alert( $('.1').val());
	   //var input = $(this).closest('tr').find('.hour').val();
	    //ctrl_name = $(this).closest('tr').find('input').val();
		//var subjectId = $(this).closest("td").find('input').val();    
	 // alert(subjectId);
	   	$.post('../site/Updaterepairlist',{
								Id:rid,
							},
							function(data)
							{ 
								
							
							}); 
	
  });*/	
	});	 		 
  </script>
    <style type="text/css">
input[type="text"]
{
	width:50px;
}
</style>

<?php 
 ?>  <ul class="nav nav-tabs" role="tablist">
                                       <li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/createService">Create Repair</a></li>
                                        <li  class="active"><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/Repairlist">Repair List</a></li>       
										
									<li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/Servicepackagelist">Service Package List</a></li> 
									 <li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/BikeList/bikepackagelist">Bike Package List</a></li>
                                   </ul>
                                   
								   <div class="tab-content">     <?php if(!empty($message))
{ ?>
<div class="btn-success"><p align="center"><?php echo "Update successfully"; ?></p></div>
	<?php 
} ?>                             
			<div class="table-responsive">
						Vehicle Type: <select name="type" id="type" style="margin-left:57px; width:153px;">
							<option name="bike" value="bike"<?php if(isset($message)){ if($message=='2') echo "selected"; } ?>>Bike</option>
							<option name="car" value="car"<?php if(isset($message)){ if($message=='1') echo "selected"; } ?>>Car</option>
							
						</select>        
						<div id="car">
						 <?php echo $repairlist; ?>  
						 </div>
						 <div id="bike1">
						 <?php echo $bikerepairlist; ?>  
						 </div>
			
			</div> 
