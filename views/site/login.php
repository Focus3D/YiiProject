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
			<h2 class="text-center"><?= Yii::t('app/login', 'Sign in') ?></h2>
			<?php $form = ActiveForm::begin([
				'id' => 'login-form',
				'options' => ['class' => 'form-horizontal'],
				'fieldConfig' => [
					'template' => "{input}\n<div>{error}</div>",
				],
			]); ?>

			<?= $form->field($model, 'username')->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

			<?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>
			<div class="row">
				<label class="label"><?= $model->getAttributeLabel('verifyCode') ?>
				<?= $form->field($model, 'verifyCode')->textInput()->widget(Captcha::className(), [
					'template' => '<div class="col-lg-6">{input}</div><div class="col-lg-3">{image}</div>',
				]) ?>
				</label>
			</div>

			<?= $form->field($model, 'rememberMe', [
				'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>",
			])->checkbox() ?>

			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="row">
						<div class="col-md-6">
							<?= Html::submitButton(Yii::t('app/login', 'Sign in'), ['class' => 'btn btn-signin', 'name' => 'login']) ?>
						</div>
						<div class="col-md-6">
							<?= Html::a(Yii::t('app/login', 'Sign up'), Url::toRoute('register'), ['class' => 'btn btn-signup']) ?>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<p class="text-center"><?= Yii::t('app/login', 'Forgotten your password?') ?>
						<?= Html::a(Yii::t('app/login', 'Recover it here'), Url::to(['site/recover'])) ?>
					</p>
				</div>
			</div>
			<?php $form->end() ?>
		</div>
	</div>
</div>