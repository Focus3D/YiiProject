<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 02.12.14
 * Time: 12:05
 */

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
	/**
	 * @var UploadedFile|Null file attribute
	 */
	public $file;

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
			[ [ 'file' ],
				'file',
				'extensions' => 'gif, jpg',
				'mimeTypes' => 'image/jpeg, image/png',
				'skipOnEmpty' => false,
				'maxFiles' => 100,
			],
		];
	}

	public function attributeLabels()
	{
		return [
			'file' => 'Загрузка файлов',
		];
	}

} 