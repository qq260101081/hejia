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
        <?php if(Yii::$app->user->can('staff/staff/create')) echo Html::a(Yii::t('app', 'Create Staff'), ['create'], ['class' => 'btn btn-success btn-xs']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'school',
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
                'attribute' => 'diploma',
                'value' => function($model){
                    $diploma = [
                        '博士' => '博士',
                        '硕士' => '硕士',
                        '本科' => '本科',
                        '专科' => '专科',
                        '高中' => '高中',
                    ];
                    return $diploma[$model->diploma];
                },
                'filter' => Html::activeDropDownList($searchModel, 'diploma',[
                    '博士' => '博士',
                    '硕士' => '硕士',
                    '本科' => '本科',
                    '专科' => '专科',
                    '高中' => '高中',
                ],['prompt'=>'全部','class' => 'form-control'] )
            ],
            [
                'attribute' => 'position',
                'value' => function($model){
                    return Yii::$app->params['position'][$model->position];
                },
                'filter' => Html::activeDropDownList($searchModel, 'position',Yii::$app->params['position'],
                    ['prompt'=>'全部','class' => 'form-control'] )
            ],
            'phone',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} &nbsp;&nbsp; {update} &nbsp;&nbsp; {delete}',
                'header' => '操作',
                'headerOptions'=> ['width'=> '75'],
                'buttons' => [
                    'view' => function ($url, $model) {
                        return  Yii::$app->user->can('staff/staff/view') ?
                            Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url):
                            '';
                    },
                    'update' => function ($url, $model) {
                        return  Yii::$app->user->can('staff/staff/update') ?
                            Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url):
                            '';
                    },
                    'delete' => function ($url, $model) {
                        return  Yii::$app->user->can('staff/staff/delete') ?
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