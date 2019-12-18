<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\Article;
use yii\db\ActiveQuery;

class ArticleQuery extends ActiveQuery
{
    /**
     * @return $this
     */
    public function published()
    {
        $this->andWhere(['status' => Article::STATUS_PUBLISHED]);
        $this->andWhere(['<', '{{%article}}.published_at', time()]);
        return $this;
    }

    /**
     * @return $this
     */
    public function latest()
    {
        return $this
            ->andWhere(['status' => Article::STATUS_PUBLISHED])
            ->orderBy(['created_at' => SORT_DESC]);
    }

    /**
     * @return $this
     */
    public function active()
    {
        return $this->andWhere(['status' => Article::STATUS_PUBLISHED]);
    }
}
