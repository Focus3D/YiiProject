<?php
/**
 * Created by PhpStorm.
 * User: maksimtrunov
 * Date: 22.06.14
 * Time: 11:06
 */

namespace app\controllers;

use app\models\UploadForm;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
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

		$upload = new UploadForm();
		$count = User::getCount();
		$dataProvider = new ActiveDataProvider([
			'query' => User::find(),
			'pagination' => [

			],
		]);

		return $this->render('index', [
			'count' => $count,
			'upload' => $upload,
			'dataProvider' => $dataProvider,
		]);
	}

} 