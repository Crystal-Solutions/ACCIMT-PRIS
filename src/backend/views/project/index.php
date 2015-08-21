<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use backend\models\Project;

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
        <?= Html::a('Print', ['printviewsearch'], ['class' => 'btn btn-print']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          

           // 'id',
            'code',
            //'name',
            //krajee gridview widget with links-Shanika 
            [
                'attribute'=>'name', 
                'vAlign'=>'middle',
                'width'=>'180px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return Html::a($model->name,  
                        'index.php?r=project%2Fview&id='.$model->id,
                        ['title'=>'View project detail',]);
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
            ////////////////////////////////////////////////
            [
                'attribute'=>'project_type_id',
                'value'=>'projectType.name',    //what is projectType ?
            ],

            'client',
            'state',
            //krajee gridview widget with links-Shanika 
            [
                'attribute'=>'parent_project_id', 
                'vAlign'=>'middle',
                'width'=>'180px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return Html::a($model->getParentProject()->one()==null?"":$model->getParentProject()->one()->name,  
                        $model->getParentProject()->one()==null?"#":'index.php?r=project%2Fview&id='.$model->getParentProject()->one()->id,
                        ['title'=>'View parent project detail',]);
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
            //krajee gridview widget with links-Shanika 
            [
                'attribute'=>'requested_user_id', 
                'vAlign'=>'middle',
                'width'=>'180px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return Html::a($model->getRequestedUser()->one()==null?"":$model->getRequestedUser()->one()->name,  
                        $model->getRequestedUser()->one()==null?"#":'index.php?r=user%2Fview&id='.$model->getRequestedUser()->one()->id,
                        ['title'=>'View requested user detail',]);
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
            ////////////////////////////////////////////////
            [
                'attribute'=>'division_id', 
                'vAlign'=>'middle',
                'width'=>'180px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return Html::a($model->getDivision()->one()==null?"":$model->getDivision()->one()->name,  
                        $model->getDivision()->one()==null?"#":'index.php?r=division%2Fview&id='.$model->getDivision()->one()->id,
                        ['title'=>'View project division detail',]);
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
            ////////////////////////////////////////////////

            'starting_date',
            'end_date',








            // 'parent_project_id',
             //'requested_user_id',
             //'requestedUser.name',
            //'approved_ddg_user_id',
            // 'approved_dh_user_id',


            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
