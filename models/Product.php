<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 02.12.14
 * Time: 18:12
 */

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use app\models\File;

class Product extends ActiveRecord
{
	public $id;
	public $name;
	public $cost;
	public $files;
	public $quantity;

	public static function tableName()
	{
		return 'goods';
	}

	/**
	 * @return integer count goods in DB
	 */
	public static function getCount()
	{
		return parent::find()->count();
	}

	public function attributeLabels()
	{
		return [
			'name' => 'Название товара',
			'cost' => 'Стоимость',
			'quantity' => 'Количество',
			'files' => 'Фото',
		];
	}

	public function rules()
	{
		return [
			[['name', 'cost', 'quantity'], 'required'],
			['name', 'unique', 'targetAttribute' => 'name'],
			['quantity', 'integer'],
			['cost', 'integer'],
			['id', 'safe'],
			['files', 'image'],
		];
	}

	public function saveItem()
	{
		$connection = Yii::$app->db;

		$result = $connection->
			createCommand()->
			insert(
				$this->tableName(),
				['name' => $this->name,
					'cost' => $this->cost,
					'quantity' => $this->quantity,
					'photo_id' => $imageID,
				]
			)->execute();

		if ($result) {
			return true;
		} else {
			return false;
		}
	}
} 