<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\RegisterForm $model
 */
$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="well">
			<h2 class="text-center"><?= Html::encode(Yii::t('app/register', 'Sign up')) ?></h2>

			<p><?= Html::encode(Yii::t('app/register', 'Please fill the fields for registration')) ?>:</p>

			<?php $form = ActiveForm::begin([
				'id' => 'register',
				'fieldConfig' => [
					'template' => "{input}\n{error}",
				],
			]); ?>

			<?= $form->field($model, 'username')->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

			<?= $form->field($model, 'email')->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>

			<div class="row">
				<div class="col-md-6">
					<?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>
				</div>
				<div class="col-md-6">
				<?= $form->field($model, 'password2')->passwordInput(['placeholder' => $model->getAttributeLabel('password2')]) ?>
				</div>
			</div>
			<div class="row">
				<label class="label"><?= $model->getAttributeLabel('verifyCode') ?>
				<?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
					'template' => '<div class="col-lg-6 col-md-6 col-sm-6">{input}</div><div class="col-lg-3 col-md-3 col-sm-3">{image}</div>',
				]) ?>
				</label>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="form-group">
								<?= Html::submitButton(Html::encode(Yii::t('app/register', 'Sign up')), ['class' => 'btn btn-signup btn-block', 'name' => 'login-button']) ?>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="form-group">
								<?= Html::a(Yii::t('app/register', 'Sign in'), Url::toRoute('login'), ['class' => 'btn btn-signin btn-block']) ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php ActiveForm::end(); ?>

		</div>
	</div>
</div>