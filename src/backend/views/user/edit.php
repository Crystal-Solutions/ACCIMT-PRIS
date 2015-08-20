<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Edit Your Profile';

//-S
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>
<p>
     <?= Html::a('Change Password', ['change-password', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
 </p>
    <?= $this->render('_form', [
        'model' => $model,
        'showDivisions' => false,
        //'showAuths' => true,
    ]) ?>

</div>
