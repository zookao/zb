<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'name' => '遵纪守法好公民',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'api\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-api',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-api', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-api',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'controller' => ['user'],
                    'class' => 'yii\rest\UrlRule',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'POST l' => 'login',
                        'GET i' => 'info',
                    ],
                ],
                [
                    'controller' => ['get'],
                    'class' => 'yii\rest\UrlRule',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET p' => 'plants',
                        'GET zb/<address:.+>' => 'lists',
                        'GET f' => 'favorites',
                    ],
                ],
            ],
        ],
    ],
    'params' => $params,
];
