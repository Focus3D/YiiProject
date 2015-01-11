<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 11.01.15
 * Time: 14:27
 */

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use app\models\File;
use app\models\Image;

class ImageController extends Controller
{
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only' => ['save'],
				'rules' => [
					// deny all POST requests
					[
						'allow' => true,
						'verbs' => ['POST'],
						'roles' => ['@'],
					],
					// everything else is denied
				],
			],
		];
	}

	public function actionSave()
	{
		if (Yii::$app->request->isPost) {
			$model = new Image();

			$model->image = UploadedFile::getInstances($model, 'image');

			if ($model->image && $model->validate()) {
				$model->saveImages();
			}
		}
	}
}