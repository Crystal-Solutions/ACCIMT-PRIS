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

            [
                'attribute'=>'team_leader',
                'value'=>$model->getTeamLeader()->one()==null?"-":$model->getTeamLeader()->one()->name,
            ],

            [
                'attribute'=>'team_members',
                'value'=>$model->getUsers()->one()==null?"-":$model->getUsers()->all()->name,
            ],

            'quarterly_targets',

        ],
    ]) ?>
