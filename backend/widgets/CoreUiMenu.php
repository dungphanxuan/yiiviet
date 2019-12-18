<?php

namespace backend\widgets;

use backend\assets_b\CoreUiAsset;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Class Menu
 * @package backend\components\widget
 */
class CoreUiMenu extends \yii\widgets\Menu
{
    /**
     * @var string
     */
    public $linkTemplate = "<a href=\"{url}\">\n{icon}\n{label}\n{right-icon}\n{badge}</a>";
    /**
     * @var string
     */
    public $labelTemplate = "{icon}\n{label}\n{badge}";

    /**
     * @var string
     */
    public $badgeTag = 'span';
    /**
     * @var string
     */
    public $badgeClass = 'badge';
    /**
     * @var string
     */
    public $badgeBgClass;

    public $iconUrl = '';

    public function init()
    {
        parent::init();
    }

    /**
     * @inheritdoc
     */
    protected function renderItem($item)
    {
        $item['badgeOptions'] = isset($item['badgeOptions']) ? $item['badgeOptions'] : [];

        if (!ArrayHelper::getValue($item, 'badgeOptions.class')) {
            $bg = isset($item['badgeBgClass']) ? $item['badgeBgClass'] : $this->badgeBgClass;
            $item['badgeOptions']['class'] = $this->badgeClass . ' ' . $bg;
        }


        if (isset($item['url'])) {
            $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);

            return strtr($template, [
                '{badge}' => isset($item['badge'])
                    ? Html::tag(
                        'span',
                        $item['badge'],
                        $item['badgeOptions']
                    )
                    : '',
                '{icon}' => isset($item['iconElement']) ? '<svg class="c-sidebar-nav-icon">
              <use xlink:href="' . $this->iconUrl . $item['iconElement'] . '"></use>
            </svg>' : '',
                '{right-icon}' => isset($item['right-icon']) ? $item['right-icon'] : '',
                '{url}' => Url::to($item['url']),
                '{label}' => $item['label'],
            ]);
        } else {
            $template = ArrayHelper::getValue($item, 'template', $this->labelTemplate);

            return strtr($template, [
                '{badge}' => isset($item['badge'])
                    ? Html::tag('small', $item['badge'], $item['badgeOptions'])
                    : '',
                '{icon}' => isset($item['iconElement']) ? '<svg class="c-sidebar-nav-icon">
              <use xlink:href="' . $this->iconUrl . $item['iconElement'] . '"></use>
            </svg>' : '',
                '{right-icon}' => isset($item['right-icon']) ? $item['right-icon'] : '',
                '{label}' => $item['label'],
            ]);
        }
    }
}
