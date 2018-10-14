<div class="card-body">
    <ul class="nav nav-tabs" role="tablist">
        <li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/Vehicles/Brands/createBrand">Create Brand</a></li>
        <li class="active"><a href="<?php echo Yii::app()->baseurl; ?>/index.php/Vehicles/Brands/createBrandReport">Brands Report</a></li>
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
                if (!empty($brands)) {
                    $i = 0;
                    foreach ($brands as $arrEleBrand) {
                        $i++;
                        ?>
                        <tr data-toggle="modal" data-id="1" data-target="#signup-model">
                            <td align="center">
                                <?php echo $i; ?>
                            </td>
                            <td align="center">
                                <?php
                                echo isset($arrEleBrand['brand_name']) ? $arrEleBrand['brand_name'] : NULL;
                                ?>
                            </td>       

                            <td align="center">
                                <?php
                                echo isset($arrEleBrand['brand_code']) ? $arrEleBrand['brand_code'] : NULL;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                if (isset($arrEleBrand['vehicle_id']) && 2 == $arrEleBrand['vehicle_id']) {
                                    ?>
                                    <img src="<?php echo $bike_logo_path . '/' . $arrEleBrand['brand_logo']; ?>" width="50px" />
                                    <?php
                                } else {
                                    ?>
                                    <img src="<?php echo $car_logo_path . '/' . $arrEleBrand['brand_logo']; ?>" width="50px" />
                                    <?php
                                }
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                $status = 'Active';
                                if (0 == $arrEleBrand['brand_status']) {
                                    $status = 'Inactive';
                                }
                                echo $status;
                                ?>
                            </td>
                            <td align="center">
                                <a data-toggle="modal" data-target="#UpdateBrands" title="edit" class="clickbtn edit-u" onclick="ViewBrandDetails('<?php echo $arrEleBrand['brand_id']?>');">
                               <i class="fa fa-pencil" aria-hidden="true"></i>
                              </a> 
                            </td>
                        </tr>
                        <?php
                    }
                    unset($brands);
                    unset($i);
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div id="UpdateBrands" class="modal fade" role="dialog">
    <div class="modal-dialog">   
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Manage Brands</h4>
        </div>
        <div class="modal-body">
            <form class="form-horizontal lcns " action="" method="POST">
                <input type="hidden" name="brand_id" id="brand_id" />
                <div class="row">
                <div class="col-md-6">
                <label class="col-md-6 control-label">Brand Name</label>
                <div class="col-md-6">
                    <input type="text" id="barnd_name" name="barnd_name" class="form-control" readonly="readonly">                    
                </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <label class="col-md-6 control-label">Brand Code</label>
                        <div class="col-md-6">
                            <input type="text" id="brand_code" name="brand_code" class="form-control" readonly="readonly">                           
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <label class="col-md-6 control-label">Brand Logo</label>
                        <div class="col-md-6" id="brand_logo">
                                                        
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <label class="col-md-6 control-label">Status</label>
                        <div class="col-md-6">
                            <select name="brand_status" id="brand_status">
                            <option value="1">Active</option>
                            <option value="0">InActive</option>
                            </select>
                        </div>
                    </div>								
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-6 col-sm-6">
                        <input type="button" id="update" class="btn btn-warning" name="update" value="update" onclick="UpdateBrandDetails();" />
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>


<script>

//View Details in dialog screen
function ViewBrandDetails(BrandID){
            $("#brand_id").val(BrandID);
            $("#brand_logo").html("");
            var bikePath='<?php echo Yii::app()->params['adminImgURL'].'bikes/web/brands/60X40'?>';
            var carPath='<?php echo Yii::app()->params['adminImgURL'].'cars/web/brands/60X40'?>';  
            $("#brand_status option").attr('selected',false);
            $.ajax({
               type:'POST', 
               url:'<?php echo Yii::app()->params['webURL'] . 'Vehicles/Brands/ViewBrand' ?>',
               data:'&BrandID='+BrandID,
               catch:false,
               success:function(data){                   
                   var obj=JSON.parse(data);
                   $("#barnd_name").val(obj[0]['brand_name']);
                   $("#brand_code").val(obj[0]['brand_code']);
                   if(obj[0]['vehicle_id'] !=2){                       
                       $("#brand_logo").append('<img width="80px"src='+carPath+'/'+obj[0]['brand_logo']+'>');
                   }else{
                       $("#brand_logo").append('<img width="80px"src='+bikePath+'/'+obj[0]['brand_logo']+'>');
                   }                   
                   $("#brand_status option[value="+obj[0]['brand_status']+"]").attr('selected',true);                   
                   }
            });           
 }
 //Update the Brand details
 function UpdateBrandDetails(){
            if($('#brand_status').val() !=''){
                $.ajax({
                   type:'POST', 
                   url:'<?php echo Yii::app()->params['webURL'] . 'Vehicles/Brands/UpdateBrandDetails' ?>',
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