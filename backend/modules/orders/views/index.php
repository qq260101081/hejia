<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\presscentre\models\PresscentreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="box box-info guarantee-index">
        <div class="box-header">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Orders'), ['create'], ['class' => 'btn btn-success btn-xs']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'student_name',
            'product_name',
            'stime:date',
            'etime:date',
            'money',
            'payment_type',
            'principal',
            'remark',
            'created_at:date',

            ['class' => 'yii\grid\ActionColumn','header'=>'操作'],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
    </div>