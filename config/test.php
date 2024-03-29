<?php
$params = require __DIR__ . '/params.php';
$db     = require __DIR__ . '/test_db.php';

/**
 * Application configuration shared by all test types
 */
return [
	'id'         => 'basic-tests',
	'basePath'   => dirname(__DIR__),
	'aliases'    => [
		'@bower' => '@vendor/bower-asset',
		'@npm'   => '@vendor/npm-asset',
	],
	'language'   => 'en-US',
	'components' => [
		'db'           => $db,
		'mailer'       => [
			'useFileTransport' => TRUE,
		],
		'assetManager' => [
			'basePath' => __DIR__ . '/../web/assets',
		],
		'urlManager'   => [
			'showScriptName' => TRUE,
		],
		'user'         => [
			'identityClass' => 'app\models\User',
		],
		'request'      => [
			'cookieValidationKey'  => 'test',
			'enableCsrfValidation' => FALSE,
			// but if you absolutely need it set cookie domain to localhost
			/*
			'csrfCookie' => [
				'domain' => 'localhost',
			],
			*/
		],
	],
	'params'     => $params,
];
