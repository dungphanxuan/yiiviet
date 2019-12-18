<?php

namespace common\models;

use common\components\object\ClassType;
use common\models\query\ArticleQuery;
use dosamigos\taggable\Taggable;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

use common\components\object\ObjectIdentityInterface;
/**
 * This is the model class for table "article".
 *
 * @property integer             $id
 * @property string              $slug
 * @property string              $title
 * @property string              $body
 * @property string              $excerpt
 * @property string              $view
 * @property string              $thumbnail_base_url
 * @property string              $thumbnail_path
 * @property array               $attachments
 * @property integer             $category_id
 * @property integer             $status
 * @property integer             $published_at
 * @property integer             $created_by
 * @property integer             $updated_by
 * @property integer             $created_at
 * @property integer             $updated_at
 *
 * @property User                $author
 * @property User                $updater
 * @property ArticleCategory     $category
 * @property ArticleAttachment[] $articleAttachments
 */
class Article extends ActiveRecord implements Linkable
{
    const STATUS_PUBLISHED = 1;
    const STATUS_DRAFT     = 0;

    const CONTENT_TYPE_MARKDOWN     = 1;
    const CONTENT_TYPE_PLAIN    = 2;

    /**
     * @var string editor note on upate
     */
    public $memo;

    /**
     * @var array
     */
    public $attachments;

    /**
     * @var array
     */
    public $thumbnail;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article}}';
    }

    /**
     * @return ArticleQuery
     */
    public static function find()
    {
        return new ArticleQuery(get_called_class());
    }

    /**
     * @return array statuses list
     */
    public static function statuses()
    {
        return [
            self::STATUS_DRAFT => Yii::t('common', 'Draft'),
            self::STATUS_PUBLISHED => Yii::t('common', 'Published'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class,
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
                'immutable' => true,
            ],
            [
                'class' => UploadBehavior::class,
                'attribute' => 'attachments',
                'multiple' => true,
                'uploadRelation' => 'articleAttachments',
                'pathAttribute' => 'path',
                'baseUrlAttribute' => 'base_url',
                'orderAttribute' => 'order',
                'typeAttribute' => 'type',
                'sizeAttribute' => 'size',
                'nameAttribute' => 'name',
            ],
            [
                'class' => UploadBehavior::class,
                'attribute' => 'thumbnail',
                'pathAttribute' => 'thumbnail_path',
                'baseUrlAttribute' => 'thumbnail_base_url',
            ],
            'tagable' => [
                'class' => Taggable::class,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'body', 'category_id'], 'required'],
            [['slug'], 'unique'],
            [['body', 'excerpt'], 'string'],
            [['published_at'], 'default', 'value' => function () {
                return date(DATE_ISO8601);
            }],
            [['published_at'], 'filter', 'filter' => 'strtotime', 'skipOnEmpty' => true],
            [['category_id'], 'exist', 'targetClass' => ArticleCategory::class, 'targetAttribute' => 'id'],
            [['status'], 'integer'],
            [['thumbnail_base_url', 'thumbnail_path'], 'string', 'max' => 1024],
            [['title'], 'string', 'max' => 512],
            [['view', 'slug'], 'string', 'max' => 255],
            [['attachments', 'thumbnail'], 'safe'],
            [['tagNames'], 'safe'],
            //['memo', 'required', 'on' => 'update'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'slug' => Yii::t('common', 'Slug'),
            'title' => Yii::t('common', 'Title'),
            'body' => Yii::t('common', 'Body'),
            'excerpt' => Yii::t('common', 'Excerpt'),
            'view' => Yii::t('common', 'Article View'),
            'thumbnail' => Yii::t('common', 'Thumbnail'),
            'category_id' => Yii::t('common', 'Category'),
            'status' => Yii::t('common', 'Published'),
            'published_at' => Yii::t('common', 'Published At'),
            'created_by' => Yii::t('common', 'Author'),
            'updated_by' => Yii::t('common', 'Updater'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
            'tagNames' => Yii::t('common', 'Tags'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getObjectType()
    {
        return ClassType::ARTICLE;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdater()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ArticleCategory::class, ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleAttachments()
    {
        return $this->hasMany(ArticleAttachment::class, ['article_id' => 'id']);
    }

    public function getTeaser()
    {
        $lines = preg_split("/\n\s+\n/", $this->content, -1, PREG_SPLIT_NO_EMPTY);
        return reset($lines);
    }


    public function getContentHtml()
    {
        return Yii::$app->formatter->asGuideMarkdown($this->body);
    }

    // relations

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        $tableTagArticle = 'tbl_article2article_tags';
        return $this->hasMany(ArticleTag::class, ['id' => 'article_tag_id'])
            ->viaTable($tableTagArticle, ['article_id' => 'id']);
    }

    /**
     * @return Article[]
     */
    public function getRelatedArticle()
    {
        $tags = $this->tags;
        if (empty($tags)) {
            return [];
        }
        $likes = [];
        foreach($tags as $i => $tag) {
            if ($i > 5) {
                break;
            }
            $likes[] = $tag->name;
        }
        $ids = self::find()
            ->latest()
            ->published()
            ->select('news.id')->distinct()
            ->joinWith('tags AS tags')
            ->where(['or like', 'tags.name', $likes])
            ->andWhere(['!=', 'news.id', $this->id])
            ->limit(5)
            ->column();

        return self::findAll($ids);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::class, ['id' => 'creator_id']);
    }

    /**
     * @return array url to this object. Should be something to be passed to [[\yii\helpers\Url::to()]].
     */
    public function getUrl($action = 'view', $params = [])
    {
        return ['news/view', 'id' => $this->id, 'name' => $this->slug];
    }

    /**
     * @return string title to display for a link to this object.
     */
    public function getLinkTitle()
    {
        return $this->title;
    }


    /**
     * @inheritdoc
     */
    public function getObjectId()
    {
        return $this->id;
    }

}
