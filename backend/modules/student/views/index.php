<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
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
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            'name',
            [
                'label' => '家长',
                'headerOptions'=>['width' => 100],
                'value' => 'patriarch.name'
            ],
            'sex',
            'age',
            'school',
            'updated_at:date',
            'created_at:date',

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
                            Html::a('<span class="glyphicon glyphicon-trash"></span>', $url):
                            '';
                    },
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
    </div>