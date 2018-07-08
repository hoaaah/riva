<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\widgets\MaskedInput;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\widgets\DatePicker;

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
        ],
    ]) ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($rencanaTindak, 'level_awal')->radioList($rencanaTindak->levelSpipArray(), [
        'item' => function ($index, $label, $name, $checked, $value) {
            return '<label class="radio-inline">' . Html::radio($name, $checked, ['value'  => $value]) . $value. " " .$label . '</label>';
        }
    ]); ?>

    
    <?= $form->field($rencanaTindak, 'level_target')->radioList($rencanaTindak->levelSpipArray(), [
        'item' => function ($index, $label, $name, $checked, $value) {
            return '<label class="radio-inline">' . Html::radio($name, $checked, ['value'  => $value]) . $value. " " .$label . '</label>';
        }
    ]); ?>

    <?= $form->field($rencanaTindak, 'rencana_tindak')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($rencanaTindak, 'output')->textInput() ?>

    <?= $form->field($rencanaTindak, 'penanggung_jawab')->textInput() ?>

    <?= DatePicker::widget([
        'model' => $rencanaTindak,
        'attribute' => 'batas_waktu_tl',
        // 'size' => 'sm',
        'removeButton' => false,
        'options' => ['placeholder' => 'Batas Waktu TL'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-m-d',
        ]
    ]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($rencanaTindak->isNewRecord ? 'Create' : 'Update', ['class' => $rencanaTindak->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
