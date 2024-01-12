<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
  public $basePath = '@webroot';
  public $baseUrl = '@web';
  public $css = [
    'css/app.css',
    'plugins/jstree/dist/themes/default/style.min.css',
    "plugins/atjs/dist/css/jquery.atwho.min.css",
    'plugins/typeahead/typeahead.css',
  ];
  public $js = [
    'js/app.js',
    //order penunjang
    'plugins/jstree/dist/jstree.min.js',
    //utk resep
    "plugins/typeahead/typeahead.bundle.min.js",
    "plugins/atjs/dist/js/jquery.atwho.min.js",
    "plugins/caretjs/dist/jquery.caret.min.js",
    'plugins/typeahead/typeahead.bundle.min.js',
  ];
  public $depends = [
    // 'yii\web\YiiAsset',
    // 'yii\bootstrap4\BootstrapAsset',
  ];
}
