<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <link rel="stylesheet" type="text/css" href="<?= Yii::$app->request->baseUrl ?>/css/print.css">
     <script src="<?php echo Yii::$app->request->baseUrl; ?>/ckeditor/ckeditor.js"></script>
</head>
<body>
<?php $this->beginBody() ?>
    <div class="container">
    <div class="non-printable">
        <a href="<?php echo Yii::$app->request->baseUrl; ?>">Home </a> - 
        <a href="javascript:window.print()"> <span class="glyphicon glyphicon-print" > </span> Print</a>
    </div>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
