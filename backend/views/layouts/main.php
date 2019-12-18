<?php
/**
 * @var $this yii\web\View
 * @var $content string
 */
?>
<?php $this->beginContent('@backend/views/layouts/common.php'); ?>

<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <div class="card">
                <div class="card-body">
                    <?php echo $content ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php $this->endContent(); ?>
