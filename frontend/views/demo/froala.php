<?php
/* @var $this yii\web\View */
?>
<h1>demo/index</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>

<div class="form-group">
    <label class="control-label col-sm-2">Message:</label>
    <div class="col-sm-10">

        <?php echo froala\froalaeditor\FroalaEditorWidget::widget([
            'name' => 'content',
            'options' => [
                // html attributes
                'id'=>'content'
            ],
            'clientOptions' => [
                'toolbarInline'=> false,
                'theme' =>'royal', //optional: dark, red, gray, royal
                'language'=>'en_gb' // optional: ar, bs, cs, da, de, en_ca, en_gb, en_us ...
            ],
            //'clientPlugins'=> ['fullscreen', 'paragraph_format', 'image']
        ]); ?>
    </div>