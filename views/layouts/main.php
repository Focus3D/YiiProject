<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);
?>

<?php $this->beginPage() ?>

	<!DOCTYPE html>
	<html lang="<?= Yii::$app->language ?>">

	<head>
		<meta charset="<?= Yii::$app->charset ?>"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?= Html::encode($this->title) ?></title>
		<?php $this->head() ?>
	</head>
	<body>

	<?php $this->beginBody() ?>

	<div class="site-wrapper">

		<div class="site-wrapper-inner">

			<div class="cover-container">

				<div class="masthead clearfix">
					<div class="inner">
						<h3 class="masthead-brand">Webhome</h3>
						<?php
						echo Nav::widget([
							'options' => ['class' => 'nav masthead-nav'],
							'items' => [
								['label' => 'Home', 'url' => ['/site/index']],
								['label' => 'About', 'url' => ['/site/about']],
								['label' => 'Contact', 'url' => ['/site/contact']],
								['label' => 'File Upload', 'url' => ['/file/upload']],
								(!Yii::$app->user->isGuest && Yii::$app->user->identity->username === 'admin') ?
									['label' => 'Admin', 'url' => ['/admin/index']] : '',
								Yii::$app->user->isGuest ?
									['label' => 'Login', 'url' => ['/site/login']] :
									['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
										'url' => ['/site/logout'],
										'linkOptions' => ['data-method' => 'post']],
								(Yii::$app->user->isGuest) ?
									['label' => 'Register', 'url' => ['/site/register']] : '',
							],
						]);
						?>
					</div>
				</div>

				<?= $content ?>

				<div class="mastfoot">
					<div class="inner">
						<p class="pull-left">&copy; Maksim Trunov <?= date('Y') ?></p>
						<p class="pull-right"><?= Yii::powered() ?></p>
					</div>
				</div>

			</div>

		</div>

	</div>

	<?php $this->endBody() ?>
	</body>
	</html>
<?php $this->endPage() ?>