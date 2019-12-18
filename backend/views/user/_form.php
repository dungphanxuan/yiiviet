<?php

use common\models\User;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserForm */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $roles yii\rbac\Role[] */
/* @var $permissions yii\rbac\Permission[] */
?>
<div class="row">
    <div class="col-6">
        <div class="user-form">
            <?php $form = ActiveForm::begin() ?>
            <?php echo $form->errorSummary($model, [
                'class' => 'alert alert-warning alert-dismissible',
                'header' => ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-warning"></i> Vui lòng sửa các lỗi sau!</h4>'
            ]); ?>
            <?php echo $form->field($model, 'username') ?>
            <?php echo $form->field($model, 'email') ?>
            <?php echo $form->field($model, 'password')->passwordInput() ?>
            <?php echo $form->field($model, 'status')->dropDownList(User::statuses()) ?>
            <?php echo $form->field($model, 'roles')->checkboxList($roles) ?>
            <div class="form-group">
                <?php echo Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end() ?>

        </div>
    </div>
</div>

