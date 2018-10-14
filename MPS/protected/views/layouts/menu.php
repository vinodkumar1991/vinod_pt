<ul class="nav navbar-nav">
    <?php
    $intRole = Yii::app()->session['role_id'];
    if (6 == $intRole) { //Superadmin
        ?>
        <!--Agents :: START-->
        <li>
            <a href="<?php echo Yii::app()->params['webURL']; ?>/SelfDrive/Agent/Create">
                <span class="icon fa fa-star"></span><span class="title">Self Drive Agents</span>
            </a>
        </li>
        <!--Agents :: END-->

        <!--Agents Vehicle :: START-->
        <li>
            <a href="<?php echo Yii::app()->params['webURL']; ?>/SelfDrive/Agent/AgentVehicle">
                <span class="icon fa fa-car"></span><span class="title">Self Drive Agent Vehicles</span>
            </a>
        </li>
        <!--Agents Vehicle:: END-->

        <!--Hire A Mechanic :: START-->
        <li>
            <a href="<?php echo Yii::app()->params['webURL']; ?>/SelfDrive/Agent/Create1">
                <span class="icon fa fa-star"></span><span class="title">Hire A Mechanic</span>
            </a>
        </li>
        <!--Hire A Mechanic :: END-->

        <!--Brands :: START-->
        <li>
            <a href="<?php echo Yii::app()->params['webURL']; ?>/Vehicles/Brands/createBrand">
                <span class="icon fa fa-star"></span><span class="title">Brands</span>
            </a>
        </li>
        <!--Brands :: END-->

        <!--Models :: START-->
        <li>
            <a href="<?php echo Yii::app()->params['webURL']; ?>/Vehicles/Brands/createBrandModels">
                <span class="icon fa fa-tag"></span><span class="title">Models</span>
            </a>
        </li>
        <!--Models :: END-->

        <!--Vehicles :: START-->
        <li>
            <a href="<?php echo Yii::app()->params['webURL']; ?>/Vehicles/Vehicles/vehicle">
                <span class="icon fa fa-car"></span><span class="title">Vehicles</span>
            </a>
        </li>
        <!--Vehicles :: END-->

        <!--Vehicle Features :: START-->
        <li>
            <a href="<?php echo Yii::app()->params['webURL']; ?>/SelfDrive/Agent/VehicleFeatureform">
                <span class="icon fa fa-car"></span><span class="title">Vehicle Features</span>
            </a>
        </li>
        <!--Vehicle Features :: END-->

        <!--Mechanic Stores :: START-->
        <li>
            <a href="<?php echo Yii::app()->params['webURL'] . 'User/User/Mechanic'; ?>">
                <span class="icon fa fa-file-text"></span><span class="title">Mechanic Store</span>
            </a>
        </li>
        <!--Mechanic Stores :: END-->

        <!--Modification Shops :: START-->
        <!--        <li>
                    <a href="<?php //echo Yii::app()->params['webURL'] . 'Modifications/ModificationShop/CreateModificationShop';                                  ?>">
                        <span class="icon fa fa-hand-lizard-o"></span><span class="title">Modification Shops</span>
                    </a>
                </li>-->
        <!--Modification Shops :: END-->

        <!--Delivery Boys :: START-->
        <li>
            <a href="<?php echo Yii::app()->params['webURL'] . 'User/User/CreateDeliveryBoys'; ?>">
                <span class="icon fa fa-male"></span><span class="title">Delivery Boys</span>
            </a>
        </li>
        <!--Delivery Boys :: END-->

        <!--Repairs :: START-->
        <li>
            <a href="<?php echo Yii::app()->params['webURL'] . 'UserService/UserService/Repairs'; ?>">
                <span class="icon fa fa-life-ring"></span><span class="title">Garage</span>
            </a>
        </li>
        <!--Repairs :: END-->

        <!--Parnters :: START-->
        <li>
            <a href="<?php echo Yii::app()->params['webURL'] . 'Vendor/Vendor/VendorReport' ?>">
                <span class="icon fa fa-file-text"></span><span class="title">Vendor</span>
            </a>
        </li>
        <!--Parnters :: END-->

        <!--Enquires :: START-->
        <li>
            <a href="<?php echo Yii::app()->params['webURL'] . 'Enquiry/Enquiry/EnquiryReport' ?>"><span class="icon fa fa-pencil"></span><span class="title">Customer Enquires</span></a>
        </li>
        <!--Enquires :: END-->

<!--Customer :: START-->
        <li>
            <a href="<?php echo Yii::app()->params['webURL'] . 'User/User/GetCustomers' ?>"><span class="icon fa fa-pencil"></span><span class="title">Customers</span></a>
        </li>
        <!--Customer :: END-->


        <!--Vehicle Guide :: START-->
        <li>
            <a href="<?php echo Yii::app()->params['webURL'] . 'VehicleGuide/GuideCategory' ?>">
                <span class="icon fa fa-book"></span><span class="title">Vehicle Guide</span>
            </a>
        </li>
        <!--Vehicle Guide :: END-->

        <!--Reports :: START-->
        <li>
            <a href="<?php echo Yii::app()->params['webURL'] . 'Reports/Orders/Orders/Orders'; ?>">
                <span class="icon fa fa-file-text"></span><span class="title">Reports</span>
            </a>
        </li>
        <!--Reports :: END-->
    <?php } else if (2 == $intRole) { ?>

        <!--Agents Vehicle :: START-->
        <li>
            <a href="<?php echo Yii::app()->params['webURL']; ?>/SelfDrive/Agent/AgentVehicle">
                <span class="icon fa fa-car"></span><span class="title">Self Drive Agent Vehicles</span>
            </a>
        </li>
        <!--Agents Vehicle:: END-->

        <!--Reports :: START-->
        <li>
            <a href="<?php echo Yii::app()->params['webURL'] . 'Reports/Orders/Orders/SelfDriveOrders/'; ?>">
                <span class="icon fa fa-file-text"></span><span class="title">Reports</span>
            </a>
        </li>
        <!--Reports :: END-->


        <?php
    }
    ?>
</ul>
