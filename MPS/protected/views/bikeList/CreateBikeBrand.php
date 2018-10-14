

<body>
    <div class="card-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="<?php echo Yii::app()->baseurl; ?>/index.php/BikeList/CreateBikeBrand">Create Bike Brand</a></li>
            <li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/BikeList/CreateBikeModel">Create Bike Model</a></li>
            <li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/BikeList/allBikeList">All Bike List</a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <form class="form-horizontal lcns" method="post" enctype="multipart/form-data" action="CreateBikeBrand">

                <div class="form-group">
                    <label class="col-sm-2 control-label">Bike Brand Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="brand_name"/>

                    </div>
                </div> 

                <div class="form-group">
                    <label class="col-sm-2 control-label">Bike Brand Logo</label>
                    <div class="col-sm-10">
                        <input type="file" name="bikelogofile" ID="bikelogofile" data-type="image" accept="image/*" capture required/>
                       <!--<span id="vmodelerr" style="color:red;display: none;">Please select Model</span>-->
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-warning"  name="addbrand">Submit</button>
                    </div>
                    <span id="loading" style="display:none; align:center"><img src="<?php echo Yii::app()->baseUrl ?>/images/load.gif" width="100px" height="100px"></span>
                        <?php
                        if (isset($success)) {
                            echo $success;
                        }
                        ?>
                </div>

            </form>
        </div>
    </div>
