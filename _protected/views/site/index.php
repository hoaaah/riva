<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

$this->title = Yii::t('app', Yii::$app->name);
?>
<div class="site-index">
<div class="row">
    <!-- <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">Welcome to RIVA</p>

        <p><a class="btn btn-lg btn-success" href="http://www.freetuts.org/tutorial/view?id=6">Read our tutorial</a></p>
    </div> -->
    <div class="well col-md-9 col-xs-9">
        <div class="row">
            <div class="col-md-3 col-md-offset-3">
                <?php 
                // echo Html::a('Tambah Lkada', ['create'], [
                //     'class' => 'btn btn-xs btn-success',
                //     'data-toggle'=>"modal",
                //     'data-target'=>"#myModal",
                //     'data-title'=>"Tambah",
                // ]); 
                ?>
                <a href="<?= Url::to(['detail', 'id' => 1]) ?>" data-toggle="modal" data-target="#myModal" data-title="Lingkungan Pengendalian">
                    <div class="circle <?= $unsurLevel3Check[1] > 0 ? "red" : "green"  ?>">Lingkungan Pengendalian</div>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <a href="<?= Url::to(['detail', 'id' => 5]) ?>" data-toggle="modal" data-target="#myModal" data-title="Pemantauan">
                    <div class="circle <?= $unsurLevel3Check[5] > 0 ? "red" : "green"  ?>">Pemantauan</div>
                </a>
            </div>
            <div class="col-md-3">
                <div class="circle-large <?= $skorSpip > 2 ? "green" : "blue"  ?>">SPIP Level <?= number_format($skorSpip, 0) ?></div>
            </div>
            <div class="col-md-3">
                <a href="<?= Url::to(['detail', 'id' => 2]) ?>" data-toggle="modal" data-target="#myModal" data-title="Penilaian Risiko">
                    <div class="circle <?= $unsurLevel3Check[2] > 0 ? "red" : "green"  ?>">Penilaian Risiko</div>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 col-md-offset-1">
                <a href="<?= Url::to(['detail', 'id' => 4]) ?>" data-toggle="modal" data-target="#myModal" data-title="InfoKom">
                    <div class="circle <?= $unsurLevel3Check[4] > 0 ? "red" : "green"  ?>">InfoKom</div>
                </a>
            </div>
            <div class="col-md-3 col-md-offset-1">
                <a href="<?= Url::to(['detail', 'id' => 3]) ?>" data-toggle="modal" data-target="#myModal" data-title="Kegiatan Pengendalian">
                    <div class="circle <?= $unsurLevel3Check[3] > 0 ? "red" : "green"  ?>">Kegiatan Pengendalian</div>
                </a>
            </div>
        </div>
    </div>
        <!-- <h1>CSS circles using border radius</h1>
        <div class="col-md-3 circle blue">Blue</div>
        <div class="col-md-3 circle green">Green</div>
        <div class="col-md-3 circle red">Red</div> -->

    <div class="col-md-3 col-xs-3">

        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Informasi Level Maturitas SPIP
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>Level</th>
                                    <th>Definisi</th>
                                </tr>
                                <tr>
                                    <td>0</td>
                                    <td>Belum ada infrastruktur SPIP</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Mulai menyadari pentingnya pengendalian intrn</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Mulai melaksanakan praktik pengendalian itern namun belum terdokumentasi</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Praktik pengendalian intern mulai terdokumentasi, namun belum ada kegiatan evaluasi secara berkala terhadap praktik pengendalian intern</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Pelaksanaan pengendalian intern sudah baik dan efektif, namun evaluasi formal dan pemantauan atas praktik pengendalian itern belum berbasis aplikasi</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Pelaksanaan pengendalian intern sudah baik dan efektif, kegiatan evaluasi formal dan pemantauan atas praktik pengendalian itern sudah berbasis aplikasi</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

            
    </div>

</div>
</div>

<?php
$this->registerCss(<<<CSS
/* body {
  font-family: "open sans", sans-serif;
  background: #f1f1f1;
} */
/* #content {
  margin: 40px auto;
  text-align: center;
  width: 600px;
} */
/* #content h1 {
  text-transform: uppercase;
  font-weight: 700;
  margin: 0 0 40px 0;
  font-size: 25px;
  line-height: 30px;
} */
.circle {
  width: 100px;
  height: 100px;
  line-height: 100px;
  border-radius: 50%; /* the magic */
  -moz-border-radius: 50%;
  -webkit-border-radius: 50%;
  text-align: center;
  color: white;
  font-size: 14px;
  /* text-transform: uppercase; */
  /* font-weight: 700; */
  margin: 0 auto 40px;
}

.circle-large {
  width: 150px;
  height: 150px;
  line-height: 150px;
  border-radius: 50%; /* the magic */
  -moz-border-radius: 50%;
  -webkit-border-radius: 50%;
  text-align: center;
  color: white;
  font-size: 16px;
  text-transform: uppercase;
  font-weight: 700;
  margin: 0 auto 40px;
}

.blue {
  background-color: #3498db;  
}
.green {
  background-color: #16a085;
}
.red {
  background-color: #e74c3c;
}
.feedback {
  font-size: 14px;
  color: #b1b1b1;
}
CSS
);

$this->registerJs(<<<JS

JS
);
?>
<?php Modal::begin([
    'id' => 'myModal',
    'header' => '<h4 class="modal-title">Lihat lebih...</h4>',
    'options' => [
        'tabindex' => false // important for Select2 to work properly
    ], 
    'size' => 'modal-lg'
]);
 
echo '...';
 
Modal::end();

$this->registerJs(<<<JS
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
JS
);
?>