 <?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Project;
use backend\models\Division;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model backend\models\Report */
/* @var $form yii\widgets\ActiveForm */
?>

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
