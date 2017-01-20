<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\guarantee\models\Guarantee */

$this->title = $model->product_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guarantee-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(Yii::$app->user->can('orders/orders-atv/update')) echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if(Yii::$app->user->can('orders/orders-atv/delete')) echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'patriarch_name',
            'product_name',
            'phone',
            'stime:date',
            'etime:date',
            'money',
            'payment_type',
            'principal',
            'remark',
            'created_at:date',
        ],
        'template' => '<tr><th class="col-md-2">{label}</th><td>{value}</td></tr>',
    ]) ?>

</div>