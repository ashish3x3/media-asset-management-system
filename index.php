<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

//log4php
require_once dirname(__FILE__).'/protected/extensions/log4php/Logger.php';

Logger::configure("configuration/log4php/yiilog4phpdemo.xml");

require_once($yii);
Yii::createWebApplication($config)->run();
