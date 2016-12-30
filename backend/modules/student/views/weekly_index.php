
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
            <?= Html::a(Yii::t('app', 'Create Weekly'), ['create'], ['class' => 'btn btn-success btn-xs']) ?>
        </p>
        <?php Pjax::begin(); ?>    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'id',
                'student_name',
                'discipline',
                'sleep',
                'diet',
                'study',
                'synthesize',
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
                        'update' => function ($url,$model, $key) {
                            if(!$model->check1)
                            {
                                return Html::a('<span class="glyphicon glyphicon-edit"></span>',
                                    ['update','id'=>$key],
                                    [
                                        'title'=> '更新',
                                    ] );
                            }
                        },
                    ],
                ],
            ],
        ]); ?>
        <?php Pjax::end(); ?></div>
</div>