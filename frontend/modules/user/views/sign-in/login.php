<?php

use yii\authclient\widgets\AuthChoice;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\LoginForm */

$this->title = Yii::t('frontend', 'Login');
$this->params['breadcrumbs'][] = $this->title;
$bundle = \frontend\assets\FrontendAsset::register($this);
?>
<section class="fdb-block py-0">
    <div class="container py-5 my-5" style="background-image: url(<?php echo $this->assetManager->getAssetUrl($bundle, 'froala-design-blocks/imgs/shapes/4.svg') ?>);">
        <div class=" row justify-content-end">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5 text-left">
                <div class="fdb-box">
                    <div class="row">
                        <div class="col">
                            <h1><?php echo Html::encode($this->title) ?></h1>
                            <p class="lead"><?php echo Yii::t('frontend', 'Sign in to your account to continue.') ?></p>
                        </div>
                    </div>
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                    <?php echo $form->field($model, 'identity')->textInput(['placeholder' => Yii::t('frontend', 'Username or email')])->label(false) ?>
                    <?php echo $form->field($model, 'password')->passwordInput(['placeholder' => Yii::t('frontend', 'Password')])->label(false) ?>
                    <?php echo $form->field($model, 'rememberMe')->checkbox() ?>
                    <div style="color:#999;margin:1em 0">
                        <?php echo Yii::t('frontend', 'If you forgot your password you can reset it <a href="{link}">here</a>', [
                            'link' => yii\helpers\Url::to(['sign-in/request-password-reset'])
                        ]) ?>
                        <?php if (Yii::$app->getModule('user')->shouldBeActivated) : ?>
                            <br>
                            <?php echo Yii::t('frontend', 'Resend your activation email <a href="{link}">here</a>', [
                                'link' => yii\helpers\Url::to(['sign-in/resend-email'])
                            ]) ?>
                        <?php endif; ?>

                    </div>
                    <div class="form-group">
                        <?php echo Html::submitButton(Yii::t('frontend', 'Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>
                    <div class="form-group">
                        <?php echo Html::a(Yii::t('frontend', 'Need an account? Sign up.'), ['signup']) ?>
                    </div>
                    <h2><?php echo Yii::t('frontend', 'Log in with') ?>:</h2>
                    <div class="form-group">
                        <?php $authAuthChoice = yii\authclient\widgets\AuthChoice::begin([
                            'baseAuthUrl' => ['site/auth']
                        ]); ?>
                        <ul class="list-unstyle list-inline">
                            <?php foreach ($authAuthChoice->getClients() as $client): ?>
                                <li><?= $authAuthChoice->clientLink($client) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php yii\authclient\widgets\AuthChoice::end(); ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>


