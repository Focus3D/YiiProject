<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\base\Security;
use app\models\User;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{
	public $username;
	public $password;
	public $rememberMe = true;
	public $verifyCode;

	private $_identity = false;

	public function attributeLabels()
	{
		return [
			'username' => 'Логин',
			'password' => 'Пароль',
			'rememberMe' => 'Запомнить меня',
			'verifyCode' => 'Проверочный код',
		];
	}

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
			// username and password are both required
			[['username', 'password'], 'required'],
			// rememberMe must be a boolean value
			['rememberMe', 'boolean'],
			// password is validated by validatePassword()
			['password', 'validatePassword'],
			['verifyCode', 'captcha'],
		];
	}

	/**
	 * Validates password
	 *
	 * @param  string $password password to validate
	 *
	 * @return boolean if password provided is valid for current user
	 */
	public function validatePassword($password)
	{
		$user = $this->getUser();
		if ($user instanceof User) {
			return Yii::$app->security->validatePassword($this->password, $user->password);
		} else {
			$this->addError('username', 'Пользователя с таким логином не существует.');
			return false;
		}
	}

	/**
	 * Logs in a user using the provided username and password.
	 *
	 * @return boolean whether the user is logged in successfully
	 */
	public function login()
	{
		if ($this->validate()) {
			return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
		} else return false;
	}

	public function getUser()
	{
		if ($this->_identity === false) {
			$this->_identity = User::findByUsername(['username' => $this->username]);
		}

		return $this->_identity;
	}
}
