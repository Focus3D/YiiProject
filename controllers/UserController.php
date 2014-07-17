<?php
/**
 * Created by PhpStorm.
 * User: maksimtrunov
 * Date: 13.07.14
 * Time: 19:56
 */

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\Controller;
use app\models\User;

class UserController extends Controller {

	public function actionView($id) {

		$dataProvider = new ActiveDataProvider([
			'query' => User::find()->filterWhere(['id' => $id]),
		]);

		return $this->render('view',[
			'dataProvider' => $dataProvider,
		]);
	}
} 