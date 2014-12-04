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
use app\models\Image;
use app\models\Commodity;
use app\models\User;

class AdminController extends Controller
{
	public function beforeAction( $action )
	{
		$this->layout = 'admin';
		parent::beforeAction( $action );
		return true;
	}

	public function actionIndex()
	{
		$model = new Commodity();
		$image = new Image();
		$count = User::getCount();
		$dataProvider = new ActiveDataProvider([
			'query' => User::find(),
			'pagination' => [

			],
		]);

		if ( Yii::$app->request->isPost ) {
			$file = null;
			$image->image = UploadedFile::getInstance( $image, 'image' );
			$path = Yii::$app->params[ 'uploadFolder' ] . $model->image->baseName . '.' . $model->image->extension;

			if ( $image->validate() && $image->image->saveAs( $path ) ) {
				$id = $image->saveImageInfo($path);

				if ( $id ) {
					if ( $model->load( Yii::$app->request->post() ) && $model->validate() ) {
						$model->saveItem( $id );
					}
				}
			}
		}

		return $this->render( 'index', [
			'commodity' => $model,
			'count' => $count,
			'image' => $image,
			'dataProvider' => $dataProvider,
		] );
	}

} 