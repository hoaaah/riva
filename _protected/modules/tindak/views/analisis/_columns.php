<?php
use yii\helpers\Url;
use yii\helpers\Html;

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
        'width' => '30%',
        'value' => function($model){
            return $model->taRencanaTindak['rencana_tindak'];
        },
        'format' => 'html',
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
        'label' => 'TL',
        'width' => '30%',
        'value' => function($model){
            $tindakLanjuts = $model->taRencanaTindak['taTindakLanjuts'];
            $return = "";
            if($tindakLanjuts){
                foreach ($tindakLanjuts as $key => $value) {
                    $file = explode('.', $value->file_name);
                    $fileExt = end($file);
                    
                    $return .= Html::a('<i class="glyphicon glyphicon-search"></i> '.$value->file_name, ['preview', 'id' => $value->id ], [
                        'class' => $fileExt == "pdf" ? 'label label-success' : 'label label-warning',
                        'title' => $value->uraian,
                        'role'=>'modal-remote',
                        'data-toggle'=>'tooltip'
                    ]);
                    $return .= Html::a('<i class="glyphicon glyphicon-remove"></i> ', ['delete', 'id' => $value->id ], [
                        // 'class' =>  'label label-danger',
                        'title' => "Hapus Dokumen",
                        'role'=>'modal-remote',
                        'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                        'data-request-method'=>'post',
                        'data-toggle'=>'tooltip',
                        'data-confirm-title'=>'Are you sure?',
                        'data-confirm-message'=>'Anda akan menghapus dokumen ini, data yang sudah dihapus tidak dapat dikembalikan lagi.'
                    ]);
                    $return .= "</br>";
                }
            }
            return $return;
        },
        'format' => 'raw',
    ],
    [
        'label' => 'Hasil Analisis',
        'value' => function($model){
            $analisis = $model->taRencanaTindak['taAnalisisTls'];
            $return = "";
            if($analisis){
                foreach ($analisis as $key => $value) {
                    $return .= $value->level_akhir;
                }
            }
            return $return;
        },
        'format' => 'decimal',
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
        'updateOptions'=>['role'=>'modal-remote','title'=>'Tambah TL', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   