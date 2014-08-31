<?php
/**
 * Created by PhpStorm.
 * User: maksimtrunov
 * Date: 22.06.14
 * Time: 11:08
 */
use yii\widgets\Menu;
use yii\helpers\Url;

$this->title = 'Администрирование';
?>

<div class="row">
	<div class="col-xs-3">
		<ul class="nav nav-pills nav-stacked">
			<li>
				<a href="<?=Url::to(['user/all'])?>" class="btn btn-primary">Пользователи
					<span class="badge pull-right">
						<?=(isset($users)) ? $users : ''?>
					</span>
				</a>
			</li>
		</ul>
	</div>
	<div class="col-xs-4 col-xs-offset-1">
		<div class="panel panel-primary">
			<div class="panel-heading">Оплата</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form">
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
	<div class="col-xs-3 col-xs-offset-1">
		<div class="panel panel-primary">
			<div class="panel-heading">Загрузка файлов</div>
			<div class="panel-body">
				<form role="form">
					<div class="form-group col-xs-12">
						<label for="fileupload">Кнопка загрузки</label>
						<input id="fileupload" data-url="<?=Url::to(['file/save'])?>" class="form-control" type="file" name="upload-file">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
