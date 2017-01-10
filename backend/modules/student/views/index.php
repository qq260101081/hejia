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

            'id',
            'name',
            'school',
            [
                'label' => '家长',
                'headerOptions'=>['width' => 100],
                'value' => 'patriarch.name'
            ],
            [
                'attribute' => 'sex',
                'value' => function($model){
                    $sex = ['男'=>'男','女'=>'女'];
                    return $sex[$model->sex];
                },
                'filter' => Html::activeDropDownList($searchModel, 'sex',[
                    '男'=>'男','女'=>'女'
                ],['prompt'=>'全部','class' => 'form-control'] )
            ],
            'age',
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
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'操作',
                'template' => '{view} {update} {delete}',
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