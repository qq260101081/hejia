<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Orders */

$this->title = '更新订单: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '订单管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="orders-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
