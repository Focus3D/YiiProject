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
use yii\data\ActiveDataProvider;

$this->title = 'Администрирование';
?>

<div class="row">
	<div class="panel panel-primary">
		<div class="panel-heading">Пользователи
			<span class="badge pull-right">
				<?=(isset($count)) ? $count : ''?>
			</span>
		</div>
		<div class="panel-body">
			<?php echo GridView::widget([
				'id' => 'users',
				'layout' => "{errors}\n{summary}\n{items}\n{pager}",
				'tableOptions' => ['class' => 'table table-striped table-hover'],
				'summaryOptions' => ['class' => 'lead'],
				'captionOptions' => ['class' => 'lead'],
				//'rowOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-12'],
				'summary' => false,
				'caption' => 'Список пользователей',
				'filterSelector' => 'filter',
				'filterUrl' => Yii::$app->urlManager->createUrl('user/filter'),
				'dataProvider' => $dataProvider,
				'columns' => [
					['class' => 'yii\grid\DataColumn', 'attribute' => 'id',],
					['class' => 'yii\grid\DataColumn', 'attribute' => 'username', 'label' => 'Логин'],
					['class' => 'yii\grid\DataColumn', 'attribute' => 'email', 'label' => 'Email'],
					['class' => 'yii\grid\ActionColumn', 'controller' => 'admin',
						'urlCreator' => function($action, $model, $key, $index) {
								return Yii::$app->urlManager->createUrl('user/'.$model->id.'/'.$action);
							},
					],
				]
			])?>
		</div>
	</div>
</div>

<div class="row">
	<div class="panel panel-primary">
		<div class="panel-heading">Оплата</div>
		<div class="panel-body">
			<form class="form-horizontal" role="form" action="<?=Url::to(['yandex/index'])?>">
				<div class="form-group">
					<label class="col-xs-4 control-label">Назначение</label>
					<div class="col-xs-8">
						<p class="form-control-static">Оплата услуг</p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-4 control-label">Сумма</label>
					<div class="col-xs-6 input-group">
						<input class="form-control" type="text" placeholder="Сумма к оплате">
						<span class="input-group-addon">руб.</span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-6 col-xs-offset-4">
						<button class="btn btn-success" type="submit">Оплатить</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="row">
	<div class="panel panel-primary">
		<div class="panel-heading">Загрузка файлов</div>
		<div class="panel-body">
			<span class="btn btn-success fileinput-button">
				<i class="glyphicon glyphicon-plus"></i>
				<span>Выбрать файлы</span>
				<!-- The file input field used as target for the file upload widget -->
				<input id="fileupload" type="file" name="files[]" data-url="<?=Url::to(['file/save'])?>" multiple>
			</span>
		</div>
	</div>
</div>