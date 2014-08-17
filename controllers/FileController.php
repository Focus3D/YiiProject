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
		Yii::getLogger()->log(print_r('Files '. $_FILES, true), Logger::LEVEL_INFO);
	}
} 