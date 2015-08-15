<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Project', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
            

            // 'parent_project_id',
             //'requested_user_id',
             //'requestedUser.name',
            // 'approved_ddg_user_id',
            // 'approved_dh_user_id',


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
