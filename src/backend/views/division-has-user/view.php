<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\DivisionHasUser */

$this->title = $model->division_id;
$this->params['breadcrumbs'][] = ['label' => 'Division Has Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="division-has-user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'division_id' => $model->division_id, 'user_id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'division_id' => $model->division_id, 'user_id' => $model->user_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'division_id',
            'user_id',
        ],
    ]) ?>

</div>
