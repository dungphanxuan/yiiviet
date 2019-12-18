<?php
/**
 * @var $this yii\web\View
 * @var $content string
 */

use backend\assets_b\CoreUiAsset;
use backend\modules\system\models\SystemLog;
use backend\widgets\Menu;
use common\models\TimelineEvent;
use yii\bootstrap4\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\log\Logger;
use yii\bootstrap4\Breadcrumbs;

$coreuiBundle = CoreUiAsset::register($this);
$iconSvgUrl = $this->assetManager->getAssetUrl($coreuiBundle, 'vendors/@coreui/icons/svg/free.svg');
Yii::info(Yii::$app->components["i18n"]["translations"]['*']['class'], 'test');
$sideBarClass = implode(' ', [
    'c-sidebar c-sidebar-fixed',
    ArrayHelper::getValue($this->params, 'body-class'),
    Yii::$app->keyStorage->get('backend.dark-theme') ? 'c-sidebar-dark' : null,
    Yii::$app->keyStorage->get('backend.sidebar-lg-show') ? 'c-sidebar-lg-show' : null,
    Yii::$app->keyStorage->get('backend.sidebar-minimized') ? 'c-sidebar-minimized' : null,
])
?>

<?php $this->beginContent('@backend/views/layouts/base.php'); ?>

<div class="<?php echo $sideBarClass?>" id="sidebar">
    <div class="c-sidebar-brand">
        <img class="c-sidebar-brand-full"
             src="<?php echo $this->assetManager->getAssetUrl($coreuiBundle, 'assets/brand/coreui-base-white.svg') ?>"
             width="118" height="46" alt="CoreUI Logo">
        <img class="c-sidebar-brand-minimized"
             src="<?php echo $this->assetManager->getAssetUrl($coreuiBundle, 'assets/brand/coreui-signet-white.svg') ?>"
             width="118" height="46"
             alt="CoreUI Logo">
    </div>
    <?php echo \backend\widgets\CoreUiMenu::widget([
        'options' => ['class' => 'c-sidebar-nav'],
        'linkTemplate' => '<a class="c-sidebar-nav-link" href="{url}">{icon}<span>{label}</span>{right-icon}{badge}</a>',
        'submenuTemplate' => "\n<ul class=\"c-sidebar-nav-dropdown-items\">\n{items}\n</ul>\n",
        'activateParents' => true,
        'iconUrl' => $iconSvgUrl,
        'items' => [
            [
                'label' => Yii::t('backend', 'Main'),
                'options' => ['class' => 'c-sidebar-nav-title'],
            ],
            [
                'label' => Yii::t('backend', 'Timeline'),
                'iconElement' => '#cil-bar-chart',
                'url' => ['/timeline-event/index'],
                'badge' => TimelineEvent::find()->today()->count(),
                'badgeBgClass' => 'badge-info',
            ],
            [
                'label' => Yii::t('backend', 'Users'),
                'iconElement' => '#cil-user',
                'url' => ['/user/index'],
                'active' => Yii::$app->controller->id === 'user',
                'visible' => Yii::$app->user->can('administrator'),
            ],
            [
                'label' => Yii::t('backend', 'Content'),
                'options' => ['class' => 'c-sidebar-nav-title'],
            ],
            [
                'label' => Yii::t('backend', 'Static pages'),
                'url' => ['/content/page/index'],
                'iconElement' => '#cil-paper-plane',
                'active' => Yii::$app->controller->id === 'page',
            ],
            [
                'label' => Yii::t('backend', 'Articles'),
                'url' => '#',
                'iconElement' => '#cil-file',
                'options' => ['class' => 'c-sidebar-nav-item c-sidebar-nav-dropdown'],
                'template' => '<a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="{url}">{icon}<span>{label}</span>{right-icon}{badge}</a>',
                'active' => 'content' === Yii::$app->controller->module->id &&
                    ('article' === Yii::$app->controller->id || 'category' === Yii::$app->controller->id),
                'items' => [
                    [
                        'label' => Yii::t('backend', 'Articles'),
                        'url' => ['/content/article/index'],
                        'active' => Yii::$app->controller->id === 'article',
                    ],
                    [
                        'label' => Yii::t('backend', 'Categories'),
                        'url' => ['/content/category/index'],
                        'active' => Yii::$app->controller->id === 'category',
                    ],
                ],
            ],
            [
                'label' => 'Download CoreUI',
                'url' => ['/content/page/index'],
                'iconElement' => '#cil-cloud-download',
                'options' => ['class' => 'c-sidebar-nav-item mt-auto'],
                'template' => '<a class="c-sidebar-nav-link c-sidebar-nav-link-success" href="https://coreui.io">{icon}<span>{label}</span>{right-icon}{badge}</a>',
                'active' => Yii::$app->controller->id === 'page',
            ],
            [
                'label' => 'Try CoreUIPRO',
                'url' => ['/content/page/index'],
                'iconElement' => '#cil-layers',
                'template' => '<a class="c-sidebar-nav-link c-sidebar-nav-link-danger" href="https://coreui.io/pro">{icon}<span>{label}</span>{right-icon}{badge}</a>',
                'active' => Yii::$app->controller->id === 'page',
            ],
        ],
    ]) ?>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
            data-class="c-sidebar-minimized"></button>
