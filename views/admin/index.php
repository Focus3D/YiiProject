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
	<div class="col-sm-3">
		<ul class="nav nav-pills nav-stacked">
			<li>
				<a href="<?=Url::to(['user/all'])?>" class="btn btn-primary">Пользователи<span class="badge pull-right">42</span></a>
			</li>
		</ul>
	</div>
	<div class="col-sm-3 col-sm-offset-1">
		<div class="panel panel-primary">
			<div class="panel-heading">Загрузка файлов</div>
			<div class="panel-body">
				<form role="form">
					<div class="form-group">
						<label for="fileupload">Кнопка загрузки</label>
						<input id="fileupload" data-url="<?=Url::to(['file/save'])?>" class="form-control" type="file" name="upload-file">
						<div id="progress">
							<div class="bar" style="width: 0%;"></div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
