<?php
return ['bundles' => [
	'all' => [
		'class' => 'yii\web\AssetBundle',
		'basePath' => '@webroot/assets',
		'baseUrl' => '@web/assets',
		'css' => [

		],
		'js' => [
			'js/script.js',
		],
		'depends' => [
			'yii\web\YiiAsset',
			'yii\bootstrap\BootstrapAsset',
		],
	],
	'login' =>
			['css' => [

			],
			'js' => [

			],
			'depends' => [
				'all'
			]
		],
	],
];