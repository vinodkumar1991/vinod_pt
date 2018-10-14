
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/datetimepicker/css/bootstrap-datetimepicker.min.css">
<script src="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

<!--Menu :: START-->
<ul class="nav nav-tabs" role="tablist">
    <li>
        <a href="<?php echo Yii::app()->params['webURL'] . 'SelfDrive/Agent/AgentVehicle'; ?>">Create</a>
    </li>
    <li class="active">
        <a href="<?php echo Yii::app()->params['webURL'] . 'SelfDrive/Agent/AgentVehiclesReport'; ?>">Report</a>
    </li>
</ul>
<!--Menu :: END-->

<form class="form-horizontal lcns 4 userreg-form" method="POST" name="vehicle_timings_form" id="vehicle_timings_form">
<div class="row"><h3 class="col-sm-12">Add Vehicles Timings</h3></div>
    <div class="row">
        <div class="col-md-12">
            <label class="col-md-3 control-label">Start Date</label>
            <div class="col-md-2">
                <input type="text" name="vehicle_start_date" id="vehicle_start_date" class="form-control" />
                <?php echo isset($errors['vehicle_start_date'][0]) ? $errors['vehicle_start_date'][0] : NULL;?>
            </div>
        </div>
        <div <div class="col-md-12">
            <label class="col-md-3 control-label">End Date</label>
            <div class="col-md-2">
                <input type="text" name="vehicle_end_date" id="vehicle_end_date" class="form-control" />
                    <?php
                    echo isset($errors['vehicle_end_date'][0]) ? $errors['vehicle_end_date'][0] : NULL;
                    ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-4">
            <input type="submit" name="add_vehicles_timings" class="btn btn-warning" id="add_vehicles_timings" value="Add"/>
        </div>
    </div>  
</form>

 <!--Tab Menus :: END-->  

    <div class="col-md-12">
        <div class="table-responsive">
            <table class="datatable table table-striped" cellspacing="0" width="100%" id="example">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Is Available</th>
                        <th>Status</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($SelfVehiclesTiming)) {
                        $i = 0;
                        foreach ($SelfVehiclesTiming as $arrtimings) {
                            $i++;
                            ?>
                            <tr data-toggle="modal">
                                <td>
                                    <?php echo $i; ?>
                                </td>
                                <td>
                                    <?php
                                    echo isset($arrtimings['start_date']) ? $arrtimings['start_date'] : NULL;
                                    ?>
                                </td>       
                                <td>
                                    <?php
                                    echo isset($arrtimings['end_date']) ? $arrtimings['end_date'] : NULL;
                                    ?>
                                </td>    
                                 <td align="center">
                                    <?php
                                    $availabel = 'Yes';
                                    if (0 == $arrtimings['is_available']) {
                                        $availabel = 'No';
                                    }
                                    echo $availabel;
                                    ?>
                                </td> 
                               <td align="center">
                                    <?php
                                    $status = 'Active';
                                    if (0 == $arrtimings['status']) {
                                        $status = 'Inactive';
                                    }
                                    echo $status;
                                    ?>
                                </td>
                               
                            </tr>
                            <?php
                        }
                        unset($agents_report);
                        unset($i);
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


<script type="text/javascript">
         jQuery("#vehicle_start_date").datetimepicker({
            format: 'yyyy-mm-dd hh:ii', 
            autoclose: 1,
            todayHighlight: 1,
            minuteStep: 30,
            startDate: new Date()
        });
          
        jQuery("#vehicle_end_date").datetimepicker({
            format: 'yyyy-mm-dd hh:ii', 
            autoclose: 1,
            todayHighlight: 1,
            minuteStep: 30,
            startDate: new Date()
    });
</script>