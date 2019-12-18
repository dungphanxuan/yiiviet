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

class CloudinaryUploadWidget extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = null;


    /**
     * @var array
     */
    public $js = [
        'https://widget.cloudinary.com/v2.0/global/all.js'
    ];
    /**
     * @var array
     */
    public $depends = [
        JqueryAsset::class
    ];
}
