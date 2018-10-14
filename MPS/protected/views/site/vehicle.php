<script>

    function getModel(makerId)
    
        $.post('../site/Getvmodel', {
            Maker: makerId,
        },
                function (data)
                {


                    $("#vmodel").html("");
                    $("#vmodel").append(data);
                });
    }
   
</script>
<div class="card-body">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/vehicle">Add Vehicle</a></li>
        <li ><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/vehiclelist?id=1">Vehicle List</a></li>

    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <form class="form-horizontal lcns" method="post" enctype="multipart/form-data" action="vsave">

            <div class="form-group">
                <label class="col-sm-2 control-label">Category</label>
                <div class="col-sm-3">
                    <select id="category" name="category_id">
                        <?php
                        if (!empty($vcat)) {
                            foreach ($vcat as $vcats) {
                                ?>
                                <option value="<?php echo $vcats['id']; ?>"><?php echo $vcats['categoryname']; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>

                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Vehicle Brand</label>
                <div class="col-sm-3">
                    <select onChange="getModel(this.value)" id="vmake" NAME="vmake">
                        <option value="">Select Vehicle Brand</option>
                        <?php
                        foreach ($vmakelist as $vmake) {
                            echo "<option value='" . $vmake['makes_id'] . "'>" . $vmake['makes_name'] . "</option>";
                        }
                        ?>

                    </select>
                    <span id="vmakeerr" style="color:red;display: none;">Please select  Model</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Vehicle Model</label>
                <div class="col-sm-3">
                    <select id="vmodel" NAME="vmodel">
                        <option value="">Select Vehicle Model</option>

                    </select>
                    <span id="vmodelerr" style="color:red;display: none;">Please select Model</span>
                </div>
            </div>


         


            <div class="form-group">
                <label class="col-sm-2 control-label">Year</label>
                <div class="col-sm-3">
                    <select id="valyear" name="valyear" >
                        <option value="">Select Year</option>
                        <?php
                        for ($i = 1900; $i <= 2016; $i++) {
                            echo "<option value='" . $i . "'>" . $i . "</option>";
                        }
                        ?>
                    </select>
                    <span id="vyearerr" style="color:red;display: none;">Please select Year</span>
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-2 control-label">Logo</label>
                <div class="col-sm-3">
                    <input type="file" name="logofile" ID="logofile" data-type="image" accept="image/*" capture required/>
                   <!--<span id="vmodelerr" style="color:red;display: none;">Please select Model</span>-->
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Car</label>
                <div class="col-sm-3">
                    <input type="file" name="carfile" data-type="image" ID="carfile" accept="image/*" capture required/>
                   <!--<span id="vmodelerr" style="color:red;display: none;">Please select Model</span>-->
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="SUBMIT" class="btn btn-warning">Submit</button>
                </div>

            </div>
            <font color="green"><div id="message"><?php
                        if (isset($message)) {
                            echo $message;
                        }
                        ?></div></font>
        </form>
    </div>
</div>


