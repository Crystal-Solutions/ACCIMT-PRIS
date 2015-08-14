<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Project */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p> 
        <?= Html::a('Add a report', ['report/createforproject', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
         <?php if(Yii::$app->user->can('mark-ddg-approval')) echo Html::a('Approve by DDG', ['approveddg', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
   
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'code',
            'client',
            'state',
            'description',
           // 'parent_project_id',
             [
              'attribute'=>'parent_project_id',
              'value'=>$model->getParentProject()->one()==null?"-":$model->getParentProject()->one()->name,
            ],

            [
              'attribute'=>'requested_user_id',
              'value'=>$model->getRequestedUser()->one()==null?"-":$model->getRequestedUser()->one()->name,
            ],

            [
              'attribute'=>'approved_dh_user_id',
              'value'=>$model->getApprovedDhUser()->one()==null?"-":$model->getApprovedDhUser()->one()->name,
            ],
            
            [
              'attribute'=>'project_type_id',
              'value'=>$model->getProjectType()->one()==null?"-":$model->getProjectType()->one()->name,
            ],            
            
            [
              'attribute'=>'division_id',
              'value'=>$model->getDivision()->one()==null?"-":$model->getDivision()->one()->name,
            ], 
          
            
            
        ],
    ]) ?>

</div>
