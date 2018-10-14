      <!-- BREADCRUMBS -->
        <section class="page-section breadcrumbs text-right">
            <div class="container">
                <div class="page-header">
                    <h1><?php
                echo Yii::t('app', 'common.form.change_password');
                ?></h1>
                </div>
                <ul class="breadcrumb">
                    <li><a href="<?php echo Yii::app()->homeUrl;?>">Home</a></li>
                    <li><a href="#"><?php
                echo Yii::t('app', 'common.form.change_password');
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
                echo Yii::t('app', 'common.form.change_password');
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
 <div class="col-md-5"></div>
        <div class="col-md-7">
            <form class="updateform" method="post">
                <!--OTP Password :: START-->
                <div class="form-group">
                    <input type="text" class="input-text full-width" name="update_otp" id="update_otp" autocomplete="off" placeholder="OTP" value="<?php echo isset($passwordForm->update_otp) ? $passwordForm->update_otp : NULL; ?>"/>
                    <span class="throw_error">
                        <?php
                        echo isset($errors['update_otp'][0]) ? $errors['update_otp'][0] : NULL;
                        ?>
                    </span>
                </div>
                <!--OTP Password :: END-->

                <!--New Password :: START-->
                <div class="form-group">
                    <input type="password" class="input-text full-width" name="update_new_password" id="update_new_password"  placeholder="New Pin"/>
                    <span class="throw_error">
                        <?php
                        echo isset($errors['update_new_password'][0]) ? $errors['update_new_password'][0] : NULL;
                        ?>
                    </span>
                </div>
                <!-- New Password :: END-->
                <!--Confirm Password :: START-->
                <div class="form-group">
                    <input type="password" class="input-text full-width" name="update_confirm_password" id="update_confirm_password" placeholder="Confirm New Pin"/>
                    <span class="throw_error">
                        <?php
                        echo isset($errors['update_confirm_password'][0]) ? $errors['update_confirm_password'][0] : NULL;
                        ?>
                    </span>
                </div>
                <!-- Confirm Password :: END-->
                <!--Button :: START-->
                <div class="simple-signup">
                    <div class="text-left signup-email-section">
                        <input type="submit" class="btn btn-theme btn-theme-dark" name="update_password" id="update_password" value="Update Pin"/>
                    </div>
                </div>
                <!--Button :: END-->
            </form>
      
        </div>
    </div>
    </section>


