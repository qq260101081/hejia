
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

        <?php Pjax::begin(); ?>    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [

                'id',
                [
                    'attribute' => 'name',
                    'label' => '家长',
                ],
                [
                    'label' => '学生',
                    'headerOptions'=>['width' => 100],
                    'value' => 'student.name'
                ],
                'relation',
                'phone',
                'urgency_person',
                'urgency_phone',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {open}',
                    'header' => '操作',
                    'buttons' => [
                        'open' => function ($url,$model, $key) {
                            if(Yii::$app->user->can('student/patriarch/create-user'))
                            {
                                if($model->userid) return '';
                                return Html::a('<span class="glyphicon glyphicon-user"></span>',
                                    ['/student/patriarch/create-user','id'=>$model->id],
                                    [
                                    'title'=> '开账号',
                                ] );
                            }
                        },
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
                    ],
                ],
            ],
        ]); ?>
        <?php Pjax::end(); ?></div>
</div>