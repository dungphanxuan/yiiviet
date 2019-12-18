<?php

use common\grid\EnumColumn;
use common\models\ArticleCategory;
use yii\grid\GridView;
use yii\helpers\Html;

/**
 * @var $this         yii\web\View
 * @var $searchModel  backend\modules\content\models\search\ArticleCategorySearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $model        ArticleCategory
 * @var $categories   common\models\ArticleCategory[]
 */

$this->title = Yii::t('backend', 'Article Categories');

$this->params['breadcrumbs'][] = $this->title;

?>

<div class="d-flex justify-content-end bd-highlight mb-3">
    <div class="p-2 bd-highlight">
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseForm"
                aria-expanded="false" aria-controls="collapseExample">
            <?php echo Yii::t('backend', 'Create {modelClass}', ['modelClass' => 'Article Category']) ?>
        </button>
    </div>
</div>
<div class="collapse" id="collapseForm">
    <div class="card">
        <div class="card-body">
            <?php echo $this->render('_form', [
                'model' => $model,
                'categories' => $categories,
            ]) ?>
        </div>
    </div>
</div>

<?php echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'options' => [
        'class' => 'grid-view table-responsive',
    ],
    'columns' => [
        [
            'attribute' => 'id',
            'options' => ['style' => 'width: 5%'],
        ],
        [
            'attribute' => 'slug',
            'options' => ['style' => 'width: 15%'],
        ],
        [
            'attribute' => 'title',
            'value' => function ($model) {
                return Html::a($model->title, ['update', 'id' => $model->id]);
            },
            'format' => 'raw',
        ],
        [
            'class' => EnumColumn::class,
            'attribute' => 'status',
            'options' => ['style' => 'width: 10%'],
            'enum' => ArticleCategory::statuses(),
            'filter' => ArticleCategory::statuses(),
        ],
        [
            'class' => 'backend\grid\ActionColumn',
            'options' => ['style' => 'width: 10%;text-align:center'],
            'template' => '{update} {delete}',
        ],
    ],
]); ?>
