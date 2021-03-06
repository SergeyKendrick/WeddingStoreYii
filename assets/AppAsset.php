<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

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
        'front/css/flexslider.css',
        'front/css/form.css',
        'front/css/jquery-ui.css',
        'front/css/memenu.css',
        'front/css/bootstrap.css',
        'front/css/style.css',
        'front/css/font-awesome.min.css',
        
    ];
    public $js = [
        'front/js/jquery.js',
        'front/js/jquery-ui.min.js',
        'front/js/memenu.js',
        'front/js/bootstrap.min.js',
        'front/js/jquery.flexslider.js',
        'front/js/script.js',
        'front/js/jquery.flexisel.js',
        'front/js/jquery.cookie.js',
        'front/js/jquery.pjax.js',
        
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
