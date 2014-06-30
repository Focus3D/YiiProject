<?php
/**
 * Created by PhpStorm.
 * User: maksimtrunov
 * Date: 22.06.14
 * Time: 11:06
 */

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class AdminController extends Controller {

	public function actionIndex()
	{
		if(Yii::$app->user->isGuest) {
			$this->goHome();
		}

		//$this->layout = 'admin';
		return $this->render('index');
	}
} 