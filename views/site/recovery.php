<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 02.01.15
 * Time: 18:50
 */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\RecoveryForm $model
 */
$this->title = 'Аутентификация';
?>

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="well">
			<h2 class="text-center"><?= Yii::t('app/login', 'Password Recovery') ?></h2>
			<?php $form = ActiveForm::begin([
				'id' => 'recovery-password-form',
				'fieldConfig' => [
					'template' => "{input}\n<div>{error}</div>",
				],
			]) ?>
				<div class="form-group">
					<?= $form->field($model, 'email')->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>
				</div>

				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<div class="row">
							<div class="col-md-6">
								<?= Html::submitButton(Yii::t('app/login', 'Recovery'), ['class' => 'btn btn-signup']) ?>
							</div>
							<div class="col-md-6">
								<?= Html::a(Yii::t('app/login', 'Sign in'), Url::toRoute('login'), ['class' => 'btn btn-signin']) ?>
							</div>
						</div>
					</div>
				</div>
			<?php ActiveForm::end() ?>
		</div>
	</div>
</div>