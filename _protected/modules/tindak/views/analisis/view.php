<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RefSubUnsur */
?>
<div class="ref-sub-unsur-view">
 
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

</div>
