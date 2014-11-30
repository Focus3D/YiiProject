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
use yii\base\Security;

class RegisterForm extends ActiveRecord
{
	public $id;
	public $username;
	public $password;
	public $password2;
	public $email;
	public $auth_key;
	public $verifyCode;

	public static function tableName()
	{
		return 'users';
	}

	public function attributeLabels()
	{
		return [
			'username' => 'Логин',
			'password' => 'Пароль',
			'password2' => 'Повторите пароль',
			'email' => 'Email',
			'verifyCode' => 'Проверочный код',
		];
	}

	public function rules()
	{
		return [
			[ [ 'username', 'password', 'password2', 'email' ], 'required' ],
			[ ['username', 'password', 'password2' ], 'string', 'min' => 3, 'max' => 20 ],
			[ 'email', 'email' ],
			[ 'password', 'compare', 'compareAttribute' => 'password2' ],
			[ 'verifyCode', 'captcha' ],
			[ 'username', 'unique', 'targetAttribute' => 'username' ],
			[ 'email', 'uniqueAjax', 'targetAttribute' => 'email' ],
			[ 'username', 'uniqueAjax', 'targetAttribute' => 'username' ],
		];
	}

	public function register()
	{
		$security = new Security();
		$this->auth_key = $security->generateRandomString();
		$this->password = $security->generatePasswordHash( $this->password );

		$connection = Yii::$app->db;
		$command = $connection->createCommand( 'INSERT INTO users
																(username,
																 password,
																 email,
																 auth_key)
														VALUES (:username,
																:password,
																:email,
																:auth_key)
											' );
		$command->bindValues( [ ':username' => $this->username,
			':password' => $this->password,
			':email' => $this->email,
			':auth_key' => $this->auth_key,
		] );

		$result = $command->execute();

		if ( $result && $result > 0 ) {
			if ( $user = User::findByUsername( $this->username ) ) {
				if ( Yii::$app->user->login( $user ) ) {
					return true;
				}
			}
		}

		return false;
	}

} 