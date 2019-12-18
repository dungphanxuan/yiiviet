<?php

use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

$this->beginContent('@frontend/views/layouts/_clear.php')
?>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="<?php echo Url::home() ?>"><?php echo Yii::t('frontend','Yii Viet')?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo Url::to('/site/index') ?>"><?php echo Yii::t('frontend','Home')?><span
                                class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Wiki Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo Url::to(['/article/index']) ?>">Forum</a>
                </li>
                <?php if (Yii::$app->user->isGuest) : ?>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="<?php echo Url::to(['/user/sign-in/login']) ?>"><?php echo Yii::t('frontend',
                                'Login') ?></a>
                    </li>
                <?php else: ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown"
                           aria-haspopup="true"
                           aria-expanded="false"><?php echo Yii::$app->user->identity->getPublicIdentity() ?></a>
                        <div class="dropdown-menu" aria-labelledby="dropdown01">
                            <a class="dropdown-item"
                               href="<?php echo Url::to(['/user/default/index']) ?>"> <?php echo Yii::t('frontend', 'Settings') ?></a>
                            <a class="dropdown-item" href="<?php echo Url::to(['/user/sign-in/logout']) ?>"
                               data-method="post"> <?php echo Yii::t('frontend', 'Logout') ?></a>
                        </div>
                    </li>
                <?php endif; ?>

            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <main role="main">

        <?php echo $content ?>

    </main>

    <footer class="fdb-block footer-small bg-dark" data-block-type="footers" data-id="9">
        <div class="container">
            <div class="row text-center align-items-center">
                <div class="col">
                    <ul class="nav justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link active" href=""
                               style="outline: none; display: inline-block;">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href=""
                               style="outline: none; display: inline-block;">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href=""
                               style="outline: none; display: inline-block;">Privacy Policy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href=""
                               style="outline: none; display: inline-block;">Terms</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href=""
                               style="outline: none; display: inline-block;">About</a>
                        </li>
                    </ul>

                    <p class="h5 mt-5">© 2019 Yii</p>
                </div>
            </div>
        </div>
    </footer>

<?php $this->endContent() ?>