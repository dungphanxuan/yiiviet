<?php
/* @var $this \yii\web\View */

use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;

/* @var $content string */

$this->beginContent('@frontend/views/layouts/base.php')
?>
    <div class="container">
        <?php if (Yii::$app->session->hasFlash('alert')): ?>
        <div class="mt-4">
            <?php echo \yii\bootstrap4\Alert::widget([
                'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
                'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
            ]) ?></div>
        <?php endif; ?>
        <?php echo $content ?>
    </div>
<?php $this->endContent() ?>