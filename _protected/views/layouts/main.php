<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\models\User;

$kdUser = Yii::$app->user->identity->kd_user ?? null;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php $taTh = \app\models\TaTh::find()->where('(SELECT MAX(tahun) FROM ta_th)')->one(); ?>

<div class="wrap">
    <?php
    // echo '<a href="#" class="">'.\yii\helpers\Html::img($taTh->getImageUrl(), ['alt' => 'Brand', 'class' => 'img-rounded', 'height' => '30px']).'</a>';
    NavBar::begin([
        'brandLabel' => isset($taTh) ? $taTh->nama_pemda : Yii::t('app', Yii::$app->name),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);

    // everyone can see Home page
    $menuItems[] = ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']];

    if(!Yii::$app->user->isGuest){
        $menuItems[] = ['label' => 'Parameter', 'items' => [
            ['label' => "Data Umum", 'url' => ['/parameter/pemda']],
            ['label' => "Bobot Sub Unsur", 'url' => ['/parameter/bobot']],
        ], 'visible' => $kdUser == USER::KD_USER_ADMINISTRATOR ];
        $menuItems[] = ['label' => 'Tindakan', 'items' => [
            ['label' => "Rencan Tindak", 'url' => ['/tindak/rencana'], 'visible' => $kdUser <= USER::KD_USER_BPKP],
            ['label' => "Tindak Lanjut", 'url' => ['/tindak/tl'], 'visible' => $kdUser <= USER::KD_USER_INSPEKTORAT],
            ['label' => "Analisis TL", 'url' => ['/tindak/analisis'], 'visible' => $kdUser <= USER::KD_USER_BPKP],
        ]];
        $menuItems[] = ['label' => 'Laporan', 'url' => ['/tindak/laporan'], 'visible' => $kdUser <= USER::KD_USER_INSPEKTORAT];
    }

    // we do not need to display About and Contact pages to employee+ roles
    // if (!Yii::$app->user->can('employee')) {
    //     $menuItems[] = ['label' => Yii::t('app', 'About'), 'url' => ['/site/about']];
    //     $menuItems[] = ['label' => Yii::t('app', 'Contact'), 'url' => ['/site/contact']];
    // }

    // display Users to admin+ roles
    if (Yii::$app->user->can('admin')){
        $menuItems[] = ['label' => Yii::t('app', 'Users'), 'url' => ['/user/index']];
    }
    
    // display Logout to logged in users
    if (!Yii::$app->user->isGuest) {
        $menuItems[] = [
            'label' => Yii::t('app', 'Logout'). ' (' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
    }

    // display Signup and Login pages to guests of the site
    if (Yii::$app->user->isGuest) {
        // $menuItems[] = ['label' => Yii::t('app', 'Signup'), 'url' => ['/site/signup']];
        $menuItems[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);

    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::t('app', Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="pull-right">Dikembangkan oleh Tim APD BPKP Pwk. Banda Aceh</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
