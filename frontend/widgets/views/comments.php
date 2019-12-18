<?php

/* @var $comments common\models\Comment[] */
/* @var $form yii\widgets\ActiveForm */

/* @var $commentForm common\models\Comment */

use common\components\UserPermissions;
use common\models\User;
use frontend\widgets\Voter;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

\common\assets\StackEdit::register($this);
?>

    <div class="row" id="user-notes">
        <div class="col-md-offset-2 col-md-9">
            <?php if (!empty($comments)): ?>
                <span class="heading"><?php echo Yii::t('frontend', 'User Contributed Notes') ?><span
                            class="badge"><?= count($comments) ?></span></span>
            <?php else: ?>
                <span class="heading"><?php echo Yii::t('frontend', 'User Contributed Notes') ?></span>
            <?php endif; ?>
        </div>
    </div>
    <br>
    <div class="component-comments lang-en" id="comments">
        <?php if (!empty($comments)): ?>
            <?php foreach ($comments as $comment): ?>

                <!-- Single Comment -->
                <div class="media mb-4">
                    <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                    <div class="media-body">
                        <h5 class="mt-0">Commenter
                            Name<?= $comment->user ? $comment->user->rankLink : User::DELETED_USER_HTML ?> at
                            <span class="date text-muted"><small><?= Yii::$app->formatter->format($comment->created_at, 'datetime') ?></small></span>
                        </h5>
                        <?php
                        echo Yii::$app->formatter->asCommentMarkdown($comment->text);
                        ?>
                    </div>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>

    <!-- Comments Form -->
    <div class="card my-4">
        <h5 class="card-header">Leave a Comment:</h5>
        <div class="card-body">
            <?php if (!Yii::$app->user->isGuest): ?>
                <?php $form = ActiveForm::begin(); ?>
                <div class="form-group">
                    <?= $form->field($commentForm, 'text')->label(false)->textarea(['class' => 'form-control stackEdit']) ?>
                </div>
                <?= Html::submitButton('Comment', ['class' => 'btn btn-primary']) ?>
                <?php ActiveForm::end(); ?>
            <?php else: ?>
                <p><?= Html::a('Signup', ['user/sign-in/signup']) ?> or <?= Html::a('Login', ['user/sign-in/login']) ?>
                    in order to
                    comment.</p>
            <?php endif ?>
        </div>
    </div>
<?php if (isset($prompt)): ?>
    <div class="row">
        <div class="col-md-12">
            <?= $prompt ?>
        </div>
    </div>
<?php endif; ?>

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


