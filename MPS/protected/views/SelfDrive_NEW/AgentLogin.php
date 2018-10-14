<!DOCTYPE html>
<html>
    <head>
        <title>Metre Per Second</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
        <!-- CSS Libs -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/css/animate.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/css/bootstrap-switch.min.css">

        <!-- CSS App -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/css/flat-blue.css">

        <style type="text/css">
            body{
                background: #ebea3b !important; 
                /* background: #f5f5f5 !important; */
            }
            .login_pagetemplete .container{
                width: 500px;
                margin:0 auto;
            }
            .login_pagetemplete .logo{padding-top: 34%; text-align: center;padding-bottom: 30px;}
            .login_pagetemplete .form-control{height: 54px; padding: 10px 12px;}
            .login_pagetemplete .checkbox-light [type="checkbox"] {margin-right: 10px;}
            .login_pagetemplete .checkbox3 label{padding-left: 0px;cursor: pointer;}
            .login_pagetemplete .btn{padding: 12px 40px !important;border-radius: 5px !important;}

            @media only screen and (max-width: 540px) {
                .login_pagetemplete .container{
                    width: 100%;
                    margin:0 auto;
                }
                .login_pagetemplete .logo{
                    padding-top: 5%; padding-bottom: 10px;
                }

            }
        </style>
    </head>

    <body class="login_pagetemplete flat-blue">
        <!--Login Form :: START-->
        <div class="container-fluid">
            <div class="container">
                <!--Logo :: START-->
                <div class="logo col-xs-12">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/admin/img/login-logo-rentit.png">
                </div>
                <!--Logo :: END-->
                <!--Form :: START-->
                <form method="post" id="login_form" name="login_form" class="form-horizontal">
                    <!--Username :: START-->
                    <div class="form-group">
                        <div class="col-sm-12">
                                <!-- <label class="required" for="MPSUSER_id">ID <span class="required">*</span></label> -->
                            <input type="text" class="form-control" id="MPSUSER_id" name="MPSUSER[id]" placeholder="Enter Username" required>
                            <div style="display:block;" id="MPSUSER_id_em_" class="errorMessage"></div>     
                        </div>
                    </div>
                    <!--Username :: END-->

                    <!--Password :: START-->
                    <div class="form-group">
                        <div class="col-sm-12">
                                <!-- <label class="required" for="MPSUSER_password">Password <span class="required">*</span></label> -->		        
                            <input type="password" maxlength="500" id="MPSUSER_password" name="MPSUSER[password]" class="form-control" placeholder="Enter Password" required>
                            <div style="display:block" id="MPSUSER_password_em_" class="errorMessage"></div>
                        </div>
                    </div>
                    <!--Password :: END-->

                    <!--Button :: START-->
                    <div class="form-group text-center">
                        <div class="col-sm-12">
                            <input type="submit" value="Login" name="btn_login" id="btn_login" class="btn btn-primary"/>
                        </div>
                    </div>
                    <!--Button :: END-->
                </form>
                <!--Form :: END-->
            </div>
        </div>
        <!--Login Form :: END-->
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/admin/lib/js/bootstrap.min.js"></script>
    </body>
</html>

<!--form end here-->
