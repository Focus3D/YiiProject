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
use app\models\UploadForm;

class FileController extends Controller
{
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only' => ['index', 'save', 'get', 'delete'],
				'rules' => [
					// deny all POST requests
					[
						'allow' => true,
						'verbs' => ['GET'],
						'roles' => ['@'],
					],
					[
						'allow' => true,
						'verbs' => ['POST'],
						'roles' => ['@'],
					],
					[
						'allow' => true,
						'verbs' => ['GET'],
						'roles' => ['@'],
					],
					[
						'allow' => true,
						'verbs' => ['GET'],
						'roles' => ['@'],
					],
					// everything else is denied
				],
			],
		];
	}

	public function actionIndex()
	{
		return $this->render( 'index', [
			'files' => new UploadForm(),
		] );
	}

	public function actionSave()
	{
		if (Yii::$app->request->isPost) {
			$model = new UploadForm();
			$model->files = UploadedFile::getInstances($model, 'files');

			if ($model->files && $model->validate()) {
				$model->saveFiles();
			}

			$this->redirect(Url::to(['file/index']));
		}
	}

	public function actionGet($id)
	{
		$model = new UploadForm();

		$file = $model->findOne(['id' => $id]);
		Yii::$app->response->setDownloadHeaders($file['original_name'], $file['type'], false, $file['size']);
	}

	public function actionDelete($id)
	{
		$model = new UploadForm();

		if ($model->delete(['id' => $id]) && unlink(Yii::$app->params['filePath'] . $file['name'])) {
			Yii::$app->session->setFlash('file', 'Файл успешно удален.');
			$this->redirect(Url::to(['file/index']));
		} else {
			Yii::$app->session->setFlash('file', 'Ошибка удаления файла.');
		}
	}
} 