<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'My Web Application',
'defaultController' => 'User/Login/SignIN',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'sourceLanguage' => '00',
    'language' => 'en',
    'import' => array(
        'application.models.*',
        'application.controllers.*',
        'application.components.*',
        'application.Forms.*',
        'application.DataManager.*',
        'application.NotificationManager.*',
        'application.models.Modifications.*',
    ),
    'behaviors' => array(
        'onBeginRequest' => array(
            'class' => 'application.components.RequireLogin'
        )
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'cteladmin',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array($_SERVER['REMOTE_ADDR']),
        ),
    ),
    // application components
    'components' => array(
        'ePdf' => array(
        'class'         => 'ext.yii-pdf.EYiiPdf',
        'params'        => array(
            'mpdf'     => array(
                'librarySourcePath' => 'application.vendor.mpdf.*',
                'constants'         => array(
                    '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                ),
                'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder
                'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
                    'mode'              => '', //  This parameter specifies the mode of the new document.
                    'format'            => 'A2', // format A4, A5, ...
                    'default_font_size' => 0, // Sets the default document font size in points (pt)
                    'default_font'      => '', // Sets the default font-family for the new document.
                    'mgl'               => 35, // margin_left. Sets the page margins for the new document.
                    'mgr'               => 35, // margin_right
                    'mgt'               => 30, // margin_top
                    'mgb'               => 30, // margin_bottom
                    'mgh'               => 9, // margin_header
                    'mgf'               => 9, // margin_footer
                    'orientation'       => 'P', // landscape or portrait orientation
                )
            ),
            'HTML2PDF' => array(
                'librarySourcePath' => 'application.vendor.vendor.spipu.html2pdf.*',
                'classFile'         => 'html2pdf.class.php', // For adding to Yii::$classMap
                'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
                    'orientation' => 'P', // landscape or portrait orientation
                    'format'      => 'A4', // format A4, A5, ...
                    'language'    => 'en', // language: fr, en, it ...
                    'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
                    'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
                    'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
                )
            )
        ),
    ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
               
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>'
            ),
            //'showScriptName' => false,
        ),
        /* 'db'=>array(
          'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
          ), */
        // uncomment the following to use a MySQL database
        /* 'db' => array(
          'connectionString' => 'mysql:host=10.10.10.28;dbname=live_db',
          'emulatePrepare' => true,
          'username' => 'mps',
          'password' => 'mpsadmin',
          'charset' => 'utf8',
          ), */

  //'db' => array(
    //        'connectionString' => 'mysql:host=localhost;dbname=mps_team_testing',
      //      'emulatePrepare' => true,
       //     'username' => 'mps_team_testing',
        //    'password' => 'mps_team_testing',
         //   'charset' => 'utf8',
        //),

        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=mps_latest',
            'emulatePrepare' => true,
            'username' => 'mps_latest',
            'password' => 'mps_latest',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
        'webURL' => 'http://10.10.10.30/metrepersecond/MPS/index.php/',
	'imgURL' => 'http://10.10.10.30/metrepersecond/MPS/images/',
        'adminImgURL' => 'http://10.10.10.30/metrepersecond/MPS/images/uploadimages/',
        'vehicle_variants' => array('petrol' => 1, 'diesel' => 2),
        'secureToken' => '*(_+=c/T\el~`',
        'image_path' => realpath(Yii::app()->basePath) . '/../images/uploadimages/',
        'order_staus' => array(1 => 'NEW', 2 => 'ACCEPTED', 3 => 'REJECTED', 4 => 'ASSIGNED',  5 => 'PICKUP_ACCEPTED', 6 => 'STARTED',  7 => 'REPAIRS_STARTED', 8 => 'REPAIRS_COMPLETED',  9 => 'ASSIGN_DELIVERY',10 => 'FINISHED',13 => 'DELIVERY ACCEPTED',12 => 'CANCELLED'),
    ),    
);
