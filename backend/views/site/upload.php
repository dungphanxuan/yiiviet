<?php

use trntv\aceeditor\AceEditor;
use yii\web\View;

/* @var $this yii\web\View */
\common\assets\CloudinaryUploadWidget::register($this);

$this->title = 'Upload';
?>
    <h1>demo/index</h1>

    <p>
        You may change the content of this page by modifying
        the file <code><?= __FILE__; ?></code>.
    </p>

    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="exampleInputEmail1">Image Url</label>
                <input type="email" class="form-control" id="inputImageUrl" aria-describedby="emailHelp" placeholder="">
            </div>
            <br>
            <button id="upload_widget" class="cloudinary-button">Upload files</button>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <img src="" alt="" id="imageview">
        </div>
    </div>
<?php

$app_JS = <<<JS
var myWidget = cloudinary.createUploadWidget({
  cloudName: 'dfeqcehdw', 
  uploadPreset: 'eqwyir53'}, (error, result) => { 
    if (!error && result && result.event === "success") { 
      console.log('Done! Here is the image info: ', result.info); 
       
       $("#inputImageUrl").val(result.info.url);
       $("#imageview").attr("src",result.info.url);
    }
  }
)

document.getElementById("upload_widget").addEventListener("click", function(){
    myWidget.open();
  }, false);
JS;

$this->registerJs($app_JS);
