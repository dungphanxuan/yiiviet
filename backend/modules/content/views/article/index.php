<?php

use common\grid\EnumColumn;
use common\models\Article;
use common\models\ArticleCategory;
use trntv\yii\datetime\DateTimeWidget;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JsExpression;

/**
 * @var $this         yii\web\View
 * @var $searchModel  backend\modules\content\models\search\ArticleSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = Yii::t('backend', 'Articles');

$this->params['breadcrumbs'][] = $this->title;

?>
<div class="d-flex justify-content-end bd-highlight mb-3">
    <div class="p-2 bd-highlight">
        <?php echo Html::a(
            Yii::t('backend', 'Create {modelClass}', ['modelClass' => 'Article']),
            ['create'],
            ['class' => 'btn btn-success']) ?>
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
            'attribute' => 'category_id',
            'options' => ['style' => 'width: 10%'],
            'value' => function ($model) {
                return $model->category ? $model->category->title : null;
            },
            'filter' => ArrayHelper::map(ArticleCategory::find()->all(), 'id', 'title'),
        ],
        [
            'attribute' => 'created_by',
            'options' => ['style' => 'width: 10%'],
            'value' => function ($model) {
                return $model->author ? $model->author->username : '';
            },
        ],
        [
            'class' => EnumColumn::class,
            'attribute' => 'status',
            'options' => ['style' => 'width: 10%'],
            'enum' => Article::statuses(),
            'filter' => Article::statuses(),
        ],
        [
            'attribute' => 'published_at',
            'options' => ['style' => 'width: 10%'],
            'format' => 'datetime',
            'filter' => DateTimeWidget::widget([
                'model' => $searchModel,
                'attribute' => 'published_at',
                'phpDatetimeFormat' => 'dd.MM.yyyy',
                'momentDatetimeFormat' => 'DD.MM.YYYY',
                'clientEvents' => [
                    'dp.change' => new JsExpression('(e) => $(e.target).find("input").trigger("change.yiiGridView")'),
                ],
            ]),
        ],
        [
            'attribute' => 'created_at',
            'options' => ['style' => 'width: 10%'],
            'format' => 'datetime',
            'filter' => DateTimeWidget::widget([
                'model' => $searchModel,
                'attribute' => 'created_at',
                'phpDatetimeFormat' => 'dd.MM.yyyy',
                'momentDatetimeFormat' => 'DD.MM.YYYY',
                'clientEvents' => [
                    'dp.change' => new JsExpression('(e) => $(e.target).find("input").trigger("change.yiiGridView")'),
                ],
            ]),
        ],
        [
            'class' => 'backend\grid\ActionColumn',
            'template' => '{update} {copy} {delete}',
            'contentOptions' => ['style' => 'width:10%;text-align:center'],
            'buttons' => [
                'copy' => function ($url, $model, $key) {
                    $url = \yii\helpers\Url::to(['/article/create', 'type' => 'copy', 'id' => $key]);
                    return Html::a('<span class="c-icon cil-copy"></span>', $url, [
                        'title' => \Yii::t('common', 'Copy'),
                        'class' => 'btn btn-sm btn-success btn-xs',
                        'data-pjax' => 0
                    ]);
                },
                'show' => function ($url) {
                    return Html::a(
                        '<i class="c-icon cil-browser" aria-hidden="true"></i>',
                        $url,
                        [
                            'title' => Yii::t('backend', 'Show'),
                            'class' => 'btnaction btn btn-success btn-xs',
                            'target' => '_blank',
                            'data-pjax' => 0
                        ]
                    );
                },
            ]
        ]
    ],
]); ?>
