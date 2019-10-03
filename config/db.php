<?php

return [
	'class'               => 'yii\db\Connection',
	'dsn'                 => 'mysql:host=localhost;dbname=beehamchoi',
	'username'            => 'root',
	'password'            => '',
	'charset'             => 'utf8',
	'tablePrefix'         => 'beebs_',

	// Schema cache options (for production environment)
	'enableSchemaCache'   => TRUE,
	'schemaCacheDuration' => 60,
	'schemaCache'         => 'cache',
];
