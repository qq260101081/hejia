<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Orders */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => '订单管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
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
            'id',
            'userid',
            'username',
            'product_id',
            'product_name',
            'created_at',
        ],
    ]) ?>

</div>
