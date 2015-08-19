<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DivisionHasUser */

$this->title = 'Update Division Has User: ' . ' ' . $model->division_id;
$this->params['breadcrumbs'][] = ['label' => 'Division Has Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->division_id, 'url' => ['view', 'division_id' => $model->division_id, 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="division-has-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
