<?php

use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\User;
/**
 * Created by PhpStorm.
 * User: maksimtrunov
 * Date: 07.07.14
 * Time: 20:44
 */
$this->title = 'Упраление пользователями';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
	<?php
	$dataProvider = new ActiveDataProvider([
		'query' => User::find(),
		'pagination' => [
			'pageSize' => 20,
		],
	]);
	?>
	<?php echo GridView::widget([
		'id' => 'users',
		'layout' => "{summary}\n{items}\n{pager}",
		'tableOptions' => ['class' => 'table table-striped table-bordered'],
		'caption' => 'Список пользователей',
		'dataProvider' => $dataProvider,
	])?>
</div>