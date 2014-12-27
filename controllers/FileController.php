<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 02.12.14
 * Time: 17:05
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

class FileController extends Controller
{
	public $sharingPath = '/Volumes/Warehouse/WebWarehouse/Sharing';

	public function actionSharing()
	{
		$files = scandir($this->sharingPath);

		return $this->render( 'sharing', [
			'files' => $files,
			'path' => $this->sharingPath,
		] );
	}
} 