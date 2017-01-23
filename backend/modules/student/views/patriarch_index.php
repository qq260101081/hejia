
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\presscentre\models\PresscentreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Patriarch List');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-info">
    <div class="box-header">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p>
            <?php if(Yii::$app->user->can('student/patriarch/create')) echo Html::a(Yii::t('app', 'Create Patriarch'), ['create'], ['class' => 'btn btn-success btn-xs']) ?>
        </p>

        <?php Pjax::begin(); ?>    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [

                'id',
                [
                    'attribute' => 'name',
                    'label' => '客户',
                ],
                [
                    'label' => '学生',
                    'headerOptions'=>['width' => 100],
                    'value' => function($model){
                        if(isset($model['student']->name))
                            return $model['student']->name;
                        else
                            return '';
                    }
                ],
                'relation',
                'phone',
                'urgency_person',
                'urgency_phone',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} &nbsp; {update} &nbsp; {delete}',
                    'header' => '操作',
                    'headerOptions'=>['width' => 70],
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return  Yii::$app->user->can('student/patriarch/view') ?
                                Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url):
                                '';
                        },
                        'update' => function ($url, $model) {
                            return  Yii::$app->user->can('student/patriarch/update') ?
                                Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url):
                                '';
                        },
                        'delete' => function ($url, $model) {
                            return  Yii::$app->user->can('student/patriarch/delete') ?
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