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
	<div class="col-lg-2 col-xs-2 col-md-2">
		<a href="<?=Url::to(['user/all'])?>" class="btn btn-primary btn-lg">Пользователи</a>
	</div>
</div>

