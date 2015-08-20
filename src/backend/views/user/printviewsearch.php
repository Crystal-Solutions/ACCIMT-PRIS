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
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->status=='10'?"Active":"Inactive";
                   
                        //['title'=>'View user detail', 'onclick'=>'alert("This will open the user page.")']);
                },
                // 'filterType'=>GridView::FILTER_SELECT2,
                // 'filter'=>ArrayHelper::map(User::find()->orderBy('id')->asArray()->all(), 'id', 'name'), 
                // 'filterWidgetOptions'=>[
                //     'pluginOptions'=>['allowClear'=>true],
                // ],
                // 'filterInputOptions'=>['placeholder'=>'Any user'],
                'format'=>'raw'
            ],
        
            [
                'attribute'=>'email',
                'enableSorting' => false,
            ],

        ],
    ]); ?>

</div>