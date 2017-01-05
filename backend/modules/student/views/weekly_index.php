
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

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
            <?php if(Yii::$app->user->can('student/weekly/create')) echo Html::a(Yii::t('app', 'Create Weekly'), ['create'], ['class' => 'btn btn-success btn-xs']) ?>
        </p>

        <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'id',
                'student_name',
                'discipline',
                'sleep',
                'diet',
                'study',
                'synthesize:html',
                [
                    'attribute'=>'remark',
                    'format' => 'raw',
                    'label'=>'审核',
                    'value'=> function($model){
                        if($model->remark)
                            return '<b title="'.$model->remark.'" style="color: red">未通过</b>';
                        else
                            return '';
                    }
                ],
                'created_at:date',
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


