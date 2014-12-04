<?php
/**
 * Created by PhpStorm.
 * User: maksimtrunov
 * Date: 22.06.14
 * Time: 11:08
 */

use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;

$this->title = 'Администрирование';
$this->params[ 'breadcrumbs' ][ ] = $this->title;
?>
<div class="row">
	<div class="panel panel-info">
		<div class="panel-heading">Пользователи
			<span class="badge pull-right">
				<?= (isset($count)) ? $count : '' ?>
			</span>
		</div>
		<div class="panel-body">
			<?php echo GridView::widget( [
				'id' => 'users',
				'layout' => "{errors}\n{summary}\n{items}\n{pager}",
				'tableOptions' => [ 'class' => 'table table-striped table-hover' ],
				'summaryOptions' => [ 'class' => 'lead' ],
				'captionOptions' => [ 'class' => 'lead' ],
				//'rowOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-12'],
				'summary' => false,
				'caption' => 'Список пользователей',
				'filterSelector' => 'filter',
				'filterUrl' => Yii::$app->urlManager->createUrl( 'user/filter' ),
				'dataProvider' => ($dataProvider) ? $dataProvider : null,
				'columns' => [
					[ 'class' => 'yii\grid\DataColumn', 'attribute' => 'id', ],
					[ 'class' => 'yii\grid\DataColumn', 'attribute' => 'username', 'label' => 'Логин' ],
					[ 'class' => 'yii\grid\DataColumn', 'attribute' => 'email', 'label' => 'Email' ],
					[ 'class' => 'yii\grid\ActionColumn', 'controller' => 'admin',
						'urlCreator' => function ( $action, $model, $key, $index ) {
								return Yii::$app->urlManager->createUrl( 'user/' . $model->id . '/' . $action );
							},
					],
				]
			] )?>
		</div>
	</div>
</div>

<div class="row">
	<!--div class="col-lg-4">
		<?php if ( Yii::$app->session->hasFlash( 'file' ) ) {
			echo '<div class="alert alert-info" role="alert">'. Yii::$app->session->getFlash('file') . '</div>';
			Yii::$app->session->removeFlash( 'file' );
		}?>
		<div class="panel panel-info">
			<div class="panel-heading">Загрузка файлов</div>
			<div class="panel-body">
				<?php $fileInput = ActiveForm::begin( [
					'id' => 'image',
					'action' => Url::to( [ 'image/add' ] ),
					'options' => [
						'enctype' => 'multipart/form-data',
					]
				] ); ?>
				<?= $fileInput->field( $image, 'image' )->fileInput( [ 'class' => 'btn btn-info' ] ); ?>
				<?= Html::submitButton( 'Сохранить', [ 'class' => 'btn btn-success' ] ); ?>
				<?php ActiveForm::end(); ?>
			</div>
		</div>
	</div-->

	<div class="col-lg-4">
		<?php if ( Yii::$app->session->hasFlash( 'model' ) ) {
			echo '<div class="alert alert-info" role="alert">'. Yii::$app->session->getFlash('model') . '</div>';
			Yii::$app->session->removeFlash( 'model' );
		}?>
		<?php if ( Yii::$app->session->hasFlash( 'image' ) ) {
			echo '<div class="alert alert-info" role="alert">'. Yii::$app->session->getFlash('image') . '</div>';
			Yii::$app->session->removeFlash( 'image' );
		}?>
		<div class="panel panel-info">
			<div class="panel-heading">Создание товара</div>
			<div class="panel-body">
				<?php $item = ActiveForm::begin( [
					'id' => 'commodity',
					'action' => Url::to( [ 'admin/index' ] ),
					'options' => [
						'enctype' => 'multipart/form-data',
						'class' => 'form-horizontal',
					],
					'fieldConfig' => [
						'template' => "{label}\n<div class=\"col-lg-8\">{input}</div>\n<br><div class=\"col-lg-12\">{error}</div>",
						'labelOptions' => ['class' => 'col-lg-4 control-label'],
					],
				] ); ?>
				<?= $item->field( $commodity, 'name' ); ?>
				<?= $item->field( $commodity, 'quantity' ); ?>
				<?= $item->field( $commodity, 'cost' ); ?>
				<?= $item->field( $image, 'image' )->fileInput( [ 'name' => 'image' ] ); ?>
				<?= Html::submitButton( 'Сохранить', [ 'class' => 'btn btn-success col-lg-offset-4' ] ); ?>
				<?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>
</div>