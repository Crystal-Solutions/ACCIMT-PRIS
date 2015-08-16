<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\ProjectType;
use backend\models\Project;
use common\models\User;
use kartik\select2\Select2;
use yii\widgets\ListView;
use backend\models\TeamMember;
use unclead\widgets\MultipleInput;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Project */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'client')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <!--?= $form->field($model, 'starting_date')->textInput(['maxlength' => true]) ?-->

    <?php 
        // with an ActiveForm instance 
        ?>
        <?= $form->field($model, 'starting_date')->widget(
            DatePicker::className(), [
                // inline too, not bad
                 'inline' => false, 
                 // modify template for custom rendering
                //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-m-dd'
                ]
        ]);?>


    <!--?= $form->field($model, 'end_date')->textInput(['maxlength' => true]) ?-->

    <?php 
        // with an ActiveForm instance 
        ?>
        <?= $form->field($model, 'end_date')->widget(
            DatePicker::className(), [
                // inline too, not bad
                 'inline' => false, 
                 // modify template for custom rendering
                //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-m-dd'
                ]
        ]);?>


    <?= $form->field($model, 'parent_project_id')->dropDownList(
        ArrayHelper::map(Project::find()->all(),'id','name'),
        ['prompt' => 'Select Parent Project']
    )?>

    <?= $form->field($model, 'division_id')->dropDownList(
        ArrayHelper::map( User::findOne(Yii::$app->user->id)->getDivisions()->all(),'id','name'),
        ['prompt' => 'Select Division'
        ]
    )?>

    <!--?= $form->field($model, 'requested_user_id')->textInput() ?-->

    <!--?= $form->field($model, 'approved_ddg_user_id')->textInput() ?-->

    <!--?= $form->field($model, 'approved_dh_user_id')->textInput() ?-->

    <?= $form->field($model, 'project_type_id')->dropDownList(
        ArrayHelper::map(ProjectType::find()->all(),'id','name'),
        ['prompt' => 'Select Project Type']
    )?>

    <!--adding team leader added-Shanika-->
    <?= $form->field($model, 'team_leader')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(User::find()->all(),'id','name'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select the team leader'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <!--adding team members added-Shanika-->

    <!--?= $form->field($model,'users')->widget(Select2::classname(), [    //is users correct?
        'data' => ArrayHelper::map(User::find()->all(),'id','name'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select a member'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?-->

    <?= $form->field($model, 'users')->widget(MultipleInput::className(), [
        'limit' => 10,
        'columns' => [
            [
                'name'  => 'team_members',
                'type'  => 'dropDownList',
                'title' => '',
                //'options' => ['placeholder' => 'Select'],
                'defaultValue' => 5,        //default value not working when arrayhelper used
                'items' => ArrayHelper::map(User::find()->all(),'id','name'),       //how to get users only from same division?
                //ArrayHelper::map( User::findOne(Yii::$app->user->id)->getDivisions()->all(),'id','name'),
            ],
        ]
    ]); ?>

    <!--displaying the team members added-Shanika-->




    <!--?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
        },
        'summary'=>"Added Team members",
        'emptyText'=>"No team members added"
    ]) ?-->

    <?= $form->field($model, 'quarterly_targets')->textarea(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
