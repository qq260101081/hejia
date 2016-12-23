<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\presscentre\models\PresscentreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Events');
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="box box-info guarantee-index">
        <div class="box-header">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Events'), ['create'], ['class' => 'btn btn-success btn-xs']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            'title',
            'info',
            [
                'attribute' => 'category_id',
                'value' => function($model){
                    $category = [
                        '4'   => '活动花絮',
                        '106' => '和家动态',
                        '136' => '行业资讯',
                        '146' => '最新活动',
                    ];
                    return $category[$model->category_id];
                },
                'filter' => Html::activeDropDownList($searchModel, 'category_id',[
                    '4'   => '活动花絮',
                    '106' => '和家动态',
                    '136' => '行业资讯',
                    '146' => '最新活动',
                ],['prompt'=>'全部','class' => 'form-control'] )
            ],
            //'category_id',
            'created_at:date',

            ['class' => 'yii\grid\ActionColumn','header'=>'操作'],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
    </div>