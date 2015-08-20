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
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
             [
                'attribute'=>'epf_no',
                'enableSorting' => false,
            ],

            [
                'attribute'=>'name',
                'enableSorting' => false,
            ],

            [
                'attribute'=>'username',
                'enableSorting' => false,
            ],

            [
                'attribute'=>'status',
                'enableSorting' => false,
            ],
            
            
            //'auth_key',
            //'password_hash',
           // 'password_reset_token',

            [
                'attribute'=>'email',
                'enableSorting' => false,
            ],

            // 'status',
            // 'created_at',
            // 'updated_at',

        ],
    ]); ?>

</div>