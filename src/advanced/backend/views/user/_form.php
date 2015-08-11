<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Division;
use backend\models\AuthAssignment;

use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'epf_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= //Show password box only for new users

    $model->isNewRecord? $form->field($model, 'password')->passwordInput(['maxlength' => true]):"" 
    ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php
    if(isSet($showDivisions) && $showDivisions)
        {
        $allDivisions = ArrayHelper::map(Division::find()->all(),'id','name') ;
        echo  $form->field($model, 'divisions')->checkboxList($allDivisions);
        }
    ?>


    <?php
    if(isSet($showDivisions) && $showDivisions)
        {
        $allAuths = ArrayHelper::map(AuthAssignment::find()->all(),'item_name','item_name') ;
        echo  $form->field($model, 'auths')->checkboxList($allAuths);
        }
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>




    <?php ActiveForm::end(); ?>

</div>
