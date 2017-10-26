<?php
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'联众互动',
	'preload'=>array('log'),
	'language'=>'zh_cn',  //此处根据你拷贝文件夹名自行设置
	'import'=>array(
		'application.widgets.*',
		'application.models.*',
		'application.components.*',
	),
	'defaultController'=>'Default',
	'modules'=>array(
		'admin'=>array(
			//'class'=>'AdminModule'
		),
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
		'cache' => array (
			'class' =>'system.caching.CFileCache'
		),
		//memcache内存缓存
		/*'cache'=>array(
                'class'=>'system.caching.CMemCache',
                'servers'=>array(
                    array('host'=>'10.143.74.56', 'port'=>11211, 'weight'=>60),
                ),
         ),*/
		'session' => array (
            'sessionName' => 'PHPSESSID',
            'class'=> 'CCacheHttpSession',
			'timeout'=>600*10
           // 'cacheID' => 'mcache',
            //'autoStart' => true,
            //'cookieMode' => 'only',

        ),
		'urlManager'=>array(
			'urlFormat'=>'path',
			//'urlSuffix' => '.html',
			'showScriptName'=>false,
			'rules'=>array(
        		//'<controller:addonSystemLog|site>/<action:\w+>' => '<controller>/<action>',
				//'<controller:addonSystemLog|site>' => '<controller>',
        		/*'gii'=>'gii',
            	'gii/<controller:\w+>'=>'gii/<controller>',
            	'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',
				'stat'=>'stat',
				'stat/<controller:\w+>'=>'stat/<controller>',
				'stat/<controller:\w+>/<action:\w+>'=>'stat/<controller>/<action>',
				//'<controller:wxapi>/<_token:\w+>*' => '<controller>/index/_token/<_token>*',
				'http://<_m:(interface)>.i-lz.com<_q:.\w+>/<_token:\w+>*'=>'<_m>/<_q>/index/_token/<_token>',
				//'http://openapi.i-lz.com/<controller:wxapi>/<_token:\w+>*' => 'openapi/<controller>/index/_token/<_token>*',
				'http://<_m:(oauth)>.i-lz.com<_q:.*>/*'=>'<_m><_q>',
*/
				//union----
				//'/'=>'default',
				/*'<controller:\w+>'=>'/<controller>',
				'<controller:\w+>/<action:\w+>*'=>'/<controller>/<action>',
				'<module:\w+>/<controller:\w+>'=>'/<module>/<controller>',
				'<module:\w+>/<controller:\w+>/<action:\w+>*'=>'/<module>/<controller>/<action>',*/
			),
		),
		//微信数据库
		/*'db'=>array(
			'connectionString' => 'mysql:host=127.0.0.1;dbname=lzsys',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'root',
			'charset' => 'utf8',
		),
		//插件数据库
		'db2'=>array(
			'class'            => 'CDbConnection' ,
			'connectionString' => 'mysql:host=127.0.0.1;dbname=lzaddons',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'root',
			'charset' => 'utf8',
		),*/
		//数据库
		'db'=>array(
			'connectionString' => 'mysql:host=127.0.0.1;port=3306;dbname=share',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'root',
			'charset' => 'utf8mb4',
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
		//插件数据库
		/*'db2'=>array(
			'class'            => 'CDbConnection' ,
			'connectionString' => 'mysql:host=127.0.0.1;dbname=ptdata',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'root',
			'charset' => 'utf8',
		),*/
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
				/*array(
					'class' => 'CWebLogRoute',
					
					'levels'=>'error, warning, trace, profile, info',
					'levels' => 'trace', //级别为trace
					'categories' => 'system.db.*' //只显示关于数据库信息,包括数据库连接,数据库执行语句
				),*/
				/*array(
					'class'=>'WDbLogRoute',
					'autoCreateLogTable'=>true,
					'categories'=>'system.*,exception.CDbException,exception.CException,php',
					'connectionID'=>'db',
					'logTableName'=>'sys_log',
					'levels'=>'error, warning',
				),*/
				/*array(
                    'class'=>'CDbLogRoute',
                    'autoCreateLogTable'=>true,
                    'categories'=>'system.*,exception.CDbException,exception.CException,php',
					'connectionID'=>'db2',
					'logTableName'=>'addon_system_log',
					'levels'=>'error, warning',
                ),*/
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
		//'title'=> '联众微营销平台',
		'title'=> '推广平台后台管理',
		'homeUrl'=>'http://s.i-lz.com',
		'preImageUrl'=>'http://s.i-lz.com',
		'defautlUploadImg'=>WEB_URL . '/static/images/icon/ooopic.png',
	    'ghtype'=>array(0=>'普通订阅号',1=>'认证订阅号',2=>'普通服务号',3=>'认证服务号'),
	    'oauthtype'=>array(1=>'联众互动科技',2=>'联众互动',3=>'腾讯微购物',4=>'扫货帮接口',5=>'万科接口',100=>'自己'),
		'classify'=>array(	0=>'默认',4=>'首发',3=>'竞赛',2=>'推荐',1=>'热度'),

	),
);