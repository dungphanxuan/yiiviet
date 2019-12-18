<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model common\models\Article */

$this->title = 'Update Wiki Article';

?>
<div class="container guide-view lang-en" xmlns="http://www.w3.org/1999/xhtml">
    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3"><?php echo Yii::t('frontend', 'Update a new Wiki article') ?>
        <small>Subheading</small>
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo Url::home() ?>"><?php echo Yii::t('frontend', 'Home') ?></a>
        </li>
        <li class="breadcrumb-item active"><?php echo Yii::t('frontend', 'Create Article') ?></li>
    </ol>
    <div class="row">
        <div class="col-sm-3 col-md-2 col-lg-2">
            <?= $this->render('_sidebar', [
                'category' => $model,
                //'sort' => $dataProvider->sort,
            ]) ?>
        </div>

        <div class="col-sm-9 col-md-10 col-lg-10" role="main">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>
</div>
