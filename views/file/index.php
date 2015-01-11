<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

/**
 * @var yii\web\View           $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\File        $model
 */
$this->title = 'Файлы';
$this->params['breadcrumbs'][] = $this->title;
?>

<?
if (Yii::$app->session->getFlash('file')) : ?>
	<div class="alert alert-success" role="alert"><?= Yii::$app->session->getFlash('file') ?></div>
<? endif ?>

<div class="row">
	<?php echo GridView::widget([
		'id' => 'files',
		'layout' => "{errors}\n{summary}\n{items}\n{pager}",
		'tableOptions' => ['class' => 'table table-striped table-hover col-log-12 col-md-8 col-xs-4'],
		'caption' => 'Список файлов',
		'filterSelector' => 'filter',
		'filterUrl' => Yii::$app->urlManager->createUrl('file/filter'),
		'dataProvider' => new ActiveDataProvider([
				'query' => $file::find(),
				'pagination' => [
					'pageSize' => 20,
				],
			]),
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			['class' => 'yii\grid\DataColumn', 'attribute' => 'id',],
			['class' => 'yii\grid\DataColumn', 'attribute' => 'type', 'label' => 'Тип файла'],
			['class' => 'yii\grid\DataColumn', 'attribute' => 'name', 'label' => 'Имя файла'],
			['class' => 'yii\grid\DataColumn', 'attribute' => 'size', 'label' => 'Размер'],
			['class' => 'yii\grid\ActionColumn', 'controller' => 'file',
				'template' => '{get} {delete}',
				'buttons' => [
					'get' => function ($url, $model, $key) {
							return Html::a('<span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>', $url);
						},
				],
				'urlCreator' => function ($action, $file, $key, $index) {
						return Yii::$app->urlManager->createUrl('file/' . $file->id . '/' . $action);
					},
			],
		]
	])?>
</div>

<div class="row">
	<?php $form = ActiveForm::begin([
		'id' => 'file-form',
		'action' => Url::to(['file/save']),
		'options' => [
			'enctype' => 'multipart/form-data',
			'class' => 'form-inline col-lg-6 col-md-8 col-xs-12',
		]
	]) ?>
	<?= $form->field($file, 'file')->fileInput(); ?>
	<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
	<?php ActiveForm::end() ?>
</div>

<div class="row">
	<?php $form = ActiveForm::begin([
		'id' => 'images-form',
		'action' => Url::to(['image/save']),
		'options' => [
			'enctype' => 'multipart/form-data',
			'class' => 'form-inline col-lg-6 col-md-8 col-xs-12',
		]
	]) ?>
	<?= $form->field($image, 'image[]')->fileInput(['multiple' => true]); ?>
	<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
	<?php ActiveForm::end() ?>
</div>