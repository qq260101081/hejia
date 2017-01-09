
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\presscentre\models\PresscentreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Weekly List');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-info">
    <div class="box-header">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <p>
            <?= Html::button(Yii::t('app', '导出'), ['class' => 'btn btn-success btn-xs','id'=>'export']) ?>
            <?php if(Yii::$app->user->can('weekly/weekly/create')) echo Html::a(Yii::t('app', 'Create Weekly'), ['create'], ['class' => 'btn btn-success btn-xs']) ?>
        </p>

        <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'attribute'=>'id',
                    'headerOptions'=> ['width'=> '60'],
                ],
                [
                    'label' => '周报名称',
                    'attribute'=>'student_name',
                    'format' =>'raw',
                    'headerOptions'=> ['width'=> '150'],
                    'value' => function($model){
                        return $model->student_name . '周报 (<span style="color:gray">'.date('m.d',$model->stime).'~'.date('m.d',$model->etime).'</span>)';
                    }
                ],
                [
                    'attribute'=>'discipline',
                    'headerOptions'=> ['width'=> '50'],
                ],
                [
                    'attribute'=>'sleep',
                    'headerOptions'=> ['width'=> '50'],
                ],
                [
                    'attribute'=>'diet',
                    'headerOptions'=> ['width'=> '50'],
                ],
                [
                    'attribute'=>'study',
                    'headerOptions'=> ['width'=> '50'],
                ],
                'synthesize:html',
                [
                    'attribute'=>'check1',
                    'headerOptions'=> ['width'=> '80'],
                    'format' => 'raw',
                    'label'=>'审核状态',
                    'value'=> function($model){
                        if($model->remark)
                            return '<span title="'.$model->remark.'" style="color: red">未通过</span>';
                        else if($model->check1)
                            return '<span style="color: green">已通过</span>';
                        else
                            return '<span style="color: grey">待审</span>';
                    }
                ],
                [
                    'attribute' => 'created_at',
                    'format' => 'date',
                    'headerOptions'=> ['width'=> '100'],
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
                    'template' => '{view} &nbsp; &nbsp;{update}&nbsp; &nbsp; {delete}',
                    'header' => '操作',
                    'headerOptions'=> ['width'=> '80'],
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return  Yii::$app->user->can('student/weekly/view') ?
                                Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url):
                                '';
                        },
                        'update' => function ($url,$model, $key) {
                            if(Yii::$app->user->can('student/weekly/update'))
                            {
                                if(!$model->check1)
                                {
                                    return Html::a('<span class="glyphicon glyphicon-edit"></span>',
                                        ['update','id'=>$key],
                                        [
                                            'title'=> '更新',
                                        ] );
                                }
                            }
                        },
                        'delete' => function ($url, $model) {
                            return  Yii::$app->user->can('student/weekly/delete') ?
                                Html::a('<span class="glyphicon glyphicon-trash"></span>', $url):
                                '';
                        },
                    ],
                ],
            ],
        ]); ?>
        <?php Pjax::end(); ?></div>
</div>


