<?php

use dosamigos\selectize\SelectizeTextInput;
use trntv\filekit\widget\Upload;
use trntv\yii\datetime\DateTimeWidget;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\web\JsExpression;
use common\models\Article;
use common\widgets\UploadCloudinary;

/**
 * @var $this       yii\web\View
 * @var $model      common\models\Article
 * @var $categories common\models\ArticleCategory[]
 */
$contenType = Article::CONTENT_TYPE_MARKDOWN;
if ($contenType == Article::CONTENT_TYPE_MARKDOWN) {
    //\common\assets\SimpleMDE::register($this);
    \common\assets\StackEdit::register($this);
}

?>

<?php $form = ActiveForm::begin([
    'enableClientValidation' => false,
    'enableAjaxValidation' => true,
    'options' => ['enctype' => 'multipart/form-data']
]) ?>
<?php echo $form->errorSummary($model, [
    'class' => 'alert alert-warning alert-dismissible',
    'header' => ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-warning"></i> Vui lòng sửa các lỗi sau!</h4>'
]); ?>
<?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<?php echo $form->field($model, 'slug')
    ->hint(Yii::t('backend', 'If you leave this field empty, the slug will be generated automatically'))
    ->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="col-md-6">
            <?php echo $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(
                $categories,
                'id',
                'title'
            ), ['prompt' => '']) ?>
        </div>
        <div class="col-md-6"></div>
    </div>

<?= $form->field($model, 'excerpt')->textarea(['class' => 'form-control']) ?>

<?php if ($contenType == Article::CONTENT_TYPE_MARKDOWN): ?>
    <?= $form->field($model, 'body')->textarea(['class' => 'form-control stackEdit', 'rows' => 5]) ?>
<?php endif; ?>
<?php if ($contenType == Article::CONTENT_TYPE_PLAIN): ?>
    <?php echo $form->field($model, 'body')->widget(
        \yii\imperavi\Widget::class,
        [
            'plugins' => ['fullscreen', 'fontcolor', 'video'],
            'options' => [
                'minHeight' => 400,
                'maxHeight' => 400,
                'buttonSource' => true,
                'convertDivs' => false,
                'removeEmptyTags' => true,
                'imageUpload' => Yii::$app->urlManager->createUrl(['/file/storage/upload-imperavi']),
            ],
        ]
    ) ?>
<?php
endif;
?>
    <div class="row">
        <div class="col-md-3">
            <?php echo $form->field($model, 'thumbnail')->widget(
            //Upload::class,
                UploadCloudinary::class,
                [
                    'url' => getenv('CLOUDINARY_UPLOAD_URL'),
                    'maxFileSize' => 5000000, // 5 MiB,
                    'acceptFileTypes' => new JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),
                ]);
            ?>
        </div>
        <div class="col-md-9">
            <?php echo $form->field($model, 'attachments')->widget(
                UploadCloudinary::class,
                [
                    'url' => getenv('CLOUDINARY_UPLOAD_URL'),
                    'sortable' => true,
                    'maxFileSize' => 10000000, // 10 MiB
                    'maxNumberOfFiles' => 15,
                ]);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?php echo $form->field($model, 'view')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
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
        <div class="col-md-6"></div>
    </div>

<?php echo $form->field($model, 'status')->checkbox() ?>

    <div class="row">
        <div class="col-md-3">
            <?php echo $form->field($model, 'published_at')->widget(
                DateTimeWidget::class,
                [
                    'phpDatetimeFormat' => 'yyyy-MM-dd\'T\'HH:mm:ssZZZZZ',
                ]
            ) ?>
        </div>
        <div class="col-md-9">
        </div>
    </div>
    <hr class="b2r">

    <div class="d-flex justify-content-center bd-highlight mb-3">
        <div class="p-2 bd-highlight">
            <?php echo Html::a('<i class="c-icon cil-arrow-left"></i> ' . Yii::t('common', 'Back'), ['index'], ['class' => 'btn btn-secondary btn200']); ?>
        </div>
        <div class="p-2 bd-highlight">
            <?php echo Html::submitButton(
                $model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'),
                ['class' => $model->isNewRecord ? 'btn btn-flat btn-success btn200' : 'btn btn-flat btn-primary btn200']) ?>
        </div>
        <div class="p-2 bd-highlight">
            <?php
            if (!$model->isNewRecord) {
                echo Html::a(Yii::t('common', 'Delete'), ['delete', 'id' => $model->id],
                    [
                        'class' => 'btn btn-warning btn200 bold',
                        'data' => [
                            'confirm' => Yii::t('common', 'Are you sure to delete?'),
                            'method' => 'post',
                        ]
                    ]);
            }
            ?></div>
    </div>
<?php ActiveForm::end() ?>

<?php
$appCSS = <<<CSS
.stackedit-button-wrapper img {
    width: 1.6em;
    height: 1.6em;
    vertical-align: bottom;
    margin-right: 0.33em;
}
CSS;
$textWithStackEdit = Yii::t('common', 'Edit with StackEdit');
$this->registerCss($appCSS);
$appJS = <<<JS
//var simplemde = new SimpleMDE();
const el = document.querySelector('.stackEdit');
const stackedit = new Stackedit();


// Listen to StackEdit events and apply the changes to the textarea.
stackedit.on('fileChange', (file) => {
    el.value = file.content.text;
});

function makeEditButton(el) {
    const div = document.createElement('div');
    div.className = 'stackedit-button-wrapper';
    div.innerHTML = '<a href="javascript:void(0)"><img src="https://benweet.github.io/stackedit.js/icon.svg">$textWithStackEdit</a>';
    el.parentNode.insertBefore(div, el.nextSibling);
    return div.getElementsByTagName('a')[0];
}


const textareaEl = document.querySelector('.stackEdit');
makeEditButton(textareaEl)
    .addEventListener('click', function onClick() {
        const stackedit = new Stackedit();
        stackedit.on('fileChange', function onFileChange(file) {
            textareaEl.value = file.content.text;
        });
        stackedit.openFile({
            name: 'Markdown with StackEdit',
            content: {
                text: textareaEl.value
            }
        });
    });

JS;

$this->registerJs($appJS);
