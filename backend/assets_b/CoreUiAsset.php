<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/3/14
 * Time: 3:14 PM
 */

namespace backend\assets_b;

use common\assets\AdminLte;
use common\assets\Html5shiv;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

class CoreUiAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $basePath = '@webroot';
    /**
     * @var string
     */
    public $baseUrl = '@web/web/coreui-template';

    /**
     * @var array
     */
    public $css = [
        'vendors/coreui/icons/css/free.min.css',
        'vendors/flag-icon-css/css/flag-icon.min.css',
        'css/style.css',
        'vendors/pace-progress/css/pace.min.css'
    ];
    /**
     * @var array
     */
    public $js = [
        'vendors/pace-progress/js/pace.min.js',
        'vendors/coreui/coreui/js/coreui.bundle.min.js'
    ];

    /**
     * @var array
     */
    public $depends = [
        YiiAsset::class,
    ];
}
