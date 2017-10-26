<?php
ini_set('date.timezone','Asia/Shanghai');
define ( 'ROOT_PATH', dirname ( __FILE__ ) );
define ( 'WEB_ROOT',"" );//网站文件夹 如无则为空不用加/扛
define ( 'WEB_HOST',"http://".$_SERVER ['HTTP_HOST'] );//网址
define ( 'ROOT_HOST', '.i-lz.cn');//session,cookie域
//ini_set('session.cookie_domain', ROOT_HOST);//域Session
define ( 'WEB_URL', WEB_HOST.WEB_ROOT );//
define ( "__PUBLIC__", WEB_URL . "/static" );
define ( 'UPLOAD_PATH',ROOT_PATH."/uploads" );
define ( 'QR_PATH',ROOT_PATH."/qrcode/" );
error_reporting(E_ALL^E_NOTICE);
ini_set("display_errors", "On");
$yii=dirname(__FILE__).'/yii-framework/yii.php';
if(strpos($_SERVER['REMOTE_ADDR'],'127.0.0')!==FALSE||strpos($_SERVER['REMOTE_ADDR'],'192.168')!==FALSE||strpos($_SERVER['REMOTE_ADDR'],'::1')!==FALSE) {
	ini_set("display_errors", "On");
	defined('YII_DEBUG') or define('YII_DEBUG',true);
	defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
	$config=dirname(__FILE__).'/protected/config/development.php';
}else{
	$config=dirname(__FILE__).'/protected/config/main.php';
}
require_once($yii);
require_once(dirname(__FILE__).'/protected/config/globals.php');
require_once(dirname(__FILE__).'/protected/config/common.php');
Yii::createWebApplication($config)->run();