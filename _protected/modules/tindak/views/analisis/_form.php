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

    <div class="callout callout-info">
        <h4>Analisis atas Tindak Lanjut</h4>

        <p>Berdasarkan hasil tindak lanjut yang telah dilakukan dengan rincian sebagai berikut:</p>
        <b>
        <?php 
            $tindakLanjut = $model->taRencanaTindak['taTindakLanjuts'];
            if($tindakLanjut){
                usort($tindakLanjut, function($a, $b){
                    if ($a['no_urut'] == $b['no_urut']) {
                        return 0;
                    }
                    return ($a['no_urut'] < $b['no_urut']) ? -1 : 1;
                });
                foreach ($tindakLanjut as $key => $value) {
                    echo $value->no_urut.". ".$value->uraian."</br>";
                }
            }
        ?>
        </b>

        <p>Maka dapat disimpulkan bahwa Level SPIP setelah dilakukan tindak lanjut atas rencana tindak pada Sub Unsur "<?= $model->name ?>" dapat meningkat pada level berikut.</p>
    </div>

    <div class="well">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($analisisTl, 'level_akhir')->radioList((new \app\models\TaRencanaTindak)->levelSpipArray(), [
        'item' => function ($index, $label, $name, $checked, $value) {
            return '<label class="radio-inline">' . Html::radio($name, $checked, ['value'  => $value]) . $value. " " .$label . '</label>';
        }
    ]); ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($analisisTl->isNewRecord ? 'Create' : 'Update', ['class' => $analisisTl->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
    </div>
</div>
