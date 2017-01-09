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

        <?php Pjax::begin(['id'=>'teacher-pjax']); ?>    <?= GridView::widget([
            'id' => 'teacher-grid-view',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'name',
                'sex',
                'school',
                'phone',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{select}',
                    'header' => '操作',
                    'buttons' => [
                        'select' => function ($url,$model, $key) {
                            return Html::a('选择', 'javascript:;', [
                                'title'=> '选择',
                                'onclick'=>"$('#teacher_id').val($model->id);$('#teacher_name').val('$model->name');$('#category_id').val('$model->category_id');",
                                'data-dismiss'=> 'modal'
                            ] );
                        },
                    ],
                ],
            ],
        ]); ?>
        <?php Pjax::end(); ?></div>
</div>
