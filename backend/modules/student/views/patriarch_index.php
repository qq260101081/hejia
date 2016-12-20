
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
                'student_id',
                'name',
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
                            if($model->userid) return '';
                            return Html::a('<span class="glyphicon glyphicon-user"></span>',
                                ['/student/patriarch/create-user','id'=>$model->id],
                                [
                                'title'=> '开账号',
                            ] );
                        },
                    ],
                ],
            ],
        ]); ?>
        <?php Pjax::end(); ?></div>
</div>