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
		$upload = new UploadForm();

		if ( Yii::$app->request->isPost ) {
			$files = UploadedFile::getInstances( $upload, 'file' );

			foreach ( $files as $file ) {

				$_model = new UploadForm();

				$_model->file = $file;

				if ( $_model->validate() ) {
					$_model->file->saveAs( Yii::$app->params[ 'uploadFolder' ] . $_model->file->baseName . '.' . $_model->file->extension );
				} else {
					foreach ( $_model->getErrors( 'file' ) as $error ) {
						$upload->addError( 'file', $error );
					}
				}
			}

			if ( $upload->hasErrors( 'file' ) ) {
				$upload->addError(
					'file',
					count( $upload->getErrors( 'file' ) ) . ' of ' . count( $files ) . ' files not uploaded'
				);
			}
		}
		$this->goBack(Yii::$app->request->getReferrer());
	}
} 