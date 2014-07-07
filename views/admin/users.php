<?php

use yii\grid\GridView;
/**
 * Created by PhpStorm.
 * User: maksimtrunov
 * Date: 07.07.14
 * Time: 20:44
 */
$this->title = 'Упраление пользователями';
//$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => Yii::$app->urlManager->createUrl('admin/index')];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
	<?GridView::widget(

	)?>
</div>