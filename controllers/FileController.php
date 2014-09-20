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
			Yii::info(print_r($_FILES, true));
			return $this->renderAjax(json_encode(['status' => 'ok']));
		} else return $this->renderAjax(json_encode(['status' => 'error']));
	}

	public function actionUpload()
	{
		return $this->render('upload');
	}
} 