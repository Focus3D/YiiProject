<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 11.01.15
 * Time: 15:38
 */
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * UploadForm is the model behind the upload form.
 */
class UploadForm extends ActiveRecord
{
	/**
	 * @var UploadedFile file attribute
	 */
	public $files;

	/**
	 * @return string table name in database
	 */
	public static function tableName()
	{
		return 'files';
	}
	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
			[
				'files',
				'file',
				'maxFiles' => 100,
				'message' => 'Максимальное количество файлов для одновременной загрузки 100',
			],
			[
				'files',
				'required',
				'message' => 'Необходимо выбрать файл/ы для загрузки'
			],
		];
	}

	public function attributeLabels()
	{
		return [
			'files' => 'Загрузка файлов',
		];
	}

	/**
	 * Сохраняет фойлы в файловой системе и записи о них в базе данных
	 */
	public function saveFiles()
	{
		foreach ($this->files as $file) {
			if ($file instanceof UploadedFile) {
				$saved = $file->saveAs(Yii::$app->params['filePath'] . basename($file->tempName) . '.' . $file->extension);

				$connection = Yii::$app->db;

				$result = $connection
					->createCommand()
					->insert($this->tableName(), [
						'original_name' => $file->name,
						'name' => basename($file->tempName),
						'type' => $file->type,
						'size' => $file->size,
					])
					->execute();
				if (!$result || !$saved) $this->addError('files', 'Ошибка');
			}
		}
	}
}