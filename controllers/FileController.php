<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 02.12.14
 * Time: 17:05
 */

namespace app\controllers;

use Yii;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use app\models\UploadForm;

class FileController extends Controller
{
   public $enableCsrfValidation = false;


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
		if (Yii::$app->request->isPost && Yii::$app->request->isAjax) {
			$model = new UploadForm();
			$model->files = UploadedFile::getInstances($model, 'files');

			if ($model->files && $model->validate()) {
				$count = $model->saveFiles();
				if ($count == count($model->files)) {
					echo Json::encode(['Количество загруженных файлов' => $count]);
				} else {
					echo Json::encode($model->getErrors('files'));
				}
			}

		} else {
			echo Json::encode('Не верный формат запроса.');
		}
	}

	public function actionGet($id)
	{
		$model = UploadForm::findOne(['id' => $id]);

		Yii::$app->response->setDownloadHeaders($model->getAttribute('original_name'), $model->getAttribute('type'), false, $model->getAttribute('size'));
	}

	public function actionDelete($id)
	{
		$model = UploadForm::findOne(['id' => $id]);

		if (unlink(Yii::$app->params['filePath'] . $model->getAttribute('name') . '.' .$model->getAttribute('extension'))) {
			if ($model->delete()) {
				Yii::$app->session->setFlash('file', 'Файл успешно удален.');
			}
		} else {
			Yii::$app->session->setFlash('file', 'Ошибка удаления файла.');
		}

		$this->redirect(['file/index']);
	}
} 