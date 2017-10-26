<?php
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'联联圈',
	'preload'=>array('log'),
	'language'=>'zh_cn',  //此处根据你拷贝文件夹名自行设置
	'import'=>array(
		'application.widgets.*',
		'application.models.*',
		'application.components.*',
	),
	'defaultController'=>'Default',
	'modules'=>array(
		'admin'=>array(),
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'admin',
		 	'connectionID' => 'db',
			// 可登录的IP
			'ipFilters'=>array('127.0.0.1','192.168.3.101'),

		),
	),

	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// 文件缓存
		/*'cache' => array (
			'class' =>'system.caching.CFileCache'
		),*/
		//memcache内存缓存
		'cache'=>array(
			'class'=>'application.components.UUMemCache',
			'servers'=>array(
				array('host'=>'10.0.0.246', 'port'=>9101, 'weight'=>100),
			),
			'keyPrefix' => 'lzshare_',
			'hashKey' => false,
		),
		'session' => array (
            'sessionName' => 'PHPSESSID',
            'class'=> 'CCacheHttpSession',
			'timeout'=>600*10
            //'cacheID' => 'mcache',
            //'autoStart' => true,
            //'cookieMode' => 'only',

        ),
		'urlManager'=>array(
			'urlFormat'=>'path',
			//'caseSensitive'=>false,
			'showScriptName'=>false,
			'rules'=>array(
				/*
				'<controller:\w+>'=>'/<controller>',
				'<controller:\w+>/<action:\w+>*'=>'/<controller>/<action>',*/
			),
		),
		//本机数据 库
		'db'=>array(
			'class'=>'CDbConnection',
			'connectionString'=>'mysql:host=10.0.0.208;port=3306;dbname=lzhd_share',
			'emulatePrepare'=>true,
			'username'=>'lzhd_sys',
			'password'=>'PUCFgbPZURjPmysK',
			'charset'=>'utf8'
		),
		//微信服务器
		'wxdb'=>array(
			'class'            => 'CDbConnection' ,
			'connectionString' => 'mysql:host=559a93c0ee108.gz.cdb.myqcloud.com;port=8010;dbname=db_wechat',
			'emulatePrepare' => true,
			'username' => 'outer_lzhd',
			'password' => 'Mdi21NE2*32@0Ml0Ajd#dmHEL1s',
			'charset' => 'utf8',
		),
		'errorHandler'=>array(
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				array(
					'class'=>'WDbLogRoute',
					'autoCreateLogTable'=>true,
					'categories'=>'system.*,exception.CDbException,exception.CException,php',
					'connectionID'=>'db',
					'logTableName'=>'sys_log',
					'levels'=>'error, warning',
				),
				array(
                    'class'=>'CDbLogRoute',
                    'autoCreateLogTable'=>true,
                    'categories'=>'system.*,exception.CDbException,exception.CException,php',
					'connectionID'=>'db',
					'logTableName'=>'addon_system_log',
					'levels'=>'error, warning',
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
	//使用方法 Yii::app()->params['paramName']
	'params'=>array(
		'adminEmail'=>'webmaster@example.com',
		'title'=> '联联圈',
		'homeUrl'=>'http://share.i-lz.cn',
		'preImageUrl'=>'http://share.i-lz.cn',
		'wxapiBaseUrl'=>'http://interface.i-lz.cn/wxapi/',
		'defautlUploadImg'=>WEB_URL . '/static/images/icon/ooopic.png',
	    'ghtype'=>array(0=>'普通订阅号',1=>'认证订阅号',2=>'普通服务号',3=>'认证服务号'),
	    'oauthtype'=>array(1=>'联众互动科技',2=>'联众互动',3=>'腾讯微购物',4=>'扫货帮接口',5=>'万科接口',100=>'自己'),
		'classify'=>array(	0=>'默认',4=>'首发',3=>'竞赛',2=>'推荐',1=>'热度'),
	),
);