<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\LoginForm $model
 */
$this->title = 'Общая папка';
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="row">
		<div class="col-lg-12">
			<table class="table table-hover">
				<?php
				foreach ( $files as $file) {
					echo "<tr class='active'><td>$file</td></tr>";
				}
				?>
			</table>
		</div>
    </div>
