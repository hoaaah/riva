<?php
use yii\helpers\Url;

return [
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'kdUnsur.name',
        'width' => '10%',
        'group' => true,
        'groupedRow' => true,
        'groupOddCssClass'=>'kv-grouped-row',  // configure odd group cell css class
        'groupEvenCssClass'=>'kv-grouped-row', // configure even group cell css class
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'kd_sub_unsur',
        'width' => '5%',
        'value' => function($model){
            return $model->kd_unsur.".".substr("0".$model->kd_sub_unsur, -2);
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'name',
    ],
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
    [
        'label' => 'Output',
        'value' => function($model){
            return $model->taRencanaTindak['output'];
        },
        // 'format' => 'decimal',
    ],
    [
        'label' => 'Penanggung Jawab',
        'value' => function($model){
            return $model->taRencanaTindak['penanggung_jawab'];
        },
        // 'format' => 'decimal',
    ],
    [
        'label' => 'Deadline',
        'value' => function($model){
            return $model->taRencanaTindak['batas_waktu_tl'];
        },
        'format' => 'date',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'template' => '{update}',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   