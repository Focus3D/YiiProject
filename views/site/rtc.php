<?php
/**
 * @var yii\web\View $this
 */

$this->registerAssetBundle('app\assets\ChatAsset');
$this->title = Yii::t('app/chat', 'Site chat');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
	Чат
</div>