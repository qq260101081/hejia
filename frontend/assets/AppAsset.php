<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'frontend/web/css/reset.css',
        'frontend/web/css/thems.css',
    ];
    public $js = [
        //'frontend/web/js/js_z.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
         //'yii\bootstrap\BootstrapAsset',
    ];
}
