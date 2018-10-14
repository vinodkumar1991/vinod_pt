<!DOCTYPE html>
<html>
    <head>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
        <!-- Javascript Libs -->	
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/js/jquery.geocomplete.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/js/Chart.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/js/bootstrap-switch.min.js"></script>

        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/js/jquery.matchHeight-min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/js/select2.full.min.js"></script>

        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/js/ace/ace.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/js/ace/mode-html.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/js/ace/theme-github.js"></script>
        <!-- Javascript -->
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/js/app.js"></script>
        <!-- CSS Libs -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/css/animate.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/css/bootstrap-switch.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/css/checkbox3.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/css/dataTables.bootstrap.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/css/select2.min.css">
        <!-- CSS App -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/css/flat-blue.css">
    </head>
    <body class="flat-blue">
        <div class="app-container">
            <div class="row content-container">
                <nav class="navbar navbar-default navbar-fixed-top navbar-top">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-expand-toggle">
                                <i class="fa fa-bars icon"></i>
                            </button>
                            <ol class="breadcrumb navbar-breadcrumb">
                                <li>Page</li>
                                <li class="active">Metre Per Second</li>
                            </ol>
                            <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                                <i class="fa fa-th icon"></i>
                            </button>
                        </div>
                        <ul class="nav navbar-nav navbar-right">
                            <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                                <i class="fa fa-times icon"></i>
                            </button>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-comments-o"></i></a>
                                <ul class="dropdown-menu animated fadeInDown">
                                    <li class="title">
                                        Notification <span class="badge pull-right">0</span>
                                    </li>
                                    <li class="message">
                                        No new notification
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown danger">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-star-half-o"></i> 4</a>
                                <ul class="dropdown-menu danger  animated fadeInDown">
                                    <li class="title">
                                        Notification <span class="badge pull-right">4</span>
                                    </li>
                                    <li>
                                        <ul class="list-group notifications">
                                            <a href="#">
                                                <li class="list-group-item">
                                                    <span class="badge">1</span> <i class="fa fa-exclamation-circle icon"></i> new registration
                                                </li>
                                            </a>
                                            <a href="#">
                                                <li class="list-group-item">
                                                    <span class="badge success">1</span> <i class="fa fa-check icon"></i> new orders
                                                </li>
                                            </a>
                                            <a href="#">
                                                <li class="list-group-item">
                                                    <span class="badge danger">2</span> <i class="fa fa-comments icon"></i> customers messages
                                                </li>
                                            </a>
                                            <a href="#">
                                                <li class="list-group-item message">
                                                    view all
                                                </li>
                                            </a>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown profile">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo Yii::app()->user->getState('user'); ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu animated fadeInDown">
                                    <li class="profile-img">
                                        <img src="<?php echo Yii::app()->params['imgURL'] . '/admin-icon.png' ?>" class="profile-img">
                                    </li>
                                    <li>
                                        <div class="profile-info">
                                            <h4 class="username"><?php echo Yii::app()->user->getState('user'); ?></h4>
                                            <p>admin@mps.com</p>
                                            <div class="btn-group margin-bottom-2x" role="group">
                                                <button type="button" class="btn btn-default"><i class="fa fa-user"></i> Profile</button>
                                                <button type="button" class="btn btn-default" onclick="logout();"><i class="fa fa-sign-out"></i> Logout</button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="side-menu sidebar-inverse">
                    <nav class="navbar navbar-default" role="navigation">
                        <div class="side-menu-container">
                            <div class="navbar-header id="logo"">
                                 <a class="navbar-brand" href="#">
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/admin/img/logo-rentit.png" title="Metre Per Second" alt="Metre Per Second">
                                    <div class="title">Metre Per Second<?php //echo CHtml::encode(Yii::app()->name);                                                                                     ?></div>
                                </a>
                                <button type="button" class="navbar-expand-toggle pull-right visible-xs">
                                    <i class="fa fa-times icon"></i>
                                </button>
                            </div>
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="<?php echo $this->createUrl('site/dashboard'); ?>">
                                        <span class="icon fa fa-tachometer"></span><span class="title">Dashboard</span>
                                    </a>
                                </li>
                                <li>
                                    <?php
                                    $role = Yii::app()->user->getState('role');
                                    if ($role < 4) {
                                        ?>
                                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/mPSUserRegistration/userRegister">
                                            <span class="icon fa fa-user"></span><span class="title">Users</span>
                                        </a>
                                    </li>
                                    <!--Agents :: START-->
                                    <li>
                                        <a href="<?php echo Yii::app()->params['webURL']; ?>/SelfDrive/Agent/Create">
                                            <span class="icon fa fa-star"></span><span class="title">Agents</span>
                                        </a>
                                    </li>
                                    <!--Agents :: END-->
                                    <!--Agents Vehicle :: START-->
                                    <li>
                                        <a href="<?php echo Yii::app()->params['webURL']; ?>/SelfDrive/Agent/AgentVehicle">
                                            <span class="icon fa fa-car"></span><span class="title">Agent Vehicles</span>
                                        </a>
                                    </li>
                                    <!--Agents Vehicle:: END-->
                                    <li>
                                        <a href="<?php echo Yii::app()->params['webURL']; ?>/Vehicles/Brands/createBrand">
                                            <span class="icon fa fa-star"></span><span class="title">Brands</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo Yii::app()->params['webURL']; ?>/Vehicles/Brands/createBrandModels">
                                            <span class="icon fa fa-tag"></span><span class="title">Models</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo Yii::app()->params['webURL']; ?>/Vehicles/Vehicles/vehicle">
                                            <span class="icon fa fa-car"></span><span class="title">Vehicles</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="<?php echo Yii::app()->params['webURL'] . 'User/User/Mechanic'; ?>">
                                            <span class="icon fa fa-file-text"></span><span class="title">Mechanic Store</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="<?php echo Yii::app()->params['webURL'] . 'Modifications/ModificationShop/CreateModificationShop'; ?>">
                                            <span class="icon fa fa-hand-lizard-o"></span><span class="title">Modification Shops</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="<?php echo Yii::app()->params['webURL'] . 'User/User/CreateDeliveryBoys'; ?>">
                                            <span class="icon fa fa-male"></span><span class="title">Delivery Boys</span>
                                        </a>
                                    </li>


                                    <li>
                                        <!--<a href="<?php //echo $this->createUrl('site/images');          ?>">
                                            <span class="icon fa fa-file-image-o"></span><span class="title">Images</span>
                                        </a>-->
                                    </li>
                                    <!--Repairs :: START-->
                                    <li>
                                        <a href="<?php echo Yii::app()->params['webURL'] . 'UserService/UserService/Repairs'; ?>">
                                            <span class="icon fa fa-life-ring"></span><span class="title">Garage</span>
                                        </a>
                                    </li>
                                    <!--Repairs :: END-->
                                <?php } ?>
                                <?php
                                if ($role == 4) {
                                    // $addVehicle = $this->createUrl('MPSSELFDRIVEAGENCY/addvehicle');
                                    $addVehicle = $this->createUrl('/selfdrive/SelfVehicles/create');
                                    ?> <li>
                                        <a href="<?php echo $addVehicle; ?>">
                                            <span class="icon fa fa-file-text"></span><span class="title">Add Vehicle</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $this->createUrl('MPSSELFDRIVEAGENCY/VehicleList'); ?>">
                                            <span class="icon fa fa-plus"></span><span class="title">Vehicle List</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="<?php echo $this->createUrl('MPSSELFDRIVEAGENCY/manageVehicle'); ?>">
                                            <span class="icon fa fa-file-text"></span><span class="title">Manage Vehicles</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $this->createUrl('MPSSELFDRIVEAGENCY/bookRequest'); ?>">
                                            <span class="icon fa fa-file-text"></span><span class="title">Booking Request</span>
                                        </a>
                                    </li>
                                <?php } ?><?php if ($role != 4) {
                                    ?>
                                    <li>
                                        <!-- <a href="<?php //echo $this->createUrl('mPSUserRegistration/BookingReports');              ?>">-->
                                        <a href="<?php echo Yii::app()->params['webURL'] . 'Reports/Orders/Orders/Orders'; ?>">
                                            <span class="icon fa fa-file-text"></span><span class="title">Reports</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo Yii::app()->params['webURL'] . 'VehicleGuide/GuideCategory' ?>">
                                            <span class="icon fa fa-book"></span><span class="title">Vehicle Guide</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo Yii::app()->params['webURL'] . 'Enquiry/Enquiry/EnquiryReport' ?>"><span class="icon fa fa-pencil"></span><span class="title">Customer Enquires</span></a>
                                    </li>
                                    <li>
                                        <a href="<?php echo Yii::app()->params['webURL'] . 'Vendor/Vendor/VendorReport' ?>"><span class="icon fa fa-file-text"></span><span class="title">Vendor</span>

                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $this->createUrl('site/dashboard'); ?>"><span class="icon fa fa-map-marker"></span><span class="title">Locations</span></a>
                                    </li>
                                <?php } ?>
                                <li>
                                    <a href="#"><span class="icon fa fa-cog"></span><span class="title">Settings</span></a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->
                    </nav>
                </div>
                <!-- Main Content -->

                <!-- <div id="mainmenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array('label' => 'Home', 'url' => array('/site/index')),
                        array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
                        array('label' => 'Contact', 'url' => array('/site/contact')),
                        array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                        array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                    ),
                ));
                ?>
                </div> --><!-- mainmenu -->

                <div class="container-fluid">
                    <div class="side-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="card">

                                    <div class="card-body">
                                        <?php echo $content; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

            <footer class="app-footer">
                <div class="wrapper">
                    <span class="pull-right">1.0<a href="#"><i class="fa fa-long-arrow-up"></i></a></span> &copy; 2016 Copyright.
                </div>
            </footer><!-- footer -->

        </div><!-- page -->


        <script type="text/javascript">

            function logout()
            {
                var baseurl = "<?php echo Yii::app()->baseurl; ?>";
                var logout = confirm("Are you sure you wish to logout?");
                if (logout)
                {
                    location.href = "<?php echo Yii::app()->params['webURL'] . 'site/logout'; //$this->createUrl('site/logout');          ?>";
                }
            }
        </script>
    </body>
</html>

