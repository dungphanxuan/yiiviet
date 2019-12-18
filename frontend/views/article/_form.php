<?php

use common\models\Article;
use common\models\ArticleCategory;
use dosamigos\selectize\SelectizeTextInput;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form ActiveForm */

\common\assets\SimpleMDE::register($this);
?>
<div class="wiki-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-9">

            <?php echo $form->errorSummary($model) ?>

            <?= $form->field($model, 'title') ?>

            <?= $form->field($model, 'body')->textarea(['class' => 'markdown-editor']) ?>

            <?php if (!$model->isNewRecord): ?>
                <?= $form->field($model, 'memo')->hint('Give a short summary of what you changed.') ?>
            <?php endif; ?>


        </div>
        <div class="col-md-3">

            <?= $form->field($model, 'category_id')->dropDownList(ArticleCategory::getSelectData(), ['prompt' => Yii::t('frontend', 'Please select...')]) ?>


            <?= $form->field($model, 'tagNames')->widget(SelectizeTextInput::class, [
                // calls an action that returns a JSON object with matched
                // tags
                'loadUrl' => ['article/list-tags'],
                'options' => ['class' => 'form-control'],
                'clientOptions' => [
                    'plugins' => ['remove_button'],
                    'valueField' => 'name',
                    'labelField' => 'name',
                    'searchField' => ['name'],
                    'create' => true,
                ],
            ])->hint(Yii::t('common', 'Use commas to separate tags')) ?>

        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('common', 'Submit'), ['class' => 'btn btn-primary']) ?>
        <?php if ($model->isNewRecord) {
            echo Html::a(Yii::t('common', 'Abort'), ['index'], ['class' => 'btn btn-danger']);
        } else {
            echo Html::a(Yii::t('common', 'Abort'), ['view', 'id' => $model->id, 'name' => $model->slug], ['class' => 'btn btn-danger']);
        } ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- wiki-_form -->

<?php
$appJS = <<<JS
window.setInterval(function()
    {
        $.get(yiiBaseUrl + '/wiki/keep-alive');
        // TODO show a nice warning when user go logged out and allow log in in other window before submitting the form
    }, 300000 /* call every 5 min */);

var simplemde = new SimpleMDE();
JS;

// register a JS function that repeatedly calls the server to keep the session alive
// this prevents issues with users getting logged out when editing wiki for long time,
$this->registerJs($appJS);

?>
