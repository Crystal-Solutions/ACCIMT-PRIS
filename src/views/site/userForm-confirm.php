<?php

use yii\helpers\Html;
?>

<?php
	if(Yii::$app->session->hasFlash('success')){
		$flash = Yii::$app->session->getFlash('success');
		echo "<h4>$flash</h4>";
	}
?>

<p>You have entered the following information:</p>

<ul>
    <li><label>Name</label>: <?= Html::encode($model->name) ?></li>
    <li><label>Email</label>: <?= Html::encode($model->email) ?></li>
</ul>

