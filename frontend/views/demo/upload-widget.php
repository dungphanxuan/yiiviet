<?php
/* @var $this yii\web\View */
\common\assets\CloudinaryUploadWidget::register($this);
?>
<h1>demo/index</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>

<br>
<button id="upload_widget" class="cloudinary-button">Upload files</button>
    <img src="" alt="" id="imageview">
<?php

$app_JS = <<<JS
var myWidget = cloudinary.createUploadWidget({
  cloudName: 'dfeqcehdw', 
  uploadPreset: 'eqwyir53'}, (error, result) => { 
    if (!error && result && result.event === "success") { 
      console.log('Done! Here is the image info: ', result.info); 
       $("#imageview").attr("src",result.info.url);
    }
  }
)

document.getElementById("upload_widget").addEventListener("click", function(){
    myWidget.open();
  }, false);
JS;

$this->registerJs($app_JS);
