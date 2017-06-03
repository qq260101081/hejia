<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Weekly Push Logs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index box box-info">

    <div class="box-header">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?php if(Yii::$app->user->can('weekly/weekly-push/create')) echo Html::a(Yii::t('app', 'Created Weekly'), ['create'], ['class' => 'btn btn-success btn-xs']) ?>
    </p>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            'student_name',
            [
                'label' => '周报名称',
                //'attribute'=>'student_name',
                'format' =>'raw',
                'headerOptions'=> ['width'=> '150'],
                'value' => function($model){
                    return $model->student_name . '周报 (<span style="color:gray">'.date('m.d',$model->stime).'~'.date('m.d',$model->etime).'</span>)';
                }
            ],
            'discipline',
            'sleep',
            'diet',
            'study',
            // 'synthesize',
            'username',
            'created_at:date',
            // 'status',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} &nbsp; {delete}',
                'header' => '操作',
                'headerOptions'=> ['width'=> '80'],

                'buttons' => [
                    'view' => function ($url, $model) {
                        return  Yii::$app->user->can('weekly/weekly-push/view') ?
                            Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url):
                            '';
                    },
                    'delete' => function ($url, $model) {
                        return  Yii::$app->user->can('weekly/weekly-push/delete') ?
                            Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                'data' => [
                                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ],
                            ]):
                            '';
                    },
                ],

            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div>

