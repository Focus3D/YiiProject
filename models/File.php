<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 02.12.14
 * Time: 12:05
 */

namespace app\models;

use Yii;
use yii\base\UnknownPropertyException;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class File extends ActiveRecord
{
	/**
	 * @var UploadedFile|Null file attribute
	 */
	public $file;

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
			['file', 'file', 'skipOnEmpty' => false],
		];
	}

	public function attributeLabels()
	{
		return [
			'file' => 'Файл',
		];
	}

	public function getFiles()
	{
		return $this->find()->asArray()->limit(10)->all();
	}

	public function findByID($id)
	{
		return $this->find(['id' => $id])->asArray()->one();
	}

	public function findByTempName($tmpName)
	{
		return parent::find(['tmp_name' => $tmpName])->asArray();
	}

	/**
	 * @param $path string размещение сохраненного изображения
	 *
	 * @return bool|int идентификатор сохраненного изображения или false - в случаи ошибки
	 */
	public function saveFileInfo()
	{
		if ($this->file instanceof UploadedFile) {
			$connection = Yii::$app->db;

			$result = $connection
				->createCommand()
				->insert($this->tableName(), [
					'name' => $this->file->name,
					'tmp_name' => $this->file->tempName,
					'type' => $this->file->type,
					'size' => $this->file->size,
				])
				->execute();
			if ($result) {
				return intval($connection->getLastInsertID());
			} else {
				return false;
			}
		} else {
			throw new UnknownPropertyException($this->file);
		}
	}

	/*public function saveImages()
	{
		$images = UploadedFile::getInstances( $this, 'image' );
		$path = Yii::$app->params[ 'uploadFolder' ] . $this->image->baseName . '.' . $this->image->extension;

		foreach ( $images as $image ) {

			$_model = new Image();

			$_model->image = $image;

			if ( $_model->validate() && $_model->image->saveAs( $path ) ) {

				Yii::$app->session->setFlash( 'image[]', 'Изображение успешно сохранено' );
			} else {
				foreach ( $_model->getErrors( 'image' ) as $error ) {
					$this->addError( 'image[]', $error );
				}
			}
		}

		if ( $this->hasErrors( 'image' ) ) {
			$this->addError( 'image', count( $this->getErrors( 'image' ) ) . ' of ' . count( $images ) . ' files not uploaded');
			Yii::$app->session->setFlash( 'image', count( $this->getErrors( 'image' ) ) . ' из ' . count( $images ) . ' изображений не загружено' );
		}
	}*/
}