<?php

namespace app\models;

use \yii\db\ActiveRecord;
use \yii\web\IdentityInterface;
use \yii\helpers\Security;
use \Yii;

class User extends ActiveRecord implements IdentityInterface
{

	public static function tableName() {
		return 'users';
	}
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

	public static function findAsArray($id) {
		return static::find(['id' => $id])->one()->toArray();
	}
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findIdentityByAccessToken(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param  string  $login
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
			if ($this->isNewRecord) {
				$this->auth_key = Security::generateRandomKey();
				$this->password = Security::generatePasswordHash($this->password);
			}
			return true;
		}
		return false;
	}

	public static function getUsersList()
	{
		return static::find()->all();
	}
}
