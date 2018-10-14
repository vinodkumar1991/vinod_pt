<div class="card-body">
    <ul class="nav nav-tabs" role="tablist">
        <li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/Vehicles/Brands/CreateBrandModels">Create Model</a></li>
        <li class="active" ><a href="<?php echo Yii::app()->baseurl; ?>/index.php/Vehicles/Brands/CreateBrandModelsReport">Models Report</a></li>
    </ul>

    <div class="table-responsive">
        <table class="datatable table table-striped" cellspacing="0" width="100%" id="example">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Logo</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($brandModels)) {
                    $i = 0;
                    foreach ($brandModels as $arrEleBrand) {
                        $i++;
                        ?>
                        <tr data-toggle="modal" data-id="1" data-target="#signup-model">
                            <td align="center">
                                <?php echo $i; ?>
                            </td>
                            <td align="center">
                                <?php
                                echo isset($arrEleBrand['brand_model_name']) ? $arrEleBrand['brand_model_name'] : NULL;
                                ?>
                            </td>       

                            <td align="center">
                                <?php
                                echo isset($arrEleBrand['brand_model_code']) ? $arrEleBrand['brand_model_code'] : NULL;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                if (isset($arrEleBrand['vehicle_id']) && 2 == $arrEleBrand['vehicle_id']) {
                                    ?>
                                    <img src="<?php echo $bike_model_path . '/' . $arrEleBrand['brand_model_logo']; ?>" width="50px" />
                                    <?php
                                } else {
                                    ?>
                                    <img src="<?php echo $car_model_path . '/' . $arrEleBrand['brand_model_logo']; ?>" width="50px" />
                                    <?php
                                }
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                $status = 'Active';
                                if (0 == $arrEleBrand['brand_model_status']) {
                                    $status = 'Inactive';
                                }
                                echo $status;
                                ?>
                            </td>
                            <td align="center">
                                <a data-toggle="modal" data-target="#UpdateModel" title="edit" class="clickbtn edit-u" onclick="ViewBrandModelDetails('<?php echo $arrEleBrand['brand_model_id']?>');">
                               <i class="fa fa-pencil" aria-hidden="true"></i>
                              </a> 
                            </td>
                        </tr>
                        <?php
                    }
                    unset($brandModels);
                    unset($i);
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<div id="UpdateModel" class="modal fade" role="dialog">
    <div class="modal-dialog">   
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Manage Models</h4>
        </div>
        <div class="modal-body">
            <form class="form-horizontal lcns " action="" method="POST">
                <input type="hidden" name="model_id" id="model_id" />
                <div class="row">
                <div class="col-md-6">
                <label class="col-md-6 control-label">Model Name</label>
                <div class="col-md-6">
                    <input type="text" id="model_name" name="model_name" class="form-control" readonly="readonly" style="width:200px;">                    
                </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <label class="col-md-6 control-label">Model Code</label>
                        <div class="col-md-6">
                            <input type="text" id="model_code" name="model_code" class="form-control" readonly="readonly">                           
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <label class="col-md-6 control-label">Model Logo</label>
                        <div class="col-md-6" id="model_logo">                                                        
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <label class="col-md-6 control-label">Status</label>
                        <div class="col-md-6">
                            <select name="model_status" id="model_status">                            
                            <option value="1">Active</option>
                            <option value="0">InActive</option>
                            </select>
                        </div>
                    </div>								
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-6 col-sm-6">
                        <input type="button" id="update" class="btn btn-warning" name="update" value="update" onclick="UpdateBrandModelDetails();" />
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

<script>
//View Details in dialog screen
function ViewBrandModelDetails(ModelID){
            $("#model_id").val(ModelID);
            $("#model_logo").html("");
            var bikePath='<?php echo Yii::app()->params['adminImgURL'].'bikes/web/models/60X35'?>';
            var carPath='<?php echo Yii::app()->params['adminImgURL'].'cars/web/models/60X35'?>';  
            $("#model_status option").attr('selected',false);
            $.ajax({
               type:'POST', 
               url:'<?php echo Yii::app()->params['webURL'] . 'Vehicles/Brands/ViewModels' ?>',
               data:'&ModelID='+ModelID,
               catch:false,
               success:function(data){                   
                   var obj=JSON.parse(data);
                   $("#model_name").val(obj[0]['brand_model_name']);
                   $("#model_code").val(obj[0]['brand_model_code']);
                   if(obj[0]['vehicle_id'] !=2){                       
                       $("#model_logo").append('<img width="80px"src='+carPath+'/'+obj[0]['brand_model_logo']+'>');
                   }else{
                       $("#model_logo").append('<img width="80px"src='+bikePath+'/'+obj[0]['brand_model_logo']+'>');
                   }                   
                   $("#model_status option[value="+obj[0]['brand_model_status']+"]").attr('selected',true);                   
                   }
            });           
 }
 //Update the Brand details
 function UpdateBrandModelDetails(){
            if($('#model_status').val() !=''){
                $.ajax({
                   type:'POST', 
                   url:'<?php echo Yii::app()->params['webURL'] . 'Vehicles/Brands/UpdateModelDetails' ?>',
                   data:jQuery('form').serialize(),
                   catch:false,
                   success:function(data){                      
                       alert(data);                       
                       location.reload(true);
                   }
                });  
            }else{
                alert('Please Select Status');
                return false;
            }
 }
</script>
