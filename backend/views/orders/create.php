<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Orders */

$this->title = '创建订单';
$this->params['breadcrumbs'][] = ['label' => '订单管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
