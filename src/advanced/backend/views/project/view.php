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
        <?php if(Yii::$app->user->can('mark-dh-approval') && $model->getApprovedDhUser()->one()==null) echo Html::a('Approve by DH', ['approvedh', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
        <?php if(Yii::$app->user->can('mark-ddg-approval') && $model->getApprovedDdgUser()->one()==null) echo Html::a('Approve by DDG', ['approveddg', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
   
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'code',
            'client',
            'state',
            'description',
            'starting_date',

            'end_date',
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
              'attribute'=>'approved_ddg_user_id',
              'value'=>$model->getApprovedDdgUser()->one()==null?"-":$model->getApprovedDdgUser()->one()->name,
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

   <div class="panel-group" id="accordion">

    <div>
    <?php
      //Generate tab view of reports
      $reports = $model->getReports()->all();
      if($reports)
      {
       echo "<br/><h2>Attached reports.</h2>";

       foreach ($reports as $key => $report) {

         ?>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $key?>"><?= $report->title?></a>
                </h4>
              </div>
              <div id="collapse<?= $key?>" class="panel-collapse collapse">
                <div class="panel-body">

                  <?= $this->render('..\report\_detail', [
        'model' => $report,
                ]) ?>
                  <?= $report->content;
                  ?>
              </div>
              </div>
            </div>
         <?php
       }

      }
      else
      {
        echo "No report is attached.";
      }
    ?>
</div>
  </div>
</div>
