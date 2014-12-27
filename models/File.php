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
	public $image;
	private $filePath = '/Volumes/Warehouse/WebWarehouse/Sharing';

	/**
	 * @return string table name in database
	 */
	public static function tableName()
	{
		return 'files';
	}

	public function getSharedFiles()
	{
		$files = [];

		$files = scandir($this->filePath);

		foreach ($files as $i => $file) {
			if (preg_match('/^\./', $file) || !strlen($file)) {
				unset($files[$i]);
			}
		}

		return $files;
	}
	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
			[ 'file', 'image', 'extensions' => 'png, jpg, jpeg', 'on' => 'image'],
		];
	}

	public function attributeLabels()
	{
		return [
			'image' => 'Изображение',
		];
	}

	public function findByID( $id )
	{
		return parent::find( [ 'id' => $id ] );
	}

	public function findByTempName( $tmpName )
	{
		return parent::find( [ 'tmp_name' => $tmpName ] )->asArray();
	}

	/**
	 * @param $path string размещение сохраненного изображения
	 *
	 * @return bool|int идентификатор сохраненного изображения или false - в случаи ошибки
	 */
	public function saveImageInfo( $path )
	{
		if ( $this->image instanceof UploadedFile ) {
			$connection = Yii::$app->db;

			$result = $connection
				->createCommand()
				->insert( $this->tableName(), [
					'src' => $path,
					'name' => $this->image->baseName,
					'tmp_name' => $this->image->tmpName,
					'type' => $this->image->type,
					'size' => $this->image->size,
				] )
				->execute();
			if ( $result ) {
				return intval( $connection->getLastInsertID() );
			} else {
				return false;
			}
		} else {
			throw new UnknownPropertyException( $this->image );
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