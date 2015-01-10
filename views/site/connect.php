<?php
/**
 * @var yii\web\View $this
 */

$this->registerJsFile('@web/js/webRTC.js');
$this->title = Yii::t('app/connect', 'Development page with WebRTC');
$this->params['breadcrumbs'][] = $this->title;
?>

<audio autoplay controls></audio>

