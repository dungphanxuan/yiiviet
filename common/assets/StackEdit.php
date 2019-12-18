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

class StackEdit extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = null;


    /**
     * @var array
     */
    public $js = [
        'https://unpkg.com/stackedit-js@1.0.7/docs/lib/stackedit.min.js'
    ];
    /**
     * @var array
     */
    public $depends = [
        JqueryAsset::class
    ];
}
