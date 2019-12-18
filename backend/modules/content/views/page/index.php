<?php

use common\grid\EnumColumn;
use common\models\Page;
use yii\grid\GridView;
use yii\helpers\Html;

/**
 * @var $this         yii\web\View
 * @var $searchModel  \backend\models\search\PageSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $model        common\models\Page
 */

$this->title = Yii::t('backend', 'Pages');

$this->params['breadcrumbs'][] = $this->title;

?>

<div>

</div>
<div class="d-flex justify-content-end bd-highlight mb-3">
    <div class="p-2 bd-highlight">
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseForm"
                aria-expanded="false" aria-controls="collapseExample">
            <?php echo Yii::t('backend', 'Create {modelClass}', ['modelClass' => 'Page']) ?>
        </button>
    </div>
</div>
<div class="collapse" id="collapseForm">
    <div class="card">
        <div class="card-body">
            <?php echo $this->render('_form', [
                'model' => $model,
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
            'options' => ['style' => 'width: 7%;text-align:center'],
        ],
        [
            'attribute' => 'slug',
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
            'enum' => Page::statuses(),
            'filter' => Page::statuses(),
        ],
        [
            'class' => 'backend\grid\ActionColumn',
            'template' => '{delete}',
        ],
    ],
]); ?>
