<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Project;
use backend\models\Division;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model backend\models\Report */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="report-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'project_id')->dropDownList(
        ArrayHelper::map(Project::find()->all(),'id','name'),
        ['prompt' => 'Select Project']
    )?>
    <?= $form->field($model, 'division_id')->dropDownList(
        ArrayHelper::map(User::findOne(Yii::$app->user->id)->getDivisions()->all(),'id','name'),
        ['prompt' => 'Select Division']
    )?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['maxlength' => true]) ?>

    <!--?= $form->field($model, 'submit_date')->textInput() ?-->

    <!--?= $form->field($model, 'requested_user_id')->textInput() ?-->

    <!--?= $form->field($model, 'approved_user_id')->textInput() ?-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
