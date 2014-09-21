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

class FileController extends Controller{

	public $enableCsrfValidation = false;

	public function actionSave()
	{
		if(Yii::$app->request->isAjax) {
			if(!empty($_FILES)) {
				foreach ($_FILES as $file) {
					if ($file['error'][0] == 0 && move_uploaded_file($file['tmp_name'][0], Yii::$app->basePath . '/upload/' . $file['name'][0])) {
						return $this->renderAjax('save', ['status' => 'ok']);
					}
				}
			}
		} else return $this->renderAjax('save', ['status' => 'error']);
	}

	public function actionUpload()
	{
		return $this->render('upload');
	}
} 