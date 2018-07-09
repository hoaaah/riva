<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\TaTh */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-th-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tahun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_pemda')->textInput(['maxlength' => true]) ?>

    <?php $form->field($model, 'image')->widget(FileInput::classname(), [
        'options'=>['accept'=>'image/*'],
        'pluginOptions'=>[
            'maxFileCount' => 1,
            'allowedFileExtensions' => ['jpg','gif','png'],
            'showPreview' => true,
            'showCaption' => true,
            'showRemove' => true,
            'showUpload' => false,
            // this line for image preview
            'initialPreview'=>[
                $model->image_name ? $model->getImageUrl() : null,
            ],
            'initialPreviewAsData'=>true,
            'initialCaption'=> $model->image_name ? $model->image_name : null,
            'initialPreviewConfig' => [
                $model->image_name ? [
                    'caption' => $model->image_name, 
                    'size' => filesize($model->getImage()), 
                    'url' => Url::to(['delete-image', 'id' => $model->tahun, 'file' => $model->image_name])
                ] : null,
            ],
            'overwriteInitial'=> false,
    ]])->label('Logo Image') ?>
    
    <?php  echo $form->field($model, 'image')->widget(\bilginnet\cropper\Cropper::className(), [
        'cropperOptions' => [
            'width' => 100, // must be specified
            'height' => 100, // must be specified
        ]
    ]); ?>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
