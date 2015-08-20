<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ReportTemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Report Templates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-template-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Report Template', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'name',
            //krajee gridview widget with links-Shanika 
            [
                'attribute'=>'name', 
                'vAlign'=>'middle',
                'width'=>'90%',
                'value'=>function ($model, $key, $index, $widget) { 
                    return Html::a($model->name,  
                        'index.php?r=report-template%2Fview&id='.$model->id,
                        ['title'=>'View attachment template',]);
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
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
