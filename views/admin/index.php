<?php
/**
 * Created by PhpStorm.
 * User: maksimtrunov
 * Date: 22.06.14
 * Time: 11:08
 */
use yii\widgets\Menu;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;

$this->title = 'Администрирование';
?>
<div class="row">
	<div class="panel panel-primary">
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
				'dataProvider' => ( $dataProvider ) ? $dataProvider : null,
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
	<?php $fileInput = ActiveForm::begin( [
		'action' => Url::to( ['file/upload'] ),
		'options' => [
			'enctype' => 'multipart/form-data',
		]
	] ); ?>
	<?= $fileInput->field( $upload, 'file[]' )->fileInput( [ 'multiple' => '' ] ); ?>
	<?= Html::submitButton( 'Сохранить', [ 'class' => 'btn btn-primary col-lg-2', 'name' => 'upload' ] ); ?>
	<?php ActiveForm::end(); ?>
</div>