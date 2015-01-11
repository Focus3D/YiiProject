<?php
/**
 * Created by PhpStorm.
 * User: maksimtrunov
 * Date: 22.06.14
 * Time: 11:08
 */

use yii\grid\GridView;
use yii\data\ActiveDataProvider;

$this->title = 'Администрирование';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
	<?php echo GridView::widget([
		'id' => 'users',
		'layout' => "{errors}\n{summary}\n{items}\n{pager}",
		'tableOptions' => ['class' => 'table table-striped table-hover'],
		'caption' => 'Список пользователей',
		'filterSelector' => 'filter',
		'filterUrl' => Yii::$app->urlManager->createUrl('user/filter'),
		'dataProvider' => new ActiveDataProvider([
				'query' => $model::find(),
				'pagination' => [
					'pageSize' => 20,
				],
			]),
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			['class' => 'yii\grid\DataColumn', 'attribute' => 'id',],
			['class' => 'yii\grid\DataColumn', 'attribute' => 'username', 'label' => 'Логин'],
			['class' => 'yii\grid\DataColumn', 'attribute' => 'email', 'label' => 'Email'],
			['class' => 'yii\grid\ActionColumn', 'controller' => 'admin',
				'urlCreator' => function ($action, $model, $key, $index) {
						return Yii::$app->urlManager->createUrl('user/' . $model->id . '/' . $action);
					},
			],
		]
	])?>
</div>

<div class="row">
	<?/*php if (Yii::$app->session->hasFlash('model')) {
			echo '<div class="alert alert-info" role="alert">' . Yii::$app->session->getFlash('model') . '</div>';
			Yii::$app->session->removeFlash('model');
		}?>
		<?php if (Yii::$app->session->hasFlash('image')) {
			echo '<div class="alert alert-info" role="alert">' . Yii::$app->session->getFlash('image') . '</div>';
			Yii::$app->session->removeFlash('image');
		}?>

	<?php $item = ActiveForm::begin([
		'id' => 'commodity',
		'action' => Url::to(['admin/index']),
		'options' => [
			'enctype' => 'multipart/form-data',
			'class' => 'form-horizontal',
		],
		'fieldConfig' => [
			'template' => "{label}\n<div class=\"col-lg-8\">{input}</div>\n<br><div class=\"col-lg-12\">{error}</div>",
			'labelOptions' => ['class' => 'col-lg-4 control-label'],
		],
	]); ?>
	<?= $item->field($model, 'name'); ?>
	<?= $item->field($model, 'quantity'); ?>
	<?= $item->field($model, 'cost'); ?>
	<?= $item->field($model, 'files')->fileInput(['multiple' => 'multiple']); ?>
	<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success col-lg-offset-4']); ?>
	<?php ActiveForm::end();*/ ?>
</div>