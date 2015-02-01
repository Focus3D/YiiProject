<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 18.01.15
 * Time: 10:48
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ChatAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		'css/site.css',
	];
	public $js = [
		'js/sipml5.js',
		'js/chat.js',
	];
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
	];
}
