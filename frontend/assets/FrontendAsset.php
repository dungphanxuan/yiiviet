<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use common\assets\Html5shiv;
use yii\bootstrap4\BootstrapAsset;
use yii\bootstrap4\BootstrapPluginAsset;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

/**
 * Frontend application asset
 */
class FrontendAsset extends AssetBundle
{
    /**
     * @var string
     */
    //public $sourcePath = '@frontend/web/bundle';

    /**
     * @var string
     */
    public $basePath = '@webroot';
    /**
     * @var string
     */
    //public $baseUrl = '@web/frontend/web/dist';
    public $baseUrl = '@web/frontend/web';

    /**
     * @var array
     */
    public $css = [
        'css/main.css',
        'https://fonts.googleapis.com/css?family=Lato',
        'https://use.fontawesome.com/releases/v5.3.1/css/all.css',
        'froala-design-blocks/css/froala_blocks.css',
        //'https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-flash.min.css'

    ];

    /**
     * @var array
     */
    public $js = [
        'js/app.js',
        //'https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js'
    ];

    /**
     * @var array
     */
    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
        BootstrapPluginAsset::class,
        Html5shiv::class,
    ];
}
