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

<?php Pjax::begin(['id'=>'service-product-pjax']); ?>    <?= GridView::widget([
        'id' => 'service-product-grid-view',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            [
                'attribute' => 'type',
                'filter' => Html::activeDropDownList($searchModel, 'type',[
                    1=>'兴趣班',
                    2=>'夏冬令营',
                    3=>'课程班',
                    4=>'拓展班',
                    5=>'基础服务',
                    0=>'其他',
                ],['prompt'=>'全部'] )
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{select}',
                'header' => '操作',
                'buttons' => [
                    'select' => function ($url,$model, $key) {
                        return Html::a('选择', 'javascript:;', [
                            'title'=> '选择',
                            'onclick'=>"$('#product_id').val($model->id);$('#product_name').val('$model->name');",
                            'data-dismiss'=> 'modal'
                        ] );
                    },
                ],
            ]
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div>
