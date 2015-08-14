<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Report */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

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
