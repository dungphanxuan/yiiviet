<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \backend\models\LoginForm */

$this->title = Yii::t('backend', 'Sign In');
$this->params['breadcrumbs'][] = $this->title;
$this->params['body-class'] = 'login-page';
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group">
                <div class="card p-4">
                    <div class="card-body">
                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                        <h1><?php echo Html::encode($this->title) ?></h1>
                        <p class="text-muted">Sign In to your account</p>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text">
                      <svg class="c-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                      </svg></span></div>
                            <?php echo Html::activeInput('text', $model, 'username', ['class' => 'form-control']) ?>
                        </div>
                        <div class="input-group mb-4">
                            <div class="input-group-prepend"><span class="input-group-text">
                      <svg class="c-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                      </svg></span></div>
                            <?php echo Html::activeInput('password', $model, 'password', ['class' => 'form-control']) ?>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <?php echo Html::submitButton(Yii::t('backend', 'Sign me in'), [
                                    'class' => 'btn btn-primary px-4',
                                    'name' => 'login-button'
                                ]) ?>
                            </div>
                            <div class="col-6 text-right">
                                <button class="btn btn-link px-0" type="button">Forgot password?</button>
                            </div>
                        </div>
                        <?php ActiveForm::end() ?>
                    </div>
                </div>
                <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
                    <div class="card-body text-center">
                        <div>
                            <h2>Sign up</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua.</p>
                            <button class="btn btn-lg btn-outline-light mt-3" type="button">Register Now!</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
