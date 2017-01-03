<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\users\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '用户管理');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-info">
    <div class="box-header">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <p>
            <?php if(Yii::$app->user->can('users/users/create')) echo Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success btn-xs']) ?>
        </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'name',
            'phone',
            'email',
            // 'auth_key',
            // 'password_hash',
             //'status',
             'created_at:date',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return  Yii::$app->user->can('users/users/view') ?
                            Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url):
                            '';
                    },
                    'update' => function ($url, $model) {
                        return  Yii::$app->user->can('users/users/update') ?
                            Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url):
                            '';
                    },
                    'delete' => function ($url, $model) {
                        return  Yii::$app->user->can('users/users/delete') ?
                            Html::a('<span class="glyphicon glyphicon-trash"></span>', $url):
                            '';
                    },
                ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div>
