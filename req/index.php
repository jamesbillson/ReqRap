<?php
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 300);
error_reporting(E_ALL);
ini_set("display_errors", 1);
define('WP_USE_THEMES', true);
$wp_did_header = true;
// wordpress config
require_once(dirname(__FILE__).'/../wp-load.php');

// change the following paths if necessary
$yii=dirname(__FILE__).'/../../yii/framework/yiilite.php';
$config = dirname(__FILE__).'/protected/config/main.php';



// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::$enableIncludePath = false;


Yii::createWebApplication($config)->run();
