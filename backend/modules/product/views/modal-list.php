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

<?php Pjax::begin(['id'=>'product-pjax']); ?>    <?= GridView::widget([
        'id' => 'product-grid-view',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'category_id',
            'name',
            'list_img',
             'created_at:date',
            // 'updated_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{select}',
                'header' => '操作',
                'buttons' => [
                    'select' => function ($url,$model, $key) {
                        return Html::a('选择', 'javascript:;', [
                            'title'=> '选择',
                            'onclick'=>"$('#productid').val($model->id);$('#productname').val('$model->name');",
                            'data-dismiss'=> 'modal'
                        ] );
                    },
                ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div>
