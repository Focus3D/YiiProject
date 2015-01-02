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
			<h2 class="text-center">Password Recovery</h2>
			<?php ActiveForm::begin([
				'id' => 'recover'
			]) ?>
				<div class="form-group">
					<input type="email" name="email" class="form-control" placeholder="Email Address">
											</div>

				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<div class="row">
							<div class="col-md-6">
								<button type="submit" name="recover" class="btn btn-signup">Recover</button>
							</div>
							<div class="col-md-6">
								<a href="https://phpaste.ga/login" class="btn btn-signin">Sign in</a>
							</div>
						</div>
					</div>
				</div>
			<?php ActiveForm::end() ?>
		</div>
	</div>
</div>