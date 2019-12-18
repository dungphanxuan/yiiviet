<?php

use common\grid\EnumColumn;
use common\models\User;
use trntv\yii\datetime\DateTimeWidget;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="d-flex justify-content-end bd-highlight mb-3">
        <div class="p-2 bd-highlight">
            <?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
                'modelClass' => 'User',
            ]), ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'grid-view table-responsive'
        ],
        'columns' => [
            'id',
            'username',
            'email:email',
            [
                'class' => EnumColumn::class,
                'attribute' => 'status',
                'enum' => User::statuses(),
                'filter' => User::statuses()
            ],
            [
                'attribute' => 'created_at',
                'format' => 'datetime',
                'filter' => DateTimeWidget::widget([
                    'model' => $searchModel,
                    'attribute' => 'created_at',
                    'phpDatetimeFormat' => 'dd.MM.yyyy',
                    'momentDatetimeFormat' => 'DD.MM.YYYY',
                    'clientEvents' => [
                        'dp.change' => new JsExpression('(e) => $(e.target).find("input").trigger("change.yiiGridView")')
                    ],
                ])
            ],
            [
                'attribute' => 'logged_at',
                'format' => 'datetime',
                'filter' => DateTimeWidget::widget([
                    'model' => $searchModel,
                    'attribute' => 'logged_at',
                    'phpDatetimeFormat' => 'dd.MM.yyyy',
                    'momentDatetimeFormat' => 'DD.MM.YYYY',
                    'clientEvents' => [
                        'dp.change' => new JsExpression('(e) => $(e.target).find("input").trigger("change.yiiGridView")')
                    ],
                ])
            ],
            // 'updated_at',

            [
                'class' => 'backend\grid\ActionColumn',
                'options' => ['style' => 'width: 10%;text-align:center'],
                'template' => '{login} {view} {update} {delete}',
                'buttons' => [
                    'login' => function ($url) {
                        return Html::a(
                            '<i class="c-icon cil-user" aria-hidden="true"></i>',
                            $url,
                            [
                                'title' => Yii::t('backend', 'Login'),
                                'class' => 'btn btn-sm btn-success btn-xs',
                            ]
                        );
                    },
                ],
                'visibleButtons' => [
                    'login' => Yii::$app->user->can('administrator')
                ]

            ],
        ],
    ]); ?>

</div>
