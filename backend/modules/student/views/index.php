<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\presscentre\models\PresscentreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Student List');
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="box box-info guarantee-index">
        <div class="box-header">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php if(Yii::$app->user->can('student/student/create')) echo Html::a(Yii::t('app', 'Create Student'), ['create'], ['class' => 'btn btn-success btn-xs']) ?>
    </p>
    <?php Pjax::begin(); ?>
            <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            [
                'attribute' => 'id',
                'headerOptions'=>['width' => 60],
            ],
            [
                'attribute' => 'name',
                'headerOptions'=>['width' => 70],
            ],
            [
                'label' => '家长',
                'headerOptions'=>['width' => 70],
                'value' => function($model){
                    if(isset($model['patriarch']->name))
                        return $model['patriarch']->name;
                    else
                        return '';
                },
            ],
            'school',
            [
                'attribute' => 'grade',
                'headerOptions'=>['width' => 100],
                'value' => function($model) {
                    $grade = [
                        '1'=>'一年级',
                        '2'=>'二年级',
                        '3'=>'三年级',
                        '4'=>'四年级',
                        '5'=>'五年级',
                        '6'=>'六年级',
                    ];
                    $classes = [
                        '1'=>'(1)班',
                        '2'=>'(2)班',
                        '3'=>'(3)班',
                        '4'=>'(4)班',
                        '5'=>'(5)班',
                        '6'=>'(6)班',
                        '7'=>'(7)班',
                        '8'=>'(8)班',
                        '9'=>'(9)班',
                        '10'=>'(10)班',
                        '11'=>'(11)班',
                        '12'=>'(12)班',
                        '13'=>'(13)班',
                        '14'=>'(14)班',
                        '15'=>'(15)班',
                        '16'=>'(16)班',
                        '17'=>'(17)班',
                        '18'=>'(18)班',
                        '19'=>'(19)班',
                        '20'=>'(20)班',
                    ];
                    return $grade[$model->grade] . ' ' . $classes[$model->classes];
                }
            ],
            [
                'attribute' => 'type',
                'value' => function($model){
                    $type = ['午托','晚托','日托'];
                    return $type[$model->type];
                },
                'filter' => Html::activeDropDownList($searchModel, 'type',[
                    '午托','晚托','日托'
                ],
                    ['prompt'=>'全部','class' => 'form-control'] ),
                'headerOptions'=>['width' => 80],
            ],
            [
                'attribute' => 'sex',
                'value' => function($model){
                    $sex = ['男'=>'男','女'=>'女'];
                    return $sex[$model->sex];
                },
                'filter' => Html::activeDropDownList($searchModel, 'sex',[
                    '男'=>'男','女'=>'女'
                ],
                ['prompt'=>'全部','class' => 'form-control'] ),
                'headerOptions'=>['width' => 80],
            ],
            [
               'attribute' => 'age',
                'headerOptions'=>['width' => 80],
            ],
            [
                'attribute' => 'created_at',
                'format' => 'date',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'created_at',
                    'type' => DatePicker::TYPE_INPUT,
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'autoclose'=>true, 'locale' => [
                            'format' => 'Y-m-d'
                        ]
                    ],
                ]),
                'headerOptions'=>['width' => 80],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'操作',
                'headerOptions'=>['width' => 70],
                'template' => '{view} &nbsp; {update} &nbsp; {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return  Yii::$app->user->can('student/student/view') ?
                        Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url):
                        '';
                    },
                    'update' => function ($url, $model) {
                        return  Yii::$app->user->can('student/student/update') ?
                            Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url):
                            '';
                    },
                    'delete' => function ($url, $model) {
                        return  Yii::$app->user->can('student/student/delete') ?
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