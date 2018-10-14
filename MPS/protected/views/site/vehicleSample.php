<script>


function getModel(makerId)
{
	$.post('../site/Getvmodel',{
		Maker:makerId,
	},
	function(data)
	{ 
		
		
		$(".vmodel").html("");
		$(".vmodel").append(data);
	});
}
  $(document).ready(function(){
      var i=1;
     $("#add_row").click(function(){
      $('#addr'+i).html("<td>"+ (i+1) +"</td><td>  <select class='vmodel form-control input-md' name='vmodel[]'></select></td><td><input type='file' name='carfile[]' data-type='image' /></td>");

      $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
      i++; 
  });
     $("#delete_row").click(function(){
         if(i>1){
         $("#addr"+(i-1)).html('');
         i--;
         }
     });

});
</script>
<body>
<div class="card-body">
                                <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="active"><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/createService">Create Service</a></li>
                                        <li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/createVehicleaddimage">Service List</a></li>
                                    </ul>
                                <!-- Tab panes -->
                                    <div class="tab-content">
                                            <form class="form-horizontal lcns" method="post" enctype="multipart/form-data" action="createVehicleaddimage">
                                
                           <div class="form-group">
                                            <label class="col-sm-2 control-label">Vehicle Maker</label>
                                            <div class="col-sm-10">
                                                <select onChange="getModel(this.value)" id="vmake" NAME="vmake">
                                                    <option value="">Select Vehicle Maker</option>
                                                    <?php
                    foreach ($vmakelist as $vmake) {
                    	echo "<option value='".$vmake['makes_id']."'>".$vmake['makes_name']."</option>";
                    }
                    ?>
                                                    
                                                </select>
                                                <span id="vmakeerr" style="color:red;display: none;">Please select  Maker</span>
                                            </div>
                                        </div> 
										
										<div class="form-group">
                                            <label class="col-sm-2 control-label">Logo</label>
                                            <div class="col-sm-10">
                                                 <input type="file" name="logofile" ID="logofile" data-type="image" required/>
                                                <!--<span id="vmodelerr" style="color:red;display: none;">Please select Model</span>-->
                                            </div>
                                        </div>
									<div class="form-group" id="armps">
                                        <label class="col-sm-2 control-label" >Enter models</label>
                                        <div class="col-sm-3">
                                             <table class="table table-bordered table-hover" id="tab_logic">
                <thead>
                    <tr >
                        <th class="text-center">
                            #
                        </th>
                        <th class="text-center">
                            Sub Service Name
                        </th>
                       
                    </tr>
                </thead>
                <tbody>
                    <tr id='addr0'>
                        <td>
                        1
                        </td>
                        <td>
                       <select class="vmodel" name="vmodel"></select>
                        </td>
						  <td>
                       <div class="form-group">
                                            <label class="col-sm-2 control-label">Car</label>
                                            <div class="col-sm-10">
                                                 <input type="file" name="carfile[]" data-type="image" ID="carfile" />
                                                <!--<span id="vmodelerr" style="color:red;display: none;">Please select Model</span>-->
                                            </div>
                                        </div>
                        </td>
                        
                    </tr>
                    <tr id='addr1'></tr>
                </tbody>
            </table>
			<a id="add_row" class="btn btn-default pull-left">Add Row</a><a id='delete_row' class="pull-right btn btn-default">Delete Row</a>
                                        </div>

                                    </div>
                                   
                                    <!--<div class="form-group">
                                        <label class="col-sm-2 control-label">Location</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" id="" placeholder="Enter Location">
                                        </div>
                                    </div>-->
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-warning"  name="add" onClick="locsubmit();">Submit</button>
                                            </div>
                                            <span id="loading" style="display:none; align:center"><img src="<?php echo Yii::app()->baseUrl?>/images/load.gif" width="100px" height="100px"></span>
                                        </div>
                                        </form>
                                </div>
                            </div>