</div>
<div class="c-wrapper">
    <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
        <button class="c-header-toggler c-class-toggler d-lg-none mr-auto" type="button" data-target="#sidebar"
                data-class="c-sidebar-show"><span class="c-header-toggler-icon"></span></button>
        <a class="c-header-brand d-sm-none" href="#"><img class="c-header-brand"
                                                          src="<?php echo $this->assetManager->getAssetUrl($coreuiBundle, 'assets/brand/coreui-base.svg') ?>"
                                                          width="97" height="46" alt="CoreUI Logo"></a>
        <button class="c-header-toggler c-class-toggler ml-3 d-md-down-none" type="button" data-target="#sidebar"
                data-class="c-sidebar-lg-show" responsive="true"><span class="c-header-toggler-icon"></span></button>
        <ul class="c-header-nav d-md-down-none">
            <li class="c-header-nav-item px-3"><a class="c-header-nav-link"
                                                  href="<?php echo Url::to(['/site/dashboard']) ?>">Dashboard</a></li>
            <li class="c-header-nav-item px-3"><a class="c-header-nav-link"
                                                  href="<?php echo Url::to(['/user/index']) ?>">Users</a></li>
            <li class="c-header-nav-item px-3"><a class="c-header-nav-link"
                                                  href="<?php echo Url::to(['/system/settings']) ?>">Settings</a></li>
        </ul>
        <ul class="c-header-nav mfs-auto">
            <li class="c-header-nav-item px-3">
                <button class="c-class-toggler c-header-nav-btn" type="button" id="header-tooltip" data-target="body"
                        data-class="c-dark-theme" data-toggle="c-tooltip" data-placement="bottom"
                        title="Toggle Light/Dark Mode">
                    <svg class="c-icon c-d-dark-none">
                        <use xlink:href="<?php echo $iconSvgUrl ?>#cil-moon"></use>
                    </svg>
                    <svg class="c-icon c-d-light-none">
                        <use xlink:href="<?php echo $iconSvgUrl ?>#cil-sun"></use>
                    </svg>
                </button>
            </li>
        </ul>
        <ul class="c-header-nav">
            <li class="c-header-nav-item dropdown d-md-down-none mx-2"><a class="c-header-nav-link"
                                                                          data-toggle="dropdown" href="#" role="button"
                                                                          aria-haspopup="true" aria-expanded="false">
                    <svg class="c-icon">
                        <use xlink:href="<?php echo $iconSvgUrl ?>#cil-bell"></use>
                    </svg>
                    <span class="badge badge-pill badge-danger">5</span></a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg pt-0">
                    <div class="dropdown-header bg-light"><strong>You have 5 notifications</strong></div>
                    <a class="dropdown-item" href="#">
                        <svg class="c-icon mfe-2 text-success">
                            <use xlink:href="<?php echo $iconSvgUrl ?>#cil-user-follow"></use>
                        </svg>
                        New user registered</a><a class="dropdown-item" href="#">
                        <svg class="c-icon mfe-2 text-danger">
                            <use xlink:href="<?php echo $iconSvgUrl ?>#cil-user-unfollow"></use>
                        </svg>
                        User deleted</a><a class="dropdown-item" href="#">
                        <svg class="c-icon mfe-2 text-info">
                            <use xlink:href="<?php echo $iconSvgUrl ?>#cil-chart"></use>
                        </svg>
                        Sales report is ready</a><a class="dropdown-item" href="#">
                        <svg class="c-icon mfe-2 text-success">
                            <use xlink:href="<?php echo $iconSvgUrl ?>#cil-basket"></use>
                        </svg>
                        New client</a><a class="dropdown-item" href="#">
                        <svg class="c-icon mfe-2 text-warning">
                            <use xlink:href="<?php echo $iconSvgUrl ?>#cil-speedometer"></use>
                        </svg>
                        Server overloaded</a>
                    <div class="dropdown-header bg-light"><strong>Server</strong></div>
                    <a class="dropdown-item d-block" href="#">
                        <div class="text-uppercase mb-1">
                            <small><b>CPU Usage</b></small>
                        </div>
                        <span class="progress progress-xs">
