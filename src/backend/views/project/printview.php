<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Report */

?>

<div class="project-view">
    <?= $this->render('_detail', [
        'model' => $model,
    ]) ?>

<?php
if($all)
{

    echo "<br/><h3>Attached reports.</h3>";
     $reports = $model->getReports()->all();
      if($reports)
      {
       foreach ($reports as $key => $report) {

         ?>
                <div class="report-content">

                  <?= $this->render('..\report\_detail', [
        'model' => $report,
                ]) ?>
                
                <div class="report-content-content">
        <?= $report->content ?>
      </div>
              </div>
         <?php
       }}


}
?>

</div>
