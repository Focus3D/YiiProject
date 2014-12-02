<?php
/**
 * Created by PhpStorm.
 * User: maksimtrunov
 * Date: 22.06.14
 * Time: 11:06
 */

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;
use app\models\UploadForm;
use app\models\User;

class AdminController extends Controller
{
	public function beforeAction($action) {
		$this->layout = 'admin';
		parent::beforeAction($action);
		return true;
	}

	public function actionIndex()
	{
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