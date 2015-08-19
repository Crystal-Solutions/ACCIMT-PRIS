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

            //'id',
            'epf_no',
            'name',
            'username',
            'status',
            
            
            //'auth_key',
            //'password_hash',
           // 'password_reset_token',
             'email:email',
            // 'status',
            // 'created_at',
            // 'updated_at',

          ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>