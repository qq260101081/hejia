<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\product\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ServiceProducts');
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="box box-info product-index">
        <div class="box-header">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php if(Yii::$app->user->can('serviceProduct/service-product/create')) echo Html::a(Yii::t('app', 'Create ServiceProducts'), ['create'], ['class' => 'btn btn-success btn-xs']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
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
                ],['prompt'=>'全部','class' => 'form-control'] )
            ],
            'created_at:date',

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'操作',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return  Yii::$app->user->can('serviceProduct/service-product/view') ?
                            Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url):
                            '';
                    },
                    'update' => function ($url, $model) {
                        return  Yii::$app->user->can('serviceProduct/service-product/update') ?
                            Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url):
                            '';
                    },
                    'delete' => function ($url, $model) {
                        return  Yii::$app->user->can('serviceProduct/service-product/delete') ?
                            Html::a('<span class="glyphicon glyphicon-trash"></span>', $url):
                            '';
                    },
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
    </div>