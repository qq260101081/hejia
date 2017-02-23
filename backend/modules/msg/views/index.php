<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Msg Push Logs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index box box-info">

    <div class="box-header">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?php if(Yii::$app->user->can('msg/msg-push-logs/create')) echo Html::a(Yii::t('app', 'Created Msg'), ['create'], ['class' => 'btn btn-success btn-xs']) ?>
    </p>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            [
                'attribute'=>'id',
                'headerOptions'=> ['width'=> '60'],
            ],
            [
                'attribute'=>'username',
                'headerOptions'=> ['width'=> '80'],
            ],
            [
                'label' => '推送家长',
                'value' => function($model){
                    if(isset($model['patriarch']->name))
                        return $model['patriarch']->name;
                    else
                        return '';
                },
                'headerOptions'=> ['width'=> '80'],
            ],
            'title',
            //'status',
            [
                'attribute'=>'created_at',
                'format' => 'date',
                'headerOptions'=> ['width'=> '80'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'header' => '操作',
                'headerOptions'=> ['width'=> '80'],

                'buttons' => [
                    'view' => function ($url, $model) {
                        return  Yii::$app->user->can('msg/msg-push-logs/view') ?
                            Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url):
                            '';
                    },
                ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div>
