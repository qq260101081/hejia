<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\presscentre\models\PresscentreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '托辅订单');
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="box box-info guarantee-index">
        <div class="box-header">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php if(Yii::$app->user->can('orders/orders/create')) echo Html::a(Yii::t('app', 'Create Orders'), ['create'], ['class' => 'btn btn-success btn-xs']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'headerOptions'=> ['width'=> '80'],
            ],
            'student_name',
            [
                'attribute' => 'category_id',
                'label' => '学校',
                'headerOptions'=> ['width'=> '80'],
                'value' => function($model){
                    return $model['category']->name;
                },

            ],
            'product_name',
            'stime:date',
            'etime:date',
            /*[
                'attribute' => 'stime',
                'label' => '开始日期(>)',
                'format' => 'date',
                'headerOptions'=> ['width'=> '100'],
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'stime',
                    'type' => DatePicker::TYPE_INPUT,
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'autoclose'=>true, 'locale' => [
                            'format' => 'Y-m-d'
                        ]
                    ],
                ]),
            ],
            [
                'attribute' => 'etime',
                'label' => '结束日期(<)',
                'format' => 'date',
                'headerOptions'=> ['width'=> '100'],
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'etime',
                    'type' => DatePicker::TYPE_INPUT,
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'autoclose'=>true, 'locale' => [
                            'format' => 'Y-m-d'
                        ]
                    ],
                ]),
            ],*/
            'money',
            [
                'attribute' => 'payment_type',
                'headerOptions'=> ['width'=> '80'],
            ],
            'principal',
            //'remark',
            'created_at:date',

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'操作',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return  Yii::$app->user->can('orders/orders/view') ?
                            Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url):
                            '';
                    },
                    'update' => function ($url, $model) {
                        return  Yii::$app->user->can('orders/orders/update') ?
                            Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url):
                            '';
                    },
                    'delete' => function ($url, $model) {
                        return  Yii::$app->user->can('orders/orders/delete') ?
                            Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                'data' => [
                                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ],
                            ]):
                            '';
                    },
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
    </div>