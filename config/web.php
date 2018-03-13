<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name'=>'TIOGRUP',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'authManager' => [
              'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
              'defaultRoles'    => ['users']
          ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '1T3GhTLwIn6N4Qw41lq7vEkCB8joLiZH',
            'baseUrl'=>'',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'en',
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
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
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
              '/' =>'site/index',
              '/login'=>'/user/security/login',
              '/site/logout'=>'/user/security/logout',
              '/signup'=>'/site/signup',
              '/request-password-reset'=>'/site/request-password-reset',
              '/reset-password'=>'site/reset-password',
              '/admin/pmassage'=>'admin/default/pmassage',
              '/admin/cmassage'=>'admin/default/cmassage',
              '/admin/wmassage'=>'/admin/default/wmassage',
              '/agency/profile'=>'agency/default/profile',
              '/agency/update'=>'agency/default/update',
              '/agency/change-password'=>'agency/default/change-password',
              '/employer/profile'=>'employer/default/profile',
              '/employer/update'=>'employer/default/update',
              '/employer/change-password'=>'employer/default/change-password',
              '/workers/profile'=>'workers/default/profile',
              '/workers/update'=>'workers/default/update',
              '/workers/change-password'=>'workers/default/change-password',
            ],
        ],

    ],
    'modules' => [

        'admin' => [
            'class' => 'app\modules\admin\Module',
          ],
        'agency' => [
              'class' => 'app\modules\agency\Module',
            ],
        'employer' => [
            'class' => 'app\modules\employer\Module',
          ],
        'workers' => [
            'class' => 'app\modules\workers\Module',
          ],
        'user' => [
            'class' => 'dektrium\user\Module',
            //'layout' => 'left-menu',
            'layout' => '@app/views/layouts/admin.php',
          //  'enableUnconfirmedLogin' => true,
          //  'confirmWithin' => 21600,
          //  'cost' => 12,
            'admins' => ['admin']
          ],
         'rbac' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
            'mainLayout' => '@app/views/layouts/admin.php',
          ],
        'gridview' =>  [
                'class' => '\kartik\grid\Module'
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
        ]
    ],
    'controllerMap' => [
      'elfinder' => [
      'class' => 'mihaildev\elfinder\PathController',
      'access' => ['@'],
        'root' => [
              'path' => 'uploads',
              'name' => 'Files'
              ],
         ]
    ],
    'params' => $params,
];






if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
