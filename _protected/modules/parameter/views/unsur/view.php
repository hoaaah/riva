<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RefUnsur */
?>
<div class="ref-unsur-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kd_unsur',
            'name',
        ],
    ]) ?>

</div>
