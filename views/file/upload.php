<?php

use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 */
$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<?= $form->field($model, 'file[]')->fileInput(['multiple' => '']) ?>

	<button>Отправить</button>

<?php ActiveForm::end(); ?>