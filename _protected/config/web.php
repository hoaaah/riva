<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'riva',
    'name' => 'emat',
    'language' => 'en',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'app\components\Aliases'],
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to  
            // use your own export download action or custom translation 
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ],
        'parameter' => [
            'class' => 'app\modules\parameter\Parameter',
        ],
        'tindak' => [
            'class' => 'app\modules\tindak\Module',
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'zEA4J6zeyVJDBvtFWnzatF2jVQVuLYO1',
        ],
        // you can set your theme here - template comes with: 'light' and 'dark'
        'view' => [
            'theme' => [
                'pathMap' => ['@app/views' => '@webroot/themes/light/views'],
                'baseUrl' => '@web/themes/light',
            ],
            // theme for admin LTE
            // 'theme' => [
            //     'pathMap' => ['@app/views' => '@webroot/themes/adm/views'],
            //     'baseUrl' => '@web/themes/adm',
            // ],  
        ],
        'assetManager' => [
            'bundles' => [
                // we will use bootstrap css from our theme
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [], // do not use yii default one
                ],
            ],
        ],
        
        // 'assetManager' => [
        //     'bundles' => [
        //         // we will use bootstrap css from our theme
        //         // 'yii\bootstrap\BootstrapAsset' => [
        //         //     'css' => [], // do not use yii default one
        //         // ],
        //         /* Part ini adalah untuk mengganti skin admin-LTE. Ganti sesuai yang tersedia @hoaaah
        //         "skin-blue",
        //         "skin-black",
        //         "skin-red",
        //         "skin-yellow",
        //         "skin-purple",
        //         "skin-green",
        //         "skin-blue-light",
        //         "skin-black-light",
        //         "skin-red-light",
        //         "skin-yellow-light",
        //         "skin-purple-light",
        //         "skin-green-light"
        //         */
        //         'dmstr\web\AdminLteAsset' => ['skin' => 'skin-purple',],                
        //     ],
        // ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                // '<alias:\w+>' => 'site/<alias>',
            ],
        ],
        'user' => [
            'identityClass' => 'app\models\UserIdentity',
            'enableAutoLogin' => true,
        ],
        'session' => [
            'class' => 'yii\web\Session',
            'savePath' => '@app/runtime/session'
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'cache' => 'cache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. 
            // You have to set 'useFileTransport' to false and configure a transport for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/translations',
                    'sourceLanguage' => 'en',
                ],
                'yii' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/translations',
                    'sourceLanguage' => 'en'
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'as beforeRequest' => [
        'class' => 'yii\filters\AccessControl',
        'rules' => [
            [
                'allow' => true,
                'actions' => ['login', 'qr', 'index', 'detail'],
            ],
            [
                'allow' => true,
                'roles' => ['@'],
            ],
        ],
        'denyCallback' => function () {
            return Yii::$app->response->redirect(['site/login']);
        },
    ], 
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = ['class' => 'yii\debug\Module'];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = ['class' => 'yii\gii\Module'];
}

return $config;
