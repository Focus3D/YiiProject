<?php
use yii\grid\GridView;

/**
 * Created by PhpStorm.
 * User: maksimtrunov
 * Date: 07.07.14
 * Time: 20:44
 */
$this->title = 'Данные пользователя';
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
		'dataProvider' => $dataProvider,
		'columns' => [
			['class' => 'yii\grid\DataColumn', 'attribute' => 'id',],
			['class' => 'yii\grid\DataColumn', 'attribute' => 'username', 'label' => 'Логин'],
			['class' => 'yii\grid\DataColumn', 'attribute' => 'email', 'label' => 'Email'],
			['class' => 'yii\grid\ActionColumn', 'controller' => 'admin',
				'urlCreator' => function ($action, $model) {
						return \Yii::$app->urlManager->createUrl('user/' . $model['id'] . '/' . $action);
					},
			],
		]
	])?>
</div>