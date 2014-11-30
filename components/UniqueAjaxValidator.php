<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 30.11.14
 * Time: 21:42
 */

namespace components;

use yii\validators\Validator;
use app\models\User;

class UniqueAjaxValidator extends Validator
{
	public function init()
	{
		parent::init();
		$this->message = 'Данное значение уже занято.';
	}

	public function validateAttribute( $model, $attribute )
	{
		$value = $model->$attribute;

		if ( !User::find()->where( [ $attribute => $value ] )->exists() ) {
			$model->addError( $attribute, $this->message );
		}
	}

	public function clientValidateAttribute( $model, $attribute, $view )
	{
		if ( User::find()->where( [ $attribute => $model->$attribute ] )->count() ) {
			$message = json_encode( $this->message, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

			$model->addError( $attribute, $this->message );

			return <<<JS
				messages.push($message);
JS;

		}
	}
} 