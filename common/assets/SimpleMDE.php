<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/3/14
 * Time: 8:16 PM
 */

namespace common\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class SimpleMDE extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = null;
    /**
     * @var array
     */
    public $css = [
        'https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css'
    ];

    /**
     * @var array
     */
    public $js = [
        'https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js',
    ];
    /**
     * @var array
     */
    public $depends = [
        JqueryAsset::class
    ];
}
