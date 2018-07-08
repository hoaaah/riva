<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\widgets\MaskedInput;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\widgets\DatePicker;
use kartik\widgets\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $rencanaTindak app\rencanaTindaks\RefSubUnsur */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-sub-unsur-form">
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'kd_unsur',
            'kd_sub_unsur',
            'name',
            [
                'label' => 'Level Tindak Lanjut',
                'value' => function($model){
                    return $model->taRencanaTindak['levelAwalSpip']." > ".$model->taRencanaTindak['levelTargetSpip'];
                },
                // 'format' => 'decimal',
            ],
            [
                'label' => 'Rencana Tindak',
                'value' => function($model){
                    return $model->taRencanaTindak['rencana_tindak'];
                },
                'format' => 'ntext',
            ],
        ],
    ]) ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($tindakLanjut, 'no_urut')->textInput() ?>

    <?= $form->field($tindakLanjut, 'uraian')->textInput(['maxlength' => true]) ?>

    <?= $form->field($tindakLanjut, 'image')->widget(FileInput::classname(), [
        // 'options'=>['accept'=>'image/*'],
        'pluginOptions'=>[
            'maxFileCount' => 1,
            'allowedFileExtensions' => ['jpg','gif','png', 'pdf', 'docx', 'doc', 'mp4', 'avi', 'xlsx', 'xls', 'ppt', 'pptx'],
            'showPreview' => true,
            'showCaption' => true,
            'showRemove' => true,
            'showUpload' => false,
            // this line for image preview
            'initialPreview'=>[
                $tindakLanjut->file_name ? $tindakLanjut->getFileUrl() : null,
            ],
            'initialPreviewAsData'=>true,
            'initialCaption'=> $tindakLanjut->file_name ? $tindakLanjut->file_name : null,
            'initialPreviewConfig' => [
                $tindakLanjut->file_name ? [
                    'caption' => $tindakLanjut->file_name, 
                    'size' => filesize($tindakLanjut->getFile()), 
                    'url' => Url::to(['delete-image', 'id' => $tindakLanjut->id, 'file' => $tindakLanjut->file_name])
                ] : null,
            ],
            'overwriteInitial'=> false,
    ]])->label('File') ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($tindakLanjut->isNewRecord ? 'Create' : 'Update', ['class' => $tindakLanjut->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
