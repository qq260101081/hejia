<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\users\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="box box-info">
    <div class="box-header">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin(['id'=>'student-pjax']); ?>    <?= GridView::widget([
        'id' => 'student-grid-view',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'sex',
            'age',
            'school',
            'updated_at:date',
            'created_at:date',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{select}',
                'header' => '操作',
                'buttons' => [
                    'select' => function ($url,$model, $key) {
                        return Html::a('选择', 'javascript:;', [
                            'title'=> '选择',
                            'onclick'=>"$('#student_id').val($model->id);$('#student_name').val('$model->name');",
                            'data-dismiss'=> 'modal'
                        ] );
                    },
                ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div>
