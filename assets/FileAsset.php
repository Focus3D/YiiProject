<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 12.01.15
 * Time: 21:16
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class FileAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		'css/site.css',
		'css/jquery.fileupload-ui.css',
		'css/jquery.fileupload.css',
	];
	public $js = [
		'js/jquery.ui.widget.js',
		'js/jquery.fileupload.js',
		'js/jquery.iframe-transport.js',
		'js/script.js',
	];
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
	];
}
