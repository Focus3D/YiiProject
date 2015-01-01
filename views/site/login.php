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
?>

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="well">
				<h2 class="text-center">Sign in</h2>
				<?php $form = ActiveForm::begin([
					'id' => 'login-form',
					'options' => ['class' => 'form-horizontal'],
					'fieldConfig' => [
						'template' => "<div class=\"form-group\">{input}\n<div>{error}</div>",
					],
				]); ?>
					<?= $form->field($model, 'username')->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>
					<?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<div class="row">
								<div class="col-md-6">
									<?= Html::submitButton('Вход', ['class' => 'btn btn-signin', 'name' => 'login']) ?>
								</div>
								<div class="col-md-6">
									<?= Html::a('Регистрация', Url::toRoute('register'), ['class' => 'btn btn-signup']) ?>
								</div>
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<p class="text-center">Forgotten your password? <a href="https://phpaste.ga/recover/password">Recover it here</a>.</p>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

    <div class="row">
		<div class="jumbotron green ">
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
			<?= $form->field($model, 'verifyCode')->textInput(['placeholder' => $model->getAttributeLabel('verifyCode')])->widget(Captcha::className(), [
				'template' => '<div class="row"><div class="col-lg-6">{input}</div><div class="col-lg-6">{image}</div></div>',
			]) ?>
			<?= $form->field($model, 'rememberMe', [
				'template' => "<div class=\"col-lg-offset-1 col-lg-6\">{input}</div>\n<div class=\"col-lg-6\">{error}</div>",
			])->checkbox() ?>

			<div class="form-group">
				<div class="col-lg-offset-1">
					<?= Html::submitButton('Вход', ['class' => 'btn btn-primary col-lg-2', 'name' => 'login-button']) ?>
				</div>
			</div>

			<?php ActiveForm::end(); ?>

		</div>
    </div>
