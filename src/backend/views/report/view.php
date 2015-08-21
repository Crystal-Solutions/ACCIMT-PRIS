<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Report */

$this->title = $model->title;
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
        <?php
                 $users = $model->getDivision()->one()->getUsers()->all();
                  $userId = Yii::$app->user->id;
                  $userDivision = false;
                  if($users)
                  foreach ($users as $user) {
                    if($userId==$user->id)
                    {
                        $userDivision = true;
                        break;
                    }
                  }
        ?>
        <?php if($userDivision && Yii::$app->user->can('mark-report-approval') && $model->getApprovedUser()->one()==null)
            echo Html::a('Approve', ['approve', 'id' => $model->id], ['class' => 'btn btn-primary']);
        ?>
         <?= Html::a('Print', ['printview', 'id' => $model->id], ['class' => 'btn btn-print']) ?>

    </p>

    <?= $this->render('_detail', [
        'model' => $model,
    ]) ?>



    <div class="report-content-title">Content</div>
         <div class="report-content-content">
        <?= $model->content ?>
    </div>

</div>
