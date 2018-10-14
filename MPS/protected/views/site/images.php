
<script type="text/javascript">
function validate()
{
    var modhome = $('#imake').val();
    var carbike = $('#imodel').val();
    if(modhome == ''){
        $('#mherr').show();
        return false;
    }
    
   
   
    document.iimake.submit();
}
function checkmodel(id)
{
   
   var val=id;

   if(val==1)
    {
        $("#imps").show();
    }
    else
    {
        $("#imps").hide();
        $("#imodel").val('');
    }
    
}


</script>
<?php

if(isset($_REQUEST['message'])){

    $message = $_REQUEST['message'];
}else{
    $message = '';
}

?>
<div class="card-body">

                    <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="active"><a href="dashboard">Upload images</a></li>
                            
                        </ul>
                    <!-- Tab panes -->
                        <div class="tab-content">
                            <form class="form-horizontal lcns" name="iimake" enctype="multipart/form-data" action="imageupload" method="POST">
                            <div class="form-group" >
                                <label class="col-sm-2 control-label">Image</label>
                                <div class="col-sm-2">
                                    <select  id="imake" name="imake" onChange="checkmodel(this.value);">
                                        <option value="">Select </option>  
                                        <option value="1">Models </option> 
                                        <option value="2">Homescreen </option>          
                                    </select>
                                    <span id="mherr" style="color:red;display: none;">Please select Model/Home screen</span>
                                   
                                </div>
                               </div>
                               <div class="form-group" id="imps" style="display: none;">
                                <label class="col-sm-2 control-label">Select model</label>
                               <div class="col-sm-2" >
                                    <select  id="imodel" name="imodel">
                                        <option value="">Select </option>  
                                        <option value="1">Car</option> 
                                        <option value="2">Bike</option>          
                                    </select>
                                    <span id="carbkeerr" style="color:red;display: none;">Please select Car/Bike</span>
                                   
                                </div>
                                </div>

                             <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                         
                              <!--  <input name= "userfile" type="file" />-->
                                 <input type="file" name="userfile" data-type="image" />
                                </div>
                                
                            </div>
							<div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="button" class="btn btn-warning" onClick="validate()">Submit</button>
                                    
                                </div>
                                
                            </div>
						</form>
                        <?php

                        if($message!='')
                        {
                            if($message==1)
                            {
                                echo "<font color='red'>Invalid file type. Only JPEG, JPG, GIF and PNG types are accepted </font>";
                            }
                            if($message==2)
                            {
                                echo "<font color='red'>File too large. File must be less than 256kb </font>";
                            }
                            if($message==0)
                            {
                                echo "<font color='green'>Successfully uploaded </font>";
                            }
                            
                        }
                        ?>

						</div>
					</div>
                        
                            
