<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
    	'menus' => [
    		'class' => 'app\modules\menus\Module',
    	],
    	'pages' => [
    		'class' => 'app\modules\pages\Module',
    	],
        'service' => [
            'class' => 'app\modules\service\Module',
        ],
        'users' => [
            'class' => 'app\modules\users\Module',
        ],
        'presscentre' => [
            'class' => 'app\modules\presscentre\Module',
        ],
        'interesting' => [
            'class' => 'app\modules\interesting\Module',
        ],
        'mien' => [
            'class' => 'app\modules\mien\Module',
        ],
        'student' => [
            'class' => 'app\modules\student\Module',
        ],
        'staff' => [
            'class' => 'app\modules\staff\Module',
        ],
        'product' => [
            'class' => 'app\modules\product\Module',
        ],
        'serviceProduct' => [
            'class' => 'app\modules\serviceProduct\Module',
        ],
        'orders' => [
            'class' => 'app\modules\orders\Module',
        ],
        'stat' => [
            'class' => 'app\modules\stat\Module',
        ],
        'cfg' => [
            'class' => 'app\modules\cfg\Module',
        ],
        'ad' => [
            'class' => 'app\modules\ad\Module',
        ],
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],

    	'assetManager' => [
    		'bundles' => [
    			'dmstr\web\AdminLteAsset' => [
    				'skin' => 'skin-red-light',
    				//"skin-blue",
    					//"skin-black",
    					//"skin-red",
    					//"skin-yellow",
    					//"skin-purple",
    					//"skin-green",
    					//"skin-blue-light",
    					//"skin-black-light",
    					//"skin-red-light",
    					//"skin-yellow-light",
    					//"skin-purple-light",
    					//"skin-green-light"
    			],
    		],
            'basePath' => '@webroot/backend/web/assets',
            'baseUrl' => '@web/backend/web/assets'
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
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            //'viewPath' => '@backend/mail',
            'useFileTransport' => false,//set this property to false to send mails to real email addresses
            //comment the following array to send mail using php's mail function
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.263.net',
                'username' => 'admin@bnboxes.com',
                'password' => '1KK65O8B',
                'port' => '25',
                'encryption' => 'tls',
            ],
            'messageConfig'=>[
                'charset'=>'UTF-8',
                'from'=>['admin@bnboxes.com'=>'admin']
            ],
        ],
        'formatter' => [
            'dateFormat' => 'yyyy-MM-dd',
            'datetimeFormat' => 'yyyy-MM-dd H:i:s',
            'timeFormat' => 'H:i:s',

            'locale' => 'de-DE', //your language locale
            'defaultTimeZone' => 'Europe/Berlin', // time zone
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'basePath' => '@app/messages',
                    //'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'language' => 'zh-CN',
    'timeZone' => 'Asia/Shanghai',
    'params' => $params,
];
