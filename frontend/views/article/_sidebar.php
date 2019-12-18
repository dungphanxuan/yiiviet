<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var $this \yii\web\View */
/** @var $category string */
/** @var $version string */
/** @var $tag \common\models\ArticleTag */
?>
<div class="card mb-4">
    <a href="<?php echo Url::to(['/article/create']) ?>" class="btn btn-outline-primary" role="button"
       aria-pressed="true"><?php echo Yii::t('frontend', 'Write new Article') ?></a>
</div>
<!-- Search Widget -->
<div class="card mb-4">
    <h5 class="card-header"><?php echo Yii::t('frontend', 'Search') ?></h5>
    <div class="card-body">
        <?php $form = ActiveForm::begin([
            'method' => 'GET',
            'action' => ['/article/index'],
            'options' => ['class' => '']
        ]) ?>
        <div class="input-group">
            <?= Html::textInput('title', getParam('title'), ['class' => 'form-control', 'placeholder' => Yii::t('frontend', 'Search for...')]) ?>
            <span class="input-group-btn">
                <button class="btn btn-secondary" type="submit">Go!</button>
              </span>
        </div>
        <?php ActiveForm::end() ?>
    </div>
</div>

<!-- Categories Widget -->
<div class="card my-4">
    <h5 class="card-header"><?php echo Yii::t('frontend', 'Categories') ?></h5>
    <div class="card-body">
        <div class="row">
            <ul class="article-side-menu">
                <li<?= empty($category) ? ' class="active"' : '' ?>><a
                            href="<?= Url::to(['article/index', 'tag' => isset($tag) ? $tag->slug : null]) ?>">All</a>
                </li>
                <?php foreach (\common\models\ArticleCategory::findWithCountData()->all() as $cat): ?>
                    <li<?= isset($category) && $category->id == $cat->id ? ' class="active"' : '' ?>>
                        <a href="<?= Url::to([
                            'article/index',
                            'category' => $cat->id,
                            'tag' => isset($tag) ? $tag->slug : null,
                        ]) ?>"><?= Html::encode($cat->title) ?> <span class="count"><?= (int)$cat->count ?></span></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<!-- Side Widget -->
<div class="card my-4">
    <h5 class="card-header">Side Widget</h5>
    <div class="card-body">
        You can put anything you want inside of these side widgets. They are easy to use, and feature the
        new
        Bootstrap 4 card containers!
    </div>
</div>