<div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0"
     aria-valuemax="100"></div>
</span>
                        <small class="text-muted">348 Processes. 1/4 Cores.</small>
                    </a><a class="dropdown-item d-block" href="#">
                        <div class="text-uppercase mb-1">
                            <small><b>Memory Usage</b></small>
                        </div>
                        <span class="progress progress-xs">
<div class="progress-bar bg-warning" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0"
     aria-valuemax="100"></div>
</span>
                        <small class="text-muted">11444GB/16384MB</small>
                    </a><a class="dropdown-item d-block" href="#">
                        <div class="text-uppercase mb-1">
                            <small><b>SSD 1 Usage</b></small>
                        </div>
                        <span class="progress progress-xs">
<div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0"
     aria-valuemax="100"></div>
</span>
                        <small class="text-muted">243GB/256GB</small>
                    </a>
                </div>
            </li>
            <li class="c-header-nav-item dropdown d-md-down-none mx-2"><a class="c-header-nav-link"
                                                                          data-toggle="dropdown" href="#" role="button"
                                                                          aria-haspopup="true" aria-expanded="false">
                    <svg class="c-icon">
                        <use xlink:href="<?php echo $iconSvgUrl ?>#cil-list-rich"></use>
                    </svg>
                    <span class="badge badge-pill badge-warning">15</span></a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg pt-0">
                    <div class="dropdown-header bg-light"><strong>You have 5 pending tasks</strong></div>
                    <a class="dropdown-item d-block" href="#">
                        <div class="small mb-1">Upgrade NPM &amp; Bower<span
                                    class="float-right"><strong>0%</strong></span></div>
                        <span class="progress progress-xs">
<div class="progress-bar bg-info" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
     aria-valuemax="100"></div>
</span>
                    </a><a class="dropdown-item d-block" href="#">
                        <div class="small mb-1">ReactJS Version<span class="float-right"><strong>25%</strong></span>
                        </div>
                        <span class="progress progress-xs">
<div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0"
     aria-valuemax="100"></div>
</span>
                    </a><a class="dropdown-item d-block" href="#">
                        <div class="small mb-1">VueJS Version<span class="float-right"><strong>50%</strong></span></div>
                        <span class="progress progress-xs">
<div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0"
     aria-valuemax="100"></div>
</span>
                    </a><a class="dropdown-item d-block" href="#">
                        <div class="small mb-1">Add new layouts<span class="float-right"><strong>75%</strong></span>
                        </div>
                        <span class="progress progress-xs">
<div class="progress-bar bg-info" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0"
     aria-valuemax="100"></div>
</span>
                    </a><a class="dropdown-item d-block" href="#">
                        <div class="small mb-1">Angular 8 Version<span class="float-right"><strong>100%</strong></span>
                        </div>
                        <span class="progress progress-xs">
<div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0"
     aria-valuemax="100"></div>
