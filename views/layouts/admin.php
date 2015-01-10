<?php
/**
 * Created by PhpStorm.
 * User: maksimtrunov
 * Date: 22.06.14
 * Time: 11:20
 */
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use \yii\helpers\Url;

/**
 * @var \yii\web\View $this
 * @var string        $content
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
			NavBar::begin([
				'brandLabel' => 'Администрирование',
				'brandUrl' => Url::to(['admin/index']),
				'options' => [
					'class' => 'navbar-inverse navbar-fixed-top',
				],
			]);
			echo Nav::widget([
				'options' => ['class' => 'navbar-nav navbar-right'],
				'items' => [
					['label' => 'В публичную часть', 'url' => ['site/index']],
					!Yii::$app->user->isGuest ?
						['label' => 'Выйти (' . Yii::$app->user->identity->username . ')',
							'url' => ['/site/logout'],
							'linkOptions' => ['data-method' => 'get']] : '',
					['label' => 'PHP Info', 'url' => ['site/phpinfo']],
				],
			]);
			NavBar::end();
			?>
		</div>
		<div class="row">
			<?= Breadcrumbs::widget([
				'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
				'homeLink' => ['label' => 'Главная', 'url' => Url::to(['site/index'])],
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