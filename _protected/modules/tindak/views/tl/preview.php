<?php

use yii\widgets\DetailView;
use yii\helpers\Html;

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
            [
                'label' => 'Tindak Lanjut',
                'value' => function($model) use($tindakLanjut){
                    return $tindakLanjut->uraian;
                }
            ]
        ],
    ]) ?>

    <?php



        $file = explode('.', $tindakLanjut->file_name);
        $fileExt = end($file);

        if($fileExt == 'pdf'){    
            echo \lesha724\documentviewer\ViewerJsDocumentViewer::widget([
                'url' => $tindakLanjut->getFileUrl(),
                'width'=>'100%',
                'height'=> "800px"//'100%',
            ]);
        }

        elseif(
            $fileExt= 'xls'||
            $fileExt= 'xlsx' ||
            $fileExt= 'doc'||
            $fileExt= 'docx' ||
            $fileExt= 'ppt'||
            $fileExt= 'pptx'
        )
        
        {
            echo  \lesha724\documentviewer\MicrosoftDocumentViewer::widget([
                'url'=> $tindakLanjut->getFileUrl(),
                'width'=>'100%',
                'height'=> "800px"//'100%',
            ]);

            // echo \lesha724\documentviewer\GoogleDocumentViewer::widget([
            //     'url' => $tindakLanjut->getFileUrl(),
            //     'width'=>'100%',
            //     'height'=> "800px",//'100%',
            //     'embedded'=>true,
            //     'a'=>\lesha724\documentviewer\GoogleDocumentViewer::A_BI //A_V = 'v', A_GT= 'gt', A_BI = 'bi'
            // ]);

            // echo \lesha724\documentviewer\ViewerJsDocumentViewer::widget([
            //     'url' => $tindakLanjut->getFileUrl(),
            //     'width'=>'100%',
            //     'height'=> "800px"//'100%',
            // ]);
        }

        echo Html::img($tindakLanjut->getFileUrl(), ['class' => 'img-thumbnail']);

        echo Html::a('<i class="glyphicon glyphicon-download-alt"></i> Download', $tindakLanjut->getFileUrl(), ['class' => 'btn btn-lg btn-danger pull-right']);
    ?>

</div>
