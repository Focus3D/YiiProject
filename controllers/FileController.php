<?php
/**
 * Created by PhpStorm.
 * User: maksimtrunov
 * Date: 14.08.14
 * Time: 21:27
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use app\models\UploadForm;

class FileController extends Controller
{

	public function actionUpload()
	{
		$model = new UploadForm();

		if ( Yii::$app->request->isPost ) {
			$files = UploadedFile::getInstances( $model, 'file' );

			foreach ( $files as $file ) {

				$_model = new UploadForm();

				$_model->file = $file;

				if ( $_model->validate() ) {
					$_model->file->saveAs( Yii::$app->params[ 'uploadFolder' ] . $_model->file->baseName . '.' . $_model->file->extension );
				} else {
					foreach ( $_model->getErrors( 'file' ) as $error ) {
						$model->addError( 'file', $error );
					}
				}
			}

			if ( $model->hasErrors( 'file' ) ) {
				$model->addError(
					'file',
					count( $model->getErrors( 'file' ) ) . ' of ' . count( $files ) . ' files not uploaded'
				);
			}
		}
		return $this->render( 'upload', [ 'model' => $model ] );
	}

} 