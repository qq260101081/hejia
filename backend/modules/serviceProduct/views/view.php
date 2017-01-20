<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

function types($model)
{
    $types = [
        1=>'兴趣班',
        2=>'夏冬令营',
        3=>'课程班',
        4=>'拓展班',
        5=>'基础服务',
        0=>'其他',
    ];
    return $types[$model->type];
}
/* @var $this yii\web\View */
/* @var $model app\modules\product\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ServiceProducts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(Yii::$app->user->can('serviceProduct/service-product/update')) echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if(Yii::$app->user->can('serviceProduct/service-product/delete')) echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
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
            'name',
            [
                'attribute' => 'type',
                'value' => types($model),
            ],
            'info',
            'created_at:date',
        ],
        'template' => '<tr><th class="col-md-2">{label}</th><td>{value}</td></tr>',
    ]) ?>

</div>