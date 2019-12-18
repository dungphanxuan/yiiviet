<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\Article
 */

use yii\helpers\Html;

?>
<!-- Blog Post -->
<div class="card mb-4">
    <div class="card-body">
        <h2 class="card-title"><?php echo $model->title ?></h2>
        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
        <a href="<?php echo \yii\helpers\Url::to(['view', 'id' => $model->id, 'name' => $model->slug]) ?>"
           class="btn btn-primary"><?php echo Yii::t('frontend', 'Read More') ?>
            &rarr;</a>
    </div>
    <div class="card-footer text-muted">
        <?php echo Yii::t('frontend', 'Posted on') ?> <?php echo Yii::$app->formatter->asDatetime($model->created_at) ?> <?php echo Yii::t('frontend', 'by') ?>
        <a href="#">Start Bootstrap</a>
    </div>
</div>
