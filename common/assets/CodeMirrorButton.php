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

class CodeMirrorButton extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@bower/codemirror-buttons';
    /**
     * @var array
     */
    public $css = [
        'buttons.css'
    ];

    /**
     * @var array
     */
    public $js = [
        'buttons.js'
    ];
    /**
     * @var array
     */
    public $depends = [
        JqueryAsset::class,
        CodeMirror::class
    ];
}
