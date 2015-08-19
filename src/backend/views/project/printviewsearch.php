<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\Report */

?>

<div class="project-index">



 <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'filterPosition' => GridView::FILTER_POS_FOOTER,
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'code',
            'name',
            [
                'attribute'=>'project_type_id',
                'value'=>'projectType.name',    //what is projectType ?
            ],

            'client',
            'state',

            // 'description',
            [
              'attribute'=>'parent_project_id',
              'value'=>'parentProject.name',
            ],

             
            [
              'attribute'=>'requested_user_id',
              'value'=>'requestedUser.name',
            ],
            
            [
              'attribute'=>'division_id',
              'value'=>'division.name',
            ],
            

            'starting_date',
            'end_date',

            // 'parent_project_id',
             //'requested_user_id',
             //'requestedUser.name',
            //'approved_ddg_user_id',
            // 'approved_dh_user_id',
        ],
    ]); ?>


</div>