<?php

$params = require(__DIR__ . '/params.php');

$config = [
	'id' => 'basic',
	'charset' => 'UTF-8',
	'basePath' => dirname( __DIR__ ),
	'bootstrap' => [ 'log' ],
	'sourceLanguage' => 'en-US',
	'language' => 'ru-RU',
	'components' => [
		'i18n' => [
			'translations' => [
				'app*' => [
					'class' => 'yii\i18n\PhpMessageSource',
					'basePath' => '@app/messages',
					'sourceLanguage' => 'en-US',
					'fileMap' => [
						'app' => 'app.php',
						'app/error' => 'error.php',
						'app/file' => 'file.php',
						'app/user' => 'user.php',
						'app/login' => 'login.php',
						'app/register' => 'register.php',
						'app/chat' => 'rtc.php',
					],
				],
			],
		],
		'request' => [
			'cookieValidationKey' => 'af6191c79d23c085e8e49c8966cbdaae',
		],
		'urlManager' => [
			'enablePrettyUrl' => true,
			'enableStrictParsing' => false,
			'showScriptName' => false,
			'suffix' => '.html',
			'rules' => [
				'file/<id:\d+>/<action:(get|delete)>' => 'file/<action>',
				'POST <controller:(file)>/<action:(save)>' => '<controller>/<action>',
				'<controller:(user)>/<id:\d+>/<action:(view|update|delete|create)>' => 'user/<action>',
				'<controller:(admin)>/<action:(index)>' => '<controller>/<action>',
				'<controller:(site)>/<action:(index|login|register|logout|contact|about|phpinfo|rtc)>' => '<controller>/<action>',
				'<controller:(yandex)>/<action:(index)>' => '<controller>/<action>',
			],
		],
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],
		'user' => [
			'identityClass' => 'app\models\User',
			'enableAutoLogin' => false,
		],
		'errorHandler' => [
			'errorAction' => 'error/error',
		],
		'mail' => [
			'class' => 'yii\swiftmailer\Mailer',
			// send all mails to a file by default. You have to set
			// 'useFileTransport' to false and configure a transport
			// for the mailer to send real emails.
			'useFileTransport' => false,
		],
		'log' => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets' => [
				[
					'class' => 'yii\log\FileTarget',
					'levels' => [ 'error', 'warning', 'info' ],
				],
			],
		],
		'db' => require(__DIR__ . '/db.php'),
		'security' => [
			'class' => 'yii\base\Security',
			'passwordHashStrategy' => 'crypt',
		],
		'image' => [
			'class' => 'yii\imagine\Image',
		],
	],
	'params' => $params,
];

if ( YII_ENV_DEV ) {
	// configuration adjustments for 'dev' environment
	$config[ 'bootstrap' ][ ] = 'debug';
	$config[ 'modules' ][ 'debug' ] = [
		'class' => 'yii\debug\Module',
		'allowedIPs' => [ '127.0.0.1', '::1' , '77.120.128.77' ],
	];

	$config[ 'bootstrap' ][ ] = 'gii';
	$config[ 'modules' ][ 'gii' ] = 'yii\gii\Module';
}

return $config;
