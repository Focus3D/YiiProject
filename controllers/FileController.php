<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 02.12.14
 * Time: 17:05
 */

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use app\models\File;

class FileController extends Controller
{
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only' => ['index'],
				'rules' => [
					// deny all POST requests
					[
						'allow' => true,
						'verbs' => ['POST', 'GET'],
						'roles' => ['@'],
					],
					// everything else is denied
				],
			],
		];
	}

	public function actionIndex()
	{
		$model = new File();
		$files = $model->getSharedFiles();

		return $this->render( 'index', [
			'files' => $files,
			'model' => $model
		] );
	}

	public function actionAdd()
	{
		if (Yii::$app->request->isPost) {
			$model = new File();
			$model->file = UploadedFile::getInstance($model, 'file');

			if ($model->file && $model->validate()) {
				$model->file->saveAs($model->savePath . $model->file->baseName . '.' . $model->file->extension);
				Yii::$app->session->setFlash('file', 'Файл успешно сохранен.');
			} else {
				Yii::$app->session->setFlash('file', 'Ошибка сохранения файла.');
			}

			$this->redirect(Url::to(['file/index']));
		}
	}
} 