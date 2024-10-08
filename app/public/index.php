<?php
date_default_timezone_set('Asia/Jakarta');
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);

// change the following paths if necessary
$yii = dirname(__FILE__).'/../vendor/yiisoft/yii/framework/yii.php';
$config = dirname(__FILE__).'/../src/protected/config/main.php';

// remove the following lines when in production mode
// defined('YII_DEBUG') or define('YII_DEBUG', true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

$loader = require(__DIR__ . '/../vendor/autoload.php');
Yii::$classMap = $loader->getClassMap();

require_once($yii);
Yii::createWebApplication($config)->run();
