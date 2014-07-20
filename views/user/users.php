<?php

use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\User;
/**
 * Created by PhpStorm.
 * User: maksimtrunov
 * Date: 07.07.14
 * Time: 20:44
 */
$this->title = 'Список пользователей';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
	<?php echo GridView::widget([
		'id' => 'users',
		'layout' => "{errors}\n{summary}\n{items}\n{pager}",
		'tableOptions' => ['class' => 'table table-striped table-bordered table-hover'],
		'summaryOptions' => ['class' => 'lead'],
		'captionOptions' => ['class' => 'lead'],
		//'rowOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-12'],
		'caption' => 'Список пользователей',
		'filterSelector' => 'filter',
		'filterUrl' => Yii::$app->urlManager->createUrl('user/filter'),
		'dataProvider' => $dataProvider,
		'columns' => [
			['class' => 'yii\grid\DataColumn', 'attribute' => 'id',],
			['class' => 'yii\grid\DataColumn', 'attribute' => 'username', 'label' => 'Логин'],
			['class' => 'yii\grid\DataColumn', 'attribute' => 'email', 'label' => 'Email'],
			['class' => 'yii\grid\ActionColumn', 'controller' => 'admin',
				'urlCreator' => function($action, $model, $key, $index) {
						return Yii::$app->urlManager->createUrl('user/'.$model->id.'/'.$action);
					},
			],
		]
	])?>
</div>