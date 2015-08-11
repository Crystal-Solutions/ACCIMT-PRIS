<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'client')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'state')->dropDownList([ 'pending' => 'Pending', 'active' => 'Active', 'suspended' => 'Suspended', 'finished' => 'Finished', ], ['prompt' => 'Select State']) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_project_id')->textInput() ?>

    <!--?= $form->field($model, 'requested_user_id')->textInput() ?-->

    <!--?= $form->field($model, 'approved_ddg_user_id')->textInput() ?-->

    <!--?= $form->field($model, 'approved_dh_user_id')->textInput() ?-->

    <?= $form->field($model, 'project_type_id')->dropDownList([ 'pending' => 'Pending', 'active' => 'Active', 'suspended' => 'Suspended', 'finished' => 'Finished', ], ['prompt' => 'Select State']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
