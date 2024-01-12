<?php
namespace app\assets;
use yii\web\AssetBundle;
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // 'plugins/iofrm/css/bootstrap.min.css',//pakai bootstrap.min.css bawaan yii2
        'plugins/iofrm/css/fontawesome-all.min.css',
        'plugins/iofrm/css/iofrm-style.css',
        'plugins/iofrm/css/iofrm-theme4.css',
    ];
    public $js = [
        // 'plugins/iofrm/js/jquery.min.js',//karena bentrok dgn jquery yii2
        // 'plugins/iofrm/js/popper.min.js',//pakai popper.min.js di admin lte
        // 'plugins/iofrm/js/bootstrap.min.js',//pakai bootstrap.min.js bawaan yii2
        'plugins/iofrm/js/main.js',
    ];
    public $depends = [
        // 'yii\web\YiiAsset',
        // 'yii\bootstrap4\BootstrapAsset',
    ];
}