</span>
                    </a><a class="dropdown-item text-center border-top" href="#"><strong>View all tasks</strong></a>
                </div>
            </li>
            <li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link" href="#">
                    <svg class="c-icon">
                        <use xlink:href="<?php echo $iconSvgUrl ?>#cil-envelope-open"></use>
                    </svg>
                    <span class="badge badge-pill badge-info">7</span></a></li>
            <li class="c-header-nav-item dropdown"><a class="c-header-nav-link" data-toggle="dropdown" href="#"
                                                      role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="c-avatar"><img class="c-avatar-img"
                                               src="<?php echo $this->assetManager->getAssetUrl($coreuiBundle, 'assets/img/avatars/6.jpg') ?>"
                                               alt="user@email.com"></div>
                </a>
                <div class="dropdown-menu dropdown-menu-right pt-0">
                    <div class="dropdown-header bg-light py-2"><strong>Account</strong></div>
                    <a class="dropdown-item" href="#">
                        <svg class="c-icon mr-2">
                            <use xlink:href="<?php echo $iconSvgUrl ?>#cil-bell"></use>
                        </svg>
                        Updates<span class="badge badge-info ml-auto">42</span></a><a class="dropdown-item" href="#">
                        <svg class="c-icon mr-2">
                            <use xlink:href="<?php echo $iconSvgUrl ?>#cil-envelope-open"></use>
                        </svg>
                        Messages<span class="badge badge-success ml-auto">42</span></a><a class="dropdown-item"
                                                                                          href="#">
                        <svg class="c-icon mr-2">
                            <use xlink:href="<?php echo $iconSvgUrl ?>#cil-task"></use>
                        </svg>
                        Tasks<span class="badge badge-danger ml-auto">42</span></a><a class="dropdown-item" href="#">
                        <svg class="c-icon mr-2">
                            <use xlink:href="<?php echo $iconSvgUrl ?>#cil-comment-square"></use>
                        </svg>
                        Comments<span class="badge badge-warning ml-auto">42</span></a>
                    <div class="dropdown-header bg-light py-2"><strong>Settings</strong></div>
                    <a class="dropdown-item" href="<?php echo Url::to(['/sign-in/profile']) ?>">
                        <svg class="c-icon mr-2">
                            <use xlink:href="<?php echo $iconSvgUrl ?>#cil-user"></use>
                        </svg>
                        Profile</a><a class="dropdown-item" href="<?php echo Url::to(['/sign-in/account']) ?>">
                        <svg class="c-icon mr-2">
                            <use xlink:href="<?php echo $iconSvgUrl ?>#cil-settings"></use>
                        </svg>
                        Settings</a><a class="dropdown-item" href="#">
                        <svg class="c-icon mr-2">
                            <use xlink:href="<?php echo $iconSvgUrl ?>#cil-credit-card"></use>
                        </svg>
                        Payments<span class="badge badge-secondary ml-auto">42</span></a><a class="dropdown-item"
                                                                                            href="#">
                        <svg class="c-icon mr-2">
                            <use xlink:href="<?php echo $iconSvgUrl ?>#cil-file"></use>
                        </svg>
                        Projects<span class="badge badge-primary ml-auto">42</span></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <svg class="c-icon mr-2">
                            <use xlink:href="<?php echo $iconSvgUrl ?>#cil-lock-locked"></use>
                        </svg>
                        Lock Account</a><a class="dropdown-item" data-method="post"
                                           href="<?php echo Url::to(['/sign-in/logout']) ?>">
                        <svg class="c-icon mr-2">
                            <use xlink:href="<?php echo $iconSvgUrl ?>#cil-account-logout"></use>
                        </svg>
                        Logout</a>
                </div>
            </li>
        </ul>
        <div class="c-subheader justify-content-between px-3">
            <?= Breadcrumbs::widget([
                    'tag' => 'ol',
                'options' => ['class' => 'breadcrumb border-0 m-0 px-0 px-md-3'],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <div class="c-header-nav d-md-down-none mfe-2"><a class="c-header-nav-link" href="#">
                    <svg class="c-icon">
                        <use xlink:href="<?php echo $iconSvgUrl ?>#cil-speech"></use>
                    </svg>
                </a><a class="c-header-nav-link" href="#">
                    <svg class="c-icon">
                        <use xlink:href="<?php echo $iconSvgUrl ?>#cil-graph"></use>
                    </svg> &nbsp;Dashboard</a><a class="c-header-nav-link" href="#">
                    <svg class="c-icon">
                        <use xlink:href="<?php echo $iconSvgUrl ?>#cil-settings"></use>
                    </svg> &nbsp;Settings</a></div>
        </div>
    </header>
    <div class="c-body">
        <?php echo $content ?>
    </div>
    <footer class="c-footer">
        <div><a href="https://coreui.io">CoreUI</a> © 2019 creativeLabs.</div>
        <div class="ml-auto"><?php echo Yii::powered() ?></div>
    </footer>
</div>

<?php $this->endContent(); ?>
