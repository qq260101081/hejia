<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\RepositorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Repository');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repository-index box box-info">
    <div class="box-header">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p>
            <?php if(Yii::$app->user->can('repository/repository/create')) echo Html::a(Yii::t('app', 'Created Repository'), ['create'], ['class' => 'btn btn-success btn-xs']) ?>
        </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            'type',
            'username',
            'title',
            'path',
            'created_at:date',

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'操作',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return  Yii::$app->user->can('repository/repository/view') ?
                            Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url):
                            '';
                    },
                    'update' => function ($url, $model) {
                        return  Yii::$app->user->can('repository/repository/update') ?
                            Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url):
                            '';
                    },
                    'delete' => function ($url, $model) {
                        return  Yii::$app->user->can('repository/repository/delete') ?
                            Html::a('<span class="glyphicon glyphicon-trash"></span>', $url):
                            '';
                    },
                ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div>
