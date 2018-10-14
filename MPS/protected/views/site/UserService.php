<script>
  $(document).ready(function(){
      $('#carservice').hide();
      $('#bikeservice').hide();
      var i=1;
     $("#add_row").click(function(){
      $('#addr'+i).html("<td>"+ (i+1) +"</td><td><input name='user[]' type='text' placeholder='Repair Name' class='form-control input-md'  /></td>");

      $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
      i++; 
  });
     $("#delete_row").click(function(){
         if(i>1){
         $("#addr"+(i-1)).html('');
         i--;
         }
     });

  $('#vehicle_type').change(function()
  {
        vehicle_type=$('#vehicle_type').val();
       
        if(vehicle_type == 'car')
        {
              $('#bikeservice').hide();
              $('#carservice').show();
        }
        else
        {
              $('#carservice').hide();
              $('#bikeservice').show();
        }
  });

});
</script>
<body>
<div class="card-body">
                                <!-- Nav tabs -->
                                  <ul class="nav nav-tabs" role="tablist">
                                        <li class="active"><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/UserService">Create Repair</a></li>
                                        <li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/Repairlist">Repair List</a></li>
                                        <li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/Servicepackagelist">Service Package List</a></li>
					<li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/BikeList/bikepackagelist">Bike Package List</a></li>
                                   </ul>
                                <!-- Tab panes -->
	  <form class="form-horizontal lcns" method="POST" action="../UserService/UserService/AddUserService">							
         <div class="tab-content">
          
		<div class="col-md-5">                                   
                        <div class="form-group">
			   <label >Enter vehicle Type</label>
                            <select id="vehicle_type" name="vehicle_type">
                                <option>Select vehicle Type</option>
                                <option value="car">Car</option>
                                <option value="bike">Bike</option>
                            </select>
			</div>  									</div>  
			<div class="col-md-offset-1 col-md-5" id="bikeservice"> 
                            <div class="form-group">
                                <label >Enter Service Type</label>
                                <select id="bike_ser_type" name="bike_service_type">
                                    <option>Select Service Type</option>
                                    <option value="1">General</option>
                                    <option value="2">Repairjob</option>
                                    <option value="3">Oil Change</option>
                                    <option value="4">Washing</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-offset-1 col-md-5" id="carservice"> 
                            <div class="form-group">
                                <label >Enter Service Type</label>
                                    <select id="car_veh__type" name="car_service_type">
                                        <option>Select Service Type</option>
                                        <option value="1">General</option>
                                        <option value="2">Periodic</option>
                                        <option value="3">Repair Job</option>
                                        <option value="7">Washing</option>
                                        <option value="8">Denting</option>
                                    </select>
                            </div>
                        </div>
                        <div class="col-md-5">									
                            <div class="form-group" id="armps">
				<label>Enter Repair Title</label>
				    <input type="text" class="form-control" name="servicename" id="amps" placeholder="Enter Repair Title" >
				    <span id="ampserr" style="color:red;display: none;">Enter Repair Title</span>
				
                                    
			    </div>  											
                        </div>
          
         </div>
                <div class="col-md-offset-1 col-md-5">
                    <div class="form-group" id="armps">
                        <div>
                            <table class="table table-bordered table-hover" id="tab_logic">
                                            <thead>
                                                <tr >
                                                    <th class="text-center">
                                                        #
                                                    </th>
                                                    <th class="text-center">
                                                        Sub Repair LIst
                                                    </th>

                                                </tr>
                                            </thead>
                                    <tbody>
                                        <tr id='addr0'>
                                            <td>
                                            1
                                            </td>
                                            <td>
                                            <input type="text" name='user[]'  placeholder='Repair Name' class="form-control"/>
                                            </td>

                                        </tr>
                                        <tr id='addr1'></tr>
                                    </tbody>
                            </table>           
                    <div class="col-md-6">
			<a id="add_row" class="btn btn-default">Add Row</a><a id='delete_row' class="btn btn-default">Delete Row</a>
		    </div><div class="col-md-4"><div class="form-group">			  
                    <button type="submit" class="btn btn-warning"  name="add" onClick="locsubmit();">Submit</button>  			<span id="loading" style="display:none; align:center"><img src="<?php echo Yii::app()->baseUrl?>/images/load.gif" width="100px" height="100px"></span>		</div>		</div>
                       </div>			
                    </div>
                        
                                  
            </div>
            </form>                          
        </div>
</div>
