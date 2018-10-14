<?php


// Reference : http://www.yiiframework.com/forum/index.php/topic/5554-redirect-problems/
ob_start('My_OB');

function My_OB($str, $flags)
{
    // remove UTF-8 BOM
    $str = preg_replace("/\xef\xbb\xbf/", "", $str);

    return $str;
}

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'timeZone' => 'Asia/Calcutta',
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Meter Per Second',
    'defaultController' => 'mPSVEHICLES_DETAILS/AddVehicle',
    // preloading 'log' component
    'preload' => array(
        'log'
    ),
    // autoloading model and component classes
    'sourceLanguage' => '00',
    'language' => 'en',
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.modules.*',
        'application.Forms.*',
        'application.DataManager.*',
        'application.NotificationManager.*',
        'ext.PHPMailer.*'
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123'
            // If removed, Gii defaults to localhost:8090 only. Edit carefully to taste.
            // 'ipFilters'=>array('127.0.0.1','10.10.10.*'),
        )
    ),
    // application components
    'components' => array(
        'something' => array(
            'class' => 'MyClass'
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            // 'showScriptName' => false,
            // 'caseSensitive' => false,
            // 'Booking' => 'Vendor/Vendor/Vendor',
            // 'privacy' => 'site/privacy',
            // 'password' => 'site/forgot',
            'rules' => array(
                'bookacar' => 'Booking/BookAService/bookACar',
                'bookabike' => 'Booking/BookAService/bookABike',
                'selfdrive' => 'Self/SelfDrive/SelfDrive',
                'hiremechanic' => 'HireMechanic/Hire',
                'vehicleguide' => 'VehicleGuide/Home',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>' => '<controller>/index',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>'
            ),
            'showScriptName' => false
        ),
     /*    'db'=>array(
          'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
          ),
          */
          // uncomment the following to use a MySQL database
         

        //'db' => array(
          //  'connectionString' => 'mysql:host=localhost:8090;dbname=mps_team_testing',
           // 'emulatePrepare' => true,
           // 'username' => 'mps_team_testing',
          //  'password' => 'mps_team_testing',
          //  'charset' => 'utf8',
       // ),

'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=mps',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8'
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error'
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning'
                )
                // uncomment the following to show log messages on web pages
                /*
             * array(
             * 'class'=>'CWebLogRoute',
             * ),
             */
            )
        ),
        'ePdf' => array(
            'class' => 'ext.yii-pdf.EYiiPdf',
            'params' => array(
                'mpdf' => array(
                    'librarySourcePath' => 'application.vendor.mpdf.*',
                    'constants' => array(
                        '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime')
                    ),
                    'class' => 'mpdf' // the literal class filename to be loaded from the vendors folder
                /*
                 * 'defaultParams' => array( // More info: http://mpdf1.com/manual/index.php?tid=184
                 * 'mode' => '', // This parameter specifies the mode of the new document.
                 * 'format' => 'A4', // format A4, A5, ...
                 * 'default_font_size' => 0, // Sets the default document font size in points (pt)
                 * 'default_font' => '', // Sets the default font-family for the new document.
                 * 'mgl' => 15, // margin_left. Sets the page margins for the new document.
                 * 'mgr' => 15, // margin_right
                 * 'mgt' => 16, // margin_top
                 * 'mgb' => 16, // margin_bottom
                 * 'mgh' => 9, // margin_header
                 * 'mgf' => 9, // margin_footer
                 * 'orientation' => 'P', // landscape or portrait orientation
                 * )
                 */
                ),
                'HTML2PDF' => array(
                    'librarySourcePath' => 'application.vendor.vendor.spipu.html2pdf.*',
                    'classFile' => 'html2pdf.class.php' // For adding to Yii::$classMap
                /*
                 * 'defaultParams' => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
                 * 'orientation' => 'P', // landscape or portrait orientation
                 * 'format' => 'A4', // format A4, A5, ...
                 * 'language' => 'en', // language: fr, en, it ...
                 * 'unicode' => true, // TRUE means clustering the input text IS unicode (default = true)
                 * 'encoding' => 'UTF-8', // charset encoding; Default is UTF-8
                 * 'marges' => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
                 * )
                 */
                )
            )
        )
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
        'secureToken' => '*(_+=c/T\el~`',
        'sms' => array(
            'key' => '115157ACrUVUhXjZT5765202d',
            'sender' => 'VERIFY',
            'route' => 4,
            'url' => 'https://control.msg91.com/api/sendhttp.php'
        ),
        'sms1' => array(
            'user' => 'chandu4130',
            'password' => 'Metre@2016',
            'sender' => 'MPSMSG',
            'message_type' => 'N',
            'dreport' => 'Y',
            'url' => 'http://www.smscountry.com/SMSCwebservice_Bulk.aspx'
        ),
        // 'webURL' => 'http://localhost:8090/MeterPerSecond/MPS_New/index.php/',
        // 'imgURL' => 'http://localhost:8090/MeterPerSecond/MPS_New/images/',
        // 'adminImgURL' => 'http://localhost:8090/MeterPerSecond/MPS_New/MPS/images/uploadimages/',

        'webURL' => 'http://localhost:8090/MPS/index.php/',
        'imgURL' => 'http://localhost:8090/MPS/MPS/images/',
        'adminImgURL' => 'http://localhost:8090/MPS/MPS/images/uploadimages/',
        'vehicle_variants' => array(
            'petrol' => 1,
            'diesel' => 2
        ),
        'is_package' => array(
            '1' => 1,
            '2' => 0,
            '3' => 0,
            '6' => 1,
            '7' => 1
        ),
        'customer_info' => array(
            'support_mobile' => '+91 801 944 80 35',
            'support_mail' => 'support@metrepersecond.com',
            'message' => 'Call us for your car and bike needs',
            'tag' => 'HELP & SUPPORT',
            'admin_mobile' => '8019448035,9705999270,9553208000'
        ),
        'distance_in_kms' => 500,
        // 'ASSIGN_DELIVERY' => 9 Need To Remove
        // 'order_staus' => array('NEW' => 1, 'ACCEPTED' => 2, 'REJECTED' => 3, 'ASSIGNED' => 4, 'PICKUP_ACCEPTED' => 5, 'STARTED' => 6, 'REPAIRS_STARTED' => 7, 'REPAIRS_COMPLETED' => 8, 'ASSIGN_DELIVERY' => 9, 'FINISHED' => 10),
        // 'order_staus' => array('NEW' => 1, 'ACCEPTED' => 2, 'REJECTED' => 3, 'ASSIGNED' => 4, 'PICKUP_ACCEPTED' => 5, 'STARTED' => 6, 'REPAIRS_STARTED' => 7, 'REPAIRS_COMPLETED' => 8, 'ASSIGN_DELIVERY' => 9, 'FINISHED' => 10, 'VEHICLE_COLLECTED' => 11, 'CANCELLED' => 12),
        'order_staus' => array(
            'NEW' => 1,
            'ACCEPTED' => 2,
            'REJECTED' => 3,
            'ASSIGNED' => 4,
            'PICKUP_ACCEPTED' => 5,
            'STARTED' => 6,
            'REPAIRS_STARTED' => 7,
            'REPAIRS_COMPLETED' => 8,
            'ASSIGN_DELIVERY' => 9,
            'FINISHED' => 10,
            'VEHICLE_COLLECTED' => 11,
            'CANCELLED' => 12,
            'DELIVERY_ACCEPTED' => 13,
            14 => 'CUSTOMER_NOT_AVAILABLE'
        ),
        'webImageURL' => 'http://metrepersecond.com/assets/',
        'payment_keys' => array(
            'ccavenue' => array(
                'merchant_id' => '105397',
                'access_code' => 'AVEH66DG32CL38HELC',
                'working_key' => '6F6871227204E80B4AA7570E32BEEE30',
                'redirect_url' => 'http://metrepersecond.com/index.php/Booking/BookAService/PaymentResponse',
                'cancel_url' => 'http://metrepersecond.com/index.php/Booking/BookAService/PaymentResponse',
                'self_redirect_url' => 'http://metrepersecond.com/index.php/Self/SelfDrive/PaymentResponse',
                'self_cancel_url' => 'http://metrepersecond.com/index.php/Self/SelfDrive/PaymentResponse',
                'currency' => 'INR',
                'language' => 'EN',
                'secure_url' => 'https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction'
            ),
            'mobile_ccavenue' => array(
                'secure_url' => 'https://secure.ccavenue.com/transaction/getRSAKey'
            )
        ),
        'payment_status' => array(
            'ccavenue' => array(
                'Success' => 1,
                'Aborted' => 2,
                'Failure' => 3
            )
        ),
        'smtp_config' => array(
            'smtp_host' => 'smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_secure' => 'ssl',
            'smtp_auth' => true,
            'username' => 'support@metrepersecond.com',
            'password' => 'Mps_support',
            'encoding' => 'base64',
            'from_mail' => 'support@metrepersecond.com'
        ),
        'current_tax' => 14.5,
        'tax' => '14.5',
        'fcm_mechanic_runner' => array(
            'server_key' => 'AAAAfTz00Ew:APA91bEyhSY7-JIkpYLq35dMXlxslzZAue03esJuz1yZytiEi2pW_DTeqlgb5G1iq9BGE2kuz7WmNE98sr2DNywTP-6cBfzkjUQWAvnN1GNvRoXjvEHKr7_92RxdhEmqCh47i2fwYUEIg41GpR0vtmWrrSOFwof7ew',
            'secure_url' => 'https://fcm.googleapis.com/fcm/send'
        ),
        'fcm_customer' => array(
            'server_key' => 'AAAATxquI_w:APA91bHvlgxQ5F-GYKeCiHQ3i3H0aSMHhYKkR181VJF6PyDujf5DbfjegrJ1iSelX-I17IxkBZwGrLE0PE_FMSJSjP0yHtGoP0cGx0X1wPwofXIYW76j4ZUE5qbFjmNNoFjjRnobx2gR2bDfJ0SECSeKGB-DruHPVg',
            'secure_url' => 'https://fcm.googleapis.com/fcm/send'
        ),
        'app_download_link' => 'https://play.google.com/store/apps/details?id=com.mps.mpsb2c&hl=en',
        'service_codes' => array(
            'bookaservice' => array(
                'car' => 'MPSHSC',
                'car_digit' => 6,
                'car_padding' => 8,
                'car_format' => 'MPSHSC00001000',
                'bike' => 'MPSHSB',
                'bike_digit' => 6,
                'bike_padding' => 8,
                'bike_format' => 'MPSHSB00001000'
            ),
            'selfdrive' => array(
                'car' => 'MPSHDC',
                'car_digit' => 6,
                'car_padding' => 8,
                'car_format' => 'MPSHDC00001000',
                'bike' => 'MPSHDB',
                'bike_digit' => 6,
                'bike_padding' => 8,
                'bike_format' => 'MPSHDB00001000'
            ),
            'hireamechanic' => array(
                'car' => 'MPSMC',
                'car_digit' => 5,
                'car_padding' => 9,
                'car_format' => 'MPSMC000001000',
                'bike' => 'MPSMB',
                'bike_digit' => 5,
                'bike_padding' => 9,
                'bike_format' => 'MPSMB000001000'
            ),
            'registration_ids' => array(
                'customer' => 'MPSCUST',
                'customer_digit' => 7,
                'customer_padding' => 7,
                'customer_format' => 'MPSCUST0000001',
                'mechanic' => 'MPSMECH',
                'mechanic_digit' => 7,
                'mechanic_padding' => 7,
                'mechanic_format' => 'MPSMECH0000001',
                'runner' => 'MPSRUNR',
                'runner_digit' => 7,
                'runner_padding' => 7,
                'runner_format' => 'MPSRUNR0000001',
                'selfdriveagent' => 'MPSSDRV',
                'selfagent_digit' => 7,
                'selfagent_padding' => 7,
                'selfagent_format' => 'MPSSDRV0000001',
                'hireamechanic' => 'MPSHMB',
                'hire_digit' => 6,
                'hire_padding' => 8,
                'hire_format' => 'MPSHMB00000001'
            )
        ),
        'carpm_credentials' => array(
            'username' => 'rk@metrepersecond.com',
            'password' => 'rakesh@carpm'
        )
    )
);

