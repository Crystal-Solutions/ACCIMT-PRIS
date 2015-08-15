<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Report */

$this->title = $model->title;
?>

<div class="report-view">
    <?= $this->render('_detail', [
        'model' => $model,
    ]) ?>

    <?= $model->content ?>

</div>
