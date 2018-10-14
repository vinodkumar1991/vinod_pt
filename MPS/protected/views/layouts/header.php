<nav class="navbar navbar-default navbar-fixed-top navbar-top">
    <div class="container-fluid">
        <!--Menu ICON :: START-->
        <div class="navbar-header">
            <button type="button" class="navbar-expand-toggle">
                <i class="fa fa-bars icon"></i>
            </button>
            <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                <i class="fa fa-th icon"></i>
            </button>
        </div>
        <!--Menu ICON :: END-->

        <!--Logout Section :: START-->
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown profile">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span></a>
                <ul class="dropdown-menu animated fadeInDown">
                    <!--Profile Image :: START-->
                    <li class="profile-img">
                        <img src="<?php echo Yii::app()->params['imgURL'] . '/admin-icon.png' ?>" class="profile-img">
                    </li>
                    <!--Profile Image :: START-->

                    <!--Log Out :: START-->
                    <li>
                        <div class="profile-info">
                            <div class="btn-group margin-bottom-2x" role="group">
                                <div>
                                    <?php echo Yii::app()->session['fullname'] . ' ( ' . Yii::app()->session['username'] . ' ) '; ?>
                                </div>
                                <a href="<?php echo Yii::app()->params['webURL'] . '/User/Login/SignOUT' ?>"><i class="fa fa-sign-out"></i>Logout</a>
                            </div>
                        </div>
                    </li>
                    <!--Log Out :: END-->
                </ul>
            </li>
        </ul>
        <!--Logout Section :: END-->
    </div>
</nav>