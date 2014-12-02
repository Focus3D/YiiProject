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
use app\models\UploadForm;

class FileController extends Controller
{
	public function actionSave()
	{
		$model = new UploadForm();

		if ( Yii::$app->request->isPost ) {
			$model->file = UploadedFile::getInstance( $model, 'file' );

			if ( $model->validate() ) {
				$model->file->saveAs( Yii::$app->params['uploadFolder'] . $model->file->baseName . '.' . $model->file->extension );
				Yii::$app->session->setFlash( 'file', 'Файл успешно сохранен' );
			} else {
				Yii::$app->session->setFlash( 'file', print_r( $model->getErrors( 'file' ), true ) );
			}
		}

		$this->goBack( Yii::$app->request->getReferrer() );
	}
} 