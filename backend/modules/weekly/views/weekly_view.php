<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\guarantee\models\Guarantee */

$this->title = Yii::t('app', 'View');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Weekly List'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guarantee-view">

    <h1><?= Html::encode($model->student_name . ' ('.date('m.d',$model->stime).'~'.date('m.d',$model->etime).')') ?></h1>

    <p>
        <?php if($model->check1 == 0):;?>
        <?php if(Yii::$app->user->can('student/weekly/update')) echo  Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif;?>
        <?php if(Yii::$app->user->can('student/weekly/delete')) echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
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
            'userid',
            'student_name',
            'discipline',
            'sleep',
            'diet',
            'study',
            'synthesize:html',
            'created_at:date',
        ],
    ]) ?>

</div>