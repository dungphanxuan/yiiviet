<?php

use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\base\MultiModel */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('frontend', 'User Settings')
?>

<!-- Page Content -->

<!-- Page Heading/Breadcrumbs -->
<h1 class="mt-4 mb-3">User Settings
    <small>Profile</small>
</h1>

<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="index.html">Home</a>
    </li>
    <li class="breadcrumb-item active">User Page</li>
</ol>

<!-- Content Row -->
<div class="row">
    <!-- Sidebar Column -->
    <div class="col-lg-3 mb-4">
        <div class="list-group">
            <a href="<?php echo \yii\helpers\Url::to(['/user/default/index']) ?>" class="list-group-item active">Profile
                Setting</a>
            <a href="<?php echo \yii\helpers\Url::to(['/user/default/article']) ?>" class="list-group-item">Article</a>

        </div>
    </div>
    <!-- Content Column -->
    <div class="col-lg-9 mb-4">

        <div class="user-profile-form">

            <?php $form = ActiveForm::begin(); ?>

            <h2><?php echo Yii::t('frontend', 'Profile settings') ?></h2>

            <?php echo $form->field($model->getModel('profile'), 'picture')->widget(
                Upload::class,
                [
                    'url' => ['avatar-upload']
                ]
            ) ?>

            <div class="row">
                <div class="col-sm">  <?php echo $form->field($model->getModel('profile'), 'firstname')->textInput(['maxlength' => 255]) ?>
                </div>
                <div class="col-sm"> <?php echo $form->field($model->getModel('profile'), 'middlename')->textInput(['maxlength' => 255]) ?>
                </div>
                <div class="col-sm">
                    <?php echo $form->field($model->getModel('profile'), 'lastname')->textInput(['maxlength' => 255]) ?>
                </div>
            </div>


            <?php echo $form->field($model->getModel('profile'), 'locale')->dropDownlist(Yii::$app->params['availableLocales']) ?>

            <?php echo $form->field($model->getModel('profile'), 'gender')->dropDownlist([
                \common\models\UserProfile::GENDER_FEMALE => Yii::t('frontend', 'Female'),
                \common\models\UserProfile::GENDER_MALE => Yii::t('frontend', 'Male')
            ], ['prompt' => '']) ?>

            <h2><?php echo Yii::t('frontend', 'Account Settings') ?></h2>

            <?php echo $form->field($model->getModel('account'), 'username') ?>

            <?php echo $form->field($model->getModel('account'), 'email') ?>

            <?php echo $form->field($model->getModel('account'), 'password')->passwordInput() ?>

            <?php echo $form->field($model->getModel('account'), 'password_confirm')->passwordInput() ?>

            <div class="form-group">
                <?php echo Html::submitButton(Yii::t('frontend', 'Update'), ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
<!-- /.row -->


