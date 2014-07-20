<?php
/**
 * @var yii\web\View $this
 */
use yii\helpers\Html;

$this->title = 'Welcome in My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?=Html::encode($this->title);?></h1>
    </div>

    <div class="body-content">

        <div class="row">
			<ul class="bxslider">
				<li><img src="/images/Abstract.jpg" /></li>
				<li><img src="/images/Antelope Canyon.jpg" /></li>
				<li><img src="/images/Bahamas Aerial.jpg" /></li>
				<li><img src="/images/Desert.jpg" /></li>
			</ul>
        </div>

    </div>
</div>
