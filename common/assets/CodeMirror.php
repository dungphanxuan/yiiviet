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

class CodeMirror extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@npm/codemirror';
    /**
     * @var array
     */
    public $css = [
        'lib/codemirror.css'
    ];

    /**
     * @var array
     */
    public $js = [
        'lib/codemirror.js',
        'mode/php/php.js',
        'mode/meta.js',
        'mode/markdown/markdown.js',
        'addon/display/panel.js'
    ];
    /**
     * @var array
     */
    public $depends = [
        JqueryAsset::class
    ];
}
