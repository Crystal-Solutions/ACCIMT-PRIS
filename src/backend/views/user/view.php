<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>

        <?php $isActive = ($model->status==User::STATUS_ACTIVE); ?>
        <?= Html::a( $isActive?'Deactivate':'Activate', [$isActive?'deactivate':'activate', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => $isActive?'Are you sure you want to deactivate this user?':'Are you sure you want to activate this user?',
                'method' => 'post',
            ],
        ]) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'username',
            'email:email',
            'name',
            'epf_no',
            [
              'attribute'=>'status',
              'value'=>(($model->status=='10')?'Active':'Inactive'),
            ],
        ],
    ]) ?>

<?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
                return Html::a(Html::encode($model->name), ['division/view', 'id' => $model->id]);
        },
        'summary'=>"This user is in following divisions.",
        'emptyText'=>"This user is not in any division."
]) ?>

<br>
<?= ListView::widget([
        'dataProvider' => $dataProviderAuths,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
                return Html::a(Html::encode($model->item_name));
        },
        'summary'=>"This user has following access levels.",
        'emptyText'=>"This user is not assigned to any access level.",
]) ?>

</div>
