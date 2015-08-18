<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProjectSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'client') ?>

    <?= $form->field($model, 'state') ?>

    <?= $form->field($model, 'starting_date') ?>

    <?= $form->field($model, 'end_date') ?>

    <?php echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'parent_project_id') ?>

    <?php // echo $form->field($model, 'requested_user_id') ?>

    <?php // echo $form->field($model, 'approved_ddg_user_id') ?>

    <?php // echo $form->field($model, 'approved_dh_user_id') ?>

    <?php // echo $form->field($model, 'project_type_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
