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

			<!--form action="https://phpaste.ga/register/submit" method="post">
				<div class="form-group">
					<input type="email" name="email" class="form-control" placeholder="Email Address">
				</div>

				<div class="form-group">
					<input type="text" name="username" maxlength="16" class="form-control" placeholder="Username">
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="password" name="password" class="form-control" placeholder="Password">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="password" name="password_repeat" class="form-control" placeholder="...repeat password">
						</div>
					</div>
				</div>
				<hr>
				<p class="text-center text-muted">Please see our <a href="#" data-toggle="modal" data-target="#PassReq">password requirements</a>.</p>
				<hr>
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<button type="submit" name="register" class="btn btn-signup btn-block">Sign up</button>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<a href="https://phpaste.ga/login" class="btn btn-signin btn-block">Sign in</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<input name="_token" type="hidden" value="naA9WULDEIPhAE78Baga173AvDDK52C1CNoqdAtS">
			</form-->

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
			<hr>
			<div class="row">
			<?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
				'template' => '<div class="col-lg-6">{input}</div><div class="col-lg-6">{image}</div>',
			]) ?>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<?= Html::submitButton(Html::encode(Yii::t('app/register', 'Sign up')), ['class' => 'btn btn-signup btn-block', 'name' => 'login-button']) ?>
							</div>
						</div>
						<div class="col-md-6">
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