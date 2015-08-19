<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php
	if(Yii::$app->session->hasFlash('failure')){
		echo Yii::$app->session->getFlash('failure');
	}
?>

<?php $form = ActiveForm::begin(); ?>
<?php echo $form->field($model,'name'); ?>
<?php echo $form->field($model,'email'); ?>

	<div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>