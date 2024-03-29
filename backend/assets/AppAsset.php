<?php

namespace backend\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'vendor/fontawesome-free/css/all.min.css',
        'https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i',
        'css/sb-admin-2.min.css',
        'css/style.css'
    ];
    public $js = [
        "vendor/jquery-easing/jquery.easing.min.js",
        "vendor/chart.js/Chart.min.js",
        "js/sb-admin-2.min.js",
        "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js",
        "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    ];
    public $depends = [
        'yii\web\YiiAsset',
        JqueryAsset::class,
        'yii\bootstrap4\BootstrapAsset',
    ];
}
