<?php
/**
 * @author Eugene Terentev <eugene@terentev.net>
 */

use common\components\keyStorage\FormWidget;

/**
 * @var $model \common\components\keyStorage\FormModel
 */

$this->title = Yii::t('backend', 'Application settings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-6">
        <?php echo FormWidget::widget([
            'model' => $model,
            'formClass' => '\yii\bootstrap4\ActiveForm',
            'submitText' => Yii::t('backend', 'Save'),
            'submitOptions' => ['class' => 'btn btn-primary'],
        ]) ?>
    </div>
</div>

