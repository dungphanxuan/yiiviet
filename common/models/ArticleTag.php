<?php

namespace common\models;

use common\components\SluggableBehavior;
use common\models\query\ArticleQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "article_tags".
 *
 * @property integer $id
 * @property integer $frequency
 * @property string $name
 * @property string $slug
 *
 * @property Article[] $article
 */
class ArticleTag extends ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'name',
                'attributes' => [static::EVENT_BEFORE_INSERT => 'slug'],
                'immutable' => true,
                'ensureUnique' => true,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article_tags}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['frequency'], 'integer'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'frequency' => 'Frequency',
            'name' => 'Name',
        ];
    }

    /**
     * @return ArticleQuery
     */
    public function getArticle()
    {
        $tableTagArticle = 'tbl_article2article_tags';
        return $this->hasMany(Article::class, ['id' => 'article_id'])
            ->viaTable($tableTagArticle, ['article_tag_id' => 'id']);
    }
}
