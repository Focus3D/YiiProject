<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/**
 * @var yii\web\View           $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\LoginForm   $model
 */
$this->title = 'Файлы';
$this->params['breadcrumbs'][] = $this->title;
?>

<?
if (Yii::$app->session->getFlash('file')) : ?>
	<div class="alert alert-success" role="alert"><?= Yii::$app->session->getFlash('file') ?></div>
<? endif ?>

<div class="row">
	<div class="panel panel-primary col-lg-3">
		<div class="panel-body">
			<?php $form = ActiveForm::begin([
				'id' => 'file-form',
				'action' => Url::to(['file/add']),
				'options' => [
					'enctype' => 'multipart/form-data',
					'class' => 'form-horizontal',
				]
			]) ?>
			<?= $form->field($model, 'file')->fileInput(); ?>
			<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
			<?php ActiveForm::end() ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="panel panel-primary col-lg-12">
		<div class="panel-body">
			<table class="table table-hover table-bordered file-list">
				<tr>
					<td class="col-lg-1">#</td>
					<td class="col-lg-8">Имя</td>
					<td class="col-lg-3">Действие</td>
				</tr>
				<? $counter = 1; ?>
				<? foreach ($files as $i => $file) : ?>
					<tr>
						<td class="col-lg-1"><?= $counter ?></td>
						<td class="col-lg-8"><?= $file ?></td>
						<td class="col-lg-3">
							<a href="<?= Url::to(['file/'. $file .'/download/']) ?>">
								<span class="glyphicon glyphicon-download" aria-hidden="true"></span>
								Скачать
							</a>
							<?php if (Yii::$app->user->identity->username === 'admin') : ?>
								<a href="<?= Url::to(['file/'. $file .'/delete/']) ?>">
									<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
									Удалить
								</a>
							<?php endif ?>
						</td>
					</tr>
					<? $counter++; ?>
				<? endforeach ?>
			</table>
		</div>
	</div>
</div>
