<?php
/* @var $this yii\web\View */
/* @var $model common\models\Article */
$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

use yii\helpers\Html; ?>
<div class="content">
    <article class="article-item">

        <!-- Page Content -->

        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3"><?php echo $model->title ?>
            <small><?php echo Yii::t('frontend', 'by') ?>
                <a href="#">Start Bootstrap</a>
            </small>
        </h1>

        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html">Home</a>
            </li>
            <li class="breadcrumb-item active">Blog</li>
        </ol>

        <div class="row">

            <!-- Post Content Column -->
            <div class="col-lg-8">

                <!-- Preview Image -->
                <img class="img-fluid rounded" src="http://placehold.it/900x300" alt="">

                <hr>

                <!-- Date/Time -->
                <p><?php echo Yii::t('frontend', 'Posted on') ?> <?php echo Yii::$app->formatter->asDatetime($model->created_at) ?></p>

                <hr>
                <?php echo $model->contentHtml ?>

                <hr>

                <div class="comments-wrapper">
                    <div class="comments">
                        <?= \frontend\widgets\Comments::widget([
                            'objectType' => $model->getObjectType(),
                            'objectId' => $model->getObjectId(),
                            'prompt' => Yii::t('frontend', 'Please only use comments to help explain the above article.<br/>If you have any questions, please ask in ' . Html::a('the forum', Yii::$app->request->baseUrl . '/forum') . ' instead.'),
                        ]) ?>
                    </div>
                </div>

                <p></p>
            </div>

            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">
                <?= $this->render('_sidebar', [
                    'category' => $model,
                    'searchModel' => $searchModel,
                ]) ?>
            </div>

        </div>
        <!-- /.row -->


    </article>
</div>