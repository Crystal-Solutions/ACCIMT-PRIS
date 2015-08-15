<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Report */

$this->title = $model->title;
?>

<div class="report-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'submit_date',
             [
              'label'=>'Relevent Project',
              'value'=>$model->getProject()->one()==null?"-":$model->getProject()->one()->name,
            ], 
            [
              'label'=>'Division',
              'value'=>$model->getDivision()->one()==null?"-":$model->getDivision()->one()->name,
            ],
            [
              'label'=>'Submitted by',
              'value'=>$model->getRequestedUser()->one()==null?"-":$model->getRequestedUser()->one()->name,
            ],
            [
              'label'=>'Approved by',
              'value'=>$model->getApprovedUser()->one()==null?"-":$model->getApprovedUser()->one()->name,
            ],
        ],
    ]) ?>

    <?= $model->content ?>

</div>
