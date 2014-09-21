<?php

use yii\helpers\Url;

$this->title = 'Загрузка Файлов';
?>
<div class="upload-form">
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
	<div class="progress">
		<div class="progress-bar progress-bar-striped active"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">
			<span class="sr-only"></span>
		</div>
	</div>
</div>