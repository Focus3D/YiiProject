<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 02.01.15
 * Time: 15:01
 */

namespace app\assets;

use yii\web\AssetBundle;

class ErrorAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		'css/error.css',
	];
	public $js = [];
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
	];
} 