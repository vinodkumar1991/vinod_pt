<?php
$strAction = strtolower(Yii::app()->controller->action->id);
if ('signin' == $strAction) {
    $this->renderPartial('/User/Login');
} else {
    ?>

    <!DOCTYPE html>
    <html>
        <!--Header Script :: START-->
        <?php
        include_once 'header_scripts.php';
        ?>
        <!--Header Script :: END-->

        <body class="flat-blue">
            <div class="app-container">
                <div class="row content-container">
                    <!--Header Script :: START-->
                    <?php
                    include_once 'header.php';
                    ?>
                    <!--Header Script :: END-->

                    <div class="side-menu sidebar-inverse">
                        <nav class="navbar navbar-default" role="navigation">
                            <div class="side-menu-container">
                                <!--Mini MPS Icon :: START-->
                                <div class="navbar-header" id="logo">
                                    <a class="navbar-brand" href="#">
                                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/admin/img/logo-rentit.png" title="Metre Per Second" alt="Metre Per Second">
                                        <div class="title">Metre Per Second</div>
                                    </a>
                                    <button type="button" class="navbar-expand-toggle pull-right visible-xs">
                                        <i class="fa fa-times icon"></i>
                                    </button>
                                </div>
                                <!--Mini MPS Icon :: END-->
                            </div>
                            <!--Menu :: START-->
                            <?php
                            include_once 'menu.php';
                            ?>
                            <!--Menu :: END-->

                        </nav>
                    </div>

                    <!-- Main Content -->

                    <!--Customer View File :: START-->
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
                    <!--Customer View File :: END-->
                </div>

                <!--Footer :: START-->
                <?php
                include_once 'footer.php';
                ?>
                <!--Footer :: END-->
            </div>
        </body>
    </html>
    <?php
}
?>

