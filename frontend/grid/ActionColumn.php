<?php

namespace frontend\grid;

use Yii;
use yii\helpers\Html;

class ActionColumn extends \yii\grid\ActionColumn
{
    /**
     * @var array
     */
    public $buttonClass = [
        'delete' => 'danger',
        'view' => 'success',
        'show' => 'success',
        'update' => 'edit',
        'copy' => 'info',
        'item' => 'info',
        'task' => 'info',
        'search' => 'info',
        'login' => 'info'
    ];

    /**
     * @inheritdoc
     */
    protected function initDefaultButton($name, $iconName, $additionalOptions = [])
    {
        if (!isset($this->buttons[$name]) && strpos($this->template, '{' . $name . '}') !== false) {
            $this->buttons[$name] = function ($url, $model, $key) use ($name, $iconName, $additionalOptions) {
                $title = Yii::t('yii', ucfirst($name));
                $options = array_merge([
                    'title' => $title,
                    'class' => 'btn btn-xs btn-' . $this->buttonClass[$name],
                    'aria-label' => $title,
                    'data-pjax' => '0',
                ], $additionalOptions, $this->buttonOptions);
                $icon = Html::tag('i', '', ['class' => "fas fa-$iconName"]);

                return Html::a($icon, $url, $options);
            };
        }
    }

}