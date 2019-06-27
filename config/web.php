<?php

$params = array_merge(
	require __DIR__ . '/params.php',
	require __DIR__ . '/staff.php'
);
$db     = require __DIR__ . '/db.php';

$config = [
	'id'         => 'basic',
	'basePath'   => dirname(__DIR__),
	'bootstrap'  => ['log'],
	'aliases'    => [
		'@bower' => '@vendor/bower-asset',
		'@npm'   => '@vendor/npm-asset',
	],
	'components' => [
		'request'      => [
			'cookieValidationKey' => 'cCVOyTDSN4x75SBgYJG1okO28LuPXO7U',
		],
		'cache'        => [
			'class' => 'yii\caching\FileCache',
		],
		'user'         => [
			'identityClass'   => 'app\models\User',
			'enableAutoLogin' => TRUE,
		],
		'errorHandler' => [
			'errorAction' => 'site/error',
		],
		'log'          => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets'    => [
				[
					'class'  => 'yii\log\FileTarget',
					'levels' => ['error', 'warning'],
				],
			],
		],
		'db'           => $db,
		'urlManager' => [
			'class'           => 'yii\web\UrlManager',
			'showScriptName'  => FALSE,
			'enablePrettyUrl' => TRUE,
			'rules'           => [
				'<controller:[a-z0-9\-]+>/<id:\d+>'                      => '<controller>/index',
				'<controller:[a-z0-9\-]+>'                               => '<controller>/index',
				'<controller:[a-z0-9\-]+>/<action:[a-z0-9\-]+>/<id:\d+>' => '<controller>/<action>',
				'<controller:[a-z0-9\-]+>/<action:[a-z0-9\-]+>'          => '<controller>/<action>',

				'<module:[a-z0-9\-]+>/<controller:[a-z0-9\-]+>/<id:\d+>'                      => '<module>/<controller>/index',
				'<module:[a-z0-9\-]+>/<controller:[a-z0-9\-]+>'                               => '<module>/<controller>/index',
				'<module:[a-z0-9\-]+>/<controller:[a-z0-9\-]+>/<action:[a-z0-9\-]+>/<id:\d+>' => '<module>/<controller>/<action>',
				'<module:[a-z0-9\-]+>/<controller:[a-z0-9\-]+>/<action:[a-z0-9\-]+>'          => '<module>/<controller>/<action>',
			],
		],
		'mailer'     => [
			'class'     => 'yii\swiftmailer\Mailer',
			'transport' => [
				'class'      => 'Swift_SmtpTransport',
				'host'       => 'smtp.gmail.com',
				'username'   => 'tpphung0328@gmail.com',
				'password'   => 'Roronoazoro#2',
				'port'       => '587',
				'encryption' => 'tls',
			],
		],
	],
	'params'     => $params,
	'name'       => 'Bee ham chơi',
];

if (YII_ENV_DEV){
	// configuration adjustments for 'dev' environment
	$config['bootstrap'][]      = 'debug';
	$config['modules']['debug'] = [
		'class' => 'yii\debug\Module',
		// uncomment the following to add your IP if you are not connecting from localhost.
		//'allowedIPs' => ['127.0.0.1', '::1'],
	];

	$config['bootstrap'][]    = 'gii';
	$config['modules']['gii'] = [
		'class' => 'yii\gii\Module',
		// uncomment the following to add your IP if you are not connecting from localhost.
		//'allowedIPs' => ['127.0.0.1', '::1'],
	];
}

return $config;
