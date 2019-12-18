<?php
/* @var $this yii\web\View */
$this->title = Yii::$app->name;
$bundle = \frontend\assets\FrontendAsset::register($this);
?>
<section class="fdb-block fp-active" data-block-type="features" data-id="1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-left" style="z-index: 10000;"><h1>Yes, it is!</h1>
                <p class="lead">
                    Yii is a fast, secure, and efficient PHP framework.<br>
                    Flexible yet pragmatic. <br>
                    Works right out of the box. <br>
                    Has reasonable defaults.
                </p></div>
        </div>

        <div class="row text-left mt-5">
            <div class="col-12 col-sm-8 col-md-4 col-lg-3 m-sm-auto mr-md-auto ml-md-0" style="z-index: 10000;"><p><img
                            alt="image" class="img-fluid rounded"
                            src="https://cdn.jsdelivr.net/gh/froala/design-blocks@2.0.1/dist/imgs//hero/blue.svg"></p>
                <h3><strong>Fast</strong></h3>
                <p>Yii gives you the maximum functionality by adding the least possible overhead.</p></div>

            <div class="col-12 col-sm-8 col-md-4 col-lg-3 m-sm-auto pt-5 pt-md-0" style="z-index: 10000;"><p><img
                            alt="image" class="img-fluid rounded"
                            src="https://cdn.jsdelivr.net/gh/froala/design-blocks@2.0.1/dist/imgs//hero/red.svg"></p>
                <h3><strong>Secure</strong></h3>
                <p>Sane defaults and built-in tools helps you write solid and secure code.</p>
            </div>

            <div class="col-12 col-sm-8 col-md-4 col-lg-3 m-sm-auto ml-md-auto mr-md-0 pt-5 pt-md-0"
                 style="z-index: 10000;"><p><img alt="image" class="img-fluid rounded"
                                                 src="https://cdn.jsdelivr.net/gh/froala/design-blocks@2.0.1/dist/imgs//hero/yellow.svg">
                </p>
                <h3><strong>Efficient</strong></h3>
                <p>Write more code in less time with simple, yet powerful APIs and code generation.</p></div>
        </div>
    </div>
</section>

<section class="fdb-block">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 m-md-auto ml-lg-0 col-lg-5">
                <img alt="image" class="img-fluid"
                     src="<?php echo $this->assetManager->getAssetUrl($bundle, 'froala-design-blocks/imgs/draws/group-chat.svg') ?>">
            </div>
            <div class="col-12 col-md-10 col-lg-6 mt-4 mt-lg-0 ml-auto mr-auto ml-lg-auto text-left">
                <div class="row">
                    <div class="col">
                        <h1>Subscribe</h1>
                        <p class="lead">Far far away, behind the word mountains, far from the countries Vokalia and
                            Consonantia. </p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Enter your email address">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <p class="h4">* Leave your email address to be notified first.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

