<?php

namespace common\components\object;

use common\models\Comment;

use common\models\FileStorageItem;
use common\models\Article;
use yii\base\InvalidValueException;

class ClassType
{
    const NEWS = 'news';
    const WIKI = 'wiki';
    const ARTICLE = 'article';
    const EXTENSION = 'extension';
    const COMMENT = 'comment';
    const FILE = 'file';

    const GUIDE = 'guide';
    const API = 'api';
    const DOC = 'doc';

    public static $classes = [
        self::NEWS => News::class,
        self::WIKI => Wiki::class,
        self::EXTENSION => Extension::class,
        self::COMMENT => Comment::class,
        self::FILE => File::class,
        self::DOC => Doc::class,
    ];

    /**
     * @param string $type
     *
     * @return string
     */
    public static function getClass($type)
    {
        if (array_key_exists($type, static::$classes)) {
            return static::$classes[$type];
        }

        throw new InvalidValueException("Object type \"{$type}\" was not found.");
    }
}
