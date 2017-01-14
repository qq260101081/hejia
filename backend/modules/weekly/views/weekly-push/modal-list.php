<?php

use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\users\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="box box-info">
    <div class="box-header">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


<?php Pjax::begin(['id'=>'weekly-pjax']); ?>    <?= GridView::widget([
        'id' => 'weekly-grid-view',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'student_name',
            'discipline',
            'sleep',
            'diet',
            'study',
            //'synthesize',
            'created_at:date',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{select}',
                'header' => '操作',
                'buttons' => [
                    'select' => function ($url,$model, $key) {
                        $title = $model->student_name .'【'.date('Y-m-d', $model->stime).'-'.date('Y-m-d', $model->etime).'】';
                        return Html::a('选择', 'javascript:;', [
                            'title'=> '选择',
                            'onclick'=>"$('#weekly_id').val($model->id);$('#weekly_name').val('$title');",
                            'data-dismiss'=> 'modal'
                        ] );
                    },
                ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?>

</div>
</div>
