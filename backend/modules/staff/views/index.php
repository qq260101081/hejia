<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\presscentre\models\PresscentreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Staff List');
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="box box-info guarantee-index">
        <div class="box-header">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Staff'), ['create'], ['class' => 'btn btn-success btn-xs']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'diploma',
            // 'photo',
            'position',
            'school',
            'phone',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} &nbsp;&nbsp; {update} &nbsp;&nbsp; {delete}',
                'header' => '操作',
                'headerOptions'=> ['width'=> '75'],

            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
    </div>