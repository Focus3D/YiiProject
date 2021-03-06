<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 02.12.14
 * Time: 20:44
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Product;

class ProductController extends Controller
{
	public function actionAdd()
	{
		$model = new Product();

		if ( Yii::$app->request->isPost ) {
			$model->load( Yii::$app->request->post(), 'Commodity' );
			if ( $model->validate() && $model->saveItem() ) {
				Yii::$app->session->setFlash( 'item', 'Товар успешно сохранен' );
				$this->redirect( Yii::$app->request->getReferrer() );
			} else {
				Yii::$app->session->setFlash( 'item', $model->getErrors() );
				$this->redirect( Yii::$app->request->getReferrer() );
			}
		} else $this->goHome();
	}
} 