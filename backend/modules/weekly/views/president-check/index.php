
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\presscentre\models\PresscentreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'President Weekly List');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-info">
    <div class="box-header">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?php Pjax::begin(); ?>    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'attribute'=>'id',
                    'headerOptions'=> ['width'=> '60'],
                ],
                [
                    'attribute'=>'student_name',
                    'headerOptions'=> ['width'=> '100'],
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
                [
                    'attribute'=>'synthesize',
                    'format' => 'raw',
                    'value' => function($model){
                        return strip_tags($model->synthesize);
                    },
                ],
                [
                    'attribute' => 'created_at',
                    'headerOptions'=> ['width'=> '100'],
                ],
                /*[
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
                ],*/
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '操作',
                    'template' => '{check}',
                    'buttons' => [
                        'check' => function ($url,$model, $key) {
                            return  Yii::$app->user->can('weekly/president-check/check') ?
                                Html::a('审核', ['check','id'=>$key], ['title'=> '审核'] ):
                                '';
                        },
                    ],
                ],
            ],
        ]); ?>
        <?php Pjax::end(); ?></div>
</div>