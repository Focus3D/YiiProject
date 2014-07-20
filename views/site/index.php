<?php
/**
 * @var yii\web\View $this
 */
use yii\helpers\Html;
use Imagine\Image\Box;

$this->title = 'Welcome in My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?=Html::encode($this->title);?></h1>
		<div class="row">

		</div>
    </div>

    <div class="body-content">

        <div class="row">
			<ul class="bxslider">
				<?php
				foreach($resizeImagesArray as $i => $image) : ?>
					<li><img src="<?=$image?>" /></li>
				<?php endforeach;?>
			</ul>
        </div>

    </div>
</div>
