<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\Modal;

echo GridView::widget([
	'dataProvider' => $data,
	'responsive'=>true,
	'hover'=>true,
	'resizableColumns'=>true,
	'panel'=>['type'=>'primary', 'heading'=>$heading],
	'responsiveWrap' => false,
	'toolbar' => [
            // '{toggleData}',
            '{export}',
            // [
            //     'content' =>
            //     Html::a('<i class="glyphicon glyphicon-print"></i> Cetak', ['cetak', 'Laporan' => [
            //                         'Kd_Laporan' => $getparam['Laporan']['Kd_Laporan'],
            //                         'elimination_level' => $getparam['Laporan']['elimination_level'],
            //                         'kd_wilayah' => $getparam['Laporan']['kd_wilayah'],
            //                         'kd_provinsi' => $getparam['Laporan']['kd_provinsi'],
            //                         'kd_pemda' => $getparam['Laporan']['kd_pemda'],
            //                         'periode_id' => $getparam['Laporan']['periode_id']
            //                     ] ], [
            //                         'class' => 'btn btn btn-default pull-right',
            //                         'onClick' => "return !window.open(this.href, 'SPH', 'width=1024,height=600,scrollbars=1')"
            //                             ])
            // ],
    ],
    'exportConfig' => [
        GridView::HTML => ['filename' => $heading,],
        GridView::CSV => ['filename' => $heading,],
        GridView::TEXT => ['filename' => $heading,],
        GridView::EXCEL => ['filename' => $heading,],
        GridView::PDF => [
            'label' => 'PDF',
            'showHeader' => true,
            // 'showPageSummary' => true,
            'showFooter' => true,
            'showCaption' => true,
            'filename' => $heading,
            'alertMsg' => 'The PDF export file will be generated for download.',
            'options' => ['title' => 'Portable Document Format'],
            'mime' => 'application/pdf',
            'config' => [
                'mode' => 'c',
                'format' => 'A4-L',
                'destination' => 'D',
                'marginTop' => 20,
                'marginBottom' => 20,
                'cssInline' => '.kv-wrap{padding:20px;}' .
                    '.kv-align-center{text-align:center;}' .
                    '.kv-align-left{text-align:left;}' .
                    '.kv-align-right{text-align:right;}' .
                    '.kv-align-top{vertical-align:top!important;}' .
                    '.kv-align-bottom{vertical-align:bottom!important;}' .
                    '.kv-align-middle{vertical-align:middle!important;}' .
                    '.kv-page-summary{border-top:4px double #ddd;font-weight: bold;}' .
                    '.kv-table-footer{border-top:4px double #ddd;font-weight: bold;}' .
                    '.kv-table-caption{font-size:1.5em;padding:8px;border:1px solid #ddd;border-bottom:none;}',
                'methods' => [
                    'SetHeader' => $heading,
                    'SetFooter' => "Generated by ".Yii::$app->name,//'<li role="presentation" class="dropdown-footer">Generated by '.Yii::$app->name.', '.date('Y-m-d H-i-s T').'</li>',
                ],
                'options' => [
                    'title' => $heading,
                    'subject' => 'PDF export generated by '.Yii::$app->name,
                    'keywords' => 'grid, export, yii2-grid, pdf'
                ],
                'contentBefore'=>'',
                'contentAfter'=>''
            ]
        ],
        GridView::JSON => ['filename' => $heading,],
    ],
	'pager' => [
	    'firstPageLabel' => 'Awal',
	    'lastPageLabel'  => 'Akhir'
	],
	'pjax'=>true,
	'pjaxSettings'=>[
	    'options' => ['id' => 'laporan1-pjax', 'timeout' => 5000],
	],
	'showPageSummary'=>true,
	'columns' => [
        'fokus',
        [
            'attribute' => 'bobot',
            'visible' => $get->kd_unsur ? true : false
        ],
        [
            'attribute' => 'level',
            'visible' => $get->kd_unsur ? true : false
        ],
        [
            'attribute' => 'skor',
            'format' => ['decimal', 4],
            'hAlign' => 'right',
            'pageSummary' => true,
        ],
	],
]);
 ?>
 <?php
 Modal::begin([
    'id' => 'myModal',
    'header' => '<h4 class="modal-title">Lihat lebih...</h4>',
    'options' => [
        'tabindex' => false // important for Select2 to work properly
    ],
    'size' => 'modal-lg'
]);

echo '...';

Modal::end();
$this->registerJs("
    $('#myModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var modal = $(this)
        var title = button.data('title')
        var href = button.attr('href')
        modal.find('.modal-title').html(title)
        modal.find('.modal-body').html('<i class=\"fa fa-spinner fa-spin\"></i>')
        $.post(href)
            .done(function( data ) {
                modal.find('.modal-body').html(data)
            });
        })
");
$this->registerCss(<<<CSS
    a.akunDetail{
        color:inherit;
    }
CSS
);
$this->registerJs(<<<JS
function number_format (number, decimals, decPoint, thousandsSep) {
    //  discuss at: http://locutus.io/php/number_format/
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
    var n = !isFinite(+number) ? 0 : +number
    var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
    var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
    var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
    var s = ''

    var toFixedFix = function (n, prec) {
        var k = Math.pow(10, prec)
        return '' + (Math.round(n * k) / k)
        .toFixed(prec)
    }

    // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || ''
        s[1] += new Array(prec - s[1].length + 1).join('0')
    }

    return s.join(dec)
}

$('.summary-rek2').each(function (event) {
    $(this).html(number_format($(this).html(), 0, ',', '.'));
})
JS
);
?>
