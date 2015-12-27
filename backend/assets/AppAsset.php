<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/main.css',
        'css/animate.min.css',
        'css/bootstrap.css',
        'css/font-awesome.css',
        'css/font-awesome.min.css',
        'css/prettyPhoto.css',
        'css/responsive.css',
    ];
    public $js = [
        'js/bootstrap.min.js',
        'js/jquery.isotope.min.js',
        'js/jquery.js',
        'js/jquery.prettyPhoto.js',
        'js/main.js',
        'js/wow.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
