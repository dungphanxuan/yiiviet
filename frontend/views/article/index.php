<?php
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

/* @var $searchModel frontend\models\search\ArticleSearch */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = Yii::t('frontend', 'Yii Framework Wiki')
?>
<div id="article-index">

    <!-- Page Content -->

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">Yii Framework Wiki
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html">Home</a>
        </li>
        <li class="breadcrumb-item active">Blog</li>
    </ol>

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php echo ListView::widget([
                'dataProvider' => $dataProvider,
                'layout' => "{summary}\n{items}\n",
                'itemView' => '_item',
            ]) ?>

            <!-- Pagination -->
            <?php
            // display pagination
            echo \yii\bootstrap4\LinkPager::widget([
            'pagination' => $dataProvider->pagination,
            ]);
            ?>

        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">
            <?= $this->render('_sidebar', ['category' => $category ? $category : null,
            'tag' => $tag,
            'searchModel' => $searchModel,]) ?>
        </div>

    </div>

</div>
