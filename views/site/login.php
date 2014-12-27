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
$this->title = 'Аутентификация';
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="row">
		<div class="jumbotron">
			<p>Для регистрации нажмите <?= Html::a('регистрация', Url::toRoute('register')) ?></p>
		</div>
		<div class="col-lg-12">
			<h1><?= Html::encode($this->title) ?></h1>

			<p>Пожалуйста заполните поля для входа:</p>

			<?php $form = ActiveForm::begin([
				'id' => 'login-form',
				'options' => ['class' => 'form-horizontal'],
				'fieldConfig' => [
					'template' => "<div class=\"col-lg-6\">{input}</div>\n<div class=\"col-lg-6\">{error}</div>",
				],
			]); ?>
			<?= $form->field($model, 'username')->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>
			<?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>
			<?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
				'template' => '<div class="row"><div class="col-lg-6">{input}</div><div class="col-lg-6">{image}</div></div>',
			]) ?>
			<?= $form->field($model, 'rememberMe', [
				'template' => "<div class=\"col-lg-offset-3 col-lg-4\">{input}</div>\n<div class=\"col-lg-2\">{error}</div>",
			])->checkbox() ?>

			<div class="form-group">
				<div class="col-lg-offset-3">
					<?= Html::submitButton('Вход', ['class' => 'btn btn-primary col-lg-2', 'name' => 'login-button']) ?>
				</div>
			</div>

			<?php ActiveForm::end(); ?>

		</div>
    </div>
