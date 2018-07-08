<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\web\UploadedFile;

/**
 * This is the model class for table "ta_tindak_lanjut".
 *
 * @property int $id
 * @property string $tahun
 * @property int $rencana_tindak_id
 * @property int $no_urut
 * @property string $file_name
 * @property string $saved_file
 * @property string $uraian
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property TaRencanaTindak $rencanaTindak
 */
class TaTindakLanjut extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ta_tindak_lanjut';
    }

    public $image;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tahun', 'rencana_tindak_id', 'no_urut'], 'required'],
            [['tahun'], 'safe'],
            [['rencana_tindak_id', 'no_urut', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['file_name', 'saved_file', 'uraian'], 'string', 'max' => 255],
            [['rencana_tindak_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaRencanaTindak::className(), 'targetAttribute' => ['rencana_tindak_id' => 'id']],
            [['image'], 'file', 'maxSize' => 5104000, /*'maxFiles' => 10,*/ 'extensions'=>'jpg, jpeg, gif, png, pdf, docx, doc, mp4, avi, xlsx, xls, pptx, ppt'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tahun' => 'Tahun',
            'rencana_tindak_id' => 'Rencana Tindak ID',
            'no_urut' => 'No Urut',
            'file_name' => 'File Name',
            'saved_file' => 'Saved File',
            'uraian' => 'Uraian',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'image' => 'File',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),
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

    public function getFile(){
        // check folder first
        $this->checkFolder(Yii::getAlias('@uploads').'/userFile');
        $this->checkFolder(Yii::getAlias('@uploads').'/userFile');
        // getFile
        if(isset($this->file_name)){
            $filePath = Yii::getAlias('@uploads').'/userFile/'.$this->saved_file;
            return $filePath;
        }
        return null;
    }

    public function getFileUrl(){
        return Yii::getAlias('@uploadsUrl').'/userFile/'.$this['saved_file'];
    }

    public function uploadFile(){
        // get the uploaded file instance. for multiple file uploads
        // the following data will return an array (you may need to use
        // getInstances method)
        $image = UploadedFile::getInstance($this, 'image');

        // if no image was uploaded abort the upload
        if (empty($image)) {
            return false;
        }

        // store the source file name
        $this->file_name = $image->name;
        $imageName = (explode(".", $image->name));
        $ext = end($imageName);

        // generate a unique file name
        $this->saved_file = Yii::$app->security->generateRandomString().".{$ext}";

        // the uploaded image instance
        return $image;
    }

    public function deleteFile() {
        $file = $this->getFile();

        // check if file exists on server
        if (empty($file) || !file_exists($file)) {
            return false;
        }

        // check if uploaded file can be deleted on server
        if (!unlink($file)) {
            return false;
        }

        // if deletion successful, reset your file attributes
        $this->file_name = null;
        $this->saved_file = null;

        $this->save();

        return true;
    }      

    public function getRencanaTindak()
    {
        return $this->hasOne(TaRencanaTindak::className(), ['id' => 'rencana_tindak_id']);
    }
}
