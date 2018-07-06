<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TaTh */
?>
<div class="ta-th-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tahun',
            'nama_pemda',
            'image_name',
            'saved_image',
        ],
    ]) ?>

</div>
