<!--Google Address :: START-->
<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/jquery.geocomplete.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/dist/locationpicker.jquery.min.js"></script>
<span id="selfdrivemessage"></span>		
<form class="form-horizontal lcns userreg-form"  action="" method="POST" name="weekEnd" id="weekendform1" enctype="multipart/form-data">

    <div class="row"><h3 class="col-sm-12">Week End Prices</h3></div>
    <div class="row">                                  
        <div class="col-md-6">
            <label class="col-md-6 control-label">Kms per Hour</label>
            <div class="col-md-6">
                <input type="text" name="weekend_kmperhr" class="form-control" id='weekend_kmperhr'>
                <?php
                if (isset($errors['weekend_kmperhr'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['weekend_kmperhr'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>

        </div>
    </div>				
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Extra Rate Per Kms</label>
            <div class="col-md-6">
                <input type="text" name="weekend_extrarate" class="form-control" id='weekend_extrarate'>
                <?php
                if (isset($errors['weekend_extrarate'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['weekend_extrarate'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Price Per Hour</label>
            <div class="col-md-6">
                <input type="text" name="weekend_priceperhr"class="form-control" id='weekend_priceperhr'>

                <?php
                if (isset($errors['weekend_priceperhr'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['weekend_priceperhr'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="col-md-6 control-label">Security Deposit</label>
            <div class="col-md-6">
                <input type="text" name="weekend_deposit" class="form-control" id='weekend_deposit'>
                <?php
                if (isset($errors['weekend_deposit'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['weekend_deposit'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div>

        </div>                                        
    </div>

    <div class="form-group">
        <div class="col-sm-6">
            <button type="submit" class="addvehicle btn btn-warning" id="btn_weekend" name="btn_weekend">Add</button>
        </div>
        <?php
        if (isset($response['code']) && 200 == $response['code']) {
            ?>
            <font color="green"><div id="message">
                <?php
                echo isset($response['message']) ? $response['message'] : NULL;
                ?>
            </div></font>
            <?php
        }
        ?>
    </div>
</form>

<script>

</script>

