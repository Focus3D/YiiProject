<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 02.01.15
 * Time: 15:07
 */

namespace app\controllers;

use yii\web\Controller;

class ErrorController extends Controller{

	public $layout = 'error';

	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
		];
	}
} 