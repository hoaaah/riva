<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\TaProgram;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\controlhutang\models\TaRASKArsipSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
]); ?>
<div class="col-md-12">
<div class="panel panel-primary">
    <div class="panel-body">
        <div class="row col-md-12">
            <div class="col-md-3">
                <?php

                    // $model->kd_laporan = isset(Yii::$app->request->queryParams['Laporan']['kd_laporan']) ? Yii::$app->request->queryParams['Laporan']['kd_laporan'] : '';
                    echo $form->field($model, 'kd_laporan')->widget(Select2::classname(), [
                        'data' => $model->klasifikasiLaporan,
                        'options' => ['class' =>'form-control input-sm' ,'placeholder' => 'Pilih Jenis Laporan ...',
                        ],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label(false);
                ?>
            </div>

            <div class="col-md-3">
                <?php
                    echo $form->field($model, 'kd_unsur')->widget(Select2::classname(), [
                        'data' => $model->klasifikasiUnsur,
                        'options' => ['class' =>'form-control input-sm' ,'placeholder' => 'Pilih Unsur ...',
                        ],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label(false);
                ?>
            </div>

        </div>
        <div class="row col-md-12">   
            <div class="col-md-3">
        
            </div>    
            <div class="col-md-2 pull-right">
                <?= Html::submitButton( 'Pilih', ['class' => 'btn btn-default']) ?>        
            </div>
        </div>
    </div> <!--panel-body-->
</div> <!--panel-->
</div> <!--col-->

<?php ActiveForm::end(); ?>
