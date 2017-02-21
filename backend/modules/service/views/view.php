<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\menus\models\Menus */

$this->title = Yii::t('app', 'View');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Family'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menus-view">
    <p>
        <?php if(Yii::$app->user->can('service/family/update')) echo  Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if(Yii::$app->user->can('service/family/delete')) echo  Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
<div class="box box-info">
	<div class="box-header with-border">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
                'attribute' => 'category_id',
                'value' => $model->getCategoryPath($model->category_id)
            ],
            'content:html',
            'created_at:date',
            'updated_at:date',
        ],
        'template' => '<tr><th class="col-md-2">{label}</th><td>{value}</td></tr>',
    ]) ?>
</div>
</div>
</div>
