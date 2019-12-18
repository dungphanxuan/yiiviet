<?php

use Sitemaped\Sitemap;

return [
    'class' => 'yii\web\UrlManager',
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        'render-markdown' => 'site/render-markdown',
        // Pages
        ['pattern' => 'page/<slug>', 'route' => 'page/view'],

        // Articles
        ['pattern' => 'article/index', 'route' => 'article/index'],
        ['pattern' => 'article/create', 'route' => 'article/create'],
        ['pattern' => 'article/update', 'route' => 'article/update'],
        ['pattern' => 'article/attachment-download', 'route' => 'article/attachment-download'],
        'article/<id:\d+>/<name>' => 'article/view',
        'article/<id:\d+>' => 'article/view',
        //['pattern' => 'article/<slug>', 'route' => 'article/view'],

        // Sitemap
        ['pattern' => 'sitemap.xml', 'route' => 'site/sitemap', 'defaults' => ['format' => Sitemap::FORMAT_XML]],
        ['pattern' => 'sitemap.txt', 'route' => 'site/sitemap', 'defaults' => ['format' => Sitemap::FORMAT_TXT]],
        ['pattern' => 'sitemap.xml.gz', 'route' => 'site/sitemap', 'defaults' => ['format' => Sitemap::FORMAT_XML, 'gzip' => true]],
    ]
];
