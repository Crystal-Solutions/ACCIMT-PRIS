<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use backend\models\ReportTemplate;

/* @var $this yii\web\View */
/* @var $model backend\models\Project */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p> 
              <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          Add a report
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
          <?php 
            $reportTemplates =ReportTemplate::find()->all();
            if($reportTemplates)
              foreach ($reportTemplates as $value) {
                # code...
                ?>
                <li>

                  <?= Html::a($value->name, ['report/create', 'projectid' => $model->id, 'template'=>$value->id], ['class' => 'btn btn-primary']) ?>
                </li>
                <?php
              }
?>
          
        </ul>
      </div>
 |

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
     <?= Html::a('Print', ['printview', 'id' => $model->id], ['class' => 'btn btn-print']) ?> |
      <?= Html::a('Print with Reports', ['printviewall', 'id' => $model->id], ['class' => 'btn btn-print']) ?>

    </p>



    <?= $this->render('_detail', [
        'model' => $model,
    ]) ?>

    <!--?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
        },
        'summary'=>"Added Team members",
        'emptyText'=>"No team members added"
    ]) ?-->

  <div class="panel-group" id="accordion">

    <div>
    <?php
      //Generate tab view of reports
      $reports = $model->getReports()->all();
      if($reports)
      {
        echo "<br/><h3>Attached reports.</h3>";

        foreach ($reports as $key => $report) {

    ?>
            <div class="panel panel-default">
              <div class="panel  panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $key?>"><?= $report->title?></a>
                
                </h4>
                 <?= Html::a('View', ['report/view', 'id' => $report->id], ['class' => 'btn btn-view']) ?>

                 <?= Html::a('Print', ['report/printview', 'id' => $report->id], ['class' => 'btn btn-print']) ?>

              </div>
              <div id="collapse<?= $key?>" class="panel-collapse collapse">
                <div class="panel-body">

                  <?= $this->render('..\report\_detail', [
                    'model' => $report,
                  ]) ?>

                  <div class="report-content">
                    <div class="report-content-title">Content</div>

                    <div class="report-content-content">
                            <?= $report->content ?>
                    </div>
                  </div>
                </div>
              </div>
            </div
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
