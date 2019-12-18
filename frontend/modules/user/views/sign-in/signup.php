<?php

use yii\authclient\widgets\AuthChoice;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\SignupForm */

$this->title = Yii::t('frontend', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
$bundle = \frontend\assets\FrontendAsset::register($this);
?>
<section class="fdb-block py-0">
    <div class="container py-5 my-5" style="background-image: url(<?php echo $this->assetManager->getAssetUrl($bundle, 'froala-design-blocks/imgs/shapes/6.svg') ?>);">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-7 col-xl-5 text-left">
                <div class="row">
                    <div class="col">
                        <h1><?php echo Html::encode($this->title) ?></h1>
                        <p class="lead"><?php echo Yii::t('frontend', 'Made with love for designers & developers.') ?></p>
                    </div>
                </div>
                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?php echo $form->field($model, 'username')->textInput(['placeholder' => Yii::t('frontend', 'Username')])->label(false) ?>
                <?php echo $form->field($model, 'email')->textInput(['placeholder' => Yii::t('frontend', 'E-mail')])->label(false) ?>
                <?php echo $form->field($model, 'password')->passwordInput(['placeholder' => Yii::t('frontend', 'Password')])->label(false) ?>
                <div class="form-group">
                    <?php echo Html::submitButton(Yii::t('frontend', 'Signup'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
                <h2><?php echo Yii::t('frontend', 'Sign up with')  ?>:</h2>
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
</section>
