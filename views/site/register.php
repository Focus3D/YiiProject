<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\LoginForm $model
 */
$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
	<div class="row">
		<div class="jumbotron orange">
			<p>Перейти на страницу аутентификации <?= Html::a('вход', Url::toRoute('login')) ?></p>
		</div>

		<h1><?= Html::encode($this->title) ?></h1>

		<p>Пожалуйста заполните поля для регистрации:</p>

		<?php $form = ActiveForm::begin([
			'id' => 'register',
			'options' => ['class' => 'form-horizontal'],
			'fieldConfig' => [
				'template' => "<div class=\"col-lg-6\">{input}</div>\n<div class=\"col-lg-6\">{error}</div>",
				'labelOptions' => ['class' => 'col-lg-2 control-label'],
			],
		]); ?>

		<?= $form->field($model, 'username')->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

		<?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

		<?= $form->field($model, 'password2')->passwordInput(['placeholder' => $model->getAttributeLabel('password2')]) ?>

		<?= $form->field($model, 'email')->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>

		<?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
			'template' => '<div class="row"><div class="col-lg-6">{input}</div><div class="col-lg-6">{image}</div></div>',
		]) ?>


		<div class="form-group">
			<div class="col-lg-offset-1">
				<?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
			</div>
		</div>

		<?php ActiveForm::end(); ?>

	</div>