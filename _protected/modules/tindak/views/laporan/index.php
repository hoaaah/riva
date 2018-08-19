<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\controlhutang\models\RekananSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pelaporan';
$this->params['breadcrumbs'][] = 'Pelaporan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
<?php echo $this->render('_search', ['model' => $get, 'tahun' => $tahun]); ?>
</div>
<?php 
IF($get->kd_laporan){
	$heading = $get->klasifikasiLaporan[$get->kd_laporan];
	echo $this->render($render, [
		'data' => $data, 
		'data1' => $data1,
		'data2' => $data2,
		'data3' => $data3,
		'data4' => $data4,
		'data5' => $data5,
		'data6' => $data6,
		'heading' => $heading, 
		'get' => $get,
		'totalPemda' => $totalPemda]);
} ?>
