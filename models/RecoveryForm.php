<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\base\Security;
use app\models\User;

/**
 * RecoveryForm is the model behind the recovery form.
 * @_identity false|app\models\User
 */
class RecoveryForm extends Model
{
	public $email;

	private $_identity = false;

	public function attributeLabels()
	{
		return [
			'email' => 'Email',
		];
	}

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
			['email', 'required'],
			['email', 'email'],
			['email', 'checkEmail'],
		];
	}

	public function checkEmail()
	{
		if ($this->_identity === false) {
			$this->_identity = User::findOne(['email' => $this->email]);

			if (!$this->_identity instanceof User) {
				$this->addError('email', 'Пользователь с таким email не найден.');
				return false;
			}
		}
		return true;
	}

	public function sendToken()
	{
		if ($identity = $this->getUser()) {
			return Yii::$app->mail->compose()
				->setTo($identity->getAttribute('email'))
				->setFrom([$identity->getAttribute('email') => $identity->getAttribute('name')])
				->setSubject(Yii::t('app/login', 'Password Recovery'))
				->setTextBody(Html::a(Yii::t('app/login', 'Password Recovery'), $_SERVER['SERVER_NAME'] . Url::to(['site/recovery']) . '?token=' . $identity->getAttribute('auth_key')))
				->send();
		}
	}

	public function getUser()
	{
		if ($this->_identity instanceof User) {
			return $this->_identity;
		} else {
			return false;
		}
	}
}
