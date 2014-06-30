<?php
/**
 * Created by PhpStorm.
 * User: maksimtrunov
 * Date: 30.06.14
 * Time: 11:08
 */

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;

class RegisterForm extends ActiveRecord
{
	public $id;
	public $username;
	public $password;
	public $password2;
	public $email;
	public $auth_key;

	public static function tableName()
	{
		return 'users';
	}

	public function rules()
	{
		return [
			['id', 'safe'],
			[['username', 'password', 'password2', 'email'], 'required'],
			['username', 'string', 'min' => 3, 'max' => 40],
			['password', 'string', 'min' => 3, 'max' => 30],
			['password2', 'string', 'min' => 3, 'max' => 30],
			['email', 'email'],
			['password', 'compare', 'compareAttribute' => 'password2'],
			['auth_key', 'safe'],
		];
	}

	public function register()
	{
		$this->auth_key = Security::generateRandomKey();
		$this->password = Security::generatePasswordHash($this->password);

		$connection = Yii::$app->db;
		$command = $connection->createCommand('INSERT INTO users
																(username,
																 password,
																 email,
																 auth_key)
														VALUES (:username,
																:password,
																:email,
																:auth_key)
											');
		$command->bindValues([':username' => $this->username,
							  ':password' => $this->password,
							  ':email' => $this->email,
							  ':auth_key' => $this-> auth_key,
							]);

		$result = $command->execute();

		if($result && $result > 0) {
			if($user = User::findByUsername($this->username)) {
				if(Yii::$app->user->login($user)) {
					return true;
				}
			}
		}

		return false;
	}

} 