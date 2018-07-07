<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "ta_th".
 *
 * @property string $tahun
 * @property string $nama_pemda
 * @property string $image_name
 * @property string $saved_image
 */
class TaTh extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ta_th';
    }

    public $image;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tahun'], 'required'],
            [['tahun'], 'safe'],
            [['nama_pemda'], 'string', 'max' => 50],
            [['image_name', 'saved_image'], 'string', 'max' => 255],
            [['image'], 'file', 'maxSize' => 2104000, /*'maxFiles' => 10,*/ 'extensions'=>'jpg, jpeg, gif, png'],
            [['tahun'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tahun' => 'Tahun',
            'nama_pemda' => 'Nama Pemda',
            'image_name' => 'Image Name',
            'saved_image' => 'Saved Image',
            'image' => 'Logo Pemda',
        ];
    }


    private function checkFolder($directoryName){
        if(!is_dir($directoryName)){
            //Directory does not exist, so lets create it.
            mkdir($directoryName, 0755, true);
        }
    }

    private function checkFile($filePath){
        return file_exists($filePath);
    }    

    public function getImage(){
        // check folder first
        $this->checkFolder(Yii::getAlias('@uploads').'/userFile');
        $this->checkFolder(Yii::getAlias('@uploads').'/userFile');
        // getImage
        if(isset($this->image_name)){
            $filePath = Yii::getAlias('@uploads').'/userFile/'.$this->saved_image;
            return $filePath;
        }
        return null;
    }

    public function getImageUrl(){
        return Yii::getAlias('@uploadsUrl').'/userFile/'.$this['saved_image'];
    }

    public function uploadImage(){
        // get the uploaded file instance. for multiple file uploads
        // the following data will return an array (you may need to use
        // getInstances method)
        $image = UploadedFile::getInstance($this, 'image');

        // if no image was uploaded abort the upload
        if (empty($image)) {
            return false;
        }

        // store the source file name
        $this->image_name = $image->name;
        $imageName = (explode(".", $image->name));
        $ext = end($imageName);

        // generate a unique file name
        $this->saved_image = Yii::$app->security->generateRandomString().".{$ext}";

        // the uploaded image instance
        return $image;
    }

    public function deleteImage() {
        $file = $this->getImage();

        // check if file exists on server
        if (empty($file) || !file_exists($file)) {
            return false;
        }

        // check if uploaded file can be deleted on server
        if (!unlink($file)) {
            return false;
        }

        // if deletion successful, reset your file attributes
        $this->image_name = null;
        $this->saved_image = null;

        $this->save();

        return true;
    }            
}
