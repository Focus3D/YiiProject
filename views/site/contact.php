<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\ContactForm $model
 */
$this->title = 'Контакт';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

    <div class="alert alert-success">
        Thank you for contacting us. We will respond to you as soon as possible.
    </div>

    <p>
        <?php if (Yii::$app->mail->useFileTransport): ?>
        Because the application is in development mode, the email is not sent but saved as
        a file under <code><?= Yii::getAlias(Yii::$app->mail->fileTransportPath) ?></code>.
        Please configure the <code>useFileTransport</code> property of the <code>mail</code>
        application component to be false to enable email sending.
        <?php endif; ?>
    </p>

    <?php else: ?>
		<h1>Форма обратной связи</h1>
		<p>
			Если у вас есть деловое предложение или другие вопросы, пожалуйста, заполните следующую форму, чтобы связаться с нами. Спасибо.
		</p>

		<div class="row">
			<div class="col-lg-12">
				<?php $form = ActiveForm::begin([
					'id' => 'contact',
					'options' => ['class' => 'form-horizontal'],
					'fieldConfig' => [
						'template' => "<div class=\"col-lg-6 col-sm-6 col-xs-6\">{input}</div>\n<div class=\"col-lg-3 col-sm-3 col-xs-3\">{error}</div>",
					],
				]); ?>
					<?= $form->field($model, 'name')->textInput(['placeholder' => $model->getAttributeLabel('name')]) ?>
					<?= $form->field($model, 'email')->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>
					<?= $form->field($model, 'subject')->textInput(['placeholder' => $model->getAttributeLabel('subject')]) ?>
					<?= $form->field($model, 'body')->textArea(['rows' => 6, 'placeholder' => $model->getAttributeLabel('body')]) ?>
					<?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
						'template' => '<div class="row"><div class="col-lg-6 col-sm-6 col-xs-6">{input}</div><div class="col-lg-6 col-sm-6 col-xs-6">{image}</div></div>',
					]) ?>
					<div class="form-group">
						<?= Html::submitButton('Отправить', ['class' => 'btn btn-primary col-lg-offset-1 col-sm-offset-1 col-xs-offset-1', 'name' => 'contact-button']) ?>
					</div>
				<?php ActiveForm::end(); ?>
			</div>
		</div>

    <?php endif; ?>
</div>
