
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\presscentre\models\PresscentreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Customer Weekly List');
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
                'student_name',
                'discipline',
                'sleep',
                'diet',
                'study',
                'synthesize',
                'created_at:date',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '操作',
                    'template' => '{check}',
                    'buttons' => [
                        'check' => function ($url,$model, $key) {
                            return Html::a('审核', ['customer-check','id'=>$key], ['title'=> '审核'] );
                        },
                    ],
                ],
            ],
        ]); ?>
        <?php Pjax::end(); ?></div>
</div>