<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\DivisionHasUser */

$this->title = 'Create Division Has User';
$this->params['breadcrumbs'][] = ['label' => 'Division Has Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="division-has-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
