<?php

use yii\helpers\Url;
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
	<div class="container">
		<div class="page-header">
			<?php
			NavBar::begin(
			['brandLabel' => $_SERVER['SERVER_NAME'],
			 'brandUrl' => Yii::$app->homeUrl,
			 'options' => [
				 'class' => 'navbar-inverse navbar-fixed-top',
				],
			]);
			if (!Yii::$app->user->isGuest) {
				echo Nav::widget([
					'options' => ['class' => 'navbar-nav navbar-right'],
					'items' => [
						['label' => 'Home', 'url' => ['/site/index']],
						['label' => 'About', 'url' => ['/site/about']],
						['label' => 'Contact', 'url' => ['/site/contact']],
						['label' => 'File Upload', 'url' => ['/file/upload']],
						(Yii::$app->user->identity->username === 'admin') ?
							['label' => 'Admin', 'url' => ['/admin/index']] : '',
						['label' => 'Logout (' . Yii::$app->user->identity->username . ')', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'get']],
						(Yii::$app->user->isGuest) ?
							['label' => 'Register', 'url' => ['/site/register']] : '',
					],
				]);
			} else {
				echo Nav::widget([
					'options' => ['class' => 'navbar-nav navbar-right'],
					'items' => [
						['label' => 'Контакт', 'url' => ['/site/contact']],
						['label' => 'Скачать', 'url' => ['/file/sharing']],
					],
				]);
			}

			NavBar::end();
			?>
		</div>
		<div class="row">
			<?= Breadcrumbs::widget([
				'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
				'homeLink' => ['label' => 'Главная', 'url' => Url::home()],
			]) ?>
		</div>
		<?= $content ?>
		<footer class="navbar-fixed-bottom">
			<div class="container">
				<div class="col-lg-12">
					<p class="pull-left">&copy; Maksim Trunov <?= date('Y') ?></p>
					<p class="pull-right"><?= Yii::powered() ?></p>
				</div>
			</div>
		</footer>
	</div>
	<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>