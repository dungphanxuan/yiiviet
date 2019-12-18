<?php

namespace common\models;

use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 *
 */
abstract class BaseCategory extends ActiveRecord
{
    protected static $objectRelation;

    public $count;

    public static function getSelectData()
    {
        return ArrayHelper::map(static::find()->orderBy(['title' => SORT_ASC])->asArray()->all(), 'id', 'title');
    }

    /**
     * @return ActiveQuery
     */
    public static function findWithCountData()
    {
        return static::find()->alias('c')->joinWith(static::getObjectRelationName() . ' as r')
            ->select(['c.id', 'c.title', 'COUNT(r.id) AS count'])
            ->groupBy(['c.id', 'c.title']);
    }

    /**
     * @return string
     */
    protected static function getObjectRelationName()
    {
        throw new InvalidConfigException('getObjectRelationName() must be implemented in child classes.');
    }
}
