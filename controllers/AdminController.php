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
use app\models\File;
use app\models\Product;
use app\models\User;

class AdminController extends Controller
{
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only' => [],
				'rules' => [
					[
						'allow' => true,
						'ips' => ['77.120.128.77', '127.0.0.1'],
					],
				],
			],
		];
	}

	public function beforeAction( $action )
	{
		$this->layout = 'admin';
		parent::beforeAction( $action );
		return true;
	}

	public function actionIndex()
	{
		$model = new User();

		if ( Yii::$app->request->isPost ) {
			if ( $model->load( Yii::$app->request->post() ) && $model->validate() ) {
				$model->save();
			}
		}

		return $this->render( 'index', [
			'model' => $model,
		] );
	}

} 