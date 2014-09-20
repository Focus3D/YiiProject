<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
		'request' => [
			'cookieValidationKey' => 'af6191c79d23c085e8e49c8966cbdaae',
		],
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'suffix' => '.html',
			'rules' => [
				'<controller:(user)>/<id:\d+>/<action:(view|update|delete|create)>' => 'user/<action>',
				'<controller:(admin)>/<action:(index)>' => '<controller>/<action>',
				'<controller:(site)>/<action:(index|login|logout|contact|about|phpinfo)>' => '<controller>/<action>',
				'<controller:(file)>/<action:(save)>' => '<controller>/<action>',
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
            'errorAction' => 'site/error',
        ],
        'mail' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info'],
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

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
		'class' => 'yii\debug\Module',
		'allowedIPs' => ['127.0.0.1', '::1']
	];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
