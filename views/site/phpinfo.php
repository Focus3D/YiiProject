<?php
/**
 * Created by PhpStorm.
 * User: maksimtrunov
 * Date: 20.07.14
 * Time: 14:38
 */
$this->title = 'php info';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index"><?= phpinfo();?></div>