<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 02.12.14
 * Time: 12:05
 */

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class Image extends ActiveRecord
{
	/**
	 * @var UploadedFile|Null file attribute
	 */
	public $image;

	/**
	 * @return string table name in database
	 */
	public static function tableName()
	{
		return 'images';
	}

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
			['image', 'image', 'extensions' => 'jpg, jpeg, png', 'mimeTypes' => 'image/jpeg, image/png', 'maxFiles' => 1000],
			['image', 'required', 'message' => 'Необходимо выбрать изображения для загрузки'],
		];
	}

	public function attributeLabels()
	{
		return [
			'image' => 'Изображение',
		];
	}

	public function save()
	{
		foreach ($this->image as $image) {
			if ($image instanceof UploadedFile) {
				$saved = $image->saveAs(Yii::$app->params['imagesUploadPath'] . $image->tempName . '.' . $image->extension);

				$connection = Yii::$app->db;

				$result = $connection
					->createCommand()
					->insert($this->tableName(), [
						'name' => $image->name,
						'system_name' => $image->tempName,
						'type' => $image->type,
						'size' => $image->size,
					])
					->execute();
				if (!$result || !$saved) $this->addError('image', 'Ошибка');
			}
		}
	}
}