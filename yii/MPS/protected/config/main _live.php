<?php

return array(
    'timeZone' => 'Asia/Calcutta',
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Meter Per Second',
    'defaultController' => 'User/Login/SignIN',
    'preload' => array('log'),
    'sourceLanguage' => '00',
    'language' => 'en',
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.modules.*',
        'application.Forms.*',
        'application.DataManager.*',
        'application.Controllers.*',
        'application.NotificationManager.*',
        'ext.PHPMailer.*',
    ),
    'modules' => array(
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123',
        ),
    ),
    // application components
    'components' => array(
        'something' => array(
            'class' => 'MyClass',
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>' => '<controller>/index',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>'
            ),
        ),
        'db' => array(
            'connectionString' => 'mysql:host=10.10.10.28;dbname=MPS',
            'emulatePrepare' => true,
            'username' => 'mps',
            'password' => 'mpsadmin',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        ),
        'ePdf' => array(
            'class' => 'ext.yii-pdf.EYiiPdf',
            'params' => array(
                'mpdf' => array(
                    'librarySourcePath' => 'application.vendor.mpdf.*',
                    'constants' => array(
                        '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                    ),
                    'class' => 'mpdf', // the literal class filename to be loaded from the vendors folder
                /* 'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
                  'mode'              => '', //  This parameter specifies the mode of the new document.
                  'format'            => 'A4', // format A4, A5, ...
                  'default_font_size' => 0, // Sets the default document font size in points (pt)
                  'default_font'      => '', // Sets the default font-family for the new document.
                  'mgl'               => 15, // margin_left. Sets the page margins for the new document.
                  'mgr'               => 15, // margin_right
                  'mgt'               => 16, // margin_top
                  'mgb'               => 16, // margin_bottom
                  'mgh'               => 9, // margin_header
                  'mgf'               => 9, // margin_footer
                  'orientation'       => 'P', // landscape or portrait orientation
                  ) */
                ),
                'HTML2PDF' => array(
                    'librarySourcePath' => 'application.vendor.vendor.spipu.html2pdf.*',
                    'classFile' => 'html2pdf.class.php', // For adding to Yii::$classMap
                /* 'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
                  'orientation' => 'P', // landscape or portrait orientation
                  'format'      => 'A4', // format A4, A5, ...
                  'language'    => 'en', // language: fr, en, it ...
                  'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
                  'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
                  'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
                  ) */
                )
            ),
        ),
    ),
    'params' => array(
        'adminEmail' => 'webmaster@example.com',
        'secureToken' => '*(_+=c/T\el~`',
        'sms' => array('key' => '115157ACrUVUhXjZT5765202d', 'sender' => 'VERIFY', 'route' => 4, 'url' => 'https://control.msg91.com/api/sendhttp.php'),
        'webURL' => 'http://metrepersecond.com/MPS/index.php/',
        'imgURL' => 'http://metrepersecond.com/MPS/images/',
        'adminImgURL' => 'http://metrepersecond.com/MPS/images/uploadimages/',
        'vehicle_variants' => array('petrol' => 1, 'diesel' => 2),
        'is_package' => array('1' => 1, '2' => 0, '3' => 0),
        'customer_info' => array('support_mobile' => '+91 801 944 80 35', 'support_mail' => 'support@metrepersecond.com', 'message' => 'Call us for your car and bike needs', 'tag' => 'HELP & SUPPORT'),
        'distance_in_kms' => 2,
        'order_staus' => array(1 => 'NEW', 2 => 'ACCEPTED', 3 => 'REJECTED', 4 => 'ASSIGNED', 5 => 'PICKUP_ACCEPTED', 6 => 'STARTED', 7 => 'REPAIRS_STARTED', 8 => 'REPAIRS_COMPLETED', 9 => 'ASSIGN_DELIVERY', 10 => 'FINISHED', 13 => 'DELIVERY ACCEPTED', 12 => 'CANCELLED'),
        'webImageURL' => 'http://metrepersecond.com/MPS/assets/',
        'payment_status' => array(
            'ccavenue' => array(
                'Success' => 1,
                'Aborted' => 2,
                'Failure' => 3,
            ),
        ),
        'tic_url' => 'http://metrepersecond.com/MPS/tic/',
        'real_image_path' => realpath(Yii::app()->basePath) . '/images/uploadimages/',
    ),
);

