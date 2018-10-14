      <!-- BREADCRUMBS -->
        <section class="page-section breadcrumbs text-right">
            <div class="container">
                <div class="page-header">
                    <h1><?php
                echo Yii::t('app', 'common.form.forgot_pwd_tag');
                ?></h1>
                </div>
                <ul class="breadcrumb">
                    <li><a href="<?php echo Yii::app()->homeUrl;?>">Home</a></li>
                    <li><a href="#"><?php
                echo Yii::t('app', 'common.form.forgot_pwd_tag');
                ?></a></li>
                   
                </ul>
            </div>
        </section>
        <!-- /BREADCRUMBS -->
 <section class="page-section with-sidebar sub-page">
            <div class="container">
                <div class="row">               
            <h2 class="text-center">
                
                 <?php
                echo Yii::t('app', 'common.form.forgot_pwd_tag');
                ?>
                
            </h2>
            <!--Operation Message :: START-->
            <?php if (Yii::app()->user->hasFlash('success')) { ?>
                <div class="throw_success">
                    <?php echo Yii::app()->user->getFlash('success'); ?>
                </div>
            <?php } else if (Yii::app()->user->hasFlash('failure')) { ?>
                <div class="throw_warning">
                    <?php echo Yii::app()->user->getFlash('failure'); ?>
                </div>
                <?php
            }
            ?>
            <!--Operation Message :: END-->
            <div class="col-md-4"></div>
        <div class="col-md-8">
            <form class="loginform" method="post" name="forgot_password_form" id="forgot_password_form">
                <!--Email :: START-->
                <div class="col-md-7">
                <div class="form-group">
                    <input type="text" class="form-control" autocomplete="off" name="email_address" id="email_address" placeholder="Enter Email" value="<?php echo isset($forgotPasswordForm->email_address) ? $forgotPasswordForm->email_address : NULL; ?>"/>
                    <span class="throw_error">
                        <?php
                        echo isset($errors['email_address'][0]) ? $errors['email_address'][0] : NULL;
                        ?>
                    </span>
                </div>
                       <!--Button :: START-->
                <div class="simple-signup">
                    <div class="text-left signup-email-section">
                        <input type="submit" class="btn btn-theme btn-theme-dark" name="get_otp" id="get_otp" value="Submit"/>
                    </div>
                </div>      
                <!--Button :: END-->
                </div>
                <!--Email :: END-->
             

            </form>
        </div>
        </div>
    </div>
</div>
      </section>  