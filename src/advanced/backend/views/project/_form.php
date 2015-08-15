<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\ProjectType;
use backend\models\Project;
use common\models\User;
use kartik\select2\Select2;

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


    <?= $form->field($model, 'starting_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'end_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_project_id')->dropDownList(
        ArrayHelper::map(Project::find()->all(),'id','name'),
        ['prompt' => 'Select Parent Project']
    )?>

    <?= $form->field($model, 'division_id')->dropDownList(
        ArrayHelper::map( User::findOne(Yii::$app->user->id)->getDivisions()->all(),'id','name'),
        ['prompt' => 'Select Division
        ']
    )?>

    <!--?= $form->field($model, 'requested_user_id')->textInput() ?-->

    <!--?= $form->field($model, 'approved_ddg_user_id')->textInput() ?-->

    <!--?= $form->field($model, 'approved_dh_user_id')->textInput() ?-->

    <?= $form->field($model, 'project_type_id')->dropDownList(
        ArrayHelper::map(ProjectType::find()->all(),'id','name'),
        ['prompt' => 'Select Project Type']
    )?>

    <?= $form->field($model, 'team_leader')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(User::find()->all(),'id','name'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select the team leader'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
