<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\data\ActiveDataProvider;
use \yii\bootstrap\Progress;

/**
 * @var yii\web\View           $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\UploadForm  $files
 */
$this->registerAssetBundle('app\assets\FileAsset');
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
				'query' => $files->find(),
				'pagination' => [
					'pageSize' => 10,
				],
			]),
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			['class' => 'yii\grid\DataColumn', 'attribute' => 'id',],
			['class' => 'yii\grid\DataColumn', 'attribute' => 'original_name', 'label' => 'Имя файла'],
			['class' => 'yii\grid\DataColumn', 'attribute' => 'size', 'label' => 'Размер'],
			['class' => 'yii\grid\DataColumn', 'attribute' => 'type', 'label' => 'Тип файла'],
			['class' => 'yii\grid\ActionColumn',
				'header' => 'Действие',
				'controller' => 'file',
				'template' => '{get} {delete}',
				'buttons' => [
					'get' => function ($url, $model, $key) {
							return Html::a('Скачать <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>', $url);
						},
					'delete' => function ($url, $model, $key) {
							return Html::a('Удалить <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>', $url);
						},
				],
				'urlCreator' => function ($action, $files, $key, $index) {
						return Yii::$app->urlManager->createUrl('file/' . $files->id . '/' . $action);
					},
			],
		]
	])?>
</div>

<div class="row last">
	<?php $form = ActiveForm::begin([
			'id' => 'files-form',
			'action' => Url::to(['file/save']),
			'options' => [
				'enctype' => 'multipart/form-data',
				'class' => 'form-inline col-lg-6 col-md-8 col-xs-12',
			]
		]) ?>
		<?= $form->field($files, 'files[]')->fileInput(['multiple' => true]); ?>
		<?= Html::submitButton('Отправить <span class="glyphicon glyphicon-upload" aria-hidden="true"></span>', ['class' => 'btn btn-success']) ?>
		<?= Html::resetButton('', ['class' => 'hidden']) ?>
		<?= Progress::widget([
			'id' => 'files-form-progress',
			'percent' => 0,
			'barOptions' => ['class' => 'progress-bar'],
			'options' => ['class' => 'active progress-striped']
		]); ?>
	<?php ActiveForm::end() ?>
</div>