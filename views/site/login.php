<?php
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
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Пожалуйста заполните поля для входа:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

	<?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
		'template' => '<div class="row"><div class="col-lg-6">{image}</div><div class="col-lg-6">{input}</div></div>',
	]) ?>

    <?= $form->field($model, 'rememberMe', [
        'template' => "<div class=\"col-lg-offset-3 col-lg-4\">{input}</div>\n<div class=\"col-lg-2\">{error}</div>",
    ])->checkbox() ?>

    <div class="form-group">
        <div class="col-lg-offset-3 col-lg-19">
            <?= Html::submitButton('Вход', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
