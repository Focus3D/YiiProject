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

class AdminController extends Controller
{
	public function beforeAction($action) {
		$this->layout = 'admin';
		parent::beforeAction($action);
		return true;
	}

	public function actionIndex()
	{
		if(Yii::$app->user->isGuest) {
			$this->goHome();
		}

		return $this->render('index');
	}

	public function actionUsers()
	{
		return $this->render('users');
	}

} 