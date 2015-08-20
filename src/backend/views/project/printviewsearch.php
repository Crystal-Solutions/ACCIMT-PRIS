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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            [
                'attribute'=>'code',
                'enableSorting' => false,
            ],

            [
                'attribute'=>'name',
                'enableSorting' => false,
            ],

            [
                'attribute'=>'project_type_id',
                'value'=>'projectType.name',    //what is projectType ?
                'enableSorting' => false,
            ],

            [
                'attribute'=>'client',
                'enableSorting' => false,
            ],
            [
                'attribute'=>'state',
                'enableSorting' => false,
            ],

            // 'description',
            [
              'attribute'=>'parent_project_id',
              'value'=>'parentProject.name',
              'enableSorting' => false,

            ],

             
            [
              'attribute'=>'requested_user_id',
              'value'=>'requestedUser.name',
              'enableSorting' => false,
            ],
            
            [
              'attribute'=>'division_id',
              'value'=>'division.name',
              'enableSorting' => false,
            ],
            

            [
                'attribute'=>'starting_date',
                'enableSorting' => false,
            ],

            [
                'attribute'=>'end_date',
                'enableSorting' => false,
            ],

            // 'parent_project_id',
             //'requested_user_id',
             //'requestedUser.name',
            //'approved_ddg_user_id',
            // 'approved_dh_user_id',
        ],
    ]); ?>


</div>